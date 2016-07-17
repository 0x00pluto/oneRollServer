<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/2/17
 * Time: 下午4:37
 */

namespace hellaEngine\service;


class service_builder
{
    /**
     * 服务缓存
     * @var array
     */
    private $servicesCache = [];

    /**
     * 创建服务
     * @param $serviceName
     * @return bool|service_base
     */
    function create($serviceName)
    {
        if (isset($this->servicesCache[$serviceName])) {
            return $this->servicesCache[$serviceName];
        }

        if (!class_exists($serviceName)) {
            return false;
        }
        $classInstance = new $serviceName ();
        if (!$classInstance instanceof service_base) {
            return false;
        }
        $this->servicesCache[$serviceName] = $classInstance;
        $classInstance->bootstrap();
        return $classInstance;
    }

    /**
     * @var service_base
     */
    private static $instance = null;

    /**
     * 单例
     * @return service_builder
     */
    public static function o()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}