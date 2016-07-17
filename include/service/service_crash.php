<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/25
 * Time: 下午3:12
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use utils\utils_log;

/**
 * 客户端崩溃服务
 * Class service_crash
 * @package service
 */
class service_crash extends service_base
{
    /**
     * service_crash constructor.
     */
    public function __construct()
    {
        $this->addFunction('recordCrashInfo');
    }

    /**
     * @inheritDoc
     */
    function isNeedRole()
    {
        return false;
    }

    /**
     * 记录崩溃信息
     * @param string $crashJson
     * @return Common_Util_ReturnVar
     */
    function recordCrashInfo($crashJson)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $crashInfos = json_decode($crashJson, true);


        if (is_array($crashInfos)) {
            foreach ($crashInfos as $crashInfo) {
                utils_log::getInstance()->crashlog($this->callerUserid, $crashInfo);
            }
        }
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }

}