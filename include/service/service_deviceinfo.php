<?php

namespace service;

use utils\utils_log;
use Common\Util\Common_Util_ReturnVar;

/**
 * 设备信息
 * @auther zhipeng
 */
class service_deviceinfo extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'setdeviceinfo',
            'setdevicetoken',
            'recordcrashinfo'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_deviceinfo();
    }

    /**
     * 设置信息
     *
     * @param integer $devicetype
     * @param string $devicename
     * @param string $devicetoken
     * @return Common_Util_ReturnVar
     */
    function setdeviceinfo($devicetype, $devicename)
    {
//        typeCheckChoice($devicetype, ["1", "2"]);
        typeCheckString($devicename, 128);
        return $this->get_dbins()->setdeviceinfo($devicetype, $devicename);
    }

    /**
     * 设置token
     *
     * @param unknown $devicetoken
     * @return Common_Util_ReturnVar
     */
    function setdevicetoken($devicetoken)
    {
        typeCheckString($devicetoken, 256);

        return $this->get_dbins()->setdevicetoken($devicetoken);
    }

    /**
     * 记录崩溃信息
     *
     * @param unknown $crashJson
     */
    function recordcrashinfo($crashJson)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_deviceinfo_recordcrashinfo{}

        $crashInfos = json_decode($crashJson, true);


        if (is_array($crashInfos)) {
            foreach ($crashInfos as $crashInfo) {
                utils_log::getInstance()->crashlog($this->callerUserid, $crashInfo);
            }
        }
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}