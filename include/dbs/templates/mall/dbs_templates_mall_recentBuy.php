<?php

namespace dbs\templates\mall;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_recentBuy
 * @package dbs\templates\mall
 */
class dbs_templates_mall_recentBuy extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.recentBuy" );
    }
    /**
     * 最后的购买记录
     *
     * @var
     */
    const DBKey_lastTradeDetails = "lastTradeDetails";

	/**
	 * 获取 最后的购买记录
	 * @return array
	 */
	public function get_lastTradeDetails()
	{
		return $this->getdata ( self::DBKey_lastTradeDetails );
	}

	/**
	 * 设置 最后的购买记录
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_lastTradeDetails($value)
	{
		$this->setdata ( self::DBKey_lastTradeDetails, $value );
		return $this;
	}

	/**
     * 重置 最后的购买记录
     * 设置为 []
     * @return $this
     */
    public function reset_lastTradeDetails()
    {
        return $this->reset_defaultValue(self::DBKey_lastTradeDetails);
    }

    /**
     * 设置 最后的购买记录 默认值
     */
    protected function _set_defaultvalue_lastTradeDetails()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastTradeDetails, [] );
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
        //设置 最后的购买记录 默认值
        $this->_set_defaultvalue_lastTradeDetails();

    }
}