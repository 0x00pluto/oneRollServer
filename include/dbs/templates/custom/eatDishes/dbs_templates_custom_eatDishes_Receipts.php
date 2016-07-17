<?php

namespace dbs\templates\custom\eatDishes;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_custom_eatDishes_Receipts
 * @package dbs\templates\custom\eatDishes
 */
class dbs_templates_custom_eatDishes_Receipts extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "custom.eatDishes.Receipts" );
    }
    /**
     * 票据s
     *
     * @var
     */
    const DBKey_recepits = "recepits";

	/**
	 * 获取 票据s
	 * @return array
	 */
	public function get_recepits()
	{
		return $this->getdata ( self::DBKey_recepits );
	}

	/**
	 * 设置 票据s
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_recepits($value)
	{
		$this->setdata ( self::DBKey_recepits, $value );
		return $this;
	}

	/**
     * 重置 票据s
     * 设置为 []
     * @return $this
     */
    public function reset_recepits()
    {
        return $this->reset_defaultValue(self::DBKey_recepits);
    }

    /**
     * 设置 票据s 默认值
     */
    protected function _set_defaultvalue_recepits()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_recepits, [] );
    }
    /**
     * 上次生成票据时间
     *
     * @var
     */
    const DBKey_lastBuildReceiptsTime = "lastBuildReceiptsTime";

	/**
	 * 获取 上次生成票据时间
	 * @return int
	 */
	public function get_lastBuildReceiptsTime()
	{
		return $this->getdata ( self::DBKey_lastBuildReceiptsTime );
	}

	/**
	 * 设置 上次生成票据时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_lastBuildReceiptsTime($value)
	{
		$this->setdata ( self::DBKey_lastBuildReceiptsTime, intval($value) );
		return $this;
	}

	/**
     * 重置 上次生成票据时间
     * 设置为 0
     * @return $this
     */
    public function reset_lastBuildReceiptsTime()
    {
        return $this->reset_defaultValue(self::DBKey_lastBuildReceiptsTime);
    }

    /**
     * 设置 上次生成票据时间 默认值
     */
    protected function _set_defaultvalue_lastBuildReceiptsTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastBuildReceiptsTime, 0 );
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
        //设置 票据s 默认值
        $this->_set_defaultvalue_recepits();
        //设置 上次生成票据时间 默认值
        $this->_set_defaultvalue_lastBuildReceiptsTime();

    }
}