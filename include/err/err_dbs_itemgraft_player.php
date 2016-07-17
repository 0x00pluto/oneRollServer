<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/15
 * Time: 下午3:28
 */

namespace err;


/**
 * Class err_dbs_itemgraft_player_prepareGraft
 * @package err
 */
class err_dbs_itemgraft_player_prepareGraft
{
    /**
     * 槽位id错误
     */
    const SLOT_ID_ERROR = 1;
    /**
     * 槽位状态错误,不能开始嫁接
     */
    const SLOT_STATUS_ERROR = 2;
    /**
     * 道具不足
     */
    const ITEM_NOT_ENOUGH = 3;
    /**
     * 道具ID错误
     */
    const ITEM_ID_ERROR = 4;
    /**
     * 道具ID错误,找不到此ID的配方
     */
    const NOT_FORMULA_EXIST = 4;
}

class err_dbs_itemgraft_player_answerGraft
{
    /**
     * 不能是自己
     */
    const CAN_NOT_SELF = 1;

    /**
     * 目标用户没有开启嫁接
     */
    const DEST_PLAYER_NOT_GRAFT = 2;

    /**
     * 道具不足
     */
    const ITEM_NOT_ENOUGH = 3;
    /**
     * 道具ID错误
     */
    const ITEM_ID_ERROR = 4;
    /**
     * 道具ID错误,找不到此ID的配方
     */
    const NOT_FORMULA_EXIST = 5;
    /**
     * 目标用户不存在
     */
    const DEST_PLAYER_NOT_EXIST = 6;

    /**
     * 槽位id错误
     */
    const SLOT_ID_ERROR = 7;
    /**
     * 到达了最大应答次数
     */
    const ANSWER_TIMES_MAX = 8;
    /**
     * 重复应答本次请求
     */
    const ANSWER_DUPLICATE = 9;
}

class err_dbs_itemgraft_player_acceptGraft
{
    /**
     * 槽位ID错误
     */
    const SLOT_ID_ERROR = 1;
    /**
     * 槽位状态错误
     */
    const SLOT_STATUS_ERROR = 2;
    /**
     * 目标用户不存在
     */
    const DEST_USER_NOT_EXIST = 3;
}

class err_dbs_itemgraft_player_refuseGraftAll
{
    /**
     * 槽位ID错误
     */
    const SLOT_ID_ERROR = 1;
    /**
     * 槽位状态错误
     */
    const SLOT_STATUS_ERROR = 2;
    /**
     * 不存在应答
     */
    const ANSWERS_EMPTY = 3;
}

class err_dbs_itemgraft_player_refuseGraft
{
    /**
     * 槽位ID错误
     */
    const SLOT_ID_ERROR = 1;
    /**
     * 槽位状态错误
     */
    const SLOT_STATUS_ERROR = 2;

    /**
     * 请求不存在
     */
    const ANSWER_NOT_EXIST = 3;


}

class err_dbs_itemgraft_player_addResultWeight
{
    /**
     * 槽位ID错误
     */
    const SLOT_ID_ERROR = 1;
    /**
     * 槽位状态错误
     */
    const SLOT_STATUS_ERROR = 2;
    /**
     * 目标用户不存在
     */
    const DEST_PLAYER_NOT_EXIST = 3;
    /**
     * 该序号不能增加权重
     */
    const ADD_RESULT_WEIGHT_INDEX_ERROR = 4;
    /**
     * 添加次数已经满了
     */
    const ADD_RESULT_TIMES_MAX = 5;
}

class err_dbs_itemgraft_player_harvestGraft
{
    /**
     * 槽位ID错误
     */
    const SLOT_ID_ERROR = 1;
    /**
     * 槽位状态错误
     */
    const SLOT_STATUS_ERROR = 2;
    /**
     * 目标用户不存在
     */
    const DEST_PLAYER_NOT_EXIST = 3;
    /**
     * 仓库已满
     */
    const WAREHOUSE_FULL = 4;

}

class err_dbs_itemgraft_player_publishAdvertisement
{
    /**
     * 槽位ID错误
     */
    const SLOT_ID_ERROR = 1;
    /**
     * 槽位状态错误
     */
    const SLOT_STATUS_ERROR = 2;
    /**
     * 已经发布过了
     */
    const PUBLISHED = 3;

    /**
     * 冷却中
     */
    const COOL_DOWN = 4;


    /**
     * 钻石不足
     */
    const DIAMOND_NOT_ENOUGH = 5;
}