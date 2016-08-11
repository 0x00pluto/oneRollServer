<?php

namespace dbs\templates\records;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_records_acceptRecordTransferData
 * @package dbs\templates\records
 */
class dbs_templates_records_acceptRecordTransferData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "records.acceptRecordTransferData" );
    }
    /**
     * 物流号
     *
     * @var
     */
    const DBKey_TransferCode = "TransferCode";

	/**
	 * 获取 物流号
	 * @return string
	 */
	public function get_TransferCode()
	{
		return $this->getdata ( self::DBKey_TransferCode );
	}

	/**
	 * 设置 物流号
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_TransferCode($value)
	{
		$this->setdata ( self::DBKey_TransferCode, strval($value) );
		return $this;
	}

	/**
     * 重置 物流号
     * 设置为 ""
     * @return $this
     */
    public function reset_TransferCode()
    {
        return $this->reset_defaultValue(self::DBKey_TransferCode);
    }

    /**
     * 设置 物流号 默认值
     */
    protected function _set_defaultvalue_TransferCode()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_TransferCode, "" );
    }
    /**
     * 物流类型
     *
     * @var
     */
    const DBKey_TransferType = "TransferType";

	/**
	 * 获取 物流类型
	 * @return string
	 */
	public function get_TransferType()
	{
		return $this->getdata ( self::DBKey_TransferType );
	}

	/**
	 * 设置 物流类型
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_TransferType($value)
	{
		$this->setdata ( self::DBKey_TransferType, strval($value) );
		return $this;
	}

	/**
     * 重置 物流类型
     * 设置为 ""
     * @return $this
     */
    public function reset_TransferType()
    {
        return $this->reset_defaultValue(self::DBKey_TransferType);
    }

    /**
     * 设置 物流类型 默认值
     */
    protected function _set_defaultvalue_TransferType()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_TransferType, "" );
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
        //设置 物流号 默认值
        $this->_set_defaultvalue_TransferCode();
        //设置 物流类型 默认值
        $this->_set_defaultvalue_TransferType();

    }
}