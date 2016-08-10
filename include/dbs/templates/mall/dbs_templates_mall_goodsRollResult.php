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
     * 重庆时时彩信息
     *
     * @var
     */
    const DBKey_cqsscData = "cqsscData";

	/**
	 * 获取 重庆时时彩信息
	 * @return array
	 */
	public function get_cqsscData()
	{
		return $this->getdata ( self::DBKey_cqsscData );
	}

	/**
	 * 设置 重庆时时彩信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_cqsscData($value)
	{
		$this->setdata ( self::DBKey_cqsscData, $value );
		return $this;
	}

	/**
     * 重置 重庆时时彩信息
     * 设置为 []
     * @return $this
     */
    public function reset_cqsscData()
    {
        return $this->reset_defaultValue(self::DBKey_cqsscData);
    }

    /**
     * 设置 重庆时时彩信息 默认值
     */
    protected function _set_defaultvalue_cqsscData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cqsscData, [] );
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
        //设置 抽奖时间 默认值
        $this->_set_defaultvalue_rollTime();
        //设置 最后50个购买者信息 默认值
        $this->_set_defaultvalue_recentBuy();
        //设置 重庆时时彩信息 默认值
        $this->_set_defaultvalue_cqsscData();
        //设置 中奖ID 默认值
        $this->_set_defaultvalue_luckNum();

    }
}