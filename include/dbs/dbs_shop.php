<?php

namespace dbs;

use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_item_setting;
use configdata\configdata_mall_item_setting;
use constants\constants_mission;
use constants\constants_moneychangereason;
use dbs\shop\dbs_shop_player;
use err\err_dbs_shop_buygoods;

/**
 * db商店类
 *
 * @author zhipeng
 *
 */
class dbs_shop
{
    /**
     * 所有商品道具限制信息
     * @var array
     */
    private $shopItems = [];

    /**
     * @return array
     */
    public function getShopItems()
    {
        return $this->shopItems;
    }

    /**
     * 获取单个商品信息
     * @param string $mallId 商城ID
     * @return null|dbs_shopitem
     */
    public function getShopItemData($mallId)
    {
        if (isset($this->shopItems[$mallId])) {
            return $this->shopItems[$mallId];
        }
        return null;
    }

    /**
     * 设置商品限制信息
     * @param dbs_shopitem $shopItemData
     */
    public function setShopItemData(dbs_shopitem $shopItemData)
    {
        $this->shopItems[$shopItemData->get_mallid()] = $shopItemData;
    }


    public function loadFromDB()
    {

        $allItems = dbs_shopitem::all();
        foreach ($allItems as $value) {
            if ($value instanceof dbs_shopitem) {
                $value->nextday();
                $this->shopItems [$value->get_mallid()] = $value;
            }
        }
    }

    /**
     *
     * 商品是否有效
     *
     * @param string $mallId
     *            商品id
     * @param integer $num
     *            商品数量
     * @return false|array
     */
    private function goods_is_valid($mallId, $num = 1)
    {
        $mallId = strval($mallId);
        $mallConfig = getConfigData(configdata_mall_item_setting::class,
            configdata_mall_item_setting::k_mallid,
            $mallId);

        if (is_null($mallConfig)) {
            return false;
        }
        if (intval($mallConfig [configdata_mall_item_setting::k_online]) != 1) {
            return false;
        }
        //开始时间
        $startTime = $mallConfig [configdata_mall_item_setting::k_onlinestime] === '0' ?
            -1 : strtotime($mallConfig [configdata_mall_item_setting::k_onlinestime]);
        //结束时间
        $endTime = $mallConfig [configdata_mall_item_setting::k_onlineetime] === '0' ?
            -1 : strtotime($mallConfig [configdata_mall_item_setting::k_onlineetime]);

        //开始时间不满足
        if ($startTime !== -1 && time() < $startTime) {
            return false;
        }
        //超过结束时间
        if ($endTime !== -1 && time() > $endTime) {
            return false;
        }

        // 有每日全服限制
        if ($mallConfig [configdata_mall_item_setting::k_limitserdailycount] !== '0') {
            $shopItemData = $this->getShopItemData($mallId);
            if (!is_null($shopItemData)) {
                if ($shopItemData->get_serverDailySellCount() + $num >
                    intval($mallConfig[configdata_mall_item_setting::k_limitserdailycount])
                ) {
                    return false;
                }
            }
        }
        // 有全服全部数量限制
        if ($mallConfig [configdata_mall_item_setting::k_limitsercount] !== '0') {
            $shopItemData = $this->getShopItemData($mallId);
            if (!is_null($shopItemData)) {
                if ($shopItemData->get_serverTotalSellCount() + $num >
                    intval($mallConfig[configdata_mall_item_setting::k_limitsercount])
                ) {
                    return false;
                }
            }
        }

        return $mallConfig;
    }

    /**
     * 增加每日限购
     *
     * @param string $mallId
     * @param integer $num
     */
    private function addLimitSerDailyCount($mallId, $num)
    {

        $shopItemData = $this->getShopItemData($mallId);
        if (is_null($shopItemData)) {
            $shopItemData = dbs_shopitem::create($mallId);
        }
        $shopItemData->addServerDailySellCount($num);
        $this->setShopItemData($shopItemData);
    }

    /**
     * 增加总限购
     *
     * @param string $mallId
     * @param integer $num
     */
    private function addLimitSerTotalCount($mallId, $num)
    {
        $shopItemData = $this->getShopItemData($mallId);
        if (is_null($shopItemData)) {
            $shopItemData = dbs_shopitem::create($mallId);
        }
        $shopItemData->addServerTotalSellCount($num);
        $this->setShopItemData($shopItemData);
    }

    /**
     * 获取商品列表
     */
    public function getGoods()
    {
        $data = configdata_mall_item_setting::data();
        $goods = [];
        foreach ($data as $value) {
            $mallId = $value [configdata_mall_item_setting::k_mallid];
            if ($this->goods_is_valid($mallId) !== false) {
                $goods[$mallId] = $value;
            }
        }
        return $goods;
    }


    /**
     * 购买物品
     * @param dbs_player $player
     * @param $mallId
     * @param int $num
     * @return Common_Util_ReturnVar
     */
    public function buygoods(dbs_player $player, $mallId, $num = 1)
    {
        $num = intval($num);
        $mallId = strval($mallId);
        $retCode = 0;
        $data = array();

        $mallConfig = $this->goods_is_valid($mallId, $num);
        logicErrorCondition($mallConfig !== false,
            err_dbs_shop_buygoods::GOODS_INFO_ERROR,
            "GOODS_INFO_ERROR");

        // 有每人每日限购的数量
        if ($mallConfig [configdata_mall_item_setting::k_limitdailycount] !== '0') {
            $dailyCount = dbs_shop_player::createWithPlayer($player)->getMallBuyDailyCount($mallId);
            $maxDailyCount = intval($mallConfig[configdata_mall_item_setting::k_limitdailycount]);
            logicErrorCondition($dailyCount < $maxDailyCount,
                err_dbs_shop_buygoods::LIMIT_PERSON_DAILY_BUYMAX,
                "LIMIT_PERSON_DAILY_BUYMAX");
        }
        //每人全部购买限制
        if ($mallConfig [configdata_mall_item_setting::k_limittotalcount] !== '0') {
            $totalCount = dbs_shop_player::createWithPlayer($player)->getMallBuyCount($mallId);
            $maxTotalCount = intval($mallConfig[configdata_mall_item_setting::k_limittotalcount]);
            logicErrorCondition($totalCount < $maxTotalCount,
                err_dbs_shop_buygoods::LIMIT_PERSON_BUYMAX,
                "LIMIT_PERSON_BUYMAX");
        }

        // 有vip限制
        if ($mallConfig [configdata_mall_item_setting::k_limitviplevel] != '0') {
            logicErrorCondition(dbs_vip::createWithPlayer($player)->get_viplevel() >=
                intval($mallConfig [configdata_mall_item_setting::k_limitviplevel]),
                err_dbs_shop_buygoods::LIMIT_VIPLEVEL,
                "LIMIT_VIPLEVEL");
        }

        // 有等级限制
        if ($mallConfig [configdata_mall_item_setting::k_limitlevel] != '0') {
            logicErrorCondition(dbs_restaurantinfo::createWithPlayer($player)->get_restaurantlevel() >=
                intval($mallConfig [configdata_mall_item_setting::k_limitlevel]),
                err_dbs_shop_buygoods::LIMIT_LEVEL,
                "LIMIT_LEVEL");
        }

        $mallItemId = $mallConfig[configdata_mall_item_setting::k_itemid];
        $mallItemCount = intval($mallConfig[configdata_mall_item_setting::k_num]) * $num;

        $warehouse = dbs_warehouse::getwarehousebyitemid($player, $mallItemId);
        logicErrorCondition(!is_null($warehouse) && $warehouse->testItemCanPut($mallItemId, $mallItemCount),
            err_dbs_shop_buygoods::WAREHOUSE_IS_FULL,
            "WAREHOUSE_IS_FULL");

        $price = intval($mallConfig [configdata_mall_item_setting::k_price]) * $num;
        //计算折扣
        if ($mallConfig [configdata_mall_item_setting::k_discount] != '-1') {
            $startTime = $mallConfig [configdata_mall_item_setting::k_discountstime] == '0' ?
                0 : strtotime($mallConfig [configdata_mall_item_setting::k_discountstime]);

            $endTime = $mallConfig [configdata_mall_item_setting::k_discountetime] == '0' ?
                time() + 100 : strtotime($mallConfig [configdata_mall_item_setting::k_discountetime]);

            if (time() >= $startTime && time() <= $endTime) {
                // 在折扣时间,执行折扣价格
                $price = intval($mallConfig [configdata_mall_item_setting::k_discount]) * $num;
            }
        }

        // 判断货币
        if ($mallConfig [configdata_mall_item_setting::k_pricetype] == '1') {

            // 金币购买
            logicErrorCondition($price <= dbs_role::createWithPlayer($player)->get_gamecoin(),
                err_dbs_shop_buygoods::GAME_COIN_NOT_ENOUGH,
                "GAME_COIN_NOT_ENOUGH");
            dbs_role::createWithPlayer($player)->cost_gamecoin($price, constants_moneychangereason::SHOP_BUY
                , 'shop buy:' . $mallId);


        } elseif ($mallConfig [configdata_mall_item_setting::k_pricetype] == '2') {
            logicErrorCondition($price <= dbs_role::createWithPlayer($player)->get_diamond(),
                err_dbs_shop_buygoods::DIAMOND_NOT_ENOUGH,
                "DIAMOND_NOT_ENOUGH");
            dbs_role::createWithPlayer($player)->cost_diamond($price, constants_moneychangereason::SHOP_BUY
                , 'shop buy:' . $mallId);

        } else {
            // 声望购买暂时空缺
        }

        // 如果有每人每日限购 或总数显示
        if ($mallConfig [configdata_mall_item_setting::k_limitdailycount] != '0'
            || $mallConfig[configdata_mall_item_setting::k_limittotalcount] != '0'
        ) {
            dbs_shop_player::createWithPlayer($player)->addMallBuyCount($mallId, $num);
        }

        // 有每日全服限制
        if ($mallConfig [configdata_mall_item_setting::k_limitserdailycount] != '0') {
            $this->addLimitSerDailyCount($mallId, $num);
        }
        // 有全服全部数量限制
        if ($mallConfig [configdata_mall_item_setting::k_limitsercount] != '0') {
            $this->addLimitSerTotalCount($mallId, $num);
        }

        //添加到仓库
        dbs_warehouse::additemtowarehouse($player, $mallItemId, $mallItemCount);

        // exp 增加经验
        $exp = $num * intval($mallConfig [configdata_mall_item_setting::k_restaurantexp]);
        $player->db_restaurantinfo()->addrestaurantexp($exp);

        // 完成任务接口
        $itemConfig = dbs_item::getInstance()->getItemConfig($mallItemId);

        $player->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_15,
            $itemConfig [configdata_item_setting::k_subtype],
            $mallItemCount);
        $player->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_14,
            $mallItemId, $mallItemCount);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
    }
}