<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\neighbourhood\dbs_neighbourhood_groupmanager;


/**
 * 账号接口
 *
 * @author zhipeng
 *
 */
class service_account extends service_base
{
    function __construct()
    {
        $this->addFunctions([
            'login',
            'logout'
        ]);
    }

    /**
     * 标记用户登录,目前为空,调用时间在 thridparty.login 之后
     * 在进入后台 切换前台的时候调用
     *
     * login
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function login()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_account_login{}

        $this->callerUserInstance->db_role()->login();

        // 加入默认的群组
        dbs_neighbourhood_groupmanager::getInstance()->autojoinneighboorhood($this->callerUserInstance);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 登出,在进入后台,或者杀掉进程前调用
     */
    function logout()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_account_logout{}

        $this->callerUserInstance->db_role()->logout();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}