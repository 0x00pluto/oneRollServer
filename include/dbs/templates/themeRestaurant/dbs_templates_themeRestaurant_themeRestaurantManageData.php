<?php

namespace dbs\templates\themeRestaurant;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_themeRestaurant_themeRestaurantManageData
 * @package dbs\templates\themeRestaurant
 */
class dbs_templates_themeRestaurant_themeRestaurantManageData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "themeRestaurant.themeRestaurantManageData" );
    }
    /**
     * 是否自动经营
     *
     * @var
     */
    const DBKey_autoManage = "autoManage";

	/**
	 * 获取 是否自动经营
	 * @return bool
	 */
	public function get_autoManage()
	{
		return $this->getdata ( self::DBKey_autoManage );
	}

	/**
	 * 设置 是否自动经营
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_autoManage($value)
	{
		$this->setdata ( self::DBKey_autoManage, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否自动经营
     * 设置为 false
     * @return $this
     */
    public function reset_autoManage()
    {
        return $this->reset_defaultValue(self::DBKey_autoManage);
    }

    /**
     * 设置 是否自动经营 默认值
     */
    protected function _set_defaultvalue_autoManage()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_autoManage, false );
    }
    /**
     * 下次收获的开始时间
     *
     * @var
     */
    const DBKey_nextHarvestStartTime = "nextHarvestStartTime";

	/**
	 * 获取 下次收获的开始时间
	 * @return int
	 */
	public function get_nextHarvestStartTime()
	{
		return $this->getdata ( self::DBKey_nextHarvestStartTime );
	}

	/**
	 * 设置 下次收获的开始时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_nextHarvestStartTime($value)
	{
		$this->setdata ( self::DBKey_nextHarvestStartTime, intval($value) );
		return $this;
	}

	/**
     * 重置 下次收获的开始时间
     * 设置为 0
     * @return $this
     */
    public function reset_nextHarvestStartTime()
    {
        return $this->reset_defaultValue(self::DBKey_nextHarvestStartTime);
    }

    /**
     * 设置 下次收获的开始时间 默认值
     */
    protected function _set_defaultvalue_nextHarvestStartTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_nextHarvestStartTime, 0 );
    }
    /**
     * 下次收获的结束时间
     *
     * @var
     */
    const DBKey_nextHarvestEndTime = "nextHarvestEndTime";

	/**
	 * 获取 下次收获的结束时间
	 * @return int
	 */
	public function get_nextHarvestEndTime()
	{
		return $this->getdata ( self::DBKey_nextHarvestEndTime );
	}

	/**
	 * 设置 下次收获的结束时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_nextHarvestEndTime($value)
	{
		$this->setdata ( self::DBKey_nextHarvestEndTime, intval($value) );
		return $this;
	}

	/**
     * 重置 下次收获的结束时间
     * 设置为 0
     * @return $this
     */
    public function reset_nextHarvestEndTime()
    {
        return $this->reset_defaultValue(self::DBKey_nextHarvestEndTime);
    }

    /**
     * 设置 下次收获的结束时间 默认值
     */
    protected function _set_defaultvalue_nextHarvestEndTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_nextHarvestEndTime, 0 );
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
        //设置 是否自动经营 默认值
        $this->_set_defaultvalue_autoManage();
        //设置 下次收获的开始时间 默认值
        $this->_set_defaultvalue_nextHarvestStartTime();
        //设置 下次收获的结束时间 默认值
        $this->_set_defaultvalue_nextHarvestEndTime();

    }
}