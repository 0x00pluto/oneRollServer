<?php

namespace dbs\templates\friend;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_friend_data
 * @package dbs\templates\friend
 */
class dbs_templates_friend_data extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "friend.data" );
    }
    /**
     * 好友的用户id
     *
     * @var
     */
    const DBKey_frienduserid = "frienduserid";

	/**
	 * 获取 好友的用户id
	 * @return string
	 */
	public function get_frienduserid()
	{
		return $this->getdata ( self::DBKey_frienduserid );
	}

	/**
	 * 设置 好友的用户id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_frienduserid($value)
	{
		$this->setdata ( self::DBKey_frienduserid, strval($value) );
		return $this;
	}

	/**
     * 重置 好友的用户id
     * 设置为 ""
     * @return $this
     */
    public function reset_frienduserid()
    {
        return $this->reset_defaultValue(self::DBKey_frienduserid);
    }

    /**
     * 设置 好友的用户id 默认值
     */
    protected function _set_defaultvalue_frienduserid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_frienduserid, "" );
    }
    /**
     * 成为好友时间
     *
     * @var
     */
    const DBKey_timespan = "timespan";

	/**
	 * 获取 成为好友时间
	 * @return int
	 */
	public function get_timespan()
	{
		return $this->getdata ( self::DBKey_timespan );
	}

	/**
	 * 设置 成为好友时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_timespan($value)
	{
		$this->setdata ( self::DBKey_timespan, intval($value) );
		return $this;
	}

	/**
     * 重置 成为好友时间
     * 设置为 0
     * @return $this
     */
    public function reset_timespan()
    {
        return $this->reset_defaultValue(self::DBKey_timespan);
    }

    /**
     * 设置 成为好友时间 默认值
     */
    protected function _set_defaultvalue_timespan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_timespan, 0 );
    }
    /**
     * 好感度唯一ID
     *
     * @var
     */
    const DBKey_goodwillGUID = "goodwillGUID";

	/**
	 * 获取 好感度唯一ID
	 * @return string
	 */
	public function get_goodwillGUID()
	{
		return $this->getdata ( self::DBKey_goodwillGUID );
	}

	/**
	 * 设置 好感度唯一ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_goodwillGUID($value)
	{
		$this->setdata ( self::DBKey_goodwillGUID, strval($value) );
		return $this;
	}

	/**
     * 重置 好感度唯一ID
     * 设置为 ""
     * @return $this
     */
    public function reset_goodwillGUID()
    {
        return $this->reset_defaultValue(self::DBKey_goodwillGUID);
    }

    /**
     * 设置 好感度唯一ID 默认值
     */
    protected function _set_defaultvalue_goodwillGUID()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodwillGUID, "" );
    }
    /**
     * 最后一次登录时间
     *
     * @var
     */
    const DBKey_lastlogin = "lastlogin";

	/**
	 * 获取 最后一次登录时间
	 * @return int
	 */
	public function get_lastlogin()
	{
		return $this->getdata ( self::DBKey_lastlogin );
	}

	/**
	 * 设置 最后一次登录时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_lastlogin($value)
	{
		$this->setdata ( self::DBKey_lastlogin, intval($value) );
		return $this;
	}

	/**
     * 重置 最后一次登录时间
     * 设置为 0
     * @return $this
     */
    public function reset_lastlogin()
    {
        return $this->reset_defaultValue(self::DBKey_lastlogin);
    }

    /**
     * 设置 最后一次登录时间 默认值
     */
    protected function _set_defaultvalue_lastlogin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastlogin, 0 );
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
        //设置 好友的用户id 默认值
        $this->_set_defaultvalue_frienduserid();
        //设置 成为好友时间 默认值
        $this->_set_defaultvalue_timespan();
        //设置 好感度唯一ID 默认值
        $this->_set_defaultvalue_goodwillGUID();
        //设置 最后一次登录时间 默认值
        $this->_set_defaultvalue_lastlogin();

    }
}