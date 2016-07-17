<?php

namespace err;
class err_dbs_cookdishes_BeginCookDishes implements err_dbs_scene_buildingExtend_cookTable_BeginCookDishes
{
    /**
     * 菜谱无效
     */
    const COOKBOOK_INVALID = 10;
    /**
     * 烹饪台不存在
     */
    const COOKTABLE_NOT_EXISTS = 11;
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 12;
    /**
     * 主题餐厅ID错误
     */
    const THEME_RESTAURANT_ID_ERROR = 13;
    /**
     * 没有任命厨师
     */
    const JOB_CHEF_NOT_PERSON = 14;
}

class err_dbs_cookdishes_cookDishesByStep implements err_dbs_scene_buildingExtend_cookTable_cookDishesByStep
{
    /**
     * 烹饪台不存在
     */
    const COOKTABLE_NOT_EXISTS = 10;
}

class err_dbs_cookdishes_cookDishesHarvest implements err_dbs_scene_buildingExtend_cookTable_harvest
{
    /**
     * 烹饪台不存在
     */
    const COOKTABLE_NOT_EXISTS = 10;
    /**
     * 场景中没有餐台
     */
    const NOT_DINNER_TABLE = 11;
    /**
     * 没有空餐台
     */
    const NOT_EMPTY_DINNERTABLE = 12;
}

class err_dbs_cookdishes_cookdishes
{
    /**
     * 菜谱错误
     *
     * @var unknown
     */
    const COOKBOOK_ERROR = 1;
    /**
     * 烹饪台没有找到
     *
     * @var unknown
     */
    const COOKING_TABLE_CANNOT_FOUND = 2;

    /**
     * 烹饪台正在工作中
     *
     * @var unknown
     */
    const COOKING_TABLE_ISBUSY = 3;

    /**
     * 菜谱类型错误 就是烹饪台做不了这种菜
     *
     * @var unknown
     */
    const COOKING_TABLE_TYPE_ERR = 4;

    /**
     * 到达最大步骤
     *
     * @var
     *
     */
    const COOKING_STEP_MAX = 5;
    /**
     * 食材数量不够
     *
     * @var unknown
     */
    const FOOD_MATERIAL_NOT_ENOUGH = 6;
    /**
     * 没有找到厨师
     *
     * @var unknown
     */
    const CHEF_NOT_FOUND = 7;

    /**
     * 厨师体力不足
     *
     * @var unknown
     */
    const CHEF_VIT_NOT_ENOUGH = 8;
}

class err_dbs_cookdishes_harvestcookingtable
{
    /**
     * 没有找到烹饪台
     *
     * @var unknown
     */
    const COOKINGTABLE_NOT_FOUND = 1;
    /**
     * 没有烹饪
     *
     * @var unknown
     */
    const NOT_COOKING = 2;
    /**
     * 冷却中
     *
     * @var unknown
     */
    const COOLDOWN = 3;
    /**
     * 没有找到空的餐台
     */
    const NOT_EMPTY_DINNERTABLE = 4;
    /**
     * 没有放置餐台
     *
     * @var unknown
     */
    const NOT_DINNERTABLE = 5;

    /**
     * 菜品没有找到
     *
     * @var unknown
     */
    const DISHES_NOT_FOUND = 6;

    /**
     * 做菜步骤没有完成
     *
     * @var unknown
     */
    const STEP_NOT_FINISH = 7;

    /**
     * 不能收获
     *
     * @var unknown
     */
    const CANNOT_HARVEST = 8;

    /**
     * 菜品配置错误
     */
    const DISHES_CONFIG_ERROR = 9;

    /**
     * 需要接收好友感谢
     *
     * @var unknown
     */
    const NEED_RECV_FRIEND_HELP = 10;
}

class err_dbs_cookdishes_ungradecooktable
{
    /**
     * 没有找到烹饪台
     *
     * @var unknown
     */
    const COOKINGTABLE_NOT_FOUND = 1;

    /**
     * 等级上限了
     *
     * @var unknown
     */
    const COOKINGTABLE_LEVEL_MAX = 2;
    /**
     * 道具不足
     *
     * @var unknown
     */
    const COOKINGTABLE_NOT_ENOUGH_ITEMS = 3;

    /**
     * 升级配置错误
     *
     * @var unknown
     */
    const UPGRADE_CONFIG_ERROR = 4;
}

class err_dbs_cookdishes_cleardinnertable
{
    const DINNER_TABLE_NOT_FOUND = 1;
    /**
     * 不是餐台
     *
     * @var unknown
     */
    const IS_NOT_DINNERTABLE = 2;
}

class err_dbs_cookdishes_clearcooktable
{
    /**
     * 没有找到烹饪台
     *
     * @var unknown
     */
    const COOKINGTABLE_NOT_FOUND = 1;
    /**
     * 不是餐台
     *
     * @var unknown
     */
    const IS_NOT_COOKTABLE = 2;
}
