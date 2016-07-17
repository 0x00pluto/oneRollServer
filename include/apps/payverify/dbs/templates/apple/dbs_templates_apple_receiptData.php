<?php

namespace apps\payverify\dbs\templates\apple;

use apps\payverify\dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_apple_receiptData
 * @package apps\payverify\dbs\templates\apple
 */
abstract class dbs_templates_apple_receiptData extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "applereceiptdata";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "apple.receiptData" );
    }
    /**
     * 唯一id
     *
     * @var
     */
    const DBKey_uuid = "uuid";

	/**
	 * 获取 唯一id
	 * @return string
	 */
	public function get_uuid()
	{
		return $this->getdata ( self::DBKey_uuid );
	}

	/**
	 * 设置 唯一id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_uuid($value)
	{
		$this->setdata ( self::DBKey_uuid, strval($value) );
		return $this;
	}

	/**
     * 重置 唯一id
     * 设置为 ""
     * @return $this
     */
    public function reset_uuid()
    {
        return $this->reset_defaultValue(self::DBKey_uuid);
    }

    /**
     * 设置 唯一id 默认值
     */
    protected function _set_defaultvalue_uuid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_uuid, "" );
    }
    /**
     * 订单id
     *
     * @var
     */
    const DBKey_orderid = "orderid";

	/**
	 * 获取 订单id
	 * @return string
	 */
	public function get_orderid()
	{
		return $this->getdata ( self::DBKey_orderid );
	}

	/**
	 * 设置 订单id
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
     * 重置 订单id
     * 设置为 ""
     * @return $this
     */
    public function reset_orderid()
    {
        return $this->reset_defaultValue(self::DBKey_orderid);
    }

    /**
     * 设置 订单id 默认值
     */
    protected function _set_defaultvalue_orderid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_orderid, "" );
    }
    /**
     * 渠道id
     *
     * @var
     */
    const DBKey_platformid = "platformid";

	/**
	 * 获取 渠道id
	 * @return string
	 */
	public function get_platformid()
	{
		return $this->getdata ( self::DBKey_platformid );
	}

	/**
	 * 设置 渠道id
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
     * 重置 渠道id
     * 设置为 ""
     * @return $this
     */
    public function reset_platformid()
    {
        return $this->reset_defaultValue(self::DBKey_platformid);
    }

    /**
     * 设置 渠道id 默认值
     */
    protected function _set_defaultvalue_platformid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_platformid, "" );
    }
    /**
     * 票据
     *
     * @var
     */
    const DBKey_receipt = "receipt";

	/**
	 * 获取 票据
	 * @return string
	 */
	public function get_receipt()
	{
		return $this->getdata ( self::DBKey_receipt );
	}

	/**
	 * 设置 票据
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_receipt($value)
	{
		$this->setdata ( self::DBKey_receipt, strval($value) );
		return $this;
	}

	/**
     * 重置 票据
     * 设置为 ""
     * @return $this
     */
    public function reset_receipt()
    {
        return $this->reset_defaultValue(self::DBKey_receipt);
    }

    /**
     * 设置 票据 默认值
     */
    protected function _set_defaultvalue_receipt()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_receipt, "" );
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
        //设置 唯一id 默认值
        $this->_set_defaultvalue_uuid();
        //设置 订单id 默认值
        $this->_set_defaultvalue_orderid();
        //设置 渠道id 默认值
        $this->_set_defaultvalue_platformid();
        //设置 票据 默认值
        $this->_set_defaultvalue_receipt();

    }
}