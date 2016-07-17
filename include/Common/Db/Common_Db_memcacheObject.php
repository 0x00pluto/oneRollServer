<?php

namespace Common\Db;

/**
 * memcache缓存对象
 *
 * @author zhipeng
 *
 */
class Common_Db_memcacheObject
{
    /**
     *
     * @var string
     *
     */
    private $key = '';

    /**
     * Memcache 实例
     *
     * @var Common_Db_memcached
     */
    private $memcache_ins = null;

    /**
     * 过期时间
     *
     * @var integer
     */
    private $expiration = 0;

    function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * 获取Cache实例
     *
     * @return \Common\Db\Common_Db_memcached
     */
    private function getMemcacheIns()
    {
        if (!$this->memcache_ins instanceof Common_Db_memcached) {
            $this->memcache_ins = Common_Db_memcached::getInstance();
        }
        return $this->memcache_ins;
    }

    /**
     * 设置过期时间
     *
     * @param number $expiration
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;
    }

    /**
     * 设置值
     * @param $value
     * @return TRUE
     */
    function set_value($value)
    {
        return $this->getMemcacheIns()->set($this->key, $value, $this->expiration);
    }

    /**
     * 获取值
     * @param null $defaultValue
     * @return array|null
     */
    function get_value($defaultValue = NULL)
    {
        $returnValue = $this->getMemcacheIns()->get($this->key);
        if ($returnValue === FALSE) {
            $returnValue = $defaultValue;
        }
        return $returnValue;
    }

    /**
     * 是否有值
     *
     * @return boolean
     */
    function has_value()
    {
        $returnValue = $this->getMemcacheIns()->get($this->key);
        if ($returnValue === FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * 删除值
     *
     * @return true
     */
    function del_value()
    {
        return $this->getMemcacheIns()->delete($this->key);
    }

    /**
     * 创建对象
     *
     * @param string $key
     *            默认值,不会保存到memcache中
     * @return Common_Db_memcacheObject
     */
    static function create($key)
    {
        $ins = new self ($key);
        return $ins;
    }

    /**
     * 删除key
     *
     * @param string $key
     * @return \Common\Db\true
     */
    static function delete($key)
    {
        $ins = self::create($key);
        return $ins->del_value();
    }

    /**
     * 获取键值
     *
     * @param string $key
     * @param mixed $default
     * @return \Common\Db\Ambigous
     */
    static function get($key, $default = NULL)
    {
        $ins = self::create($key);
        return $ins->get_value($default);
    }
}