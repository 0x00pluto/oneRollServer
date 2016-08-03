<?php

namespace hellaEngine\data;

/**
 * 数据操作基本单元
 *
 * @author zhipeng
 *
 */
abstract class data_basedatacell extends data_base
{
    /**
     *
     * @param array $defaultValue
     *            默认值
     */
    function __construct($defaultValue = [])
    {
        $this->set_defaultvalues($defaultValue);
        if ($this->getVersion() === 1) {
            self::set_defalutvaluebyreflection($this);
        } else {
            //初始化默认值
            $this->initializeDefaultValues();
        }
        $this->set_defalutvaluetodata();
    }

    /**
     * 数据容器
     *
     * @var array
     */
    private $_data_contains = [];

    /**
     * 默认值
     *
     * @var array
     */
    protected $_defaultvalue = [];

    /**
     * 获取数据
     *
     * @param $key
     * @return mixed:
     */
    protected function getdata($key)
    {
        $key = strval($key);
        if (isset ($this->_data_contains [$key])) {
            return $this->_data_contains [$key];
        } elseif (isset ($this->_defaultvalue [$key])) {
            return $this->_defaultvalue [$key];
        }
        return null;
    }


    /**
     * @param string $key
     * @param $value
     * @return bool
     */
    protected function setdata($key, $value)
    {
        $key = strval($key);
        //此处必须用 array_key_exists_faster .因为默认值里面有null
        if (array_key_exists_faster($key, $this->_defaultvalue)) {
            $this->_data_contains [$key] = $value;
            return true;
        }
        return false;
    }

    /**
     * @param array $dataArr
     * @return bool
     */
    protected function setdatas($dataArr)
    {
        if (empty ($dataArr) || !is_array($dataArr)) {
            return false;
        }
        foreach ($dataArr as $key => $value) {
            $this->setdata($key, $value);
        }
        return TRUE;
    }

    /**
     * @inheritDoc
     */
    protected function set_defaultvalues($arr)
    {
        if (!is_array($arr)) {
            return;
        }
        $this->_defaultvalue = array_merge($this->_defaultvalue, $arr);
    }

    /**
     * @inheritDoc
     */
    protected function get_defaultvalues()
    {
        return $this->_defaultvalue;
    }

    /**
     * @inheritDoc
     */
    public function get_defaultValue($key)
    {
        if (isset($this->_defaultvalue[$key])) {
            return $this->_defaultvalue[$key];
        }
        return null;
    }


    /**
     * 设置单个默认值
     *
     * @param string $key
     * @param mixed $defalutvalue
     */
    protected function set_defaultkeyandvalue($key, $defalutvalue)
    {
//        $key = strval($key);
        $this->_defaultvalue [$key] = $defalutvalue;
    }

    /*
     * (non-PHPdoc)
     * @see \dbs\base\dbs_base_operate::set_defalutvaluetodata()
     */
    protected function set_defalutvaluetodata()
    {
        $this->_data_contains = $this->_defaultvalue;
    }

    /**
     * @param $key
     * @return $this
     */
    protected function reset_defaultValue($key)
    {
        if (isset($this->_defaultvalue[$key])) {
            $functionName = "set_" . $key;
            if (method_exists($this, $functionName)) {
                $this->{$functionName}($this->_defaultvalue[$key]);
            } else {
                $this->_data_contains[$key] = $this->_defaultvalue[$key];
            }
        }
        return $this;
    }


    /*
     * (non-PHPdoc)
     * @see \dbs\base\dbs_base_operate::fromArray()
     */
    public function fromArray($arr, $exclude = NULL)
    {
        if (empty ($arr)) {
            return false;
        }
        $this->set_defalutvaluetodata();

        if (empty ($exclude)) {
            $this->setdatas($arr);
        } else {
            foreach ($arr as $key => $value) {
                if (isset ($exclude [$key])) {
                    continue;
                }
                $this->setdata($key, $value);
            }
        }
        return TRUE;
    }


    /**
     * @param array $filter
     * @param array $excludefilter
     * @return array
     */
    public function toArray($filter = [], $excludefilter = [])
    {
        $originalDatas = array_merge([], $this->_data_contains);
        if (empty ($filter)) {
            $arr = $originalDatas;
        } else {
            $arr = array_intersect_key($originalDatas, array_flip($filter));
        }

        if (!empty ($excludefilter)) {
            foreach ($excludefilter as $key) {
                unset ($arr [$key]);
            }
        }
        return $arr;
    }


    /**
     * 通过数组创建
     * @param array $arr
     * @return static
     */

    public static function create_with_array(array $arr)
    {
        $ins = new static ();
        $ins->fromArray($arr);
        return $ins;
    }

    /**
     * 默认值模板
     * @var array
     */
    private static $defaultValues = [];

    /**
     * 输出默认值
     * @return mixed
     */
    public static function dumpDefaultValue()
    {
        if (isset(self::$defaultValues[static::class])) {
            $ins = self::$defaultValues[static::class];
        } else {
            $ins = new static ();
            self::$defaultValues[static::class] = $ins;
        }
        return $ins->toArray();
    }
}