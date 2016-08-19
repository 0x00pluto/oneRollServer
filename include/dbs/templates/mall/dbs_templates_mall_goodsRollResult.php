<?php

namespace dbs\templates\mall;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_goodsRollResult
 * @package dbs\templates\mall
 */
class dbs_templates_mall_goodsRollResult extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.goodsRollResult" );
    }
    /**
     * 重庆时时彩开奖ID
     *
     * @var
     */
    const DBKey_cqsscId = "cqsscId";

	/**
	 * 获取 重庆时时彩开奖ID
	 * @return string
	 */
	public function get_cqsscId()
	{
		return $this->getdata ( self::DBKey_cqsscId );
	}

	/**
	 * 设置 重庆时时彩开奖ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_cqsscId($value)
	{
		$this->setdata ( self::DBKey_cqsscId, strval($value) );
		return $this;
	}

	/**
     * 重置 重庆时时彩开奖ID
     * 设置为 ""
     * @return $this
     */
    public function reset_cqsscId()
    {
        return $this->reset_defaultValue(self::DBKey_cqsscId);
    }

    /**
     * 设置 重庆时时彩开奖ID 默认值
     */
    protected function _set_defaultvalue_cqsscId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cqsscId, "" );
    }
    /**
     * 购买完成时间
     *
     * @var
     */
    const DBKey_finishTime = "finishTime";

	/**
	 * 获取 购买完成时间
	 * @return int
	 */
	public function get_finishTime()
	{
		return $this->getdata ( self::DBKey_finishTime );
	}

	/**
	 * 设置 购买完成时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_finishTime($value)
	{
		$this->setdata ( self::DBKey_finishTime, intval($value) );
		return $this;
	}

	/**
     * 重置 购买完成时间
     * 设置为 0
     * @return $this
     */
    public function reset_finishTime()
    {
        return $this->reset_defaultValue(self::DBKey_finishTime);
    }

    /**
     * 设置 购买完成时间 默认值
     */
    protected function _set_defaultvalue_finishTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_finishTime, 0 );
    }
    /**
     * 抽奖时间
     *
     * @var
     */
    const DBKey_rollTime = "rollTime";

	/**
	 * 获取 抽奖时间
	 * @return int
	 */
	public function get_rollTime()
	{
		return $this->getdata ( self::DBKey_rollTime );
	}

	/**
	 * 设置 抽奖时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_rollTime($value)
	{
		$this->setdata ( self::DBKey_rollTime, intval($value) );
		return $this;
	}

	/**
     * 重置 抽奖时间
     * 设置为 0
     * @return $this
     */
    public function reset_rollTime()
    {
        return $this->reset_defaultValue(self::DBKey_rollTime);
    }

    /**
     * 设置 抽奖时间 默认值
     */
    protected function _set_defaultvalue_rollTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rollTime, 0 );
    }
    /**
     * 最后50个购买者信息
     *
     * @var
     */
    const DBKey_recentBuy = "recentBuy";

	/**
	 * 获取 最后50个购买者信息
	 * @return array
	 */
	public function get_recentBuy()
	{
		return $this->getdata ( self::DBKey_recentBuy );
	}

	/**
	 * 设置 最后50个购买者信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_recentBuy($value)
	{
		$this->setdata ( self::DBKey_recentBuy, $value );
		return $this;
	}

	/**
     * 重置 最后50个购买者信息
     * 设置为 []
     * @return $this
     */
    public function reset_recentBuy()
    {
        return $this->reset_defaultValue(self::DBKey_recentBuy);
    }

    /**
     * 设置 最后50个购买者信息 默认值
     */
    protected function _set_defaultvalue_recentBuy()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_recentBuy, [] );
    }
    /**
     * 最近购买所有时间戳的和
     *
     * @var
     */
    const DBKey_codeA = "codeA";

	/**
	 * 获取 最近购买所有时间戳的和
	 * @return int
	 */
	public function get_codeA()
	{
		return $this->getdata ( self::DBKey_codeA );
	}

	/**
	 * 设置 最近购买所有时间戳的和
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_codeA($value)
	{
		$this->setdata ( self::DBKey_codeA, intval($value) );
		return $this;
	}

	/**
     * 重置 最近购买所有时间戳的和
     * 设置为 0
     * @return $this
     */
    public function reset_codeA()
    {
        return $this->reset_defaultValue(self::DBKey_codeA);
    }

    /**
     * 设置 最近购买所有时间戳的和 默认值
     */
    protected function _set_defaultvalue_codeA()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_codeA, 0 );
    }
    /**
     * 重庆时时彩开奖号码
     *
     * @var
     */
    const DBKey_codeB = "codeB";

	/**
	 * 获取 重庆时时彩开奖号码
	 * @return int
	 */
	public function get_codeB()
	{
		return $this->getdata ( self::DBKey_codeB );
	}

	/**
	 * 设置 重庆时时彩开奖号码
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_codeB($value)
	{
		$this->setdata ( self::DBKey_codeB, intval($value) );
		return $this;
	}

	/**
     * 重置 重庆时时彩开奖号码
     * 设置为 0
     * @return $this
     */
    public function reset_codeB()
    {
        return $this->reset_defaultValue(self::DBKey_codeB);
    }

    /**
     * 设置 重庆时时彩开奖号码 默认值
     */
    protected function _set_defaultvalue_codeB()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_codeB, 0 );
    }
    /**
     * 中奖ID
     *
     * @var
     */
    const DBKey_luckNum = "luckNum";

	/**
	 * 获取 中奖ID
	 * @return int
	 */
	public function get_luckNum()
	{
		return $this->getdata ( self::DBKey_luckNum );
	}

	/**
	 * 设置 中奖ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_luckNum($value)
	{
		$this->setdata ( self::DBKey_luckNum, intval($value) );
		return $this;
	}

	/**
     * 重置 中奖ID
     * 设置为 0
     * @return $this
     */
    public function reset_luckNum()
    {
        return $this->reset_defaultValue(self::DBKey_luckNum);
    }

    /**
     * 设置 中奖ID 默认值
     */
    protected function _set_defaultvalue_luckNum()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_luckNum, 0 );
    }
    /**
     * 中奖者用户ID
     *
     * @var
     */
    const DBKey_luckUserId = "luckUserId";

	/**
	 * 获取 中奖者用户ID
	 * @return array
	 */
	public function get_luckUserId()
	{
		return $this->getdata ( self::DBKey_luckUserId );
	}

	/**
	 * 设置 中奖者用户ID
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_luckUserId($value)
	{
		$this->setdata ( self::DBKey_luckUserId, $value );
		return $this;
	}

	/**
     * 重置 中奖者用户ID
     * 设置为 []
     * @return $this
     */
    public function reset_luckUserId()
    {
        return $this->reset_defaultValue(self::DBKey_luckUserId);
    }

    /**
     * 设置 中奖者用户ID 默认值
     */
    protected function _set_defaultvalue_luckUserId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_luckUserId, [] );
    }
    /**
     * 中奖用户信息
     *
     * @var
     */
    const DBKey_luckUserInfo = "luckUserInfo";

	/**
	 * 获取 中奖用户信息
	 * @return array
	 */
	public function get_luckUserInfo()
	{
		return $this->getdata ( self::DBKey_luckUserInfo );
	}

	/**
	 * 设置 中奖用户信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_luckUserInfo($value)
	{
		$this->setdata ( self::DBKey_luckUserInfo, $value );
		return $this;
	}

	/**
     * 重置 中奖用户信息
     * 设置为 []
     * @return $this
     */
    public function reset_luckUserInfo()
    {
        return $this->reset_defaultValue(self::DBKey_luckUserInfo);
    }

    /**
     * 设置 中奖用户信息 默认值
     */
    protected function _set_defaultvalue_luckUserInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_luckUserInfo, [] );
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
        //设置 重庆时时彩开奖ID 默认值
        $this->_set_defaultvalue_cqsscId();
        //设置 购买完成时间 默认值
        $this->_set_defaultvalue_finishTime();
        //设置 抽奖时间 默认值
        $this->_set_defaultvalue_rollTime();
        //设置 最后50个购买者信息 默认值
        $this->_set_defaultvalue_recentBuy();
        //设置 最近购买所有时间戳的和 默认值
        $this->_set_defaultvalue_codeA();
        //设置 重庆时时彩开奖号码 默认值
        $this->_set_defaultvalue_codeB();
        //设置 中奖ID 默认值
        $this->_set_defaultvalue_luckNum();
        //设置 中奖者用户ID 默认值
        $this->_set_defaultvalue_luckUserId();
        //设置 中奖用户信息 默认值
        $this->_set_defaultvalue_luckUserInfo();

    }
}