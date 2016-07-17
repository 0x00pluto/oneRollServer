<?php

namespace dbs\templates\custom\visitors;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_custom_visitors_player
 * @package dbs\templates\custom\visitors
 */
abstract class dbs_templates_custom_visitors_player extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "custom.visitors.player" );
    }
    /**
     * 顾客数据
     *
     * @var
     */
    const DBKey_NpcVisitors = "NpcVisitors";

	/**
	 * 获取 顾客数据
	 * @return array
	 */
	public function get_NpcVisitors()
	{
		return $this->getdata ( self::DBKey_NpcVisitors );
	}

	/**
	 * 设置 顾客数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_NpcVisitors($value)
	{
		$this->setdata ( self::DBKey_NpcVisitors, $value );
		return $this;
	}

	/**
     * 重置 顾客数据
     * 设置为 []
     * @return $this
     */
    public function reset_NpcVisitors()
    {
        return $this->reset_defaultValue(self::DBKey_NpcVisitors);
    }

    /**
     * 设置 顾客数据 默认值
     */
    protected function _set_defaultvalue_NpcVisitors()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_NpcVisitors, [] );
    }
    /**
     * 好友顾客顾客数据
     *
     * @var
     */
    const DBKey_FriendVisitors = "FriendVisitors";

	/**
	 * 获取 好友顾客顾客数据
	 * @return array
	 */
	public function get_FriendVisitors()
	{
		return $this->getdata ( self::DBKey_FriendVisitors );
	}

	/**
	 * 设置 好友顾客顾客数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_FriendVisitors($value)
	{
		$this->setdata ( self::DBKey_FriendVisitors, $value );
		return $this;
	}

	/**
     * 重置 好友顾客顾客数据
     * 设置为 []
     * @return $this
     */
    public function reset_FriendVisitors()
    {
        return $this->reset_defaultValue(self::DBKey_FriendVisitors);
    }

    /**
     * 设置 好友顾客顾客数据 默认值
     */
    protected function _set_defaultvalue_FriendVisitors()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_FriendVisitors, [] );
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
        //设置 顾客数据 默认值
        $this->_set_defaultvalue_NpcVisitors();
        //设置 好友顾客顾客数据 默认值
        $this->_set_defaultvalue_FriendVisitors();

    }
}