<?php

namespace dbs;

use constants\constants_defaultvalue;

/**
 * 用户kv表
 *
 * @author zhipeng
 *
 */
class dbs_userkvstore extends dbs_baseplayer
{

    /**
     * 值集合
     *
     * @var string
     */
    const DBKey_values = "values";

    /**
     * 获取值集合
     */
    private function get_values()
    {
        return $this->getdata(self::DBKey_values);
    }

    /**
     * 设置值集合
     *
     * @param array $values
     */
    private function set_values($values)
    {
        $this->setdata(self::DBKey_values, $values);
    }

    /**
     * 设置值
     *
     * @param string $key
     * @param  $value
     */
    public function setvalue($key, $value)
    {
        $key = strval($key);
        $values = $this->get_values();
        $values [$key] = $value;
        // dump ( $values );
        // dump_stack ();
        $this->set_values($values);
    }

    /**
     * 获取值
     *
     * @param string $key
     * @param string $defaultvalue
     * @return unknown|string
     */
    public function getvalue($key, $defaultvalue = null)
    {
        $key = strval($key);
        $values = $this->get_values();
        if (array_key_exists_faster($key, $values)) {
            return $values [$key];
        }
        return $defaultvalue;
    }

    /**
     * 删除键
     *
     * @param unknown $key
     */
    public function removekey($key)
    {
        $key = strval($key);
        $values = $this->get_values();
        unset ($values [$key]);
        $this->set_values($values);
    }

    function __construct()
    {
        parent::__construct('userkvstore', array(
            self::DBKey_userid => constants_defaultvalue::USERID_EMPTY,
            self::DBKey_values => array()
        ));
    }
}