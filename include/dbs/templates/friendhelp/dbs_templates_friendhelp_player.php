<?php

namespace dbs\templates\friendhelp;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_friendhelp_player
 * @package dbs\templates\friendhelp
 */
abstract class dbs_templates_friendhelp_player extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "friendhelps";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "friendhelp.player" );
    }
    /**
     * 今天接到的帮忙的次数
     *
     * @var
     */
    const DBKey_todayRecvHelpCount = "todayRecvHelpCount";

	/**
	 * 获取 今天接到的帮忙的次数
	 * @return int
	 */
	public function get_todayRecvHelpCount()
	{
		return $this->getdata ( self::DBKey_todayRecvHelpCount );
	}

	/**
	 * 设置 今天接到的帮忙的次数
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_todayRecvHelpCount($value)
	{
		$this->setdata ( self::DBKey_todayRecvHelpCount, intval($value) );
		return $this;
	}

	/**
     * 重置 今天接到的帮忙的次数
     * 设置为 0
     * @return $this
     */
    public function reset_todayRecvHelpCount()
    {
        return $this->reset_defaultValue(self::DBKey_todayRecvHelpCount);
    }

    /**
     * 设置 今天接到的帮忙的次数 默认值
     */
    protected function _set_defaultvalue_todayRecvHelpCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_todayRecvHelpCount, 0 );
    }
    /**
     * 今天帮忙的总次数
     *
     * @var
     */
    const DBKey_todayHelpCount = "todayHelpCount";

	/**
	 * 获取 今天帮忙的总次数
	 * @return int
	 */
	public function get_todayHelpCount()
	{
		return $this->getdata ( self::DBKey_todayHelpCount );
	}

	/**
	 * 设置 今天帮忙的总次数
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
     * 重置 今天帮忙的总次数
     * 设置为 0
     * @return $this
     */
    public function reset_todayHelpCount()
    {
        return $this->reset_defaultValue(self::DBKey_todayHelpCount);
    }

    /**
     * 设置 今天帮忙的总次数 默认值
     */
    protected function _set_defaultvalue_todayHelpCount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_todayHelpCount, 0 );
    }
    /**
     * 今天帮忙列表
     *
     * @var
     */
    const DBKey_todayHelpList = "todayHelpList";

	/**
	 * 获取 今天帮忙列表
	 * @return array
	 */
	public function get_todayHelpList()
	{
		return $this->getdata ( self::DBKey_todayHelpList );
	}

	/**
	 * 设置 今天帮忙列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_todayHelpList($value)
	{
		$this->setdata ( self::DBKey_todayHelpList, $value );
		return $this;
	}

	/**
     * 重置 今天帮忙列表
     * 设置为 []
     * @return $this
     */
    public function reset_todayHelpList()
    {
        return $this->reset_defaultValue(self::DBKey_todayHelpList);
    }

    /**
     * 设置 今天帮忙列表 默认值
     */
    protected function _set_defaultvalue_todayHelpList()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_todayHelpList, [] );
    }
    /**
     * 正在被帮助的烹饪台列表
     *
     * @var
     */
    const DBKey_helpedCookingTables = "helpedCookingTables";

	/**
	 * 获取 正在被帮助的烹饪台列表
	 * @return array
	 */
	public function get_helpedCookingTables()
	{
		return $this->getdata ( self::DBKey_helpedCookingTables );
	}

	/**
	 * 设置 正在被帮助的烹饪台列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_helpedCookingTables($value)
	{
		$this->setdata ( self::DBKey_helpedCookingTables, $value );
		return $this;
	}

	/**
     * 重置 正在被帮助的烹饪台列表
     * 设置为 []
     * @return $this
     */
    public function reset_helpedCookingTables()
    {
        return $this->reset_defaultValue(self::DBKey_helpedCookingTables);
    }

    /**
     * 设置 正在被帮助的烹饪台列表 默认值
     */
    protected function _set_defaultvalue_helpedCookingTables()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpedCookingTables, [] );
    }
    /**
     * 正在被帮助的餐台列表
     *
     * @var
     */
    const DBKey_helpedDinnerTables = "helpedDinnerTables";

	/**
	 * 获取 正在被帮助的餐台列表
	 * @return array
	 */
	public function get_helpedDinnerTables()
	{
		return $this->getdata ( self::DBKey_helpedDinnerTables );
	}

	/**
	 * 设置 正在被帮助的餐台列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_helpedDinnerTables($value)
	{
		$this->setdata ( self::DBKey_helpedDinnerTables, $value );
		return $this;
	}

	/**
     * 重置 正在被帮助的餐台列表
     * 设置为 []
     * @return $this
     */
    public function reset_helpedDinnerTables()
    {
        return $this->reset_defaultValue(self::DBKey_helpedDinnerTables);
    }

    /**
     * 设置 正在被帮助的餐台列表 默认值
     */
    protected function _set_defaultvalue_helpedDinnerTables()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpedDinnerTables, [] );
    }
    /**
     * 正在被帮助的扩建列表
     *
     * @var
     */
    const DBKey_helpedExpand = "helpedExpand";

	/**
	 * 获取 正在被帮助的扩建列表
	 * @return array
	 */
	public function get_helpedExpand()
	{
		return $this->getdata ( self::DBKey_helpedExpand );
	}

	/**
	 * 设置 正在被帮助的扩建列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_helpedExpand($value)
	{
		$this->setdata ( self::DBKey_helpedExpand, $value );
		return $this;
	}

	/**
     * 重置 正在被帮助的扩建列表
     * 设置为 []
     * @return $this
     */
    public function reset_helpedExpand()
    {
        return $this->reset_defaultValue(self::DBKey_helpedExpand);
    }

    /**
     * 设置 正在被帮助的扩建列表 默认值
     */
    protected function _set_defaultvalue_helpedExpand()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_helpedExpand, [] );
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
        //设置 今天接到的帮忙的次数 默认值
        $this->_set_defaultvalue_todayRecvHelpCount();
        //设置 今天帮忙的总次数 默认值
        $this->_set_defaultvalue_todayHelpCount();
        //设置 今天帮忙列表 默认值
        $this->_set_defaultvalue_todayHelpList();
        //设置 正在被帮助的烹饪台列表 默认值
        $this->_set_defaultvalue_helpedCookingTables();
        //设置 正在被帮助的餐台列表 默认值
        $this->_set_defaultvalue_helpedDinnerTables();
        //设置 正在被帮助的扩建列表 默认值
        $this->_set_defaultvalue_helpedExpand();

    }
}