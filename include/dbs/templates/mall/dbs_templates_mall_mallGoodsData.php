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
     * 下架时间
     *
     * @var
     */
    const DBKey_offlineTime = "offlineTime";

	/**
	 * 获取 下架时间
	 * @return int
	 */
	public function get_offlineTime()
	{
		return $this->getdata ( self::DBKey_offlineTime );
	}

	/**
	 * 设置 下架时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_offlineTime($value)
	{
		$this->setdata ( self::DBKey_offlineTime, intval($value) );
		return $this;
	}

	/**
     * 重置 下架时间
     * 设置为 0
     * @return $this
     */
    public function reset_offlineTime()
    {
        return $this->reset_defaultValue(self::DBKey_offlineTime);
    }

    /**
     * 设置 下架时间 默认值
     */
    protected function _set_defaultvalue_offlineTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_offlineTime, 0 );
    }
    /**
     * 开始竞拍时间
     *
     * @var
     */
    const DBKey_startTime = "startTime";

	/**
	 * 获取 开始竞拍时间
	 * @return int
	 */
	public function get_startTime()
	{
		return $this->getdata ( self::DBKey_startTime );
	}

	/**
	 * 设置 开始竞拍时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_startTime($value)
	{
		$this->setdata ( self::DBKey_startTime, intval($value) );
		return $this;
	}

	/**
     * 重置 开始竞拍时间
     * 设置为 0
     * @return $this
     */
    public function reset_startTime()
    {
        return $this->reset_defaultValue(self::DBKey_startTime);
    }

    /**
     * 设置 开始竞拍时间 默认值
     */
    protected function _set_defaultvalue_startTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_startTime, 0 );
    }
    /**
     * 结束竞拍时间
     *
     * @var
     */
    const DBKey_endTime = "endTime";

	/**
	 * 获取 结束竞拍时间
	 * @return int
	 */
	public function get_endTime()
	{
		return $this->getdata ( self::DBKey_endTime );
	}

	/**
	 * 设置 结束竞拍时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_endTime($value)
	{
		$this->setdata ( self::DBKey_endTime, intval($value) );
		return $this;
	}

	/**
     * 重置 结束竞拍时间
     * 设置为 0
     * @return $this
     */
    public function reset_endTime()
    {
        return $this->reset_defaultValue(self::DBKey_endTime);
    }

    /**
     * 设置 结束竞拍时间 默认值
     */
    protected function _set_defaultvalue_endTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_endTime, 0 );
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
     * 商品售出数量
     *
     * @var
     */
    const DBKey_selloutCount = "selloutCount";

	/**
	 * 获取 商品售出数量
	 * @return int
	 */
	public function get_selloutCount()
	{
		return $this->getdata ( self::DBKey_selloutCount );
	}

	/**
	 * 设置 商品售出数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_selloutCount($value)
	{
		$this->setdata ( self::DBKey_selloutCount, intval($value) );
		return $this;
	}

	/**
     * 重置 商品售出数量
     * 设置为 0
     * @return $this
     */
    public function reset_selloutCount()
    {
        return $this->reset_defaultValue(self::DBKey_selloutCount);
    }

    /**
     * 设置 商品售出数量 默认值
     */
    protected function _set_defaultvalue_selloutCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_selloutCount, 0 );
    }
    /**
     * 商品总数
     *
     * @var
     */
    const DBKey_count = "count";

	/**
	 * 获取 商品总数
	 * @return int
	 */
	public function get_count()
	{
		return $this->getdata ( self::DBKey_count );
	}

	/**
	 * 设置 商品总数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_count($value)
	{
		$this->setdata ( self::DBKey_count, intval($value) );
		return $this;
	}

	/**
     * 重置 商品总数
     * 设置为 0
     * @return $this
     */
    public function reset_count()
    {
        return $this->reset_defaultValue(self::DBKey_count);
    }

    /**
     * 设置 商品总数 默认值
     */
    protected function _set_defaultvalue_count()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_count, 0 );
    }
    /**
     * 单价
     *
     * @var
     */
    const DBKey_price = "price";

	/**
	 * 获取 单价
	 * @return int
	 */
	public function get_price()
	{
		return $this->getdata ( self::DBKey_price );
	}

	/**
	 * 设置 单价
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_price($value)
	{
		$this->setdata ( self::DBKey_price, intval($value) );
		return $this;
	}

	/**
     * 重置 单价
     * 设置为 0
     * @return $this
     */
    public function reset_price()
    {
        return $this->reset_defaultValue(self::DBKey_price);
    }

    /**
     * 设置 单价 默认值
     */
    protected function _set_defaultvalue_price()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_price, 0 );
    }
    /**
     * 商品信息
     *
     * @var
     */
    const DBKey_goodsInfo = "goodsInfo";

	/**
	 * 获取 商品信息
	 * @return array
	 */
	public function get_goodsInfo()
	{
		return $this->getdata ( self::DBKey_goodsInfo );
	}

	/**
	 * 设置 商品信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_goodsInfo($value)
	{
		$this->setdata ( self::DBKey_goodsInfo, $value );
		return $this;
	}

	/**
     * 重置 商品信息
     * 设置为 []
     * @return $this
     */
    public function reset_goodsInfo()
    {
        return $this->reset_defaultValue(self::DBKey_goodsInfo);
    }

    /**
     * 设置 商品信息 默认值
     */
    protected function _set_defaultvalue_goodsInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsInfo, [] );
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
        //设置 商品是否有效 默认值
        $this->_set_defaultvalue_valid();
        //设置 上架时间 默认值
        $this->_set_defaultvalue_onlineTime();
        //设置 下架时间 默认值
        $this->_set_defaultvalue_offlineTime();
        //设置 开始竞拍时间 默认值
        $this->_set_defaultvalue_startTime();
        //设置 结束竞拍时间 默认值
        $this->_set_defaultvalue_endTime();
        //设置 抽奖时间 默认值
        $this->_set_defaultvalue_rollTime();
        //设置 商品售出数量 默认值
        $this->_set_defaultvalue_selloutCount();
        //设置 商品总数 默认值
        $this->_set_defaultvalue_count();
        //设置 单价 默认值
        $this->_set_defaultvalue_price();
        //设置 商品信息 默认值
        $this->_set_defaultvalue_goodsInfo();
        //设置 商品信息 默认值
        $this->_set_defaultvalue_goodsSellInfo();

    }
}