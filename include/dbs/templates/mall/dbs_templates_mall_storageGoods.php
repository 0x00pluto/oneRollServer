<?php

namespace dbs\templates\mall;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_storageGoods
 * @package dbs\templates\mall
 */
abstract class dbs_templates_mall_storageGoods extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "mall_storageGoods";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.storageGoods" );
    }
    /**
     * 货物ID
     *
     * @var
     */
    const DBKey_goodsId = "goodsId";

	/**
	 * 获取 货物ID
	 * @return string
	 */
	public function get_goodsId()
	{
		return $this->getdata ( self::DBKey_goodsId );
	}

	/**
	 * 设置 货物ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_goodsId($value)
	{
		$this->setdata ( self::DBKey_goodsId, strval($value) );
		return $this;
	}

	/**
     * 重置 货物ID
     * 设置为 ""
     * @return $this
     */
    public function reset_goodsId()
    {
        return $this->reset_defaultValue(self::DBKey_goodsId);
    }

    /**
     * 设置 货物ID 默认值
     */
    protected function _set_defaultvalue_goodsId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsId, "" );
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
     * 商品是否有效
     *
     * @var
     */
    const DBKey_valid = "valid";

	/**
	 * 获取 商品是否有效
	 * @return bool
	 */
	public function get_valid()
	{
		return $this->getdata ( self::DBKey_valid );
	}

	/**
	 * 设置 商品是否有效
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_valid($value)
	{
		$this->setdata ( self::DBKey_valid, boolval($value) );
		return $this;
	}

	/**
     * 重置 商品是否有效
     * 设置为 false
     * @return $this
     */
    public function reset_valid()
    {
        return $this->reset_defaultValue(self::DBKey_valid);
    }

    /**
     * 设置 商品是否有效 默认值
     */
    protected function _set_defaultvalue_valid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_valid, false );
    }
    /**
     * 上架时间
     *
     * @var
     */
    const DBKey_onlineTime = "onlineTime";

	/**
	 * 获取 上架时间
	 * @return int
	 */
	public function get_onlineTime()
	{
		return $this->getdata ( self::DBKey_onlineTime );
	}

	/**
	 * 设置 上架时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_onlineTime($value)
	{
		$this->setdata ( self::DBKey_onlineTime, intval($value) );
		return $this;
	}

	/**
     * 重置 上架时间
     * 设置为 0
     * @return $this
     */
    public function reset_onlineTime()
    {
        return $this->reset_defaultValue(self::DBKey_onlineTime);
    }

    /**
     * 设置 上架时间 默认值
     */
    protected function _set_defaultvalue_onlineTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_onlineTime, 0 );
    }
    /**
     * 商品是否已经上架
     *
     * @var
     */
    const DBKey_isonline = "isonline";

	/**
	 * 获取 商品是否已经上架
	 * @return bool
	 */
	public function get_isonline()
	{
		return $this->getdata ( self::DBKey_isonline );
	}

	/**
	 * 设置 商品是否已经上架
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isonline($value)
	{
		$this->setdata ( self::DBKey_isonline, boolval($value) );
		return $this;
	}

	/**
     * 重置 商品是否已经上架
     * 设置为 false
     * @return $this
     */
    public function reset_isonline()
    {
        return $this->reset_defaultValue(self::DBKey_isonline);
    }

    /**
     * 设置 商品是否已经上架 默认值
     */
    protected function _set_defaultvalue_isonline()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isonline, false );
    }
    /**
     * 商品总数
     *
     * @var
     */
    const DBKey_quantity = "quantity";

	/**
	 * 获取 商品总数
	 * @return int
	 */
	public function get_quantity()
	{
		return $this->getdata ( self::DBKey_quantity );
	}

	/**
	 * 设置 商品总数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_quantity($value)
	{
		$this->setdata ( self::DBKey_quantity, intval($value) );
		return $this;
	}

	/**
     * 重置 商品总数
     * 设置为 0
     * @return $this
     */
    public function reset_quantity()
    {
        return $this->reset_defaultValue(self::DBKey_quantity);
    }

    /**
     * 设置 商品总数 默认值
     */
    protected function _set_defaultvalue_quantity()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_quantity, 0 );
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
     * 最后一次上线的商品ID
     *
     * @var
     */
    const DBKey_lastProductGoodsId = "lastProductGoodsId";

	/**
	 * 获取 最后一次上线的商品ID
	 * @return string
	 */
	public function get_lastProductGoodsId()
	{
		return $this->getdata ( self::DBKey_lastProductGoodsId );
	}

	/**
	 * 设置 最后一次上线的商品ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_lastProductGoodsId($value)
	{
		$this->setdata ( self::DBKey_lastProductGoodsId, strval($value) );
		return $this;
	}

	/**
     * 重置 最后一次上线的商品ID
     * 设置为 ""
     * @return $this
     */
    public function reset_lastProductGoodsId()
    {
        return $this->reset_defaultValue(self::DBKey_lastProductGoodsId);
    }

    /**
     * 设置 最后一次上线的商品ID 默认值
     */
    protected function _set_defaultvalue_lastProductGoodsId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastProductGoodsId, "" );
    }
    /**
     * 开奖期数
     *
     * @var
     */
    const DBKey_productGoodsPeriod = "productGoodsPeriod";

	/**
	 * 获取 开奖期数
	 * @return int
	 */
	public function get_productGoodsPeriod()
	{
		return $this->getdata ( self::DBKey_productGoodsPeriod );
	}

	/**
	 * 设置 开奖期数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_productGoodsPeriod($value)
	{
		$this->setdata ( self::DBKey_productGoodsPeriod, intval($value) );
		return $this;
	}

	/**
     * 重置 开奖期数
     * 设置为 0
     * @return $this
     */
    public function reset_productGoodsPeriod()
    {
        return $this->reset_defaultValue(self::DBKey_productGoodsPeriod);
    }

    /**
     * 设置 开奖期数 默认值
     */
    protected function _set_defaultvalue_productGoodsPeriod()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_productGoodsPeriod, 0 );
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
        //设置 货物ID 默认值
        $this->_set_defaultvalue_goodsId();
        //设置 商品名称 默认值
        $this->_set_defaultvalue_goodsName();
        //设置 商品是否有效 默认值
        $this->_set_defaultvalue_valid();
        //设置 上架时间 默认值
        $this->_set_defaultvalue_onlineTime();
        //设置 商品是否已经上架 默认值
        $this->_set_defaultvalue_isonline();
        //设置 商品总数 默认值
        $this->_set_defaultvalue_quantity();
        //设置 抽奖总次数 默认值
        $this->_set_defaultvalue_rollCount();
        //设置 单次抽奖价格 默认值
        $this->_set_defaultvalue_eachRollPrice();
        //设置 商品基本信息 默认值
        $this->_set_defaultvalue_goodsNormalInfo();
        //设置 最后一次上线的商品ID 默认值
        $this->_set_defaultvalue_lastProductGoodsId();
        //设置 开奖期数 默认值
        $this->_set_defaultvalue_productGoodsPeriod();

    }
}