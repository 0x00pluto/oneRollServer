<?php

namespace dbs\templates\robot;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_robot_robotData
 * @package dbs\templates\robot
 */
abstract class dbs_templates_robot_robotData extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "robotDatas";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "robot.robotData" );
    }
    /**
     * 机器人的用户ID
     *
     * @var
     */
    const DBKey_robotUserId = "robotUserId";

	/**
	 * 获取 机器人的用户ID
	 * @return string
	 */
	public function get_robotUserId()
	{
		return $this->getdata ( self::DBKey_robotUserId );
	}

	/**
	 * 设置 机器人的用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_robotUserId($value)
	{
		$this->setdata ( self::DBKey_robotUserId, strval($value) );
		return $this;
	}

	/**
     * 重置 机器人的用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_robotUserId()
    {
        return $this->reset_defaultValue(self::DBKey_robotUserId);
    }

    /**
     * 设置 机器人的用户ID 默认值
     */
    protected function _set_defaultvalue_robotUserId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_robotUserId, "" );
    }
    /**
     * 机器人是否已经删除
     *
     * @var
     */
    const DBKey_isDelete = "isDelete";

	/**
	 * 获取 机器人是否已经删除
	 * @return bool
	 */
	public function get_isDelete()
	{
		return $this->getdata ( self::DBKey_isDelete );
	}

	/**
	 * 设置 机器人是否已经删除
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isDelete($value)
	{
		$this->setdata ( self::DBKey_isDelete, boolval($value) );
		return $this;
	}

	/**
     * 重置 机器人是否已经删除
     * 设置为 false
     * @return $this
     */
    public function reset_isDelete()
    {
        return $this->reset_defaultValue(self::DBKey_isDelete);
    }

    /**
     * 设置 机器人是否已经删除 默认值
     */
    protected function _set_defaultvalue_isDelete()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isDelete, false );
    }
    /**
     * 代理场景的UserID
     *
     * @var
     */
    const DBKey_agentSceneUserId = "agentSceneUserId";

	/**
	 * 获取 代理场景的UserID
	 * @return string
	 */
	protected function get_agentSceneUserId()
	{
		return $this->getdata ( self::DBKey_agentSceneUserId );
	}

	/**
	 * 设置 代理场景的UserID
	 *
	 * @param string $value
	 * @return $this
	 */
	protected function set_agentSceneUserId($value)
	{
		$this->setdata ( self::DBKey_agentSceneUserId, strval($value) );
		return $this;
	}

	/**
     * 重置 代理场景的UserID
     * 设置为 ""
     * @return $this
     */
    public function reset_agentSceneUserId()
    {
        return $this->reset_defaultValue(self::DBKey_agentSceneUserId);
    }

    /**
     * 设置 代理场景的UserID 默认值
     */
    protected function _set_defaultvalue_agentSceneUserId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_agentSceneUserId, "" );
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
        //设置 机器人的用户ID 默认值
        $this->_set_defaultvalue_robotUserId();
        //设置 机器人是否已经删除 默认值
        $this->_set_defaultvalue_isDelete();
        //设置 代理场景的UserID 默认值
        $this->_set_defaultvalue_agentSceneUserId();

    }
}