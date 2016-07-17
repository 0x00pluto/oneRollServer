<?php

namespace dbs\templates\friendhelp;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_friendhelp_helpDetailData
 * @package dbs\templates\friendhelp
 */
class dbs_templates_friendhelp_helpDetailData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "friendhelp.helpDetailData" );
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
     * 帮忙时间
     *
     * @var
     */
    const DBKey_helpTimespan = "helpTimespan";

	/**
	 * 获取 帮忙时间
	 * @return int
	 */
	public function get_helpTimespan()
	{
		return $this->getdata ( self::DBKey_helpTimespan );
	}

	/**
	 * 设置 帮忙时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_helpTimespan($value)
	{
		$this->setdata ( self::DBKey_helpTimespan, intval($value) );
		return $this;
	}

	/**
     * 重置 帮忙时间
     * 设置为 0
     * @return $this
     */
    public function reset_helpTimespan()
    {
        return $this->reset_defaultValue(self::DBKey_helpTimespan);
    }

    /**
     * 设置 帮忙时间 默认值
     */
    protected function _set_defaultvalue_helpTimespan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpTimespan, 0 );
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
        //设置 帮忙时间 默认值
        $this->_set_defaultvalue_helpTimespan();
        //设置 帮忙次数 默认值
        $this->_set_defaultvalue_helpTimes();

    }
}