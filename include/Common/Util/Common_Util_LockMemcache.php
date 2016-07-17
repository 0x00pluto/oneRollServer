<?php

namespace Common\Util;

use Common\Db\Common_Db_memcached;

/**
 * 锁服务(用Memcache模拟锁)
 * Author: tomheng<zhm20070928@gmail.com>
 * gist: https://gist.github.com/tomheng/6149779
 */
class Common_Util_LockMemcache implements Common_Util_LockInterface
{
    private $mc = null;
    private $key_prefix = "memcache_lock_service_key_";
    private $key;
    private $_locked = FALSE;

    /**
     * 休眠毫秒数量
     * @var integer
     */
    const SLEEP_TIME = 10;

    /**
     * [__construct description]
     */
    public function __construct($key = NULL)
    {
        // $this->key = $key;
        $this->set_key($key);

        $this->mc = Common_Db_memcached::getInstance();
    }

    public function set_key($value)
    {
        $this->key = strval($value);
    }

    /*
     * (non-PHPdoc)
     * @see \Common\Util\Common_Util_LockInterface::get_key()
     */
    function get_key()
    {
        $key = $this->key_prefix . $this->key;
        return $key;
    }

    /**
     * 是否加锁了
     *
     * @return boolean
     */
    private function is_lock()
    {
        return $this->_locked;
    }

    /**
     * Information generate by this method allow to track down process which acquired lock
     * .
     * By default it returns array with:
     * 1. pid
     * 2. server_ip
     * 3. server_name
     *
     * @return array
     */
    protected function generateLockInformation()
    {
        $pid = getmypid();
        $hostname = gethostname();
        $host = gethostbyname($hostname);
        // Compose data to one string
        $params = array();
        $params [] = $pid;
        $params [] = $host;
        $params [] = $hostname;
        return $params;
    }


    /**
     * 加锁
     * @param int $timeoutSec 秒
     * @param bool|TRUE $sync
     * @return bool
     */
    public function lock($timeoutSec = 10, $sync = TRUE)
    {
        if (!$this->mc) {
            return false;
        }
        if ($this->is_lock()) {
            return true;
        }
        $key = $this->get_key();

//        $timeoutSec = 15;
        //转换为10ms单位
        $max_block_time = $timeoutSec * (1000 / self::SLEEP_TIME);
        do {

            $re = $this->mc->add($key, serialize($this->generateLockInformation()), $timeoutSec);
            // dump ( [
            // $re,
            // $key,
            // serialize ( $this->generateLockInformation () ),
            // $sync,
            // $max_block_time
            // ] );
            if ($re !== FALSE) {
                break;
            }

            if ($sync) {
//                dump("lock failed:" . $key);
                //休眠10 ms
                usleep(self::SLEEP_TIME);
            }
        } while ($sync && ($max_block_time--) >= 0);

        if ($re !== FALSE) {
            $this->_locked = true;

        } else {

            $this->_locked = false;
            Common_Util_Log::record_error("LOCK_FAILED", ["lock_key" => $key]);
        }
        return $this->_locked;
    }

    /**
     * 释放锁
     */
    public function unlock()
    {
        if (!$this->mc) {
            return false;
        }
        if (!$this->is_lock()) {
            return true;
        }

        $key = $this->get_key();
        $re = $this->mc->delete($key);
        $this->_locked = false;

        return $re;
    }

    /**
     * 释放所有的锁
     */
    public function __destruct()
    {
        $this->unlock();
    }

    /**
     * 构造方法
     *
     * @param string $key
     * @return Common_Util_LockMemcache
     */
    static function newlock($key = NULL)
    {
        return new self ($key);
    }
}
