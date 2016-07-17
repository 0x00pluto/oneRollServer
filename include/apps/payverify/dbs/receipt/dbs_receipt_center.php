<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/5/31
 * Time: 上午11:10
 */

namespace apps\payverify\dbs\receipt;


use constants\constants_platformtype;

class dbs_receipt_center
{
    /**
     * @var
     */
    private static $_instance;

    private function __construct()
    {
        // echo 'This is a Constructed method;';
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    /**
     * 单例方法,用于访问实例的公共的静态方法
     * @return static
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof static)) {
            self::$_instance = new static ();
            self::$_instance->initialize();
        }
        return self::$_instance;
    }


    /**
     * 初始化方法
     */
    final protected function initialize()
    {
        $this->initializing();
    }

    /**
     * 初始化
     */
    protected function initializing()
    {

    }
    /**
     * 允许校验的渠道号
     * @var array
     */
    protected $allowPlatforms = [
        constants_platformtype::FANQIE_DEBUG_SIMULATOR,
        constants_platformtype::FANQIE_DEBUG_Phone,
        constants_platformtype::TEST002
    ];

    /**
     * @param $platform
     */
    protected function addAllowPlatform($platform)
    {
        $this->allowPlatforms[] = $platform;
    }

    /**
     * 是否允许运行平台
     * @param $platformId
     * @return bool
     */
    protected function isAllowPlatform($platformId)
    {
        return in_array($platformId, $this->allowPlatforms);
    }
}