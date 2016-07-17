<?php

namespace dbs\templates\neighbourhood;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_neighbourhood_joinlistdata
 * @package dbs\templates\neighbourhood
 */
class dbs_templates_neighbourhood_joinlistdata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "neighbourhood.joinlistdata" );
    }
    /**
     * 组id
     *
     * @var
     */
    const DBKey_groupid = "groupid";

	/**
	 * 获取 组id
	 * @return string
	 */
	public function get_groupid()
	{
		return $this->getdata ( self::DBKey_groupid );
	}

	/**
	 * 设置 组id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_groupid($value)
	{
		$this->setdata ( self::DBKey_groupid, strval($value) );
		return $this;
	}

	/**
     * 重置 组id
     * 设置为 ""
     * @return $this
     */
    public function reset_groupid()
    {
        return $this->reset_defaultValue(self::DBKey_groupid);
    }

    /**
     * 设置 组id 默认值
     */
    protected function _set_defaultvalue_groupid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_groupid, "" );
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
        //设置 组id 默认值
        $this->_set_defaultvalue_groupid();

    }
}