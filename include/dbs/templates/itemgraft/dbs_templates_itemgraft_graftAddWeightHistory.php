<?php

namespace dbs\templates\itemgraft;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_itemgraft_graftAddWeightHistory
 * @package dbs\templates\itemgraft
 */
class dbs_templates_itemgraft_graftAddWeightHistory extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "itemgraft.graftAddWeightHistory" );
    }
    /**
     * 用户id
     *
     * @var
     */
    const DBKey_userid = "userid";

	/**
	 * 获取 用户id
	 * @return string
	 */
	public function get_userid()
	{
		return $this->getdata ( self::DBKey_userid );
	}

	/**
	 * 设置 用户id
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
     * 重置 用户id
     * 设置为 ""
     * @return $this
     */
    public function reset_userid()
    {
        return $this->reset_defaultValue(self::DBKey_userid);
    }

    /**
     * 设置 用户id 默认值
     */
    protected function _set_defaultvalue_userid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userid, "" );
    }
    /**
     * 添加日期
     *
     * @var
     */
    const DBKey_addtimespan = "addtimespan";

	/**
	 * 获取 添加日期
	 * @return int
	 */
	public function get_addtimespan()
	{
		return $this->getdata ( self::DBKey_addtimespan );
	}

	/**
	 * 设置 添加日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_addtimespan($value)
	{
		$this->setdata ( self::DBKey_addtimespan, intval($value) );
		return $this;
	}

	/**
     * 重置 添加日期
     * 设置为 0
     * @return $this
     */
    public function reset_addtimespan()
    {
        return $this->reset_defaultValue(self::DBKey_addtimespan);
    }

    /**
     * 设置 添加日期 默认值
     */
    protected function _set_defaultvalue_addtimespan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_addtimespan, 0 );
    }
    /**
     * 增加次数
     *
     * @var
     */
    const DBKey_addtimes = "addtimes";

	/**
	 * 获取 增加次数
	 * @return int
	 */
	public function get_addtimes()
	{
		return $this->getdata ( self::DBKey_addtimes );
	}

	/**
	 * 设置 增加次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_addtimes($value)
	{
		$this->setdata ( self::DBKey_addtimes, intval($value) );
		return $this;
	}

	/**
     * 重置 增加次数
     * 设置为 1
     * @return $this
     */
    public function reset_addtimes()
    {
        return $this->reset_defaultValue(self::DBKey_addtimes);
    }

    /**
     * 设置 增加次数 默认值
     */
    protected function _set_defaultvalue_addtimes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_addtimes, 1 );
    }
    /**
     * 用户信息
     *
     * @var
     */
    const DBKey_roleinfo = "roleinfo";

	/**
	 * 获取 用户信息
	 * @return array
	 */
	public function get_roleinfo()
	{
		return $this->getdata ( self::DBKey_roleinfo );
	}

	/**
	 * 设置 用户信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_roleinfo($value)
	{
		$this->setdata ( self::DBKey_roleinfo, $value );
		return $this;
	}

	/**
     * 重置 用户信息
     * 设置为 []
     * @return $this
     */
    public function reset_roleinfo()
    {
        return $this->reset_defaultValue(self::DBKey_roleinfo);
    }

    /**
     * 设置 用户信息 默认值
     */
    protected function _set_defaultvalue_roleinfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_roleinfo, [] );
    }
    /**
     * 概率变化的结果
     *
     * @var
     */
    const DBKey_resultWeights = "resultWeights";

	/**
	 * 获取 概率变化的结果
	 * @return array
	 */
	public function get_resultWeights()
	{
		return $this->getdata ( self::DBKey_resultWeights );
	}

	/**
	 * 设置 概率变化的结果
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_resultWeights($value)
	{
		$this->setdata ( self::DBKey_resultWeights, $value );
		return $this;
	}

	/**
     * 重置 概率变化的结果
     * 设置为 []
     * @return $this
     */
    public function reset_resultWeights()
    {
        return $this->reset_defaultValue(self::DBKey_resultWeights);
    }

    /**
     * 设置 概率变化的结果 默认值
     */
    protected function _set_defaultvalue_resultWeights()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_resultWeights, [] );
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
        //设置 用户id 默认值
        $this->_set_defaultvalue_userid();
        //设置 添加日期 默认值
        $this->_set_defaultvalue_addtimespan();
        //设置 增加次数 默认值
        $this->_set_defaultvalue_addtimes();
        //设置 用户信息 默认值
        $this->_set_defaultvalue_roleinfo();
        //设置 概率变化的结果 默认值
        $this->_set_defaultvalue_resultWeights();

    }
}