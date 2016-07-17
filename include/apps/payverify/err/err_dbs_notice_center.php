<?php

namespace apps\payverify\err;

class err_dbs_notice_center_check
{
    /**
     * 充值数据不存在
     *
     */
    const RECHARGE_DATA_NOT_EXIST = 1;
    /**
     * 已经验证过了
     *
     */
    const ALREADY_VERIFYED = 2;
}

class err_dbs_notice_center_recordrechargedata
{
    /**
     * 充值数据已经存在
     *
     */
    const RECHARGE_DATA_EXIST = 1;
}