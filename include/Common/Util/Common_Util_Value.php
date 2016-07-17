<?php

namespace Common\Util;

/**
 * 装箱的方法
 *
 * @author zhipeng
 *
 * Class Common_Util_Value
 * @package Common\Util
 */
class Common_Util_Value
{
    private $_value;

    /**
     * 构造方法
     *
     * @param mixed $value
     * @return Common_Util_Value
     */
    static function create($value)
    {
        return new self ($value);
    }

    /**
     * Common_Util_Value constructor.
     * @param mixed $value
     */
    function __construct($value)
    {
        $this->_value = $value;
    }

    /**
     * @return mixed
     */
    function int_value()
    {
        return intval($this->_value);
    }

    /**
     * @return mixed
     */
    function double_value()
    {
        return doubleval($this->_value);
    }

    function float_value()
    {
        return floatval($this->_value);
    }

    function string_value()
    {
        return strval($this->_value);
    }

    function bool_value()
    {
        return boolval($this->_value);
    }

    /**
     * 原始数据
     */
    function value()
    {
        return $this->_value;
    }

    function is_null()
    {
        return is_null($this->_value);
    }

    function __clone()
    {
        dump("__clone");
    }
}