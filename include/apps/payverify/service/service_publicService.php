<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/4/5
 * Time: 下午4:14
 */

namespace apps\payverify\service;


use apps\payverify\constants\constants_serverVersion;
use Common\Util\Common_Util_ReturnVar;

/**
 * 公共服务
 * Class service_publicService
 * @package apps\payverify\service
 */
class service_publicService extends service_base
{
    /**
     * @inheritDoc
     */
    protected function configureFunctions()
    {
        $this->addFunction('getServerVersion');
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

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

}