<?php

namespace dbs\templates\mall;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_mallGoodsData
 * @package dbs\templates\mall
 */
class dbs_templates_mall_mallGoodsData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.mallGoodsData" );
    }
    /**
     * 商品ID
     *
     * @var
     */
    const DBKey_id = "id";

	/**
	 * 获取 商品ID
	 * @return string
	 */
	public function get_id()
	{
		return $this->getdata ( self::DBKey_id );
	}

	/**
	 * 设置 商品ID
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
     * 重置 商品ID
     * 设置为 ""
     * @return $this
     */
    public function reset_id()
    {
        return $this->reset_defaultValue(self::DBKey_id);
    }

    /**
     * 设置 商品ID 默认值
     */
    protected function _set_defaultvalue_id()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_id, "" );
    }
    /**
     * 开奖期数
     *
     * @var
     */
    const DBKey_goodsPeriod = "goodsPeriod";

	/**
	 * 获取 开奖期数
	 * @return int
	 */
	public function get_goodsPeriod()
	{
		return $this->getdata ( self::DBKey_goodsPeriod );
	}

	/**
	 * 设置 开奖期数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_goodsPeriod($value)
	{
		$this->setdata ( self::DBKey_goodsPeriod, intval($value) );
		return $this;
	}

	/**
     * 重置 开奖期数
     * 设置为 0
     * @return $this
     */
    public function reset_goodsPeriod()
    {
        return $this->reset_defaultValue(self::DBKey_goodsPeriod);
    }

    /**
     * 设置 开奖期数 默认值
     */
    protected function _set_defaultvalue_goodsPeriod()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsPeriod, 0 );
    }
    /**
     * 商品名称
     *
     * @var
     */
    const DBKey_goodsName = "goodsName";

	/**
	 * 获取 商品名称
	 * @return string
	 */
	public function get_goodsName()
	{
		return $this->getdata ( self::DBKey_goodsName );
	}

	/**
	 * 设置 商品名称
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_goodsName($value)
	{
		$this->setdata ( self::DBKey_goodsName, strval($value) );
		return $this;
	}

	/**
     * 重置 商品名称
     * 设置为 ""
     * @return $this
     */
    public function reset_goodsName()
    {
        return $this->reset_defaultValue(self::DBKey_goodsName);
    }

    /**
     * 设置 商品名称 默认值
     */
    protected function _set_defaultvalue_goodsName()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsName, "" );
    }
    /**
     * 库存中的货物ID
     *
     * @var
     */
    const DBKey_storageGoodsId = "storageGoodsId";

	/**
	 * 获取 库存中的货物ID
	 * @return string
	 */
	public function get_storageGoodsId()
	{
		return $this->getdata ( self::DBKey_storageGoodsId );
	}

	/**
	 * 设置 库存中的货物ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_storageGoodsId($value)
	{
		$this->setdata ( self::DBKey_storageGoodsId, strval($value) );
		return $this;
	}

	/**
     * 重置 库存中的货物ID
     * 设置为 ""
     * @return $this
     */
    public function reset_storageGoodsId()
    {
        return $this->reset_defaultValue(self::DBKey_storageGoodsId);
    }

    /**
     * 设置 库存中的货物ID 默认值
     */
    protected function _set_defaultvalue_storageGoodsId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_storageGoodsId, "" );
    }
    /**
     * 商品状态
     *
     * @var
     */
    const DBKey_status = "status";

	/**
	 * 获取 商品状态
	 * @return int
	 */
	public function get_status()
	{
		return $this->getdata ( self::DBKey_status );
	}

	/**
	 * 设置 商品状态
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_status($value)
	{
		$this->setdata ( self::DBKey_status, intval($value) );
		return $this;
	}

	/**
     * 重置 商品状态
     * 设置为 0
     * @return $this
     */
    public function reset_status()
    {
        return $this->reset_defaultValue(self::DBKey_status);
    }

    /**
     * 设置 商品状态 默认值
     */
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_status, 0 );
    }
    /**
     * 已经销售出去的抽奖次数
     *
     * @var
     */
    const DBKey_selloutrollCount = "selloutrollCount";

	/**
	 * 获取 已经销售出去的抽奖次数
	 * @return int
	 */
	public function get_selloutrollCount()
	{
		return $this->getdata ( self::DBKey_selloutrollCount );
	}

	/**
	 * 设置 已经销售出去的抽奖次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_selloutrollCount($value)
	{
		$this->setdata ( self::DBKey_selloutrollCount, intval($value) );
		return $this;
	}

	/**
     * 重置 已经销售出去的抽奖次数
     * 设置为 0
     * @return $this
     */
    public function reset_selloutrollCount()
    {
        return $this->reset_defaultValue(self::DBKey_selloutrollCount);
    }

    /**
     * 设置 已经销售出去的抽奖次数 默认值
     */
    protected function _set_defaultvalue_selloutrollCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_selloutrollCount, 0 );
    }
    /**
     * 抽奖总次数
     *
     * @var
     */
    const DBKey_rollCount = "rollCount";

	/**
	 * 获取 抽奖总次数
	 * @return int
	 */
	public function get_rollCount()
	{
		return $this->getdata ( self::DBKey_rollCount );
	}

	/**
	 * 设置 抽奖总次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_rollCount($value)
	{
		$this->setdata ( self::DBKey_rollCount, intval($value) );
		return $this;
	}

	/**
     * 重置 抽奖总次数
     * 设置为 0
     * @return $this
     */
    public function reset_rollCount()
    {
        return $this->reset_defaultValue(self::DBKey_rollCount);
    }

    /**
     * 设置 抽奖总次数 默认值
     */
    protected function _set_defaultvalue_rollCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rollCount, 0 );
    }
    /**
     * 单次抽奖价格
     *
     * @var
     */
    const DBKey_eachRollPrice = "eachRollPrice";

	/**
	 * 获取 单次抽奖价格
	 * @return int
	 */
	public function get_eachRollPrice()
	{
		return $this->getdata ( self::DBKey_eachRollPrice );
	}

	/**
	 * 设置 单次抽奖价格
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_eachRollPrice($value)
	{
		$this->setdata ( self::DBKey_eachRollPrice, intval($value) );
		return $this;
	}

	/**
     * 重置 单次抽奖价格
     * 设置为 0
     * @return $this
     */
    public function reset_eachRollPrice()
    {
        return $this->reset_defaultValue(self::DBKey_eachRollPrice);
    }

    /**
     * 设置 单次抽奖价格 默认值
     */
    protected function _set_defaultvalue_eachRollPrice()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_eachRollPrice, 0 );
    }
    /**
     * 商品基本信息
     *
     * @var
     */
    const DBKey_goodsNormalInfo = "goodsNormalInfo";

	/**
	 * 获取 商品基本信息
	 * @return array
	 */
	public function get_goodsNormalInfo()
	{
		return $this->getdata ( self::DBKey_goodsNormalInfo );
	}

	/**
	 * 设置 商品基本信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_goodsNormalInfo($value)
	{
		$this->setdata ( self::DBKey_goodsNormalInfo, $value );
		return $this;
	}

	/**
     * 重置 商品基本信息
     * 设置为 []
     * @return $this
     */
    public function reset_goodsNormalInfo()
    {
        return $this->reset_defaultValue(self::DBKey_goodsNormalInfo);
    }

    /**
     * 设置 商品基本信息 默认值
     */
    protected function _set_defaultvalue_goodsNormalInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsNormalInfo, [] );
    }
    /**
     * 商品信息
     *
     * @var
     */
    const DBKey_goodsSellInfo = "goodsSellInfo";

	/**
	 * 获取 商品信息
	 * @return array
	 */
	public function get_goodsSellInfo()
	{
		return $this->getdata ( self::DBKey_goodsSellInfo );
	}

	/**
	 * 设置 商品信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_goodsSellInfo($value)
	{
		$this->setdata ( self::DBKey_goodsSellInfo, $value );
		return $this;
	}

	/**
     * 重置 商品信息
     * 设置为 []
     * @return $this
     */
    public function reset_goodsSellInfo()
    {
        return $this->reset_defaultValue(self::DBKey_goodsSellInfo);
    }

    /**
     * 设置 商品信息 默认值
     */
    protected function _set_defaultvalue_goodsSellInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsSellInfo, [] );
    }
    /**
     * 商品抽奖信息
     *
     * @var
     */
    const DBKey_goodsRollResult = "goodsRollResult";

	/**
	 * 获取 商品抽奖信息
	 * @return array
	 */
	public function get_goodsRollResult()
	{
		return $this->getdata ( self::DBKey_goodsRollResult );
	}

	/**
	 * 设置 商品抽奖信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_goodsRollResult($value)
	{
		$this->setdata ( self::DBKey_goodsRollResult, $value );
		return $this;
	}

	/**
     * 重置 商品抽奖信息
     * 设置为 []
     * @return $this
     */
    public function reset_goodsRollResult()
    {
        return $this->reset_defaultValue(self::DBKey_goodsRollResult);
    }

    /**
     * 设置 商品抽奖信息 默认值
     */
    protected function _set_defaultvalue_goodsRollResult()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsRollResult, [] );
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
        //设置 商品ID 默认值
        $this->_set_defaultvalue_id();
        //设置 开奖期数 默认值
        $this->_set_defaultvalue_goodsPeriod();
        //设置 商品名称 默认值
        $this->_set_defaultvalue_goodsName();
        //设置 库存中的货物ID 默认值
        $this->_set_defaultvalue_storageGoodsId();
        //设置 商品状态 默认值
        $this->_set_defaultvalue_status();
        //设置 已经销售出去的抽奖次数 默认值
        $this->_set_defaultvalue_selloutrollCount();
        //设置 抽奖总次数 默认值
        $this->_set_defaultvalue_rollCount();
        //设置 单次抽奖价格 默认值
        $this->_set_defaultvalue_eachRollPrice();
        //设置 商品基本信息 默认值
        $this->_set_defaultvalue_goodsNormalInfo();
        //设置 商品信息 默认值
        $this->_set_defaultvalue_goodsSellInfo();
        //设置 商品抽奖信息 默认值
        $this->_set_defaultvalue_goodsRollResult();

    }
}