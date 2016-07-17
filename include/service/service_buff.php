<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * @auther zhipeng
 */
class service_buff extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo'
        ));

        $this->addFunctions([
            'addbuff'
        ], true);
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_buff_list();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err\err_dbs_buff_list" . "_";
    }

    /**
     * getinfo
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_buff_getinfo{}

        $data = $this->get_dbins()->toArray();

        // dump ( dbs_buff_data::create_with_array ( [ ] ) );
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 增加buff
     *
     * @param unknown $buffid
     */
    function addbuff($buffid)
    {

        typeCheckString($buffid, 10);
        return $this->get_dbins()->addbuff($buffid);
    }
}