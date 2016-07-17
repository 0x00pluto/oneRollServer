<?php

namespace dbs;

use Common\Util\Common_Util_Array;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_item_collectionexchange_setting;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\templates\item\dbs_templates_item_itemcollectionexchange;
use err\err_dbs_itemcollectionexchange_exchange;

/**
 * 收藏品兑换
 *
 * @author zhipeng
 *
 */
class dbs_itemcollectionexchange extends dbs_templates_item_itemcollectionexchange
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 增加兑换记录
     *
     * @param unknown $itemid
     * @param unknown $itemcount
     */
    private function addhistory($exchangeid, $exchangecount)
    {
        $exchangecount = intval($exchangecount);
        $exchangeid = strval($exchangeid);

        $count = 0;
        $list = $this->get_exchangehistory();
        if (isset ($list [$exchangeid])) {
            $count = $list [$exchangeid];
        }
        $count += $exchangecount;
        $list [$exchangeid] = $count;

        $this->set_exchangehistory($list);
    }


    /**
     * 获取兑换配置
     * @param $id
     * @return array|null
     */
    static function get_config($id)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_collectionexchange_setting::class, configdata_item_collectionexchange_setting::k_id, $id);
    }

    /**
     * 兑换.
     *
     * @param string $id
     *            配方id
     * @return Common_Util_ReturnVar
     */
    function exchange($id)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_itemcollectionexchange_exchange{}

        $id = strval($id);
        $config = self::get_config($id);
        if (is_null($config)) {
            $retCode = err_dbs_itemcollectionexchange_exchange::ID_PROPERTY_ERROR;
            $retCode_Str = 'ID_PROPERTY_ERROR';
            goto failed;
        }

        $needitems = array();
        $needitems [] = $config [configdata_item_collectionexchange_setting::k_itemid1];
        $needitems [] = $config [configdata_item_collectionexchange_setting::k_itemid2];
        $needitems [] = $config [configdata_item_collectionexchange_setting::k_itemid3];
        $needitems [] = $config [configdata_item_collectionexchange_setting::k_itemid4];
        $needitems [] = $config [configdata_item_collectionexchange_setting::k_itemid5];

        foreach ($needitems as $itemid) {
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);
            if (is_null($warehouse)) {
                $retCode = err_dbs_itemcollectionexchange_exchange::ITEM_NOT_ENOUGH;
                $retCode_Str = 'ITEM_NOT_ENOUGH';
                goto failed;
            }
            if (!$warehouse->hasItem($itemid)) {
                $retCode = err_dbs_itemcollectionexchange_exchange::ITEM_NOT_ENOUGH;
                $retCode_Str = 'ITEM_NOT_ENOUGH';
                goto failed;
            }
        }
        $awarditemid = null;
        $awarditemcount = 0;
        if (array_key_exists_faster(configdata_item_collectionexchange_setting::k_awarditemid, $config)) {
            $awarditemid = $config [configdata_item_collectionexchange_setting::k_awarditemid];
            $awarditemcount = intval($config [configdata_item_collectionexchange_setting::k_awarditemcount]);
        }

        if (!is_null($awarditemid)) {
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $awarditemid);
            if (is_null($warehouse) || !$warehouse->testItemCanPut($awarditemid)) {

                $retCode = err_dbs_itemcollectionexchange_exchange::WAREHOUSE_FULL;
                $retCode_Str = 'WAREHOUSE_FULL';
                goto failed;
            }
        }

        // 扣除道具
        foreach ($needitems as $itemid) {
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);
            if (!is_null($warehouse)) {
                $warehouse->removeItemByItemId($itemid, 1);
            }
        }

        $diamonds = Common_Util_Array::getvalue($config, configdata_item_collectionexchange_setting::k_awarddiamonds);
        // 发钻石
        if (!$diamonds->is_null()) {
            $data [constants_returnkey::RK_DIAMOND] = $diamonds->int_value();
            $this->db_owner->db_role()->add_diamond($diamonds->int_value(), constants_moneychangereason::ITEM_COLLECTION_EXCHANGE);
        }

        // 发游戏币
        $gamecoin = Common_Util_Array::getvalue($config, configdata_item_collectionexchange_setting::k_awardgamecoin);
        if (!$gamecoin->is_null()) {
            $data [constants_returnkey::RK_GAMECOIN] = $gamecoin->int_value();
            $this->db_owner->db_role()->add_gamecoin($gamecoin->int_value(), constants_moneychangereason::ITEM_COLLECTION_EXCHANGE);
        }

        // 发餐厅经验
        $restaruantexp = Common_Util_Array::getvalue($config, configdata_item_collectionexchange_setting::k_awardrestaruantexp);
        if (!$restaruantexp->is_null()) {
            $data [constants_returnkey::RK_EXP] = $restaruantexp->int_value();
            $this->db_owner->db_restaurantinfo()->addrestaurantexp($restaruantexp->int_value());
        }

        // 发道具
        if (!is_null($awarditemid)) {
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $awarditemid);
            if (!is_null($warehouse)) {
                $data [constants_returnkey::RK_ITEMID] = $awarditemid;
                $data [constants_returnkey::RK_ITEMCOUNT] = 1;
                $warehouse->addItemByItemId($awarditemid);
            }
        }

        $this->addhistory($id, 1);

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_29, count($this->get_exchangehistory()));

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_28, 1);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}