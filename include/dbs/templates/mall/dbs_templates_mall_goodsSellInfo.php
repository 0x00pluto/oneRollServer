<?php

namespace dbs\templates\mall;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_goodsSellInfo
 * @package dbs\templates\mall
 */
abstract class dbs_templates_mall_goodsSellInfo extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.goodsSellInfo" );
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
     * 已经售出的数量
     *
     * @var
     */
    const DBKey_sellcount = "sellcount";

	/**
	 * 获取 已经售出的数量
	 * @return int
	 */
	public function get_sellcount()
	{
		return $this->getdata ( self::DBKey_sellcount );
	}

	/**
	 * 设置 已经售出的数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_sellcount($value)
	{
		$this->setdata ( self::DBKey_sellcount, intval($value) );
		return $this;
	}

	/**
     * 重置 已经售出的数量
     * 设置为 0
     * @return $this
     */
    public function reset_sellcount()
    {
        return $this->reset_defaultValue(self::DBKey_sellcount);
    }

    /**
     * 设置 已经售出的数量 默认值
     */
    protected function _set_defaultvalue_sellcount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sellcount, 0 );
    }
    /**
     * 出售详情
     *
     * @var
     */
    const DBKey_sellDetails = "sellDetails";

	/**
	 * 获取 出售详情
	 * @return array
	 */
	public function get_sellDetails()
	{
		return $this->getdata ( self::DBKey_sellDetails );
	}

	/**
	 * 设置 出售详情
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_sellDetails($value)
	{
		$this->setdata ( self::DBKey_sellDetails, $value );
		return $this;
	}

	/**
     * 重置 出售详情
     * 设置为 []
     * @return $this
     */
    public function reset_sellDetails()
    {
        return $this->reset_defaultValue(self::DBKey_sellDetails);
    }

    /**
     * 设置 出售详情 默认值
     */
    protected function _set_defaultvalue_sellDetails()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sellDetails, [] );
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
        //设置 已经售出的数量 默认值
        $this->_set_defaultvalue_sellcount();
        //设置 出售详情 默认值
        $this->_set_defaultvalue_sellDetails();

    }
}