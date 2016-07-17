<?php

namespace apps\payverify\err;

class err_dbs_applereceipt_center_verify
{
    /**
     * 已经验证过了
     *
     */
    const ALREADY_VERIFIED = 1;
    /**
     * http200
     *
     */
    const HTTP_CODE_200 = 2;
    /**
     * 验证错误
     *
     */
    const VERIFY_STATUS_ERROR = 3;

    /**
     * 已经存在了充值数据
     */
    const RECHARGE_VERIFY_DATA_EXISTS = 4;

    /**
     * 验证渠道不对
     */
    const PLATFORM_NOT_ALLOW = 5;
}