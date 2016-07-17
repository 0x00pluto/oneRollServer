<?php

namespace dbs\templates\cookbook;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_cookbook_cookbookinfo
 * @package dbs\templates\cookbook
 */
class dbs_templates_cookbook_cookbookinfo extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "cookbook.cookbookinfo" );
    }
    /**
     * 菜谱ID
     *
     * @var
     */
    const DBKey_bookid = "bookid";

	/**
	 * 获取 菜谱ID
	 * @return string
	 */
	public function get_bookid()
	{
		return $this->getdata ( self::DBKey_bookid );
	}

	/**
	 * 设置 菜谱ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_bookid($value)
	{
		$this->setdata ( self::DBKey_bookid, strval($value) );
		return $this;
	}

	/**
     * 重置 菜谱ID
     * 设置为 ""
     * @return $this
     */
    public function reset_bookid()
    {
        return $this->reset_defaultValue(self::DBKey_bookid);
    }

    /**
     * 设置 菜谱ID 默认值
     */
    protected function _set_defaultvalue_bookid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_bookid, "" );
    }
    /**
     * 烹饪次数
     *
     * @var
     */
    const DBKey_cookingtimes = "cookingtimes";

	/**
	 * 获取 烹饪次数
	 * @return int
	 */
	public function get_cookingtimes()
	{
		return $this->getdata ( self::DBKey_cookingtimes );
	}

	/**
	 * 设置 烹饪次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cookingtimes($value)
	{
		$this->setdata ( self::DBKey_cookingtimes, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪次数
     * 设置为 0
     * @return $this
     */
    public function reset_cookingtimes()
    {
        return $this->reset_defaultValue(self::DBKey_cookingtimes);
    }

    /**
     * 设置 烹饪次数 默认值
     */
    protected function _set_defaultvalue_cookingtimes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cookingtimes, 0 );
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
        //设置 菜谱ID 默认值
        $this->_set_defaultvalue_bookid();
        //设置 烹饪次数 默认值
        $this->_set_defaultvalue_cookingtimes();

    }
}