<?php

namespace dbs;

use Common\Util\Common_Util_ReturnVar;
use dbs\templates\dbs_templates_deviceinfo;
use err\err_dbs_deviceinfo_setdeviceinfo;

/**
 * 设备信息
 * 2015年5月13日 下午3:06:45
 *
 * @author zhipeng
 *
 */
class dbs_deviceinfo extends dbs_templates_deviceinfo
{


    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
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
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_deviceinfo_setdeviceinfo{}

        $devicetype = intval($devicetype);

        //
        if ($devicetype > 3 || $devicetype <= 0) {
            $retCode = err_dbs_deviceinfo_setdeviceinfo::DEVICE_TYPE_ERR;
            $retCode_Str = 'DEVICE_TYPE_ERR';
            goto failed;
        }

        $this->set_devicetype($devicetype);
        $this->set_devicename($devicename);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 设置token
     *
     * @param unknown $devicetoken
     * @return Common_Util_ReturnVar
     */
    function setdevicetoken($devicetoken)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_deviceinfo_setdevicetoken{}

        $devicetoken = strval($devicetoken);
        $this->set_devicetoken($devicetoken);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}