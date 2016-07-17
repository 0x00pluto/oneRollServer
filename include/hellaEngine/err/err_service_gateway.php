<?php

namespace hellaEngine\err;

/**
 *
 * @author zhipeng
 *
 */
class err_service_gateway_call
{
    /**
     * 服务类没有找到
     *
     */
    const SERVICE_CLASS_NOT_FOUND = 30000;

    /**
     * 服务类类型错误
     *
     */
    const SERVER_CLASS_TYPE_ERROR = 30001;

    /**
     * verify 错误
     *
     */
    const VERIFY_IS_ERROR = 30002;

    /**
     * 用户数据没有找到
     *
     */
    const USER_DATA_ERROR = 30003;

    /**
     * verify 为空
     *
     */
    const VERIFY_IS_EMPTY = 30004;

    /**
     * 参数错误
     *
     */
    const ARGUMENT_ERROR = 30005;
    /**
     * 不能调用
     *
     */
    const NO_CALLABLE = 30006;

    /**
     * 不支持的客户端版本号
     */
    const NONSUPPORT_CLIENT_VERSION = 30007;
}