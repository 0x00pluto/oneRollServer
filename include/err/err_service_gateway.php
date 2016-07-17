<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/2/3
 * Time: 上午11:40
 */

namespace err;


use hellaEngine\err\err_service_gateway_call;

class err_service_gateway extends err_service_gateway_call
{
    /**
     * 角色不存在
     */
    const NOT_EXISTS_ROLE = 30010;
}