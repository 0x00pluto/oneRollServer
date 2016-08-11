<?php

namespace dbs\templates\records;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_records_acceptRecordSignInData
 * @package dbs\templates\records
 */
class dbs_templates_records_acceptRecordSignInData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "records.acceptRecordSignInData" );
    }
    /**
     * 是否签收
     *
     * @var
     */
    const DBKey_signIn = "signIn";

	/**
	 * 获取 是否签收
	 * @return bool
	 */
	public function get_signIn()
	{
		return $this->getdata ( self::DBKey_signIn );
	}

	/**
	 * 设置 是否签收
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_signIn($value)
	{
		$this->setdata ( self::DBKey_signIn, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否签收
     * 设置为 false
     * @return $this
     */
    public function reset_signIn()
    {
        return $this->reset_defaultValue(self::DBKey_signIn);
    }

    /**
     * 设置 是否签收 默认值
     */
    protected function _set_defaultvalue_signIn()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_signIn, false );
    }
    /**
     * 签收时间
     *
     * @var
     */
    const DBKey_signInTimeSpan = "signInTimeSpan";

	/**
	 * 获取 签收时间
	 * @return int
	 */
	public function get_signInTimeSpan()
	{
		return $this->getdata ( self::DBKey_signInTimeSpan );
	}

	/**
	 * 设置 签收时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_signInTimeSpan($value)
	{
		$this->setdata ( self::DBKey_signInTimeSpan, intval($value) );
		return $this;
	}

	/**
     * 重置 签收时间
     * 设置为 0
     * @return $this
     */
    public function reset_signInTimeSpan()
    {
        return $this->reset_defaultValue(self::DBKey_signInTimeSpan);
    }

    /**
     * 设置 签收时间 默认值
     */
    protected function _set_defaultvalue_signInTimeSpan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_signInTimeSpan, 0 );
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
        //设置 是否签收 默认值
        $this->_set_defaultvalue_signIn();
        //设置 签收时间 默认值
        $this->_set_defaultvalue_signInTimeSpan();

    }
}