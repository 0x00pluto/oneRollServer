<?php

namespace Common\Util;

/**
 * 锁的接口
 *
 * @author zhipeng
 *
 */
interface Common_Util_LockInterface
{
    /**
     * 设置锁的key
     *
     * @param string $value
     */
    function set_key($value);

    /**
     * 获取锁
     *
     * @return string
     */
    function get_key();

    /**
     * 加锁
     *
     * @param integer $timeoutSec
     *            超时时间
     * @param boolean $sync
     *            是否同步
     * @return boolean
     */
    function lock($timeoutSec, $sync);

    /**
     * 解锁
     */
    function unlock();
}