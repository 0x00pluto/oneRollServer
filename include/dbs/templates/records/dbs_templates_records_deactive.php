<?php

namespace dbs\templates\records;

use dbs\dbs_base as super;

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
     * 用户ID
     *
     * @var
     */
    const DBKey_userid = "userid";

	/**
	 * 获取 用户ID
	 * @return string
	 */
	public function get_userid()
	{
		return $this->getdata ( self::DBKey_userid );
	}

	/**
	 * 设置 用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_userid($value)
	{
		$this->setdata ( self::DBKey_userid, strval($value) );
		return $this;
	}

	/**
     * 重置 用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_userid()
    {
        return $this->reset_defaultValue(self::DBKey_userid);
    }

    /**
     * 设置 用户ID 默认值
     */
    protected function _set_defaultvalue_userid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userid, "" );
    }
    /**
     * 货物ID
     *
     * @var
     */
    const DBKey_goodsId = "goodsId";

	/**
	 * 获取 货物ID
	 * @return string
	 */
	public function get_goodsId()
	{
		return $this->getdata ( self::DBKey_goodsId );
	}

	/**
	 * 设置 货物ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_goodsId($value)
	{
		$this->setdata ( self::DBKey_goodsId, strval($value) );
		return $this;
	}

	/**
     * 重置 货物ID
     * 设置为 ""
     * @return $this
     */
    public function reset_goodsId()
    {
        return $this->reset_defaultValue(self::DBKey_goodsId);
    }

    /**
     * 设置 货物ID 默认值
     */
    protected function _set_defaultvalue_goodsId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_goodsId, "" );
    }
    /**
     * 开奖记录(key=>goodsId value=>recordData)
     *
     * @var
     */
    const DBKey_recordData = "recordData";

	/**
	 * 获取 开奖记录(key=>goodsId value=>recordData)
	 * @return array
	 */
	public function get_recordData()
	{
		return $this->getdata ( self::DBKey_recordData );
	}

	/**
	 * 设置 开奖记录(key=>goodsId value=>recordData)
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_recordData($value)
	{
		$this->setdata ( self::DBKey_recordData, $value );
		return $this;
	}

	/**
     * 重置 开奖记录(key=>goodsId value=>recordData)
     * 设置为 []
     * @return $this
     */
    public function reset_recordData()
    {
        return $this->reset_defaultValue(self::DBKey_recordData);
    }

    /**
     * 设置 开奖记录(key=>goodsId value=>recordData) 默认值
     */
    protected function _set_defaultvalue_recordData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_recordData, [] );
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
        //设置 用户ID 默认值
        $this->_set_defaultvalue_userid();
        //设置 货物ID 默认值
        $this->_set_defaultvalue_goodsId();
        //设置 开奖记录(key=>goodsId value=>recordData) 默认值
        $this->_set_defaultvalue_recordData();

    }
}