<?php

namespace dbs;

use Common\Db\Common_Db_memcached;
use Common\Util\Common_Util_Guid;
use Common\Util\Common_Util_LockInterface;
use Common\Util\Common_Util_LockMemcache;
use constants\constants_configure;
use constants\constants_memcachekey;
use dbs\i\dbs_i_iSync;
use dbs\i\dbs_i_iUpdate;
use dbs\push\dbs_push_player;
use dbs\recharge\dbs_recharge_player;


/**
 * 玩家容器类
 *
 * @author zhipeng
 *
 */
final class dbs_player implements dbs_i_iUpdate, dbs_i_iSync
{

    /**
     * 活动db
     *
     * @var array
     */
    private $hot_db = [];

    /**
     * 数据访问锁
     *
     * @var Common_Util_LockInterface
     */
    private $_lock = NULL;

    /**
     * 当前操作的用户userid
     *
     * @var string
     */
    private $userid;

    /**
     * 用户是否存在
     *
     * @var boolean
     */
    private $accountExist = false;

    /**
     * 语意方法,用户是否存在
     *
     * @return boolean
     */
    public function isRoleExists()
    {
        return $this->accountExist && dbs_role::createWithPlayer($this)->exist();
    }

    /**
     *
     * @param bool $value
     */
    private function set_accountExists($value)
    {
        $value = boolval($value);
        $this->accountExist = $value;
    }

    /**
     * 账号是否存在,也就是是否有account,不一定存在角色
     */
    public function isAccountExists()
    {
        return $this->accountExist;
    }

    /**
     * 获取userid
     */
    public function get_userid()
    {
        return $this->userid;
    }

    /**
     * 设置userid
     *
     * @param string $value
     */
    private function set_userid($value)
    {
        $value = strval($value);
        $this->userid = $value;

    }

    /**
     * 删除用户id
     */
    private function unset_userid()
    {
        $this->userid = null;
        $this->set_accountExists(false);
    }

    /**
     * 是否只读,如果
     *
     * @var bool
     */
    private $readonly = FALSE;

    /**
     * 是否只读,也就是所有的数据都不能写
     *
     * @return boolean
     */
    public function is_readonly()
    {
        return $this->readonly;
    }

    private function set_readonly($value)
    {
        $this->readonly = boolval($value);
    }


    function __destruct()
    {
        $this->dispose();
    }

    /**
     * 是否已经释放
     *
     * @var bool
     */
    private $dispose = false;

    protected function dispose()
    {
        if (!$this->dispose) {
            $this->dispose = true;
            $this->unlock();
        }
    }

    /**
     * @inheritDoc
     */
    function __sleep()
    {
        return array_diff(array_keys(get_object_vars($this)), ['_lock', 'hot_db']);
    }


    /**
     * 用户池
     *
     * @var array
     */
    protected static $player_poll = [];

    /**
     * 创建用户实例
     *
     * @param string $userid
     * @param boolean $isLogin
     *            是否是登陆设置,一般new出来的不是登陆的用户,只有setCallerUserid生成的才是
     * @param boolean $readonly
     *            是否只读
     * @return dbs_player
     */
    private static function newplayer($userid = NULL, $isLogin = FALSE, $readonly = FALSE)
    {

        if (empty ($userid)) {
            return new dbs_player ();
        } else {

            /**
             * @param $userid
             * @param $isLogin
             * @param $readonly
             * @return dbs_player
             */
            $create_newPlayer = function ($userid, $isLogin, $readonly) {
                $playerIns = new dbs_player ();
                self::$player_poll [$userid] = $playerIns;
                $playerIns->set_readonly($readonly);
                $playerIns->loginWithUserid($userid, $isLogin);
                return $playerIns;
            };

            // 已经存在缓存中
            if (isset (self::$player_poll [$userid])) {

                // 不能从只读变成可读写
                // 从 只读 变为可读写
                if ($readonly == FALSE && self::$player_poll [$userid]->readonly != $readonly) {
                    unset (self::$player_poll [$userid]);
                    return $create_newPlayer ($userid, $isLogin, $readonly);
                } else {
                    return self::$player_poll [$userid];
                }
            } else {
                return $create_newPlayer ($userid, $isLogin, $readonly);
            }
        }
    }

    /**
     * 创建新的第三方用户,如果是主用户,还是返回主用户,助手方法
     * 主要返回一个 只读的 其它非主用户
     *
     * @param string $userid
     *            是否只读
     * @return \dbs\dbs_player
     */
    static function newGuestPlayer($userid)
    {
        return self::newplayer($userid, false, true);
    }

    /**
     * 读写占用生成第三方用户
     *
     * @param string $userid
     * @return \dbs\dbs_player
     */
    static function newGuestPlayerWithLock($userid)
    {
        return self::newplayer($userid, false, false);
    }

    /**
     * 本次操作的主体用户
     *
     * @param string $UserId
     *            用户id
     * @return \dbs\dbs_player
     */
    static function newMasterPlayer($UserId)
    {

        self::$masterUserId = $UserId;
        return self::newplayer($UserId, true, false);
    }

    private static $masterUserId = null;

    /**
     * 获取本次主用户
     * @return dbs_player|null
     */
    static function getMasterPlayer()
    {
        if (is_null(self::$masterUserId)) {
            return null;
        }
        return self::newplayer(self::$masterUserId, true, false);
    }

    /**
     * 释放所有第三方用户
     */
    static function disposeAllGuestPlayer()
    {
        foreach (self::$player_poll as $userId => $playerIns) {
            if ($playerIns instanceof self) {
                if (!$playerIns->isMasterPlayer()) {
                    $playerIns->dispose();
                    unset (self::$player_poll [$userId]);
                }
            }
        }
    }

    /**
     * 释放用户缓冲
     */
    static function disposeAllPlayer()
    {
        foreach (self::$player_poll as $userid => $playerIns) {
            if ($playerIns instanceof self) {
                $playerIns->update_aftercall();
            }
        }
        foreach (self::$player_poll as $userid => $playerIns) {
            if ($playerIns instanceof self) {
                $playerIns->dispose();
            }
            unset (self::$player_poll [$userid]);
        }
    }


    /**
     * 是否是主用户,也就是本次操作的用户
     *
     * @var bool
     */
    private $isMasterPlayer = FALSE;

    /**
     * 是否是主用户,也就是本次操作的用户
     *
     * @return bool
     */
    function isMasterPlayer()
    {
        return $this->isMasterPlayer;
    }

    /**
     * 通过userid登陆
     *
     * @param string $userid
     *            用户id
     * @param string $isMaster
     *            是否是主用户登录
     * @return bool
     */
    private function loginWithUserid($userid, $isMaster)
    {
        if (self::getVerifyFromUserid($userid) !== FALSE) {
            //从Verify获取用户
            $login = true;
        } else {
            // 判断缓存中是否有用户信息了
            $account = dbs_account::getByUserId($userid);
            $login = $account->exist();
        }

        if ($login) {
            $this->isMasterPlayer = $isMaster;
            // 设置用户id
            $this->set_userid($userid);
            $this->set_accountExists(true);

            // 加锁
            if (!$this->lock()) {
                // 加锁失败
                $this->unset_userid();
                $this->set_accountExists(false);
            } else {
                // 执行用户update
                $this->update_beforecall();
            }
        }
        return $login;
    }


    /**
     * 获取锁
     * @return Common_Util_LockInterface|Common_Util_LockMemcache
     */
    private function getLock()
    {
        if (is_null($this->_lock)) {
            $lock_key = "player_" . $this->get_userid();
            $this->_lock = Common_Util_LockMemcache::newlock();
            $this->_lock->set_key($lock_key);
        }
        return $this->_lock;
    }

    /**
     * 加锁
     *
     * @return boolean
     */
    private function lock()
    {
        if ($this->readonly) {
            return true;
        }
        if (empty ($this->get_userid())) {
            return false;
        }

        $ret = $this->getLock()->lock();

        return $ret;
    }

    /**
     * 解锁
     */
    private function unlock()
    {
        if ($this->readonly) {
            return true;
        }
        if (empty ($this->get_userid())) {
            return false;
        }
        return $this->getLock()->unlock();
    }

    /**
     * 添加用户信息到缓存中
     *
     * @param string $userid
     * @return NULL|string 返回verify
     */
    public static function addUseridToCache($userid = '')
    {
        if (!is_string($userid)) {
            return null;
        }
        $cacheKey = constants_memcachekey::DBKey_Verify_Userid . $userid;
        $memcache = Common_Db_memcached::getInstance();

        $verify = $memcache->get($cacheKey);

        $cachetime = C(constants_configure::VERIFY_CACHE_TIME);

        // dump ( C ( \configure_constants::DEBUG ) );
        if (C(\configure_constants::DEBUG)) {
            // 测试期间,重复登陆不生成新的verify
            // 30d 永久有效
            $cachetime = 30 * 60 * 60 * 24;
        }

        // 生成新的verify
        if ($verify === FALSE) {
            $verify = Common_Util_Guid::gen_verify();
            // 写入登陆缓存中
            $memcache->set($cacheKey, $verify, $cachetime);
            $memcache->set($verify, $userid, $cachetime);
        }
        return $verify;
    }

    /**
     * 从缓存中获取用户id
     *
     * @param string $verify
     * @param boolean $updateVerifyTime
     *            是否延续缓存时间,应该是在登录的时候延续
     * @return false|string
     */
    public static function getUseridFromCache($verify = '', $updateVerifyTime = FALSE)
    {
        if (empty ($verify)) {
            return false;
        }
        $memcache = Common_Db_memcached::getInstance();
        $userid = $memcache->get($verify);
        if ($updateVerifyTime && $userid !== FALSE) {
            $cacheTime = C(constants_configure::VERIFY_CACHE_TIME);
            if (!C(\configure_constants::DEBUG)) {
                // 如果不是调试状态
                $cacheTime = 30 * 60 * 60 * 24;
            }
            $cacheKey = constants_memcachekey::DBKey_Verify_Userid . $userid;
            $memcache->set($cacheKey, $verify, $cacheTime);
            $memcache->set($verify, $userid, $cacheTime);
        }
        return $userid;
    }

    /**
     * 通过userid获取verify,实际中没有这种需求,只是调试的时候需要
     *
     * @param string $userid
     * @return string:
     */
    public static function getVerifyFromUserid($userid)
    {
        $cacheKey = constants_memcachekey::DBKey_Verify_Userid . $userid;
        $memcache = Common_Db_memcached::getInstance();
        $verify = $memcache->get($cacheKey);
        return $verify;
    }

    /**
     * 通过userid 删除verify
     *
     * @param string $userid
     * @return true
     */
    public static function removeVerifyFromUserid($userid)
    {
        $cacheKey = constants_memcachekey::DBKey_Verify_Userid . $userid;
        $memcache = Common_Db_memcached::getInstance();
        $verify = $memcache->get($cacheKey);
        $result = false;
        if ($verify) {
            // 删除用户键缓存
            $result = $memcache->delete($cacheKey);
            // 删除verify到userid的反向查询
            $result = $memcache->delete($verify);
        }
        return $result;
    }

    /**
     * 需要每次调用访问的数据库,调用每个类的update方法,慎用,这个是全局的,相当于Tick
     *
     * @var array
     */
    private static $_update_dbarr = array(
        dbs_sync::class
    );
    /**
     * 目前应该只有一个,就是同步服务
     *
     * @var array
     */
    private static $_sync_dbarr = array(
        dbs_sync::class
    );

    function update_beforecall()
    {
        if (!$this->isMasterPlayer()) {
            return;
        }

        foreach (self::$_update_dbarr as $value) {
            $db = $this->loadDbInstance($value);
            $db->update_beforecall();
        }
    }

    function update_aftercall()
    {
        if (!$this->isMasterPlayer()) {
            return;
        }
        foreach (self::$_update_dbarr as $value) {
            $db = $this->loadDbInstance($value);
            $db->update_aftercall();
        }
    }

    function sync()
    {
        if (!$this->isMasterPlayer()) {
            return;
        }
        foreach (self::$_sync_dbarr as $value) {
            $db = $this->loadDbInstance($value);
            $db->sync();
        }
    }

    function beforecall()
    {
    }

    /**
     * 数据库生成器
     *
     * @param string $moduleName 数据库名称
     * @return dbs_baseplayer|NULL
     */
    protected function m($moduleName)
    {
        $module = NULL;
        if (isset($this->hot_db[$moduleName])) {
            $module = $this->hot_db [$moduleName];
        } else {
            if (class_exists($moduleName)) {
                $module = new $moduleName ();
                $this->hot_db [$moduleName] = $module;
                if ($module instanceof dbs_baseplayer) {
                    $module->set_owner($this);
                } else {
                    throw new \LogicException("moduleType Error");
                }
            }
        }
        return $module;
    }

    /**
     * 获取说句模块
     *
     * @param string $dbsClassName
     * @return dbs_baseplayer
     */
    public function getDbModule($dbsClassName)
    {
        return $this->loadDbInstance($dbsClassName);
    }

    /**
     * 自动加载的db
     *
     * @param string $name
     * @return dbs_baseplayer
     */
    protected function loadDbInstance($name)
    {


        $db = $this->m($name);
        if (is_null($db)) {
            return $db;
        }
        // 如果已经有数据了,不重复加载
        //已经从数据库中加载过了,或者有数据
        if ($db->isLoadedFromDb() || $db->exist()) {
            return $db;
        }
        if (!empty ($this->get_userid()) && empty ($db->get_userid())) {
            $db->set_userid($this->get_userid());
        }
        // 设置数据库是否只读
        $db->set_readonly($this->is_readonly());
        $ret = $db->loadFromDB();
        if ($ret) {
            $db->beforecall();
            if ($db instanceof dbs_baseplayer && $this->isMasterPlayer) {
                $db->masterbeforecall();
            }
        }

        return $db;
    }

    /**
     *
     * @return dbs_sync
     */
    function db_sync()
    {
        return $this->loadDbInstance(dbs_sync::class);
    }


    /**
     *
     * @return dbs_recharge_player
     */
    function dbs_recharge_player()
    {
        return $this->loadDbInstance(dbs_recharge_player::class);
    }

    /**
     *
     * @return dbs_deviceinfo
     */
    function dbs_deviceinfo()
    {
        return $this->loadDbInstance(dbs_deviceinfo::class);
    }

    /**
     *
     * @return dbs_push_player
     */
    function dbs_pushplayer()
    {
        return $this->loadDbInstance(dbs_push_player::class);
    }


}
