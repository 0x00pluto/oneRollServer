<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/12
 * Time: 下午12:37
 */

namespace hellaEngine\utils;

/**
 * Class singleton
 * @package hellaEngine\utils
 */
trait singleton
{
    /**
     * @return static
     */
    public static function getInstance()
    {
        static $_instance = NULL;
        return $_instance ?: $_instance = new static();
    }
}