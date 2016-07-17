<?php

namespace dbs\templates\chef;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_traindata
 * @package dbs\templates\chef
 */
class dbs_templates_chef_traindata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.traindata" );
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
     * 培训房间ID
     *
     * @var
     */
    const DBKey_trainRoomId = "trainRoomId";

	/**
	 * 获取 培训房间ID
	 * @return string
	 */
	public function get_trainRoomId()
	{
		return $this->getdata ( self::DBKey_trainRoomId );
	}

	/**
	 * 设置 培训房间ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_trainRoomId($value)
	{
		$this->setdata ( self::DBKey_trainRoomId, strval($value) );
		return $this;
	}

	/**
     * 重置 培训房间ID
     * 设置为 ""
     * @return $this
     */
    public function reset_trainRoomId()
    {
        return $this->reset_defaultValue(self::DBKey_trainRoomId);
    }

    /**
     * 设置 培训房间ID 默认值
     */
    protected function _set_defaultvalue_trainRoomId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_trainRoomId, "" );
    }
    /**
     * 如果发起请求
     *
     * @var
     */
    const DBKey_trainRequestId = "trainRequestId";

	/**
	 * 获取 如果发起请求
	 * @return string
	 */
	public function get_trainRequestId()
	{
		return $this->getdata ( self::DBKey_trainRequestId );
	}

	/**
	 * 设置 如果发起请求
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_trainRequestId($value)
	{
		$this->setdata ( self::DBKey_trainRequestId, strval($value) );
		return $this;
	}

	/**
     * 重置 如果发起请求
     * 设置为 ""
     * @return $this
     */
    public function reset_trainRequestId()
    {
        return $this->reset_defaultValue(self::DBKey_trainRequestId);
    }

    /**
     * 设置 如果发起请求 默认值
     */
    protected function _set_defaultvalue_trainRequestId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_trainRequestId, "" );
    }
    /**
     * 是否为主动发起的培训
     *
     * @var
     */
    const DBKey_isMaster = "isMaster";

	/**
	 * 获取 是否为主动发起的培训
	 * @return bool
	 */
	public function get_isMaster()
	{
		return $this->getdata ( self::DBKey_isMaster );
	}

	/**
	 * 设置 是否为主动发起的培训
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isMaster($value)
	{
		$this->setdata ( self::DBKey_isMaster, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否为主动发起的培训
     * 设置为 false
     * @return $this
     */
    public function reset_isMaster()
    {
        return $this->reset_defaultValue(self::DBKey_isMaster);
    }

    /**
     * 设置 是否为主动发起的培训 默认值
     */
    protected function _set_defaultvalue_isMaster()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isMaster, false );
    }
    /**
     * 开始时间
     *
     * @var
     */
    const DBKey_startTime = "startTime";

	/**
	 * 获取 开始时间
	 * @return int
	 */
	public function get_startTime()
	{
		return $this->getdata ( self::DBKey_startTime );
	}

	/**
	 * 设置 开始时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_startTime($value)
	{
		$this->setdata ( self::DBKey_startTime, intval($value) );
		return $this;
	}

	/**
     * 重置 开始时间
     * 设置为 0
     * @return $this
     */
    public function reset_startTime()
    {
        return $this->reset_defaultValue(self::DBKey_startTime);
    }

    /**
     * 设置 开始时间 默认值
     */
    protected function _set_defaultvalue_startTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_startTime, 0 );
    }
    /**
     * 完成时间
     *
     * @var
     */
    const DBKey_finishTime = "finishTime";

	/**
	 * 获取 完成时间
	 * @return int
	 */
	public function get_finishTime()
	{
		return $this->getdata ( self::DBKey_finishTime );
	}

	/**
	 * 设置 完成时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_finishTime($value)
	{
		$this->setdata ( self::DBKey_finishTime, intval($value) );
		return $this;
	}

	/**
     * 重置 完成时间
     * 设置为 0
     * @return $this
     */
    public function reset_finishTime()
    {
        return $this->reset_defaultValue(self::DBKey_finishTime);
    }

    /**
     * 设置 完成时间 默认值
     */
    protected function _set_defaultvalue_finishTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_finishTime, 0 );
    }
    /**
     * 今日被培训的次数
     *
     * @var
     */
    const DBKey_todayTrainCount = "todayTrainCount";

	/**
	 * 获取 今日被培训的次数
	 * @return int
	 */
	public function get_todayTrainCount()
	{
		return $this->getdata ( self::DBKey_todayTrainCount );
	}

	/**
	 * 设置 今日被培训的次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_todayTrainCount($value)
	{
		$this->setdata ( self::DBKey_todayTrainCount, intval($value) );
		return $this;
	}

	/**
     * 重置 今日被培训的次数
     * 设置为 0
     * @return $this
     */
    public function reset_todayTrainCount()
    {
        return $this->reset_defaultValue(self::DBKey_todayTrainCount);
    }

    /**
     * 设置 今日被培训的次数 默认值
     */
    protected function _set_defaultvalue_todayTrainCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_todayTrainCount, 0 );
    }
    /**
     * 今日被培训用户ID列表
     *
     * @var
     */
    const DBKey_todayTrainedUserIds = "todayTrainedUserIds";

	/**
	 * 获取 今日被培训用户ID列表
	 * @return array
	 */
	public function get_todayTrainedUserIds()
	{
		return $this->getdata ( self::DBKey_todayTrainedUserIds );
	}

	/**
	 * 设置 今日被培训用户ID列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_todayTrainedUserIds($value)
	{
		$this->setdata ( self::DBKey_todayTrainedUserIds, $value );
		return $this;
	}

	/**
     * 重置 今日被培训用户ID列表
     * 设置为 []
     * @return $this
     */
    public function reset_todayTrainedUserIds()
    {
        return $this->reset_defaultValue(self::DBKey_todayTrainedUserIds);
    }

    /**
     * 设置 今日被培训用户ID列表 默认值
     */
    protected function _set_defaultvalue_todayTrainedUserIds()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_todayTrainedUserIds, [] );
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
        //设置 培训房间ID 默认值
        $this->_set_defaultvalue_trainRoomId();
        //设置 如果发起请求 默认值
        $this->_set_defaultvalue_trainRequestId();
        //设置 是否为主动发起的培训 默认值
        $this->_set_defaultvalue_isMaster();
        //设置 开始时间 默认值
        $this->_set_defaultvalue_startTime();
        //设置 完成时间 默认值
        $this->_set_defaultvalue_finishTime();
        //设置 今日被培训的次数 默认值
        $this->_set_defaultvalue_todayTrainCount();
        //设置 今日被培训用户ID列表 默认值
        $this->_set_defaultvalue_todayTrainedUserIds();

    }
}