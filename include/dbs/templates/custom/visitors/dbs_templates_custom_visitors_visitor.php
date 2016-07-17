<?php

namespace dbs\templates\custom\visitors;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_custom_visitors_visitor
 * @package dbs\templates\custom\visitors
 */
class dbs_templates_custom_visitors_visitor extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "custom.visitors.visitor" );
    }
    /**
     * 顾客唯一ID
     *
     * @var
     */
    const DBKey_customId = "customId";

	/**
	 * 获取 顾客唯一ID
	 * @return string
	 */
	public function get_customId()
	{
		return $this->getdata ( self::DBKey_customId );
	}

	/**
	 * 设置 顾客唯一ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_customId($value)
	{
		$this->setdata ( self::DBKey_customId, strval($value) );
		return $this;
	}

	/**
     * 重置 顾客唯一ID
     * 设置为 ""
     * @return $this
     */
    public function reset_customId()
    {
        return $this->reset_defaultValue(self::DBKey_customId);
    }

    /**
     * 设置 顾客唯一ID 默认值
     */
    protected function _set_defaultvalue_customId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_customId, "" );
    }
    /**
     * 生成时间
     *
     * @var
     */
    const DBKey_startTime = "startTime";

	/**
	 * 获取 生成时间
	 * @return int
	 */
	public function get_startTime()
	{
		return $this->getdata ( self::DBKey_startTime );
	}

	/**
	 * 设置 生成时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_startTime($value)
	{
		$this->setdata ( self::DBKey_startTime, intval($value) );
		return $this;
	}

	/**
     * 重置 生成时间
     * 设置为 0
     * @return $this
     */
    public function reset_startTime()
    {
        return $this->reset_defaultValue(self::DBKey_startTime);
    }

    /**
     * 设置 生成时间 默认值
     */
    protected function _set_defaultvalue_startTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_startTime, 0 );
    }
    /**
     * 结束时间
     *
     * @var
     */
    const DBKey_endTime = "endTime";

	/**
	 * 获取 结束时间
	 * @return int
	 */
	public function get_endTime()
	{
		return $this->getdata ( self::DBKey_endTime );
	}

	/**
	 * 设置 结束时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_endTime($value)
	{
		$this->setdata ( self::DBKey_endTime, intval($value) );
		return $this;
	}

	/**
     * 重置 结束时间
     * 设置为 0
     * @return $this
     */
    public function reset_endTime()
    {
        return $this->reset_defaultValue(self::DBKey_endTime);
    }

    /**
     * 设置 结束时间 默认值
     */
    protected function _set_defaultvalue_endTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_endTime, 0 );
    }
    /**
     * 顾客类型
     *
     * @var
     */
    const DBKey_customType = "customType";

	/**
	 * 获取 顾客类型
	 * @return int
	 */
	public function get_customType()
	{
		return $this->getdata ( self::DBKey_customType );
	}

	/**
	 * 设置 顾客类型
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_customType($value)
	{
		$this->setdata ( self::DBKey_customType, intval($value) );
		return $this;
	}

	/**
     * 重置 顾客类型
     * 设置为 0
     * @return $this
     */
    public function reset_customType()
    {
        return $this->reset_defaultValue(self::DBKey_customType);
    }

    /**
     * 设置 顾客类型 默认值
     */
    protected function _set_defaultvalue_customType()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_customType, 0 );
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
        //设置 顾客唯一ID 默认值
        $this->_set_defaultvalue_customId();
        //设置 生成时间 默认值
        $this->_set_defaultvalue_startTime();
        //设置 结束时间 默认值
        $this->_set_defaultvalue_endTime();
        //设置 顾客类型 默认值
        $this->_set_defaultvalue_customType();

    }
}