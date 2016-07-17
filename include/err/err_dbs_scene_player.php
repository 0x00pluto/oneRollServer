<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/29
 * Time: 下午8:56
 */

namespace err;


/**
 * Interface err_dbs_scene_player
 * @package err
 */
interface err_dbs_scene_player
{
    /**
     * 餐厅信息没有找到
     */
    const RESTAURANT_INFO_NOT_FOUND = 100;

    /**
     * 餐厅没有开启
     */
    const RESTAURANT_INFO_NOT_OPEN = 101;
}

/**
 * Class err_dbs_scene_player_getThemeRestaurantInfo
 * @package err
 */
class err_dbs_scene_player_getThemeRestaurantInfo
{

}

class err_dbs_scene_player_addBuilding extends err_dbs_scene_data_addBuilding implements err_dbs_scene_player
{

}

class err_dbs_scene_player_batchAddBuildings extends err_dbs_scene_data_batchAddBuildings implements err_dbs_scene_player
{

}

class err_dbs_scene_player_modifyBuilding extends err_dbs_scene_data_modifyBuilding implements err_dbs_scene_player
{

}

class err_dbs_scene_player_removeBuildingToWarehouse extends err_dbs_scene_data_modifyBuilding implements err_dbs_scene_player
{

}

class err_dbs_scene_player_removeBuildingToSell extends err_dbs_scene_data_removeBuildingToSell implements err_dbs_scene_player
{

}

class err_dbs_scene_player_expand implements err_dbs_scene_data_expand, err_dbs_scene_player
{

}

class err_dbs_scene_player_expandfinish implements err_dbs_scene_data_expandfinish, err_dbs_scene_player
{

}
