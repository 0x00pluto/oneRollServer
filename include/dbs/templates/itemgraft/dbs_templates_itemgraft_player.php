<?php

namespace dbs\templates\itemgraft;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_itemgraft_player
 * @package dbs\templates\itemgraft
 */
abstract class dbs_templates_itemgraft_player extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "itemgraft";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "itemgraft.player" );
    }
    /**
     * 槽位信息
     *
     * @var
     */
    const DBKey_slots = "slots";

	/**
	 * 获取 槽位信息
	 * @return array
	 */
	public function get_slots()
	{
		return $this->getdata ( self::DBKey_slots );
	}

	/**
	 * 设置 槽位信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_slots($value)
	{
		$this->setdata ( self::DBKey_slots, $value );
		return $this;
	}

	/**
     * 重置 槽位信息
     * 设置为 []
     * @return $this
     */
    public function reset_slots()
    {
        return $this->reset_defaultValue(self::DBKey_slots);
    }

    /**
     * 设置 槽位信息 默认值
     */
    protected function _set_defaultvalue_slots()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_slots, [] );
    }
    /**
     * 槽位数量
     *
     * @var
     */
    const DBKey_slotcount = "slotcount";

	/**
	 * 获取 槽位数量
	 * @return int
	 */
	public function get_slotcount()
	{
		return $this->getdata ( self::DBKey_slotcount );
	}

	/**
	 * 设置 槽位数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_slotcount($value)
	{
		$this->setdata ( self::DBKey_slotcount, intval($value) );
		return $this;
	}

	/**
     * 重置 槽位数量
     * 设置为 0
     * @return $this
     */
    public function reset_slotcount()
    {
        return $this->reset_defaultValue(self::DBKey_slotcount);
    }

    /**
     * 设置 槽位数量 默认值
     */
    protected function _set_defaultvalue_slotcount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_slotcount, 0 );
    }
    /**
     * 帮助过的槽位信息
     *
     * @var
     */
    const DBKey_helpSlots = "helpSlots";

	/**
	 * 获取 帮助过的槽位信息
	 * @return array
	 */
	public function get_helpSlots()
	{
		return $this->getdata ( self::DBKey_helpSlots );
	}

	/**
	 * 设置 帮助过的槽位信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_helpSlots($value)
	{
		$this->setdata ( self::DBKey_helpSlots, $value );
		return $this;
	}

	/**
     * 重置 帮助过的槽位信息
     * 设置为 []
     * @return $this
     */
    public function reset_helpSlots()
    {
        return $this->reset_defaultValue(self::DBKey_helpSlots);
    }

    /**
     * 设置 帮助过的槽位信息 默认值
     */
    protected function _set_defaultvalue_helpSlots()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpSlots, [] );
    }
    /**
     * 今日帮助过的次数
     *
     * @var
     */
    const DBKey_todayHelpCount = "todayHelpCount";

	/**
	 * 获取 今日帮助过的次数
	 * @return int
	 */
	public function get_todayHelpCount()
	{
		return $this->getdata ( self::DBKey_todayHelpCount );
	}

	/**
	 * 设置 今日帮助过的次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_todayHelpCount($value)
	{
		$this->setdata ( self::DBKey_todayHelpCount, intval($value) );
		return $this;
	}

	/**
     * 重置 今日帮助过的次数
     * 设置为 0
     * @return $this
     */
    public function reset_todayHelpCount()
    {
        return $this->reset_defaultValue(self::DBKey_todayHelpCount);
    }

    /**
     * 设置 今日帮助过的次数 默认值
     */
    protected function _set_defaultvalue_todayHelpCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_todayHelpCount, 0 );
    }
    /**
     * 发布广告冷却时间
     *
     * @var
     */
    const DBKey_publishAdvertisementCoolDown = "publishAdvertisementCoolDown";

	/**
	 * 获取 发布广告冷却时间
	 * @return int
	 */
	public function get_publishAdvertisementCoolDown()
	{
		return $this->getdata ( self::DBKey_publishAdvertisementCoolDown );
	}

	/**
	 * 设置 发布广告冷却时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_publishAdvertisementCoolDown($value)
	{
		$this->setdata ( self::DBKey_publishAdvertisementCoolDown, intval($value) );
		return $this;
	}

	/**
     * 重置 发布广告冷却时间
     * 设置为 0
     * @return $this
     */
    public function reset_publishAdvertisementCoolDown()
    {
        return $this->reset_defaultValue(self::DBKey_publishAdvertisementCoolDown);
    }

    /**
     * 设置 发布广告冷却时间 默认值
     */
    protected function _set_defaultvalue_publishAdvertisementCoolDown()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_publishAdvertisementCoolDown, 0 );
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
        //设置 槽位信息 默认值
        $this->_set_defaultvalue_slots();
        //设置 槽位数量 默认值
        $this->_set_defaultvalue_slotcount();
        //设置 帮助过的槽位信息 默认值
        $this->_set_defaultvalue_helpSlots();
        //设置 今日帮助过的次数 默认值
        $this->_set_defaultvalue_todayHelpCount();
        //设置 发布广告冷却时间 默认值
        $this->_set_defaultvalue_publishAdvertisementCoolDown();

    }
}