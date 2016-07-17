<?php

namespace dbs\templates\sync;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_sync_data
 * @package dbs\templates\sync
 */
class dbs_templates_sync_data extends super
{
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "sync.data" );
    }
    /**
     * 同步类型
     *
     * @var
     */
    const DBKey_type = "type";

	/**
	 * 获取 同步类型
	 * @return string
	 */
	public function get_type()
	{
		return $this->getdata ( self::DBKey_type );
	}

	/**
	 * 设置 同步类型
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_type($value)
	{
		$this->setdata ( self::DBKey_type, strval($value) );
		return $this;
	}

	/**
     * 重置 同步类型
     * 设置为 ""
     * @return $this
     */
    public function reset_type()
    {
        return $this->reset_defaultValue(self::DBKey_type);
    }

    /**
     * 设置 同步类型 默认值
     */
    protected function _set_defaultvalue_type()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_type, "" );
    }
    /**
     * 同步关键字
     *
     * @var
     */
    const DBKey_key = "key";

	/**
	 * 获取 同步关键字
	 * @return string
	 */
	public function get_key()
	{
		return $this->getdata ( self::DBKey_key );
	}

	/**
	 * 设置 同步关键字
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
     * 重置 同步关键字
     * 设置为 ""
     * @return $this
     */
    public function reset_key()
    {
        return $this->reset_defaultValue(self::DBKey_key);
    }

    /**
     * 设置 同步关键字 默认值
     */
    protected function _set_defaultvalue_key()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_key, "" );
    }
    /**
     * 同步消息
     *
     * @var
     */
    const DBKey_message = "message";

	/**
	 * 获取 同步消息
	 * @return array
	 */
	public function get_message()
	{
		return $this->getdata ( self::DBKey_message );
	}

	/**
	 * 设置 同步消息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_message($value)
	{
		$this->setdata ( self::DBKey_message, $value );
		return $this;
	}

	/**
     * 重置 同步消息
     * 设置为 []
     * @return $this
     */
    public function reset_message()
    {
        return $this->reset_defaultValue(self::DBKey_message);
    }

    /**
     * 设置 同步消息 默认值
     */
    protected function _set_defaultvalue_message()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_message, [] );
    }
    /**
     * 同步类名
     *
     * @var
     */
    const DBKey_classname = "classname";

	/**
	 * 获取 同步类名
	 * @return string
	 */
	public function get_classname()
	{
		return $this->getdata ( self::DBKey_classname );
	}

	/**
	 * 设置 同步类名
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_classname($value)
	{
		$this->setdata ( self::DBKey_classname, strval($value) );
		return $this;
	}

	/**
     * 重置 同步类名
     * 设置为 ""
     * @return $this
     */
    public function reset_classname()
    {
        return $this->reset_defaultValue(self::DBKey_classname);
    }

    /**
     * 设置 同步类名 默认值
     */
    protected function _set_defaultvalue_classname()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_classname, "" );
    }
    /**
     * 同步函数名称
     *
     * @var
     */
    const DBKey_functionname = "functionname";

	/**
	 * 获取 同步函数名称
	 * @return string
	 */
	public function get_functionname()
	{
		return $this->getdata ( self::DBKey_functionname );
	}

	/**
	 * 设置 同步函数名称
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_functionname($value)
	{
		$this->setdata ( self::DBKey_functionname, strval($value) );
		return $this;
	}

	/**
     * 重置 同步函数名称
     * 设置为 ""
     * @return $this
     */
    public function reset_functionname()
    {
        return $this->reset_defaultValue(self::DBKey_functionname);
    }

    /**
     * 设置 同步函数名称 默认值
     */
    protected function _set_defaultvalue_functionname()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_functionname, "" );
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
        //设置 同步类型 默认值
        $this->_set_defaultvalue_type();
        //设置 同步关键字 默认值
        $this->_set_defaultvalue_key();
        //设置 同步消息 默认值
        $this->_set_defaultvalue_message();
        //设置 同步类名 默认值
        $this->_set_defaultvalue_classname();
        //设置 同步函数名称 默认值
        $this->_set_defaultvalue_functionname();

    }
}