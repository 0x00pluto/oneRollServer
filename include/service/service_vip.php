<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * vip 服务
 * @auther zhipeng
 */
class service_vip extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'awardviplevelupgift'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_vip();
    }

    /**
     * 获取基本信息
     *
     * @return Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_vip_getinfo{}

        $data = $this->get_dbins()->toArray();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 领取vip等级礼包
     *
     * @return Common_Util_ReturnVar
     */
    function awardviplevelupgift()
    {
        return $this->get_dbins()->awardviplevelupgift();
    }
}