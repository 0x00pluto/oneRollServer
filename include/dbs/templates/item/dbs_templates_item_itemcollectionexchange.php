<?php

namespace dbs\templates\item;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_item_itemcollectionexchange
 * @package dbs\templates\item
 */
abstract class dbs_templates_item_itemcollectionexchange extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "itemcollectionexchange";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "item.itemcollectionexchange" );
    }
    /**
     * 兑换记录
     *
     * @var
     */
    const DBKey_exchangehistory = "exchangehistory";

	/**
	 * 获取 兑换记录
	 * @return array
	 */
	public function get_exchangehistory()
	{
		return $this->getdata ( self::DBKey_exchangehistory );
	}

	/**
	 * 设置 兑换记录
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_exchangehistory($value)
	{
		$this->setdata ( self::DBKey_exchangehistory, $value );
		return $this;
	}

	/**
     * 重置 兑换记录
     * 设置为 []
     * @return $this
     */
    public function reset_exchangehistory()
    {
        return $this->reset_defaultValue(self::DBKey_exchangehistory);
    }

    /**
     * 设置 兑换记录 默认值
     */
    protected function _set_defaultvalue_exchangehistory()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_exchangehistory, [] );
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
        //设置 兑换记录 默认值
        $this->_set_defaultvalue_exchangehistory();

    }
}