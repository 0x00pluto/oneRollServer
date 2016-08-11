<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/11
 * Time: 下午7:25
 */

namespace constants;


class constants_recordsAccept
{
    const STATUS_IDLE = 0;
    const STATUS_WAIT_CONFIRM_ADDRESS = 1;
    const STATUS_WAIT_SEND_GIFT = 2;
    const STATUS_WAIT_TRANSFER = 3;
    const STATUS_WAIT_SIGN_IN = 4;
    const STATUS_FINISH = 5;
}