<?php

namespace dbs\templates\recharge;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_recharge_player
 * @package dbs\templates\recharge
 */
abstract class dbs_templates_recharge_player extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "recharge";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "recharge.player" );
    }
    /**
     * 未完成的订单
     *
     * @var
     */
    const DBKey_uncompleteorderlist = "uncompleteorderlist";

	/**
	 * 获取 未完成的订单
	 * @return array
	 */
	public function get_uncompleteorderlist()
	{
		return $this->getdata ( self::DBKey_uncompleteorderlist );
	}

	/**
	 * 设置 未完成的订单
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_uncompleteorderlist($value)
	{
		$this->setdata ( self::DBKey_uncompleteorderlist, $value );
		return $this;
	}

	/**
     * 重置 未完成的订单
     * 设置为 []
     * @return $this
     */
    public function reset_uncompleteorderlist()
    {
        return $this->reset_defaultValue(self::DBKey_uncompleteorderlist);
    }

    /**
     * 设置 未完成的订单 默认值
     */
    protected function _set_defaultvalue_uncompleteorderlist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_uncompleteorderlist, [] );
    }
    /**
     * 完成的订单
     *
     * @var
     */
    const DBKey_completeorderlist = "completeorderlist";

	/**
	 * 获取 完成的订单
	 * @return array
	 */
	public function get_completeorderlist()
	{
		return $this->getdata ( self::DBKey_completeorderlist );
	}

	/**
	 * 设置 完成的订单
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_completeorderlist($value)
	{
		$this->setdata ( self::DBKey_completeorderlist, $value );
		return $this;
	}

	/**
     * 重置 完成的订单
     * 设置为 []
     * @return $this
     */
    public function reset_completeorderlist()
    {
        return $this->reset_defaultValue(self::DBKey_completeorderlist);
    }

    /**
     * 设置 完成的订单 默认值
     */
    protected function _set_defaultvalue_completeorderlist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_completeorderlist, [] );
    }
    /**
     * 货物充值的次数记录
     *
     * @var
     */
    const DBKey_rechargegoodsidlist = "rechargegoodsidlist";

	/**
	 * 获取 货物充值的次数记录
	 * @return array
	 */
	public function get_rechargegoodsidlist()
	{
		return $this->getdata ( self::DBKey_rechargegoodsidlist );
	}

	/**
	 * 设置 货物充值的次数记录
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_rechargegoodsidlist($value)
	{
		$this->setdata ( self::DBKey_rechargegoodsidlist, $value );
		return $this;
	}

	/**
     * 重置 货物充值的次数记录
     * 设置为 []
     * @return $this
     */
    public function reset_rechargegoodsidlist()
    {
        return $this->reset_defaultValue(self::DBKey_rechargegoodsidlist);
    }

    /**
     * 设置 货物充值的次数记录 默认值
     */
    protected function _set_defaultvalue_rechargegoodsidlist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rechargegoodsidlist, [] );
    }
    /**
     * 充值的总数人民币金额分
     *
     * @var
     */
    const DBKey_totalrechargemoney = "totalrechargemoney";

	/**
	 * 获取 充值的总数人民币金额分
	 * @return int
	 */
	public function get_totalrechargemoney()
	{
		return $this->getdata ( self::DBKey_totalrechargemoney );
	}

	/**
	 * 设置 充值的总数人民币金额分
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_totalrechargemoney($value)
	{
		$this->setdata ( self::DBKey_totalrechargemoney, intval($value) );
		return $this;
	}

	/**
     * 重置 充值的总数人民币金额分
     * 设置为 0
     * @return $this
     */
    public function reset_totalrechargemoney()
    {
        return $this->reset_defaultValue(self::DBKey_totalrechargemoney);
    }

    /**
     * 设置 充值的总数人民币金额分 默认值
     */
    protected function _set_defaultvalue_totalrechargemoney()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_totalrechargemoney, 0 );
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
        //设置 未完成的订单 默认值
        $this->_set_defaultvalue_uncompleteorderlist();
        //设置 完成的订单 默认值
        $this->_set_defaultvalue_completeorderlist();
        //设置 货物充值的次数记录 默认值
        $this->_set_defaultvalue_rechargegoodsidlist();
        //设置 充值的总数人民币金额分 默认值
        $this->_set_defaultvalue_totalrechargemoney();

    }
}