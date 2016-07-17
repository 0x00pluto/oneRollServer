<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/29
 * Time: 下午9:25
 */

namespace err;


class err_dbs_scene_data_initializeScene
{

}

/**
 * Class err_dbs_scene_data_addBuilding
 * @package err
 */
class err_dbs_scene_data_addBuilding
{
    /**
     * 建筑不存在仓库
     */
    const BUILDING_NOT_EXISTS = 1;
    /**
     * 道具子类错误
     */
    const ITEM_SUBTYPE_ERROR = 2;
    /**
     * 没有找到地图数据
     */
    const NOT_FIND_MAP_DATA = 3;
    /**
     * 不能放置
     */
    const CANNOT_PLACE = 4;
    /**
     * 不能在此主题餐台中使用
     */
    const NOT_ALLOW_IN_THEME_RESTAURANT = 5;

    /**
     * 到达数量上限
     */
    const REACH_COUNT_LIMIT = 6;
}

class err_dbs_scene_data_batchAddBuildings
{
    /**
     * 位置错误
     *
     * @var
     */
    const POSITIONS_ERROR = 1;
    /**
     * 道具数量不足
     *
     * @var
     */
    const BUILDING_NOT_ENOUGH = 2;
    /**
     * 道具类型错误,只可以批量放置墙砖和地板
     *
     * @var
     */
    const BUILDING_TYPE_ERROR = 3;

    /**
     * 位置无效
     *
     * @var
     */
    const POSITION_INVALID = 4;
    /**
     * 建筑配置错误
     *
     * @var
     */
    const BUILDING_CONFIG_ERROR = 5;
    /**
     * 道具类型错误
     *
     * @var
     */
    const BUILDING_MAIN_TYPE_ERROR = 6;
    /**
     * 道具子类错误
     *
     * @var
     */
    const BUILDING_SUBTYPE_ERROR = 7;
    /**
     * 填充过程被打断
     *
     * @var
     */
    const FILL_PROGRESS_BREAK = 8;
}

class err_dbs_scene_data_removeBuildingToWarehouse
{

    /**
     * 建筑不存在
     */
    const BUILDING_NOT_EXIST = 1;
    /**
     * 放入仓库错误
     */
    const PUT_IN_WAREHOUSE_ERROR = 2;
    /**
     * 配置错误
     */
    const CONFIG_ERROR = 3;
    /**
     * 不能删除
     */
    const CANNOT_REMOVE = 4;
    /**
     * 建筑正在使用中
     *
     */
    const BUILDING_IS_BUSY = 5;
}

class err_dbs_scene_data_removeBuildingToSell
{
    /**
     * 建筑不存在
     */
    const BUILDING_NOT_EXIST = 1;

    /**
     * 不能出售
     */
    const CANNOT_SELL = 2;
    /**
     * 建筑正在使用中
     *
     */
    const BUILDING_IS_BUSY = 3;
}

/**
 * Class err_dbs_scene_data_modifyBuilding
 * @package err
 */
class err_dbs_scene_data_modifyBuilding
{
    /**
     * 建筑不存在
     */
    const BUILDING_NOT_EXIST = 1;
    /**
     * 不能放置
     */
    const CANNOT_PLACE = 2;
}

interface err_dbs_scene_data_expand
{
    /**
     * 游戏币不足
     *
     */
    const NOT_ENOUGH_GAMECOIN = 1;
    /**
     * 钻石不足
     *
     */
    const NOT_ENOUGH_DIAMOND = 2;
    /**
     * 餐厅等级不足
     *
     */
    const NOT_ENOUGH_RESTAURANT_LEVEL = 3;
    /**
     * 材料不足
     *
     */
    const NOT_ENOUGH_MATERIALS = 4;
    /**
     * 升级冷却中
     *
     */
    const COOL_DOWN = 5;
    /**
     * 已经到最大级别
     *
     */
    const LEVEL_MAX = 6;
    /**
     * 下一级配置错误
     *
     */
    const NEXT_LEVEL_CONFIG_ERROR = 7;

    /**
     * 正在扩建中
     *
     */
    const ALREADY_EXPANDING = 8;
}

interface err_dbs_scene_data_expandfinish
{
    /**
     * 不在扩地中
     *
     */
    const NOT_IN_EXPANDING = 1;

    /**
     * 冷却中
     *
     */
    const COOLDOWN = 2;
}