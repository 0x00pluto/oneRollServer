<?php

namespace constants;

/**
 * 全局错误代码
 *
 * @author zhipeng
 *
 */
class constants_globalerrcode
{
    /**
     * 服务器状态异常
     *
     * @var integer
     */
    const SERVER_STATE_ERROR = 10000;


    /**
     * 消息了类型错误
     */
    const SYSTEM_ERR_MESSAGE_TYPE_ERROR = 10001;
    /**
     * 服务类没有找到
     */
    const SYSTEM_ERR_MESSAGE_SERVICE_CLASS_NOT_FOUND = 10002;
    /**
     * 单次处理消息到达上限
     */
    const SYSTEM_ERR_PROCESS_MESSAGES_COUNT_REACH_MAX = 10003;
    /**
     * 进出消息数量不匹配
     */
    const SYSTEM_ERR_IN_OUT_MESSAGE_NOT_BALANCE = 10004;

    /**
     * 没有返回消息
     */
    const SYSTEM_ERR_NOT_RETURN_MESSAGE = 10005;

    /**
     * 消息解码错误
     */
    const SYSTEM_ERR_DECODE_MESSAGE_ERROR = 10006;

    /**
     * 无效消息
     */
    const SYSTEM_ERR_INVALID_MESSAGE = 10007;
}