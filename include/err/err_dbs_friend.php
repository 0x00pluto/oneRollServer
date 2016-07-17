<?php

namespace err;

class err_dbs_friend_sendfriendrequest
{
    /**
     * 请求列表满了
     *
     * @var unknown
     */
    const REQUEST_LIST_MAX = 1;
    /**
     * 好友列表满了
     *
     * @var unknown
     */
    const FRIEND_LIST_MAX = 2;
    /**
     * 已经
     *
     * @var unknown
     */
    const EXIST_FRIEND = 3;
    /**
     * 用户不存在
     *
     * @var unknown
     */
    const USER_NOT_EXISTS = 4;

    /**
     * 请求已经存在了
     *
     * @var unknown
     */
    const REQUEST_EXISTS = 5;

    /**
     * 已经在对方的列表中
     *
     * @var unknown
     */
    const ANSWER_EXISTS = 6;

    /**
     * 不能向自己发请求
     *
     * @var unknown
     */
    const CANNOT_REQUEST_SELF = 7;
    /**
     * 对方已经请求过我成为对方的好友
     *
     * @var unknown
     */
    const REQUST_EXISTS_IN_OTHER_REQUESTLIST = 8;
}

class err_dbs_friend_answerfriendrequest
{
    /**
     * 应答不存在
     *
     * @var unknown
     */
    const ANSWER_NOT_EXISTS = 1;

    /**
     *
     * @var unknown
     */
    const FROM_USER_NOT_EXISTS = 2;
    /**
     * 自己的好友到达上限
     *
     * @var unknown
     */
    const SELF_FRIEND_MAX = 3;

    /**
     * 申请用户的好友到达上限
     *
     * @var unknown
     */
    const FROM_USER_FRIEND_MAX = 4;
}

class err_dbs_friend_removefriend
{

    /**
     * 好友不存在
     *
     * @var unknown
     */
    const FRIEND_NOT_EXISTS = 1;
}

class err_dbs_friend_getfriend
{
    /**
     * 没有找到用户
     *
     * @var unknown
     */
    const NOT_FOUND_USER = 1;
}

class err_dbs_friend_addfriendgoodwillexp extends err_dbs_friend_data_addgoodwillexp
{
    /**
     * 没有找到用户
     *
     * @var unknown
     */
    const NOT_FOUND_USER = 10;
    /**
     * 增加经验错误
     *
     * @var unknown
     */
    const ADD_EXP_ERROR = 11;
}

class err_dbs_friend_getrecommendfriends
{
    /**
     * 钻石数量不足
     *
     * @var unknown
     */
    const DIAMOND_NOT_ENOUGH = 1;
}

class err_dbs_friend_removeFriendRequest
{
    /**
     * 没有找到好友请求
     *
     * @var unknown
     */
    const NOT_FOUND_FRIEND_REQUEST = 1;
}

/**
 * Class err_dbs_friend_addFriend
 * @package err
 */
class err_dbs_friend_addFriend
{
    /**
     * 好友列表满了
     *
     * @var
     */
    const FRIEND_LIST_MAX = 1;
    /**
     * 已经存在此好友了
     *
     * @var
     */
    const EXIST_FRIEND = 2;
    /**
     * 用户不存在
     *
     * @var
     */
    const USER_NOT_EXISTS = 3;

    /**
     * 不能添加自己
     *
     * @var
     */
    const CANNOT_ADD_SELF = 4;

}

/**
 * Class err_dbs_friend_getGoodwill
 * @package err
 */
class err_dbs_friend_getGoodwill
{
    /**
     * 目标用户不存在
     */
    const DEST_USER_NOT_EXISTS = 1;
    /**
     * 不能是自己
     */
    const CANNOT_SELF = 2;
}

/**
 * Class err_dbs_friend_awardGoodwillGift
 * @package err
 */
class err_dbs_friend_awardGoodwillGift
{
    /**
     * 目标用户不存在
     */
    const DEST_USER_NOT_EXISTS = 1;

    /**
     * 没有到达领取等级
     */
    const NOT_REACH_AWARD_LEVEL = 2;

    /**
     * 奖励配置错误
     */
    const AWARD_CONFIG_ERROR = 3;
    /**
     * 仓库已满
     */
    const WAREHOUSE_FULL = 4;
    /**
     * 不能是自己
     */
    const CANNOT_SELF = 5;
}
