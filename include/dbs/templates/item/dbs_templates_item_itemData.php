<?php

namespace dbs\templates\item;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_item_itemData
 * @package dbs\templates\item
 */
class dbs_templates_item_itemData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "item.itemData" );
    }
    /**
     * 道具模板
     *
     * @var
     */
    const DBKey_itemid = "itemid";

	/**
	 * 获取 道具模板
	 * @return string
	 */
	public function get_itemid()
	{
		return $this->getdata ( self::DBKey_itemid );
	}

	/**
	 * 设置 道具模板
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_itemid($value)
	{
		$this->setdata ( self::DBKey_itemid, strval($value) );
		return $this;
	}

	/**
     * 重置 道具模板
     * 设置为 ""
     * @return $this
     */
    public function reset_itemid()
    {
        return $this->reset_defaultValue(self::DBKey_itemid);
    }

    /**
     * 设置 道具模板 默认值
     */
    protected function _set_defaultvalue_itemid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemid, "" );
    }
    /**
     * 道具数量
     *
     * @var
     */
    const DBKey_num = "num";

	/**
	 * 获取 道具数量
	 * @return int
	 */
	public function get_num()
	{
		return $this->getdata ( self::DBKey_num );
	}

	/**
	 * 设置 道具数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_num($value)
	{
		$this->setdata ( self::DBKey_num, intval($value) );
		return $this;
	}

	/**
     * 重置 道具数量
     * 设置为 0
     * @return $this
     */
    public function reset_num()
    {
        return $this->reset_defaultValue(self::DBKey_num);
    }

    /**
     * 设置 道具数量 默认值
     */
    protected function _set_defaultvalue_num()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_num, 0 );
    }
    /**
     * 扩展属性
     *
     * @var
     */
    const DBKey_extendinfo = "extendinfo";

	/**
	 * 获取 扩展属性
	 * @return array
	 */
	public function get_extendinfo()
	{
		return $this->getdata ( self::DBKey_extendinfo );
	}

	/**
	 * 设置 扩展属性
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_extendinfo($value)
	{
		$this->setdata ( self::DBKey_extendinfo, $value );
		return $this;
	}

	/**
     * 重置 扩展属性
     * 设置为 []
     * @return $this
     */
    public function reset_extendinfo()
    {
        return $this->reset_defaultValue(self::DBKey_extendinfo);
    }

    /**
     * 设置 扩展属性 默认值
     */
    protected function _set_defaultvalue_extendinfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_extendinfo, [] );
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
        //设置 道具模板 默认值
        $this->_set_defaultvalue_itemid();
        //设置 道具数量 默认值
        $this->_set_defaultvalue_num();
        //设置 扩展属性 默认值
        $this->_set_defaultvalue_extendinfo();

    }
}