<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/15
 * Time: 下午3:40
 */

namespace constants;

/**
 * 道具嫁接常量表
 * Class constants_itemgraft
 * @package constants
 */
class constants_itemgraft
{
    /**
     * 空闲
     */
    const SLOT_STATUS_FREE = 0;
    /**
     * 等待另一半
     */
    const SLOT_STATUS_WAIT_ANSWER = 1;

    /**
     * 嫁接中
     */
    const SLOT_STATUS_GRAFTING = 2;


    /**
     * 无效的配方id
     */
    const FORMULA_ID_INVALID = -1;
}