<?php

namespace dbs\templates\trade;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_trade_player
 * @package dbs\templates\trade
 */
abstract class dbs_templates_trade_player extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "trade_player";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "trade.player" );
    }
    /**
     * 钻石购买钻石数量
     *
     * @var
     */
    const DBKey_diamondexpandtimes = "diamondexpandtimes";

	/**
	 * 获取 钻石购买钻石数量
	 * @return int
	 */
	public function get_diamondexpandtimes()
	{
		return $this->getdata ( self::DBKey_diamondexpandtimes );
	}

	/**
	 * 设置 钻石购买钻石数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_diamondexpandtimes($value)
	{
		$this->setdata ( self::DBKey_diamondexpandtimes, intval($value) );
		return $this;
	}

	/**
     * 重置 钻石购买钻石数量
     * 设置为 0
     * @return $this
     */
    public function reset_diamondexpandtimes()
    {
        return $this->reset_defaultValue(self::DBKey_diamondexpandtimes);
    }

    /**
     * 设置 钻石购买钻石数量 默认值
     */
    protected function _set_defaultvalue_diamondexpandtimes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_diamondexpandtimes, 0 );
    }
    /**
     * 交易格子信息
     *
     * @var
     */
    const DBKey_tradeboxes = "tradeboxes";

	/**
	 * 获取 交易格子信息
	 * @return array
	 */
	public function get_tradeboxes()
	{
		return $this->getdata ( self::DBKey_tradeboxes );
	}

	/**
	 * 设置 交易格子信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_tradeboxes($value)
	{
		$this->setdata ( self::DBKey_tradeboxes, $value );
		return $this;
	}

	/**
     * 重置 交易格子信息
     * 设置为 []
     * @return $this
     */
    public function reset_tradeboxes()
    {
        return $this->reset_defaultValue(self::DBKey_tradeboxes);
    }

    /**
     * 设置 交易格子信息 默认值
     */
    protected function _set_defaultvalue_tradeboxes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_tradeboxes, [] );
    }
    /**
     * 交易格子数量
     *
     * @var
     */
    const DBKey_tradeboxsize = "tradeboxsize";

	/**
	 * 获取 交易格子数量
	 * @return int
	 */
	public function get_tradeboxsize()
	{
		return $this->getdata ( self::DBKey_tradeboxsize );
	}

	/**
	 * 设置 交易格子数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_tradeboxsize($value)
	{
		$this->setdata ( self::DBKey_tradeboxsize, intval($value) );
		return $this;
	}

	/**
     * 重置 交易格子数量
     * 设置为 0
     * @return $this
     */
    public function reset_tradeboxsize()
    {
        return $this->reset_defaultValue(self::DBKey_tradeboxsize);
    }

    /**
     * 设置 交易格子数量 默认值
     */
    protected function _set_defaultvalue_tradeboxsize()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_tradeboxsize, 0 );
    }
    /**
     * 交易次数限制
     *
     * @var
     */
    const DBKey_tradetimeslimit = "tradetimeslimit";

	/**
	 * 获取 交易次数限制
	 * @return array
	 */
	public function get_tradetimeslimit()
	{
		return $this->getdata ( self::DBKey_tradetimeslimit );
	}

	/**
	 * 设置 交易次数限制
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_tradetimeslimit($value)
	{
		$this->setdata ( self::DBKey_tradetimeslimit, $value );
		return $this;
	}

	/**
     * 重置 交易次数限制
     * 设置为 []
     * @return $this
     */
    public function reset_tradetimeslimit()
    {
        return $this->reset_defaultValue(self::DBKey_tradetimeslimit);
    }

    /**
     * 设置 交易次数限制 默认值
     */
    protected function _set_defaultvalue_tradetimeslimit()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_tradetimeslimit, [] );
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
        //设置 钻石购买钻石数量 默认值
        $this->_set_defaultvalue_diamondexpandtimes();
        //设置 交易格子信息 默认值
        $this->_set_defaultvalue_tradeboxes();
        //设置 交易格子数量 默认值
        $this->_set_defaultvalue_tradeboxsize();
        //设置 交易次数限制 默认值
        $this->_set_defaultvalue_tradetimeslimit();

    }
}