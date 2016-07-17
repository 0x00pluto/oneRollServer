<?php

namespace dbs\templates\custom\visitors;

use dbs\templates\custom\visitors\dbs_templates_custom_visitors_visitor as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_custom_visitors_strangervisitor
 * @package dbs\templates\custom\visitors
 */
class dbs_templates_custom_visitors_strangervisitor extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "custom.visitors.strangervisitor" );
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
     * 用户信息
     *
     * @var
     */
    const DBKey_userInfo = "userInfo";

	/**
	 * 获取 用户信息
	 * @return array
	 */
	public function get_userInfo()
	{
		return $this->getdata ( self::DBKey_userInfo );
	}

	/**
	 * 设置 用户信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_userInfo($value)
	{
		$this->setdata ( self::DBKey_userInfo, $value );
		return $this;
	}

	/**
     * 重置 用户信息
     * 设置为 []
     * @return $this
     */
    public function reset_userInfo()
    {
        return $this->reset_defaultValue(self::DBKey_userInfo);
    }

    /**
     * 设置 用户信息 默认值
     */
    protected function _set_defaultvalue_userInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userInfo, [] );
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
        //设置 用户信息 默认值
        $this->_set_defaultvalue_userInfo();

    }
}