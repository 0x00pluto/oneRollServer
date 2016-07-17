<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/23
 * Time: 下午4:06
 */

namespace dbs\dishesHandbook;


use configdata\configdata_dishes_handbook_setting;
use constants\constants_messagecmd;
use dbs\dbs_sync;
use dbs\templates\disheshandbook\dbs_templates_disheshandbook_handbooks;

/**
 * 菜品图鉴
 * Class dbs_dishesHandbook_player
 * @package dbs\dishesHandbook
 */
class dbs_dishesHandbook_player extends dbs_templates_disheshandbook_handbooks
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * 获取图鉴数据
     * @param $dishesId
     * @return null|dbs_dishesHandbook_data
     */
    public function getDishesHandbookData($dishesId)
    {
        $handbooks = $this->get_handbooks();
        if (isset($handbooks[$dishesId])) {
            return dbs_dishesHandbook_data::create_with_array($handbooks[$dishesId]);
        }
        return null;
    }

    /**
     * 设置图鉴数据
     * @param dbs_dishesHandbook_data $data
     */
    public function setDishesHandbookData(dbs_dishesHandbook_data $data)
    {
        $handbooks = $this->get_handbooks();
        $handbooks[$data->get_dishesId()] = $data->toArray();
        $this->set_handbooks($handbooks);
    }


    /**
     * 获取图鉴配置
     * @param $dishesId
     * @return array|null
     */
    public function getHandBookConfig($dishesId)
    {
        return getConfigData(
            configdata_dishes_handbook_setting::class,
            configdata_dishes_handbook_setting::k_itemid,
            $dishesId);
    }

    /**
     * 激活图鉴
     * @param $dishesId
     * @param int $cookTimes
     * @return bool
     */
    public function activeHandBook($dishesId, $cookTimes = 1)
    {
        $dishesConfig = $this->getHandBookConfig($dishesId);
        if (is_null($dishesConfig)) {
            return false;
        }

        $dishesHandbookData = $this->getDishesHandbookData($dishesId);
        $isComplete = false;
        if (is_null($dishesHandbookData)) {
            //之前没有图鉴数据.直接添加
            $dishesHandbookData = dbs_dishesHandbook_data::create($dishesId, $cookTimes);
            $isComplete = $dishesHandbookData->get_isComplete();
        } else {
            if ($dishesHandbookData->get_isComplete()) {
                return false;
            }
            $dishesHandbookData->addCookTimes($cookTimes, $isComplete);
        }

        $this->setDishesHandbookData($dishesHandbookData);

        if ($isComplete) {
            dbs_sync::createWithPlayer($this->db_owner)->mark_sync(constants_messagecmd::S2C_OPEN_DISHES_HANDBOOK,
                $dishesHandbookData->toArray());
        }
        return true;
    }


    /**
     * 获取图鉴人气值
     * @param $themeRestaurantId
     * @return int
     */
    public function getReputation($themeRestaurantId)
    {
        $themeRestaurantId = intval($themeRestaurantId);
        $handBooks = $this->get_handbooks();

        $totalReputation = 0;
        foreach ($handBooks as $handBook) {
            $handBookData = dbs_dishesHandbook_data::create($handBook);

            if ($handBookData->get_isComplete()) {
                $handBookConfig = $handBookData->getHandbookConfig();
                if (intval($handBookConfig[configdata_dishes_handbook_setting::k_themerestaurantid]) == $themeRestaurantId) {
                    $totalReputation += intval($handBookConfig[configdata_dishes_handbook_setting::k_reputation]);
                }
            }
        }
        return $totalReputation;
    }

    /**
     * 图鉴是否完成
     * @param $dishesId
     * @return bool
     */
    public function isComplete($dishesId)
    {
        $data = $this->getDishesHandbookData($dishesId);
        if (is_null($data)) {
            return false;
        }
        return $data->get_isComplete();
    }


}