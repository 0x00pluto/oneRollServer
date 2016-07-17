<?php

namespace apps\payverify\dbs\templates\notice;

use apps\payverify\dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_notice_receiptData
 * @package apps\payverify\dbs\templates\notice
 */
abstract class dbs_templates_notice_receiptData extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "rechargedata";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "notice.receiptData" );
    }
    /**
     * 应用id
     *
     * @var
     */
    const DBKey_appid = "appid";

	/**
	 * 获取 应用id
	 * @return string
	 */
	public function get_appid()
	{
		return $this->getdata ( self::DBKey_appid );
	}

	/**
	 * 设置 应用id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_appid($value)
	{
		$this->setdata ( self::DBKey_appid, strval($value) );
		return $this;
	}

	/**
     * 重置 应用id
     * 设置为 ""
     * @return $this
     */
    public function reset_appid()
    {
        return $this->reset_defaultValue(self::DBKey_appid);
    }

    /**
     * 设置 应用id 默认值
     */
    protected function _set_defaultvalue_appid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_appid, "" );
    }
    /**
     * 平台id
     *
     * @var
     */
    const DBKey_platformid = "platformid";

	/**
	 * 获取 平台id
	 * @return string
	 */
	public function get_platformid()
	{
		return $this->getdata ( self::DBKey_platformid );
	}

	/**
	 * 设置 平台id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_platformid($value)
	{
		$this->setdata ( self::DBKey_platformid, strval($value) );
		return $this;
	}

	/**
     * 重置 平台id
     * 设置为 ""
     * @return $this
     */
    public function reset_platformid()
    {
        return $this->reset_defaultValue(self::DBKey_platformid);
    }

    /**
     * 设置 平台id 默认值
     */
    protected function _set_defaultvalue_platformid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_platformid, "" );
    }
    /**
     * 订单编号
     *
     * @var
     */
    const DBKey_orderid = "orderid";

	/**
	 * 获取 订单编号
	 * @return string
	 */
	public function get_orderid()
	{
		return $this->getdata ( self::DBKey_orderid );
	}

	/**
	 * 设置 订单编号
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_orderid($value)
	{
		$this->setdata ( self::DBKey_orderid, strval($value) );
		return $this;
	}

	/**
     * 重置 订单编号
     * 设置为 ""
     * @return $this
     */
    public function reset_orderid()
    {
        return $this->reset_defaultValue(self::DBKey_orderid);
    }

    /**
     * 设置 订单编号 默认值
     */
    protected function _set_defaultvalue_orderid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_orderid, "" );
    }
    /**
     *  票据的唯一id,防止同一个票据重复验证
     *
     * @var
     */
    const DBKey_unique_identifier = "unique_identifier";

	/**
	 * 获取  票据的唯一id,防止同一个票据重复验证
	 * @return string
	 */
	public function get_unique_identifier()
	{
		return $this->getdata ( self::DBKey_unique_identifier );
	}

	/**
	 * 设置  票据的唯一id,防止同一个票据重复验证
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_unique_identifier($value)
	{
		$this->setdata ( self::DBKey_unique_identifier, strval($value) );
		return $this;
	}

	/**
     * 重置  票据的唯一id,防止同一个票据重复验证
     * 设置为 ""
     * @return $this
     */
    public function reset_unique_identifier()
    {
        return $this->reset_defaultValue(self::DBKey_unique_identifier);
    }

    /**
     * 设置  票据的唯一id,防止同一个票据重复验证 默认值
     */
    protected function _set_defaultvalue_unique_identifier()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_unique_identifier, "" );
    }
    /**
     * 金额单位分
     *
     * @var
     */
    const DBKey_money = "money";

	/**
	 * 获取 金额单位分
	 * @return int
	 */
	public function get_money()
	{
		return $this->getdata ( self::DBKey_money );
	}

	/**
	 * 设置 金额单位分
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_money($value)
	{
		$this->setdata ( self::DBKey_money, intval($value) );
		return $this;
	}

	/**
     * 重置 金额单位分
     * 设置为 0
     * @return $this
     */
    public function reset_money()
    {
        return $this->reset_defaultValue(self::DBKey_money);
    }

    /**
     * 设置 金额单位分 默认值
     */
    protected function _set_defaultvalue_money()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_money, 0 );
    }
    /**
     * 充值时间
     *
     * @var
     */
    const DBKey_rechargetime = "rechargetime";

	/**
	 * 获取 充值时间
	 * @return int
	 */
	public function get_rechargetime()
	{
		return $this->getdata ( self::DBKey_rechargetime );
	}

	/**
	 * 设置 充值时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_rechargetime($value)
	{
		$this->setdata ( self::DBKey_rechargetime, intval($value) );
		return $this;
	}

	/**
     * 重置 充值时间
     * 设置为 0
     * @return $this
     */
    public function reset_rechargetime()
    {
        return $this->reset_defaultValue(self::DBKey_rechargetime);
    }

    /**
     * 设置 充值时间 默认值
     */
    protected function _set_defaultvalue_rechargetime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rechargetime, 0 );
    }
    /**
     * 是否完成校验
     *
     * @var
     */
    const DBKey_iscompleteverify = "iscompleteverify";

	/**
	 * 获取 是否完成校验
	 * @return bool
	 */
	public function get_iscompleteverify()
	{
		return $this->getdata ( self::DBKey_iscompleteverify );
	}

	/**
	 * 设置 是否完成校验
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_iscompleteverify($value)
	{
		$this->setdata ( self::DBKey_iscompleteverify, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否完成校验
     * 设置为 false
     * @return $this
     */
    public function reset_iscompleteverify()
    {
        return $this->reset_defaultValue(self::DBKey_iscompleteverify);
    }

    /**
     * 设置 是否完成校验 默认值
     */
    protected function _set_defaultvalue_iscompleteverify()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_iscompleteverify, false );
    }
    /**
     * 完成校验时间
     *
     * @var
     */
    const DBKey_completetimestamp = "completetimestamp";

	/**
	 * 获取 完成校验时间
	 * @return int
	 */
	public function get_completetimestamp()
	{
		return $this->getdata ( self::DBKey_completetimestamp );
	}

	/**
	 * 设置 完成校验时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_completetimestamp($value)
	{
		$this->setdata ( self::DBKey_completetimestamp, intval($value) );
		return $this;
	}

	/**
     * 重置 完成校验时间
     * 设置为 0
     * @return $this
     */
    public function reset_completetimestamp()
    {
        return $this->reset_defaultValue(self::DBKey_completetimestamp);
    }

    /**
     * 设置 完成校验时间 默认值
     */
    protected function _set_defaultvalue_completetimestamp()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_completetimestamp, 0 );
    }
    /**
     * 商品id
     *
     * @var
     */
    const DBKey_goodsid = "goodsid";

	/**
	 * 获取 商品id
	 * @return string
	 */
	public function get_goodsid()
	{
		return $this->getdata ( self::DBKey_goodsid );
	}

	/**
	 * 设置 商品id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_goodsid($value)
	{
		$this->setdata ( self::DBKey_goodsid, strval($value) );
		return $this;
	}

	/**
     * 重置 商品id
     * 设置为 ""
     * @return $this
     */
    public function reset_goodsid()
    {
        return $this->reset_defaultValue(self::DBKey_goodsid);
    }

    /**
     * 设置 商品id 默认值
     */
    protected function _set_defaultvalue_goodsid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsid, "" );
    }
    /**
     * 商品数量
     *
     * @var
     */
    const DBKey_goodsnum = "goodsnum";

	/**
	 * 获取 商品数量
	 * @return int
	 */
	public function get_goodsnum()
	{
		return $this->getdata ( self::DBKey_goodsnum );
	}

	/**
	 * 设置 商品数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_goodsnum($value)
	{
		$this->setdata ( self::DBKey_goodsnum, intval($value) );
		return $this;
	}

	/**
     * 重置 商品数量
     * 设置为 0
     * @return $this
     */
    public function reset_goodsnum()
    {
        return $this->reset_defaultValue(self::DBKey_goodsnum);
    }

    /**
     * 设置 商品数量 默认值
     */
    protected function _set_defaultvalue_goodsnum()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsnum, 0 );
    }
    /**
     * 扩展信息
     *
     * @var
     */
    const DBKey_extinfo = "extinfo";

	/**
	 * 获取 扩展信息
	 * @return array
	 */
	public function get_extinfo()
	{
		return $this->getdata ( self::DBKey_extinfo );
	}

	/**
	 * 设置 扩展信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_extinfo($value)
	{
		$this->setdata ( self::DBKey_extinfo, $value );
		return $this;
	}

	/**
     * 重置 扩展信息
     * 设置为 []
     * @return $this
     */
    public function reset_extinfo()
    {
        return $this->reset_defaultValue(self::DBKey_extinfo);
    }

    /**
     * 设置 扩展信息 默认值
     */
    protected function _set_defaultvalue_extinfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_extinfo, [] );
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
        //设置 应用id 默认值
        $this->_set_defaultvalue_appid();
        //设置 平台id 默认值
        $this->_set_defaultvalue_platformid();
        //设置 订单编号 默认值
        $this->_set_defaultvalue_orderid();
        //设置  票据的唯一id,防止同一个票据重复验证 默认值
        $this->_set_defaultvalue_unique_identifier();
        //设置 金额单位分 默认值
        $this->_set_defaultvalue_money();
        //设置 充值时间 默认值
        $this->_set_defaultvalue_rechargetime();
        //设置 是否完成校验 默认值
        $this->_set_defaultvalue_iscompleteverify();
        //设置 完成校验时间 默认值
        $this->_set_defaultvalue_completetimestamp();
        //设置 商品id 默认值
        $this->_set_defaultvalue_goodsid();
        //设置 商品数量 默认值
        $this->_set_defaultvalue_goodsnum();
        //设置 扩展信息 默认值
        $this->_set_defaultvalue_extinfo();

    }
}