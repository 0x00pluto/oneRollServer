<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use Qiniu\Auth;
use constants\constants_returnkey;

/**
 * @auther zhipeng
 */
class service_uploadimg extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
                'getqiniutoken'
            )
        // 'getheadiconBaseUrl'
        );
    }

    /**
     * 获取头像访问基础URL
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getheadiconBaseUrl()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_uploadimg_getheadiconBaseUrl{}

        $data [constants_returnkey::RK_HEADICON_BASEURL] = "http://7xofda.com2.z0.glb.qiniucdn.com/";
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取七牛上床token
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getqiniutoken()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_uploadimg_getqiniutoken{}

        // code
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = 'F5aWHx-yKKt_AJQpkba-auWYLu_43hoyllxNIe82';
        $secretKey = 'mQd4sD4Scz5n4Wv9G7o2pv0S1ry1q471wnih1hep';

        // 构建鉴权对象
        $auth = new Auth ($accessKey, $secretKey);

        // 要上传的空间
        $bucket = 'tomatofuns-headicon';

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);

        $data ['bucket'] = $bucket;
        $data ['token'] = $token;
        /**
         * 图片前缀
         */
        $data ['imageprefix'] = $this->callerUserid . '/';

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}