<?php

namespace dbs\templates\examples;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_examples_role
 * @package dbs\templates\examples
 */
abstract class dbs_templates_examples_role extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "examples.role" );
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
    const DBKey_UserId1 = "UserId1";

	/**
	 * 获取 用户ID
	 * @return int
	 */
	public function get_UserId1()
	{
		return $this->getdata ( self::DBKey_UserId1 );
	}

	/**
	 * 设置 用户ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_UserId1($value)
	{
		$this->setdata ( self::DBKey_UserId1, intval($value) );
		return $this;
	}

	/**
     * 重置 用户ID
     * 设置为 2
     * @return $this
     */
    public function reset_UserId1()
    {
        return $this->reset_defaultValue(self::DBKey_UserId1);
    }

    /**
     * 设置 用户ID 默认值
     */
    protected function _set_defaultvalue_UserId1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_UserId1, 2 );
    }
    /**
     * 用户好友
     *
     * @var
     */
    const DBKey_Friends = "Friends";

	/**
	 * 获取 用户好友
	 * @return array
	 */
	public function get_Friends()
	{
		return $this->getdata ( self::DBKey_Friends );
	}

	/**
	 * 设置 用户好友
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_Friends($value)
	{
		$this->setdata ( self::DBKey_Friends, $value );
		return $this;
	}

	/**
     * 重置 用户好友
     * 设置为 []
     * @return $this
     */
    public function reset_Friends()
    {
        return $this->reset_defaultValue(self::DBKey_Friends);
    }

    /**
     * 设置 用户好友 默认值
     */
    protected function _set_defaultvalue_Friends()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_Friends, [] );
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
        $this->_set_defaultvalue_UserId1();
        //设置 用户好友 默认值
        $this->_set_defaultvalue_Friends();
        //设置 是否是新用户 默认值
        $this->_set_defaultvalue_isNew();

    }
}