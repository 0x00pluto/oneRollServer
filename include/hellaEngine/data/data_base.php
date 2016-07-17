<?php

namespace hellaEngine\data;

use hellaEngine\data\interfaces\data_interfaces_serialize;

/**
 * 数据操作基类
 *
 * @internal
 *
 * @author zhipeng
 *
 */
abstract class data_base implements data_interfaces_serialize
{
    /**
     * 获取数据模块版本号
     * 1.基础版本
     * 2.不需要通过反射设置默认值
     * @return int
     */
    public function getVersion()
    {
        return 1;
    }

    /**
     * 还原某个key为默认值
     * @param $key
     * @return data_base
     */
    abstract protected function reset_defaultValue($key);

    /**
     * 给数据设置默认值
     */
    abstract protected function set_defalutvaluetodata();

    /**
     * 设置单个默认值
     *
     * @param string $key
     * @param
     *            $defalutvalue
     */
    abstract protected function set_defaultkeyandvalue($key, $defalutvalue);

    /**
     * 设置默认值
     *
     * @param array $arr
     */
    abstract protected function set_defaultvalues($arr);

    /**
     * 获取默认值
     *
     * @return array
     */
    abstract protected function get_defaultvalues();

    /**
     * 获取字段默认值
     * @param $key
     * @return mixed|null
     */
    abstract public function get_defaultValue($key);

    /**
     * 获取数据
     *
     * @param string $key
     * @return mixed
     *
     */
    abstract protected function getdata($key);


    /**
     * 设置数据
     *
     * @param string $key
     * @param
     *            $value
     * @return boolean 是否设置成功
     */
    abstract protected function setdata($key, $value);

    /**
     * 批量设置数据
     *
     * @param array $dataArr
     * @return boolean 是否设置成功
     */
    abstract protected function setdatas($dataArr);

    /**
     * 初始化默认值
     */
    protected function initializeDefaultValues()
    {

    }

    /**
     * 反射字段缓存
     *
     * @var array
     */
    protected static $_defaultvaluereflection = array();

    /**
     * @deprecate
     * 通过反射设置默认值
     * @param data_base $classobj
     */
    protected static function set_defalutvaluebyreflection(data_base $classobj)
    {
        $classname = static::class;
        $reflectionarray = null;

//        dump($classname);
        //基础版本
        if (isset (self::$_defaultvaluereflection [$classname])) {
            $reflectionarray = self::$_defaultvaluereflection [$classname];
            $classobj->set_defaultvalues($reflectionarray);
        } else {
            $reflectionarray = array();
            $methods = get_class_methods($classname);
            foreach ($methods as $method_name) {
                if (strpos($method_name, "_set_defaultvalue_") === 0) {
                    $reflectionarray [] = $method_name;
                }
            }
            foreach ($reflectionarray as $method_name) {
                $classobj->$method_name ();
            }

            self::$_defaultvaluereflection [$classname] = $classobj->get_defaultvalues();
        }

        $classobj->set_defalutvaluetodata();

    }
}