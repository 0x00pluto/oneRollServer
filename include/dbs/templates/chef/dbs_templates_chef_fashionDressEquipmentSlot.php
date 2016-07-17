<?php

namespace dbs\templates\chef;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_fashionDressEquipmentSlot
 * @package dbs\templates\chef
 */
class dbs_templates_chef_fashionDressEquipmentSlot extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.fashionDressEquipmentSlot" );
    }
    /**
     * 位置信息
     *
     * @var
     */
    const DBKey_position = "position";

	/**
	 * 获取 位置信息
	 * @return string
	 */
	public function get_position()
	{
		return $this->getdata ( self::DBKey_position );
	}

	/**
	 * 设置 位置信息
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_position($value)
	{
		$this->setdata ( self::DBKey_position, strval($value) );
		return $this;
	}

	/**
     * 重置 位置信息
     * 设置为 ""
     * @return $this
     */
    public function reset_position()
    {
        return $this->reset_defaultValue(self::DBKey_position);
    }

    /**
     * 设置 位置信息 默认值
     */
    protected function _set_defaultvalue_position()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_position, "" );
    }
    /**
     * 道具信息
     *
     * @var
     */
    const DBKey_itemInfo = "itemInfo";

	/**
	 * 获取 道具信息
	 * @return array
	 */
	public function get_itemInfo()
	{
		return $this->getdata ( self::DBKey_itemInfo );
	}

	/**
	 * 设置 道具信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_itemInfo($value)
	{
		$this->setdata ( self::DBKey_itemInfo, $value );
		return $this;
	}

	/**
     * 重置 道具信息
     * 设置为 []
     * @return $this
     */
    public function reset_itemInfo()
    {
        return $this->reset_defaultValue(self::DBKey_itemInfo);
    }

    /**
     * 设置 道具信息 默认值
     */
    protected function _set_defaultvalue_itemInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemInfo, [] );
    }
    /**
     * 是否是主要装备,不是装备分身占位
     *
     * @var
     */
    const DBKey_isMaster = "isMaster";

	/**
	 * 获取 是否是主要装备,不是装备分身占位
	 * @return bool
	 */
	public function get_isMaster()
	{
		return $this->getdata ( self::DBKey_isMaster );
	}

	/**
	 * 设置 是否是主要装备,不是装备分身占位
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isMaster($value)
	{
		$this->setdata ( self::DBKey_isMaster, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否是主要装备,不是装备分身占位
     * 设置为 1
     * @return $this
     */
    public function reset_isMaster()
    {
        return $this->reset_defaultValue(self::DBKey_isMaster);
    }

    /**
     * 设置 是否是主要装备,不是装备分身占位 默认值
     */
    protected function _set_defaultvalue_isMaster()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isMaster, 1 );
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
        //设置 位置信息 默认值
        $this->_set_defaultvalue_position();
        //设置 道具信息 默认值
        $this->_set_defaultvalue_itemInfo();
        //设置 是否是主要装备,不是装备分身占位 默认值
        $this->_set_defaultvalue_isMaster();

    }
}