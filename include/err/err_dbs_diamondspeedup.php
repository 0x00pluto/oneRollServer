<?php

namespace err;

class err_dbs_diamondspeedup_base
{
    const NOT_COOLDOWN = 1;
    const NOT_ENOUGH_DIAMOND = 2;
    const DIAMOND_SPEEDUP_CONFIG_ERR = 3;
}

class err_dbs_diamondspeedup_speedupshopbutcher extends err_dbs_diamondspeedup_base
{
}

class err_dbs_diamondspeedup_getdiamondsspeedupshopbutcher extends err_dbs_diamondspeedup_base
{
}

class err_dbs_diamondspeedup_speedupshopfruit extends err_dbs_diamondspeedup_base
{
}

class err_dbs_diamondspeedup_speedupshopseafood extends err_dbs_diamondspeedup_base
{
}

class err_dbs_diamondspeedup_getSpeedUpCookTableDiamonds extends err_dbs_diamondspeedup_speedupcooktable
{

}

class err_dbs_diamondspeedup_speedupcooktable extends err_dbs_diamondspeedup_base
{
    const NOT_FOUND_COOK_TABLE = 10;
    /**
     * guid不是炉灶
     *
     */
    const GUID_IS_NOT_COOK_TABLE = 11;
}

class err_dbs_diamondspeedup_getSpeedUpSceneExpandDiamonds extends err_dbs_diamondspeedup_base
{

}

class err_dbs_diamondspeedup_speedupsceneexpand extends err_dbs_diamondspeedup_base
{
}

class err_dbs_diamondspeedup_speedupcomposeitem extends err_dbs_diamondspeedup_base
{
    /**
     * 合成位置不存在
     *
     */
    const NOT_SLOT_DATA = 11;
}

class err_dbs_diamondspeedup_speedupdinnertable extends err_dbs_diamondspeedup_base
{
    /**
     * 没有找到餐台
     *
     */
    const NOT_FOUND_DINNER_TABLE = 12;
    /**
     * 不是餐台
     *
     */
    const GUID_IS_NOT_DINNER_TABLE = 13;

    /**
     * 主题餐台没有开启
     */
    const THEME_RESTAURANT_NOT_OPEN = 14;
}

class err_dbs_diamondspeedup_getSpeedUpDinnerTableDiamonds extends err_dbs_diamondspeedup_speedupdinnertable
{

}

class err_dbs_diamondspeedup_speedUpGraft extends err_dbs_diamondspeedup_base

{
    /**
     * 槽位ID错误
     */
    const SLOT_ID_ERROR = 11;
    /**
     * 槽位状态错误
     */
    const SLOT_STATUS_ERROR = 12;
    /**
     * 目标用户不存在
     */
    const DEST_PLAYER_NOT_EXIST = 13;
}

class err_dbs_diamondspeedup_speedupTrainChef extends err_dbs_diamondspeedup_base
{
    const CHEF_NOT_EXISTS = 11;

    const CHEF_NOT_IN_TRAIN = 12;
    /**
     * 培训次数超过上限
     */
    const TODAY_SPEEDUP_TIMES_MAX = 13;


}