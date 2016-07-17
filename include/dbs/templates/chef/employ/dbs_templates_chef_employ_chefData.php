<?php

namespace dbs\templates\chef\employ;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_employ_chefData
 * @package dbs\templates\chef\employ
 */
class dbs_templates_chef_employ_chefData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.employ.chefData" );
    }
    /**
     * 雇佣状态
     *
     * @var
     */
    const DBKey_status = "status";

	/**
	 * 获取 雇佣状态
	 * @return int
	 */
	public function get_status()
	{
		return $this->getdata ( self::DBKey_status );
	}

	/**
	 * 设置 雇佣状态
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
     * 重置 雇佣状态
     * 设置为 0
     * @return $this
     */
    public function reset_status()
    {
        return $this->reset_defaultValue(self::DBKey_status);
    }

    /**
     * 设置 雇佣状态 默认值
     */
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_status, 0 );
    }
    /**
     * 雇佣请求
     *
     * @var
     */
    const DBKey_requests = "requests";

	/**
	 * 获取 雇佣请求
	 * @return array
	 */
	public function get_requests()
	{
		return $this->getdata ( self::DBKey_requests );
	}

	/**
	 * 设置 雇佣请求
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_requests($value)
	{
		$this->setdata ( self::DBKey_requests, $value );
		return $this;
	}

	/**
     * 重置 雇佣请求
     * 设置为 []
     * @return $this
     */
    public function reset_requests()
    {
        return $this->reset_defaultValue(self::DBKey_requests);
    }

    /**
     * 设置 雇佣请求 默认值
     */
    protected function _set_defaultvalue_requests()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_requests, [] );
    }
    /**
     * 雇主用户ID
     *
     * @var
     */
    const DBKey_employerId = "employerId";

	/**
	 * 获取 雇主用户ID
	 * @return string
	 */
	public function get_employerId()
	{
		return $this->getdata ( self::DBKey_employerId );
	}

	/**
	 * 设置 雇主用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_employerId($value)
	{
		$this->setdata ( self::DBKey_employerId, strval($value) );
		return $this;
	}

	/**
     * 重置 雇主用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_employerId()
    {
        return $this->reset_defaultValue(self::DBKey_employerId);
    }

    /**
     * 设置 雇主用户ID 默认值
     */
    protected function _set_defaultvalue_employerId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_employerId, "" );
    }
    /**
     * 雇佣开始时间
     *
     * @var
     */
    const DBKey_employStartTime = "employStartTime";

	/**
	 * 获取 雇佣开始时间
	 * @return int
	 */
	public function get_employStartTime()
	{
		return $this->getdata ( self::DBKey_employStartTime );
	}

	/**
	 * 设置 雇佣开始时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_employStartTime($value)
	{
		$this->setdata ( self::DBKey_employStartTime, intval($value) );
		return $this;
	}

	/**
     * 重置 雇佣开始时间
     * 设置为 0
     * @return $this
     */
    public function reset_employStartTime()
    {
        return $this->reset_defaultValue(self::DBKey_employStartTime);
    }

    /**
     * 设置 雇佣开始时间 默认值
     */
    protected function _set_defaultvalue_employStartTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_employStartTime, 0 );
    }
    /**
     * 雇佣结束时间
     *
     * @var
     */
    const DBKey_employEndTime = "employEndTime";

	/**
	 * 获取 雇佣结束时间
	 * @return int
	 */
	public function get_employEndTime()
	{
		return $this->getdata ( self::DBKey_employEndTime );
	}

	/**
	 * 设置 雇佣结束时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_employEndTime($value)
	{
		$this->setdata ( self::DBKey_employEndTime, intval($value) );
		return $this;
	}

	/**
     * 重置 雇佣结束时间
     * 设置为 0
     * @return $this
     */
    public function reset_employEndTime()
    {
        return $this->reset_defaultValue(self::DBKey_employEndTime);
    }

    /**
     * 设置 雇佣结束时间 默认值
     */
    protected function _set_defaultvalue_employEndTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_employEndTime, 0 );
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
        //设置 雇佣状态 默认值
        $this->_set_defaultvalue_status();
        //设置 雇佣请求 默认值
        $this->_set_defaultvalue_requests();
        //设置 雇主用户ID 默认值
        $this->_set_defaultvalue_employerId();
        //设置 雇佣开始时间 默认值
        $this->_set_defaultvalue_employStartTime();
        //设置 雇佣结束时间 默认值
        $this->_set_defaultvalue_employEndTime();

    }
}