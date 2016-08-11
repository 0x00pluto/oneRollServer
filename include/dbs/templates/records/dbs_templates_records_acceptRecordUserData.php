<?php

namespace dbs\templates\records;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_records_acceptRecordUserData
 * @package dbs\templates\records
 */
class dbs_templates_records_acceptRecordUserData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "records.acceptRecordUserData" );
    }
    /**
     * 名称
     *
     * @var
     */
    const DBKey_name = "name";

	/**
	 * 获取 名称
	 * @return string
	 */
	public function get_name()
	{
		return $this->getdata ( self::DBKey_name );
	}

	/**
	 * 设置 名称
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_name($value)
	{
		$this->setdata ( self::DBKey_name, strval($value) );
		return $this;
	}

	/**
     * 重置 名称
     * 设置为 ""
     * @return $this
     */
    public function reset_name()
    {
        return $this->reset_defaultValue(self::DBKey_name);
    }

    /**
     * 设置 名称 默认值
     */
    protected function _set_defaultvalue_name()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_name, "" );
    }
    /**
     * 地址
     *
     * @var
     */
    const DBKey_address = "address";

	/**
	 * 获取 地址
	 * @return string
	 */
	public function get_address()
	{
		return $this->getdata ( self::DBKey_address );
	}

	/**
	 * 设置 地址
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_address($value)
	{
		$this->setdata ( self::DBKey_address, strval($value) );
		return $this;
	}

	/**
     * 重置 地址
     * 设置为 ""
     * @return $this
     */
    public function reset_address()
    {
        return $this->reset_defaultValue(self::DBKey_address);
    }

    /**
     * 设置 地址 默认值
     */
    protected function _set_defaultvalue_address()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_address, "" );
    }
    /**
     * 手机号
     *
     * @var
     */
    const DBKey_mobile = "mobile";

	/**
	 * 获取 手机号
	 * @return string
	 */
	public function get_mobile()
	{
		return $this->getdata ( self::DBKey_mobile );
	}

	/**
	 * 设置 手机号
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_mobile($value)
	{
		$this->setdata ( self::DBKey_mobile, strval($value) );
		return $this;
	}

	/**
     * 重置 手机号
     * 设置为 ""
     * @return $this
     */
    public function reset_mobile()
    {
        return $this->reset_defaultValue(self::DBKey_mobile);
    }

    /**
     * 设置 手机号 默认值
     */
    protected function _set_defaultvalue_mobile()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mobile, "" );
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
        //设置 名称 默认值
        $this->_set_defaultvalue_name();
        //设置 地址 默认值
        $this->_set_defaultvalue_address();
        //设置 手机号 默认值
        $this->_set_defaultvalue_mobile();

    }
}