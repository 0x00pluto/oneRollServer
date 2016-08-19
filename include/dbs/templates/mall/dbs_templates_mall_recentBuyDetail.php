<?php

namespace dbs\templates\mall;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_recentBuyDetail
 * @package dbs\templates\mall
 */
class dbs_templates_mall_recentBuyDetail extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.recentBuyDetail" );
    }
    /**
     * 交易ID
     *
     * @var
     */
    const DBKey_tradeId = "tradeId";

	/**
	 * 获取 交易ID
	 * @return string
	 */
	public function get_tradeId()
	{
		return $this->getdata ( self::DBKey_tradeId );
	}

	/**
	 * 设置 交易ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_tradeId($value)
	{
		$this->setdata ( self::DBKey_tradeId, strval($value) );
		return $this;
	}

	/**
     * 重置 交易ID
     * 设置为 ""
     * @return $this
     */
    public function reset_tradeId()
    {
        return $this->reset_defaultValue(self::DBKey_tradeId);
    }

    /**
     * 设置 交易ID 默认值
     */
    protected function _set_defaultvalue_tradeId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_tradeId, "" );
    }
    /**
     * 时间戳
     *
     * @var
     */
    const DBKey_rollTimeSpan = "rollTimeSpan";

	/**
	 * 获取 时间戳
	 * @return int
	 */
	public function get_rollTimeSpan()
	{
		return $this->getdata ( self::DBKey_rollTimeSpan );
	}

	/**
	 * 设置 时间戳
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_rollTimeSpan($value)
	{
		$this->setdata ( self::DBKey_rollTimeSpan, intval($value) );
		return $this;
	}

	/**
     * 重置 时间戳
     * 设置为 0
     * @return $this
     */
    public function reset_rollTimeSpan()
    {
        return $this->reset_defaultValue(self::DBKey_rollTimeSpan);
    }

    /**
     * 设置 时间戳 默认值
     */
    protected function _set_defaultvalue_rollTimeSpan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rollTimeSpan, 0 );
    }
    /**
     * 交易时间
     *
     * @var
     */
    const DBKey_tradeTime = "tradeTime";

	/**
	 * 获取 交易时间
	 * @return int
	 */
	public function get_tradeTime()
	{
		return $this->getdata ( self::DBKey_tradeTime );
	}

	/**
	 * 设置 交易时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_tradeTime($value)
	{
		$this->setdata ( self::DBKey_tradeTime, intval($value) );
		return $this;
	}

	/**
     * 重置 交易时间
     * 设置为 0
     * @return $this
     */
    public function reset_tradeTime()
    {
        return $this->reset_defaultValue(self::DBKey_tradeTime);
    }

    /**
     * 设置 交易时间 默认值
     */
    protected function _set_defaultvalue_tradeTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_tradeTime, 0 );
    }
    /**
     * 交易时间毫秒
     *
     * @var
     */
    const DBKey_tradeTimeMillisecond = "tradeTimeMillisecond";

	/**
	 * 获取 交易时间毫秒
	 * @return int
	 */
	public function get_tradeTimeMillisecond()
	{
		return $this->getdata ( self::DBKey_tradeTimeMillisecond );
	}

	/**
	 * 设置 交易时间毫秒
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_tradeTimeMillisecond($value)
	{
		$this->setdata ( self::DBKey_tradeTimeMillisecond, intval($value) );
		return $this;
	}

	/**
     * 重置 交易时间毫秒
     * 设置为 0
     * @return $this
     */
    public function reset_tradeTimeMillisecond()
    {
        return $this->reset_defaultValue(self::DBKey_tradeTimeMillisecond);
    }

    /**
     * 设置 交易时间毫秒 默认值
     */
    protected function _set_defaultvalue_tradeTimeMillisecond()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_tradeTimeMillisecond, 0 );
    }
    /**
     * 交易用户ID
     *
     * @var
     */
    const DBKey_tradeUserId = "tradeUserId";

	/**
	 * 获取 交易用户ID
	 * @return string
	 */
	public function get_tradeUserId()
	{
		return $this->getdata ( self::DBKey_tradeUserId );
	}

	/**
	 * 设置 交易用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_tradeUserId($value)
	{
		$this->setdata ( self::DBKey_tradeUserId, strval($value) );
		return $this;
	}

	/**
     * 重置 交易用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_tradeUserId()
    {
        return $this->reset_defaultValue(self::DBKey_tradeUserId);
    }

    /**
     * 设置 交易用户ID 默认值
     */
    protected function _set_defaultvalue_tradeUserId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_tradeUserId, "" );
    }
    /**
     * 交易用户简易信息
     *
     * @var
     */
    const DBKey_tradeUserInfo = "tradeUserInfo";

	/**
	 * 获取 交易用户简易信息
	 * @return array
	 */
	public function get_tradeUserInfo()
	{
		return $this->getdata ( self::DBKey_tradeUserInfo );
	}

	/**
	 * 设置 交易用户简易信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_tradeUserInfo($value)
	{
		$this->setdata ( self::DBKey_tradeUserInfo, $value );
		return $this;
	}

	/**
     * 重置 交易用户简易信息
     * 设置为 []
     * @return $this
     */
    public function reset_tradeUserInfo()
    {
        return $this->reset_defaultValue(self::DBKey_tradeUserInfo);
    }

    /**
     * 设置 交易用户简易信息 默认值
     */
    protected function _set_defaultvalue_tradeUserInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_tradeUserInfo, [] );
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
        //设置 交易ID 默认值
        $this->_set_defaultvalue_tradeId();
        //设置 时间戳 默认值
        $this->_set_defaultvalue_rollTimeSpan();
        //设置 交易时间 默认值
        $this->_set_defaultvalue_tradeTime();
        //设置 交易时间毫秒 默认值
        $this->_set_defaultvalue_tradeTimeMillisecond();
        //设置 交易用户ID 默认值
        $this->_set_defaultvalue_tradeUserId();
        //设置 交易用户简易信息 默认值
        $this->_set_defaultvalue_tradeUserInfo();

    }
}