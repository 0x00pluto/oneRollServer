<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * pve 翻牌子服务
 * @auther zhipeng
 */
class service_pverollcard extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'roll'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_pve_rollcard();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_pverollcard" . "_";
    }

    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_pverollcard_getinfo{}

        $data = $this->get_dbins()->toArray();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 继续翻牌子
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function roll()
    {
        return $this->get_dbins()->roll();
    }
}