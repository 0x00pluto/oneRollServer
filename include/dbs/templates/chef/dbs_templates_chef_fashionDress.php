<?php

namespace dbs\templates\chef;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_fashionDress
 * @package dbs\templates\chef
 */
class dbs_templates_chef_fashionDress extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.fashionDress" );
    }
    /**
     * 装备数据
     *
     * @var
     */
    const DBKey_equipments = "equipments";

	/**
	 * 获取 装备数据
	 * @return array
	 */
	public function get_equipments()
	{
		return $this->getdata ( self::DBKey_equipments );
	}

	/**
	 * 设置 装备数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_equipments($value)
	{
		$this->setdata ( self::DBKey_equipments, $value );
		return $this;
	}

	/**
     * 重置 装备数据
     * 设置为 []
     * @return $this
     */
    public function reset_equipments()
    {
        return $this->reset_defaultValue(self::DBKey_equipments);
    }

    /**
     * 设置 装备数据 默认值
     */
    protected function _set_defaultvalue_equipments()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_equipments, [] );
    }
    /**
     * 魅力值
     *
     * @var
     */
    const DBKey_charmvalue = "charmvalue";

	/**
	 * 获取 魅力值
	 * @return int
	 */
	public function get_charmvalue()
	{
		return $this->getdata ( self::DBKey_charmvalue );
	}

	/**
	 * 设置 魅力值
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_charmvalue($value)
	{
		$this->setdata ( self::DBKey_charmvalue, intval($value) );
		return $this;
	}

	/**
     * 重置 魅力值
     * 设置为 0
     * @return $this
     */
    public function reset_charmvalue()
    {
        return $this->reset_defaultValue(self::DBKey_charmvalue);
    }

    /**
     * 设置 魅力值 默认值
     */
    protected function _set_defaultvalue_charmvalue()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_charmvalue, 0 );
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
        //设置 装备数据 默认值
        $this->_set_defaultvalue_equipments();
        //设置 魅力值 默认值
        $this->_set_defaultvalue_charmvalue();

    }
}