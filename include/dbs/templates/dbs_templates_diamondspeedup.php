<?php

namespace dbs\templates;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_diamondspeedup
 * @package dbs\templates
 */
abstract class dbs_templates_diamondspeedup extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "diamondspeedup";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "diamondspeedup" );
    }
    /**
     * 加速数据
     *
     * @var
     */
    const DBKey_speedup = "speedup";

	/**
	 * 获取 加速数据
	 * @return string
	 */
	public function get_speedup()
	{
		return $this->getdata ( self::DBKey_speedup );
	}

	/**
	 * 设置 加速数据
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_speedup($value)
	{
		$this->setdata ( self::DBKey_speedup, strval($value) );
		return $this;
	}

	/**
     * 重置 加速数据
     * 设置为 ""
     * @return $this
     */
    public function reset_speedup()
    {
        return $this->reset_defaultValue(self::DBKey_speedup);
    }

    /**
     * 设置 加速数据 默认值
     */
    protected function _set_defaultvalue_speedup()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_speedup, "" );
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
        //设置 加速数据 默认值
        $this->_set_defaultvalue_speedup();

    }
}