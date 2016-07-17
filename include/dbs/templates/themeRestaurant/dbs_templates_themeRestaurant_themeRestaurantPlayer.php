<?php

namespace dbs\templates\themeRestaurant;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_themeRestaurant_themeRestaurantPlayer
 * @package dbs\templates\themeRestaurant
 */
abstract class dbs_templates_themeRestaurant_themeRestaurantPlayer extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "themeRestaurant_themeRestaurantPlayer";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "themeRestaurant.themeRestaurantPlayer" );
    }
    /**
     * 主题餐厅信息列表
     *
     * @var
     */
    const DBKey_themeRestaurantInfos = "themeRestaurantInfos";

	/**
	 * 获取 主题餐厅信息列表
	 * @return array
	 */
	public function get_themeRestaurantInfos()
	{
		return $this->getdata ( self::DBKey_themeRestaurantInfos );
	}

	/**
	 * 设置 主题餐厅信息列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_themeRestaurantInfos($value)
	{
		$this->setdata ( self::DBKey_themeRestaurantInfos, $value );
		return $this;
	}

	/**
     * 重置 主题餐厅信息列表
     * 设置为 []
     * @return $this
     */
    public function reset_themeRestaurantInfos()
    {
        return $this->reset_defaultValue(self::DBKey_themeRestaurantInfos);
    }

    /**
     * 设置 主题餐厅信息列表 默认值
     */
    protected function _set_defaultvalue_themeRestaurantInfos()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_themeRestaurantInfos, [] );
    }
    /**
     * 正在经营,主要经营餐厅
     *
     * @var
     */
    const DBKey_mainRestaurantId = "mainRestaurantId";

	/**
	 * 获取 正在经营,主要经营餐厅
	 * @return int
	 */
	public function get_mainRestaurantId()
	{
		return $this->getdata ( self::DBKey_mainRestaurantId );
	}

	/**
	 * 设置 正在经营,主要经营餐厅
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_mainRestaurantId($value)
	{
		$this->setdata ( self::DBKey_mainRestaurantId, intval($value) );
		return $this;
	}

	/**
     * 重置 正在经营,主要经营餐厅
     * 设置为 0
     * @return $this
     */
    public function reset_mainRestaurantId()
    {
        return $this->reset_defaultValue(self::DBKey_mainRestaurantId);
    }

    /**
     * 设置 正在经营,主要经营餐厅 默认值
     */
    protected function _set_defaultvalue_mainRestaurantId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mainRestaurantId, 0 );
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
        //设置 主题餐厅信息列表 默认值
        $this->_set_defaultvalue_themeRestaurantInfos();
        //设置 正在经营,主要经营餐厅 默认值
        $this->_set_defaultvalue_mainRestaurantId();

    }
}