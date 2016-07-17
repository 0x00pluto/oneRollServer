<?php

namespace dbs\templates\serverstatus;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_serverstatus_basestatusdata
 * @package dbs\templates\serverstatus
 */
abstract class dbs_templates_serverstatus_basestatusdata extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "serverstatus_basestatusdata";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "serverstatus.basestatusdata" );
    }
    /**
     * 服务器状态
     *
     * @var
     */
    const DBKey_stateCode = "stateCode";

	/**
	 * 获取 服务器状态
	 * @return int
	 */
	public function get_stateCode()
	{
		return $this->getdata ( self::DBKey_stateCode );
	}

	/**
	 * 设置 服务器状态
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_stateCode($value)
	{
		$this->setdata ( self::DBKey_stateCode, intval($value) );
		return $this;
	}

	/**
     * 重置 服务器状态
     * 设置为 0
     * @return $this
     */
    public function reset_stateCode()
    {
        return $this->reset_defaultValue(self::DBKey_stateCode);
    }

    /**
     * 设置 服务器状态 默认值
     */
    protected function _set_defaultvalue_stateCode()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_stateCode, 0 );
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
        //设置 服务器状态 默认值
        $this->_set_defaultvalue_stateCode();

    }
}