<?php

namespace dbs\templates;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_deviceinfo
 * @package dbs\templates
 */
abstract class dbs_templates_deviceinfo extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "deviceinfo";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "deviceinfo" );
    }
    /**
     * 设备类型
     *
     * @var
     */
    const DBKey_devicetype = "devicetype";

	/**
	 * 获取 设备类型
	 * @return int
	 */
	public function get_devicetype()
	{
		return $this->getdata ( self::DBKey_devicetype );
	}

	/**
	 * 设置 设备类型
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_devicetype($value)
	{
		$this->setdata ( self::DBKey_devicetype, intval($value) );
		return $this;
	}

	/**
     * 重置 设备类型
     * 设置为 0
     * @return $this
     */
    public function reset_devicetype()
    {
        return $this->reset_defaultValue(self::DBKey_devicetype);
    }

    /**
     * 设置 设备类型 默认值
     */
    protected function _set_defaultvalue_devicetype()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_devicetype, 0 );
    }
    /**
     * 设备名称
     *
     * @var
     */
    const DBKey_devicename = "devicename";

	/**
	 * 获取 设备名称
	 * @return string
	 */
	public function get_devicename()
	{
		return $this->getdata ( self::DBKey_devicename );
	}

	/**
	 * 设置 设备名称
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_devicename($value)
	{
		$this->setdata ( self::DBKey_devicename, strval($value) );
		return $this;
	}

	/**
     * 重置 设备名称
     * 设置为 ""
     * @return $this
     */
    public function reset_devicename()
    {
        return $this->reset_defaultValue(self::DBKey_devicename);
    }

    /**
     * 设置 设备名称 默认值
     */
    protected function _set_defaultvalue_devicename()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_devicename, "" );
    }
    /**
     * 设备pushtoken
     *
     * @var
     */
    const DBKey_devicetoken = "devicetoken";

	/**
	 * 获取 设备pushtoken
	 * @return string
	 */
	public function get_devicetoken()
	{
		return $this->getdata ( self::DBKey_devicetoken );
	}

	/**
	 * 设置 设备pushtoken
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_devicetoken($value)
	{
		$this->setdata ( self::DBKey_devicetoken, strval($value) );
		return $this;
	}

	/**
     * 重置 设备pushtoken
     * 设置为 ""
     * @return $this
     */
    public function reset_devicetoken()
    {
        return $this->reset_defaultValue(self::DBKey_devicetoken);
    }

    /**
     * 设置 设备pushtoken 默认值
     */
    protected function _set_defaultvalue_devicetoken()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_devicetoken, "" );
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
        //设置 设备类型 默认值
        $this->_set_defaultvalue_devicetype();
        //设置 设备名称 默认值
        $this->_set_defaultvalue_devicename();
        //设置 设备pushtoken 默认值
        $this->_set_defaultvalue_devicetoken();

    }
}