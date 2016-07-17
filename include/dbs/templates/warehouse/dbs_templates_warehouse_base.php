<?php

namespace dbs\templates\warehouse;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_warehouse_base
 * @package dbs\templates\warehouse
 */
abstract class dbs_templates_warehouse_base extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "warehouse.base" );
    }
    /**
     * 所有道具
     *
     * @var
     */
    const DBKey_items = "items";

	/**
	 * 获取 所有道具
	 * @return array
	 */
	public function get_items()
	{
		return $this->getdata ( self::DBKey_items );
	}

	/**
	 * 设置 所有道具
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_items($value)
	{
		$this->setdata ( self::DBKey_items, $value );
		return $this;
	}

	/**
     * 重置 所有道具
     * 设置为 []
     * @return $this
     */
    public function reset_items()
    {
        return $this->reset_defaultValue(self::DBKey_items);
    }

    /**
     * 设置 所有道具 默认值
     */
    protected function _set_defaultvalue_items()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_items, [] );
    }
    /**
     * 仓库等级
     *
     * @var
     */
    const DBKey_level = "level";

	/**
	 * 获取 仓库等级
	 * @return int
	 */
	public function get_level()
	{
		return $this->getdata ( self::DBKey_level );
	}

	/**
	 * 设置 仓库等级
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
     * 重置 仓库等级
     * 设置为 1
     * @return $this
     */
    public function reset_level()
    {
        return $this->reset_defaultValue(self::DBKey_level);
    }

    /**
     * 设置 仓库等级 默认值
     */
    protected function _set_defaultvalue_level()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_level, 1 );
    }
    /**
     * 仓库大小
     *
     * @var
     */
    const DBKey_size = "size";

	/**
	 * 获取 仓库大小
	 * @return int
	 */
	public function get_size()
	{
		return $this->getdata ( self::DBKey_size );
	}

	/**
	 * 设置 仓库大小
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_size($value)
	{
		$this->setdata ( self::DBKey_size, intval($value) );
		return $this;
	}

	/**
     * 重置 仓库大小
     * 设置为 -1
     * @return $this
     */
    public function reset_size()
    {
        return $this->reset_defaultValue(self::DBKey_size);
    }

    /**
     * 设置 仓库大小 默认值
     */
    protected function _set_defaultvalue_size()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_size, -1 );
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
        //设置 所有道具 默认值
        $this->_set_defaultvalue_items();
        //设置 仓库等级 默认值
        $this->_set_defaultvalue_level();
        //设置 仓库大小 默认值
        $this->_set_defaultvalue_size();

    }
}