<?php

namespace dbs\templates\disheshandbook;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_disheshandbook_handbooks
 * @package dbs\templates\disheshandbook
 */
abstract class dbs_templates_disheshandbook_handbooks extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "disheshandbooks";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "disheshandbook.handbooks" );
    }
    /**
     * 图鉴列表
     *
     * @var
     */
    const DBKey_handbooks = "handbooks";

	/**
	 * 获取 图鉴列表
	 * @return array
	 */
	public function get_handbooks()
	{
		return $this->getdata ( self::DBKey_handbooks );
	}

	/**
	 * 设置 图鉴列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_handbooks($value)
	{
		$this->setdata ( self::DBKey_handbooks, $value );
		return $this;
	}

	/**
     * 重置 图鉴列表
     * 设置为 []
     * @return $this
     */
    public function reset_handbooks()
    {
        return $this->reset_defaultValue(self::DBKey_handbooks);
    }

    /**
     * 设置 图鉴列表 默认值
     */
    protected function _set_defaultvalue_handbooks()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_handbooks, [] );
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
        //设置 图鉴列表 默认值
        $this->_set_defaultvalue_handbooks();

    }
}