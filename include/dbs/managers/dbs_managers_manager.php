<?php

namespace dbs\managers;

use dbs\i\dbs_i_iUpdate;

/**
 * 管理器
 *
 * @author zhipeng
 *
 */
class dbs_managers_manager implements dbs_i_iUpdate
{
    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }

    /**
     * 活动db
     *
     * @var array
     */
    private $_hot_db = array();
    /**
     * 动态更新的数据库
     *
     * @var unknown
     */
    private $_updateable = array();

    /**
     * 数据库生成器
     *
     * @param string $modulename
     *            数据库名称
     * @return NULL|Ambigous <dbs_managers_base, NULL, unknown, multitype:>
     */
    protected function m($modulename)
    {
        $modulename = strval($modulename);
        $module = NULL;
        if (array_key_exists($modulename, $this->_hot_db)) {
            $module = $this->_hot_db [$modulename];
        } else {
            $module = new $modulename ();
            if (!$module instanceof dbs_managers_base) {
                return NULL;
            }
            if ($module != NULL) {
                $this->_hot_db [$modulename] = $module;
            }
        }
        return $module;
    }

    function update_beforecall()
    {
        foreach ($this->_updateable as $value) {
            $db = $this->m($value);
            if ($db instanceof dbs_managers_base) {
                $db->update_beforecall();
            }
        }
    }

    function update_aftercall()
    {
        foreach ($this->_updateable as $value) {
            $db = $this->m($value);
            if ($db instanceof dbs_managers_base) {
                $db->update_aftercall();
            }
        }
    }

    function beforecall()
    {
    }

    // function dbs_managers_globalkvstore()
    // {

    // }
}