<?php

namespace Common\Util;

use MongoDB\Driver\Manager;
use Monolog\ErrorHandler;
use Monolog\Handler\MongoDBHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Logger;

/**
 *
 * @package common
 * @subpackage util
 * @author kain
 *
 */

/**
 * 简单日志工具
 */
class Common_Util_Log
{

    /**
     * Detailed debug information
     */
    const DEBUG = Logger::DEBUG;

    /**
     * Interesting events
     *
     * Examples: User logs in, SQL logs.
     */
    const INFO = Logger::INFO;

    /**
     * Uncommon events
     */
    const NOTICE = Logger::NOTICE;

    /**
     * Exceptional occurrences that are not errors
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    const WARNING = Logger::WARNING;

    /**
     * Runtime errors
     */
    const ERROR = Logger::ERROR;

    /**
     * Critical conditions
     *
     * Example: Application component unavailable, unexpected exception.
     */
    const CRITICAL = Logger::CRITICAL;

    /**
     * Action must be taken immediately
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    const ALERT = Logger::ALERT;

    /**
     * Urgent alert.
     */
    const EMERGENCY = Logger::EMERGENCY;

    /**
     * 普通游戏日志
     *
     * @var \Monolog\Logger
     */
    private $_logger;

    /**
     * 记录游戏日志
     *
     * @var \Monolog\Logger
     */
    private $gameRecordLogger;

    /**
     * 客户端崩溃收集器
     *
     * @var \Monolog\Logger
     */
    private $crashLogger;
    private $serverErrorLogger;

    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
        // echo 'This is a Constructed method;';


//        $mongo = new Manager(C(\configure_constants::Const_LOGDB_Connection), [
//            'db' => 'logsystem'
//        ]);
//        $mongo = new \MongoClient (C(\configure_constants::Const_LOGDB_Connection), [
//            'db' => 'logsystem'
//        ]);

        $rsyslogIP = C(\configure_constants::RSYSLOG_SERVER_IP);

        $this->_logger = new Logger ('debug_logger');
        $this->_logger->pushHandler(new StreamHandler (C(\configure_constants::LOG_PATH) . 'game_debug.log', Logger::DEBUG));
        $this->_logger->pushHandler(new StreamHandler (C(\configure_constants::LOG_PATH) . 'game_info.log', Logger::INFO));
        $this->_logger->pushHandler(new StreamHandler (C(\configure_constants::LOG_PATH) . 'game_error.log', Logger::ERROR));
        $this->_logger->pushHandler(new StreamHandler (C(\configure_constants::LOG_PATH) . 'game_error.log', Logger::WARNING));

        // 服务器错误日志
        $this->serverErrorLogger = new Logger ('server_Error_Logger');
        $this->serverErrorLogger->pushHandler(new SyslogUdpHandler ($rsyslogIP, 514, LOG_LOCAL2, Logger::DEBUG));
        $this->serverErrorLogger->pushHandler(new SyslogUdpHandler ($rsyslogIP, 514, LOG_LOCAL2, Logger::INFO));
        $this->serverErrorLogger->pushHandler(new SyslogUdpHandler ($rsyslogIP, 514, LOG_LOCAL2, Logger::NOTICE));
        $this->serverErrorLogger->pushHandler(new SyslogUdpHandler ($rsyslogIP, 514, LOG_LOCAL2, Logger::WARNING));
        $this->serverErrorLogger->pushHandler(new SyslogUdpHandler ($rsyslogIP, 514, LOG_LOCAL2, Logger::ERROR));
        ErrorHandler::register($this->serverErrorLogger);

        // 游戏统计日志
        $this->gameRecordLogger = new Logger ('gameRecordLogger');
        // $this->gameRecordLogger->pushHandler ( new RotatingFileHandler ( C ( \configure_constants::LOG_PATH ) . "game_record.log", 0, Logger::INFO ) );
        $this->gameRecordLogger->pushHandler(new SyslogUdpHandler ($rsyslogIP, 514, LOG_LOCAL0));
//        $this->gameRecordLogger->pushHandler(new MongoDBHandler ($mongo, 'logsystem', 'gameRecordLog'));

        // 客户端崩溃日志
//        $this->crashLogger = new Logger ('clientCrashLog');
//         $this->crashLogger->pushHandler ( new RotatingFileHandler ( C ( \configure_constants::LOG_PATH ) . "crash.log", 0, Logger::INFO ) );
//        $this->crashLogger->pushHandler(new SyslogUdpHandler ($rsyslogIP, 514, LOG_LOCAL1));
//        $this->crashLogger->pushHandler(new MongoDBHandler ($mongo, 'logsystem', 'crashRecordLog'));
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }
    // 单例方法,用于访问实例的公共的静态方法
    /**
     *
     * @return \Common\Util\Common_Util_Log
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof static)) {
            self::$_instance = new static ();
        }
        return self::$_instance;
    }

    /**
     *
     * @return \Monolog\Logger
     */
    public static function getLogger()
    {
        return self::getInstance()->_logger;
    }

    /**
     *
     * @return \Monolog\Logger
     */
    public function getGameRecordLogger()
    {
        return $this->gameRecordLogger;
    }

    /**
     *
     * @return \Monolog\Logger
     */
    public function getCrashLogger()
    {
        return $this->crashLogger;
    }

    /**
     * @param $recordType
     * @param array $context
     */
    public static function recordDebug($recordType, array $context = [])
    {
        self::record(self::DEBUG, $recordType, $context);
    }

    /**
     * 记录日志
     *
     * @param int $level
     * @param string $recordtype
     * @param mixed $context
     *            可以为数组 或者任意内容
     */
    public static function record($level, $recordtype, $context = [])
    {
        $recodecontext = [];
        if (is_array($context)) {
            $recodecontext = $context;
        } elseif (is_object($context)) {
            $recodecontext = [
                var_export($context, true)
            ];
        } else {
            $recodecontext = [
                $context
            ];
        }

        if (true) {
            $debuginfo = debug_backtrace();
            $debuginfo = $debuginfo [1];
            $lineinfo = $debuginfo ["file"] . ":" . $debuginfo ['line'];
            $recodecontext ['lineinfo'] = $lineinfo;
        }

        self::getLogger()->addRecord($level, $recordtype, $recodecontext);

        // 如果在调试中,则显示出来
        // if (C ( \configure_constants::DUMP_ENABLE )) {
        // dump ( [
        // 'message' => $recordType,
        // 'context' => $context
        // ], false, 1 );
        // }
    }

    /**
     * 记录错误日志
     * @param $recordType
     * @param array $context
     */
    public static function record_error($recordType, $context = [])
    {
        self::getInstance()->serverErrorLogger->addError($recordType, $context);

    }
}

?>