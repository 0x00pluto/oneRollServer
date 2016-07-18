<?php

namespace dbs\templates\mall;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_onlineGoods
 * @package dbs\templates\mall
 */
abstract class dbs_templates_mall_onlineGoods extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "mall_onlineGoods";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.onlineGoods" );
    }
    /**
     * 商品ID
     *
     * @var
     */
    const DBKey_id = "id";

	/**
	 * 获取 商品ID
	 * @return string
	 */
	public function get_id()
	{
		return $this->getdata ( self::DBKey_id );
	}

	/**
	 * 设置 商品ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_id($value)
	{
		$this->setdata ( self::DBKey_id, strval($value) );
		return $this;
	}

	/**
     * 重置 商品ID
     * 设置为 ""
     * @return $this
     */
    public function reset_id()
    {
        return $this->reset_defaultValue(self::DBKey_id);
    }

    /**
     * 设置 商品ID 默认值
     */
    protected function _set_defaultvalue_id()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_id, "" );
    }
    /**
     * 商品数据
     *
     * @var
     */
    const DBKey_mallGoodsData = "mallGoodsData";

	/**
	 * 获取 商品数据
	 * @return array
	 */
	public function get_mallGoodsData()
	{
		return $this->getdata ( self::DBKey_mallGoodsData );
	}

	/**
	 * 设置 商品数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_mallGoodsData($value)
	{
		$this->setdata ( self::DBKey_mallGoodsData, $value );
		return $this;
	}

	/**
     * 重置 商品数据
     * 设置为 []
     * @return $this
     */
    public function reset_mallGoodsData()
    {
        return $this->reset_defaultValue(self::DBKey_mallGoodsData);
    }

    /**
     * 设置 商品数据 默认值
     */
    protected function _set_defaultvalue_mallGoodsData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mallGoodsData, [] );
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
        //设置 商品ID 默认值
        $this->_set_defaultvalue_id();
        //设置 商品数据 默认值
        $this->_set_defaultvalue_mallGoodsData();

    }
}