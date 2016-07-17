<?php

namespace dbs\templates\shop;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_shop_player
 * @package dbs\templates\shop
 */
abstract class dbs_templates_shop_player extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "shop_players";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "shop.player" );
    }
    /**
     * 商品信息
     *
     * @var
     */
    const DBKey_mallDatas = "mallDatas";

	/**
	 * 获取 商品信息
	 * @return array
	 */
	public function get_mallDatas()
	{
		return $this->getdata ( self::DBKey_mallDatas );
	}

	/**
	 * 设置 商品信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_mallDatas($value)
	{
		$this->setdata ( self::DBKey_mallDatas, $value );
		return $this;
	}

	/**
     * 重置 商品信息
     * 设置为 []
     * @return $this
     */
    public function reset_mallDatas()
    {
        return $this->reset_defaultValue(self::DBKey_mallDatas);
    }

    /**
     * 设置 商品信息 默认值
     */
    protected function _set_defaultvalue_mallDatas()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mallDatas, [] );
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
        //设置 商品信息 默认值
        $this->_set_defaultvalue_mallDatas();

    }
}