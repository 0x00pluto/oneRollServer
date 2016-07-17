<?php

namespace dbs\templates\chef;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_vitdata
 * @package dbs\templates\chef
 */
class dbs_templates_chef_vitdata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.vitdata" );
    }
    /**
     * 厨师体力
     *
     * @var
     */
    const DBKey_vit = "vit";

	/**
	 * 获取 厨师体力
	 * @return int
	 */
	public function get_vit()
	{
		return $this->getdata ( self::DBKey_vit );
	}

	/**
	 * 设置 厨师体力
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_vit($value)
	{
		$this->setdata ( self::DBKey_vit, intval($value) );
		return $this;
	}

	/**
     * 重置 厨师体力
     * 设置为 0
     * @return $this
     */
    public function reset_vit()
    {
        return $this->reset_defaultValue(self::DBKey_vit);
    }

    /**
     * 设置 厨师体力 默认值
     */
    protected function _set_defaultvalue_vit()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_vit, 0 );
    }
    /**
     * 体力上限
     *
     * @var
     */
    const DBKey_vitmax = "vitmax";

	/**
	 * 获取 体力上限
	 * @return int
	 */
	public function get_vitmax()
	{
		return $this->getdata ( self::DBKey_vitmax );
	}

	/**
	 * 设置 体力上限
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_vitmax($value)
	{
		$this->setdata ( self::DBKey_vitmax, intval($value) );
		return $this;
	}

	/**
     * 重置 体力上限
     * 设置为 0
     * @return $this
     */
    public function reset_vitmax()
    {
        return $this->reset_defaultValue(self::DBKey_vitmax);
    }

    /**
     * 设置 体力上限 默认值
     */
    protected function _set_defaultvalue_vitmax()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_vitmax, 0 );
    }
    /**
     * 今日厨师补充体力次数
     *
     * @var
     */
    const DBKey_todayfillvitcount = "todayfillvitcount";

	/**
	 * 获取 今日厨师补充体力次数
	 * @return int
	 */
	public function get_todayfillvitcount()
	{
		return $this->getdata ( self::DBKey_todayfillvitcount );
	}

	/**
	 * 设置 今日厨师补充体力次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_todayfillvitcount($value)
	{
		$this->setdata ( self::DBKey_todayfillvitcount, intval($value) );
		return $this;
	}

	/**
     * 重置 今日厨师补充体力次数
     * 设置为 0
     * @return $this
     */
    public function reset_todayfillvitcount()
    {
        return $this->reset_defaultValue(self::DBKey_todayfillvitcount);
    }

    /**
     * 设置 今日厨师补充体力次数 默认值
     */
    protected function _set_defaultvalue_todayfillvitcount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_todayfillvitcount, 0 );
    }
    /**
     * 上次补充体力的日期
     *
     * @var
     */
    const DBKey_lastfillvitday = "lastfillvitday";

	/**
	 * 获取 上次补充体力的日期
	 * @return int
	 */
	public function get_lastfillvitday()
	{
		return $this->getdata ( self::DBKey_lastfillvitday );
	}

	/**
	 * 设置 上次补充体力的日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_lastfillvitday($value)
	{
		$this->setdata ( self::DBKey_lastfillvitday, intval($value) );
		return $this;
	}

	/**
     * 重置 上次补充体力的日期
     * 设置为 0
     * @return $this
     */
    public function reset_lastfillvitday()
    {
        return $this->reset_defaultValue(self::DBKey_lastfillvitday);
    }

    /**
     * 设置 上次补充体力的日期 默认值
     */
    protected function _set_defaultvalue_lastfillvitday()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastfillvitday, 0 );
    }
    /**
     * 上次补充体力的自然增长时间
     *
     * @var
     */
    const DBKey_lastfillvittime = "lastfillvittime";

	/**
	 * 获取 上次补充体力的自然增长时间
	 * @return int
	 */
	public function get_lastfillvittime()
	{
		return $this->getdata ( self::DBKey_lastfillvittime );
	}

	/**
	 * 设置 上次补充体力的自然增长时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_lastfillvittime($value)
	{
		$this->setdata ( self::DBKey_lastfillvittime, intval($value) );
		return $this;
	}

	/**
     * 重置 上次补充体力的自然增长时间
     * 设置为 0
     * @return $this
     */
    public function reset_lastfillvittime()
    {
        return $this->reset_defaultValue(self::DBKey_lastfillvittime);
    }

    /**
     * 设置 上次补充体力的自然增长时间 默认值
     */
    protected function _set_defaultvalue_lastfillvittime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastfillvittime, 0 );
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
        //设置 厨师体力 默认值
        $this->_set_defaultvalue_vit();
        //设置 体力上限 默认值
        $this->_set_defaultvalue_vitmax();
        //设置 今日厨师补充体力次数 默认值
        $this->_set_defaultvalue_todayfillvitcount();
        //设置 上次补充体力的日期 默认值
        $this->_set_defaultvalue_lastfillvitday();
        //设置 上次补充体力的自然增长时间 默认值
        $this->_set_defaultvalue_lastfillvittime();

    }
}