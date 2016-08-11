<?php

namespace dbs\templates\records;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_records_acceptRecords
 * @package dbs\templates\records
 */
abstract class dbs_templates_records_acceptRecords extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "records_acceptRecords";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "records.acceptRecords" );
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
     * 状态
     *
     * @var
     */
    const DBKey_status = "status";

	/**
	 * 获取 状态
	 * @return int
	 */
	public function get_status()
	{
		return $this->getdata ( self::DBKey_status );
	}

	/**
	 * 设置 状态
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_status($value)
	{
		$this->setdata ( self::DBKey_status, intval($value) );
		return $this;
	}

	/**
     * 重置 状态
     * 设置为 0
     * @return $this
     */
    public function reset_status()
    {
        return $this->reset_defaultValue(self::DBKey_status);
    }

    /**
     * 设置 状态 默认值
     */
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_status, 0 );
    }
    /**
     * 领奖用户信息
     *
     * @var
     */
    const DBKey_acceptRecordUserData = "acceptRecordUserData";

	/**
	 * 获取 领奖用户信息
	 * @return array
	 */
	public function get_acceptRecordUserData()
	{
		return $this->getdata ( self::DBKey_acceptRecordUserData );
	}

	/**
	 * 设置 领奖用户信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_acceptRecordUserData($value)
	{
		$this->setdata ( self::DBKey_acceptRecordUserData, $value );
		return $this;
	}

	/**
     * 重置 领奖用户信息
     * 设置为 []
     * @return $this
     */
    public function reset_acceptRecordUserData()
    {
        return $this->reset_defaultValue(self::DBKey_acceptRecordUserData);
    }

    /**
     * 设置 领奖用户信息 默认值
     */
    protected function _set_defaultvalue_acceptRecordUserData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_acceptRecordUserData, [] );
    }
    /**
     * 物流信息
     *
     * @var
     */
    const DBKey_acceptRecordTransferData = "acceptRecordTransferData";

	/**
	 * 获取 物流信息
	 * @return array
	 */
	public function get_acceptRecordTransferData()
	{
		return $this->getdata ( self::DBKey_acceptRecordTransferData );
	}

	/**
	 * 设置 物流信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_acceptRecordTransferData($value)
	{
		$this->setdata ( self::DBKey_acceptRecordTransferData, $value );
		return $this;
	}

	/**
     * 重置 物流信息
     * 设置为 []
     * @return $this
     */
    public function reset_acceptRecordTransferData()
    {
        return $this->reset_defaultValue(self::DBKey_acceptRecordTransferData);
    }

    /**
     * 设置 物流信息 默认值
     */
    protected function _set_defaultvalue_acceptRecordTransferData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_acceptRecordTransferData, [] );
    }
    /**
     * 物品签收数据
     *
     * @var
     */
    const DBKey_acceptRecordSignIn = "acceptRecordSignIn";

	/**
	 * 获取 物品签收数据
	 * @return array
	 */
	public function get_acceptRecordSignIn()
	{
		return $this->getdata ( self::DBKey_acceptRecordSignIn );
	}

	/**
	 * 设置 物品签收数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_acceptRecordSignIn($value)
	{
		$this->setdata ( self::DBKey_acceptRecordSignIn, $value );
		return $this;
	}

	/**
     * 重置 物品签收数据
     * 设置为 []
     * @return $this
     */
    public function reset_acceptRecordSignIn()
    {
        return $this->reset_defaultValue(self::DBKey_acceptRecordSignIn);
    }

    /**
     * 设置 物品签收数据 默认值
     */
    protected function _set_defaultvalue_acceptRecordSignIn()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_acceptRecordSignIn, [] );
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
        //设置 状态 默认值
        $this->_set_defaultvalue_status();
        //设置 领奖用户信息 默认值
        $this->_set_defaultvalue_acceptRecordUserData();
        //设置 物流信息 默认值
        $this->_set_defaultvalue_acceptRecordTransferData();
        //设置 物品签收数据 默认值
        $this->_set_defaultvalue_acceptRecordSignIn();

    }
}