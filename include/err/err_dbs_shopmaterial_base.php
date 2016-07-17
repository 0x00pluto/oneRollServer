<?php
namespace err;
/**
 * 肉店购买错误码
 * @author zhipeng
 *
 */
class err_dbs_shopmaterial_base_buyitem
{

    /**
     * 没有足够的游戏币
     *
     */
    const NOT_ENOUGH_GAMECOIN = 2;
    /**
     * 没有足够的钻石
     *
     */
    const NOT_ENOUGH_DIAMOND = 3;
    /**
     * 冰箱已经满了
     *
     */
    const WAREHOUSE_FULL = 4;
    /**
     * 商品id不存在
     *
     */
    const MALL_ID_NOT_EXIST = 5;
    /**
     * 购买数量错误
     *
     */
    const NUM_ERROR = 6;

    /**
     * 餐厅等级不足,不能购买
     */
    const RESTARUANT_LEVEL_NOT_ENOUGH = 7;

    /**
     * 道具食材配置错误
     */
    const ITEM_FOOD_SETTING_ERROR = 8;
}

/**
 * 肉店收获错误码
 *
 * @author zhipeng
 *
 */
class err_dbs_shopmaterial_base_harvestgoods
{
    /**
     * 冷却中
     *
     * @var unknown
     */
    const COOLDOWN = 1;
    /**
     * 冰箱满了
     *
     * @var unknown
     */
    const WAREHOUSE_FULL = 2;
    /**
     * 物品不存在
     *
     * @var unknown
     */
    const NOT_EXIST_GOODS = 3;
}

class err_dbs_shopmaterial_base_upgrade
{
    const ITEM_NOT_ENOUGH = 1;
    const CANNOT_UPGRADE = 2;
    const UPGRADE_CONFIG_ERROR = 3;
}

class err_dbs_shopmaterial_base_speedup
{
    const MALLID_NOT_EXISTS = 1;
    const NOT_ENOUGH_DIAMOND = 2;
    /**
     * 已经存在物品,没有收取
     *
     * @var unknown
     */
    const NEED_HARVEST_GOODS = 3;
}