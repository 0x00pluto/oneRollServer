<?php

namespace dbs\templates\friend;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_friend_goodwill
 * @package dbs\templates\friend
 */
abstract class dbs_templates_friend_goodwill extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "friend_goodwills";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "friend.goodwill" );
    }
    /**
     * 好感度唯一标示
     *
     * @var
     */
    const DBKey_guid = "guid";

	/**
	 * 获取 好感度唯一标示
	 * @return string
	 */
	public function get_guid()
	{
		return $this->getdata ( self::DBKey_guid );
	}

	/**
	 * 设置 好感度唯一标示
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_guid($value)
	{
		$this->setdata ( self::DBKey_guid, strval($value) );
		return $this;
	}

	/**
     * 重置 好感度唯一标示
     * 设置为 ""
     * @return $this
     */
    public function reset_guid()
    {
        return $this->reset_defaultValue(self::DBKey_guid);
    }

    /**
     * 设置 好感度唯一标示 默认值
     */
    protected function _set_defaultvalue_guid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_guid, "" );
    }
    /**
     * 好友ID1
     *
     * @var
     */
    const DBKey_userId1 = "userId1";

	/**
	 * 获取 好友ID1
	 * @return string
	 */
	public function get_userId1()
	{
		return $this->getdata ( self::DBKey_userId1 );
	}

	/**
	 * 设置 好友ID1
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_userId1($value)
	{
		$this->setdata ( self::DBKey_userId1, strval($value) );
		return $this;
	}

	/**
     * 重置 好友ID1
     * 设置为 ""
     * @return $this
     */
    public function reset_userId1()
    {
        return $this->reset_defaultValue(self::DBKey_userId1);
    }

    /**
     * 设置 好友ID1 默认值
     */
    protected function _set_defaultvalue_userId1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userId1, "" );
    }
    /**
     * 好友ID2
     *
     * @var
     */
    const DBKey_userId2 = "userId2";

	/**
	 * 获取 好友ID2
	 * @return string
	 */
	public function get_userId2()
	{
		return $this->getdata ( self::DBKey_userId2 );
	}

	/**
	 * 设置 好友ID2
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_userId2($value)
	{
		$this->setdata ( self::DBKey_userId2, strval($value) );
		return $this;
	}

	/**
     * 重置 好友ID2
     * 设置为 ""
     * @return $this
     */
    public function reset_userId2()
    {
        return $this->reset_defaultValue(self::DBKey_userId2);
    }

    /**
     * 设置 好友ID2 默认值
     */
    protected function _set_defaultvalue_userId2()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userId2, "" );
    }
    /**
     * 好感度经验
     *
     * @var
     */
    const DBKey_exp = "exp";

	/**
	 * 获取 好感度经验
	 * @return int
	 */
	public function get_exp()
	{
		return $this->getdata ( self::DBKey_exp );
	}

	/**
	 * 设置 好感度经验
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_exp($value)
	{
		$this->setdata ( self::DBKey_exp, intval($value) );
		return $this;
	}

	/**
     * 重置 好感度经验
     * 设置为 0
     * @return $this
     */
    public function reset_exp()
    {
        return $this->reset_defaultValue(self::DBKey_exp);
    }

    /**
     * 设置 好感度经验 默认值
     */
    protected function _set_defaultvalue_exp()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_exp, 0 );
    }
    /**
     * 好感度总经验
     *
     * @var
     */
    const DBKey_expTotal = "expTotal";

	/**
	 * 获取 好感度总经验
	 * @return int
	 */
	public function get_expTotal()
	{
		return $this->getdata ( self::DBKey_expTotal );
	}

	/**
	 * 设置 好感度总经验
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_expTotal($value)
	{
		$this->setdata ( self::DBKey_expTotal, intval($value) );
		return $this;
	}

	/**
     * 重置 好感度总经验
     * 设置为 0
     * @return $this
     */
    public function reset_expTotal()
    {
        return $this->reset_defaultValue(self::DBKey_expTotal);
    }

    /**
     * 设置 好感度总经验 默认值
     */
    protected function _set_defaultvalue_expTotal()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expTotal, 0 );
    }
    /**
     * 好感度等级
     *
     * @var
     */
    const DBKey_level = "level";

	/**
	 * 获取 好感度等级
	 * @return int
	 */
	public function get_level()
	{
		return $this->getdata ( self::DBKey_level );
	}

	/**
	 * 设置 好感度等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_level($value)
	{
		$this->setdata ( self::DBKey_level, intval($value) );
		return $this;
	}

	/**
     * 重置 好感度等级
     * 设置为 1
     * @return $this
     */
    public function reset_level()
    {
        return $this->reset_defaultValue(self::DBKey_level);
    }

    /**
     * 设置 好感度等级 默认值
     */
    protected function _set_defaultvalue_level()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_level, 1 );
    }
    /**
     * 好友1领取好感度礼包的等级
     *
     * @var
     */
    const DBKey_userAwardGiftLevel1 = "userAwardGiftLevel1";

	/**
	 * 获取 好友1领取好感度礼包的等级
	 * @return int
	 */
	public function get_userAwardGiftLevel1()
	{
		return $this->getdata ( self::DBKey_userAwardGiftLevel1 );
	}

	/**
	 * 设置 好友1领取好感度礼包的等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_userAwardGiftLevel1($value)
	{
		$this->setdata ( self::DBKey_userAwardGiftLevel1, intval($value) );
		return $this;
	}

	/**
     * 重置 好友1领取好感度礼包的等级
     * 设置为 0
     * @return $this
     */
    public function reset_userAwardGiftLevel1()
    {
        return $this->reset_defaultValue(self::DBKey_userAwardGiftLevel1);
    }

    /**
     * 设置 好友1领取好感度礼包的等级 默认值
     */
    protected function _set_defaultvalue_userAwardGiftLevel1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userAwardGiftLevel1, 0 );
    }
    /**
     * 好友2领取好感度礼包的等级
     *
     * @var
     */
    const DBKey_userAwardGiftLevel2 = "userAwardGiftLevel2";

	/**
	 * 获取 好友2领取好感度礼包的等级
	 * @return int
	 */
	public function get_userAwardGiftLevel2()
	{
		return $this->getdata ( self::DBKey_userAwardGiftLevel2 );
	}

	/**
	 * 设置 好友2领取好感度礼包的等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_userAwardGiftLevel2($value)
	{
		$this->setdata ( self::DBKey_userAwardGiftLevel2, intval($value) );
		return $this;
	}

	/**
     * 重置 好友2领取好感度礼包的等级
     * 设置为 0
     * @return $this
     */
    public function reset_userAwardGiftLevel2()
    {
        return $this->reset_defaultValue(self::DBKey_userAwardGiftLevel2);
    }

    /**
     * 设置 好友2领取好感度礼包的等级 默认值
     */
    protected function _set_defaultvalue_userAwardGiftLevel2()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userAwardGiftLevel2, 0 );
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
        //设置 好感度唯一标示 默认值
        $this->_set_defaultvalue_guid();
        //设置 好友ID1 默认值
        $this->_set_defaultvalue_userId1();
        //设置 好友ID2 默认值
        $this->_set_defaultvalue_userId2();
        //设置 好感度经验 默认值
        $this->_set_defaultvalue_exp();
        //设置 好感度总经验 默认值
        $this->_set_defaultvalue_expTotal();
        //设置 好感度等级 默认值
        $this->_set_defaultvalue_level();
        //设置 好友1领取好感度礼包的等级 默认值
        $this->_set_defaultvalue_userAwardGiftLevel1();
        //设置 好友2领取好感度礼包的等级 默认值
        $this->_set_defaultvalue_userAwardGiftLevel2();

    }
}