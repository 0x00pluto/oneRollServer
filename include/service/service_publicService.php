<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/30
 * Time: 下午2:59
 */

namespace service;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_serverVersion;

/**
 * 开放服务,不要登录验证
 * Class service_publicService
 * @package service
 */
class service_publicService extends service_base
{

    /**
     * service_publicService constructor.
     */
    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    function isNeedLogin()
    {
        return false;
    }

    function isNeedRole()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    protected function configureFunctions()
    {
        $this->addFunction('getResourceCheckCode');
        $this->addFunction('getServerVersion');
    }


    /**
     * 获取线上资源版本号
     * @return Common_Util_ReturnVar
     */
    public function getResourceCheckCode()
    {
        $data = [];
        //interface err_service_publicService_getResourceCheckCode


        $data['ResourceCheckCode'] = Common_Util_Configdata::getInstance()->getConfigSetting("ResourceCheckCode")->
        string_value();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取服务器版本信息
     * @return Common_Util_ReturnVar
     */
    public function getServerVersion()
    {
        $data = [];
        //interface err_service_publicService_getServerVersion

        $data["VERSION"] = constants_serverVersion::VERSION;
        $data["SUPPORT_MIN_CLIENT_VERSION"] = constants_serverVersion::SUPPORT_MIN_CLIENT_VERSION;

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


}