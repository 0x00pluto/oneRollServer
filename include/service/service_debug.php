<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_player;
use constants\constants_returnkey;

/**
 * @auther zhipeng
 */
class service_debug extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'addUserIdToCache',
            'test'
        ), true);

        $this->exportForLuaCode = false;
    }

    function isNeedLogin()
    {
        return FALSE;
    }

    /**
     * 增加USERIDToCache
     *
     * @param unknown $userid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function addUserIdToCache($userid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_debug_addUserIdToCache{}

        $userid = strval($userid);
        $verify = dbs_player::addUseridToCache($userid);

        $data [constants_returnkey::RK_USERID] = $userid;
        $data [constants_returnkey::RK_VERIFY] = $verify;
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
        // class err_service_debug_test{}

//        $route = new Route ();
//        $route->register('a.a', 'b.b');
//        $route->getCommand('a.a');
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}