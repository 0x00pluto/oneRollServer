<?php

namespace dbs\templates\payout;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_payout_payoutdata
 * @package dbs\templates\payout
 */
class dbs_templates_payout_payoutdata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "payout.payoutdata" );
    }
    /**
     * 目标用户ID
     *
     * @var
     */
    const DBKey_userId = "userId";

	/**
	 * 获取 目标用户ID
	 * @return string
	 */
	public function get_userId()
	{
		return $this->getdata ( self::DBKey_userId );
	}

	/**
	 * 设置 目标用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_userId($value)
	{
		$this->setdata ( self::DBKey_userId, strval($value) );
		return $this;
	}

	/**
     * 重置 目标用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_userId()
    {
        return $this->reset_defaultValue(self::DBKey_userId);
    }

    /**
     * 设置 目标用户ID 默认值
     */
    protected function _set_defaultvalue_userId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userId, "" );
    }
    /**
     * 钻石价值
     *
     * @var
     */
    const DBKey_diamondValue = "diamondValue";

	/**
	 * 获取 钻石价值
	 * @return int
	 */
	public function get_diamondValue()
	{
		return $this->getdata ( self::DBKey_diamondValue );
	}

	/**
	 * 设置 钻石价值
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_diamondValue($value)
	{
		$this->setdata ( self::DBKey_diamondValue, intval($value) );
		return $this;
	}

	/**
     * 重置 钻石价值
     * 设置为 0
     * @return $this
     */
    public function reset_diamondValue()
    {
        return $this->reset_defaultValue(self::DBKey_diamondValue);
    }

    /**
     * 设置 钻石价值 默认值
     */
    protected function _set_defaultvalue_diamondValue()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_diamondValue, 0 );
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
        //设置 目标用户ID 默认值
        $this->_set_defaultvalue_userId();
        //设置 钻石价值 默认值
        $this->_set_defaultvalue_diamondValue();

    }
}