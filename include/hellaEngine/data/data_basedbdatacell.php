<?php

namespace hellaEngine\data;

use Common\Db\Common_Db_mongo;
use Common\Db\Common_Db_pools;
use constants\constants_db;
use hellaEngine\exception\exception_datasaveerror;

/**
 * 数据操作基类
 *
 * @author zhipeng
 *
 */
abstract class data_basedbdatacell extends data_basedatacell
{

    /**
     * 表名
     *
     * @var string
     */
    protected $table_name = constants_db::EMPTY_TABLE_NAME;

    /**
     * 获取数据库表名
     *
     * @return string
     */
    public function get_tablename()
    {
        return $this->table_name;
    }

    /**
     * 设置数据库名称
     * @param $value
     */
    protected function set_tablename($value)
    {
        $this->table_name = $value;

    }

    /**
     * 是否存在数据
     * @var bool
     */
    protected $exist = false;

    /**
     * 设置数据库中是否存在数据
     * @param bool $value
     */
    protected function setExist($value)
    {
        $this->exist = $value;
    }

    /**
     * 数据是否存在
     * @return bool
     */
    function exist()
    {
        return $this->exist;
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

    public function set_readonly($value)
    {
        $this->readonly = boolval($value);
    }

    /**
     * 数据是否被删除
     *
     * @var bool
     */
    private $isDelete = false;

    /**
     * 获取数据是否已经被删除
     *
     * @return boolean
     */
    public function isDelete()
    {
        return $this->isDelete;
    }


    /**
     * create_at
     *
     * @var string
     */
    const DBKey_create_at = "create_at";

    /**
     * 获取 create_at
     */
    public function get_create_at()
    {
        return $this->getdata(self::DBKey_create_at);
    }

    /**
     * 设置 create_at
     *
     * @param int $value
     */
    protected function set_create_at($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_create_at, $value);
    }

    /**
     * 设置 数据类型 默认值
     */
    protected function _set_defaultvalue_create_at()
    {
        $this->set_defaultkeyandvalue(self::DBKey_create_at, time());
    }


    /**
     * 更新时间戳
     */
    private function updateTimestamps()
    {
        $this->set_update_at(time());
    }

    /**
     * update_at
     *
     * @var string
     */
    const DBKey_update_at = "update_at";

    /**
     * 获取 update_at
     */
    public function get_update_at()
    {
        return $this->getdata(self::DBKey_update_at);
    }

    /**
     * 设置 update_at
     *
     * @param  $value
     */
    protected function set_update_at($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_update_at, $value);
    }

    /**
     * 设置 数据类型 默认值
     */
    protected function _set_defaultvalue_update_at()
    {
        $this->set_defaultkeyandvalue(self::DBKey_update_at, time());
    }

    /**
     * @var bool
     */
    private $loadedFromDb = false;

    /**
     * 是否已经从数据库中加载数据
     * @return boolean
     */
    public function isLoadedFromDb()
    {
        return $this->loadedFromDb;
    }

    /**
     * @param boolean $loadedFromDb
     */
    protected function setLoadedFromDb($loadedFromDb)
    {
        $this->loadedFromDb = $loadedFromDb;
    }

    /**
     * 数据连接池
     *
     * @return \Common\Db\Common_Db_pools
     */
    public static function db_pools()
    {
        return Common_Db_pools::default_Db_pools();
    }

    /**
     * 数据链接
     *
     * @return \Common\Db\Common_Db_mongo
     */
    public static function db_connect()
    {
        return self::db_pools()->dbconnect();
    }

    // 主键字段
    protected $_primary_key = [];

    /**
     * mongodb主键
     *
     * @var string
     */
    const DBKey_dbid = "_id";
    /**
     *
     * @var string
     */
    private $db_id = null;

    /**
     * 设置mongodb主键
     *
     * @param string $value
     */
    private function set_dbid($value)
    {
        $this->db_id = strval($value);
    }

    /**
     * 获取mongodb主键
     *
     * @return string
     */
    protected function get_dbid()
    {
        return $this->db_id;
    }

    /**
     * 建立索引
     *
     * @param array $indexs
     *            索引 例如{"userid":1}
     * @param bool $unique
     *            是否唯一
     */
    protected function ensureIndex($indexs, $unique = false)
    {

        if (empty ($this->get_tablename())) {
            return;
        }
        $index_name = "_index_";
        foreach ($indexs as $key => $value) {
            $index_name .= $key . "_";
        }

        $createResult = $this->db_connect()->ensureIndex($this->get_tablename(),
            $index_name,
            $indexs,
            true,
            $unique);
    }


    /**
     * 数据是否加入自动保存
     * @var bool
     */
    private $dbAutoSave = false;

    /**
     *
     * data_basedbdatacell constructor.
     * @param string $table_name
     * @param array $db_field_keys
     *            关键字数组,key=>defalutvalue
     * @param array $db_field_primary_key
     *            主键 [key1,key2]
     * @param bool $auto_save
     *            是否自动保存
     */
    function __construct($table_name = '',
                         $db_field_keys = array(),
                         $db_field_primary_key = array(),
                         $auto_save = true
    )
    {
        parent::__construct($db_field_keys);
        // 数据库连接
        $this->set_tablename($table_name);
        $this->set_primary_key($db_field_primary_key);
        $this->setAutoSave($auto_save);
    }

    /**
     * @inheritDoc
     */
    protected function initializeDefaultValues()
    {
        parent::initializeDefaultValues();
        $this->_set_defaultvalue_create_at();
        $this->_set_defaultvalue_update_at();
    }


    /**
     * 设置是否可以自动保存
     * @param $enable
     * @return $this
     */
    protected function setAutoSave($enable)
    {
        $this->dbAutoSave = $enable;
        if ($this->dbAutoSave) {
            self::db_pools()->push($this);
        } else {
            self::db_pools()->pop($this);
        }
        return $this;
    }


    /**
     * 数据库主键
     * @param array $arr [key1,key2]
     * @return array
     */
    protected function set_primary_key($arr)
    {
        if (is_array($arr)) {
            $this->_primary_key = array_unique(array_merge($arr, $this->_primary_key));
        }
        return $this->_primary_key;
    }

    /**
     * 获取主键值
     * @return array
     */
    protected function get_primary_value()
    {
        $where = [];
        foreach ($this->_primary_key as $primary_key) {
            $primaryValue = $this->getdata($primary_key);
            if (!empty ($primaryValue)) {
                $where [$primary_key] = $primaryValue;
            }
        }
        return $where;
    }

    /**
     * 加载数据
     *
     * @return boolean
     */
    public final function loadFromDB()
    {
        // 表名为空不读取
        if (empty ($this->table_name)) {
            return false;
        }

        $db = self::db_connect();
        $this->loadFromDBBefore($db);
        $this->onLoadingFromDB($db);
        $this->clearDirtyKeys();
        $this->loadFromDBAfter($db);

        $this->setLoadedFromDb(true);
        return TRUE;
    }

    /**
     * 加载数据
     *
     * @param Common_Db_mongo $db
     */
    protected function onLoadingFromDB($db)
    {
        $where = $this->primary_key_query_where();
        $ret = $db->query($this->get_tablename(), $where);
        if (count($ret) != 0) {
            $this->fromDBData($ret [0]);
        }
    }

    /**
     * 加载数据之前
     * @param Common_Db_mongo $db
     */
    protected function loadFromDBBefore(Common_Db_mongo $db)
    {

    }

    /**
     * 加载数据之后
     * @param $db
     */
    protected function loadFromDBAfter(Common_Db_mongo $db)
    {

    }


    /**
     * 实际保存数据之前
     * @param Common_Db_mongo $db
     */
    protected function saveToDbBefore(Common_Db_mongo $db)
    {

    }

    /**
     * 实际保存数据之后
     * @param Common_Db_mongo $db
     */
    protected function saveToDbAfter(Common_Db_mongo $db)
    {

    }

    /**
     * 保存到数据库
     *
     * @param boolean $force
     *            是否强制保存
     * @return bool 是否真正执行了保存
     */
    public final function saveToDB($force = false)
    {
        // 表名为空不保存
        $saved = false;

        // 只读不保存数据
        if ($this->is_readonly()) {
            return $saved;
        }
        if (empty ($this->table_name)) {
            return $saved;
        }
        // 数据已经被删除了,则不保存数据了
        if ($this->isDelete()) {
            return $saved;
        }
        if ($this->isDirty() || $force) {
            $saved = $this->_saveToDB(self::db_connect());
        }
        $this->clearDirtyKeys();
        return $saved;
    }


    /**
     * 从数据库中删除
     *
     * @return boolean
     */
    public final function removeFromDB()
    {
        // 不能重复执行删除
        if ($this->isDelete) {
            return false;
        }
        // 不存在主键不能删除
        if (!$this->exist()) {
            return false;

        }
        //只读数据不能删除
        if ($this->is_readonly()) {
            return false;
        }

        $db = self::db_connect();
        $where = [];
        $where [self::DBKey_dbid] = Common_Db_mongo::id($this->get_dbid());
        $db->delete($this->get_tablename(), $where);
        $this->isDelete = TRUE;

        return TRUE;
    }

    /**
     * 主键查询
     *
     * @return array
     */
    protected function primary_key_query_where()
    {
        $where = [];
        if ($this->exist()) {
            //如果存在数据,则直接用ID去查询
            $where[self::DBKey_dbid] = Common_Db_mongo::id($this->get_dbid());
        } else {
            $where = $this->get_primary_value();
        }

        return $where;
    }

    /**
     * 获取需要保存的数据,
     * 一般情况就是toArray.
     * 特殊情况需要处理,例如AutoIncreaseId
     * 调用Mongodb函数等
     * @return array
     */
    protected function getSaveData()
    {
        return parent::toArray();
    }

    /**
     * 保存数据
     *
     * @param Common_Db_mongo $db
     * @return bool
     */
    protected function _saveToDB($db)
    {

        // 设置用户主键
        $where = $this->primary_key_query_where();
        // 数据是否存在
        $dataExists = $this->exist();
        if ($dataExists) {
            //数据存在 执行更新操作
            //追加Update字段判断
            //Update 不存,或者Update 相等
            $or = [
                [
                    self::DBKey_update_at => [
                        '$exists' => false
                    ]
                ],
                [
                    self::DBKey_update_at => $this->get_update_at()
                ]
            ];
            $where ['$or'] = $or;
        }
        //更新时间戳
        $this->updateTimestamps();
        //需要保存的数据
        $saveDatas = $this->getSaveData();

//        dump($saveDatas);

        //剔除_ID,否则会报错

        //实际保存数据之前
        $this->saveToDbBefore($db);

        //不同的值记录
        $diffValues = [];
        $retDetail = [];
        if ($dataExists) {
            //更新操作
            $retDetail = $db->update($this->get_tablename(), $saveDatas, $where, false);
//            dump($retDetail);
            $ret = $retDetail['updatedExisting'];
            if (!$ret) {
                //更新失败,继续检测
                $dbDatas = $db->query($this->get_tablename(), $this->primary_key_query_where());
                //数据库中存在的原始数据
                $dbData = array_pop($dbDatas);
                //进行深度比较
                $deepEqual = true;

                foreach ($this->dirtyKeys as $key => $dirty_value) {
                    if (isset($dbData[$key])) {
                        //原始数据库存在原来的值
                        if ($key !== self::DBKey_update_at) {
                            if ($dirty_value ['oldvalue'] !== $dbData [$key]
                                && $dirty_value['newvalue'] !== $dbData [$key]
                            ) {
                                //不是更新时间关键字段
                                //原始值和数据库中的值不相同
                                //目标值和数据库中的值也不相同
                                $deepEqual = false;
                                $diffValues[$key] = [
                                    'oldValue' => $dirty_value['oldvalue'],
                                    'newValue' => $dirty_value['newvalue'],
                                    'dbValue' => $dbData [$key]
                                ];
//                        break;
                            }
                        }
                    }
                }
                $ret = $deepEqual;
                //再次检查错误,没有脏数据,只说明只是时间戳错误了
                //再次保存数据
                if ($deepEqual || empty($diffValues)) {
                    //根据主键直接保存数据
                    $retDetail = $db->update($this->get_tablename(),
                        $saveDatas,
                        $this->primary_key_query_where(),
                        false);
                    $ret = $retDetail['updatedExisting'];

                }
            }
        } else {
            $ret = $db->insert($this->get_tablename(), $saveDatas, false);
            //设置数据存在
            if ($ret) {
                $this->setExist(true);
                $this->setLoadedFromDb(true);
                //insert之后,会返回完整数据,包含_id
                $this->set_dbid(strval($saveDatas[self::DBKey_dbid]));
            }
        }
        //实际保存数据之后
        $this->saveToDbAfter($db);

        if (!$ret) {
            $errorMessage = "tablename:" . $this->get_tablename();
            $errorMessage .= " Operate:" . ($dataExists ? "Update" : "Inserted");
            $errorDetail = [
                "Info" => $errorMessage,
                "Details" => $retDetail,
                "DiffValue" => $diffValues,
                "DirtyData" => var_export($this->dirtyKeys, true),
                "CurrentData" => parent::toArray()
            ];

            $exception = new exception_datasaveerror ($errorMessage);
            $exception->setErrorDetail($errorDetail);
            throw $exception;
        }
        return $ret;
    }

    /**
     * 本次数据的脏字段
     * @var array
     */
    private $dirtyKeys = [];


    /**
     * 获取导致脏数据的字段
     *
     * @return array
     */
    public function getDirtyKeys()
    {
        return $this->dirtyKeys;
    }

    /**
     * 标记数据脏
     *
     * @param string $key
     *            脏的字段
     * @param string $oldvalue
     *            原始数据
     * @param string $newvalue
     *            新数据
     */
    protected function markDirty($key = NULL, $oldvalue = NULL, $newvalue = NULL)
    {
        if (!empty($key)) {
            $this->dirtyKeys[$key] = [
                'oldvalue' => $oldvalue,
                'newvalue' => $newvalue
            ];
        }
        if ($this->dbAutoSave) {
            self::db_pools()->push($this);
        }
    }

    /**
     * 是否有脏数据
     *
     * @return boolean
     */
    public function isDirty()
    {
        return !empty($this->dirtyKeys);
    }

    /**
     * 清除脏数据标志位
     */
    protected function clearDirtyKeys()
    {
        $this->dirtyKeys = [];
    }


    /**
     * 设置数据
     * @param string $key
     * @param $value
     * @return bool
     */
    protected function setdata($key, $value)
    {
        return $this->valueSetter($key, $value);
    }

    /**
     * 数据设置器
     * 会自动标记脏数据
     *
     * @param string $key
     * @param mixed $value
     * @return boolean
     */
    private function valueSetter($key, $value)
    {
        $key = strval($key);
        // mongodb主键
        if ($key === self::DBKey_dbid) {
            $this->set_dbid($value);
            return true;
        }

        if (!$this->isLoadingDataFromDB) {
            // 不是从db加载数据.就是正常设置
            $oldValue = $this->getdata($key);

            if (!is_array($value)) {
                //不是数组,需要完全匹配
                if ($oldValue === $value) {
                    return true;
                }
            } else {
                //如果是数组,比较数据里面的单元
                if ($oldValue == $value) {
                    return true;
                }
            }

            $this->markDirty($key, $oldValue, $value);
        }

        return parent::setdata($key, $value);

    }

    /**
     * 是否正在从数据库加载数据
     *
     * @var bool
     */
    private $isLoadingDataFromDB = false;

    /**
     * 从数据库中加载
     * @param array $arr
     */
    protected function fromDBData(array $arr)
    {
        $this->isLoadingDataFromDB = true;

        $this->fromArray($arr);
        $this->setExist(true);
        $this->isLoadingDataFromDB = false;


    }

    /**
     * @param array $arr
     * @param array $exclude
     * @return bool
     */
    function fromArray($arr, $exclude = NULL)
    {
        if (empty ($arr)) {
            return false;
        }
        $this->set_defalutvaluetodata();
        $this->setdatas($arr);
        $this->clearDirtyKeys();
        return true;
    }


    /**
     * dumpDB....
     */
    function dumpDB()
    {
        dump($this->toArray(), false, 1);
    }


    /**
     * @param array $dbResult
     * @return static
     */
    private static function createWithDB(array $dbResult)
    {
        $db = static::db_connect();
        $dbIns = new static ();
        $dbIns->loadFromDBBefore($db);
        $dbIns->fromDBData($dbResult);
        $dbIns->loadFromDBAfter($db);
        return $dbIns;
    }

    /**
     * 获取所有数据
     * @param array $where
     * @param int $skip
     * @param int $limit
     * @return static[]
     */
    public static function all(array $where = [], $skip = -1, $limit = -1)
    {
        $result = [];
        $db = static::db_connect();

        $ins = new static ();
        $dbResults = $db->queryCursor($ins->get_tablename(), $where, [], $limit, [], $skip)->getResults();

        foreach ($dbResults as $dbResult) {
            $result [] = self::createWithDB($dbResult);
        }
        return $result;
    }

    /**
     * @param array $where
     * @return static
     */
    public static function findOrNew(array $where)
    {

        $db = static::db_connect();
        $dbIns = new static ();

        $dbResults = $db->query($dbIns->get_tablename(), $where, [], 1);
        foreach ($dbResults as $dbResult) {
            return self::createWithDB($dbResult);
        }
        return $dbIns;

    }
}
