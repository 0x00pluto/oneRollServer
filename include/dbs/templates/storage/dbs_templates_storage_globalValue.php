<?php

namespace dbs\templates\storage;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_storage_globalValue
 * @package dbs\templates\storage
 */
abstract class dbs_templates_storage_globalValue extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "storage_globalValues";
    /**
     * 数据类型
     *
     * @var
     */
    const DBKey_dataTemplateType = "dataTemplateType";

	/**
	 * 获取 数据类型
	 * @return string
	 */
	public function get_dataTemplateType()
	{
		return $this->getdata ( self::DBKey_dataTemplateType );
	}

    /**
     * 设置 数据类型 默认值
     */
    protected function _set_defaultvalue_dataTemplateType()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "storage.globalValue" );
    }
    /**
     * key
     *
     * @var
     */
    const DBKey_key = "key";

	/**
	 * 获取 key
	 * @return string
	 */
	public function get_key()
	{
		return $this->getdata ( self::DBKey_key );
	}

	/**
	 * 设置 key
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_key($value)
	{
		$this->setdata ( self::DBKey_key, strval($value) );
		return $this;
	}

	/**
     * 重置 key
     * 设置为 ""
     * @return $this
     */
    public function reset_key()
    {
        return $this->reset_defaultValue(self::DBKey_key);
    }

    /**
     * 设置 key 默认值
     */
    protected function _set_defaultvalue_key()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_key, "" );
    }
    /**
     * value
     *
     * @var
     */
    const DBKey_value = "value";

	/**
	 * 获取 value
	 * @return mixed
	 */
	public function get_value()
	{
		return $this->getdata ( self::DBKey_value );
	}

	/**
	 * 设置 value
	 *
	 * @param mixed $value
	 * @return $this
	 */
	public function set_value($value)
	{
		$this->setdata ( self::DBKey_value, $value );
		return $this;
	}

	/**
     * 重置 value
     * 设置为 ""
     * @return $this
     */
    public function reset_value()
    {
        return $this->reset_defaultValue(self::DBKey_value);
    }

    /**
     * 设置 value 默认值
     */
    protected function _set_defaultvalue_value()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_value, "" );
    }

    /**
     * @inheritDoc
     */
    public function getVersion()
    {
        return 2;
    }
    /**
     * 设置默认值
     */
    protected function initializeDefaultValues()
    {
        parent::initializeDefaultValues();
        //设置 数据类型 默认值
        $this->_set_defaultvalue_dataTemplateType();
        //设置 key 默认值
        $this->_set_defaultvalue_key();
        //设置 value 默认值
        $this->_set_defaultvalue_value();

    }
}