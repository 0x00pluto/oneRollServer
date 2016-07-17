<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/30
 * Time: 下午7:42
 */

namespace dbs\scene;


use configdata\configdata_scene_expand;
use dbs\i\dbs_i_iCooldown;
use dbs\templates\scene\dbs_templates_scene_sceneExpandData;

class dbs_scene_expandInfo extends dbs_templates_scene_sceneExpandData implements dbs_i_iCooldown
{

    /**
     * 获取扩地配置
     * @param int $themeRestaurantId 主题餐厅ID
     * @param int $level -1为当前等级配置
     * @return null
     */
    public function getExpandConfig($themeRestaurantId, $level = -1)
    {
        if ($level === -1) {
            $level = $this->get_level();
        }
        $themeRestaurantId = intval($themeRestaurantId);
        foreach (configdata_scene_expand::data() as $data) {
            if (intval($data[configdata_scene_expand::k_themerestaurantid]) == $themeRestaurantId &&
                intval($data[configdata_scene_expand::k_expandlevel]) == $level
            ) {
                return $data;
            }
        }

        return null;
    }

    /**
     * 通过ID获取扩地配置
     * @param $id
     * @return null
     */
    public function getExpandConfigById($id)
    {
        return getConfigData(configdata_scene_expand::class,
            configdata_scene_expand::k_id, $id);
    }


    /**
     * @inheritDoc
     */
    function clearCooldown()
    {
        $this->set_cooldown(0);
    }

    /**
     * @inheritDoc
     */
    function getCooldownTime()
    {
        if (!$this->is_Cooldown()) {
            return 0;
        }
        return $this->get_cooldown() - time();
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
        if ($this->get_expanding()) {
            if (time() < $this->get_cooldown()) {
                return true;
            }
        }
        return false;
    }

    /**
     * 减少扩地时间
     * @param int $time
     */
    function reduceTime($time = 1)
    {
        if ($this->is_Cooldown()) {
            $leftSecond = $this->getCooldownTime();
            if ($time >= $leftSecond) {
                $this->clearCooldown();
            } else {
                $this->set_cooldown($this->getCooldownTime() - $time);
            }
        }
    }


}