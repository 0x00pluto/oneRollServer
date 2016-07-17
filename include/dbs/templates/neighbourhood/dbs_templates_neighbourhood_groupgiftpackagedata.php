<?php

namespace dbs\templates\neighbourhood;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_neighbourhood_groupgiftpackagedata
 * @package dbs\templates\neighbourhood
 */
class dbs_templates_neighbourhood_groupgiftpackagedata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "neighbourhood.groupgiftpackagedata" );
    }
    /**
     * 红包id
     *
     * @var
     */
    const DBKey_guid = "guid";

	/**
	 * 获取 红包id
	 * @return string
	 */
	public function get_guid()
	{
		return $this->getdata ( self::DBKey_guid );
	}

	/**
	 * 设置 红包id
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
     * 重置 红包id
     * 设置为 ""
     * @return $this
     */
    public function reset_guid()
    {
        return $this->reset_defaultValue(self::DBKey_guid);
    }

    /**
     * 设置 红包id 默认值
     */
    protected function _set_defaultvalue_guid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_guid, "" );
    }
    /**
     * 过期时间
     *
     * @var
     */
    const DBKey_expiretime = "expiretime";

	/**
	 * 获取 过期时间
	 * @return int
	 */
	public function get_expiretime()
	{
		return $this->getdata ( self::DBKey_expiretime );
	}

	/**
	 * 设置 过期时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_expiretime($value)
	{
		$this->setdata ( self::DBKey_expiretime, intval($value) );
		return $this;
	}

	/**
     * 重置 过期时间
     * 设置为 0
     * @return $this
     */
    public function reset_expiretime()
    {
        return $this->reset_defaultValue(self::DBKey_expiretime);
    }

    /**
     * 设置 过期时间 默认值
     */
    protected function _set_defaultvalue_expiretime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expiretime, 0 );
    }
    /**
     * 每份包含的游戏币数量
     *
     * @var
     */
    const DBKey_eachgamecoin = "eachgamecoin";

	/**
	 * 获取 每份包含的游戏币数量
	 * @return int
	 */
	public function get_eachgamecoin()
	{
		return $this->getdata ( self::DBKey_eachgamecoin );
	}

	/**
	 * 设置 每份包含的游戏币数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_eachgamecoin($value)
	{
		$this->setdata ( self::DBKey_eachgamecoin, intval($value) );
		return $this;
	}

	/**
     * 重置 每份包含的游戏币数量
     * 设置为 0
     * @return $this
     */
    public function reset_eachgamecoin()
    {
        return $this->reset_defaultValue(self::DBKey_eachgamecoin);
    }

    /**
     * 设置 每份包含的游戏币数量 默认值
     */
    protected function _set_defaultvalue_eachgamecoin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_eachgamecoin, 0 );
    }
    /**
     * 每份包含的钻石数量
     *
     * @var
     */
    const DBKey_eachdiamond = "eachdiamond";

	/**
	 * 获取 每份包含的钻石数量
	 * @return int
	 */
	public function get_eachdiamond()
	{
		return $this->getdata ( self::DBKey_eachdiamond );
	}

	/**
	 * 设置 每份包含的钻石数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_eachdiamond($value)
	{
		$this->setdata ( self::DBKey_eachdiamond, intval($value) );
		return $this;
	}

	/**
     * 重置 每份包含的钻石数量
     * 设置为 0
     * @return $this
     */
    public function reset_eachdiamond()
    {
        return $this->reset_defaultValue(self::DBKey_eachdiamond);
    }

    /**
     * 设置 每份包含的钻石数量 默认值
     */
    protected function _set_defaultvalue_eachdiamond()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_eachdiamond, 0 );
    }
    /**
     * 可以领取的总数
     *
     * @var
     */
    const DBKey_recvmaxtimes = "recvmaxtimes";

	/**
	 * 获取 可以领取的总数
	 * @return int
	 */
	public function get_recvmaxtimes()
	{
		return $this->getdata ( self::DBKey_recvmaxtimes );
	}

	/**
	 * 设置 可以领取的总数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_recvmaxtimes($value)
	{
		$this->setdata ( self::DBKey_recvmaxtimes, intval($value) );
		return $this;
	}

	/**
     * 重置 可以领取的总数
     * 设置为 0
     * @return $this
     */
    public function reset_recvmaxtimes()
    {
        return $this->reset_defaultValue(self::DBKey_recvmaxtimes);
    }

    /**
     * 设置 可以领取的总数 默认值
     */
    protected function _set_defaultvalue_recvmaxtimes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_recvmaxtimes, 0 );
    }
    /**
     * 目前领取次数
     *
     * @var
     */
    const DBKey_recvtimes = "recvtimes";

	/**
	 * 获取 目前领取次数
	 * @return int
	 */
	public function get_recvtimes()
	{
		return $this->getdata ( self::DBKey_recvtimes );
	}

	/**
	 * 设置 目前领取次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_recvtimes($value)
	{
		$this->setdata ( self::DBKey_recvtimes, intval($value) );
		return $this;
	}

	/**
     * 重置 目前领取次数
     * 设置为 0
     * @return $this
     */
    public function reset_recvtimes()
    {
        return $this->reset_defaultValue(self::DBKey_recvtimes);
    }

    /**
     * 设置 目前领取次数 默认值
     */
    protected function _set_defaultvalue_recvtimes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_recvtimes, 0 );
    }
    /**
     * 领取用户列表
     *
     * @var
     */
    const DBKey_recvuserlist = "recvuserlist";

	/**
	 * 获取 领取用户列表
	 * @return array
	 */
	public function get_recvuserlist()
	{
		return $this->getdata ( self::DBKey_recvuserlist );
	}

	/**
	 * 设置 领取用户列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_recvuserlist($value)
	{
		$this->setdata ( self::DBKey_recvuserlist, $value );
		return $this;
	}

	/**
     * 重置 领取用户列表
     * 设置为 []
     * @return $this
     */
    public function reset_recvuserlist()
    {
        return $this->reset_defaultValue(self::DBKey_recvuserlist);
    }

    /**
     * 设置 领取用户列表 默认值
     */
    protected function _set_defaultvalue_recvuserlist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_recvuserlist, [] );
    }
    /**
     * 发送红包的人
     *
     * @var
     */
    const DBKey_owneruserid = "owneruserid";

	/**
	 * 获取 发送红包的人
	 * @return string
	 */
	public function get_owneruserid()
	{
		return $this->getdata ( self::DBKey_owneruserid );
	}

	/**
	 * 设置 发送红包的人
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
     * 重置 发送红包的人
     * 设置为 ""
     * @return $this
     */
    public function reset_owneruserid()
    {
        return $this->reset_defaultValue(self::DBKey_owneruserid);
    }

    /**
     * 设置 发送红包的人 默认值
     */
    protected function _set_defaultvalue_owneruserid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_owneruserid, "" );
    }
    /**
     * 红包的道具id
     *
     * @var
     */
    const DBKey_gitfitemid = "gitfitemid";

	/**
	 * 获取 红包的道具id
	 * @return string
	 */
	public function get_gitfitemid()
	{
		return $this->getdata ( self::DBKey_gitfitemid );
	}

	/**
	 * 设置 红包的道具id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_gitfitemid($value)
	{
		$this->setdata ( self::DBKey_gitfitemid, strval($value) );
		return $this;
	}

	/**
     * 重置 红包的道具id
     * 设置为 ""
     * @return $this
     */
    public function reset_gitfitemid()
    {
        return $this->reset_defaultValue(self::DBKey_gitfitemid);
    }

    /**
     * 设置 红包的道具id 默认值
     */
    protected function _set_defaultvalue_gitfitemid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_gitfitemid, "" );
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
        //设置 红包id 默认值
        $this->_set_defaultvalue_guid();
        //设置 过期时间 默认值
        $this->_set_defaultvalue_expiretime();
        //设置 每份包含的游戏币数量 默认值
        $this->_set_defaultvalue_eachgamecoin();
        //设置 每份包含的钻石数量 默认值
        $this->_set_defaultvalue_eachdiamond();
        //设置 可以领取的总数 默认值
        $this->_set_defaultvalue_recvmaxtimes();
        //设置 目前领取次数 默认值
        $this->_set_defaultvalue_recvtimes();
        //设置 领取用户列表 默认值
        $this->_set_defaultvalue_recvuserlist();
        //设置 发送红包的人 默认值
        $this->_set_defaultvalue_owneruserid();
        //设置 红包的道具id 默认值
        $this->_set_defaultvalue_gitfitemid();

    }
}