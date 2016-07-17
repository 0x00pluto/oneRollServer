<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/18
 * Time: 上午10:39
 */

namespace dbs\scene\buildingExtend;


use configdata\configdata_item_dishes_setting;
use constants\constants_custom;
use constants\constants_dinnertable;
use constants\constants_mission;
use dbs\dbs_mission;
use dbs\dbs_player;
use dbs\i\dbs_i_iCooldown;
use dbs\templates\scene\BuildingData\dbs_templates_scene_BuildingData_dinnerTable;

/**
 * 餐台类
 * Class dbs_scene_buildingExtend_dinnerTable
 * @package dbs\scene\buildingExtend
 */
class dbs_scene_buildingExtend_dinnerTable extends dbs_templates_scene_BuildingData_dinnerTable implements dbs_i_iCooldown
{
    use dbs_scene_buildingExtend_operate;

    /**
     * @inheritDoc
     */
    public function getExtendKey()
    {
        return "dinnerTable";
    }

    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue(self::DBKey_status, constants_dinnertable::STATUS_EMPTY);
    }

    /**
     * 餐台是否为空
     * @return bool
     */
    public function isEmpty()
    {
        return $this->get_status() == constants_dinnertable::STATUS_EMPTY;
    }

    /**
     * 餐台菜品数量
     * @return int|number
     */
    public function getDishesCount()
    {
        if ($this->isEmpty()) {
            return 0;
        }
        return array_sum($this->get_dishesArr());

    }

    /**
     * 是否可以放置菜品
     *
     * @param string $dishesId
     *            菜品id
     * @return boolean
     */
    public function canPut($dishesId)
    {
        $dishesId = strval($dishesId);
        if ($this->isEmpty()) {
            return true;
        }
        // 相同种类的菜
        if ($this->get_dishesid() == $dishesId) {
            return true;
        }
        return false;
    }

    /**
     * 放菜
     *
     * @param string $dishesId
     *            菜品id
     * @param int $count
     *            数量
     */
    /**
     * @param string $dishesId
     * @param $count
     * @return bool
     */
    public function putDishes($dishesId, $count)
    {
        $dishesId = strval($dishesId);
        $count = intval($count);

        $dishesArr = $this->get_dishesArr();

        if (!$this->canPut($dishesId)) {
            return false;
        }

        // 菜品数组
        $dishesArr [] = $count;
        $this->set_dishesid($dishesId);
        $this->set_lastSellTime(time());
        $this->set_dishesArr($dishesArr);

        $this->set_status(constants_dinnertable::STATUS_HAS_DISHES);
        $this->save();
        return true;
    }

    /**
     * 出售菜品
     * @param $count
     * @param dbs_player $player
     * @return int|mixed 实际出售数量
     */
    public function sellDishes($count, dbs_player $player)
    {
        $dishesArr = $this->get_dishesArr();
        $totalReduceCount = $count;
        //实际出售的数量
        $realReduceCount = 0;
        foreach ($dishesArr as $key => $value) {
            $reduceCount = min([$value, $totalReduceCount]);

            $dishesArr[$key] -= $reduceCount;
            $totalReduceCount -= $reduceCount;
            $realReduceCount += $reduceCount;

            if ($dishesArr[$key] === 0) {
                unset($dishesArr[$key]);
            }

            if ($totalReduceCount === 0) {
                break;
            }
        }

        if ($realReduceCount !== 0) {
            dbs_mission::createWithPlayer($player)->set_mission_object_type_count(
                constants_mission::MISSION_FINISH_CONDITION_2,
                $this->get_dishesId(),
                $realReduceCount
            );
        }


        //全部卖光了
        if (empty($dishesArr)) {
            $this->reset_status()
                ->reset_lastSellTime()
                ->reset_dishesArr()
                ->reset_dishesId();
        } else {
            $this->set_dishesArr($dishesArr);
        }


        $this->save();

        return $realReduceCount;
    }

    /**
     * 获取当前出售菜的价格
     * @param int $num 菜的数量
     * @return int
     */
    public function getPrice($num = 1)
    {
        $num = intval($num);
        if ($num <= 0) {
            return 0;
        }
        if ($this->isEmpty()) {
            return 0;
        }
        $dishesId = $this->get_dishesId();
        $dishesConfig = getConfigData(configdata_item_dishes_setting::class,
            configdata_item_dishes_setting::k_id,
            $dishesId);

        if (is_null($dishesConfig)) {
            return 0;
        }
        return intval($dishesConfig[configdata_item_dishes_setting::k_price]) * $num;
    }

    /**
     * 清台
     */
    public function clearTable()
    {
        $this->reset_dishesId()
            ->reset_dishesArr()
            ->reset_lastSellTime()
            ->reset_status();
    }

    /**
     * @inheritDoc
     */
    function getCooldownTime()
    {
        if ($this->is_Cooldown()) {
            return $this->getDishesCount();
        }
        return 0;
    }

    /**
     * @inheritDoc
     */
    function clearCooldown()
    {
        $this->clearTable();
    }

    /**
     * @inheritDoc
     */
    function get_clearCooldownDiamond()
    {
        return 1;
    }

    /**
     * @inheritDoc
     */
    function is_Cooldown()
    {
        return !$this->isEmpty();
    }


}