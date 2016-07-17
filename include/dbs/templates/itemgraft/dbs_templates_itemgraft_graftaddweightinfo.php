<?php

namespace dbs\templates\itemgraft;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_itemgraft_graftaddweightinfo
 * @package dbs\templates\itemgraft
 */
class dbs_templates_itemgraft_graftaddweightinfo extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "itemgraft.graftaddweightinfo" );
    }
    /**
     * 结果的索引0-3
     *
     * @var
     */
    const DBKey_index = "index";

	/**
	 * 获取 结果的索引0-3
	 * @return int
	 */
	public function get_index()
	{
		return $this->getdata ( self::DBKey_index );
	}

	/**
	 * 设置 结果的索引0-3
	 *
	 * @param int $value
	 * @return $this
	 */
	protected function set_index($value)
	{
		$this->setdata ( self::DBKey_index, intval($value) );
		return $this;
	}

	/**
     * 重置 结果的索引0-3
     * 设置为 0
     * @return $this
     */
    public function reset_index()
    {
        return $this->reset_defaultValue(self::DBKey_index);
    }

    /**
     * 设置 结果的索引0-3 默认值
     */
    protected function _set_defaultvalue_index()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_index, 0 );
    }
    /**
     * 原始权重
     *
     * @var
     */
    const DBKey_originWeight = "originWeight";

	/**
	 * 获取 原始权重
	 * @return int
	 */
	public function get_originWeight()
	{
		return $this->getdata ( self::DBKey_originWeight );
	}

	/**
	 * 设置 原始权重
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_originWeight($value)
	{
		$this->setdata ( self::DBKey_originWeight, intval($value) );
		return $this;
	}

	/**
     * 重置 原始权重
     * 设置为 0
     * @return $this
     */
    public function reset_originWeight()
    {
        return $this->reset_defaultValue(self::DBKey_originWeight);
    }

    /**
     * 设置 原始权重 默认值
     */
    protected function _set_defaultvalue_originWeight()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_originWeight, 0 );
    }
    /**
     * 当前的权重
     *
     * @var
     */
    const DBKey_weight = "weight";

	/**
	 * 获取 当前的权重
	 * @return int
	 */
	public function get_weight()
	{
		return $this->getdata ( self::DBKey_weight );
	}

	/**
	 * 设置 当前的权重
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_weight($value)
	{
		$this->setdata ( self::DBKey_weight, intval($value) );
		return $this;
	}

	/**
     * 重置 当前的权重
     * 设置为 0
     * @return $this
     */
    public function reset_weight()
    {
        return $this->reset_defaultValue(self::DBKey_weight);
    }

    /**
     * 设置 当前的权重 默认值
     */
    protected function _set_defaultvalue_weight()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_weight, 0 );
    }
    /**
     * 添加药水历史信息
     *
     * @var
     */
    const DBKey_history = "history";

	/**
	 * 获取 添加药水历史信息
	 * @return array
	 */
	public function get_history()
	{
		return $this->getdata ( self::DBKey_history );
	}

	/**
	 * 设置 添加药水历史信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_history($value)
	{
		$this->setdata ( self::DBKey_history, $value );
		return $this;
	}

	/**
     * 重置 添加药水历史信息
     * 设置为 []
     * @return $this
     */
    public function reset_history()
    {
        return $this->reset_defaultValue(self::DBKey_history);
    }

    /**
     * 设置 添加药水历史信息 默认值
     */
    protected function _set_defaultvalue_history()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_history, [] );
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
        //设置 结果的索引0-3 默认值
        $this->_set_defaultvalue_index();
        //设置 原始权重 默认值
        $this->_set_defaultvalue_originWeight();
        //设置 当前的权重 默认值
        $this->_set_defaultvalue_weight();
        //设置 添加药水历史信息 默认值
        $this->_set_defaultvalue_history();

    }
}