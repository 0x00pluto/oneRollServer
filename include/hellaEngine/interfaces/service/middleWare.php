<?php

namespace hellaEngine\interfaces\service;

/**
 * service 中间键接口
 *
 * @author zhipeng
 *
 */
interface middleWare
{

    /**
     * 上下文中的函数名称关键字
     */
    const contextFunctionName = "functionName";
    /**
     * 上下文中的函数参数关键字
     */
    const contextParams = "params";

    /**
     *
     * @param array $context
     *            上下文内容
     * @param \Closure $next
     *            下一个函数
     *
     * @return \Closure
     *
     * @example return $next ( $context );
     */
    function handle(array $context, \Closure $next);
}