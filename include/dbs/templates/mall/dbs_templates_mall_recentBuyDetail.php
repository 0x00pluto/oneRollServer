<?php

namespace dbs\templates\mall;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_recentBuyDetail
 * @package dbs\templates\mall
 */
class dbs_templates_mall_recentBuyDetail extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.recentBuyDetail" );
    }
    /**
     * 交易ID
     *
     * @var
     */
    const DBKey_tradeId = "tradeId";

	/**
	 * 获取 交易ID
	 * @return string
	 */
	public function get_tradeId()
	{
		return $this->getdata ( self::DBKey_tradeId );
	}

	/**
	 * 设置 交易ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_tradeId($value)
	{
		$this->setdata ( self::DBKey_tradeId, strval($value) );
		return $this;
	}

	/**
     * 重置 交易ID
     * 设置为 ""
     * @return $this
     */
    public function reset_tradeId()
    {
        return $this->reset_defaultValue(self::DBKey_tradeId);
    }

    /**
     * 设置 交易ID 默认值
     */
    protected function _set_defaultvalue_tradeId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_tradeId, "" );
    }
    /**
     * 时间戳
     *
     * @var
     */
    const DBKey_rollTimeSpan = "rollTimeSpan";

	/**
	 * 获取 时间戳
	 * @return int
	 */
	public function get_rollTimeSpan()
	{
		return $this->getdata ( self::DBKey_rollTimeSpan );
	}

	/**
	 * 设置 时间戳
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_rollTimeSpan($value)
	{
		$this->setdata ( self::DBKey_rollTimeSpan, intval($value) );
		return $this;
	}

	/**
     * 重置 时间戳
     * 设置为 0
     * @return $this
     */
    public function reset_rollTimeSpan()
    {
        return $this->reset_defaultValue(self::DBKey_rollTimeSpan);
    }

    /**
     * 设置 时间戳 默认值
     */
    protected function _set_defaultvalue_rollTimeSpan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rollTimeSpan, 0 );
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
        //设置 交易ID 默认值
        $this->_set_defaultvalue_tradeId();
        //设置 时间戳 默认值
        $this->_set_defaultvalue_rollTimeSpan();

    }
}