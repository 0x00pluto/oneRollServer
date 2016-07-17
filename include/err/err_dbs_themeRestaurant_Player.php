<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/2/3
 * Time: 下午5:35
 */

namespace err;


class err_dbs_themeRestaurant_Player_openNewRestaruant
{
    const RESTAURANT_CONFIG_ERROR = 1;

    const RESTAURANT_ALREADY_OPENED = 2;
    /**
     * 主餐厅等级不足
     */
    const RESTAURANT_LEVEL_NOT_ENOUGH = 3;
    /**
     * 图鉴不足
     */
    const HANDBOOKS_NOT_ENOUGH = 4;
}

class err_dbs_themeRestaurant_Player_harvestThemeRestaurantAutoManage
{
    /**
     * 餐厅ID错误
     */
    const RESTAURANT_ID_ERROR = 1;
    /**
     * 餐厅不在自动经营的模式中
     */
    const RESTAURANT_NOT_IN_AUTO_MODE = 2;
    /**
     * 收获冷却中
     */
    const RESTAURANT_HARVEST_COOL_DOWN = 3;
    /**
     * 经营配置错误
     */
    const MANAGE_CONFIG_ERROR = 4;
}