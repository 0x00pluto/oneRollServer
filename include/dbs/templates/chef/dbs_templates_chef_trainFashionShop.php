<?php

namespace dbs\templates\chef;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_trainFashionShop
 * @package dbs\templates\chef
 */
class dbs_templates_chef_trainFashionShop extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.trainFashionShop" );
    }
    /**
     * 商店ID
     *
     * @var
     */
    const DBKey_id = "id";

	/**
	 * 获取 商店ID
	 * @return string
	 */
	public function get_id()
	{
		return $this->getdata ( self::DBKey_id );
	}

	/**
	 * 设置 商店ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_id($value)
	{
		$this->setdata ( self::DBKey_id, strval($value) );
		return $this;
	}

	/**
     * 重置 商店ID
     * 设置为 ""
     * @return $this
     */
    public function reset_id()
    {
        return $this->reset_defaultValue(self::DBKey_id);
    }

    /**
     * 设置 商店ID 默认值
     */
    protected function _set_defaultvalue_id()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_id, "" );
    }
    /**
     * 过期时间
     *
     * @var
     */
    const DBKey_expiredtime = "expiredtime";

	/**
	 * 获取 过期时间
	 * @return int
	 */
	public function get_expiredtime()
	{
		return $this->getdata ( self::DBKey_expiredtime );
	}

	/**
	 * 设置 过期时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_expiredtime($value)
	{
		$this->setdata ( self::DBKey_expiredtime, intval($value) );
		return $this;
	}

	/**
     * 重置 过期时间
     * 设置为 0
     * @return $this
     */
    public function reset_expiredtime()
    {
        return $this->reset_defaultValue(self::DBKey_expiredtime);
    }

    /**
     * 设置 过期时间 默认值
     */
    protected function _set_defaultvalue_expiredtime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expiredtime, 0 );
    }
    /**
     * 赠予者的用户id
     *
     * @var
     */
    const DBKey_owneruserid = "owneruserid";

	/**
	 * 获取 赠予者的用户id
	 * @return string
	 */
	public function get_owneruserid()
	{
		return $this->getdata ( self::DBKey_owneruserid );
	}

	/**
	 * 设置 赠予者的用户id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_owneruserid($value)
	{
		$this->setdata ( self::DBKey_owneruserid, strval($value) );
		return $this;
	}

	/**
     * 重置 赠予者的用户id
     * 设置为 ""
     * @return $this
     */
    public function reset_owneruserid()
    {
        return $this->reset_defaultValue(self::DBKey_owneruserid);
    }

    /**
     * 设置 赠予者的用户id 默认值
     */
    protected function _set_defaultvalue_owneruserid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_owneruserid, "" );
    }
    /**
     * 赠予者的厨师id
     *
     * @var
     */
    const DBKey_ownerchefid = "ownerchefid";

	/**
	 * 获取 赠予者的厨师id
	 * @return string
	 */
	public function get_ownerchefid()
	{
		return $this->getdata ( self::DBKey_ownerchefid );
	}

	/**
	 * 设置 赠予者的厨师id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_ownerchefid($value)
	{
		$this->setdata ( self::DBKey_ownerchefid, strval($value) );
		return $this;
	}

	/**
     * 重置 赠予者的厨师id
     * 设置为 ""
     * @return $this
     */
    public function reset_ownerchefid()
    {
        return $this->reset_defaultValue(self::DBKey_ownerchefid);
    }

    /**
     * 设置 赠予者的厨师id 默认值
     */
    protected function _set_defaultvalue_ownerchefid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_ownerchefid, "" );
    }
    /**
     * 被赠予者的用户id
     *
     * @var
     */
    const DBKey_presentuserid = "presentuserid";

	/**
	 * 获取 被赠予者的用户id
	 * @return string
	 */
	public function get_presentuserid()
	{
		return $this->getdata ( self::DBKey_presentuserid );
	}

	/**
	 * 设置 被赠予者的用户id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_presentuserid($value)
	{
		$this->setdata ( self::DBKey_presentuserid, strval($value) );
		return $this;
	}

	/**
     * 重置 被赠予者的用户id
     * 设置为 ""
     * @return $this
     */
    public function reset_presentuserid()
    {
        return $this->reset_defaultValue(self::DBKey_presentuserid);
    }

    /**
     * 设置 被赠予者的用户id 默认值
     */
    protected function _set_defaultvalue_presentuserid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_presentuserid, "" );
    }
    /**
     * 被赠予者的厨师id
     *
     * @var
     */
    const DBKey_presentchefid = "presentchefid";

	/**
	 * 获取 被赠予者的厨师id
	 * @return string
	 */
	public function get_presentchefid()
	{
		return $this->getdata ( self::DBKey_presentchefid );
	}

	/**
	 * 设置 被赠予者的厨师id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_presentchefid($value)
	{
		$this->setdata ( self::DBKey_presentchefid, strval($value) );
		return $this;
	}

	/**
     * 重置 被赠予者的厨师id
     * 设置为 ""
     * @return $this
     */
    public function reset_presentchefid()
    {
        return $this->reset_defaultValue(self::DBKey_presentchefid);
    }

    /**
     * 设置 被赠予者的厨师id 默认值
     */
    protected function _set_defaultvalue_presentchefid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_presentchefid, "" );
    }
    /**
     * 位置1道具,对应31002中id
     *
     * @var
     */
    const DBKey_slotid1 = "slotid1";

	/**
	 * 获取 位置1道具,对应31002中id
	 * @return int
	 */
	public function get_slotid1()
	{
		return $this->getdata ( self::DBKey_slotid1 );
	}

	/**
	 * 设置 位置1道具,对应31002中id
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_slotid1($value)
	{
		$this->setdata ( self::DBKey_slotid1, intval($value) );
		return $this;
	}

	/**
     * 重置 位置1道具,对应31002中id
     * 设置为 0
     * @return $this
     */
    public function reset_slotid1()
    {
        return $this->reset_defaultValue(self::DBKey_slotid1);
    }

    /**
     * 设置 位置1道具,对应31002中id 默认值
     */
    protected function _set_defaultvalue_slotid1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_slotid1, 0 );
    }
    /**
     * 位置2道具,对应31002中id
     *
     * @var
     */
    const DBKey_slotid2 = "slotid2";

	/**
	 * 获取 位置2道具,对应31002中id
	 * @return int
	 */
	public function get_slotid2()
	{
		return $this->getdata ( self::DBKey_slotid2 );
	}

	/**
	 * 设置 位置2道具,对应31002中id
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_slotid2($value)
	{
		$this->setdata ( self::DBKey_slotid2, intval($value) );
		return $this;
	}

	/**
     * 重置 位置2道具,对应31002中id
     * 设置为 0
     * @return $this
     */
    public function reset_slotid2()
    {
        return $this->reset_defaultValue(self::DBKey_slotid2);
    }

    /**
     * 设置 位置2道具,对应31002中id 默认值
     */
    protected function _set_defaultvalue_slotid2()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_slotid2, 0 );
    }
    /**
     * 位置3道具,对应31002中id
     *
     * @var
     */
    const DBKey_slotid3 = "slotid3";

	/**
	 * 获取 位置3道具,对应31002中id
	 * @return int
	 */
	public function get_slotid3()
	{
		return $this->getdata ( self::DBKey_slotid3 );
	}

	/**
	 * 设置 位置3道具,对应31002中id
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_slotid3($value)
	{
		$this->setdata ( self::DBKey_slotid3, intval($value) );
		return $this;
	}

	/**
     * 重置 位置3道具,对应31002中id
     * 设置为 0
     * @return $this
     */
    public function reset_slotid3()
    {
        return $this->reset_defaultValue(self::DBKey_slotid3);
    }

    /**
     * 设置 位置3道具,对应31002中id 默认值
     */
    protected function _set_defaultvalue_slotid3()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_slotid3, 0 );
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
        //设置 商店ID 默认值
        $this->_set_defaultvalue_id();
        //设置 过期时间 默认值
        $this->_set_defaultvalue_expiredtime();
        //设置 赠予者的用户id 默认值
        $this->_set_defaultvalue_owneruserid();
        //设置 赠予者的厨师id 默认值
        $this->_set_defaultvalue_ownerchefid();
        //设置 被赠予者的用户id 默认值
        $this->_set_defaultvalue_presentuserid();
        //设置 被赠予者的厨师id 默认值
        $this->_set_defaultvalue_presentchefid();
        //设置 位置1道具,对应31002中id 默认值
        $this->_set_defaultvalue_slotid1();
        //设置 位置2道具,对应31002中id 默认值
        $this->_set_defaultvalue_slotid2();
        //设置 位置3道具,对应31002中id 默认值
        $this->_set_defaultvalue_slotid3();

    }
}