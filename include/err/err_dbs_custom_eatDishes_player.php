<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/27
 * Time: 下午3:47
 */

namespace err;


class err_dbs_custom_eatDishes_player_buildEatReceipt
{
    /**
     * 没有到消耗时间
     *
     */
    const NOT_ENOUGH_TIME = 1;
    /**
     * 没有餐台有吃的
     */
    const NOT_DINNERTABLE_HAS_FOOD = 2;
    /**
     * 票据已满
     */
    const RECEIPTS_FULL = 3;
}

class err_dbs_custom_eatDishes_player_eatByReceiptAndCustom
{
    /**
     * 票据错误
     *
     */
    const RECEIPT_ERROR = 1;
    /**
     * 指定餐台id无效
     */
    const DINNERTABLE_ID_INVALID = 2;

    /**
     * 顾客id无效
     *
     * @var integer
     */
    const CUSTOM_GUID_INVALID = 3;
    /**
     * 吃菜失败 原因未知
     *
     */
    const EAT_FAILED = 4;
}

class err_dbs_custom_eatDishes_player_eatDishesByDinnerTableGUID
{

}

class err_dbs_custom_eatDishes_player_eatByOffline
{
    /**
     * 没有到消耗时间
     *
     */
    const NOT_ENOUGH_TIME = 1;
    /**
     * 没有餐台有吃的
     */
    const NOT_DINNERTABLE_HAS_FOOD = 2;
    /**
     * 离线吃菜系统没有开启
     *
     */
    const EAT_OFFLINE_SYSTEM_NOT_OPEN = 3;
}