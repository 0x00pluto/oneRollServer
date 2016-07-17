<?php

namespace err;

class err_dbs_friendhelp_player
{
    /**
     * 目标用户不存在
     */
    const DEST_PLAYER_NOT_EXISTS = 1;
    /**
     * 单个用户帮忙次数达到上限
     */
    const HELP_SINGLE_PLAYER_COUNT_MAX = 2;
    /**
     * 总的帮忙次数达到上限
     */
    const HELP_TOTAL_COUNT_MAX = 3;
    /**
     * 收到帮忙次数达到上限
     */
    const HELP_RECV_TOTAL_COUNT_MAX = 4;
    /**
     * 不能帮助自己
     */
    const CANNOT_HELP_SELF = 5;
}

class err_dbs_friendhelp_player_helpEatDishes extends err_dbs_friendhelp_player
{
    /**
     * 主题餐厅ID无效
     */
    const THEME_RESTAURANT_ID_INVALID = 10;
    /**
     * 餐台不存在
     */
    const DINNER_TABLE_NOT_EXISTS = 11;
    /**
     * 餐台类型错误
     */
    const DINNER_TABLE_TYPE_ERROR = 12;
    /**
     * 餐台为空
     */
    const DINNER_TABLE_EMPTY = 13;
}

class err_dbs_friendhelp_player_helpCookDishes extends err_dbs_friendhelp_player
{
    /**
     * 主题餐厅ID无效
     */
    const THEME_RESTAURANT_ID_INVALID = 10;
    /**
     * 烹饪台不存在
     */
    const COOKING_TABLE_NOT_EXISTS = 11;
    /**
     * 烹饪台类型错误
     */
    const COOKING_TABLE_TYPE_ERROR = 12;

    /**
     * 烹饪台状态错误
     */
    const COOKING_TABLE_STATUS_ERROR = 13;

    /**
     * 烹饪台状态
     */
    const COOKING_TABLE_COOKING_FINISH = 14;
}

class err_dbs_friendhelp_player_helpExpand extends err_dbs_friendhelp_player
{
    /**
     * 主题餐厅ID无效
     */
    const THEME_RESTAURANT_ID_INVALID = 10;
    /**
     * 扩地状态错误
     */
    const EXPAND_STATUS_ERROR = 11;
}