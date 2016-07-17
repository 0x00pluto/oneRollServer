<?php

namespace dbs;

use constants\constants_item;
use configdata\configdata_item_setting;
use dbs\item\dbs_item_equipment;
use Common\Util\Common_Util_Configdata;
use dbs\item\dbs_item_fashionDress;
use err\err_dbs_item_useitemWithOptions;
use dbs\item\uselogic\dbs_item_uselogic_factory;
use Common\Util\Common_Util_ReturnVar;
use dbs\item\uselogic\dbs_item_uselogic_logic2;
use dbs\item\dbs_item_normal;
use configdata\configdata_item_building_setting;
use constants\constants_itemid;
use constants\constants_mission;

/**
 * 道具服务
 * Class dbs_item
 * @package dbs
 */
class dbs_item
{
    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
        // echo 'This is a Constructed method;';
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }

    /**
     * 产生新道具
     *
     * @param string $itemTemplateId
     *            道具模板id
     * @param int $num
     *            道具数量
     * @return NULL|dbs_item_normal
     */
    public function newItem($itemTemplateId, $num = 1)
    {
        $itemTemplateId = strval($itemTemplateId);
        $num = intval($num);
        $itemConfig = $this->getItemConfig($itemTemplateId);
        if (is_null($itemConfig)) {
            return null;
        }
        $item = new dbs_item_normal ();
        $item->set_itemid($itemTemplateId);
        $item->set_num($num);

        $mainType = $itemConfig [configdata_item_setting::k_maintype];
        if ($mainType == constants_item::ITEM_TYPE_EQUIPMENT) {
            $equipment = new dbs_item_equipment ($item);
            $equipment->compute();
        } elseif ($mainType === constants_item::ITEM_TYPE_FASHION_DRESS) {
            $itemExtends = dbs_item_fashionDress::create($item);
            $itemExtends->save();
        }

        // dump ( $item );
        return $item;
    }

    /**
     * 获取道具配置
     * @param $itemTemplateId
     * @return null
     */
    public function getItemConfig($itemTemplateId)
    {
        $itemTemplateId = strval($itemTemplateId);
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_setting::class, configdata_item_setting::k_id, $itemTemplateId);
    }

    /**
     * 获取场景建筑配置
     *
     * @param string $itemid
     * @return NULL
     */
    public function getitembuildingconfig($itemid)
    {
        $itemConfig = $this->getItemConfig($itemid);
        if (is_null($itemConfig)) {
            return NULL;
        }

        if (!isset($itemConfig[configdata_item_setting::k_buildingconfigid])) {
            return NULL;
        }
        $itembuildingid = $itemConfig [configdata_item_setting::k_buildingconfigid];

        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_building_setting::class, configdata_item_building_setting::k_id, $itembuildingid);
    }

    /**
     * 使用道具
     *
     * @param dbs_player $player
     * @param $itemid
     * @param number $num
     * @param array $Options
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function useitemWithOptions(dbs_player $player, $itemid, $num = 1, array $Options = [])
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $itemid = strval($itemid);
        $num = intval($num);
        // class err_dbs_item_useitem{}
        if ($num <= 0) {
            $retCode = err_dbs_item_useitemWithOptions::ITEM_NUM_ERROR;
            $retCode_Str = 'ITEM_NUM_ERROR';
            goto failed;
        }

        $itemconfig = self::getItemConfig($itemid);
        if (is_null($itemconfig)) {
            $retCode = err_dbs_item_useitemWithOptions::ITEM_ID_ERROR;
            $retCode_Str = 'ITEM_ID_ERROR';
            goto failed;
        }
        if (!dbs_item_uselogic_factory::getInstance()->canUse($itemid)) {
            $retCode = err_dbs_item_useitemWithOptions::ITEM_CANNOT_USE;
            $retCode_Str = 'ITEM_CANNOT_USE';
            goto failed;
        }

        $warehouse = dbs_warehouse::getwarehousebyitemid($player, $itemid);
        if (is_null($warehouse)) {
            $retCode = err_dbs_item_useitemWithOptions::ITEM_ID_ERROR;
            $retCode_Str = 'ITEM_ID_ERROR';
            goto failed;
        }

        if (!$warehouse->hasItem($itemid, $num)) {
            $retCode = err_dbs_item_useitemWithOptions::ITEM_NOT_ENOUGH;
            $retCode_Str = 'ITEM_NOT_ENOUGH';
            goto failed;
        }

        $ret = false;
        for ($i = 0; $i < $num; $i++) {
            $ret = dbs_item_uselogic_factory::getInstance()->useItem($itemid, $player, $Options);
            if (!$ret) {
                break;
            }
        }
        if ($ret) {
            // 删除道具
            $warehouse->removeItemByItemId($itemid, $num);
        } else {
            $retCode = err_dbs_item_useitemWithOptions::USE_LOGIC_ERROR;
            $retCode_Str = 'USE_LOGIC_ERROR';
            goto failed;
        }

        $player->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_66, $itemid, $num);
        $player->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_67, $num);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 使用道具
     *
     * @param dbs_player $player
     * @param string $itemid
     * @param int $num
     * @return Common_Util_ReturnVar
     */
    function useitem(dbs_player $player, $itemid, $num)
    {
        return $this->useitemWithOptions($player, $itemid, $num);
    }

    /**
     * 直接使用.使用礼包,不管有没有东西
     * @param dbs_player $player
     * @param string $packageId
     * @return Common_Util_ReturnVar
     */
    function usepackage(dbs_player $player, $packageId)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $logic = new dbs_item_uselogic_logic2 ();
        $ret = $logic->useitem($player, array(
            $packageId
        ), []);
        if (!$ret) {
            goto failed;
        }

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 是否是游戏币道具
     *
     * @param unknown $itemid
     * @return bool
     */
    static function is_gamecoin($itemid)
    {
        return strval($itemid) === constants_itemid::ITEMID_GAMECOIN;
    }

    /**
     * 是否是钻石道具
     *
     * @param unknown $itemid
     * @return bool
     */
    static function is_diamond($itemid)
    {
        return strval($itemid) === constants_itemid::ITEMID_DIAMOND;
    }
}