<?php

namespace dbs\templates\invite;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_invite_player
 * @package dbs\templates\invite
 */
abstract class dbs_templates_invite_player extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "invites";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "invite.player" );
    }
    /**
     * 邀请码
     *
     * @var
     */
    const DBKey_inviteCode = "inviteCode";

	/**
	 * 获取 邀请码
	 * @return int
	 */
	public function get_inviteCode()
	{
		return $this->getdata ( self::DBKey_inviteCode );
	}

	/**
	 * 设置 邀请码
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_inviteCode($value)
	{
		$this->setdata ( self::DBKey_inviteCode, intval($value) );
		return $this;
	}

	/**
     * 重置 邀请码
     * 设置为 0
     * @return $this
     */
    public function reset_inviteCode()
    {
        return $this->reset_defaultValue(self::DBKey_inviteCode);
    }

    /**
     * 设置 邀请码 默认值
     */
    protected function _set_defaultvalue_inviteCode()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_inviteCode, 0 );
    }
    /**
     * 邀请我的用户ID
     *
     * @var
     */
    const DBKey_invitedUserid = "invitedUserid";

	/**
	 * 获取 邀请我的用户ID
	 * @return string
	 */
	public function get_invitedUserid()
	{
		return $this->getdata ( self::DBKey_invitedUserid );
	}

	/**
	 * 设置 邀请我的用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_invitedUserid($value)
	{
		$this->setdata ( self::DBKey_invitedUserid, strval($value) );
		return $this;
	}

	/**
     * 重置 邀请我的用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_invitedUserid()
    {
        return $this->reset_defaultValue(self::DBKey_invitedUserid);
    }

    /**
     * 设置 邀请我的用户ID 默认值
     */
    protected function _set_defaultvalue_invitedUserid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_invitedUserid, "" );
    }
    /**
     * 我邀请别人的数据
     *
     * @var
     */
    const DBKey_inviteDatas = "inviteDatas";

	/**
	 * 获取 我邀请别人的数据
	 * @return array
	 */
	public function get_inviteDatas()
	{
		return $this->getdata ( self::DBKey_inviteDatas );
	}

	/**
	 * 设置 我邀请别人的数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_inviteDatas($value)
	{
		$this->setdata ( self::DBKey_inviteDatas, $value );
		return $this;
	}

	/**
     * 重置 我邀请别人的数据
     * 设置为 []
     * @return $this
     */
    public function reset_inviteDatas()
    {
        return $this->reset_defaultValue(self::DBKey_inviteDatas);
    }

    /**
     * 设置 我邀请别人的数据 默认值
     */
    protected function _set_defaultvalue_inviteDatas()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_inviteDatas, [] );
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
        //设置 邀请码 默认值
        $this->_set_defaultvalue_inviteCode();
        //设置 邀请我的用户ID 默认值
        $this->_set_defaultvalue_invitedUserid();
        //设置 我邀请别人的数据 默认值
        $this->_set_defaultvalue_inviteDatas();

    }
}