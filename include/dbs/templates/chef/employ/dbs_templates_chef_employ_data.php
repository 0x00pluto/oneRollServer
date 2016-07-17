<?php

namespace dbs\templates\chef\employ;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_employ_data
 * @package dbs\templates\chef\employ
 */
abstract class dbs_templates_chef_employ_data extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "chef_employs";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.employ.data" );
    }
    /**
     * 发送出去的请求
     *
     * @var
     */
    const DBKey_sendRequests = "sendRequests";

	/**
	 * 获取 发送出去的请求
	 * @return array
	 */
	protected function get_sendRequests()
	{
		return $this->getdata ( self::DBKey_sendRequests );
	}

	/**
	 * 设置 发送出去的请求
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_sendRequests($value)
	{
		$this->setdata ( self::DBKey_sendRequests, $value );
		return $this;
	}

	/**
     * 重置 发送出去的请求
     * 设置为 []
     * @return $this
     */
    public function reset_sendRequests()
    {
        return $this->reset_defaultValue(self::DBKey_sendRequests);
    }

    /**
     * 设置 发送出去的请求 默认值
     */
    protected function _set_defaultvalue_sendRequests()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sendRequests, [] );
    }
    /**
     * 已经雇佣的员工
     *
     * @var
     */
    const DBKey_employees = "employees";

	/**
	 * 获取 已经雇佣的员工
	 * @return array
	 */
	protected function get_employees()
	{
		return $this->getdata ( self::DBKey_employees );
	}

	/**
	 * 设置 已经雇佣的员工
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_employees($value)
	{
		$this->setdata ( self::DBKey_employees, $value );
		return $this;
	}

	/**
     * 重置 已经雇佣的员工
     * 设置为 []
     * @return $this
     */
    public function reset_employees()
    {
        return $this->reset_defaultValue(self::DBKey_employees);
    }

    /**
     * 设置 已经雇佣的员工 默认值
     */
    protected function _set_defaultvalue_employees()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_employees, [] );
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
        //设置 发送出去的请求 默认值
        $this->_set_defaultvalue_sendRequests();
        //设置 已经雇佣的员工 默认值
        $this->_set_defaultvalue_employees();

    }
}