<?php

namespace dbs\templates\shop;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_shop_shopItemLimitData
 * @package dbs\templates\shop
 */
abstract class dbs_templates_shop_shopItemLimitData extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "shopItemLimitDatas";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "shop.shopItemLimitData" );
    }
    /**
     * 商品ID
     *
     * @var
     */
    const DBKey_mallid = "mallid";

	/**
	 * 获取 商品ID
	 * @return string
	 */
	public function get_mallid()
	{
		return $this->getdata ( self::DBKey_mallid );
	}

	/**
	 * 设置 商品ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_mallid($value)
	{
		$this->setdata ( self::DBKey_mallid, strval($value) );
		return $this;
	}

	/**
     * 重置 商品ID
     * 设置为 ""
     * @return $this
     */
    public function reset_mallid()
    {
        return $this->reset_defaultValue(self::DBKey_mallid);
    }

    /**
     * 设置 商品ID 默认值
     */
    protected function _set_defaultvalue_mallid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mallid, "" );
    }
    /**
     * 每日更新标志位
     *
     * @var
     */
    const DBKey_dayFlag = "dayFlag";

	/**
	 * 获取 每日更新标志位
	 * @return int
	 */
	public function get_dayFlag()
	{
		return $this->getdata ( self::DBKey_dayFlag );
	}

	/**
	 * 设置 每日更新标志位
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_dayFlag($value)
	{
		$this->setdata ( self::DBKey_dayFlag, intval($value) );
		return $this;
	}

	/**
     * 重置 每日更新标志位
     * 设置为 0
     * @return $this
     */
    public function reset_dayFlag()
    {
        return $this->reset_defaultValue(self::DBKey_dayFlag);
    }

    /**
     * 设置 每日更新标志位 默认值
     */
    protected function _set_defaultvalue_dayFlag()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_dayFlag, 0 );
    }
    /**
     * 全服一共出售数量
     *
     * @var
     */
    const DBKey_serverTotalSellCount = "serverTotalSellCount";

	/**
	 * 获取 全服一共出售数量
	 * @return int
	 */
	public function get_serverTotalSellCount()
	{
		return $this->getdata ( self::DBKey_serverTotalSellCount );
	}

	/**
	 * 设置 全服一共出售数量
	 *
	 * @param int $value
	 * @return $this
	 */
	protected function set_serverTotalSellCount($value)
	{
		$this->setdata ( self::DBKey_serverTotalSellCount, intval($value) );
		return $this;
	}

	/**
     * 重置 全服一共出售数量
     * 设置为 0
     * @return $this
     */
    public function reset_serverTotalSellCount()
    {
        return $this->reset_defaultValue(self::DBKey_serverTotalSellCount);
    }

    /**
     * 设置 全服一共出售数量 默认值
     */
    protected function _set_defaultvalue_serverTotalSellCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_serverTotalSellCount, 0 );
    }
    /**
     * 全服今天出售数量
     *
     * @var
     */
    const DBKey_serverDailySellCount = "serverDailySellCount";

	/**
	 * 获取 全服今天出售数量
	 * @return int
	 */
	public function get_serverDailySellCount()
	{
		return $this->getdata ( self::DBKey_serverDailySellCount );
	}

	/**
	 * 设置 全服今天出售数量
	 *
	 * @param int $value
	 * @return $this
	 */
	protected function set_serverDailySellCount($value)
	{
		$this->setdata ( self::DBKey_serverDailySellCount, intval($value) );
		return $this;
	}

	/**
     * 重置 全服今天出售数量
     * 设置为 0
     * @return $this
     */
    public function reset_serverDailySellCount()
    {
        return $this->reset_defaultValue(self::DBKey_serverDailySellCount);
    }

    /**
     * 设置 全服今天出售数量 默认值
     */
    protected function _set_defaultvalue_serverDailySellCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_serverDailySellCount, 0 );
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
        $this->_set_defaultvalue_mallid();
        //设置 每日更新标志位 默认值
        $this->_set_defaultvalue_dayFlag();
        //设置 全服一共出售数量 默认值
        $this->_set_defaultvalue_serverTotalSellCount();
        //设置 全服今天出售数量 默认值
        $this->_set_defaultvalue_serverDailySellCount();

    }
}