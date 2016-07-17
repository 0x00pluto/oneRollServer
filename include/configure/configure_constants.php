<?php

/**
 * 配置常量
 * @author zhipeng
 *
 */
class configure_constants
{
    /**
     * 当前应用的命名空间
     *
     * @example apps\gameweb
     */
    const APP_NAMESPACE = "APP_NAMESPACE";
    /**
     * 当前应用路径,自动设置
     *
     * @var
     */
    const APP_PATH = "APP_PATH";

    /**
     * htdocs 路径
     *
     * @var
     */
    const HTDOCS_PATH = "HTDOCS_PATH";

    /**
     * include path
     *
     * @var
     */
    const INCLUDE_PATH = "INCLUDE_PATH";

    /**
     * log path
     *
     * @var
     */
    const LOG_PATH = "LOG_PATH";
    /**
     * 调试开关
     *
     * @var
     */
    const DEBUG = "DEBUG";
    /**
     * 是否开启dump功能
     *
     * @var
     */
    const DUMP_ENABLE = "DUMP_ENABLE";
    /**
     * php性能调试
     *
     * @var
     */
    const PHP_PROFILE = "PHP_PROFILE";
    /**
     * 是否调试脏数据
     *
     * @var
     */
    const DEBUG_DB = "DEBUG_DB";
    /**
     * 数据调试脏数据Global变量中返回值
     *
     * @var
     */
    const DEBUG_DB_DIRTY_KEY = "DEBUG_DB_DIRTY_KEY";
    /**
     * DB库名称
     *
     * @var
     */
    const Const_DB_Name = "Const_DB_Name";
    /**
     * 数据库连接
     *
     * @var
     */
    const Const_DB_Connection = "Const_DB_Connection";
    /**
     *
     * @var
     */
    const MEMCACHE_HOST = "MEMCACHE_HOST";
    const MEMCACHE_PORT = "MEMCACHE_PORT";
    const MEMCACHE_EXPIRATION = "MEMCACHE_EXPIRATION";
    const MEMCACHE_PREFIX = "MEMCACHE_PREFIX";
    const MEMCACHE_COMPRESSION = "MEMCACHE_COMPRESSION";

    /**
     * 是否开启定时服务,默认为false
     *
     * @var
     */
    const ENABLE_SCHEDULE = "ENABLE_SCHEDULE";

    /**
     * 同时处理消息的最大数量
     *
     * @var
     */
    const ONCE_PROCESS_MESSAGE_MAX_COUNT = 'ONCE_PROCESS_MESSAGE_MAX_COUNT';

    /**
     * 日志服务器数据库连接
     *
     * @var string
     */
    const Const_LOGDB_Connection = "Const_LOGDB_Connection";

    /**
     * RSYSLOG_SERVER_IP 服务器ip
     *
     * @var
     */
    const RSYSLOG_SERVER_IP = "RSYSLOG_SERVER_IP";
}

