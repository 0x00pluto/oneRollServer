<?php

namespace dbs\templates\scene\BuildingData;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_scene_BuildingData_dinnerTable
 * @package dbs\templates\scene\BuildingData
 */
class dbs_templates_scene_BuildingData_dinnerTable extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "scene.BuildingData.dinnerTable" );
    }
    /**
     * 状态
     *
     * @var
     */
    const DBKey_status = "status";

	/**
	 * 获取 状态
	 * @return int
	 */
	public function get_status()
	{
		return $this->getdata ( self::DBKey_status );
	}

	/**
	 * 设置 状态
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_status($value)
	{
		$this->setdata ( self::DBKey_status, intval($value) );
		return $this;
	}

	/**
     * 重置 状态
     * 设置为 0
     * @return $this
     */
    public function reset_status()
    {
        return $this->reset_defaultValue(self::DBKey_status);
    }

    /**
     * 设置 状态 默认值
     */
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_status, 0 );
    }
    /**
     * 菜品ID
     *
     * @var
     */
    const DBKey_dishesId = "dishesId";

	/**
	 * 获取 菜品ID
	 * @return string
	 */
	public function get_dishesId()
	{
		return $this->getdata ( self::DBKey_dishesId );
	}

	/**
	 * 设置 菜品ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_dishesId($value)
	{
		$this->setdata ( self::DBKey_dishesId, strval($value) );
		return $this;
	}

	/**
     * 重置 菜品ID
     * 设置为 ""
     * @return $this
     */
    public function reset_dishesId()
    {
        return $this->reset_defaultValue(self::DBKey_dishesId);
    }

    /**
     * 设置 菜品ID 默认值
     */
    protected function _set_defaultvalue_dishesId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_dishesId, "" );
    }
    /**
     * 上次销售时间
     *
     * @var
     */
    const DBKey_lastSellTime = "lastSellTime";

	/**
	 * 获取 上次销售时间
	 * @return int
	 */
	public function get_lastSellTime()
	{
		return $this->getdata ( self::DBKey_lastSellTime );
	}

	/**
	 * 设置 上次销售时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_lastSellTime($value)
	{
		$this->setdata ( self::DBKey_lastSellTime, intval($value) );
		return $this;
	}

	/**
     * 重置 上次销售时间
     * 设置为 0
     * @return $this
     */
    public function reset_lastSellTime()
    {
        return $this->reset_defaultValue(self::DBKey_lastSellTime);
    }

    /**
     * 设置 上次销售时间 默认值
     */
    protected function _set_defaultvalue_lastSellTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastSellTime, 0 );
    }
    /**
     * 菜品数据
     *
     * @var
     */
    const DBKey_dishesArr = "dishesArr";

	/**
	 * 获取 菜品数据
	 * @return array
	 */
	public function get_dishesArr()
	{
		return $this->getdata ( self::DBKey_dishesArr );
	}

	/**
	 * 设置 菜品数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_dishesArr($value)
	{
		$this->setdata ( self::DBKey_dishesArr, $value );
		return $this;
	}

	/**
     * 重置 菜品数据
     * 设置为 []
     * @return $this
     */
    public function reset_dishesArr()
    {
        return $this->reset_defaultValue(self::DBKey_dishesArr);
    }

    /**
     * 设置 菜品数据 默认值
     */
    protected function _set_defaultvalue_dishesArr()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_dishesArr, [] );
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
        //设置 状态 默认值
        $this->_set_defaultvalue_status();
        //设置 菜品ID 默认值
        $this->_set_defaultvalue_dishesId();
        //设置 上次销售时间 默认值
        $this->_set_defaultvalue_lastSellTime();
        //设置 菜品数据 默认值
        $this->_set_defaultvalue_dishesArr();

    }
}