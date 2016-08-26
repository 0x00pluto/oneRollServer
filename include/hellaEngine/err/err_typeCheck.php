<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/2
 * Time: 上午11:29
 */

namespace hellaEngine\err;


/**
 * Class err_typeCheck
 * @package hellaEngine\err
 */
class err_typeCheck
{
    /**
     * 不是字符串
     */
    const NOT_STRING = 20000;
    /**
     * 字符串长度不够
     */
    const STRING_LEN_SMALL = 20001;
    /**
     * 字符串太长
     */
    const STRING_LENGTH_LARGE = 20002;

    /**
     * 不是数字
     */
    const NOT_NUMBER = 20003;
    /**
     * 数字太小
     */
    const NUMBER_TOO_SMALL = 20004;
    /**
     * 数字太大
     */
    const NUMBER_TOO_LARGE = 20005;

    /**
     * 不在选项中
     */
    const NOT_IN_CHOICES = 20006;

    /**
     * 字符串不是JSON
     */
    const STRING_NOT_JSON = 20007;
    /**
     * 不是数组
     */
    const NOT_AN_ARRAY = 20008;
}