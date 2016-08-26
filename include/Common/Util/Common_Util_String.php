<?php

namespace Common\Util;

class Common_Util_String
{
    /**
     * 计算UTF8长度
     *
     * @param string $string
     * @return number
     */
    static function utf8_strlen($string = null)
    {
        if (empty ($string)) {
            return 0;
        }

        return mb_strlen($string, "UTF-8");
    }

    static function utf8_trimAll($utf8String)
    {
        return preg_replace("/\s/", "", $utf8String);
    }

    /**
     * 删除所有空格
     *
     * @param string $str
     * @return mixed
     */
    static function trimAll($str)
    {
        return preg_replace("/\s/", "", $str);
    }
}