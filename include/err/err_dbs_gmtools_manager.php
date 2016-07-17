<?php

namespace err;

class err_dbs_gmtools_manager_base
{
    /**
     * IP 地址不允许
     *
     * @var string
     */
    const NOT_ALLOW_IP = 1;
    /**
     * 目标用户不存在
     *
     */
    const DEST_USER_NOT_EXISTS = 2;
}

class err_dbs_gmtools_manager_addDiamondAndGameCoin extends err_dbs_gmtools_manager_base
{

    /**
     * 钻石数量错误
     *
     */
    const DIAMOND_NUM_ERROR = 10;
    /**
     * 游戏币数量错误
     *
     */
    const GAMECOIN_NUM_ERROR = 11;
}

class err_dbs_gmtools_manager_reduceDiamondAndGameCoin extends err_dbs_gmtools_manager_base
{
    /**
     * 钻石数量错误
     *
     */
    const DIAMOND_NUM_ERROR = 10;
    /**
     * 游戏币数量错误
     *
     */
    const GAMECOIN_NUM_ERROR = 11;
}

class err_dbs_gmtools_manager_addrestaurantexp extends err_dbs_gmtools_manager_base
{
}

class err_dbs_gmtools_manager_serverOpen extends err_dbs_gmtools_manager_base
{
}

class err_dbs_gmtools_manager_serverClose extends err_dbs_gmtools_manager_base
{
}

class  err_dbs_gmtools_manager_addItem extends err_dbs_gmtools_manager_base
{
    /**
     * 添加道具未知错误,一般是道具ID错误
     */
    const ITEM_ADD_ERROR = 10;
}

class err_dbs_gmtools_manager_recharge extends err_dbs_gmtools_manager_base
{
    /**
     * 充值过程错误
     */
    const RECHARGE_PROCESS_ERROR = 10;
}

