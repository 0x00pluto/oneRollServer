<?php

namespace err;

class err_dbs_scene_fillBuildings
{
    /**
     * 位置错误
     *
     * @var unknown
     */
    const POSITIONS_ERROR = 1;
    /**
     * 道具数量不足
     *
     * @var unknown
     */
    const BUILDING_NOT_ENOUGH = 2;
    /**
     * 道具类型错误,只可以批量放置墙砖和地板
     *
     * @var unknown
     */
    const BUILDING_TYPE_ERROR = 3;

    /**
     * 位置无效
     *
     * @var unknown
     */
    const POSTION_INVALID = 4;
    /**
     * 建筑配置错误
     *
     * @var unknown
     */
    const BUILDING_CONFIG_ERROR = 5;
    /**
     * 道具类型错误
     *
     * @var unknown
     */
    const BUILDING_MAIN_TYPE_ERROR = 6;
    /**
     * 道具子类错误
     *
     * @var unknown
     */
    const BUILDING_SUBTYPE_ERROR = 7;
    /**
     * 填充过程被打断
     *
     * @var unknown
     */
    const FILL_PROGRESS_BREAK = 8;
}

class err_dbs_scene_addBuilding
{
    const CANNOT_PLACE = 1;
    const BUILDING_NOT_FOUND = 2;
    const REMOVE_BUILDING_ERROR = 3;
    /**
     * 道具类型错误,一般找策划
     */
    const ITEM_SUBTYPE_ERROR = 4;
    /**
     * 建筑数量到达最大
     *
     */
    const BUILDING_COUNT_MAX = 5;
}

class err_dbs_scene_modifybuilding
{
    const BUILDING_NOT_EXIST = 1;
    const CANNOT_PLACE = 2;
}

class err_dbs_scene_removeBuildingToWarehouse
{
    const BUILDING_NOT_EXIST = 1;
    const PUT_IN_WAREHOUSE_ERROR = 2;
    const CONFIG_ERROR = 3;
    const CANNOT_REMOVE = 4;
    /**
     * 建筑正在使用中
     *
     * @var unknown
     */
    const BUILDING_IS_BUSY = 5;
}

class err_dbs_scene_removeBuildingToSell
{
    const BUILDING_NOT_EXIST = 1;
    const CONFIG_ERROR = 2;
    const CANNOT_SELL = 3;
    const BUILDING_IS_BUSY = 4;
}

class err_dbs_scene_expand
{
    /**
     * 游戏币不足
     *
     * @var unknown
     */
    const NOT_ENOUGH_GAMECOIN = 1;
    /**
     * 钻石不足
     *
     * @var unknown
     */
    const NOT_ENOUGH_DIAMOND = 2;
    /**
     * 餐厅等级不足
     *
     * @var unknown
     */
    const NOT_ENOUGH_RESTAURENT_LEVEL = 3;
    /**
     * 材料不足
     *
     * @var unknown
     */
    const NOT_ENOUGH_MATERIALS = 4;
    /**
     * 升级冷却中
     *
     * @var unknown
     */
    const COOLDOWN = 5;
    /**
     * 已经到最大级别
     *
     * @var unknown
     */
    const LEVEL_MAX = 6;
    /**
     * 下一级配置错误
     *
     * @var unknown
     */
    const NEXT_LEVEL_CONFIG_ERROR = 7;

    /**
     * 正在扩建中
     *
     * @var unknown
     */
    const ALREADY_EXPANDING = 8;
}

class err_dbs_scene_expandfinish
{
    /**
     * 不在扩地中
     *
     * @var unknown
     */
    const NOT_IN_EXPANDING = 1;

    /**
     * 冷却中
     *
     * @var unknown
     */
    const COOLDOWN = 2;
}

class err_dbs_scene_initailzeScene
{
}
