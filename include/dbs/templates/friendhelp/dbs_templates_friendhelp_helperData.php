<?php

namespace dbs\templates\friendhelp;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_friendhelp_helperData
 * @package dbs\templates\friendhelp
 */
class dbs_templates_friendhelp_helperData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "friendhelp.helperData" );
    }
    /**
     * 帮忙者用户ID
     *
     * @var
     */
    const DBKey_userid = "userid";

	/**
	 * 获取 帮忙者用户ID
	 * @return string
	 */
	public function get_userid()
	{
		return $this->getdata ( self::DBKey_userid );
	}

	/**
	 * 设置 帮忙者用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_userid($value)
	{
		$this->setdata ( self::DBKey_userid, strval($value) );
		return $this;
	}

	/**
     * 重置 帮忙者用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_userid()
    {
        return $this->reset_defaultValue(self::DBKey_userid);
    }

    /**
     * 设置 帮忙者用户ID 默认值
     */
    protected function _set_defaultvalue_userid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userid, "" );
    }
    /**
     * 用户信息
     *
     * @var
     */
    const DBKey_userinfo = "userinfo";

	/**
	 * 获取 用户信息
	 * @return array
	 */
	public function get_userinfo()
	{
		return $this->getdata ( self::DBKey_userinfo );
	}

	/**
	 * 设置 用户信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_userinfo($value)
	{
		$this->setdata ( self::DBKey_userinfo, $value );
		return $this;
	}

	/**
     * 重置 用户信息
     * 设置为 []
     * @return $this
     */
    public function reset_userinfo()
    {
        return $this->reset_defaultValue(self::DBKey_userinfo);
    }

    /**
     * 设置 用户信息 默认值
     */
    protected function _set_defaultvalue_userinfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userinfo, [] );
    }
    /**
     * 帮忙次数
     *
     * @var
     */
    const DBKey_helpTimes = "helpTimes";

	/**
	 * 获取 帮忙次数
	 * @return int
	 */
	public function get_helpTimes()
	{
		return $this->getdata ( self::DBKey_helpTimes );
	}

	/**
	 * 设置 帮忙次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_helpTimes($value)
	{
		$this->setdata ( self::DBKey_helpTimes, intval($value) );
		return $this;
	}

	/**
     * 重置 帮忙次数
     * 设置为 0
     * @return $this
     */
    public function reset_helpTimes()
    {
        return $this->reset_defaultValue(self::DBKey_helpTimes);
    }

    /**
     * 设置 帮忙次数 默认值
     */
    protected function _set_defaultvalue_helpTimes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpTimes, 0 );
    }
    /**
     * 帮忙细节数据
     *
     * @var
     */
    const DBKey_helpDetails = "helpDetails";

	/**
	 * 获取 帮忙细节数据
	 * @return array
	 */
	public function get_helpDetails()
	{
		return $this->getdata ( self::DBKey_helpDetails );
	}

	/**
	 * 设置 帮忙细节数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_helpDetails($value)
	{
		$this->setdata ( self::DBKey_helpDetails, $value );
		return $this;
	}

	/**
     * 重置 帮忙细节数据
     * 设置为 []
     * @return $this
     */
    public function reset_helpDetails()
    {
        return $this->reset_defaultValue(self::DBKey_helpDetails);
    }

    /**
     * 设置 帮忙细节数据 默认值
     */
    protected function _set_defaultvalue_helpDetails()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpDetails, [] );
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
        //设置 帮忙者用户ID 默认值
        $this->_set_defaultvalue_userid();
        //设置 用户信息 默认值
        $this->_set_defaultvalue_userinfo();
        //设置 帮忙次数 默认值
        $this->_set_defaultvalue_helpTimes();
        //设置 帮忙细节数据 默认值
        $this->_set_defaultvalue_helpDetails();

    }
}