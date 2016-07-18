<?php

namespace dbs;

use constants\constants_db;
use hellaEngine\data\data_basedbdatacell;

/**
 * 数据服务虚类,目前成为代理类
 *
 * @author zhipeng
 *
 */
abstract class dbs_base extends data_basedbdatacell
{
    /**
     *
     * @param array|string $table_name
     *            表名
     * @param array $db_field_keys
     *            关键字数组,key=>defaultvalue
     * @param array $db_field_primary_key
     *            主键 [key1,key2],如果为NULL会自动添加userid
     * @param bool $auto_save
     *            是否自动保存
     * @param bool $auto_load
     *            是否自动加载,也就是判断isExistDBID 后 ,执行loadfromDB
     */
    function __construct($table_name = constants_db::EMPTY_TABLE_NAME, $db_field_keys = [], $db_field_primary_key = NULL,
                         $auto_save = true, $auto_load = true)
    {
        parent::__construct($table_name, $db_field_keys, $db_field_primary_key, $auto_save);

        $this->bootstrap();

    }

    /**
     * 初始化
     */
    protected function bootstrap()
    {
        $this->configure();
    }

    /**
     * 启动系统配置,在construct后面执行,子类重载
     */
    protected function configure()
    {

    }
}
