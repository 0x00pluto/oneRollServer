<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/25
 * Time: 下午2:22
 */

namespace constants;

/**
 * 厨师培训状态
 * Class constants_trainChef
 * @package constants
 */
class constants_trainChef
{
    /**
     * 空闲状态
     */
    const STATUS_FREE = 1;
    /**
     * 等待同意
     */
    const STATUS_WAIT_ANSWER = 2;
    /**
     * 培训中
     */
    const STATUS_TRAINING = 3;
}