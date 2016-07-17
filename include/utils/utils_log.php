<?php

namespace utils;

use Common\Util\Common_Util_Log;
use Monolog\Logger;

class utils_log
{
    /**
     * 用户登录
     *
     * @var
     */
    const LOGTYPE_USERLOGIN = 'LOGTYPE_USERLOGIN';

    /**
     * 用户登出
     *
     * @var
     */
    const LOGTYPE_USERLOGOUT = 'LOGTYPE_USERLOGOUT';

    /**
     * 改变钻石数量
     *
     * @var
     */
    const LOGTYPE_ADDDIAMOND = 'LOGTYPE_ADDDIAMOND';
    /**
     * 改变钻石数量
     *
     * @var
     */
    const LOGTYPE_COSTDIAMOND = 'LOGTYPE_COSTDIAMOND';

    /**
     * 改变游戏币
     *
     * @var
     */
    const LOGTYPE_ADDGAMECOIN = 'LOGTYPE_ADDGAMECOIN';
    /**
     * 改变游戏币
     *
     * @var
     */
    const LOGTYPE_COSTGAMECOIN = 'LOGTYPE_COSTGAMECOIN';

    /**
     * 增加声望
     *
     * @var
     */
    const LOGTYPE_ADD_REPUTATION = 'LOGTYPE_ADD_REPUTATION';
    /**
     * 减少声望
     *
     * @var
     */
    const LOGTYPE_COST_REPUTATION = 'LOGTYPE_COST_REPUTATION';

    /**
     * 钻石购买道具
     *
     * @var
     */
    const LOGTYPE_DIAMONDBUYITEM = 'LOGTYPE_DIAMONDBUYITEM';
    /**
     * 充值
     *
     * @var
     */
    const LOGTYPE_RECHAGRE = 'LOGTYPE_RECHAGRE';

    /**
     * 开启新手引导
     *
     * @var string
     */
    const LOGTYPE_USERGUIDE_BEGIN = 'LOGTYPE_USERGUIDE_BEGIN';

    /**
     * 结束新手引导
     *
     * @var string
     */
    const LOGTYPE_USERGUIDE_END = 'LOGTYPE_USERGUIDE_END';

    /**
     */
    private function __construct()
    {
        $this->logger = Common_Util_Log::getInstance()->getGameRecordLogger();
        $this->crashlogger = Common_Util_Log::getInstance()->getCrashLogger();
    }

    /**
     *
     * @var Logger
     */
    private $logger = null;
    private $crashlogger = null;
    /**
     * singleton
     */
    private static $_instance;

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof static)) {
            self::$_instance = new static ();
        }
        return self::$_instance;
    }

    /**
     * 记录日志
     *
     * @param string $logtype
     *            见常量
     * @param string $userid
     *            用户id
     * @param array $info
     */
    function gamelog($logtype, $userid = NULL, array $info = [])
    {
        $logPrefix = $logtype;
        if (!empty ($userid)) {
            $logPrefix .= " " . $userid;
        }
        $this->logger->info($logPrefix, $info);
    }

    /**
     * 记录崩溃日志
     *
     * @param $logtype
     * @param string $userid
     * @param array $info
     */
    function crashlog($userid = NULL, array $info = [])
    {
        $logPrefix = 'CRASH';
        if (!empty ($userid)) {
            $logPrefix .= " " . $userid;
        }
        $this->crashlogger->info($logPrefix, $info);
    }
}