<?php

namespace dbs;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_item_equipment_setting;
use configdata\configdata_item_equipment_upgrade_coefficient_setting;
use configdata\configdata_item_equipment_upgrade_setting;
use configdata\configdata_item_setting;
use configdata\configdata_vip_function_setting;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\equipment\dbs_equipment_givedata;
use dbs\item\dbs_item_equipment;
use dbs\item\dbs_item_normal;
use dbs\templates\dbs_templates_equipment;
use err\err_dbs_equipment_upgrade;
use err\err_dbs_equipment_upgradelogic;

/**
 * 装备服务
 *
 * @author zhipeng
 *
 */
class dbs_equipment extends dbs_templates_equipment
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 获取赠与数据
     *
     * @param string $userid
     * @return NULL|dbs_equipment_givedata
     */
    public function get_giveequipmentdata($userid)
    {
        $equipmentlist = $this->get_giveequipmentlist();
        if (!array_key_exists_faster($userid, $equipmentlist)) {
            return NULL;
        }
        $dataarr = $equipmentlist [$userid];
        $data = new dbs_equipment_givedata ();
        $data->fromArray($dataarr);
        return $data;
    }

    /**
     * 设置赠与数据
     *
     * @param dbs_equipment_givedata $data
     */
    public function set_giveequipmentdata(dbs_equipment_givedata $data)
    {
        $equipmentlist = $this->get_giveequipmentlist();
        $equipmentlist [$data->get_giveuserid()] = $data->toArray();
        $this->set_giveequipmentlist($equipmentlist);
    }


    /**
     * 赠送装备
     *
     * @param string $destuserid
     * @param string $newpos
     *            新的
     * @param string $replacepos
     */
    function giveequipment($destuserid, $newpos, $replacepos = NULL)
    {
        $destuserid = strval($destuserid);
        $newpos = strval($newpos);
        $replacepos = strval($replacepos);

        $data = $this->get_giveequipmentdata($destuserid);
        if (is_null($data)) {
            $data = new dbs_equipment_givedata ();
            $data->set_giveuserid($destuserid);
        }
        $data->giveequipment($newpos, $replacepos);
        $this->set_giveequipmentdata($data);
    }

    /**
     * 获取强化配置
     *
     * @param unknown $quality
     * @return Ambigous <multitype:, string>
     */
    static function get_upgradeconfig($level)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_equipment_upgrade_setting::class, configdata_item_equipment_upgrade_setting::k_level, $level);
    }

    /**
     * 获取强化系数配置
     *
     * @param $quality
     */
    static function get_upgradecoefficientconfig($quality)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_equipment_upgrade_coefficient_setting::class, configdata_item_equipment_upgrade_coefficient_setting::k_quality, $quality);
    }

    /**
     * 获取道具装备配置
     *
     * @param $itemid
     * @return Ambigous <multitype:, string>
     */
    static function get_equipmentsetting($itemid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_equipment_setting::class, configdata_item_equipment_setting::k_id, $itemid);
    }

    // 装备升级逻辑
    private function upgradelogic(dbs_item_normal $item)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $equipitem = new dbs_item_equipment ($item);

        $maxlevel = $this->db_owner->db_restaurantinfo()->get_restaurantlevel() * 3;

        if ($equipitem->get_level() >= $maxlevel) {
            $retCode = err_dbs_equipment_upgradelogic::UPGRADE_LEVEL_MAX;
            $retCode_Str = 'UPGRADE_LEVEL_MAX';
            goto failed;
        }

        // 原始等级
        $oldequipmentlevel = $equipitem->get_level();

        $upgradeconfig = self::get_upgradeconfig($equipitem->get_level());

        if (is_null($upgradeconfig)) {
            $retCode = err_dbs_equipment_upgradelogic::UPGRADE_CONFIG_ERROR;
            $retCode_Str = 'UPGRADE_CONFIG_ERROR';
            goto failed;
        }

        if (!array_key_exists_faster(configdata_item_equipment_upgrade_setting::k_nextlevel, $upgradeconfig)) {
            $retCode = err_dbs_equipment_upgradelogic::CANNOT_UPGRADE;
            $retCode_Str = 'CANNOT_UPGRADE';
            goto failed;
        }

        // 升级后装备的基础等级
        $nextequipmentlevel = intval($upgradeconfig [configdata_item_equipment_upgrade_setting::k_nextlevel]);

        $nextlevelconfig = self::get_upgradeconfig($nextequipmentlevel);
        $itemconfig = dbs_item::getInstance()->getItemConfig($item->get_itemid());

        // dump ( $itemconfig );
        $coefficientconfig = self::get_upgradecoefficientconfig($itemconfig [configdata_item_setting::k_quality]);
        $coefficient = floatval($coefficientconfig [configdata_item_equipment_upgrade_coefficient_setting::k_coefficient]);

        // dump ( $coefficientconfig );
        // 需要游戏币
        $gamecoin = intval($nextlevelconfig [configdata_item_equipment_upgrade_setting::k_gamecoin]) * $coefficient;
        $gamecoin = ceil($gamecoin);

        // 需要道具
        $needitemid = $nextlevelconfig [configdata_item_equipment_upgrade_setting::k_itemid];
        $needitemcount = intval($nextlevelconfig [configdata_item_equipment_upgrade_setting::k_itemcount]);
        $needitemcount = ceil($needitemcount * $coefficient);

        if ($this->db_owner->db_role()->get_gamecoin() < $gamecoin) {
            $retCode = err_dbs_equipment_upgradelogic::NOT_ENOUGH_GAMECOIN;
            $retCode_Str = 'NOT_ENOUGH_GAMECOIN';
            goto failed;
        }

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $needitemid);

        if (is_null($warehouse)) {
            $retCode = err_dbs_equipment_upgradelogic::NOT_ENOUGH_MATERIALS;
            $retCode_Str = 'NOT_ENOUGH_MATERIALS';
            goto failed;
        }

        if (!$warehouse->hasItem($needitemid, $needitemcount)) {
            $retCode = err_dbs_equipment_upgradelogic::NOT_ENOUGH_MATERIALS;
            $retCode_Str = 'NOT_ENOUGH_MATERIALS';
            goto failed;
        }

        // 扣钱
        $this->db_owner->db_role()->cost_gamecoin($gamecoin, constants_moneychangereason::UPGRADE_EQUIPMENT);

        // 扣除道具
        $warehouse->removeItemByItemId($needitemid, $needitemcount);

        // 获取暴击率
        $vipconfig = dbs_vip::get_function_config($this->db_owner->db_role()->get_viplevel());
        $critrate = $vipconfig [configdata_vip_function_setting::k_equipmentupgradecrit];
        $critrate = intval($critrate);
        $critvalue = $vipconfig [configdata_vip_function_setting::k_equipmentupgradecritvalue];
        $critvalue = intval($critvalue);

        // 暴击增加等级
        $critaddlevel = 0;
        $critrandom = rand(0, 10000);
        if ($critrandom < $critrate) {
            // 暴击
            $critaddlevel = rand(1, $critvalue);
        }

        $finalequipmentlevel = $nextequipmentlevel + $critaddlevel;
        if ($finalequipmentlevel > 300) {
            // 修正最大等级
            $finalequipmentlevel = 300;
        }

        $data [constants_returnkey::RK_CRIT] = $critaddlevel;
        $data [constants_returnkey::RK_LEVEL] = $finalequipmentlevel;
        // 保存装备
        $equipitem->set_level($finalequipmentlevel);
        $equipitem->add_upgradecostgamecoin($gamecoin);
        // 计算装备属性
        $equipitem->compute();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 升级装备
     *
     * @param string $pos
     *            装备位置
     * @return Common_Util_ReturnVar
     */
    function upgrade($pos)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $pos = strval($pos);
        // class err_dbs_equipment_upgrade{}

        $itemdata = $this->db_owner->dbs_warehouseequipment()->getitem($pos);
        if (is_null($itemdata)) {
            $retCode = err_dbs_equipment_upgrade::EQUIPMENT_NOT_EXISTS;
            $retCode_Str = 'EQUIPMENT_NOT_EXISTS';
            goto failed;
        }
        $item = new dbs_item_normal ();
        $item->fromArray($itemdata);
        $data [constants_returnkey::RK_SRC] = $item->toArray();

        $ret = $this->upgradelogic($item);
        if ($ret->is_failed()) {
            return $ret;
        }

        $data [constants_returnkey::RK_CRIT] = $ret->get_retdata() [constants_returnkey::RK_CRIT];
        $data [constants_returnkey::RK_DEST] = $item->toArray();
        // 保存数据
        $this->db_owner->dbs_warehouseequipment()->modifyItem($pos, $item);

//        $this->db_owner->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_113, $item->get_itemid(), $ret->get_retdata() [constants_returnkey::RK_LEVEL]);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }


}