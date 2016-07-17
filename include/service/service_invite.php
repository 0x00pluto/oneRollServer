<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/18
 * Time: 下午4:09
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\invite\dbs_invite_player;

/**
 * 邀请服务
 * Class service_invite
 * @package service
 */
class service_invite extends service_base
{

    /**
     * service_invite constructor.
     */
    public function __construct()
    {
        $this->addFunctions(
            [
                'getinfo',
                'invited'
            ]
        );
    }

    /**
     * @return dbs_invite_player
     */
    protected function get_dbins()
    {
        return dbs_invite_player::createWithPlayer($this->callerUserInstance);
    }

    /**
     * 获取信息
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {
        $data = $this->get_dbins()->toArray();
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 被邀请,
     * @param int $inviteCode 邀请人的邀请码
     * @return Common_Util_ReturnVar
     */
    public function invited($inviteCode)
    {
        return $this->get_dbins()->invited($inviteCode);
    }
}