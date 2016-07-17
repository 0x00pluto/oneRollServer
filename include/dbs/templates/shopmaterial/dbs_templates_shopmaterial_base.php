<?php

namespace dbs\templates\shopmaterial;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_shopmaterial_base
 * @package dbs\templates\shopmaterial
 */
abstract class dbs_templates_shopmaterial_base extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "shopmaterial.base" );
    }
    /**
     * 等级
     *
     * @var
     */
    const DBKey_level = "level";

	/**
	 * 获取 等级
	 * @return int
	 */
	public function get_level()
	{
		return $this->getdata ( self::DBKey_level );
	}

	/**
	 * 设置 等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_level($value)
	{
		$this->setdata ( self::DBKey_level, intval($value) );
		return $this;
	}

	/**
     * 重置 等级
     * 设置为 1
     * @return $this
     */
    public function reset_level()
    {
        return $this->reset_defaultValue(self::DBKey_level);
    }

    /**
     * 设置 等级 默认值
     */
    protected function _set_defaultvalue_level()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_level, 1 );
    }
    /**
     * 商店ID
     *
     * @var
     */
    const DBKey_shopid = "shopid";

	/**
	 * 获取 商店ID
	 * @return string
	 */
	public function get_shopid()
	{
		return $this->getdata ( self::DBKey_shopid );
	}

	/**
	 * 设置 商店ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_shopid($value)
	{
		$this->setdata ( self::DBKey_shopid, strval($value) );
		return $this;
	}

	/**
     * 重置 商店ID
     * 设置为 ""
     * @return $this
     */
    public function reset_shopid()
    {
        return $this->reset_defaultValue(self::DBKey_shopid);
    }

    /**
     * 设置 商店ID 默认值
     */
    protected function _set_defaultvalue_shopid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_shopid, "" );
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
        //设置 等级 默认值
        $this->_set_defaultvalue_level();
        //设置 商店ID 默认值
        $this->_set_defaultvalue_shopid();

    }
}