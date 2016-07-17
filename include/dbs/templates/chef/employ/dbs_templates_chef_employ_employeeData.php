<?php

namespace dbs\templates\chef\employ;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_employ_employeeData
 * @package dbs\templates\chef\employ
 */
class dbs_templates_chef_employ_employeeData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.employ.employeeData" );
    }
    /**
     * 用户ID
     *
     * @var
     */
    const DBKey_userid = "userid";

	/**
	 * 获取 用户ID
	 * @return string
	 */
	public function get_userid()
	{
		return $this->getdata ( self::DBKey_userid );
	}

	/**
	 * 设置 用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_userid($value)
	{
		$this->setdata ( self::DBKey_userid, strval($value) );
		return $this;
	}

	/**
     * 重置 用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_userid()
    {
        return $this->reset_defaultValue(self::DBKey_userid);
    }

    /**
     * 设置 用户ID 默认值
     */
    protected function _set_defaultvalue_userid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userid, "" );
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
     * 雇佣开始时间
     *
     * @var
     */
    const DBKey_employTime = "employTime";

	/**
	 * 获取 雇佣开始时间
	 * @return int
	 */
	public function get_employTime()
	{
		return $this->getdata ( self::DBKey_employTime );
	}

	/**
	 * 设置 雇佣开始时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_employTime($value)
	{
		$this->setdata ( self::DBKey_employTime, intval($value) );
		return $this;
	}

	/**
     * 重置 雇佣开始时间
     * 设置为 0
     * @return $this
     */
    public function reset_employTime()
    {
        return $this->reset_defaultValue(self::DBKey_employTime);
    }

    /**
     * 设置 雇佣开始时间 默认值
     */
    protected function _set_defaultvalue_employTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_employTime, 0 );
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
     * 雇佣的厨师数据
     *
     * @var
     */
    const DBKey_employeeChefData = "employeeChefData";

	/**
	 * 获取 雇佣的厨师数据
	 * @return array
	 */
	public function get_employeeChefData()
	{
		return $this->getdata ( self::DBKey_employeeChefData );
	}

	/**
	 * 设置 雇佣的厨师数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_employeeChefData($value)
	{
		$this->setdata ( self::DBKey_employeeChefData, $value );
		return $this;
	}

	/**
     * 重置 雇佣的厨师数据
     * 设置为 []
     * @return $this
     */
    public function reset_employeeChefData()
    {
        return $this->reset_defaultValue(self::DBKey_employeeChefData);
    }

    /**
     * 设置 雇佣的厨师数据 默认值
     */
    protected function _set_defaultvalue_employeeChefData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_employeeChefData, [] );
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
        //设置 用户ID 默认值
        $this->_set_defaultvalue_userid();
        //设置 厨师ID 默认值
        $this->_set_defaultvalue_chefId();
        //设置 雇佣开始时间 默认值
        $this->_set_defaultvalue_employTime();
        //设置 雇佣结束时间 默认值
        $this->_set_defaultvalue_employEndTime();
        //设置 雇佣的厨师数据 默认值
        $this->_set_defaultvalue_employeeChefData();

    }
}