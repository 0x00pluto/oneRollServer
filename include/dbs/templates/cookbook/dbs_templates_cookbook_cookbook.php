<?php

namespace dbs\templates\cookbook;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_cookbook_cookbook
 * @package dbs\templates\cookbook
 */
abstract class dbs_templates_cookbook_cookbook extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "cookbooks";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "cookbook.cookbook" );
    }
    /**
     * 所有菜谱
     *
     * @var
     */
    const DBKey_books = "books";

	/**
	 * 获取 所有菜谱
	 * @return array
	 */
	public function get_books()
	{
		return $this->getdata ( self::DBKey_books );
	}

	/**
	 * 设置 所有菜谱
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_books($value)
	{
		$this->setdata ( self::DBKey_books, $value );
		return $this;
	}

	/**
     * 重置 所有菜谱
     * 设置为 []
     * @return $this
     */
    public function reset_books()
    {
        return $this->reset_defaultValue(self::DBKey_books);
    }

    /**
     * 设置 所有菜谱 默认值
     */
    protected function _set_defaultvalue_books()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_books, [] );
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
        //设置 所有菜谱 默认值
        $this->_set_defaultvalue_books();

    }
}