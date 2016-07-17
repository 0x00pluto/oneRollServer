<?php

namespace Common\Db;

use Common\Util\Common_Util_Array;
use hellaEngine\data\data_basedbdatacell;

/**
 * db数据池
 *
 * @author zhipeng
 *
 */
class Common_Db_pools
{
    /**
     * 数据库连接
     *
     * @var Common_Db_mongo
     */
    private $_db_connection;

    /**
     * 活动数据池
     *
     * @var array
     */
    private $_db_actives = [];

    /**
     * 启动数据池
     */
    public function begin()
    {
        $this->_db_actives = [];
    }

    public function end()
    {
        // empty
        $this->_db_actives = [];
    }

    private function __construct()
    {
    }

    /**
     * create function
     *
     * @param Common_Db_mongo $dbconnection
     * @return Common_Db_pools
     */
    public static function create(Common_Db_mongo $dbconnection)
    {
        $ins = new self ();
        $ins->_db_connection = $dbconnection;
        return $ins;
    }

    /**
     * 增加需要操作的DB实例
     * @param data_basedbdatacell $dbs
     */
    public function push(data_basedbdatacell $dbs)
    {
        foreach ($this->_db_actives as $value) {
            if ($value === $dbs) {
                return;
            }
        }
        $this->_db_actives [] = $dbs;
    }

    /**
     * 删除指定数据实例
     * @param data_basedbdatacell $dbs
     */
    public function pop(data_basedbdatacell $dbs)
    {
        foreach ($this->_db_actives as $key => $value) {
            if ($value === $dbs) {
                unset($this->_db_actives[$key]);
                return;
            }
        }
    }

    /**
     * 保存数据池
     */
    public function save()
    {
        $dbs_arr = $this->_db_actives;
        $debug_db = C(\configure_constants::DEBUG_DB, null, false);
        if ($debug_db) {
            $debug_arr = Common_Util_Array::getvalue($GLOBALS, "DEBUG_DB_DIRTY_KEY", array())->value();
        }
        foreach ($dbs_arr as $value) {
            if ($value instanceof data_basedbdatacell) {
                if ($debug_db && $value->isDirty()) {
                    $dbinfo = array(
                        'classname' => get_class($value),
                        'info' => $value->getDirtyKeys()
                    );
                }
                $bsave = $value->saveToDB();
                if ($debug_db && $bsave) {
                    $debug_arr [] = $dbinfo;
                }
            }
        }
        if ($debug_db) {
            $GLOBALS ["DEBUG_DB_DIRTY_KEY"] = $debug_arr;
        }
    }

    /**
     * 获取数据连接
     *
     * @return Common_Db_mongo
     */
    public function dbconnect()
    {
        return $this->_db_connection;
    }

    /**
     * 获取活动db
     */
    public function getActiveDbs()
    {
        return $this->_db_actives;
    }

    /**
     * 默认数据池
     *
     * @var Common_Db_pools
     */
    private static $_default_instance;

    /**
     * 默认数据池
     *
     * @return \Common\Db\Common_Db_pools
     */
    public static function default_Db_pools()
    {
        if (!(self::$_default_instance instanceof self)) {
            $db_ins = new Common_Db_mongo (C(\configure_constants::Const_DB_Connection),
                ['db' => C(\configure_constants::Const_DB_Name)]);
            $db_ins->selectDB(C(\configure_constants::Const_DB_Name));

            self::$_default_instance = self::create($db_ins);
        }
        return self::$_default_instance;
    }
}