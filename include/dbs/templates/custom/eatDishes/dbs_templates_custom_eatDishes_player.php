<?php

namespace dbs\templates\custom\eatDishes;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_custom_eatDishes_player
 * @package dbs\templates\custom\eatDishes
 */
abstract class dbs_templates_custom_eatDishes_player extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "custom_eatDishes";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "custom.eatDishes.player" );
    }
    /**
     * 离线吃饭开始时间点
     *
     * @var
     */
    const DBKey_lastOfflineEatTime = "lastOfflineEatTime";

	/**
	 * 获取 离线吃饭开始时间点
	 * @return int
	 */
	public function get_lastOfflineEatTime()
	{
		return $this->getdata ( self::DBKey_lastOfflineEatTime );
	}

	/**
	 * 设置 离线吃饭开始时间点
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_lastOfflineEatTime($value)
	{
		$this->setdata ( self::DBKey_lastOfflineEatTime, intval($value) );
		return $this;
	}

	/**
     * 重置 离线吃饭开始时间点
     * 设置为 0
     * @return $this
     */
    public function reset_lastOfflineEatTime()
    {
        return $this->reset_defaultValue(self::DBKey_lastOfflineEatTime);
    }

    /**
     * 设置 离线吃饭开始时间点 默认值
     */
    protected function _set_defaultvalue_lastOfflineEatTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastOfflineEatTime, 0 );
    }
    /**
     * 上次离线收益数据
     *
     * @var
     */
    const DBKey_offlineEatData = "offlineEatData";

	/**
	 * 获取 上次离线收益数据
	 * @return array
	 */
	protected function get_offlineEatData()
	{
		return $this->getdata ( self::DBKey_offlineEatData );
	}

	/**
	 * 设置 上次离线收益数据
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_offlineEatData($value)
	{
		$this->setdata ( self::DBKey_offlineEatData, $value );
		return $this;
	}

	/**
     * 重置 上次离线收益数据
     * 设置为 []
     * @return $this
     */
    public function reset_offlineEatData()
    {
        return $this->reset_defaultValue(self::DBKey_offlineEatData);
    }

    /**
     * 设置 上次离线收益数据 默认值
     */
    protected function _set_defaultvalue_offlineEatData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_offlineEatData, [] );
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
        //设置 离线吃饭开始时间点 默认值
        $this->_set_defaultvalue_lastOfflineEatTime();
        //设置 上次离线收益数据 默认值
        $this->_set_defaultvalue_offlineEatData();

    }
}