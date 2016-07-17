<?php

namespace dbs\templates\mission;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mission_missionFinishData
 * @package dbs\templates\mission
 */
class dbs_templates_mission_missionFinishData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mission.missionFinishData" );
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
     * 完成时间
     *
     * @var
     */
    const DBKey_finishtime = "finishtime";

	/**
	 * 获取 完成时间
	 * @return int
	 */
	public function get_finishtime()
	{
		return $this->getdata ( self::DBKey_finishtime );
	}

	/**
	 * 设置 完成时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_finishtime($value)
	{
		$this->setdata ( self::DBKey_finishtime, intval($value) );
		return $this;
	}

	/**
     * 重置 完成时间
     * 设置为 0
     * @return $this
     */
    public function reset_finishtime()
    {
        return $this->reset_defaultValue(self::DBKey_finishtime);
    }

    /**
     * 设置 完成时间 默认值
     */
    protected function _set_defaultvalue_finishtime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_finishtime, 0 );
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
        //设置 完成时间 默认值
        $this->_set_defaultvalue_finishtime();

    }
}