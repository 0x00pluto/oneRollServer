<?php

namespace dbs\templates\chef;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_trainservice
 * @package dbs\templates\chef
 */
abstract class dbs_templates_chef_trainservice extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "chef_trainservices";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.trainservice" );
    }
    /**
     * 房间ID
     *
     * @var
     */
    const DBKey_roomId = "roomId";

	/**
	 * 获取 房间ID
	 * @return string
	 */
	public function get_roomId()
	{
		return $this->getdata ( self::DBKey_roomId );
	}

	/**
	 * 设置 房间ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_roomId($value)
	{
		$this->setdata ( self::DBKey_roomId, strval($value) );
		return $this;
	}

	/**
     * 重置 房间ID
     * 设置为 ""
     * @return $this
     */
    public function reset_roomId()
    {
        return $this->reset_defaultValue(self::DBKey_roomId);
    }

    /**
     * 设置 房间ID 默认值
     */
    protected function _set_defaultvalue_roomId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_roomId, "" );
    }
    /**
     * 主人培训信息
     *
     * @var
     */
    const DBKey_masterTrainData = "masterTrainData";

	/**
	 * 获取 主人培训信息
	 * @return array
	 */
	public function get_masterTrainData()
	{
		return $this->getdata ( self::DBKey_masterTrainData );
	}

	/**
	 * 设置 主人培训信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_masterTrainData($value)
	{
		$this->setdata ( self::DBKey_masterTrainData, $value );
		return $this;
	}

	/**
     * 重置 主人培训信息
     * 设置为 []
     * @return $this
     */
    public function reset_masterTrainData()
    {
        return $this->reset_defaultValue(self::DBKey_masterTrainData);
    }

    /**
     * 设置 主人培训信息 默认值
     */
    protected function _set_defaultvalue_masterTrainData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_masterTrainData, [] );
    }
    /**
     * 加入者培训信息
     *
     * @var
     */
    const DBKey_slaveTrainData = "slaveTrainData";

	/**
	 * 获取 加入者培训信息
	 * @return array
	 */
	public function get_slaveTrainData()
	{
		return $this->getdata ( self::DBKey_slaveTrainData );
	}

	/**
	 * 设置 加入者培训信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_slaveTrainData($value)
	{
		$this->setdata ( self::DBKey_slaveTrainData, $value );
		return $this;
	}

	/**
     * 重置 加入者培训信息
     * 设置为 []
     * @return $this
     */
    public function reset_slaveTrainData()
    {
        return $this->reset_defaultValue(self::DBKey_slaveTrainData);
    }

    /**
     * 设置 加入者培训信息 默认值
     */
    protected function _set_defaultvalue_slaveTrainData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_slaveTrainData, [] );
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
     * 房间状态
     *
     * @var
     */
    const DBKey_status = "status";

	/**
	 * 获取 房间状态
	 * @return int
	 */
	public function get_status()
	{
		return $this->getdata ( self::DBKey_status );
	}

	/**
	 * 设置 房间状态
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
     * 重置 房间状态
     * 设置为 0
     * @return $this
     */
    public function reset_status()
    {
        return $this->reset_defaultValue(self::DBKey_status);
    }

    /**
     * 设置 房间状态 默认值
     */
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_status, 0 );
    }
    /**
     * 所有加入申请
     *
     * @var
     */
    const DBKey_joinRequests = "joinRequests";

	/**
	 * 获取 所有加入申请
	 * @return array
	 */
	public function get_joinRequests()
	{
		return $this->getdata ( self::DBKey_joinRequests );
	}

	/**
	 * 设置 所有加入申请
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_joinRequests($value)
	{
		$this->setdata ( self::DBKey_joinRequests, $value );
		return $this;
	}

	/**
     * 重置 所有加入申请
     * 设置为 []
     * @return $this
     */
    public function reset_joinRequests()
    {
        return $this->reset_defaultValue(self::DBKey_joinRequests);
    }

    /**
     * 设置 所有加入申请 默认值
     */
    protected function _set_defaultvalue_joinRequests()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_joinRequests, [] );
    }
    /**
     * 是否发布了广告
     *
     * @var
     */
    const DBKey_publishAdvertisement = "publishAdvertisement";

	/**
	 * 获取 是否发布了广告
	 * @return bool
	 */
	public function get_publishAdvertisement()
	{
		return $this->getdata ( self::DBKey_publishAdvertisement );
	}

	/**
	 * 设置 是否发布了广告
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_publishAdvertisement($value)
	{
		$this->setdata ( self::DBKey_publishAdvertisement, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否发布了广告
     * 设置为 false
     * @return $this
     */
    public function reset_publishAdvertisement()
    {
        return $this->reset_defaultValue(self::DBKey_publishAdvertisement);
    }

    /**
     * 设置 是否发布了广告 默认值
     */
    protected function _set_defaultvalue_publishAdvertisement()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_publishAdvertisement, false );
    }
    /**
     * 广告ID
     *
     * @var
     */
    const DBKey_AdvertisementId = "AdvertisementId";

	/**
	 * 获取 广告ID
	 * @return string
	 */
	public function get_AdvertisementId()
	{
		return $this->getdata ( self::DBKey_AdvertisementId );
	}

	/**
	 * 设置 广告ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_AdvertisementId($value)
	{
		$this->setdata ( self::DBKey_AdvertisementId, strval($value) );
		return $this;
	}

	/**
     * 重置 广告ID
     * 设置为 ""
     * @return $this
     */
    public function reset_AdvertisementId()
    {
        return $this->reset_defaultValue(self::DBKey_AdvertisementId);
    }

    /**
     * 设置 广告ID 默认值
     */
    protected function _set_defaultvalue_AdvertisementId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_AdvertisementId, "" );
    }
    /**
     * 广告过期时间
     *
     * @var
     */
    const DBKey_AdvertisementExpiredTime = "AdvertisementExpiredTime";

	/**
	 * 获取 广告过期时间
	 * @return int
	 */
	public function get_AdvertisementExpiredTime()
	{
		return $this->getdata ( self::DBKey_AdvertisementExpiredTime );
	}

	/**
	 * 设置 广告过期时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_AdvertisementExpiredTime($value)
	{
		$this->setdata ( self::DBKey_AdvertisementExpiredTime, intval($value) );
		return $this;
	}

	/**
     * 重置 广告过期时间
     * 设置为 0
     * @return $this
     */
    public function reset_AdvertisementExpiredTime()
    {
        return $this->reset_defaultValue(self::DBKey_AdvertisementExpiredTime);
    }

    /**
     * 设置 广告过期时间 默认值
     */
    protected function _set_defaultvalue_AdvertisementExpiredTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_AdvertisementExpiredTime, 0 );
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
        //设置 房间ID 默认值
        $this->_set_defaultvalue_roomId();
        //设置 主人培训信息 默认值
        $this->_set_defaultvalue_masterTrainData();
        //设置 加入者培训信息 默认值
        $this->_set_defaultvalue_slaveTrainData();
        //设置 开始时间 默认值
        $this->_set_defaultvalue_startTime();
        //设置 完成时间 默认值
        $this->_set_defaultvalue_finishTime();
        //设置 房间状态 默认值
        $this->_set_defaultvalue_status();
        //设置 所有加入申请 默认值
        $this->_set_defaultvalue_joinRequests();
        //设置 是否发布了广告 默认值
        $this->_set_defaultvalue_publishAdvertisement();
        //设置 广告ID 默认值
        $this->_set_defaultvalue_AdvertisementId();
        //设置 广告过期时间 默认值
        $this->_set_defaultvalue_AdvertisementExpiredTime();

    }
}