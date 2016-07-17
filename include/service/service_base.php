<?php

namespace service;

use dbs\dbs_player;
use servicemiddle\servicemiddle_serverenable;

/**
 * 接口实体类
 * Class service_base
 * @package service
 */
abstract class service_base extends \hellaEngine\service\service_base
{
    /**
     * 接口是否需要登陆嗲用,目前是是有拥有account
     *
     * @return boolean
     */
    function isNeedLogin()
    {
        return true;
    }

    /**
     * 是否需要拥有角色
     * @return bool
     */
    function isNeedRole()
    {
        return true;
    }


    /**
     * 本次调用的用户UserId
     *
     * @var string null
     */
    protected $callerUserid = NULL;
    /**
     * 本次调用用户实例
     *
     * @var dbs_player
     */
    protected $callerUserInstance = NULL;

    /**
     * 设置本地调用的用户id
     *
     * @param dbs_player $player
     */
    function setCallerUserInstance(dbs_player $player)
    {
        $this->callerUserid = $player->get_userid();
        $this->callerUserInstance = $player;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \hellaEngine\service\service_base::configure()
     */
    protected function configure()
    {
        $this->registerMiddleWare(servicemiddle_serverenable::getInstance());
    }

    /**
     * 是否可以导出LuaCode
     *
     * @var bool
     */
    protected $exportForLuaCode = true;

    /**
     * 是否可以导出客户端的Lua代码
     *
     * @return boolean
     */
    public function isExportForLuaCode()
    {
        return $this->exportForLuaCode;
    }
}
