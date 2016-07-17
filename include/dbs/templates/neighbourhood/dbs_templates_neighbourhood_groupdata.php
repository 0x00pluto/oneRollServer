<?php

namespace dbs\templates\neighbourhood;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_neighbourhood_groupdata
 * @package dbs\templates\neighbourhood
 */
abstract class dbs_templates_neighbourhood_groupdata extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "neighbourhoodlist";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "neighbourhood.groupdata" );
    }
    /**
     * 群组id
     *
     * @var
     */
    const DBKey_guid = "guid";

	/**
	 * 获取 群组id
	 * @return string
	 */
	public function get_guid()
	{
		return $this->getdata ( self::DBKey_guid );
	}

	/**
	 * 设置 群组id
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
     * 重置 群组id
     * 设置为 ""
     * @return $this
     */
    public function reset_guid()
    {
        return $this->reset_defaultValue(self::DBKey_guid);
    }

    /**
     * 设置 群组id 默认值
     */
    protected function _set_defaultvalue_guid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_guid, "" );
    }
    /**
     * 群组创建时间
     *
     * @var
     */
    const DBKey_createtime = "createtime";

	/**
	 * 获取 群组创建时间
	 * @return int
	 */
	public function get_createtime()
	{
		return $this->getdata ( self::DBKey_createtime );
	}

	/**
	 * 设置 群组创建时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_createtime($value)
	{
		$this->setdata ( self::DBKey_createtime, intval($value) );
		return $this;
	}

	/**
     * 重置 群组创建时间
     * 设置为 time()
     * @return $this
     */
    public function reset_createtime()
    {
        return $this->reset_defaultValue(self::DBKey_createtime);
    }

    /**
     * 设置 群组创建时间 默认值
     */
    protected function _set_defaultvalue_createtime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_createtime, time() );
    }
    /**
     * 这个社区中的玩家
     *
     * @var
     */
    const DBKey_member = "member";

	/**
	 * 获取 这个社区中的玩家
	 * @return array
	 */
	public function get_member()
	{
		return $this->getdata ( self::DBKey_member );
	}

	/**
	 * 设置 这个社区中的玩家
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_member($value)
	{
		$this->setdata ( self::DBKey_member, $value );
		return $this;
	}

	/**
     * 重置 这个社区中的玩家
     * 设置为 []
     * @return $this
     */
    public function reset_member()
    {
        return $this->reset_defaultValue(self::DBKey_member);
    }

    /**
     * 设置 这个社区中的玩家 默认值
     */
    protected function _set_defaultvalue_member()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_member, [] );
    }
    /**
     * 红包列表
     *
     * @var
     */
    const DBKey_giftpackagelist = "giftpackagelist";

	/**
	 * 获取 红包列表
	 * @return array
	 */
	public function get_giftpackagelist()
	{
		return $this->getdata ( self::DBKey_giftpackagelist );
	}

	/**
	 * 设置 红包列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_giftpackagelist($value)
	{
		$this->setdata ( self::DBKey_giftpackagelist, $value );
		return $this;
	}

	/**
     * 重置 红包列表
     * 设置为 []
     * @return $this
     */
    public function reset_giftpackagelist()
    {
        return $this->reset_defaultValue(self::DBKey_giftpackagelist);
    }

    /**
     * 设置 红包列表 默认值
     */
    protected function _set_defaultvalue_giftpackagelist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_giftpackagelist, [] );
    }
    /**
     * 年龄id
     *
     * @var
     */
    const DBKey_ageid = "ageid";

	/**
	 * 获取 年龄id
	 * @return string
	 */
	public function get_ageid()
	{
		return $this->getdata ( self::DBKey_ageid );
	}

	/**
	 * 设置 年龄id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_ageid($value)
	{
		$this->setdata ( self::DBKey_ageid, strval($value) );
		return $this;
	}

	/**
     * 重置 年龄id
     * 设置为 "1"
     * @return $this
     */
    public function reset_ageid()
    {
        return $this->reset_defaultValue(self::DBKey_ageid);
    }

    /**
     * 设置 年龄id 默认值
     */
    protected function _set_defaultvalue_ageid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_ageid, "1" );
    }
    /**
     * 邀请卷列表
     *
     * @var
     */
    const DBKey_invitelist = "invitelist";

	/**
	 * 获取 邀请卷列表
	 * @return array
	 */
	public function get_invitelist()
	{
		return $this->getdata ( self::DBKey_invitelist );
	}

	/**
	 * 设置 邀请卷列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_invitelist($value)
	{
		$this->setdata ( self::DBKey_invitelist, $value );
		return $this;
	}

	/**
     * 重置 邀请卷列表
     * 设置为 []
     * @return $this
     */
    public function reset_invitelist()
    {
        return $this->reset_defaultValue(self::DBKey_invitelist);
    }

    /**
     * 设置 邀请卷列表 默认值
     */
    protected function _set_defaultvalue_invitelist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_invitelist, [] );
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
        //设置 群组id 默认值
        $this->_set_defaultvalue_guid();
        //设置 群组创建时间 默认值
        $this->_set_defaultvalue_createtime();
        //设置 这个社区中的玩家 默认值
        $this->_set_defaultvalue_member();
        //设置 红包列表 默认值
        $this->_set_defaultvalue_giftpackagelist();
        //设置 年龄id 默认值
        $this->_set_defaultvalue_ageid();
        //设置 邀请卷列表 默认值
        $this->_set_defaultvalue_invitelist();

    }
}