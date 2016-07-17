<?php

namespace dbs\templates;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_monthlycard
 * @package dbs\templates
 */
abstract class dbs_templates_monthlycard extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "monthlycard";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "monthlycard" );
    }
    /**
     * 是否激活
     *
     * @var
     */
    const DBKey_isActive = "isActive";

	/**
	 * 获取 是否激活
	 * @return bool
	 */
	public function get_isActive()
	{
		return $this->getdata ( self::DBKey_isActive );
	}

	/**
	 * 设置 是否激活
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isActive($value)
	{
		$this->setdata ( self::DBKey_isActive, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否激活
     * 设置为 false
     * @return $this
     */
    public function reset_isActive()
    {
        return $this->reset_defaultValue(self::DBKey_isActive);
    }

    /**
     * 设置 是否激活 默认值
     */
    protected function _set_defaultvalue_isActive()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isActive, false );
    }
    /**
     * 开始日期
     *
     * @var
     */
    const DBKey_startDay = "startDay";

	/**
	 * 获取 开始日期
	 * @return int
	 */
	public function get_startDay()
	{
		return $this->getdata ( self::DBKey_startDay );
	}

	/**
	 * 设置 开始日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_startDay($value)
	{
		$this->setdata ( self::DBKey_startDay, intval($value) );
		return $this;
	}

	/**
     * 重置 开始日期
     * 设置为 0
     * @return $this
     */
    public function reset_startDay()
    {
        return $this->reset_defaultValue(self::DBKey_startDay);
    }

    /**
     * 设置 开始日期 默认值
     */
    protected function _set_defaultvalue_startDay()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_startDay, 0 );
    }
    /**
     * 持续时间
     *
     * @var
     */
    const DBKey_duringDay = "duringDay";

	/**
	 * 获取 持续时间
	 * @return int
	 */
	public function get_duringDay()
	{
		return $this->getdata ( self::DBKey_duringDay );
	}

	/**
	 * 设置 持续时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_duringDay($value)
	{
		$this->setdata ( self::DBKey_duringDay, intval($value) );
		return $this;
	}

	/**
     * 重置 持续时间
     * 设置为 0
     * @return $this
     */
    public function reset_duringDay()
    {
        return $this->reset_defaultValue(self::DBKey_duringDay);
    }

    /**
     * 设置 持续时间 默认值
     */
    protected function _set_defaultvalue_duringDay()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_duringDay, 0 );
    }
    /**
     * 结束日期
     *
     * @var
     */
    const DBKey_endDay = "endDay";

	/**
	 * 获取 结束日期
	 * @return int
	 */
	public function get_endDay()
	{
		return $this->getdata ( self::DBKey_endDay );
	}

	/**
	 * 设置 结束日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_endDay($value)
	{
		$this->setdata ( self::DBKey_endDay, intval($value) );
		return $this;
	}

	/**
     * 重置 结束日期
     * 设置为 0
     * @return $this
     */
    public function reset_endDay()
    {
        return $this->reset_defaultValue(self::DBKey_endDay);
    }

    /**
     * 设置 结束日期 默认值
     */
    protected function _set_defaultvalue_endDay()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_endDay, 0 );
    }
    /**
     * 最后一次领取的日期
     *
     * @var
     */
    const DBKey_awardDay = "awardDay";

	/**
	 * 获取 最后一次领取的日期
	 * @return int
	 */
	public function get_awardDay()
	{
		return $this->getdata ( self::DBKey_awardDay );
	}

	/**
	 * 设置 最后一次领取的日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_awardDay($value)
	{
		$this->setdata ( self::DBKey_awardDay, intval($value) );
		return $this;
	}

	/**
     * 重置 最后一次领取的日期
     * 设置为 0
     * @return $this
     */
    public function reset_awardDay()
    {
        return $this->reset_defaultValue(self::DBKey_awardDay);
    }

    /**
     * 设置 最后一次领取的日期 默认值
     */
    protected function _set_defaultvalue_awardDay()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_awardDay, 0 );
    }
    /**
     * 通知领取日期
     *
     * @var
     */
    const DBKey_noticeAwardDay = "noticeAwardDay";

	/**
	 * 获取 通知领取日期
	 * @return int
	 */
	public function get_noticeAwardDay()
	{
		return $this->getdata ( self::DBKey_noticeAwardDay );
	}

	/**
	 * 设置 通知领取日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_noticeAwardDay($value)
	{
		$this->setdata ( self::DBKey_noticeAwardDay, intval($value) );
		return $this;
	}

	/**
     * 重置 通知领取日期
     * 设置为 0
     * @return $this
     */
    public function reset_noticeAwardDay()
    {
        return $this->reset_defaultValue(self::DBKey_noticeAwardDay);
    }

    /**
     * 设置 通知领取日期 默认值
     */
    protected function _set_defaultvalue_noticeAwardDay()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_noticeAwardDay, 0 );
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
        //设置 是否激活 默认值
        $this->_set_defaultvalue_isActive();
        //设置 开始日期 默认值
        $this->_set_defaultvalue_startDay();
        //设置 持续时间 默认值
        $this->_set_defaultvalue_duringDay();
        //设置 结束日期 默认值
        $this->_set_defaultvalue_endDay();
        //设置 最后一次领取的日期 默认值
        $this->_set_defaultvalue_awardDay();
        //设置 通知领取日期 默认值
        $this->_set_defaultvalue_noticeAwardDay();

    }
}