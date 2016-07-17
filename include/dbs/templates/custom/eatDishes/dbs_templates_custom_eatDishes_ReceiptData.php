<?php

namespace dbs\templates\custom\eatDishes;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_custom_eatDishes_ReceiptData
 * @package dbs\templates\custom\eatDishes
 */
class dbs_templates_custom_eatDishes_ReceiptData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "custom.eatDishes.ReceiptData" );
    }
    /**
     * 模板数据
     *
     * @var
     */
    const DBKey_nameA = "nameA";

	/**
	 * 获取 模板数据
	 * @return int
	 */
	public function get_nameA()
	{
		return $this->getdata ( self::DBKey_nameA );
	}

	/**
	 * 设置 模板数据
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_nameA($value)
	{
		$this->setdata ( self::DBKey_nameA, intval($value) );
		return $this;
	}

	/**
     * 重置 模板数据
     * 设置为 0
     * @return $this
     */
    public function reset_nameA()
    {
        return $this->reset_defaultValue(self::DBKey_nameA);
    }

    /**
     * 设置 模板数据 默认值
     */
    protected function _set_defaultvalue_nameA()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_nameA, 0 );
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
        //设置 模板数据 默认值
        $this->_set_defaultvalue_nameA();

    }
}