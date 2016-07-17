<?php

namespace dbs\chef;

use Common\Util\Common_Util_Configdata;
use configdata\configdata_chef_upgrade_setting;
use dbs\templates\chef\dbs_templates_chef_vitdata;

/**
 * 厨师体力数据
 *
 * @author zhipeng
 *
 */
class dbs_chef_vitdata extends dbs_templates_chef_vitdata
{


    /**
     * 填满体力
     * @param int $level 等级
     * @return bool
     */
    public function fillVitToFull($level)
    {

        $vitMaxConfig = Common_Util_Configdata::getInstance()->getconfigdata(configdata_chef_upgrade_setting::class,
            configdata_chef_upgrade_setting::k_level,
            $level);
        if (is_null($vitMaxConfig)) {
            return false;
        }
        $vitMax = intval($vitMaxConfig [configdata_chef_upgrade_setting::k_vitmax]);
        $this->set_vitmax($vitMax);
        $this->set_vit($vitMax);
        return true;
    }


    /**
     * 体力是否满了
     *
     * @return boolean
     */
    public function isvitfull()
    {
        return $this->get_vit() >= $this->get_vitmax();
    }

    /**
     * 增加体力
     *
     * @param integer $vit
     * @return boolean
     */
    public function addvit($vit)
    {
        $vit = intval($vit);
        if ($vit <= 0) {
            return false;
        }
        if ($this->get_vit() >= $this->get_vitmax()) {
            return false;
        }
        $this->set_vit($this->get_vit() + $vit);
        if ($this->get_vit() >= $this->get_vitmax()) {
            $this->set_lastfillvittime(0);
        }
        return true;
    }

    /**
     * 耗费体力
     * @param int $vit
     * @return bool
     */
    public function costvit($vit)
    {
        $vit = intval($vit);
        if ($vit <= 0) {
            return false;
        }
        /**
         * 体力不足
         */
        if ($vit > $this->get_vit()) {
            return false;
        }

        $currentvit = max(array(
            $this->get_vit() - $vit,
            0
        ));
        $this->set_vit($currentvit);

//        dump($currentvit);

        return true;
    }
}