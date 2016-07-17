<?php

namespace dbs\templates;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_restaurantinfo
 * @package dbs\templates
 */
abstract class dbs_templates_restaurantinfo extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "restaurant";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "restaurantinfo" );
    }
    /**
     * 餐厅等级
     *
     * @var
     */
    const DBKey_restaurantlevel = "restaurantlevel";

	/**
	 * 获取 餐厅等级
	 * @return int
	 */
	public function get_restaurantlevel()
	{
		return $this->getdata ( self::DBKey_restaurantlevel );
	}

	/**
	 * 设置 餐厅等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_restaurantlevel($value)
	{
		$this->setdata ( self::DBKey_restaurantlevel, intval($value) );
		return $this;
	}

	/**
     * 重置 餐厅等级
     * 设置为 1
     * @return $this
     */
    public function reset_restaurantlevel()
    {
        return $this->reset_defaultValue(self::DBKey_restaurantlevel);
    }

    /**
     * 设置 餐厅等级 默认值
     */
    protected function _set_defaultvalue_restaurantlevel()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_restaurantlevel, 1 );
    }
    /**
     * 餐厅校验
     *
     * @var
     */
    const DBKey_restaurantexp = "restaurantexp";

	/**
	 * 获取 餐厅校验
	 * @return int
	 */
	public function get_restaurantexp()
	{
		return $this->getdata ( self::DBKey_restaurantexp );
	}

	/**
	 * 设置 餐厅校验
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_restaurantexp($value)
	{
		$this->setdata ( self::DBKey_restaurantexp, intval($value) );
		return $this;
	}

	/**
     * 重置 餐厅校验
     * 设置为 0
     * @return $this
     */
    public function reset_restaurantexp()
    {
        return $this->reset_defaultValue(self::DBKey_restaurantexp);
    }

    /**
     * 设置 餐厅校验 默认值
     */
    protected function _set_defaultvalue_restaurantexp()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_restaurantexp, 0 );
    }
    /**
     * 餐厅总校验
     *
     * @var
     */
    const DBKey_restauranttotalexp = "restauranttotalexp";

	/**
	 * 获取 餐厅总校验
	 * @return int
	 */
	public function get_restauranttotalexp()
	{
		return $this->getdata ( self::DBKey_restauranttotalexp );
	}

	/**
	 * 设置 餐厅总校验
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_restauranttotalexp($value)
	{
		$this->setdata ( self::DBKey_restauranttotalexp, intval($value) );
		return $this;
	}

	/**
     * 重置 餐厅总校验
     * 设置为 0
     * @return $this
     */
    public function reset_restauranttotalexp()
    {
        return $this->reset_defaultValue(self::DBKey_restauranttotalexp);
    }

    /**
     * 设置 餐厅总校验 默认值
     */
    protected function _set_defaultvalue_restauranttotalexp()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_restauranttotalexp, 0 );
    }
    /**
     * 客流量
     *
     * @var
     */
    const DBKey_customs = "customs";

	/**
	 * 获取 客流量
	 * @return int
	 */
	public function get_customs()
	{
		return $this->getdata ( self::DBKey_customs );
	}

	/**
	 * 设置 客流量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_customs($value)
	{
		$this->setdata ( self::DBKey_customs, intval($value) );
		return $this;
	}

	/**
     * 重置 客流量
     * 设置为 0
     * @return $this
     */
    public function reset_customs()
    {
        return $this->reset_defaultValue(self::DBKey_customs);
    }

    /**
     * 设置 客流量 默认值
     */
    protected function _set_defaultvalue_customs()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_customs, 0 );
    }
    /**
     * 特殊顾客客流量
     *
     * @var
     */
    const DBKey_customvips = "customvips";

	/**
	 * 获取 特殊顾客客流量
	 * @return int
	 */
	public function get_customvips()
	{
		return $this->getdata ( self::DBKey_customvips );
	}

	/**
	 * 设置 特殊顾客客流量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_customvips($value)
	{
		$this->setdata ( self::DBKey_customvips, intval($value) );
		return $this;
	}

	/**
     * 重置 特殊顾客客流量
     * 设置为 0
     * @return $this
     */
    public function reset_customvips()
    {
        return $this->reset_defaultValue(self::DBKey_customvips);
    }

    /**
     * 设置 特殊顾客客流量 默认值
     */
    protected function _set_defaultvalue_customvips()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_customvips, 0 );
    }
    /**
     * 领取到升级奖励的等级
     *
     * @var
     */
    const DBKey_recvRestaurantAwardLevel = "recvRestaurantAwardLevel";

	/**
	 * 获取 领取到升级奖励的等级
	 * @return int
	 */
	public function get_recvRestaurantAwardLevel()
	{
		return $this->getdata ( self::DBKey_recvRestaurantAwardLevel );
	}

	/**
	 * 设置 领取到升级奖励的等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_recvRestaurantAwardLevel($value)
	{
		$this->setdata ( self::DBKey_recvRestaurantAwardLevel, intval($value) );
		return $this;
	}

	/**
     * 重置 领取到升级奖励的等级
     * 设置为 1
     * @return $this
     */
    public function reset_recvRestaurantAwardLevel()
    {
        return $this->reset_defaultValue(self::DBKey_recvRestaurantAwardLevel);
    }

    /**
     * 设置 领取到升级奖励的等级 默认值
     */
    protected function _set_defaultvalue_recvRestaurantAwardLevel()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_recvRestaurantAwardLevel, 1 );
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
        //设置 餐厅等级 默认值
        $this->_set_defaultvalue_restaurantlevel();
        //设置 餐厅校验 默认值
        $this->_set_defaultvalue_restaurantexp();
        //设置 餐厅总校验 默认值
        $this->_set_defaultvalue_restauranttotalexp();
        //设置 客流量 默认值
        $this->_set_defaultvalue_customs();
        //设置 特殊顾客客流量 默认值
        $this->_set_defaultvalue_customvips();
        //设置 领取到升级奖励的等级 默认值
        $this->_set_defaultvalue_recvRestaurantAwardLevel();

    }
}