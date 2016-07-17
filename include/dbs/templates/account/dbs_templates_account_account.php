<?php

namespace dbs\templates\account;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_account_account
 * @package dbs\templates\account
 */
abstract class dbs_templates_account_account extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "account";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "account.account" );
    }
    /**
     * 用户名
     *
     * @var
     */
    const DBKey_username = "username";

	/**
	 * 获取 用户名
	 * @return string
	 */
	public function get_username()
	{
		return $this->getdata ( self::DBKey_username );
	}

	/**
	 * 设置 用户名
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_username($value)
	{
		$this->setdata ( self::DBKey_username, strval($value) );
		return $this;
	}

	/**
     * 重置 用户名
     * 设置为 ""
     * @return $this
     */
    public function reset_username()
    {
        return $this->reset_defaultValue(self::DBKey_username);
    }

    /**
     * 设置 用户名 默认值
     */
    protected function _set_defaultvalue_username()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_username, "" );
    }
    /**
     * 密码
     *
     * @var
     */
    const DBKey_password = "password";

	/**
	 * 获取 密码
	 * @return string
	 */
	public function get_password()
	{
		return $this->getdata ( self::DBKey_password );
	}

	/**
	 * 设置 密码
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_password($value)
	{
		$this->setdata ( self::DBKey_password, strval($value) );
		return $this;
	}

	/**
     * 重置 密码
     * 设置为 ""
     * @return $this
     */
    public function reset_password()
    {
        return $this->reset_defaultValue(self::DBKey_password);
    }

    /**
     * 设置 密码 默认值
     */
    protected function _set_defaultvalue_password()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_password, "" );
    }
    /**
     * 控制码
     *
     * @var
     */
    const DBKey_ctl_code = "ctl_code";

	/**
	 * 获取 控制码
	 * @return int
	 */
	public function get_ctl_code()
	{
		return $this->getdata ( self::DBKey_ctl_code );
	}

	/**
	 * 设置 控制码
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_ctl_code($value)
	{
		$this->setdata ( self::DBKey_ctl_code, intval($value) );
		return $this;
	}

	/**
     * 重置 控制码
     * 设置为 0
     * @return $this
     */
    public function reset_ctl_code()
    {
        return $this->reset_defaultValue(self::DBKey_ctl_code);
    }

    /**
     * 设置 控制码 默认值
     */
    protected function _set_defaultvalue_ctl_code()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_ctl_code, 0 );
    }
    /**
     * 是否被删除
     *
     * @var
     */
    const DBKey_isdelete = "isdelete";

	/**
	 * 获取 是否被删除
	 * @return bool
	 */
	public function get_isdelete()
	{
		return $this->getdata ( self::DBKey_isdelete );
	}

	/**
	 * 设置 是否被删除
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isdelete($value)
	{
		$this->setdata ( self::DBKey_isdelete, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否被删除
     * 设置为 false
     * @return $this
     */
    public function reset_isdelete()
    {
        return $this->reset_defaultValue(self::DBKey_isdelete);
    }

    /**
     * 设置 是否被删除 默认值
     */
    protected function _set_defaultvalue_isdelete()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isdelete, false );
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
        //设置 用户名 默认值
        $this->_set_defaultvalue_username();
        //设置 密码 默认值
        $this->_set_defaultvalue_password();
        //设置 控制码 默认值
        $this->_set_defaultvalue_ctl_code();
        //设置 是否被删除 默认值
        $this->_set_defaultvalue_isdelete();

    }
}