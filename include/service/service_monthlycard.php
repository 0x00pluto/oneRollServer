<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 月卡服务
 * @auther zhipeng
 */
class service_monthlycard extends service_base
{
    function __construct()
    {
        $this->addFunction('active', TRUE);
        $this->addFunctions(array(
            'getinfo',
            'award'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_monthlycard();
    }

    protected function get_err_class_name()
    {
        return 'err\\' . "err_dbs_monthlycard_";
    }

    /**
     * 获取信息
     *
     * @return Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_monthlycard_getinfo{}

        // code
        $data = $this->get_dbins()->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 激活月卡
     *
     * @return Common_Util_ReturnVar
     */
    public function active()
    {
        $data = [];
        //interface err_service_monthlycard_active

        $data[] = $this->get_dbins()->active();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 领取奖励
     *
     * @return Common_Util_ReturnVar
     */
    function award()
    {
        return $this->get_dbins()->award();
    }
}