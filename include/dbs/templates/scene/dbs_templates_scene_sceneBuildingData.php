<?php

namespace dbs\templates\scene;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_scene_sceneBuildingData
 * @package dbs\templates\scene
 */
class dbs_templates_scene_sceneBuildingData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "scene.sceneBuildingData" );
    }
    /**
     * 唯一ID
     *
     * @var
     */
    const DBKey_guid = "guid";

	/**
	 * 获取 唯一ID
	 * @return string
	 */
	public function get_guid()
	{
		return $this->getdata ( self::DBKey_guid );
	}

	/**
	 * 设置 唯一ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_guid($value)
	{
		$this->setdata ( self::DBKey_guid, strval($value) );
		return $this;
	}

	/**
     * 重置 唯一ID
     * 设置为 ""
     * @return $this
     */
    public function reset_guid()
    {
        return $this->reset_defaultValue(self::DBKey_guid);
    }

    /**
     * 设置 唯一ID 默认值
     */
    protected function _set_defaultvalue_guid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_guid, "" );
    }
    /**
     * 主题餐厅ID
     *
     * @var
     */
    const DBKey_themeRestaurantId = "themeRestaurantId";

	/**
	 * 获取 主题餐厅ID
	 * @return int
	 */
	public function get_themeRestaurantId()
	{
		return $this->getdata ( self::DBKey_themeRestaurantId );
	}

	/**
	 * 设置 主题餐厅ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_themeRestaurantId($value)
	{
		$this->setdata ( self::DBKey_themeRestaurantId, intval($value) );
		return $this;
	}

	/**
     * 重置 主题餐厅ID
     * 设置为 0
     * @return $this
     */
    public function reset_themeRestaurantId()
    {
        return $this->reset_defaultValue(self::DBKey_themeRestaurantId);
    }

    /**
     * 设置 主题餐厅ID 默认值
     */
    protected function _set_defaultvalue_themeRestaurantId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_themeRestaurantId, 0 );
    }
    /**
     * 装饰道具ID
     *
     * @var
     */
    const DBKey_templateItemId = "templateItemId";

	/**
	 * 获取 装饰道具ID
	 * @return string
	 */
	public function get_templateItemId()
	{
		return $this->getdata ( self::DBKey_templateItemId );
	}

	/**
	 * 设置 装饰道具ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_templateItemId($value)
	{
		$this->setdata ( self::DBKey_templateItemId, strval($value) );
		return $this;
	}

	/**
     * 重置 装饰道具ID
     * 设置为 ""
     * @return $this
     */
    public function reset_templateItemId()
    {
        return $this->reset_defaultValue(self::DBKey_templateItemId);
    }

    /**
     * 设置 装饰道具ID 默认值
     */
    protected function _set_defaultvalue_templateItemId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_templateItemId, "" );
    }
    /**
     * x坐标
     *
     * @var
     */
    const DBKey_x = "x";

	/**
	 * 获取 x坐标
	 * @return int
	 */
	public function get_x()
	{
		return $this->getdata ( self::DBKey_x );
	}

	/**
	 * 设置 x坐标
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_x($value)
	{
		$this->setdata ( self::DBKey_x, intval($value) );
		return $this;
	}

	/**
     * 重置 x坐标
     * 设置为 0
     * @return $this
     */
    public function reset_x()
    {
        return $this->reset_defaultValue(self::DBKey_x);
    }

    /**
     * 设置 x坐标 默认值
     */
    protected function _set_defaultvalue_x()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_x, 0 );
    }
    /**
     * y坐标
     *
     * @var
     */
    const DBKey_y = "y";

	/**
	 * 获取 y坐标
	 * @return int
	 */
	public function get_y()
	{
		return $this->getdata ( self::DBKey_y );
	}

	/**
	 * 设置 y坐标
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_y($value)
	{
		$this->setdata ( self::DBKey_y, intval($value) );
		return $this;
	}

	/**
     * 重置 y坐标
     * 设置为 0
     * @return $this
     */
    public function reset_y()
    {
        return $this->reset_defaultValue(self::DBKey_y);
    }

    /**
     * 设置 y坐标 默认值
     */
    protected function _set_defaultvalue_y()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_y, 0 );
    }
    /**
     * 方向
     *
     * @var
     */
    const DBKey_direct = "direct";

	/**
	 * 获取 方向
	 * @return int
	 */
	public function get_direct()
	{
		return $this->getdata ( self::DBKey_direct );
	}

	/**
	 * 设置 方向
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_direct($value)
	{
		$this->setdata ( self::DBKey_direct, intval($value) );
		return $this;
	}

	/**
     * 重置 方向
     * 设置为 0
     * @return $this
     */
    public function reset_direct()
    {
        return $this->reset_defaultValue(self::DBKey_direct);
    }

    /**
     * 设置 方向 默认值
     */
    protected function _set_defaultvalue_direct()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_direct, 0 );
    }
    /**
     * 实际占地坐标
     *
     * @var
     */
    const DBKey_cells = "cells";

	/**
	 * 获取 实际占地坐标
	 * @return array
	 */
	public function get_cells()
	{
		return $this->getdata ( self::DBKey_cells );
	}

	/**
	 * 设置 实际占地坐标
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_cells($value)
	{
		$this->setdata ( self::DBKey_cells, $value );
		return $this;
	}

	/**
     * 重置 实际占地坐标
     * 设置为 []
     * @return $this
     */
    public function reset_cells()
    {
        return $this->reset_defaultValue(self::DBKey_cells);
    }

    /**
     * 设置 实际占地坐标 默认值
     */
    protected function _set_defaultvalue_cells()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cells, [] );
    }
    /**
     * 扩展信息
     *
     * @var
     */
    const DBKey_extendInfo = "extendInfo";

	/**
	 * 获取 扩展信息
	 * @return array
	 */
	public function get_extendInfo()
	{
		return $this->getdata ( self::DBKey_extendInfo );
	}

	/**
	 * 设置 扩展信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_extendInfo($value)
	{
		$this->setdata ( self::DBKey_extendInfo, $value );
		return $this;
	}

	/**
     * 重置 扩展信息
     * 设置为 []
     * @return $this
     */
    public function reset_extendInfo()
    {
        return $this->reset_defaultValue(self::DBKey_extendInfo);
    }

    /**
     * 设置 扩展信息 默认值
     */
    protected function _set_defaultvalue_extendInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_extendInfo, [] );
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
        //设置 唯一ID 默认值
        $this->_set_defaultvalue_guid();
        //设置 主题餐厅ID 默认值
        $this->_set_defaultvalue_themeRestaurantId();
        //设置 装饰道具ID 默认值
        $this->_set_defaultvalue_templateItemId();
        //设置 x坐标 默认值
        $this->_set_defaultvalue_x();
        //设置 y坐标 默认值
        $this->_set_defaultvalue_y();
        //设置 方向 默认值
        $this->_set_defaultvalue_direct();
        //设置 实际占地坐标 默认值
        $this->_set_defaultvalue_cells();
        //设置 扩展信息 默认值
        $this->_set_defaultvalue_extendInfo();

    }
}