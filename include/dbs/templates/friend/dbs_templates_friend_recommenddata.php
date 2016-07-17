<?php

namespace dbs\templates\friend;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_friend_recommenddata
 * @package dbs\templates\friend
 */
abstract class dbs_templates_friend_recommenddata extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "friend_recommenddata";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "friend.recommenddata" );
    }
    /**
     * 最后一次登录时间
     *
     * @var
     */
    const DBKey_lastlogintime = "lastlogintime";

	/**
	 * 获取 最后一次登录时间
	 * @return int
	 */
	public function get_lastlogintime()
	{
		return $this->getdata ( self::DBKey_lastlogintime );
	}

	/**
	 * 设置 最后一次登录时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_lastlogintime($value)
	{
		$this->setdata ( self::DBKey_lastlogintime, intval($value) );
		return $this;
	}

	/**
     * 重置 最后一次登录时间
     * 设置为 0
     * @return $this
     */
    public function reset_lastlogintime()
    {
        return $this->reset_defaultValue(self::DBKey_lastlogintime);
    }

    /**
     * 设置 最后一次登录时间 默认值
     */
    protected function _set_defaultvalue_lastlogintime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastlogintime, 0 );
    }
    /**
     * 性别
     *
     * @var
     */
    const DBKey_sex = "sex";

	/**
	 * 获取 性别
	 * @return int
	 */
	public function get_sex()
	{
		return $this->getdata ( self::DBKey_sex );
	}

	/**
	 * 设置 性别
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_sex($value)
	{
		$this->setdata ( self::DBKey_sex, intval($value) );
		return $this;
	}

	/**
     * 重置 性别
     * 设置为 0
     * @return $this
     */
    public function reset_sex()
    {
        return $this->reset_defaultValue(self::DBKey_sex);
    }

    /**
     * 设置 性别 默认值
     */
    protected function _set_defaultvalue_sex()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sex, 0 );
    }
    /**
     * 餐厅等级
     *
     * @var
     */
    const DBKey_restaurantlevel = "restaurantlevel";

	/**
	 * 获取 餐厅等级
	 * @return int
	 */
	public function get_restaurantlevel()
	{
		return $this->getdata ( self::DBKey_restaurantlevel );
	}

	/**
	 * 设置 餐厅等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_restaurantlevel($value)
	{
		$this->setdata ( self::DBKey_restaurantlevel, intval($value) );
		return $this;
	}

	/**
     * 重置 餐厅等级
     * 设置为 0
     * @return $this
     */
    public function reset_restaurantlevel()
    {
        return $this->reset_defaultValue(self::DBKey_restaurantlevel);
    }

    /**
     * 设置 餐厅等级 默认值
     */
    protected function _set_defaultvalue_restaurantlevel()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_restaurantlevel, 0 );
    }
    /**
     * 是否设置头像
     *
     * @var
     */
    const DBKey_setheadicon = "setheadicon";

	/**
	 * 获取 是否设置头像
	 * @return int
	 */
	public function get_setheadicon()
	{
		return $this->getdata ( self::DBKey_setheadicon );
	}

	/**
	 * 设置 是否设置头像
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_setheadicon($value)
	{
		$this->setdata ( self::DBKey_setheadicon, intval($value) );
		return $this;
	}

	/**
     * 重置 是否设置头像
     * 设置为 0
     * @return $this
     */
    public function reset_setheadicon()
    {
        return $this->reset_defaultValue(self::DBKey_setheadicon);
    }

    /**
     * 设置 是否设置头像 默认值
     */
    protected function _set_defaultvalue_setheadicon()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_setheadicon, 0 );
    }
    /**
     * 好友数量
     *
     * @var
     */
    const DBKey_friendcount = "friendcount";

	/**
	 * 获取 好友数量
	 * @return int
	 */
	public function get_friendcount()
	{
		return $this->getdata ( self::DBKey_friendcount );
	}

	/**
	 * 设置 好友数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_friendcount($value)
	{
		$this->setdata ( self::DBKey_friendcount, intval($value) );
		return $this;
	}

	/**
     * 重置 好友数量
     * 设置为 0
     * @return $this
     */
    public function reset_friendcount()
    {
        return $this->reset_defaultValue(self::DBKey_friendcount);
    }

    /**
     * 设置 好友数量 默认值
     */
    protected function _set_defaultvalue_friendcount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_friendcount, 0 );
    }
    /**
     * 是否删除账号
     *
     * @var
     */
    const DBKey_isDeleteAccount = "isDeleteAccount";

	/**
	 * 获取 是否删除账号
	 * @return bool
	 */
	public function get_isDeleteAccount()
	{
		return $this->getdata ( self::DBKey_isDeleteAccount );
	}

	/**
	 * 设置 是否删除账号
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isDeleteAccount($value)
	{
		$this->setdata ( self::DBKey_isDeleteAccount, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否删除账号
     * 设置为 false
     * @return $this
     */
    public function reset_isDeleteAccount()
    {
        return $this->reset_defaultValue(self::DBKey_isDeleteAccount);
    }

    /**
     * 设置 是否删除账号 默认值
     */
    protected function _set_defaultvalue_isDeleteAccount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isDeleteAccount, false );
    }
    /**
     * 出生日期
     *
     * @var
     */
    const DBKey_birthday = "birthday";

	/**
	 * 获取 出生日期
	 * @return string
	 */
	public function get_birthday()
	{
		return $this->getdata ( self::DBKey_birthday );
	}

	/**
	 * 设置 出生日期
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_birthday($value)
	{
		$this->setdata ( self::DBKey_birthday, strval($value) );
		return $this;
	}

	/**
     * 重置 出生日期
     * 设置为 "1970-1-1"
     * @return $this
     */
    public function reset_birthday()
    {
        return $this->reset_defaultValue(self::DBKey_birthday);
    }

    /**
     * 设置 出生日期 默认值
     */
    protected function _set_defaultvalue_birthday()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_birthday, "1970-1-1" );
    }
    /**
     * 是否发送了道具嫁接广告
     *
     * @var
     */
    const DBKey_isPublishingItemGraftAdvertisement = "isPublishingItemGraftAdvertisement";

	/**
	 * 获取 是否发送了道具嫁接广告
	 * @return bool
	 */
	public function get_isPublishingItemGraftAdvertisement()
	{
		return $this->getdata ( self::DBKey_isPublishingItemGraftAdvertisement );
	}

	/**
	 * 设置 是否发送了道具嫁接广告
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isPublishingItemGraftAdvertisement($value)
	{
		$this->setdata ( self::DBKey_isPublishingItemGraftAdvertisement, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否发送了道具嫁接广告
     * 设置为 false
     * @return $this
     */
    public function reset_isPublishingItemGraftAdvertisement()
    {
        return $this->reset_defaultValue(self::DBKey_isPublishingItemGraftAdvertisement);
    }

    /**
     * 设置 是否发送了道具嫁接广告 默认值
     */
    protected function _set_defaultvalue_isPublishingItemGraftAdvertisement()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isPublishingItemGraftAdvertisement, false );
    }
    /**
     * 是否发送了双休广告
     *
     * @var
     */
    const DBKey_isPublishingTrainChefAdvertisement = "isPublishingTrainChefAdvertisement";

	/**
	 * 获取 是否发送了双休广告
	 * @return bool
	 */
	public function get_isPublishingTrainChefAdvertisement()
	{
		return $this->getdata ( self::DBKey_isPublishingTrainChefAdvertisement );
	}

	/**
	 * 设置 是否发送了双休广告
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isPublishingTrainChefAdvertisement($value)
	{
		$this->setdata ( self::DBKey_isPublishingTrainChefAdvertisement, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否发送了双休广告
     * 设置为 false
     * @return $this
     */
    public function reset_isPublishingTrainChefAdvertisement()
    {
        return $this->reset_defaultValue(self::DBKey_isPublishingTrainChefAdvertisement);
    }

    /**
     * 设置 是否发送了双休广告 默认值
     */
    protected function _set_defaultvalue_isPublishingTrainChefAdvertisement()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isPublishingTrainChefAdvertisement, false );
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
        //设置 最后一次登录时间 默认值
        $this->_set_defaultvalue_lastlogintime();
        //设置 性别 默认值
        $this->_set_defaultvalue_sex();
        //设置 餐厅等级 默认值
        $this->_set_defaultvalue_restaurantlevel();
        //设置 是否设置头像 默认值
        $this->_set_defaultvalue_setheadicon();
        //设置 好友数量 默认值
        $this->_set_defaultvalue_friendcount();
        //设置 是否删除账号 默认值
        $this->_set_defaultvalue_isDeleteAccount();
        //设置 出生日期 默认值
        $this->_set_defaultvalue_birthday();
        //设置 是否发送了道具嫁接广告 默认值
        $this->_set_defaultvalue_isPublishingItemGraftAdvertisement();
        //设置 是否发送了双休广告 默认值
        $this->_set_defaultvalue_isPublishingTrainChefAdvertisement();

    }
}