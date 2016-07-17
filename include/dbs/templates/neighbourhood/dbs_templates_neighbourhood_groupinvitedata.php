<?php

namespace dbs\templates\neighbourhood;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_neighbourhood_groupinvitedata
 * @package dbs\templates\neighbourhood
 */
class dbs_templates_neighbourhood_groupinvitedata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "neighbourhood.groupinvitedata" );
    }
    /**
     * 唯一id
     *
     * @var
     */
    const DBKey_inviteguid = "inviteguid";

	/**
	 * 获取 唯一id
	 * @return string
	 */
	public function get_inviteguid()
	{
		return $this->getdata ( self::DBKey_inviteguid );
	}

	/**
	 * 设置 唯一id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_inviteguid($value)
	{
		$this->setdata ( self::DBKey_inviteguid, strval($value) );
		return $this;
	}

	/**
     * 重置 唯一id
     * 设置为 ""
     * @return $this
     */
    public function reset_inviteguid()
    {
        return $this->reset_defaultValue(self::DBKey_inviteguid);
    }

    /**
     * 设置 唯一id 默认值
     */
    protected function _set_defaultvalue_inviteguid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_inviteguid, "" );
    }
    /**
     * 超时时间
     *
     * @var
     */
    const DBKey_timeout = "timeout";

	/**
	 * 获取 超时时间
	 * @return int
	 */
	public function get_timeout()
	{
		return $this->getdata ( self::DBKey_timeout );
	}

	/**
	 * 设置 超时时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_timeout($value)
	{
		$this->setdata ( self::DBKey_timeout, intval($value) );
		return $this;
	}

	/**
     * 重置 超时时间
     * 设置为 0
     * @return $this
     */
    public function reset_timeout()
    {
        return $this->reset_defaultValue(self::DBKey_timeout);
    }

    /**
     * 设置 超时时间 默认值
     */
    protected function _set_defaultvalue_timeout()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_timeout, 0 );
    }
    /**
     * 获取申请的userid
     *
     * @var
     */
    const DBKey_userid = "userid";

	/**
	 * 获取 获取申请的userid
	 * @return string
	 */
	public function get_userid()
	{
		return $this->getdata ( self::DBKey_userid );
	}

	/**
	 * 设置 获取申请的userid
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
     * 重置 获取申请的userid
     * 设置为 ""
     * @return $this
     */
    public function reset_userid()
    {
        return $this->reset_defaultValue(self::DBKey_userid);
    }

    /**
     * 设置 获取申请的userid 默认值
     */
    protected function _set_defaultvalue_userid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userid, "" );
    }
    /**
     * 锁定的位置
     *
     * @var
     */
    const DBKey_lockposid = "lockposid";

	/**
	 * 获取 锁定的位置
	 * @return string
	 */
	public function get_lockposid()
	{
		return $this->getdata ( self::DBKey_lockposid );
	}

	/**
	 * 设置 锁定的位置
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_lockposid($value)
	{
		$this->setdata ( self::DBKey_lockposid, strval($value) );
		return $this;
	}

	/**
     * 重置 锁定的位置
     * 设置为 ""
     * @return $this
     */
    public function reset_lockposid()
    {
        return $this->reset_defaultValue(self::DBKey_lockposid);
    }

    /**
     * 设置 锁定的位置 默认值
     */
    protected function _set_defaultvalue_lockposid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lockposid, "" );
    }
    /**
     * 群组id
     *
     * @var
     */
    const DBKey_groupid = "groupid";

	/**
	 * 获取 群组id
	 * @return string
	 */
	public function get_groupid()
	{
		return $this->getdata ( self::DBKey_groupid );
	}

	/**
	 * 设置 群组id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_groupid($value)
	{
		$this->setdata ( self::DBKey_groupid, strval($value) );
		return $this;
	}

	/**
     * 重置 群组id
     * 设置为 ""
     * @return $this
     */
    public function reset_groupid()
    {
        return $this->reset_defaultValue(self::DBKey_groupid);
    }

    /**
     * 设置 群组id 默认值
     */
    protected function _set_defaultvalue_groupid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_groupid, "" );
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
        //设置 唯一id 默认值
        $this->_set_defaultvalue_inviteguid();
        //设置 超时时间 默认值
        $this->_set_defaultvalue_timeout();
        //设置 获取申请的userid 默认值
        $this->_set_defaultvalue_userid();
        //设置 锁定的位置 默认值
        $this->_set_defaultvalue_lockposid();
        //设置 群组id 默认值
        $this->_set_defaultvalue_groupid();

    }
}