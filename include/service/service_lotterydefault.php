<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 抽奖服务
 * @auther zhipeng
 */
class service_lotterydefault extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'lotteryone',
            'lotteryten'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_lottery_default();
    }

    protected function get_err_class_name()
    {
        return 'err\\' . "err_dbs_lottery_default_";
    }

    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_lotterydefault_getinfo{}

        $data = $this->get_dbins()->toArray();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 单抽
     *
     * @return Common_Util_ReturnVar
     */
    function lotteryone()
    {
        return $this->get_dbins()->lotteryone();
    }

    /**
     * 十连抽
     *
     * @return Common_Util_ReturnVar
     */
    function lotteryten()
    {
        return $this->get_dbins()->lotteryten();
    }
}