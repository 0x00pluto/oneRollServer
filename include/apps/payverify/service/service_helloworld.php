<?php

namespace apps\payverify\service;

use apps\payverify\constants\constants_serverVersion;
use Common\Util\Common_Util_ReturnVar;

/**
 * @auther zhipeng
 */
class service_helloworld extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'helloworld'
        ));
    }
    // protected function get_dbins() {
    // return $this->callerUserInstance->dbs_name ();
    // }
    // protected function get_err_class_name() {
    // return "err\\"."err_dbs_name"."_";
    // }
    /**
     *
     * @param string $hello
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function helloworld()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        // class err_service_name_helloworld{}

        dump(["constants_serverVersion::VERSION", constants_serverVersion::VERSION]);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}