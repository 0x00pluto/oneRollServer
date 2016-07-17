<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/26
 * Time: 下午3:11
 */

namespace err;


class err_dbs_chef_employ_player_sendRequest
{
    /**
     * 不能雇佣自己
     */
    const CANNOT_HIRE_SELF = 1;

    /**
     * 目标用户不存在
     */
    const DEST_USER_NOT_EXISTS = 2;

    /**
     * 目标厨师不存在
     */
    const DEST_CHEF_NOT_EXISTS = 3;
    /**
     * 对方厨师不能被雇佣
     */
    const DEST_CHEF_CANNOT_EMPLOYED = 4;

    /**
     * 礼物数量错误
     */
    const PRESENT_VALUE_ERROR = 5;
    /**
     * 已经发送过请求了
     */
    const ALREADY_SEND_REQUEST = 6;
    /**
     * 游戏币,或者钻石不足
     */
    const NOT_ENOUGH_PRESENT = 7;
}

class err_dbs_chef_employ_player_cancelRequest
{
    /**
     * 请求不存在
     */
    const REQUEST_NOT_EXISTS = 1;
}

class err_dbs_chef_employ_player_refuseRequest
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;

    /**
     * 请求不存在
     */
    const REQUEST_NOT_EXISTS = 2;

}

class err_dbs_chef_employ_player_refuseAllRequest
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;
}

class err_dbs_chef_employ_player_acceptRequest
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;
    /**
     * 请求不存在
     */
    const REQUEST_NOT_EXISTS = 2;
    /**
     * 厨师不能被雇佣
     */
    const CHEF_IS_CANNOT_EMPLOYED = 3;

    /**
     * 雇主的厨师已经满了
     */
    const EMPLOYER_CHEF_FULL = 4;


}

class err_dbs_chef_employ_player_fireChef
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;
}