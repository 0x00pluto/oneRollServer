<?php

namespace dbs\templates\chef;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_list
 * @package dbs\templates\chef
 */
abstract class dbs_templates_chef_list extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "chef_list";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.list" );
    }
    /**
     * 厨师列表
     *
     * @var
     */
    const DBKey_cheflist = "cheflist";

	/**
	 * 获取 厨师列表
	 * @return array
	 */
	public function get_cheflist()
	{
		return $this->getdata ( self::DBKey_cheflist );
	}

	/**
	 * 设置 厨师列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_cheflist($value)
	{
		$this->setdata ( self::DBKey_cheflist, $value );
		return $this;
	}

	/**
     * 重置 厨师列表
     * 设置为 []
     * @return $this
     */
    public function reset_cheflist()
    {
        return $this->reset_defaultValue(self::DBKey_cheflist);
    }

    /**
     * 设置 厨师列表 默认值
     */
    protected function _set_defaultvalue_cheflist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cheflist, [] );
    }
    /**
     * 厨师选择列表
     *
     * @var
     */
    const DBKey_chooselist = "chooselist";

	/**
	 * 获取 厨师选择列表
	 * @return array
	 */
	public function get_chooselist()
	{
		return $this->getdata ( self::DBKey_chooselist );
	}

	/**
	 * 设置 厨师选择列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_chooselist($value)
	{
		$this->setdata ( self::DBKey_chooselist, $value );
		return $this;
	}

	/**
     * 重置 厨师选择列表
     * 设置为 []
     * @return $this
     */
    public function reset_chooselist()
    {
        return $this->reset_defaultValue(self::DBKey_chooselist);
    }

    /**
     * 设置 厨师选择列表 默认值
     */
    protected function _set_defaultvalue_chooselist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_chooselist, [] );
    }
    /**
     * 体力道具今日使用次数
     *
     * @var
     */
    const DBKey_fillvitItemTodayUseCount = "fillvitItemTodayUseCount";

	/**
	 * 获取 体力道具今日使用次数
	 * @return int
	 */
	public function get_fillvitItemTodayUseCount()
	{
		return $this->getdata ( self::DBKey_fillvitItemTodayUseCount );
	}

	/**
	 * 设置 体力道具今日使用次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_fillvitItemTodayUseCount($value)
	{
		$this->setdata ( self::DBKey_fillvitItemTodayUseCount, intval($value) );
		return $this;
	}

	/**
     * 重置 体力道具今日使用次数
     * 设置为 0
     * @return $this
     */
    public function reset_fillvitItemTodayUseCount()
    {
        return $this->reset_defaultValue(self::DBKey_fillvitItemTodayUseCount);
    }

    /**
     * 设置 体力道具今日使用次数 默认值
     */
    protected function _set_defaultvalue_fillvitItemTodayUseCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_fillvitItemTodayUseCount, 0 );
    }
    /**
     * 今日加速培训测次数
     *
     * @var
     */
    const DBKey_todaySpeedUpTrainChefTimes = "todaySpeedUpTrainChefTimes";

	/**
	 * 获取 今日加速培训测次数
	 * @return int
	 */
	public function get_todaySpeedUpTrainChefTimes()
	{
		return $this->getdata ( self::DBKey_todaySpeedUpTrainChefTimes );
	}

	/**
	 * 设置 今日加速培训测次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_todaySpeedUpTrainChefTimes($value)
	{
		$this->setdata ( self::DBKey_todaySpeedUpTrainChefTimes, intval($value) );
		return $this;
	}

	/**
     * 重置 今日加速培训测次数
     * 设置为 0
     * @return $this
     */
    public function reset_todaySpeedUpTrainChefTimes()
    {
        return $this->reset_defaultValue(self::DBKey_todaySpeedUpTrainChefTimes);
    }

    /**
     * 设置 今日加速培训测次数 默认值
     */
    protected function _set_defaultvalue_todaySpeedUpTrainChefTimes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_todaySpeedUpTrainChefTimes, 0 );
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
        //设置 厨师列表 默认值
        $this->_set_defaultvalue_cheflist();
        //设置 厨师选择列表 默认值
        $this->_set_defaultvalue_chooselist();
        //设置 体力道具今日使用次数 默认值
        $this->_set_defaultvalue_fillvitItemTodayUseCount();
        //设置 今日加速培训测次数 默认值
        $this->_set_defaultvalue_todaySpeedUpTrainChefTimes();

    }
}