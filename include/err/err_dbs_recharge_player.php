<?php

namespace err;

class err_dbs_recharge_player_createorder
{
    /**
     * 商品不存在
     *
     */
    const GOODS_NOT_EXISTS = 1;
    /**
     * 不能充值月卡
     *
     */
    const CANNOT_RECHAGRE_MONTHLY_CARD = 2;
    // const

    /**
     * 渠道不匹配
     */
    const CHANNEL_NOT_MATCH = 3;
}

class err_dbs_recharge_player_cancelorder
{
    /**
     * 没有未完成的订单
     *
     */
    const NOT_UNCOMPLETE_ORDER = 1;
}

class err_dbs_recharge_player_completeorder
{
    /**
     * 没有未完成的订单
     *
     */
    const NOT_UNCOMPLETE_ORDER = 1;
}

class err_dbs_recharge_player_verifyorder
{
    /**
     * 没有未完成的订单
     *
     */
    const NOT_UNCOMPLETE_ORDER = 1;

    /**
     * 系统错误
     *
     */
    const VERIFY_SYSTEM_ERR = 2;

    /**
     * 没有找到充值记录
     *
     */
    const NOT_FOUND_RECHARGE_RECORD = 3;

    /**
     * 已经校验过的订单
     *
     */
    const DUPLICATE_VERIFY = 4;

    /**
     * 货物id不匹配
     *
     */
    const GOODS_ID_NOT_MATCH = 5;
}

class err_dbs_recharge_player_verifyorderactive extends err_dbs_recharge_player_verifyorder
{
    /**
     * 系统错误
     *
     */
    const SYSTEM_ERR = 100;
}

class err_dbs_recharge_player_verifyorderappstore extends err_dbs_recharge_player_verifyorderactive
{
}

class err_dbs_recharge_player_recharge
{
    const GOODS_ID_ERROR = 1;
}

