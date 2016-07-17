<?php

namespace dbs\templates\item;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_item_itemFromInfo
 * @package dbs\templates\item
 */
class dbs_templates_item_itemFromInfo extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "item.itemFromInfo" );
    }
    /**
     * 来源类型
     *
     * @var
     */
    const DBKey_FromType = "FromType";

	/**
	 * 获取 来源类型
	 * @return int
	 */
	public function get_FromType()
	{
		return $this->getdata ( self::DBKey_FromType );
	}

	/**
	 * 设置 来源类型
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_FromType($value)
	{
		$this->setdata ( self::DBKey_FromType, intval($value) );
		return $this;
	}

	/**
     * 重置 来源类型
     * 设置为 0
     * @return $this
     */
    public function reset_FromType()
    {
        return $this->reset_defaultValue(self::DBKey_FromType);
    }

    /**
     * 设置 来源类型 默认值
     */
    protected function _set_defaultvalue_FromType()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_FromType, 0 );
    }
    /**
     * 来源信息
     *
     * @var
     */
    const DBKey_FromInfo = "FromInfo";

	/**
	 * 获取 来源信息
	 * @return array
	 */
	public function get_FromInfo()
	{
		return $this->getdata ( self::DBKey_FromInfo );
	}

	/**
	 * 设置 来源信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_FromInfo($value)
	{
		$this->setdata ( self::DBKey_FromInfo, $value );
		return $this;
	}

	/**
     * 重置 来源信息
     * 设置为 []
     * @return $this
     */
    public function reset_FromInfo()
    {
        return $this->reset_defaultValue(self::DBKey_FromInfo);
    }

    /**
     * 设置 来源信息 默认值
     */
    protected function _set_defaultvalue_FromInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_FromInfo, [] );
    }
    /**
     * 道具产生时间
     *
     * @var
     */
    const DBKey_createTime = "createTime";

	/**
	 * 获取 道具产生时间
	 * @return int
	 */
	public function get_createTime()
	{
		return $this->getdata ( self::DBKey_createTime );
	}

	/**
	 * 设置 道具产生时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_createTime($value)
	{
		$this->setdata ( self::DBKey_createTime, intval($value) );
		return $this;
	}

	/**
     * 重置 道具产生时间
     * 设置为 0
     * @return $this
     */
    public function reset_createTime()
    {
        return $this->reset_defaultValue(self::DBKey_createTime);
    }

    /**
     * 设置 道具产生时间 默认值
     */
    protected function _set_defaultvalue_createTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_createTime, 0 );
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
        //设置 来源类型 默认值
        $this->_set_defaultvalue_FromType();
        //设置 来源信息 默认值
        $this->_set_defaultvalue_FromInfo();
        //设置 道具产生时间 默认值
        $this->_set_defaultvalue_createTime();

    }
}