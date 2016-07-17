<?php

namespace dbs;

use configdata\configdata_buildingwarehouse_setting;
use err\err_dbs_warehousebuildingitem_upgrade;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Configdata;
use constants\constants_returnkey;
use constants\constants_mission;

/**
 * 建材仓库
 *
 * @author zhipeng
 *
 */
class dbs_warehousebuildingitem extends dbs_warehousebase
{


    /**
     * 设置 容量 默认值
     */
    protected function _set_defaultvalue_size()
    {
        $this->set_defaultkeyandvalue(self::DBKey_size, 25);
    }

    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "warehousebuildingitem";


    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 获取建材商店设置
     *
     * @param unknown $level
     * @return Ambigous <multitype:, string>
     */
    private function __getconfig($level)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_buildingwarehouse_setting::class, configdata_buildingwarehouse_setting::k_id, $level);
    }

    /**
     * 升级
     *
     * @return array
     */
    function upgrade()
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code

        $config = $this->__getconfig($this->get_level());
        if ($config [configdata_buildingwarehouse_setting::k_upgradeenable] != '1') {
            $retCode = err_dbs_warehousebuildingitem_upgrade::CANNOT_UPGRADE;
            goto failed;
        }

        $nextlevelid = $config [configdata_buildingwarehouse_setting::k_upgradeid];
        // 下级的配置
        $nextconfig = $this->__getconfig($nextlevelid);

        $needitem = array();
        $needitem [$nextconfig [configdata_buildingwarehouse_setting::k_upgradeitemid1]] = intval($nextconfig [configdata_buildingwarehouse_setting::k_upgradeitemcount1]);
        $needitem [$nextconfig [configdata_buildingwarehouse_setting::k_upgradeitemid2]] = intval($nextconfig [configdata_buildingwarehouse_setting::k_upgradeitemcount2]);
        $needitem [$nextconfig [configdata_buildingwarehouse_setting::k_upgradeitemid3]] = intval($nextconfig [configdata_buildingwarehouse_setting::k_upgradeitemcount3]);

        // 道具数量不足
        foreach ($needitem as $itemid => $itemcount) {
            if (!$this->hasItem($itemid, $itemcount)) {
                $retCode = err_dbs_warehousebuildingitem_upgrade::ITEM_NOT_ENOUGH;
                goto failed;
            }
        }

        foreach ($needitem as $itemid => $itemcount) {
            if (!$this->removeItemByItemId($itemid, $itemcount)) {
                $retCode = err_dbs_warehousebuildingitem_upgrade::ITEM_NOT_ENOUGH;
                goto failed;
            }
        }
        $this->set_level($nextconfig [configdata_buildingwarehouse_setting::k_level]);
        $this->set_size($nextconfig [configdata_buildingwarehouse_setting::k_capacity]);

        $data = array(
            constants_returnkey::RK_LEVEL => $this->get_level(),
            constants_returnkey::RK_SIZE => $this->get_size()
        );

        $this->db_owner->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_24, 2, $this->get_level());
//        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_60, 1);


        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }
}
