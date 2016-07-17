<?php

namespace dbs\templates\neighbourhood;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_neighbourhood_playerdata
 * @package dbs\templates\neighbourhood
 */
abstract class dbs_templates_neighbourhood_playerdata extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "neighbourhood_playerdata";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "neighbourhood.playerdata" );
    }
    /**
     * 群组id
     *
     * @var
     */
    const DBKey_groupid = "groupid";

	/**
	 * 获取 群组id
	 * @return string
	 */
	public function get_groupid()
	{
		return $this->getdata ( self::DBKey_groupid );
	}

	/**
	 * 设置 群组id
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
     * 重置 群组id
     * 设置为 ""
     * @return $this
     */
    public function reset_groupid()
    {
        return $this->reset_defaultValue(self::DBKey_groupid);
    }

    /**
     * 设置 群组id 默认值
     */
    protected function _set_defaultvalue_groupid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_groupid, "" );
    }
    /**
     * 发红包数据
     *
     * @var
     */
    const DBKey_sendgift = "sendgift";

	/**
	 * 获取 发红包数据
	 * @return array
	 */
	public function get_sendgift()
	{
		return $this->getdata ( self::DBKey_sendgift );
	}

	/**
	 * 设置 发红包数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_sendgift($value)
	{
		$this->setdata ( self::DBKey_sendgift, $value );
		return $this;
	}

	/**
     * 重置 发红包数据
     * 设置为 []
     * @return $this
     */
    public function reset_sendgift()
    {
        return $this->reset_defaultValue(self::DBKey_sendgift);
    }

    /**
     * 设置 发红包数据 默认值
     */
    protected function _set_defaultvalue_sendgift()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sendgift, [] );
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
        $this->_set_defaultvalue_groupid();
        //设置 发红包数据 默认值
        $this->_set_defaultvalue_sendgift();

    }
}