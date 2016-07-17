<?php

namespace dbs\templates\disheshandbook;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_disheshandbook_handbookData
 * @package dbs\templates\disheshandbook
 */
class dbs_templates_disheshandbook_handbookData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "disheshandbook.handbookData" );
    }
    /**
     * 图鉴菜品ID
     *
     * @var
     */
    const DBKey_dishesId = "dishesId";

	/**
	 * 获取 图鉴菜品ID
	 * @return int
	 */
	public function get_dishesId()
	{
		return $this->getdata ( self::DBKey_dishesId );
	}

	/**
	 * 设置 图鉴菜品ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_dishesId($value)
	{
		$this->setdata ( self::DBKey_dishesId, intval($value) );
		return $this;
	}

	/**
     * 重置 图鉴菜品ID
     * 设置为 0
     * @return $this
     */
    public function reset_dishesId()
    {
        return $this->reset_defaultValue(self::DBKey_dishesId);
    }

    /**
     * 设置 图鉴菜品ID 默认值
     */
    protected function _set_defaultvalue_dishesId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_dishesId, 0 );
    }
    /**
     * 烹饪了多少次
     *
     * @var
     */
    const DBKey_cooktimes = "cooktimes";

	/**
	 * 获取 烹饪了多少次
	 * @return int
	 */
	public function get_cooktimes()
	{
		return $this->getdata ( self::DBKey_cooktimes );
	}

	/**
	 * 设置 烹饪了多少次
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_cooktimes($value)
	{
		$this->setdata ( self::DBKey_cooktimes, intval($value) );
		return $this;
	}

	/**
     * 重置 烹饪了多少次
     * 设置为 0
     * @return $this
     */
    public function reset_cooktimes()
    {
        return $this->reset_defaultValue(self::DBKey_cooktimes);
    }

    /**
     * 设置 烹饪了多少次 默认值
     */
    protected function _set_defaultvalue_cooktimes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cooktimes, 0 );
    }
    /**
     * 是否已经完成了图鉴
     *
     * @var
     */
    const DBKey_isComplete = "isComplete";

	/**
	 * 获取 是否已经完成了图鉴
	 * @return bool
	 */
	public function get_isComplete()
	{
		return $this->getdata ( self::DBKey_isComplete );
	}

	/**
	 * 设置 是否已经完成了图鉴
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isComplete($value)
	{
		$this->setdata ( self::DBKey_isComplete, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否已经完成了图鉴
     * 设置为 false
     * @return $this
     */
    public function reset_isComplete()
    {
        return $this->reset_defaultValue(self::DBKey_isComplete);
    }

    /**
     * 设置 是否已经完成了图鉴 默认值
     */
    protected function _set_defaultvalue_isComplete()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isComplete, false );
    }
    /**
     * 完成图鉴的时间
     *
     * @var
     */
    const DBKey_completeTimespan = "completeTimespan";

	/**
	 * 获取 完成图鉴的时间
	 * @return int
	 */
	public function get_completeTimespan()
	{
		return $this->getdata ( self::DBKey_completeTimespan );
	}

	/**
	 * 设置 完成图鉴的时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_completeTimespan($value)
	{
		$this->setdata ( self::DBKey_completeTimespan, intval($value) );
		return $this;
	}

	/**
     * 重置 完成图鉴的时间
     * 设置为 0
     * @return $this
     */
    public function reset_completeTimespan()
    {
        return $this->reset_defaultValue(self::DBKey_completeTimespan);
    }

    /**
     * 设置 完成图鉴的时间 默认值
     */
    protected function _set_defaultvalue_completeTimespan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_completeTimespan, 0 );
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
        //设置 图鉴菜品ID 默认值
        $this->_set_defaultvalue_dishesId();
        //设置 烹饪了多少次 默认值
        $this->_set_defaultvalue_cooktimes();
        //设置 是否已经完成了图鉴 默认值
        $this->_set_defaultvalue_isComplete();
        //设置 完成图鉴的时间 默认值
        $this->_set_defaultvalue_completeTimespan();

    }
}