<?php

/**
 * 快速判断key是否存在
 * @param string $key
 * @param array $array
 * @return bool
 */
function array_key_exists_faster($key, $array)
{
//    dump_stack();
    return (isset ($arr [$key]) || array_key_exists($key, $array));
}

function time2()
{
    return time();
}

if (!function_exists('getConfigData')) {

    /**
     * 获取配置
     * @param $configdataclass
     * @param $index
     * @param $key
     * @param null $default_value
     * @return array|null
     */
    function getConfigData($configdataclass, $index, $key, $default_value = NULL)
    {
        return \Common\Util\Common_Util_Configdata::getInstance()->getconfigdata($configdataclass, $index, $key, $default_value);
    }


    /**
     * 获取全局配置
     * @param $key
     * @return \Common\Util\Common_Util_Value
     */
    function getGlobalValue($key)
    {
        return \Common\Util\Common_Util_Configdata::getInstance()->get_global_config_value($key);
    }

    /**
     * @param $langId
     * @param array $params
     * @param string $locate
     * @return string
     */
    function getLanguage($langId, array $params = [], $locate = 'zn')
    {
        return \Common\Util\Common_Util_Configdata::getInstance()->get_lang($langId, $params, $locate);
    }
}

if (!function_exists('logicError')) {

    /**
     * 逻辑错误
     * @param $ErrorCode
     * @param $ErrorString
     * @param array $ErrorData
     * @throws \hellaEngine\exception\exception_logicError
     */
    function logicError($ErrorCode, $ErrorString, array $ErrorData = [])
    {

        throw new \hellaEngine\exception\exception_logicError($ErrorString,
            $ErrorCode,
            $ErrorData,
            (C(configure_constants::DEBUG))
        );
    }


    /**
     * 逻辑错误条件表达式
     * @param $condition false:抛出异常 true 继续执行
     * @param $ErrorCode
     * @param $ErrorString
     * @param array $ErrorData
     * @throws \hellaEngine\exception\exception_logicError
     */
    function logicErrorCondition($condition, $ErrorCode, $ErrorString, array $ErrorData = [])
    {
        if (!$condition) {
            logicError($ErrorCode, $ErrorString, $ErrorData);
        }
    }


    /**
     * @param $value
     * @param int $maxCharCount
     * @param int $minCharCount
     * @throws \hellaEngine\exception\exception_logicError
     */
    function typeCheckString(&$value, $maxCharCount = -1, $minCharCount = -1)
    {
        if (!is_string($value)) {
            logicError(\hellaEngine\err\err_typeCheck::NOT_STRING,
                'string type error');
        }
        $value = strval($value);
        $len = -1;
        if ($minCharCount != -1) {
            $len = iconv_strlen($value, "UTF-8");
            logicErrorCondition($len >= $minCharCount,
                \hellaEngine\err\err_typeCheck::STRING_LEN_SMALL,
                'string too short limit ' . $minCharCount);
        }
        if ($maxCharCount != -1) {
            $len = $len == -1 ? iconv_strlen($value, "UTF-8") : $len;
            logicErrorCondition($len <= $maxCharCount
                , \hellaEngine\err\err_typeCheck::STRING_LENGTH_LARGE,
                'string too large limit ' . $maxCharCount);
        }
    }

    /**
     * 检测是否是Json字符串
     * @param $value
     * @throws \hellaEngine\exception\exception_logicError
     */
    function typeCheckJsonString($value)
    {
        logicErrorCondition(json_decode($value) !== null,
            \hellaEngine\err\err_typeCheck::STRING_NOT_JSON,
            'is not json string');
    }

    /**
     * @param $value
     * @param int $minValue
     * @param int $maxValue
     * @throws \hellaEngine\exception\exception_logicError
     */
    function typeCheckNumber(&$value, $minValue = null, $maxValue = null)
    {
        if (!is_numeric($value)) {
            logicError(20003, 'number type error');
        }
        $value = intval($value);
        if ($minValue !== null) {
            logicErrorCondition($value >= $minValue,
                \hellaEngine\err\err_typeCheck::NUMBER_TOO_SMALL,
                'number too small min:' . $minValue);
        }
        if ($maxValue != null) {
            logicErrorCondition($value <= $maxValue,
                \hellaEngine\err\err_typeCheck::NUMBER_TOO_LARGE,
                'number too large max:' . $maxValue);
        }
    }

    /**
     * choice
     * @param $value
     * @param array $Choices
     * @throws \hellaEngine\exception\exception_logicError
     */
    function typeCheckChoice($value, array $Choices)
    {
        foreach ($Choices as $choice) {
            if ($choice === $value) {
                return;
            }
        }
        logicError(\hellaEngine\err\err_typeCheck::NOT_IN_CHOICES,
            'not choice item');
    }

    /**
     * 检测Userd是否合法
     * @param $value
     * @throws \hellaEngine\exception\exception_logicError
     */
    function typeCheckUserId(&$value)
    {
        typeCheckString($value, 64);
//        typeCheckGUID($value);
    }

    /**
     * 检测是否是生成的各种GUID
     * @param $value
     * @throws \hellaEngine\exception\exception_logicError
     */
    function typeCheckGUID(&$value)
    {
        typeCheckString($value, 64, 32);
    }
}

if (!function_exists('logicSuccess')) {
    /**
     * 逻辑成功
     * @param array $data
     * @param int $Code
     * @param string $CodeString
     * @throws \hellaEngine\exception\exception_logicError
     */
    function logicSuccess(array $data, $Code = 0, $CodeString = "SUCC")
    {
        throw new \hellaEngine\exception\exception_logicSucc($data, $CodeString, $Code);
    }
}
