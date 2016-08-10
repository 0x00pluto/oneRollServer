<?php

namespace dbs\templates\mall;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_remoteRollNum
 * @package dbs\templates\mall
 */
abstract class dbs_templates_mall_remoteRollNum extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "mall_remoteRollNum";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.remoteRollNum" );
    }
    /**
     * 彩票ID
     *
     * @var
     */
    const DBKey_id = "id";

	/**
	 * 获取 彩票ID
	 * @return string
	 */
	public function get_id()
	{
		return $this->getdata ( self::DBKey_id );
	}

	/**
	 * 设置 彩票ID
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
     * 重置 彩票ID
     * 设置为 ""
     * @return $this
     */
    public function reset_id()
    {
        return $this->reset_defaultValue(self::DBKey_id);
    }

    /**
     * 设置 彩票ID 默认值
     */
    protected function _set_defaultvalue_id()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_id, "" );
    }
    /**
     * 原始数据
     *
     * @var
     */
    const DBKey_originData = "originData";

	/**
	 * 获取 原始数据
	 * @return array
	 */
	public function get_originData()
	{
		return $this->getdata ( self::DBKey_originData );
	}

	/**
	 * 设置 原始数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_originData($value)
	{
		$this->setdata ( self::DBKey_originData, $value );
		return $this;
	}

	/**
     * 重置 原始数据
     * 设置为 []
     * @return $this
     */
    public function reset_originData()
    {
        return $this->reset_defaultValue(self::DBKey_originData);
    }

    /**
     * 设置 原始数据 默认值
     */
    protected function _set_defaultvalue_originData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_originData, [] );
    }
    /**
     * 期数
     *
     * @var
     */
    const DBKey_expect = "expect";

	/**
	 * 获取 期数
	 * @return string
	 */
	public function get_expect()
	{
		return $this->getdata ( self::DBKey_expect );
	}

	/**
	 * 设置 期数
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_expect($value)
	{
		$this->setdata ( self::DBKey_expect, strval($value) );
		return $this;
	}

	/**
     * 重置 期数
     * 设置为 ""
     * @return $this
     */
    public function reset_expect()
    {
        return $this->reset_defaultValue(self::DBKey_expect);
    }

    /**
     * 设置 期数 默认值
     */
    protected function _set_defaultvalue_expect()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expect, "" );
    }
    /**
     * 开奖码
     *
     * @var
     */
    const DBKey_opencode = "opencode";

	/**
	 * 获取 开奖码
	 * @return int
	 */
	public function get_opencode()
	{
		return $this->getdata ( self::DBKey_opencode );
	}

	/**
	 * 设置 开奖码
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_opencode($value)
	{
		$this->setdata ( self::DBKey_opencode, intval($value) );
		return $this;
	}

	/**
     * 重置 开奖码
     * 设置为 0
     * @return $this
     */
    public function reset_opencode()
    {
        return $this->reset_defaultValue(self::DBKey_opencode);
    }

    /**
     * 设置 开奖码 默认值
     */
    protected function _set_defaultvalue_opencode()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_opencode, 0 );
    }
    /**
     * 开奖时间
     *
     * @var
     */
    const DBKey_opentime = "opentime";

	/**
	 * 获取 开奖时间
	 * @return string
	 */
	public function get_opentime()
	{
		return $this->getdata ( self::DBKey_opentime );
	}

	/**
	 * 设置 开奖时间
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_opentime($value)
	{
		$this->setdata ( self::DBKey_opentime, strval($value) );
		return $this;
	}

	/**
     * 重置 开奖时间
     * 设置为 ""
     * @return $this
     */
    public function reset_opentime()
    {
        return $this->reset_defaultValue(self::DBKey_opentime);
    }

    /**
     * 设置 开奖时间 默认值
     */
    protected function _set_defaultvalue_opentime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_opentime, "" );
    }
    /**
     * 开奖时间戳
     *
     * @var
     */
    const DBKey_opentimestamp = "opentimestamp";

	/**
	 * 获取 开奖时间戳
	 * @return int
	 */
	public function get_opentimestamp()
	{
		return $this->getdata ( self::DBKey_opentimestamp );
	}

	/**
	 * 设置 开奖时间戳
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_opentimestamp($value)
	{
		$this->setdata ( self::DBKey_opentimestamp, intval($value) );
		return $this;
	}

	/**
     * 重置 开奖时间戳
     * 设置为 0
     * @return $this
     */
    public function reset_opentimestamp()
    {
        return $this->reset_defaultValue(self::DBKey_opentimestamp);
    }

    /**
     * 设置 开奖时间戳 默认值
     */
    protected function _set_defaultvalue_opentimestamp()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_opentimestamp, 0 );
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
        //设置 彩票ID 默认值
        $this->_set_defaultvalue_id();
        //设置 原始数据 默认值
        $this->_set_defaultvalue_originData();
        //设置 期数 默认值
        $this->_set_defaultvalue_expect();
        //设置 开奖码 默认值
        $this->_set_defaultvalue_opencode();
        //设置 开奖时间 默认值
        $this->_set_defaultvalue_opentime();
        //设置 开奖时间戳 默认值
        $this->_set_defaultvalue_opentimestamp();

    }
}