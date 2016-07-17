<?php

namespace dbs\templates\neighbourhood;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_neighbourhood_groupbulletinboard
 * @package dbs\templates\neighbourhood
 */
abstract class dbs_templates_neighbourhood_groupbulletinboard extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "neighbourhood_bulletinboards";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "neighbourhood.groupbulletinboard" );
    }
    /**
     * 群组id
     *
     * @var
     */
    const DBKey_guid = "guid";

	/**
	 * 获取 群组id
	 * @return string
	 */
	public function get_guid()
	{
		return $this->getdata ( self::DBKey_guid );
	}

	/**
	 * 设置 群组id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_guid($value)
	{
		$this->setdata ( self::DBKey_guid, strval($value) );
		return $this;
	}

	/**
     * 重置 群组id
     * 设置为 ""
     * @return $this
     */
    public function reset_guid()
    {
        return $this->reset_defaultValue(self::DBKey_guid);
    }

    /**
     * 设置 群组id 默认值
     */
    protected function _set_defaultvalue_guid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_guid, "" );
    }
    /**
     * 公告数据
     *
     * @var
     */
    const DBKey_bulletinDatas = "bulletinDatas";

	/**
	 * 获取 公告数据
	 * @return array
	 */
	public function get_bulletinDatas()
	{
		return $this->getdata ( self::DBKey_bulletinDatas );
	}

	/**
	 * 设置 公告数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_bulletinDatas($value)
	{
		$this->setdata ( self::DBKey_bulletinDatas, $value );
		return $this;
	}

	/**
     * 重置 公告数据
     * 设置为 []
     * @return $this
     */
    public function reset_bulletinDatas()
    {
        return $this->reset_defaultValue(self::DBKey_bulletinDatas);
    }

    /**
     * 设置 公告数据 默认值
     */
    protected function _set_defaultvalue_bulletinDatas()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_bulletinDatas, [] );
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
        //设置 群组id 默认值
        $this->_set_defaultvalue_guid();
        //设置 公告数据 默认值
        $this->_set_defaultvalue_bulletinDatas();

    }
}