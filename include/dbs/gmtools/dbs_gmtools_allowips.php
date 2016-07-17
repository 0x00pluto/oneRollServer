<?php

namespace dbs\gmtools;

use dbs\dbs_base;

/**
 * 说明
 * 2015年9月11日 上午10:39:28
 *
 * @author zhipeng
 *
 */
class dbs_gmtools_allowips extends dbs_base
{

    /**
     * ip地址
     *
     * @var string
     */
    const DBKey_ipaddress = "ipaddress";

    /**
     * 获取 ip地址
     */
    public function get_ipaddress()
    {
        return $this->getdata(self::DBKey_ipaddress);
    }

    /**
     * 设置 ip地址
     *
     * @param unknown $value
     */
    public function set_ipaddress($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_ipaddress, $value);
    }

    /**
     * 设置 ip地址 默认值
     */
    protected function _set_defaultvalue_ipaddress()
    {
        $this->set_defaultkeyandvalue(self::DBKey_ipaddress, '127.0.0.1');
    }

    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "gmtools_allowips";

    function __construct()
    {
        parent::__construct(self::DBKey_tablename, array(), array(), true);
    }

    protected function onLoadingFromDB($db)
    {
        dump('here');
    }
}