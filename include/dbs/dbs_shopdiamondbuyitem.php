<?php

namespace dbs;

use constants\constants_defaultvalue;
use Common\Util\Common_Util_Configdata;
use configdata\configdata_mall_item_diamondbuy_setting;
use configdata\configdata_mall_diamond_buy_gamecoin_setting;
use constants\constants_mission;
use err\err_dbs_shopdiamondbuyitem_buyitem;
use constants\constants_moneychangereason;
use Common\Util\Common_Util_ReturnVar;
use err\err_dbs_shopdiamondbuyitem_buygamecoin;
use constants\constants_returnkey;
use utils\utils_log;

/**
 * 钻石购买道具
 *
 * @author zhipeng
 *
 */
class dbs_shopdiamondbuyitem extends dbs_baseplayer
{
    function __construct()
    {
        parent::__construct('shopdiamondbuyitem', array(
            self::DBKey_userid => constants_defaultvalue::USERID_EMPTY
        ));
    }

    /**
     * 获取钻石快速购买配置
     *
     * @param unknown $itemid
     * @return Ambigous <multitype:, string>
     */
    static function get_config($itemid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_mall_item_diamondbuy_setting::class, configdata_mall_item_diamondbuy_setting::k_itemid, $itemid);
    }

    /**
     * 获取购买钻石配置
     *
     * @param unknown $mallid
     * @return Ambigous <multitype:, string>
     */
    static function get_buygamecoinconfig($mallid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_mall_diamond_buy_gamecoin_setting::class, configdata_mall_diamond_buy_gamecoin_setting::k_mallid, $mallid);
    }

    /**
     * 购买物品
     *
     * @param string $itemid 道具id
     * @param int $count 道具数量
     * @param bool $force
     *            是否可以超仓库上限 0不可以 1可以
     * @return Common_Util_ReturnVar
     */
    function buyitem($itemid, $count, $force = FALSE)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_shopdiamondbuyitem_buyitem{}
        $itemid = strval($itemid);
        $count = intval($count);
        $force = boolval($force);
        if ($count < 1) {
            $retCode = err_dbs_shopdiamondbuyitem_buyitem::BUY_NUM_ERROR;
            $retCode_Str = 'BUY_NUM_ERROR';
            goto failed;
        }

        $mallconfig = self::get_config($itemid);
        if (is_null($mallconfig)) {
            $retCode = err_dbs_shopdiamondbuyitem_buyitem::ITEM_PROPERTY_ERROR;
            $retCode_Str = 'ITEM_PROPERTY_ERROR';
            goto failed;
        }

        if ($mallconfig [configdata_mall_item_diamondbuy_setting::k_isopen] != '1') {
            $retCode = err_dbs_shopdiamondbuyitem_buyitem::ITEM_CANNOT_DIAMOND_BUY;
            $retCode_Str = 'ITEM_CANNOT_DIAMOND_BUY';
            goto failed;
        }

        // 需要的钻石总数
        $diamonds = $count * intval($mallconfig [configdata_mall_item_diamondbuy_setting::k_diamond]);

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);

        if (!$force && !$warehouse->testItemCanPut($itemid, $count)) {
            $retCode = err_dbs_shopdiamondbuyitem_buyitem::WAREHOUSE_FULL;
            $retCode_Str = 'WAREHOUSE_FULL';
            goto failed;
        }

        if ($diamonds > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_shopdiamondbuyitem_buyitem::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        $this->db_owner->db_role()->cost_diamond($diamonds, constants_moneychangereason::DIAMOND_SHOP_BUY_ITEM);
        $warehouse->addItemByItemId($itemid, $count, $force);
        // code
        // $warehouse->dumpDB();
        $data [constants_returnkey::RK_DIAMOND] = $diamonds;

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_DIAMONDBUYITEM, $this->get_userid(), [
            'diamonds' => $diamonds,
            '$itemid' => $itemid,
            '$itemcount' => $count
        ]);

        if ($itemid === getGlobalValue("GRAFT_ADD_GRAFT_WEIGHT_ITEMID")->string_value()) {
            dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_32, $count);
        }


        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 购买游戏币
     *
     * @param string $mallid 商场id
     * @return Common_Util_ReturnVar
     */
    function buygamecoin($mallid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_shopdiamondbuyitem_buygamecoin{}

        $config = self::get_buygamecoinconfig($mallid);

        if (is_null($config)) {
            $retCode = err_dbs_shopdiamondbuyitem_buygamecoin::MALLID_NOT_EXISTS;
            $retCode_Str = 'MALLID_NOT_EXISTS';
            goto failed;
        }
        if ($config [configdata_mall_diamond_buy_gamecoin_setting::k_isopen] != '1') {
            $retCode = err_dbs_shopdiamondbuyitem_buygamecoin::ITEM_CANNOT_DIAMOND_BUY;
            $retCode_Str = 'ITEM_CANNOT_DIAMOND_BUY';
            goto failed;
        }
        // code
        $diamond = intval($config [configdata_mall_diamond_buy_gamecoin_setting::k_diamond]);
        $gamecoin = intval($config [configdata_mall_diamond_buy_gamecoin_setting::k_gamecoin]);

        if ($diamond > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_shopdiamondbuyitem_buygamecoin::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        $this->db_owner->db_role()->cost_diamond($diamond, constants_moneychangereason::CONVERT_GAMECOIN_DIAMOND);
        $this->db_owner->db_role()->add_gamecoin($gamecoin, constants_moneychangereason::CONVERT_GAMECOIN_DIAMOND);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}