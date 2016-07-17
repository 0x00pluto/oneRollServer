<?php

namespace dbs\templates\friend;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_friend_requestdata
 * @package dbs\templates\friend
 */
class dbs_templates_friend_requestdata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "friend.requestdata" );
    }
    /**
     * 来源用户ID
     *
     * @var
     */
    const DBKey_fromuserid = "fromuserid";

	/**
	 * 获取 来源用户ID
	 * @return string
	 */
	public function get_fromuserid()
	{
		return $this->getdata ( self::DBKey_fromuserid );
	}

	/**
	 * 设置 来源用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_fromuserid($value)
	{
		$this->setdata ( self::DBKey_fromuserid, strval($value) );
		return $this;
	}

	/**
     * 重置 来源用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_fromuserid()
    {
        return $this->reset_defaultValue(self::DBKey_fromuserid);
    }

    /**
     * 设置 来源用户ID 默认值
     */
    protected function _set_defaultvalue_fromuserid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_fromuserid, "" );
    }
    /**
     * 目的用户ID
     *
     * @var
     */
    const DBKey_touserid = "touserid";

	/**
	 * 获取 目的用户ID
	 * @return string
	 */
	public function get_touserid()
	{
		return $this->getdata ( self::DBKey_touserid );
	}

	/**
	 * 设置 目的用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_touserid($value)
	{
		$this->setdata ( self::DBKey_touserid, strval($value) );
		return $this;
	}

	/**
     * 重置 目的用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_touserid()
    {
        return $this->reset_defaultValue(self::DBKey_touserid);
    }

    /**
     * 设置 目的用户ID 默认值
     */
    protected function _set_defaultvalue_touserid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_touserid, "" );
    }
    /**
     * 发送时间
     *
     * @var
     */
    const DBKey_timespan = "timespan";

	/**
	 * 获取 发送时间
	 * @return int
	 */
	public function get_timespan()
	{
		return $this->getdata ( self::DBKey_timespan );
	}

	/**
	 * 设置 发送时间
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
     * 重置 发送时间
     * 设置为 0
     * @return $this
     */
    public function reset_timespan()
    {
        return $this->reset_defaultValue(self::DBKey_timespan);
    }

    /**
     * 设置 发送时间 默认值
     */
    protected function _set_defaultvalue_timespan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_timespan, 0 );
    }
    /**
     * 请求ID
     *
     * @var
     */
    const DBKey_requestguid = "requestguid";

	/**
	 * 获取 请求ID
	 * @return string
	 */
	public function get_requestguid()
	{
		return $this->getdata ( self::DBKey_requestguid );
	}

	/**
	 * 设置 请求ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_requestguid($value)
	{
		$this->setdata ( self::DBKey_requestguid, strval($value) );
		return $this;
	}

	/**
     * 重置 请求ID
     * 设置为 ""
     * @return $this
     */
    public function reset_requestguid()
    {
        return $this->reset_defaultValue(self::DBKey_requestguid);
    }

    /**
     * 设置 请求ID 默认值
     */
    protected function _set_defaultvalue_requestguid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_requestguid, "" );
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
        //设置 来源用户ID 默认值
        $this->_set_defaultvalue_fromuserid();
        //设置 目的用户ID 默认值
        $this->_set_defaultvalue_touserid();
        //设置 发送时间 默认值
        $this->_set_defaultvalue_timespan();
        //设置 请求ID 默认值
        $this->_set_defaultvalue_requestguid();

    }
}