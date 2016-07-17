<?php

namespace Common\Util;

use configdata\configdata_csv_resources_setting;
use configdata\configdata_global_config;
use configdata\configdata_server_lang_setting;

class Common_Util_Configdata
{
    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
        // echo 'This is a Constructed method;';
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    /**
     *
     * @return \Common\Util\Common_Util_Configdata
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }

    private $__dataindex = [];

    /**
     * 创建缓存索引
     *
     * @param string $configDataClassName classname
     *            数据表
     * @param string $indexKey
     *            索引关键字
     * @return array
     */
    private function buildConfigData($configDataClassName, $indexKey)
    {
        $configDataClassName = strval($configDataClassName);
        $indexKey = strval($indexKey);
        if (isset($this->__dataindex[$configDataClassName])) {
            return $this->__dataindex [$configDataClassName];
        }
        $data_contains = [];
        foreach ($configDataClassName::data() as $value) {
            if (isset($value [$indexKey])) {
                $data_contains [$value [$indexKey]] = $value;
            }
        }
        $this->__dataindex [$configDataClassName] = $data_contains;
        return $this->__dataindex [$configDataClassName];
    }

    /**
     * 获取配置数据
     * @param $configDataClassName
     * @param $indexKey
     * @param $key
     * @param null $default_value
     * @return null
     */
    public function getconfigdata($configDataClassName, $indexKey, $key, $default_value = NULL)
    {
        $data_contains = $this->buildConfigData($configDataClassName, $indexKey);
        $key = strval($key);
        if (isset ($data_contains [$key])) {
            return $data_contains [$key];
        }
        return $default_value;
    }

    /**
     * 获取全局配置
     *
     * @param string $key
     * @param string $defaultvalue
     * @return null|string
     */
    public function get_global_config($key, $defaultvalue = NULL)
    {
        $value = $this->getconfigdata(
            configdata_global_config::class,
            configdata_global_config::k_key,
            $key, NULL);

        if (is_null($value)) {
            return $defaultvalue;
        } else {
            return $value ['value'];
        }
    }

    /**
     * 获取全局配置
     *
     * @param string $key
     * @param string $defaultvalue
     * @return Common_Util_Value
     */
    public function get_global_config_value($key, $defaultvalue = NULL)
    {
        return Common_Util_Value::create($this->get_global_config($key, $defaultvalue));
    }

    /**
     * 获取资源配置
     * @param $key
     * @param null $defaultValue 如果没有key的默认值
     * @return Common_Util_Value
     */
    public function getConfigSetting($key, $defaultValue = null)
    {
        $originalValue = $this->getconfigdata(configdata_csv_resources_setting::class,
            configdata_csv_resources_setting::k_key,
            $key,
            null);

        if (is_null($originalValue)) {
            return Common_Util_Value::create($defaultValue);
        } else {
            return Common_Util_Value::create($originalValue[configdata_csv_resources_setting::k_value]);
        }

    }

    /**
     * 获取语言
     *
     * @param string $langId
     * @param array $params
     *            replaceKey {'from'=>'to'}
     * @param string $locate
     * @return string
     */
    public function get_lang($langId, array $params = array(), $locate = 'zn')
    {
        $conf = $this->getconfigdata(configdata_server_lang_setting::class,
            configdata_server_lang_setting::k_languageid, $langId);
        if (is_null($conf)) {
            return "";
        }
        $langStr = "";

        if (isset ($conf [$locate])) {
            $langStr = $conf [$locate];
            $langStr = strtr($langStr, $params);
        }

        return $langStr;
    }
}

