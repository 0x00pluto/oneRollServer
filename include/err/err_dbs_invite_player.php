<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/18
 * Time: 下午4:20
 */

namespace err;


class err_dbs_invite_player_invited
{
    /**
     * 邀请码无效
     */
    const INVITE_CODE_INVALID = 1;

    /**
     * 邀请者不存在
     */
    const INVITE_PLAYER_NOT_EXISTS = 2;

    /**
     * 我已经被邀请过了
     */
    const ALREADY_INVITED = 3;

    /**
     * 不能邀请自己
     */
    const CANNOT_INVITE_SELF = 4;
}