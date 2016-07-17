<?php

namespace dbs\templates\neighbourhood;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_neighbourhood_groupmemberdata
 * @package dbs\templates\neighbourhood
 */
class dbs_templates_neighbourhood_groupmemberdata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "neighbourhood.groupmemberdata" );
    }
    /**
     * 用户id
     *
     * @var
     */
    const DBKey_playerguid = "playerguid";

	/**
	 * 获取 用户id
	 * @return string
	 */
	public function get_playerguid()
	{
		return $this->getdata ( self::DBKey_playerguid );
	}

	/**
	 * 设置 用户id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_playerguid($value)
	{
		$this->setdata ( self::DBKey_playerguid, strval($value) );
		return $this;
	}

	/**
     * 重置 用户id
     * 设置为 ""
     * @return $this
     */
    public function reset_playerguid()
    {
        return $this->reset_defaultValue(self::DBKey_playerguid);
    }

    /**
     * 设置 用户id 默认值
     */
    protected function _set_defaultvalue_playerguid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_playerguid, "" );
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
     * 位置id
     *
     * @var
     */
    const DBKey_posid = "posid";

	/**
	 * 获取 位置id
	 * @return int
	 */
	public function get_posid()
	{
		return $this->getdata ( self::DBKey_posid );
	}

	/**
	 * 设置 位置id
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_posid($value)
	{
		$this->setdata ( self::DBKey_posid, intval($value) );
		return $this;
	}

	/**
     * 重置 位置id
     * 设置为 0
     * @return $this
     */
    public function reset_posid()
    {
        return $this->reset_defaultValue(self::DBKey_posid);
    }

    /**
     * 设置 位置id 默认值
     */
    protected function _set_defaultvalue_posid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_posid, 0 );
    }
    /**
     * 分配种子id
     *
     * @var
     */
    const DBKey_seekid = "seekid";

	/**
	 * 获取 分配种子id
	 * @return int
	 */
	public function get_seekid()
	{
		return $this->getdata ( self::DBKey_seekid );
	}

	/**
	 * 设置 分配种子id
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_seekid($value)
	{
		$this->setdata ( self::DBKey_seekid, intval($value) );
		return $this;
	}

	/**
     * 重置 分配种子id
     * 设置为 0
     * @return $this
     */
    public function reset_seekid()
    {
        return $this->reset_defaultValue(self::DBKey_seekid);
    }

    /**
     * 设置 分配种子id 默认值
     */
    protected function _set_defaultvalue_seekid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_seekid, 0 );
    }
    /**
     * 加入时间
     *
     * @var
     */
    const DBKey_joindate = "joindate";

	/**
	 * 获取 加入时间
	 * @return int
	 */
	public function get_joindate()
	{
		return $this->getdata ( self::DBKey_joindate );
	}

	/**
	 * 设置 加入时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_joindate($value)
	{
		$this->setdata ( self::DBKey_joindate, intval($value) );
		return $this;
	}

	/**
     * 重置 加入时间
     * 设置为 time()
     * @return $this
     */
    public function reset_joindate()
    {
        return $this->reset_defaultValue(self::DBKey_joindate);
    }

    /**
     * 设置 加入时间 默认值
     */
    protected function _set_defaultvalue_joindate()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_joindate, time() );
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
        //设置 用户id 默认值
        $this->_set_defaultvalue_playerguid();
        //设置 群组id 默认值
        $this->_set_defaultvalue_groupid();
        //设置 位置id 默认值
        $this->_set_defaultvalue_posid();
        //设置 分配种子id 默认值
        $this->_set_defaultvalue_seekid();
        //设置 加入时间 默认值
        $this->_set_defaultvalue_joindate();

    }
}