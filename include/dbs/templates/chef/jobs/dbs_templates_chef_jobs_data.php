<?php

namespace dbs\templates\chef\jobs;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_jobs_data
 * @package dbs\templates\chef\jobs
 */
class dbs_templates_chef_jobs_data extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.jobs.data" );
    }
    /**
     * 是否是雇佣厨师,0否,1是
     *
     * @var
     */
    const DBKey_isHired = "isHired";

	/**
	 * 获取 是否是雇佣厨师,0否,1是
	 * @return int
	 */
	public function get_isHired()
	{
		return $this->getdata ( self::DBKey_isHired );
	}

	/**
	 * 设置 是否是雇佣厨师,0否,1是
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_isHired($value)
	{
		$this->setdata ( self::DBKey_isHired, intval($value) );
		return $this;
	}

	/**
     * 重置 是否是雇佣厨师,0否,1是
     * 设置为 0
     * @return $this
     */
    public function reset_isHired()
    {
        return $this->reset_defaultValue(self::DBKey_isHired);
    }

    /**
     * 设置 是否是雇佣厨师,0否,1是 默认值
     */
    protected function _set_defaultvalue_isHired()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isHired, 0 );
    }
    /**
     * 厨师ID
     *
     * @var
     */
    const DBKey_chefId = "chefId";

	/**
	 * 获取 厨师ID
	 * @return string
	 */
	public function get_chefId()
	{
		return $this->getdata ( self::DBKey_chefId );
	}

	/**
	 * 设置 厨师ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_chefId($value)
	{
		$this->setdata ( self::DBKey_chefId, strval($value) );
		return $this;
	}

	/**
     * 重置 厨师ID
     * 设置为 ""
     * @return $this
     */
    public function reset_chefId()
    {
        return $this->reset_defaultValue(self::DBKey_chefId);
    }

    /**
     * 设置 厨师ID 默认值
     */
    protected function _set_defaultvalue_chefId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_chefId, "" );
    }
    /**
     * 开始任职的时间
     *
     * @var
     */
    const DBKey_startTime = "startTime";

	/**
	 * 获取 开始任职的时间
	 * @return int
	 */
	public function get_startTime()
	{
		return $this->getdata ( self::DBKey_startTime );
	}

	/**
	 * 设置 开始任职的时间
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
     * 重置 开始任职的时间
     * 设置为 0
     * @return $this
     */
    public function reset_startTime()
    {
        return $this->reset_defaultValue(self::DBKey_startTime);
    }

    /**
     * 设置 开始任职的时间 默认值
     */
    protected function _set_defaultvalue_startTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_startTime, 0 );
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
        //设置 是否是雇佣厨师,0否,1是 默认值
        $this->_set_defaultvalue_isHired();
        //设置 厨师ID 默认值
        $this->_set_defaultvalue_chefId();
        //设置 开始任职的时间 默认值
        $this->_set_defaultvalue_startTime();

    }
}