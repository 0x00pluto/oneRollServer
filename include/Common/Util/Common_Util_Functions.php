<?php

namespace Common\Util;

class MissingArgumentException extends \Exception
{
}

/**
 * 函数回调类
 *
 * @author zhipeng
 *
 */
class Common_Util_Functions
{
    /**
     * 调用全局函数
     * @param string $method 函数名称
     * @param array $arr
     * @return mixed
     * @throws MissingArgumentException
     */
    static function call_user_func_named_array($method, array $arr = [])
    {
        $ref = new \ReflectionFunction($method);
        $params = [];
        foreach ($ref->getParameters() as $p) {
            if ($p->isOptional()) {
                if (isset ($arr [$p->name])) {
                    $params [] = $arr [$p->name];
                } else {
                    $params [] = $p->getDefaultValue();
                }
            } else if (isset ($arr [$p->name])) {
                $params [] = $arr [$p->name];
            } else {
                throw new MissingArgumentException ("Missing parameter $p->name");
            }
        }
        return $ref->invokeArgs($params);
    }

    /**
     * 调用
     *
     * @param string $classname
     *            类名
     * @param string $functionname
     *            函数名称
     * @param array $arr
     *            参数列表 key=>value
     * @return mixed
     */
    static function call_class_func_named_array($classname, $functionname, array $arr = [])
    {
        return Common_Util_Functions::call_class_func_named_object_array($classname, $functionname, new $classname (), $arr);
    }

    /**
     *
     * @param string $classname
     * @param string $functionname
     * @param mixed $classobj
     *            instanceof $classname
     * @param array $arr
     *            参数列表 key=>value
     * @throws MissingArgumentException
     * @return mixed
     */
    static function call_class_func_named_object_array($classname, $functionname, $classobj, array $arr = [])
    {
        $ref = new \ReflectionMethod ($classname, $functionname);
        $params = [];
        $finalArr = array_change_key_case($arr, CASE_UPPER);

        foreach ($ref->getParameters() as $p) {
            $paramName = strtoupper($p->name);
            if ($p->isOptional()) {
                if (isset ($finalArr [$paramName])) {
                    $params [] = $finalArr [$paramName];
                } else {
                    $params [] = $p->getDefaultValue();
                }
            } else if (isset ($finalArr [$paramName])) {
                $params [] = $finalArr [$paramName];
            } else {
                throw new MissingArgumentException ("Missing parameter $paramName");
            }
        }

        return $ref->invokeArgs($classobj, $params);
    }
}

?>