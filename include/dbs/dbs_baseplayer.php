<?php

namespace dbs;

use Common\Db\Common_Db_memcacheObject;
use Common\Db\Common_Db_mongo;
use constants\constants_db;
use constants\constants_defaultvalue;
use dbs\i\dbs_i_iSync;
use dbs\i\dbs_i_iUpdate;

/**
 * 玩家数据基础类,也就是依附于玩家本身的类
 *
 * @author zhipeng
 *
 */
abstract class dbs_baseplayer extends dbs_base implements dbs_i_iUpdate, dbs_i_iSync
{

    /**
     * 用户id
     *
     * @var string
     */
    const DBKey_userid = "userid";

    /**
     * 获取用户id
     * @return string
     */
    public function get_userid()
    {
        return $this->getdata(self::DBKey_userid);
    }

    /**
     * 设置用户id
     *
     * @param  $value
     */
    public function set_userid($value)
    {
        $this->setdata(self::DBKey_userid, $value);
    }

    /**
     * 数据库宿主
     *
     * @var dbs_player
     */
    protected $db_owner;

    /**
     * 初始化
     */
    protected function bootstrap()
    {
        $this->set_primary_key([self::DBKey_userid]);
        $this->set_defaultkeyandvalue(self::DBKey_userid, constants_defaultvalue::USERID_EMPTY);
        $this->configure();
        $this->ensureIndex(
            [
                self::DBKey_userid => 1
            ], true);
    }


    /**
     * 设置数据库宿主
     *
     * @param dbs_player $db_owner
     */
    public function set_owner($db_owner)
    {
        $this->db_owner = $db_owner;
    }

    /**
     * 通过userid填充数据
     * @param Common_Db_mongo $db
     * @param $userId
     */
    protected function loadFromDBbyUserId(Common_Db_mongo $db, $userId)
    {
        $userId = strval($userId);
        $ret = $db->query($this->get_tablename(), array(
            self::DBKey_userid => $userId
        ), [], 1);
        $retCount = count($ret);
        if ($retCount == 0) {
            // 没有数据
        } else {
            $this->fromDBData($ret [0]);
        }
    }

    /**
     * @param Common_Db_mongo $db
     */
    protected function onLoadingFromDB($db)
    {
        $this->loadFromDBbyUserId($db, $this->get_userid());
    }

    /**
     * 每次访问调用,当作为主用户的时候才调用,主要是time更新时候使用,就是在update使用调用
     */
    public function update_beforecall()
    {
    }

    public function update_aftercall()
    {
    }

    /**
     * (non-PHPdoc)
     * 同步调用,就是返回反向消息
     *
     * @see dbs_interface_iUpdate::sync()
     */
    public function sync()
    {
    }

    /**
     * (non-PHPdoc)
     *
     * @see dbs_interface_iUpdate::beforecall()
     */
    public function beforecall()
    {

    }

    /**
     * 主用户,每次调用类前的访问
     */
    function masterbeforecall()
    {
    }


    /**
     * 从用户身上加载实例
     * @param dbs_player|dbs_baseplayer $player 则是主用户
     * @return dbs_baseplayer|null|static
     */
    static function createWithPlayer($player)
    {
        if ($player instanceof dbs_baseplayer) {
            $player = $player->db_owner;
        }
        if (is_null($player)) {
            $player = dbs_player::getMasterPlayer();
        }
        $ins = $player->getDbModule(static::class);
        if ($ins instanceof static) {
            return $ins;
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function saveToDbAfter(Common_Db_mongo $db)
    {
        $this->clearCacheObject();
    }

    private function clearCacheObject()
    {
        if ($this->enableCache) {
            Common_Db_memcacheObject::delete($this->getCacheObjectKey());
        }
    }

    /**
     * 获取缓存的Key
     * @return string
     */
    protected function getCacheObjectKey()
    {
        $cacheKey = "ObjectCache_" . static::class . "_" . $this->get_userid();
        return $cacheKey;
    }


    /**
     * 是否开启对象缓存
     * @var bool
     */
    private $enableCache = true;

    /**
     * @return boolean
     */
    public function isEnableCache()
    {
        return $this->enableCache;
    }

    /**
     * @param boolean $enableCache
     */
    public function setEnableCache($enableCache)
    {
        $this->enableCache = $enableCache;
    }

    /**
     * 获取缓存对象
     * @param $userId
     * @return dbs_baseplayer|null
     */
    static function getCacheObject($userId)
    {
        $cacheKey = "ObjectCache_" . static::class . "_" . $userId;
        $memCacheObject = Common_Db_memcacheObject::create($cacheKey);
        if ($memCacheObject->has_value()) {
            return unserialize($memCacheObject->get_value());
        }

        return null;
    }

    /**
     * 获取缓存对象,或者新建缓存
     * @param $userId
     * @return dbs_baseplayer|static|null
     * 如果为null 则是userid无效
     */
    static function getCacheObjectOrNew($userId)
    {
        $cacheObject = static::getCacheObject($userId);
        if (is_null($cacheObject)) {
            $cachePlayer = dbs_player::newGuestPlayer($userId);
            if (!$cachePlayer->isRoleExists()) {
                return null;
            }
            $cacheObject = static::createWithPlayer($cachePlayer)->cachedObject();
        }
        return $cacheObject;
    }


    /**
     * 缓存对象
     * @return $this
     */
    function cachedObject()
    {
        $this->setEnableCache(true);
        $cacheKey = $this->getCacheObjectKey();
        $memCacheObject = Common_Db_memcacheObject::create($cacheKey);
        $memCacheObject->setExpiration(300);
        $serializeString = serialize($this);
        $memCacheObject->set_value($serializeString);

        return $this;
    }


}