<?php

namespace dbs\templates\invite;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_invite_inviteData
 * @package dbs\templates\invite
 */
class dbs_templates_invite_inviteData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "invite.inviteData" );
    }
    /**
     * 被邀请者的用户ID
     *
     * @var
     */
    const DBKey_userId = "userId";

	/**
	 * 获取 被邀请者的用户ID
	 * @return string
	 */
	public function get_userId()
	{
		return $this->getdata ( self::DBKey_userId );
	}

	/**
	 * 设置 被邀请者的用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_userId($value)
	{
		$this->setdata ( self::DBKey_userId, strval($value) );
		return $this;
	}

	/**
     * 重置 被邀请者的用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_userId()
    {
        return $this->reset_defaultValue(self::DBKey_userId);
    }

    /**
     * 设置 被邀请者的用户ID 默认值
     */
    protected function _set_defaultvalue_userId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userId, "" );
    }
    /**
     * 邀请时间戳
     *
     * @var
     */
    const DBKey_inviteTimespan = "inviteTimespan";

	/**
	 * 获取 邀请时间戳
	 * @return int
	 */
	public function get_inviteTimespan()
	{
		return $this->getdata ( self::DBKey_inviteTimespan );
	}

	/**
	 * 设置 邀请时间戳
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_inviteTimespan($value)
	{
		$this->setdata ( self::DBKey_inviteTimespan, intval($value) );
		return $this;
	}

	/**
     * 重置 邀请时间戳
     * 设置为 0
     * @return $this
     */
    public function reset_inviteTimespan()
    {
        return $this->reset_defaultValue(self::DBKey_inviteTimespan);
    }

    /**
     * 设置 邀请时间戳 默认值
     */
    protected function _set_defaultvalue_inviteTimespan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_inviteTimespan, 0 );
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
        //设置 被邀请者的用户ID 默认值
        $this->_set_defaultvalue_userId();
        //设置 邀请时间戳 默认值
        $this->_set_defaultvalue_inviteTimespan();

    }
}