<?php

namespace dbs\managers;

use Common\Db\Common_Db_pools;
use dbs\dbs_base;

/**
 * 全局kv表
 *
 * @author zhipeng
 *
 */
class dbs_managers_globalkvstore extends dbs_base
{

    /**
     * @var array
     */
    private static $_hotdb = array();

    /**
     * 获取值
     *
     * @param  $key
     * @param string $defaultValue
     * @return mixed
     */
    public static function getvalue($key, $defaultValue = NULL)
    {
        $key = strval($key);
        /**
         * @var dbs_managers_globalkvstore
         */
        $db = null;
        if (array_key_exists_faster($key, self::$_hotdb)) {
            $db = self::$_hotdb [$key];
        } else {

            $dbKeys = dbs_managers_globalkvstore::all([
                    dbs_managers_globalkvstore::DBKey_key => $key]
            );

            if (!empty($dbKeys)) {
                $db = $dbKeys[0];
                self::$_hotdb [$key] = $db;
            }
        }
        if ($db instanceof dbs_managers_globalkvstore) {
            return $db->get_value();
        } else {
            return $defaultValue;
        }
    }

    /**
     * 设置值
     *
     * @param string $key
     * @param mixed $value
     */
    public static function setvalue($key, $value)
    {
        $key = strval($key);
        $db = null;
        if (array_key_exists_faster($key, self::$_hotdb)) {
            $db = self::$_hotdb [$key];
        } else {

            $db = new dbs_managers_globalkvstore ();
            $db->set_key($key);
            $db->loadFromDB();
            self::$_hotdb [$key] = $db;
        }
        $db->set_value($value);
    }

    /**
     * 删除键
     *
     * @param string $key
     */
    public static function removestorekey($key)
    {
        if (array_key_exists_faster($key, self::$_hotdb)) {
            unset (self::$_hotdb [$key]);
        }
        // 删除数据库
        Common_Db_pools::default_Db_pools()->dbconnect()->delete('globalkvstore', array(
            self::DBKey_key => $key
        ));
    }

    /**
     * key
     *
     * @var string
     */
    const DBKey_key = "key";

    /**
     * 获取key
     */
    public function get_key()
    {
        return $this->getdata(self::DBKey_key);
    }

    /**
     * 设置key
     *
     * @param unknown $key
     */
    private function set_key($key)
    {
        $this->setdata(self::DBKey_key, $key);
    }

    /**
     * value
     *
     * @var string
     */
    const DBKey_value = "value";

    /**
     * 获取value
     */
    public function get_value()
    {
        return $this->getdata(self::DBKey_value);
    }

    /**
     * 设置value
     *
     * @param unknown $value
     */
    private function set_value($value)
    {
        $this->setdata(self::DBKey_value, $value);
    }

    function __construct()
    {
        parent::__construct();

        $this->set_tablename("globalkvstore");
        $this->set_defaultkeyandvalue(self::DBKey_key, "");
        $this->set_defaultkeyandvalue(self::DBKey_value, null);
        $this->set_primary_key([self::DBKey_key]);
        $this->ensureIndex(array(
            self::DBKey_key => 1
        ));
    }

    protected function onLoadingFromDB($db)
    {
        $ret = $db->query($this->get_tablename(), array(
            self::DBKey_key => $this->get_key()
        ));

        if (count($ret) > 0) {
            $this->fromDBData($ret [0]);
        }
    }
}