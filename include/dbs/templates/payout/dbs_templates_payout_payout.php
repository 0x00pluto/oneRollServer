<?php

namespace dbs\templates\payout;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_payout_payout
 * @package dbs\templates\payout
 */
abstract class dbs_templates_payout_payout extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "payouts";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "payout.payout" );
    }
    /**
     * 付出列表
     *
     * @var
     */
    const DBKey_payouts = "payouts";

	/**
	 * 获取 付出列表
	 * @return array
	 */
	public function get_payouts()
	{
		return $this->getdata ( self::DBKey_payouts );
	}

	/**
	 * 设置 付出列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_payouts($value)
	{
		$this->setdata ( self::DBKey_payouts, $value );
		return $this;
	}

	/**
     * 重置 付出列表
     * 设置为 []
     * @return $this
     */
    public function reset_payouts()
    {
        return $this->reset_defaultValue(self::DBKey_payouts);
    }

    /**
     * 设置 付出列表 默认值
     */
    protected function _set_defaultvalue_payouts()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_payouts, [] );
    }
    /**
     * 利益输送额度
     *
     * @var
     */
    const DBKey_payoutValueAmount = "payoutValueAmount";

	/**
	 * 获取 利益输送额度
	 * @return int
	 */
	public function get_payoutValueAmount()
	{
		return $this->getdata ( self::DBKey_payoutValueAmount );
	}

	/**
	 * 设置 利益输送额度
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_payoutValueAmount($value)
	{
		$this->setdata ( self::DBKey_payoutValueAmount, intval($value) );
		return $this;
	}

	/**
     * 重置 利益输送额度
     * 设置为 0
     * @return $this
     */
    public function reset_payoutValueAmount()
    {
        return $this->reset_defaultValue(self::DBKey_payoutValueAmount);
    }

    /**
     * 设置 利益输送额度 默认值
     */
    protected function _set_defaultvalue_payoutValueAmount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_payoutValueAmount, 0 );
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
        //设置 付出列表 默认值
        $this->_set_defaultvalue_payouts();
        //设置 利益输送额度 默认值
        $this->_set_defaultvalue_payoutValueAmount();

    }
}