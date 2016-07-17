<?php

namespace dbs\templates\mission;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mission_mission
 * @package dbs\templates\mission
 */
abstract class dbs_templates_mission_mission extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "missions";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mission.mission" );
    }
    /**
     * 活动周期
     *
     * @var
     */
    const DBKey_period = "period";

	/**
	 * 获取 活动周期
	 * @return int
	 */
	public function get_period()
	{
		return $this->getdata ( self::DBKey_period );
	}

	/**
	 * 设置 活动周期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_period($value)
	{
		$this->setdata ( self::DBKey_period, intval($value) );
		return $this;
	}

	/**
     * 重置 活动周期
     * 设置为 0
     * @return $this
     */
    public function reset_period()
    {
        return $this->reset_defaultValue(self::DBKey_period);
    }

    /**
     * 设置 活动周期 默认值
     */
    protected function _set_defaultvalue_period()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_period, 0 );
    }
    /**
     * 普通任务进行中列表
     *
     * @var
     */
    const DBKey_normalmissionworking = "normalmissionworking";

	/**
	 * 获取 普通任务进行中列表
	 * @return array
	 */
	public function get_normalmissionworking()
	{
		return $this->getdata ( self::DBKey_normalmissionworking );
	}

	/**
	 * 设置 普通任务进行中列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_normalmissionworking($value)
	{
		$this->setdata ( self::DBKey_normalmissionworking, $value );
		return $this;
	}

	/**
     * 重置 普通任务进行中列表
     * 设置为 []
     * @return $this
     */
    public function reset_normalmissionworking()
    {
        return $this->reset_defaultValue(self::DBKey_normalmissionworking);
    }

    /**
     * 设置 普通任务进行中列表 默认值
     */
    protected function _set_defaultvalue_normalmissionworking()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_normalmissionworking, [] );
    }
    /**
     * 普通任务完成列表
     *
     * @var
     */
    const DBKey_normalmissioncomplete = "normalmissioncomplete";

	/**
	 * 获取 普通任务完成列表
	 * @return array
	 */
	public function get_normalmissioncomplete()
	{
		return $this->getdata ( self::DBKey_normalmissioncomplete );
	}

	/**
	 * 设置 普通任务完成列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_normalmissioncomplete($value)
	{
		$this->setdata ( self::DBKey_normalmissioncomplete, $value );
		return $this;
	}

	/**
     * 重置 普通任务完成列表
     * 设置为 []
     * @return $this
     */
    public function reset_normalmissioncomplete()
    {
        return $this->reset_defaultValue(self::DBKey_normalmissioncomplete);
    }

    /**
     * 设置 普通任务完成列表 默认值
     */
    protected function _set_defaultvalue_normalmissioncomplete()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_normalmissioncomplete, [] );
    }
    /**
     * 活动任务进行中列表
     *
     * @var
     */
    const DBKey_activitymissionworking = "activitymissionworking";

	/**
	 * 获取 活动任务进行中列表
	 * @return array
	 */
	public function get_activitymissionworking()
	{
		return $this->getdata ( self::DBKey_activitymissionworking );
	}

	/**
	 * 设置 活动任务进行中列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_activitymissionworking($value)
	{
		$this->setdata ( self::DBKey_activitymissionworking, $value );
		return $this;
	}

	/**
     * 重置 活动任务进行中列表
     * 设置为 []
     * @return $this
     */
    public function reset_activitymissionworking()
    {
        return $this->reset_defaultValue(self::DBKey_activitymissionworking);
    }

    /**
     * 设置 活动任务进行中列表 默认值
     */
    protected function _set_defaultvalue_activitymissionworking()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_activitymissionworking, [] );
    }
    /**
     * 活动任务完成列表
     *
     * @var
     */
    const DBKey_activitymissioncomplete = "activitymissioncomplete";

	/**
	 * 获取 活动任务完成列表
	 * @return array
	 */
	public function get_activitymissioncomplete()
	{
		return $this->getdata ( self::DBKey_activitymissioncomplete );
	}

	/**
	 * 设置 活动任务完成列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_activitymissioncomplete($value)
	{
		$this->setdata ( self::DBKey_activitymissioncomplete, $value );
		return $this;
	}

	/**
     * 重置 活动任务完成列表
     * 设置为 []
     * @return $this
     */
    public function reset_activitymissioncomplete()
    {
        return $this->reset_defaultValue(self::DBKey_activitymissioncomplete);
    }

    /**
     * 设置 活动任务完成列表 默认值
     */
    protected function _set_defaultvalue_activitymissioncomplete()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_activitymissioncomplete, [] );
    }
    /**
     * 进行中的成就任务
     *
     * @var
     */
    const DBKey_achievementmissionworking = "achievementmissionworking";

	/**
	 * 获取 进行中的成就任务
	 * @return array
	 */
	public function get_achievementmissionworking()
	{
		return $this->getdata ( self::DBKey_achievementmissionworking );
	}

	/**
	 * 设置 进行中的成就任务
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_achievementmissionworking($value)
	{
		$this->setdata ( self::DBKey_achievementmissionworking, $value );
		return $this;
	}

	/**
     * 重置 进行中的成就任务
     * 设置为 []
     * @return $this
     */
    public function reset_achievementmissionworking()
    {
        return $this->reset_defaultValue(self::DBKey_achievementmissionworking);
    }

    /**
     * 设置 进行中的成就任务 默认值
     */
    protected function _set_defaultvalue_achievementmissionworking()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_achievementmissionworking, [] );
    }
    /**
     * 完成的成就任务
     *
     * @var
     */
    const DBKey_achievementmissioncomplete = "achievementmissioncomplete";

	/**
	 * 获取 完成的成就任务
	 * @return array
	 */
	public function get_achievementmissioncomplete()
	{
		return $this->getdata ( self::DBKey_achievementmissioncomplete );
	}

	/**
	 * 设置 完成的成就任务
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_achievementmissioncomplete($value)
	{
		$this->setdata ( self::DBKey_achievementmissioncomplete, $value );
		return $this;
	}

	/**
     * 重置 完成的成就任务
     * 设置为 []
     * @return $this
     */
    public function reset_achievementmissioncomplete()
    {
        return $this->reset_defaultValue(self::DBKey_achievementmissioncomplete);
    }

    /**
     * 设置 完成的成就任务 默认值
     */
    protected function _set_defaultvalue_achievementmissioncomplete()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_achievementmissioncomplete, [] );
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
        //设置 活动周期 默认值
        $this->_set_defaultvalue_period();
        //设置 普通任务进行中列表 默认值
        $this->_set_defaultvalue_normalmissionworking();
        //设置 普通任务完成列表 默认值
        $this->_set_defaultvalue_normalmissioncomplete();
        //设置 活动任务进行中列表 默认值
        $this->_set_defaultvalue_activitymissionworking();
        //设置 活动任务完成列表 默认值
        $this->_set_defaultvalue_activitymissioncomplete();
        //设置 进行中的成就任务 默认值
        $this->_set_defaultvalue_achievementmissionworking();
        //设置 完成的成就任务 默认值
        $this->_set_defaultvalue_achievementmissioncomplete();

    }
}