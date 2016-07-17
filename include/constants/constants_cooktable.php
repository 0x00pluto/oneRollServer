<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/14
 * Time: 下午2:54
 */

namespace constants;


class constants_cooktable
{
    /**
     * 空闲
     */
    const STATUS_EMPTY = 0;
    /**
     * 烹饪中,需要操作
     */
    const STATUS_COOKING = 1;
    /**
     * 等待完成,就是做完所有操作后,等时间
     */
    const STATUS_WAIT_FINISH = 2;
}