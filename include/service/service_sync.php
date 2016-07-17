<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use constants\constants_messagecmd;

/**
 * 同步服务
 *
 * @author zhipeng
 *
 */
class service_sync extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'sync',
            'getservertime'
        ));

        $this->addFunction('test', TRUE);
    }

    /**
     * 同步代码,主要触发客户端的update
     *
     * @return Common_Util_ReturnVar
     */
    function sync()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $this->callerUserInstance->sync();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取服务器时间
     *
     * @return Common_Util_ReturnVar
     */
    function getservertime()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_sync_getservertime{}

        $data = $this->callerUserInstance->db_sync()->getservertime();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    function test()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_sync_test{}

        // code
        $this->callerUserInstance->db_sync()->mark_sync(constants_messagecmd::S2C_RESTAURANT_LEVELUP, array());
        // $this->callerUserInstance->db_sync ()

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}