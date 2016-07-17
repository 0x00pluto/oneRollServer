<?php

namespace dbs\shopmaterial;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_foodmall_item_setting;
use configdata\configdata_foodmall_upgrade_setting;
use configdata\configdata_item_food_setting;
use constants\constants_mall;
use constants\constants_mission;
use constants\constants_returnkey;
use dbs\dbs_restaurantinfo;
use dbs\dbs_warehouse;
use dbs\templates\shopmaterial\dbs_templates_shopmaterial_base;
use err\err_dbs_shopbutcherplayer_buyitem;
use err\err_dbs_shopbutcherplayer_upgrade;

/**
 * 肉店用户信息
 *
 * @author zhipeng
 *
 */
abstract class dbs_shopmaterial_base extends dbs_templates_shopmaterial_base
{

    /**
     * 商店类型
     *
     * @var string
     */
    protected $mallType = constants_mall::TYPE_BUTCHER;


    /**
     *
     * @param string $shopdbname 商店表名
     * @param string $defaultshopid 默认的商店id
     */
    function __construct($shopdbname, $defaultshopid)
    {
        parent::__construct($shopdbname);
        $this->set_shopid($defaultshopid);
    }

    /**
     * 商品列表
     *
     * @var array
     */
    private static $__goodslist = array();

    /**
     * 获取升级属性
     * @param $shopid
     * @return null
     */
    private function __getupgradeconfig($shopid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_foodmall_upgrade_setting::class, configdata_foodmall_upgrade_setting::k_shopid, $shopid);
    }


    /**
     * 购买道具
     * @param string $mallid
     * @param int $num
     * @return Common_Util_ReturnVar
     */
    function buyitem($mallid, $num = 1)
    {
        $mallid = strval($mallid);
        $num = intval($num);

        $retCode = 0;
        $data = array();
        $retCodeArr = array();


        $goodslist = $this->__get_buildgoodslist();
        if (!array_key_exists($mallid, $goodslist)) {
            $retCode = err_dbs_shopbutcherplayer_buyitem::MALL_ID_NOT_EXIST;
            goto failed;
        }

        $goodinfo = $goodslist [$mallid];
        // 购买数量错误
        if ($num < 1 || $num > intval($goodinfo [configdata_foodmall_item_setting::k_maxnum])) {
            $retCode = err_dbs_shopbutcherplayer_buyitem::NUM_ERROR;
            goto failed;
        }

        $totalmoney = intval($goodinfo [configdata_foodmall_item_setting::k_price]) * $num;

        $moneytype = $goodinfo [configdata_foodmall_item_setting::k_pricetype];

        if ($moneytype == '1') {
            // 游戏币
            if ($totalmoney > $this->db_owner->db_role()->get_gamecoin()) {
                $retCode = err_dbs_shopbutcherplayer_buyitem::NOT_ENOUGH_GAMECOIN;
                goto failed;
            }
        } elseif ($moneytype == '2') {
            // 钻石
            if ($totalmoney > $this->db_owner->db_role()->get_diamond()) {
                $retCode = err_dbs_shopbutcherplayer_buyitem::NOT_ENOUGH_DIAMOND;
                goto failed;
            }
        }
        $goodsitemid = $goodinfo [configdata_foodmall_item_setting::k_itemid];


        $foodItemConfig = getConfigData(configdata_item_food_setting::class,
            configdata_item_food_setting::k_id,
            $goodsitemid);


        logicErrorCondition(!is_null($foodItemConfig),
            err_dbs_shopbutcherplayer_buyitem::ITEM_FOOD_SETTING_ERROR,
            "ITEM_FOOD_SETTING_ERROR");

        $needLevel = intval($foodItemConfig[configdata_item_food_setting::k_openlevel]);

        $restaruantLevel = dbs_restaurantinfo::createWithPlayer($this)->get_restaurantlevel();
        logicErrorCondition($restaruantLevel >= $needLevel,
            err_dbs_shopbutcherplayer_buyitem::RESTARUANT_LEVEL_NOT_ENOUGH,
            "RESTARUANT_LEVEL_NOT_ENOUGH");


        // 冰箱满了
        logicErrorCondition($this->db_owner->db_warehouseicebox()->testItemCanPut($goodsitemid, $num),
            err_dbs_shopbutcherplayer_buyitem::WAREHOUSE_FULL,
            "WAREHOUSE_FULL");

        //扣钱.
        if ($moneytype == '1') {
            // 游戏币
            $this->db_owner->db_role()->cost_gamecoin($totalmoney, 1);
        } elseif ($moneytype == '2') {
            // 钻石
            $this->db_owner->db_role()->cost_diamond($totalmoney, 1);
        }

        // 增加冷却
//        $shopconfig = $this->__getupgradeconfig($this->getdata(self::DBKey_shopid));

        // 放入仓库
        dbs_warehouse::additemtowarehouse($this->db_owner,
            $goodsitemid, $num);

        $data[constants_returnkey::RK_ITEMID] = $goodsitemid;
        $data[constants_returnkey::RK_ITEMCOUNT] = $num;

        // 完成任务接口
        $this->db_owner->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_10, $goodsitemid, $num);
        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_9, $num);
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }


    /**
     * 获取商品列表
     *
     * @return Ambigous <multitype:, unknown>
     */
    public function getgoods()
    {
        return $this->__get_buildgoodslist();
    }

    /**
     * 获取肉店信息
     *
     * @return multitype:
     */
    public function getshopinfo()
    {
        return $this->toArray();
    }

    /**
     * 获取物品列表
     *
     * @return array
     */
    private function __get_buildgoodslist()
    {
        if (!array_key_exists($this->mallType, self::$__goodslist)) {
            $arr = array();
            foreach (configdata_foodmall_item_setting::data() as $value) {
                if ($value [configdata_foodmall_item_setting::k_malltype] == $this->mallType && $value [configdata_foodmall_item_setting::k_online] == '1' && intval($value [configdata_foodmall_item_setting::k_malllv]) <= $this->getdata(self::DBKey_level)) {
                    $arr [$value [configdata_foodmall_item_setting::k_mallid]] = $value;
                }
            }
            self::$__goodslist [$this->mallType] = $arr;
        }
        return self::$__goodslist [$this->mallType];
    }


    /**
     * 升级
     * @return Common_Util_ReturnVar
     */
    function upgrade()
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code
        $shopid = $this->get_shopid();
        // dump ( $shopid );
        $upgradeConfig = $this->__getupgradeconfig($shopid);
        // dump ( $upgradeConfig );
        if (is_null($upgradeConfig)) {
            $retCode = err_dbs_shopbutcherplayer_upgrade::UPGRADE_CONFIG_ERROR;
            goto failed;
        }

        if ($upgradeConfig [configdata_foodmall_upgrade_setting::k_upgradeenable] != '1') {
            $retCode = err_dbs_shopbutcherplayer_upgrade::CANNOT_UPGRADE;
            goto failed;
        }

        // 升级到的id
        $nextShopId = $upgradeConfig [configdata_foodmall_upgrade_setting::k_upgradeshopid];
        // 升级到的属性
        $upgradeConfig = $this->__getupgradeconfig($nextShopId);

//        dump($nextShopId);
        $needItem = array();
        $needItem [$upgradeConfig [configdata_foodmall_upgrade_setting::k_upgradeitemid1]] = intval($upgradeConfig [configdata_foodmall_upgrade_setting::k_upgradeitemcount1]);
        $needItem [$upgradeConfig [configdata_foodmall_upgrade_setting::k_upgradeitemid2]] = intval($upgradeConfig [configdata_foodmall_upgrade_setting::k_upgradeitemcount2]);
        $needItem [$upgradeConfig [configdata_foodmall_upgrade_setting::k_upgradeitemid3]] = intval($upgradeConfig [configdata_foodmall_upgrade_setting::k_upgradeitemcount3]);

//        dump($needItem);
        // dump ( $needitem );
        // 道具数量不足
        foreach ($needItem as $itemid => $itemcount) {

            if (!$this->db_owner->db_warehousebuildingitem()->hasItem($itemid, $itemcount)) {
                $retCode = err_dbs_shopbutcherplayer_upgrade::ITEM_NOT_ENOUGH;

                goto failed;
            }
        }

        foreach ($needItem as $itemid => $itemcount) {
            if (!$this->db_owner->db_warehousebuildingitem()->removeItemByItemId($itemid, $itemcount)) {
                $retCode = err_dbs_shopbutcherplayer_upgrade::ITEM_NOT_ENOUGH;
                goto failed;
            }
        }

        $this->set_level($upgradeConfig [configdata_foodmall_upgrade_setting::k_shoplv]);
        $this->set_shopid($nextShopId);
        $data = array(
            constants_returnkey::RK_LEVEL => $this->get_level(),
            self::DBKey_shopid => $nextShopId
        );

        $this->db_owner->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_25,
            $this->mallType, $this->get_level());
//        $this->db_owner->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_65, $this->mallType, $this->get_level());

        succ:

        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }


}