<?php

namespace dbs\templates\mission;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mission_missionData
 * @package dbs\templates\mission
 */
class dbs_templates_mission_missionData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mission.missionData" );
    }
    /**
     * 任务ID
     *
     * @var
     */
    const DBKey_missionId = "missionId";

	/**
	 * 获取 任务ID
	 * @return string
	 */
	public function get_missionId()
	{
		return $this->getdata ( self::DBKey_missionId );
	}

	/**
	 * 设置 任务ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_missionId($value)
	{
		$this->setdata ( self::DBKey_missionId, strval($value) );
		return $this;
	}

	/**
     * 重置 任务ID
     * 设置为 ""
     * @return $this
     */
    public function reset_missionId()
    {
        return $this->reset_defaultValue(self::DBKey_missionId);
    }

    /**
     * 设置 任务ID 默认值
     */
    protected function _set_defaultvalue_missionId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_missionId, "" );
    }
    /**
     * 任务接收时间
     *
     * @var
     */
    const DBKey_acceptTime = "acceptTime";

	/**
	 * 获取 任务接收时间
	 * @return int
	 */
	public function get_acceptTime()
	{
		return $this->getdata ( self::DBKey_acceptTime );
	}

	/**
	 * 设置 任务接收时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_acceptTime($value)
	{
		$this->setdata ( self::DBKey_acceptTime, intval($value) );
		return $this;
	}

	/**
     * 重置 任务接收时间
     * 设置为 0
     * @return $this
     */
    public function reset_acceptTime()
    {
        return $this->reset_defaultValue(self::DBKey_acceptTime);
    }

    /**
     * 设置 任务接收时间 默认值
     */
    protected function _set_defaultvalue_acceptTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_acceptTime, 0 );
    }
    /**
     * 是否完成条件1
     *
     * @var
     */
    const DBKey_iscompletevalue1 = "iscompletevalue1";

	/**
	 * 获取 是否完成条件1
	 * @return bool
	 */
	public function get_iscompletevalue1()
	{
		return $this->getdata ( self::DBKey_iscompletevalue1 );
	}

	/**
	 * 设置 是否完成条件1
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_iscompletevalue1($value)
	{
		$this->setdata ( self::DBKey_iscompletevalue1, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否完成条件1
     * 设置为 false
     * @return $this
     */
    public function reset_iscompletevalue1()
    {
        return $this->reset_defaultValue(self::DBKey_iscompletevalue1);
    }

    /**
     * 设置 是否完成条件1 默认值
     */
    protected function _set_defaultvalue_iscompletevalue1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_iscompletevalue1, false );
    }
    /**
     * 任务条件1当前进度/完成情况
     *
     * @var
     */
    const DBKey_completevalue1 = "completevalue1";

	/**
	 * 获取 任务条件1当前进度/完成情况
	 * @return int
	 */
	public function get_completevalue1()
	{
		return $this->getdata ( self::DBKey_completevalue1 );
	}

	/**
	 * 设置 任务条件1当前进度/完成情况
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_completevalue1($value)
	{
		$this->setdata ( self::DBKey_completevalue1, intval($value) );
		return $this;
	}

	/**
     * 重置 任务条件1当前进度/完成情况
     * 设置为 0
     * @return $this
     */
    public function reset_completevalue1()
    {
        return $this->reset_defaultValue(self::DBKey_completevalue1);
    }

    /**
     * 设置 任务条件1当前进度/完成情况 默认值
     */
    protected function _set_defaultvalue_completevalue1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_completevalue1, 0 );
    }
    /**
     * 是否完成条件2
     *
     * @var
     */
    const DBKey_iscompletevalue2 = "iscompletevalue2";

	/**
	 * 获取 是否完成条件2
	 * @return bool
	 */
	public function get_iscompletevalue2()
	{
		return $this->getdata ( self::DBKey_iscompletevalue2 );
	}

	/**
	 * 设置 是否完成条件2
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_iscompletevalue2($value)
	{
		$this->setdata ( self::DBKey_iscompletevalue2, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否完成条件2
     * 设置为 false
     * @return $this
     */
    public function reset_iscompletevalue2()
    {
        return $this->reset_defaultValue(self::DBKey_iscompletevalue2);
    }

    /**
     * 设置 是否完成条件2 默认值
     */
    protected function _set_defaultvalue_iscompletevalue2()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_iscompletevalue2, false );
    }
    /**
     * 任务条件2当前进度/完成情况
     *
     * @var
     */
    const DBKey_completevalue2 = "completevalue2";

	/**
	 * 获取 任务条件2当前进度/完成情况
	 * @return int
	 */
	public function get_completevalue2()
	{
		return $this->getdata ( self::DBKey_completevalue2 );
	}

	/**
	 * 设置 任务条件2当前进度/完成情况
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_completevalue2($value)
	{
		$this->setdata ( self::DBKey_completevalue2, intval($value) );
		return $this;
	}

	/**
     * 重置 任务条件2当前进度/完成情况
     * 设置为 0
     * @return $this
     */
    public function reset_completevalue2()
    {
        return $this->reset_defaultValue(self::DBKey_completevalue2);
    }

    /**
     * 设置 任务条件2当前进度/完成情况 默认值
     */
    protected function _set_defaultvalue_completevalue2()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_completevalue2, 0 );
    }
    /**
     * 是否完成条件3
     *
     * @var
     */
    const DBKey_iscompletevalue3 = "iscompletevalue3";

	/**
	 * 获取 是否完成条件3
	 * @return bool
	 */
	public function get_iscompletevalue3()
	{
		return $this->getdata ( self::DBKey_iscompletevalue3 );
	}

	/**
	 * 设置 是否完成条件3
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_iscompletevalue3($value)
	{
		$this->setdata ( self::DBKey_iscompletevalue3, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否完成条件3
     * 设置为 false
     * @return $this
     */
    public function reset_iscompletevalue3()
    {
        return $this->reset_defaultValue(self::DBKey_iscompletevalue3);
    }

    /**
     * 设置 是否完成条件3 默认值
     */
    protected function _set_defaultvalue_iscompletevalue3()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_iscompletevalue3, false );
    }
    /**
     * 任务条件3当前进度/完成情况
     *
     * @var
     */
    const DBKey_completevalue3 = "completevalue3";

	/**
	 * 获取 任务条件3当前进度/完成情况
	 * @return int
	 */
	public function get_completevalue3()
	{
		return $this->getdata ( self::DBKey_completevalue3 );
	}

	/**
	 * 设置 任务条件3当前进度/完成情况
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_completevalue3($value)
	{
		$this->setdata ( self::DBKey_completevalue3, intval($value) );
		return $this;
	}

	/**
     * 重置 任务条件3当前进度/完成情况
     * 设置为 0
     * @return $this
     */
    public function reset_completevalue3()
    {
        return $this->reset_defaultValue(self::DBKey_completevalue3);
    }

    /**
     * 设置 任务条件3当前进度/完成情况 默认值
     */
    protected function _set_defaultvalue_completevalue3()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_completevalue3, 0 );
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
        //设置 任务ID 默认值
        $this->_set_defaultvalue_missionId();
        //设置 任务接收时间 默认值
        $this->_set_defaultvalue_acceptTime();
        //设置 是否完成条件1 默认值
        $this->_set_defaultvalue_iscompletevalue1();
        //设置 任务条件1当前进度/完成情况 默认值
        $this->_set_defaultvalue_completevalue1();
        //设置 是否完成条件2 默认值
        $this->_set_defaultvalue_iscompletevalue2();
        //设置 任务条件2当前进度/完成情况 默认值
        $this->_set_defaultvalue_completevalue2();
        //设置 是否完成条件3 默认值
        $this->_set_defaultvalue_iscompletevalue3();
        //设置 任务条件3当前进度/完成情况 默认值
        $this->_set_defaultvalue_completevalue3();

    }
}