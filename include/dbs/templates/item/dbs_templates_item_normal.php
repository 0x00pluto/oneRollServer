<?php

namespace dbs\templates\item;

use dbs\templates\item\dbs_templates_item_itemData as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_item_normal
 * @package dbs\templates\item
 */
class dbs_templates_item_normal extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "item.normal" );
    }
    /**
     * 道具在仓库中的位置
     *
     * @var
     */
    const DBKey_warehousepos = "warehousepos";

	/**
	 * 获取 道具在仓库中的位置
	 * @return string
	 */
	public function get_warehousepos()
	{
		return $this->getdata ( self::DBKey_warehousepos );
	}

	/**
	 * 设置 道具在仓库中的位置
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_warehousepos($value)
	{
		$this->setdata ( self::DBKey_warehousepos, strval($value) );
		return $this;
	}

	/**
     * 重置 道具在仓库中的位置
     * 设置为 ""
     * @return $this
     */
    public function reset_warehousepos()
    {
        return $this->reset_defaultValue(self::DBKey_warehousepos);
    }

    /**
     * 设置 道具在仓库中的位置 默认值
     */
    protected function _set_defaultvalue_warehousepos()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_warehousepos, "" );
    }
    /**
     * 道具拥有者
     *
     * @var
     */
    const DBKey_itemowneruserid = "itemowneruserid";

	/**
	 * 获取 道具拥有者
	 * @return string
	 */
	public function get_itemowneruserid()
	{
		return $this->getdata ( self::DBKey_itemowneruserid );
	}

	/**
	 * 设置 道具拥有者
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_itemowneruserid($value)
	{
		$this->setdata ( self::DBKey_itemowneruserid, strval($value) );
		return $this;
	}

	/**
     * 重置 道具拥有者
     * 设置为 ""
     * @return $this
     */
    public function reset_itemowneruserid()
    {
        return $this->reset_defaultValue(self::DBKey_itemowneruserid);
    }

    /**
     * 设置 道具拥有者 默认值
     */
    protected function _set_defaultvalue_itemowneruserid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemowneruserid, "" );
    }
    /**
     * 道具来源信息
     *
     * @var
     */
    const DBKey_itemFromInfo = "itemFromInfo";

	/**
	 * 获取 道具来源信息
	 * @return array
	 */
	protected function get_itemFromInfo()
	{
		return $this->getdata ( self::DBKey_itemFromInfo );
	}

	/**
	 * 设置 道具来源信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_itemFromInfo($value)
	{
		$this->setdata ( self::DBKey_itemFromInfo, $value );
		return $this;
	}

	/**
     * 重置 道具来源信息
     * 设置为 []
     * @return $this
     */
    public function reset_itemFromInfo()
    {
        return $this->reset_defaultValue(self::DBKey_itemFromInfo);
    }

    /**
     * 设置 道具来源信息 默认值
     */
    protected function _set_defaultvalue_itemFromInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemFromInfo, [] );
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
        //设置 道具在仓库中的位置 默认值
        $this->_set_defaultvalue_warehousepos();
        //设置 道具拥有者 默认值
        $this->_set_defaultvalue_itemowneruserid();
        //设置 道具来源信息 默认值
        $this->_set_defaultvalue_itemFromInfo();

    }
}