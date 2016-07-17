<?php
namespace dbs\thirdparty;
class dbs_thirdparty_tokeninfo
{
    /**
     * 刷新用的token
     *
     * @var string
     */
    public $refreshToken = '';
    /**
     * 访问用的token
     * @var string
     */
    public $accessToken = '';
    /**
     * 用户信息
     * @var dbs_thirdparty_userinfo
     */
    public $userInfo = null;
    /**
     * 鉴权code
     * @var string
     */
    public $autherizationcode = '';

}