<?php

namespace dbs\templates\chef\jobs;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_jobs_list
 * @package dbs\templates\chef\jobs
 */
abstract class dbs_templates_chef_jobs_list extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "chef_jobs";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.jobs.list" );
    }
    /**
     * 厨师列表
     *
     * @var
     */
    const DBKey_job1Chefs = "job1Chefs";

	/**
	 * 获取 厨师列表
	 * @return array
	 */
	public function get_job1Chefs()
	{
		return $this->getdata ( self::DBKey_job1Chefs );
	}

	/**
	 * 设置 厨师列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_job1Chefs($value)
	{
		$this->setdata ( self::DBKey_job1Chefs, $value );
		return $this;
	}

	/**
     * 重置 厨师列表
     * 设置为 []
     * @return $this
     */
    public function reset_job1Chefs()
    {
        return $this->reset_defaultValue(self::DBKey_job1Chefs);
    }

    /**
     * 设置 厨师列表 默认值
     */
    protected function _set_defaultvalue_job1Chefs()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_job1Chefs, [] );
    }
    /**
     * 收银员列表
     *
     * @var
     */
    const DBKey_job2Chefs = "job2Chefs";

	/**
	 * 获取 收银员列表
	 * @return array
	 */
	public function get_job2Chefs()
	{
		return $this->getdata ( self::DBKey_job2Chefs );
	}

	/**
	 * 设置 收银员列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_job2Chefs($value)
	{
		$this->setdata ( self::DBKey_job2Chefs, $value );
		return $this;
	}

	/**
     * 重置 收银员列表
     * 设置为 []
     * @return $this
     */
    public function reset_job2Chefs()
    {
        return $this->reset_defaultValue(self::DBKey_job2Chefs);
    }

    /**
     * 设置 收银员列表 默认值
     */
    protected function _set_defaultvalue_job2Chefs()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_job2Chefs, [] );
    }
    /**
     * 迎宾列表
     *
     * @var
     */
    const DBKey_job3Chefs = "job3Chefs";

	/**
	 * 获取 迎宾列表
	 * @return array
	 */
	public function get_job3Chefs()
	{
		return $this->getdata ( self::DBKey_job3Chefs );
	}

	/**
	 * 设置 迎宾列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_job3Chefs($value)
	{
		$this->setdata ( self::DBKey_job3Chefs, $value );
		return $this;
	}

	/**
     * 重置 迎宾列表
     * 设置为 []
     * @return $this
     */
    public function reset_job3Chefs()
    {
        return $this->reset_defaultValue(self::DBKey_job3Chefs);
    }

    /**
     * 设置 迎宾列表 默认值
     */
    protected function _set_defaultvalue_job3Chefs()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_job3Chefs, [] );
    }
    /**
     * 服务员列表
     *
     * @var
     */
    const DBKey_job4Chefs = "job4Chefs";

	/**
	 * 获取 服务员列表
	 * @return array
	 */
	public function get_job4Chefs()
	{
		return $this->getdata ( self::DBKey_job4Chefs );
	}

	/**
	 * 设置 服务员列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_job4Chefs($value)
	{
		$this->setdata ( self::DBKey_job4Chefs, $value );
		return $this;
	}

	/**
     * 重置 服务员列表
     * 设置为 []
     * @return $this
     */
    public function reset_job4Chefs()
    {
        return $this->reset_defaultValue(self::DBKey_job4Chefs);
    }

    /**
     * 设置 服务员列表 默认值
     */
    protected function _set_defaultvalue_job4Chefs()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_job4Chefs, [] );
    }
    /**
     * 分职业魅力值,key:职业ID,value:值
     *
     * @var
     */
    const DBKey_totalCharms = "totalCharms";

	/**
	 * 获取 分职业魅力值,key:职业ID,value:值
	 * @return array
	 */
	public function get_totalCharms()
	{
		return $this->getdata ( self::DBKey_totalCharms );
	}

	/**
	 * 设置 分职业魅力值,key:职业ID,value:值
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_totalCharms($value)
	{
		$this->setdata ( self::DBKey_totalCharms, $value );
		return $this;
	}

	/**
     * 重置 分职业魅力值,key:职业ID,value:值
     * 设置为 []
     * @return $this
     */
    public function reset_totalCharms()
    {
        return $this->reset_defaultValue(self::DBKey_totalCharms);
    }

    /**
     * 设置 分职业魅力值,key:职业ID,value:值 默认值
     */
    protected function _set_defaultvalue_totalCharms()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_totalCharms, [] );
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
        $this->_set_defaultvalue_job1Chefs();
        //设置 收银员列表 默认值
        $this->_set_defaultvalue_job2Chefs();
        //设置 迎宾列表 默认值
        $this->_set_defaultvalue_job3Chefs();
        //设置 服务员列表 默认值
        $this->_set_defaultvalue_job4Chefs();
        //设置 分职业魅力值,key:职业ID,value:值 默认值
        $this->_set_defaultvalue_totalCharms();

    }
}