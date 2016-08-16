<?php

namespace dbs\serverstatus;

use constants\constants_serverstatus;

/**
 * 服务器状态管理器
 *
 * @author zhipeng
 *
 */
class dbs_serverstatus_manager
{
    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
        $this->serverBaseStatus = dbs_serverstatus_basestatusdata::findOrNew([]);
        if (!$this->serverBaseStatus->exist()) {
            $this->serverBaseStatus->saveToDB(true);
        }


    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof static)) {
            self::$_instance = new static ();
        }
        return self::$_instance;
    }

    /**
     *
     * @var dbs_serverstatus_basestatusdata
     */
    private $serverBaseStatus;

    /**
     * 获取服务器状态
     */
    public function getServerState()
    {
        return $this->serverBaseStatus->get_stateCode();
    }

    /**
     * 开启服务
     */
    public function serverOpen()
    {
        $this->serverBaseStatus->set_stateCode(constants_serverstatus::STATE_OPEN);
    }

    /**
     * 关闭服务
     */
    public function serverClose()
    {
        $this->serverBaseStatus->set_stateCode(constants_serverstatus::STATE_CLOSE);
    }
}