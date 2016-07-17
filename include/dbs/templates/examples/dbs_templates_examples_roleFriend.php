<?php

namespace dbs\templates\examples;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_examples_roleFriend
 * @package dbs\templates\examples
 */
class dbs_templates_examples_roleFriend extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "examples.roleFriend" );
    }
    /**
     * 用户名
     *
     * @var
     */
    const DBKey_roleName = "roleName";

	/**
	 * 获取 用户名
	 * @return string
	 */
	public function get_roleName()
	{
		return $this->getdata ( self::DBKey_roleName );
	}

	/**
	 * 设置 用户名
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_roleName($value)
	{
		$this->setdata ( self::DBKey_roleName, strval($value) );
		return $this;
	}

	/**
     * 重置 用户名
     * 设置为 "a"
     * @return $this
     */
    public function reset_roleName()
    {
        return $this->reset_defaultValue(self::DBKey_roleName);
    }

    /**
     * 设置 用户名 默认值
     */
    protected function _set_defaultvalue_roleName()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_roleName, "a" );
    }
    /**
     * 用户ID
     *
     * @var
     */
    const DBKey_UserId = "UserId";

	/**
	 * 获取 用户ID
	 * @return string
	 */
	public function get_UserId()
	{
		return $this->getdata ( self::DBKey_UserId );
	}

	/**
	 * 设置 用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_UserId($value)
	{
		$this->setdata ( self::DBKey_UserId, strval($value) );
		return $this;
	}

	/**
     * 重置 用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_UserId()
    {
        return $this->reset_defaultValue(self::DBKey_UserId);
    }

    /**
     * 设置 用户ID 默认值
     */
    protected function _set_defaultvalue_UserId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_UserId, "" );
    }
    /**
     * 是否是新用户
     *
     * @var
     */
    const DBKey_isNew = "isNew";

	/**
	 * 获取 是否是新用户
	 * @return bool
	 */
	public function get_isNew()
	{
		return $this->getdata ( self::DBKey_isNew );
	}

	/**
	 * 设置 是否是新用户
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isNew($value)
	{
		$this->setdata ( self::DBKey_isNew, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否是新用户
     * 设置为 false
     * @return $this
     */
    public function reset_isNew()
    {
        return $this->reset_defaultValue(self::DBKey_isNew);
    }

    /**
     * 设置 是否是新用户 默认值
     */
    protected function _set_defaultvalue_isNew()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isNew, false );
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
        //设置 用户名 默认值
        $this->_set_defaultvalue_roleName();
        //设置 用户ID 默认值
        $this->_set_defaultvalue_UserId();
        //设置 是否是新用户 默认值
        $this->_set_defaultvalue_isNew();

    }
}