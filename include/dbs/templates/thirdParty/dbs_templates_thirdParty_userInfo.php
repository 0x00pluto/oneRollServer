<?php

namespace dbs\templates\thirdParty;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_thirdParty_userInfo
 * @package dbs\templates\thirdParty
 */
abstract class dbs_templates_thirdParty_userInfo extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "accountthirdparty";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "thirdParty.userInfo" );
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
    const DBKey_ctlcode = "ctlcode";

	/**
	 * 获取 控制码
	 * @return int
	 */
	public function get_ctlcode()
	{
		return $this->getdata ( self::DBKey_ctlcode );
	}

	/**
	 * 设置 控制码
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_ctlcode($value)
	{
		$this->setdata ( self::DBKey_ctlcode, intval($value) );
		return $this;
	}

	/**
     * 重置 控制码
     * 设置为 0
     * @return $this
     */
    public function reset_ctlcode()
    {
        return $this->reset_defaultValue(self::DBKey_ctlcode);
    }

    /**
     * 设置 控制码 默认值
     */
    protected function _set_defaultvalue_ctlcode()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_ctlcode, 0 );
    }
    /**
     * 关联的userid
     *
     * @var
     */
    const DBKey_link_userid = "link_userid";

	/**
	 * 获取 关联的userid
	 * @return string
	 */
	public function get_link_userid()
	{
		return $this->getdata ( self::DBKey_link_userid );
	}

	/**
	 * 设置 关联的userid
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_link_userid($value)
	{
		$this->setdata ( self::DBKey_link_userid, strval($value) );
		return $this;
	}

	/**
     * 重置 关联的userid
     * 设置为 ""
     * @return $this
     */
    public function reset_link_userid()
    {
        return $this->reset_defaultValue(self::DBKey_link_userid);
    }

    /**
     * 设置 关联的userid 默认值
     */
    protected function _set_defaultvalue_link_userid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_link_userid, "" );
    }
    /**
     * 关联用户名
     *
     * @var
     */
    const DBKey_link_username = "link_username";

	/**
	 * 获取 关联用户名
	 * @return string
	 */
	public function get_link_username()
	{
		return $this->getdata ( self::DBKey_link_username );
	}

	/**
	 * 设置 关联用户名
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_link_username($value)
	{
		$this->setdata ( self::DBKey_link_username, strval($value) );
		return $this;
	}

	/**
     * 重置 关联用户名
     * 设置为 ""
     * @return $this
     */
    public function reset_link_username()
    {
        return $this->reset_defaultValue(self::DBKey_link_username);
    }

    /**
     * 设置 关联用户名 默认值
     */
    protected function _set_defaultvalue_link_username()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_link_username, "" );
    }
    /**
     * 关联的密码
     *
     * @var
     */
    const DBKey_link_password = "link_password";

	/**
	 * 获取 关联的密码
	 * @return string
	 */
	public function get_link_password()
	{
		return $this->getdata ( self::DBKey_link_password );
	}

	/**
	 * 设置 关联的密码
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_link_password($value)
	{
		$this->setdata ( self::DBKey_link_password, strval($value) );
		return $this;
	}

	/**
     * 重置 关联的密码
     * 设置为 ""
     * @return $this
     */
    public function reset_link_password()
    {
        return $this->reset_defaultValue(self::DBKey_link_password);
    }

    /**
     * 设置 关联的密码 默认值
     */
    protected function _set_defaultvalue_link_password()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_link_password, "" );
    }
    /**
     * 渠道号
     *
     * @var
     */
    const DBKey_thirdpartytype = "thirdpartytype";

	/**
	 * 获取 渠道号
	 * @return int
	 */
	public function get_thirdpartytype()
	{
		return $this->getdata ( self::DBKey_thirdpartytype );
	}

	/**
	 * 设置 渠道号
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_thirdpartytype($value)
	{
		$this->setdata ( self::DBKey_thirdpartytype, intval($value) );
		return $this;
	}

	/**
     * 重置 渠道号
     * 设置为 0
     * @return $this
     */
    public function reset_thirdpartytype()
    {
        return $this->reset_defaultValue(self::DBKey_thirdpartytype);
    }

    /**
     * 设置 渠道号 默认值
     */
    protected function _set_defaultvalue_thirdpartytype()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_thirdpartytype, 0 );
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
        //设置 用户名 默认值
        $this->_set_defaultvalue_username();
        //设置 密码 默认值
        $this->_set_defaultvalue_password();
        //设置 控制码 默认值
        $this->_set_defaultvalue_ctlcode();
        //设置 关联的userid 默认值
        $this->_set_defaultvalue_link_userid();
        //设置 关联用户名 默认值
        $this->_set_defaultvalue_link_username();
        //设置 关联的密码 默认值
        $this->_set_defaultvalue_link_password();
        //设置 渠道号 默认值
        $this->_set_defaultvalue_thirdpartytype();

    }
}