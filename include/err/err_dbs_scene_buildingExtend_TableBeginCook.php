<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/14
 * Time: 下午3:05
 */

namespace err;


interface err_dbs_scene_buildingExtend_cookTable_BeginCookDishes
{
    /**
     * 菜谱错误
     *
     */
    const COOKBOOK_ERROR = 1;

    /**
     * 烹饪台正在工作中
     *
     */
    const COOKING_TABLE_IS_BUSY = 2;


    /**
     * 食材数量不够
     *
     */
    const FOOD_MATERIAL_NOT_ENOUGH = 3;


    /**
     * 厨师体力不足
     *
     */
    const CHEF_VIT_NOT_ENOUGH = 4;

    /**
     * 提供的食材和菜谱需要的食材不匹配
     */
    const FOOD_MATERIAL_NOT_MATCH = 5;

    /**
     * 提供的食材和菜谱需要的食材等级不匹配
     */
    const FOOD_MATERIAL_LEVEL_NOT_MATCH = 6;

    /**
     * 食材配置没有找到
     */
    const FOOD_MATERIAL_CONFIG_NOT_FOUND = 7;
    /**
     * 主题餐厅不匹配
     */
    const THEME_RESTAURANT_NOT_MATCH = 8;
}

interface err_dbs_scene_buildingExtend_cookTable_cookDishesByStep
{
    /**
     * 烹饪台状态错误
     */
    const COOKTABLE_STATUS_ERROR = 1;
}

interface err_dbs_scene_buildingExtend_cookTable_harvest
{
    /**
     * 烹饪台状态错误
     */
    const COOKTABLE_STATUS_ERROR = 1;

    /**
     * 冷却中
     */
    const COOLDOWN = 2;

    /**
     * 烹饪菜品ID错误
     */
    const COOK_DISHES_ID_ERROR = 3;
}