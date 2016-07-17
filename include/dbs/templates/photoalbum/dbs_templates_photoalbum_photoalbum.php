<?php

namespace dbs\templates\photoalbum;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_photoalbum_photoalbum
 * @package dbs\templates\photoalbum
 */
abstract class dbs_templates_photoalbum_photoalbum extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "photoalbum";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "photoalbum.photoalbum" );
    }
    /**
     * 用户相册
     *
     * @var
     */
    const DBKey_albumlist = "albumlist";

	/**
	 * 获取 用户相册
	 * @return array
	 */
	public function get_albumlist()
	{
		return $this->getdata ( self::DBKey_albumlist );
	}

	/**
	 * 设置 用户相册
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_albumlist($value)
	{
		$this->setdata ( self::DBKey_albumlist, $value );
		return $this;
	}

	/**
     * 重置 用户相册
     * 设置为 []
     * @return $this
     */
    public function reset_albumlist()
    {
        return $this->reset_defaultValue(self::DBKey_albumlist);
    }

    /**
     * 设置 用户相册 默认值
     */
    protected function _set_defaultvalue_albumlist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_albumlist, [] );
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
        //设置 用户相册 默认值
        $this->_set_defaultvalue_albumlist();

    }
}