<?php

namespace dbs\templates\records;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_records_deactive
 * @package dbs\templates\records
 */
abstract class dbs_templates_records_deactive extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "records_deactive";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "records.deactive" );
    }
    /**
     * 开奖记录(key=>goodsId value=>recordData)
     *
     * @var
     */
    const DBKey_records = "records";

	/**
	 * 获取 开奖记录(key=>goodsId value=>recordData)
	 * @return array
	 */
	public function get_records()
	{
		return $this->getdata ( self::DBKey_records );
	}

	/**
	 * 设置 开奖记录(key=>goodsId value=>recordData)
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_records($value)
	{
		$this->setdata ( self::DBKey_records, $value );
		return $this;
	}

	/**
     * 重置 开奖记录(key=>goodsId value=>recordData)
     * 设置为 []
     * @return $this
     */
    public function reset_records()
    {
        return $this->reset_defaultValue(self::DBKey_records);
    }

    /**
     * 设置 开奖记录(key=>goodsId value=>recordData) 默认值
     */
    protected function _set_defaultvalue_records()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_records, [] );
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
        //设置 开奖记录(key=>goodsId value=>recordData) 默认值
        $this->_set_defaultvalue_records();

    }
}