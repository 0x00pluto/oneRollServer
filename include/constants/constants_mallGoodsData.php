<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/8
 * Time: 下午3:14
 */

namespace constants;


class constants_mallGoodsData
{
    const STATUS_IDLE = 0;
    const STATUS_SELLING = 1;
    /**
     * 等待开奖
     */
    const STATUS_WAIT_ROLL = 2;
    /**
     * 开奖结束了
     */
    const STATUS_FINISH = 3;
}