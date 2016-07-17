<?php

namespace dbs\templates;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_equipment
 * @package dbs\templates
 */
abstract class dbs_templates_equipment extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "equipments";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "equipment" );
    }
    /**
     * 赠送出去的装备
     *
     * @var
     */
    const DBKey_giveequipmentlist = "giveequipmentlist";

	/**
	 * 获取 赠送出去的装备
	 * @return array
	 */
	public function get_giveequipmentlist()
	{
		return $this->getdata ( self::DBKey_giveequipmentlist );
	}

	/**
	 * 设置 赠送出去的装备
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_giveequipmentlist($value)
	{
		$this->setdata ( self::DBKey_giveequipmentlist, $value );
		return $this;
	}

	/**
     * 重置 赠送出去的装备
     * 设置为 []
     * @return $this
     */
    public function reset_giveequipmentlist()
    {
        return $this->reset_defaultValue(self::DBKey_giveequipmentlist);
    }

    /**
     * 设置 赠送出去的装备 默认值
     */
    protected function _set_defaultvalue_giveequipmentlist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_giveequipmentlist, [] );
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
        //设置 赠送出去的装备 默认值
        $this->_set_defaultvalue_giveequipmentlist();

    }
}