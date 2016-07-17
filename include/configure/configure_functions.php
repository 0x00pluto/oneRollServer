<?php

/**
 * 设置或者获取全局变量
 * @param string $name 全局变量的名称
 * @param string $value 如果为默认值,则为获取操作
 * @param string $default 默认值
 * @return mixed
 */
function C($name = null, $value = null, $default = null)
{
    static $_config = array();
    // 无参数时获取所有
    if (empty ($name)) {
        return $_config;
    }
    // 优先执行设置获取或赋值
    if (is_string($name)) {
        if (is_null($value)) {
            return isset ($_config [$name]) ? $_config [$name] : $default;
        } else {
            $_config [$name] = $value;
            return $value;
        }
    } elseif (is_array($name)) {
        // 批量设置
        $_config = array_merge($_config, $name);
        return null;
    }
    return null; // 避免非法参数
}

/**
 * 加载配置文件 支持格式转换 仅支持一级配置
 *
 * @param string $file
 *            配置文件名
 * @param string $parse
 *            配置解析方法 有些格式需要用户自己解析
 * @return array
 */
function load_config($file)
{
    if (!file_exists($file)) {
        return;
    }
    static $loaded_files = [];
    if (isset ($loaded_files [$file])) {
        return;
    }
    $loaded_files [$file] = true;

    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $configarr = [];
    switch ($ext) {
        case 'php' :
            $configarr = require $file;
            break;
        default :
            break;
    }

    if (is_array($configarr)) {
        C($configarr);
    }
}