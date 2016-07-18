<?php

namespace dbs\templates\mall;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_goodsMallNormalInfo
 * @package dbs\templates\mall
 */
class dbs_templates_mall_goodsMallNormalInfo extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.goodsMallNormalInfo" );
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
     * 描述
     *
     * @var
     */
    const DBKey_description = "description";

	/**
	 * 获取 描述
	 * @return string
	 */
	public function get_description()
	{
		return $this->getdata ( self::DBKey_description );
	}

	/**
	 * 设置 描述
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_description($value)
	{
		$this->setdata ( self::DBKey_description, strval($value) );
		return $this;
	}

	/**
     * 重置 描述
     * 设置为 ""
     * @return $this
     */
    public function reset_description()
    {
        return $this->reset_defaultValue(self::DBKey_description);
    }

    /**
     * 设置 描述 默认值
     */
    protected function _set_defaultvalue_description()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_description, "" );
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
        //设置 描述 默认值
        $this->_set_defaultvalue_description();

    }
}