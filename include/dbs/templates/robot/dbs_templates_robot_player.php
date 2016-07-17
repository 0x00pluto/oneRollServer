<?php

namespace dbs\templates\robot;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_robot_player
 * @package dbs\templates\robot
 */
abstract class dbs_templates_robot_player extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "robot_player";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "robot.player" );
    }
    /**
     * 是否是机器人
     *
     * @var
     */
    const DBKey_isrobot = "isrobot";

	/**
	 * 获取 是否是机器人
	 * @return bool
	 */
	public function get_isrobot()
	{
		return $this->getdata ( self::DBKey_isrobot );
	}

	/**
	 * 设置 是否是机器人
	 *
	 * @param bool $value
	 * @return $this
	 */
	protected function set_isrobot($value)
	{
		$this->setdata ( self::DBKey_isrobot, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否是机器人
     * 设置为 false
     * @return $this
     */
    public function reset_isrobot()
    {
        return $this->reset_defaultValue(self::DBKey_isrobot);
    }

    /**
     * 设置 是否是机器人 默认值
     */
    protected function _set_defaultvalue_isrobot()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isrobot, false );
    }
    /**
     * 最后一次帮忙嫁接的时间
     *
     * @var
     */
    const DBKey_helpItemgraftLastTime = "helpItemgraftLastTime";

	/**
	 * 获取 最后一次帮忙嫁接的时间
	 * @return int
	 */
	public function get_helpItemgraftLastTime()
	{
		return $this->getdata ( self::DBKey_helpItemgraftLastTime );
	}

	/**
	 * 设置 最后一次帮忙嫁接的时间
	 *
	 * @param int $value
	 * @return $this
	 */
	protected function set_helpItemgraftLastTime($value)
	{
		$this->setdata ( self::DBKey_helpItemgraftLastTime, intval($value) );
		return $this;
	}

	/**
     * 重置 最后一次帮忙嫁接的时间
     * 设置为 0
     * @return $this
     */
    public function reset_helpItemgraftLastTime()
    {
        return $this->reset_defaultValue(self::DBKey_helpItemgraftLastTime);
    }

    /**
     * 设置 最后一次帮忙嫁接的时间 默认值
     */
    protected function _set_defaultvalue_helpItemgraftLastTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpItemgraftLastTime, 0 );
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
        //设置 是否是机器人 默认值
        $this->_set_defaultvalue_isrobot();
        //设置 最后一次帮忙嫁接的时间 默认值
        $this->_set_defaultvalue_helpItemgraftLastTime();

    }
}