<?php

namespace dbs\templates\custom\eatDishes;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_custom_eatDishes_offlineEatData
 * @package dbs\templates\custom\eatDishes
 */
class dbs_templates_custom_eatDishes_offlineEatData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "custom.eatDishes.offlineEatData" );
    }
    /**
     * 离线吃饭开始时间
     *
     * @var
     */
    const DBKey_startTime = "startTime";

	/**
	 * 获取 离线吃饭开始时间
	 * @return int
	 */
	public function get_startTime()
	{
		return $this->getdata ( self::DBKey_startTime );
	}

	/**
	 * 设置 离线吃饭开始时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_startTime($value)
	{
		$this->setdata ( self::DBKey_startTime, intval($value) );
		return $this;
	}

	/**
     * 重置 离线吃饭开始时间
     * 设置为 0
     * @return $this
     */
    public function reset_startTime()
    {
        return $this->reset_defaultValue(self::DBKey_startTime);
    }

    /**
     * 设置 离线吃饭开始时间 默认值
     */
    protected function _set_defaultvalue_startTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_startTime, 0 );
    }
    /**
     * 离线吃饭结束时间
     *
     * @var
     */
    const DBKey_endTime = "endTime";

	/**
	 * 获取 离线吃饭结束时间
	 * @return int
	 */
	public function get_endTime()
	{
		return $this->getdata ( self::DBKey_endTime );
	}

	/**
	 * 设置 离线吃饭结束时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_endTime($value)
	{
		$this->setdata ( self::DBKey_endTime, intval($value) );
		return $this;
	}

	/**
     * 重置 离线吃饭结束时间
     * 设置为 0
     * @return $this
     */
    public function reset_endTime()
    {
        return $this->reset_defaultValue(self::DBKey_endTime);
    }

    /**
     * 设置 离线吃饭结束时间 默认值
     */
    protected function _set_defaultvalue_endTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_endTime, 0 );
    }
    /**
     * 离线出售份数
     *
     * @var
     */
    const DBKey_pieces = "pieces";

	/**
	 * 获取 离线出售份数
	 * @return int
	 */
	public function get_pieces()
	{
		return $this->getdata ( self::DBKey_pieces );
	}

	/**
	 * 设置 离线出售份数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_pieces($value)
	{
		$this->setdata ( self::DBKey_pieces, intval($value) );
		return $this;
	}

	/**
     * 重置 离线出售份数
     * 设置为 0
     * @return $this
     */
    public function reset_pieces()
    {
        return $this->reset_defaultValue(self::DBKey_pieces);
    }

    /**
     * 设置 离线出售份数 默认值
     */
    protected function _set_defaultvalue_pieces()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_pieces, 0 );
    }
    /**
     * 赚取的游戏币
     *
     * @var
     */
    const DBKey_earnGameCoin = "earnGameCoin";

	/**
	 * 获取 赚取的游戏币
	 * @return int
	 */
	public function get_earnGameCoin()
	{
		return $this->getdata ( self::DBKey_earnGameCoin );
	}

	/**
	 * 设置 赚取的游戏币
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_earnGameCoin($value)
	{
		$this->setdata ( self::DBKey_earnGameCoin, intval($value) );
		return $this;
	}

	/**
     * 重置 赚取的游戏币
     * 设置为 0
     * @return $this
     */
    public function reset_earnGameCoin()
    {
        return $this->reset_defaultValue(self::DBKey_earnGameCoin);
    }

    /**
     * 设置 赚取的游戏币 默认值
     */
    protected function _set_defaultvalue_earnGameCoin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_earnGameCoin, 0 );
    }
    /**
     * 赚取的小费
     *
     * @var
     */
    const DBKey_earnTipGameCoin = "earnTipGameCoin";

	/**
	 * 获取 赚取的小费
	 * @return int
	 */
	public function get_earnTipGameCoin()
	{
		return $this->getdata ( self::DBKey_earnTipGameCoin );
	}

	/**
	 * 设置 赚取的小费
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_earnTipGameCoin($value)
	{
		$this->setdata ( self::DBKey_earnTipGameCoin, intval($value) );
		return $this;
	}

	/**
     * 重置 赚取的小费
     * 设置为 0
     * @return $this
     */
    public function reset_earnTipGameCoin()
    {
        return $this->reset_defaultValue(self::DBKey_earnTipGameCoin);
    }

    /**
     * 设置 赚取的小费 默认值
     */
    protected function _set_defaultvalue_earnTipGameCoin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_earnTipGameCoin, 0 );
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
        //设置 离线吃饭开始时间 默认值
        $this->_set_defaultvalue_startTime();
        //设置 离线吃饭结束时间 默认值
        $this->_set_defaultvalue_endTime();
        //设置 离线出售份数 默认值
        $this->_set_defaultvalue_pieces();
        //设置 赚取的游戏币 默认值
        $this->_set_defaultvalue_earnGameCoin();
        //设置 赚取的小费 默认值
        $this->_set_defaultvalue_earnTipGameCoin();

    }
}