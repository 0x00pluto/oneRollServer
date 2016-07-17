<?php

namespace dbs\templates\shop;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_shop_playerMallData
 * @package dbs\templates\shop
 */
class dbs_templates_shop_playerMallData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "shop.playerMallData" );
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
     * 购买数量
     *
     * @var
     */
    const DBKey_buyCount = "buyCount";

	/**
	 * 获取 购买数量
	 * @return int
	 */
	public function get_buyCount()
	{
		return $this->getdata ( self::DBKey_buyCount );
	}

	/**
	 * 设置 购买数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_buyCount($value)
	{
		$this->setdata ( self::DBKey_buyCount, intval($value) );
		return $this;
	}

	/**
     * 重置 购买数量
     * 设置为 0
     * @return $this
     */
    public function reset_buyCount()
    {
        return $this->reset_defaultValue(self::DBKey_buyCount);
    }

    /**
     * 设置 购买数量 默认值
     */
    protected function _set_defaultvalue_buyCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_buyCount, 0 );
    }
    /**
     * 每日购买数量
     *
     * @var
     */
    const DBKey_dailyBuyCount = "dailyBuyCount";

	/**
	 * 获取 每日购买数量
	 * @return int
	 */
	public function get_dailyBuyCount()
	{
		return $this->getdata ( self::DBKey_dailyBuyCount );
	}

	/**
	 * 设置 每日购买数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_dailyBuyCount($value)
	{
		$this->setdata ( self::DBKey_dailyBuyCount, intval($value) );
		return $this;
	}

	/**
     * 重置 每日购买数量
     * 设置为 0
     * @return $this
     */
    public function reset_dailyBuyCount()
    {
        return $this->reset_defaultValue(self::DBKey_dailyBuyCount);
    }

    /**
     * 设置 每日购买数量 默认值
     */
    protected function _set_defaultvalue_dailyBuyCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_dailyBuyCount, 0 );
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
        //设置 购买数量 默认值
        $this->_set_defaultvalue_buyCount();
        //设置 每日购买数量 默认值
        $this->_set_defaultvalue_dailyBuyCount();

    }
}