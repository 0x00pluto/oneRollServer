<?php

namespace dbs\templates\recharge;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_recharge_data
 * @package dbs\templates\recharge
 */
class dbs_templates_recharge_data extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "recharge.data" );
    }
    /**
     * 订单唯一ID
     *
     * @var
     */
    const DBKey_orderid = "orderid";

	/**
	 * 获取 订单唯一ID
	 * @return string
	 */
	public function get_orderid()
	{
		return $this->getdata ( self::DBKey_orderid );
	}

	/**
	 * 设置 订单唯一ID
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
     * 重置 订单唯一ID
     * 设置为 ""
     * @return $this
     */
    public function reset_orderid()
    {
        return $this->reset_defaultValue(self::DBKey_orderid);
    }

    /**
     * 设置 订单唯一ID 默认值
     */
    protected function _set_defaultvalue_orderid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_orderid, "" );
    }
    /**
     * 货物id
     *
     * @var
     */
    const DBKey_goodsid = "goodsid";

	/**
	 * 获取 货物id
	 * @return string
	 */
	public function get_goodsid()
	{
		return $this->getdata ( self::DBKey_goodsid );
	}

	/**
	 * 设置 货物id
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
     * 重置 货物id
     * 设置为 ""
     * @return $this
     */
    public function reset_goodsid()
    {
        return $this->reset_defaultValue(self::DBKey_goodsid);
    }

    /**
     * 设置 货物id 默认值
     */
    protected function _set_defaultvalue_goodsid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsid, "" );
    }
    /**
     * 是否完成校验
     *
     * @var
     */
    const DBKey_iscomplete = "iscomplete";

	/**
	 * 获取 是否完成校验
	 * @return bool
	 */
	public function get_iscomplete()
	{
		return $this->getdata ( self::DBKey_iscomplete );
	}

	/**
	 * 设置 是否完成校验
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_iscomplete($value)
	{
		$this->setdata ( self::DBKey_iscomplete, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否完成校验
     * 设置为 false
     * @return $this
     */
    public function reset_iscomplete()
    {
        return $this->reset_defaultValue(self::DBKey_iscomplete);
    }

    /**
     * 设置 是否完成校验 默认值
     */
    protected function _set_defaultvalue_iscomplete()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_iscomplete, false );
    }
    /**
     * 创建日期
     *
     * @var
     */
    const DBKey_createtime = "createtime";

	/**
	 * 获取 创建日期
	 * @return int
	 */
	public function get_createtime()
	{
		return $this->getdata ( self::DBKey_createtime );
	}

	/**
	 * 设置 创建日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_createtime($value)
	{
		$this->setdata ( self::DBKey_createtime, intval($value) );
		return $this;
	}

	/**
     * 重置 创建日期
     * 设置为 0
     * @return $this
     */
    public function reset_createtime()
    {
        return $this->reset_defaultValue(self::DBKey_createtime);
    }

    /**
     * 设置 创建日期 默认值
     */
    protected function _set_defaultvalue_createtime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_createtime, 0 );
    }
    /**
     * 是否充值成功
     *
     * @var
     */
    const DBKey_succ = "succ";

	/**
	 * 获取 是否充值成功
	 * @return bool
	 */
	public function get_succ()
	{
		return $this->getdata ( self::DBKey_succ );
	}

	/**
	 * 设置 是否充值成功
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_succ($value)
	{
		$this->setdata ( self::DBKey_succ, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否充值成功
     * 设置为 false
     * @return $this
     */
    public function reset_succ()
    {
        return $this->reset_defaultValue(self::DBKey_succ);
    }

    /**
     * 设置 是否充值成功 默认值
     */
    protected function _set_defaultvalue_succ()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_succ, false );
    }
    /**
     * 最终增加的钻石数量
     *
     * @var
     */
    const DBKey_awarddiamonds = "awarddiamonds";

	/**
	 * 获取 最终增加的钻石数量
	 * @return int
	 */
	public function get_awarddiamonds()
	{
		return $this->getdata ( self::DBKey_awarddiamonds );
	}

	/**
	 * 设置 最终增加的钻石数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_awarddiamonds($value)
	{
		$this->setdata ( self::DBKey_awarddiamonds, intval($value) );
		return $this;
	}

	/**
     * 重置 最终增加的钻石数量
     * 设置为 0
     * @return $this
     */
    public function reset_awarddiamonds()
    {
        return $this->reset_defaultValue(self::DBKey_awarddiamonds);
    }

    /**
     * 设置 最终增加的钻石数量 默认值
     */
    protected function _set_defaultvalue_awarddiamonds()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_awarddiamonds, 0 );
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
        //设置 订单唯一ID 默认值
        $this->_set_defaultvalue_orderid();
        //设置 货物id 默认值
        $this->_set_defaultvalue_goodsid();
        //设置 是否完成校验 默认值
        $this->_set_defaultvalue_iscomplete();
        //设置 创建日期 默认值
        $this->_set_defaultvalue_createtime();
        //设置 是否充值成功 默认值
        $this->_set_defaultvalue_succ();
        //设置 最终增加的钻石数量 默认值
        $this->_set_defaultvalue_awarddiamonds();

    }
}