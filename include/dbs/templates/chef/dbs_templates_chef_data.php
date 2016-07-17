<?php

namespace dbs\templates\chef;

use dbs\templates\chef\dbs_templates_chef_property as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_data
 * @package dbs\templates\chef
 */
class dbs_templates_chef_data extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.data" );
    }
    /**
     * 厨师目前状态
     *
     * @var
     */
    const DBKey_status = "status";

	/**
	 * 获取 厨师目前状态
	 * @return int
	 */
	public function get_status()
	{
		return $this->getdata ( self::DBKey_status );
	}

	/**
	 * 设置 厨师目前状态
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_status($value)
	{
		$this->setdata ( self::DBKey_status, intval($value) );
		return $this;
	}

	/**
     * 重置 厨师目前状态
     * 设置为 0
     * @return $this
     */
    public function reset_status()
    {
        return $this->reset_defaultValue(self::DBKey_status);
    }

    /**
     * 设置 厨师目前状态 默认值
     */
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_status, 0 );
    }
    /**
     * 当前职位
     *
     * @var
     */
    const DBKey_currentJob = "currentJob";

	/**
	 * 获取 当前职位
	 * @return int
	 */
	public function get_currentJob()
	{
		return $this->getdata ( self::DBKey_currentJob );
	}

	/**
	 * 设置 当前职位
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_currentJob($value)
	{
		$this->setdata ( self::DBKey_currentJob, intval($value) );
		return $this;
	}

	/**
     * 重置 当前职位
     * 设置为 0
     * @return $this
     */
    public function reset_currentJob()
    {
        return $this->reset_defaultValue(self::DBKey_currentJob);
    }

    /**
     * 设置 当前职位 默认值
     */
    protected function _set_defaultvalue_currentJob()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_currentJob, 0 );
    }
    /**
     * 801帽子
     *
     * @var
     */
    const DBKey_equipment1 = "equipment1";

	/**
	 * 获取 801帽子
	 * @return array
	 */
	public function get_equipment1()
	{
		return $this->getdata ( self::DBKey_equipment1 );
	}

	/**
	 * 设置 801帽子
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_equipment1($value)
	{
		$this->setdata ( self::DBKey_equipment1, $value );
		return $this;
	}

	/**
     * 重置 801帽子
     * 设置为 []
     * @return $this
     */
    public function reset_equipment1()
    {
        return $this->reset_defaultValue(self::DBKey_equipment1);
    }

    /**
     * 设置 801帽子 默认值
     */
    protected function _set_defaultvalue_equipment1()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_equipment1, [] );
    }
    /**
     * 802衣服
     *
     * @var
     */
    const DBKey_equipment2 = "equipment2";

	/**
	 * 获取 802衣服
	 * @return array
	 */
	public function get_equipment2()
	{
		return $this->getdata ( self::DBKey_equipment2 );
	}

	/**
	 * 设置 802衣服
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_equipment2($value)
	{
		$this->setdata ( self::DBKey_equipment2, $value );
		return $this;
	}

	/**
     * 重置 802衣服
     * 设置为 []
     * @return $this
     */
    public function reset_equipment2()
    {
        return $this->reset_defaultValue(self::DBKey_equipment2);
    }

    /**
     * 设置 802衣服 默认值
     */
    protected function _set_defaultvalue_equipment2()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_equipment2, [] );
    }
    /**
     * 803厨具
     *
     * @var
     */
    const DBKey_equipment3 = "equipment3";

	/**
	 * 获取 803厨具
	 * @return array
	 */
	public function get_equipment3()
	{
		return $this->getdata ( self::DBKey_equipment3 );
	}

	/**
	 * 设置 803厨具
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_equipment3($value)
	{
		$this->setdata ( self::DBKey_equipment3, $value );
		return $this;
	}

	/**
     * 重置 803厨具
     * 设置为 []
     * @return $this
     */
    public function reset_equipment3()
    {
        return $this->reset_defaultValue(self::DBKey_equipment3);
    }

    /**
     * 设置 803厨具 默认值
     */
    protected function _set_defaultvalue_equipment3()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_equipment3, [] );
    }
    /**
     * 804鞋
     *
     * @var
     */
    const DBKey_equipment4 = "equipment4";

	/**
	 * 获取 804鞋
	 * @return array
	 */
	public function get_equipment4()
	{
		return $this->getdata ( self::DBKey_equipment4 );
	}

	/**
	 * 设置 804鞋
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_equipment4($value)
	{
		$this->setdata ( self::DBKey_equipment4, $value );
		return $this;
	}

	/**
     * 重置 804鞋
     * 设置为 []
     * @return $this
     */
    public function reset_equipment4()
    {
        return $this->reset_defaultValue(self::DBKey_equipment4);
    }

    /**
     * 设置 804鞋 默认值
     */
    protected function _set_defaultvalue_equipment4()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_equipment4, [] );
    }
    /**
     * 805奖牌
     *
     * @var
     */
    const DBKey_equipment5 = "equipment5";

	/**
	 * 获取 805奖牌
	 * @return array
	 */
	public function get_equipment5()
	{
		return $this->getdata ( self::DBKey_equipment5 );
	}

	/**
	 * 设置 805奖牌
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_equipment5($value)
	{
		$this->setdata ( self::DBKey_equipment5, $value );
		return $this;
	}

	/**
     * 重置 805奖牌
     * 设置为 []
     * @return $this
     */
    public function reset_equipment5()
    {
        return $this->reset_defaultValue(self::DBKey_equipment5);
    }

    /**
     * 设置 805奖牌 默认值
     */
    protected function _set_defaultvalue_equipment5()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_equipment5, [] );
    }
    /**
     * 806秘方
     *
     * @var
     */
    const DBKey_equipment6 = "equipment6";

	/**
	 * 获取 806秘方
	 * @return array
	 */
	public function get_equipment6()
	{
		return $this->getdata ( self::DBKey_equipment6 );
	}

	/**
	 * 设置 806秘方
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_equipment6($value)
	{
		$this->setdata ( self::DBKey_equipment6, $value );
		return $this;
	}

	/**
     * 重置 806秘方
     * 设置为 []
     * @return $this
     */
    public function reset_equipment6()
    {
        return $this->reset_defaultValue(self::DBKey_equipment6);
    }

    /**
     * 设置 806秘方 默认值
     */
    protected function _set_defaultvalue_equipment6()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_equipment6, [] );
    }
    /**
     * 厨师模板id
     *
     * @var
     */
    const DBKey_cheftemplateid = "cheftemplateid";

	/**
	 * 获取 厨师模板id
	 * @return string
	 */
	public function get_cheftemplateid()
	{
		return $this->getdata ( self::DBKey_cheftemplateid );
	}

	/**
	 * 设置 厨师模板id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_cheftemplateid($value)
	{
		$this->setdata ( self::DBKey_cheftemplateid, strval($value) );
		return $this;
	}

	/**
     * 重置 厨师模板id
     * 设置为 ""
     * @return $this
     */
    public function reset_cheftemplateid()
    {
        return $this->reset_defaultValue(self::DBKey_cheftemplateid);
    }

    /**
     * 设置 厨师模板id 默认值
     */
    protected function _set_defaultvalue_cheftemplateid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_cheftemplateid, "" );
    }
    /**
     * 厨师等级
     *
     * @var
     */
    const DBKey_level = "level";

	/**
	 * 获取 厨师等级
	 * @return int
	 */
	public function get_level()
	{
		return $this->getdata ( self::DBKey_level );
	}

	/**
	 * 设置 厨师等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_level($value)
	{
		$this->setdata ( self::DBKey_level, intval($value) );
		return $this;
	}

	/**
     * 重置 厨师等级
     * 设置为 1
     * @return $this
     */
    public function reset_level()
    {
        return $this->reset_defaultValue(self::DBKey_level);
    }

    /**
     * 设置 厨师等级 默认值
     */
    protected function _set_defaultvalue_level()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_level, 1 );
    }
    /**
     * 当前可以升到的最高级,小于等于
     *
     * @var
     */
    const DBKey_levelmax = "levelmax";

	/**
	 * 获取 当前可以升到的最高级,小于等于
	 * @return int
	 */
	public function get_levelmax()
	{
		return $this->getdata ( self::DBKey_levelmax );
	}

	/**
	 * 设置 当前可以升到的最高级,小于等于
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_levelmax($value)
	{
		$this->setdata ( self::DBKey_levelmax, intval($value) );
		return $this;
	}

	/**
     * 重置 当前可以升到的最高级,小于等于
     * 设置为 1
     * @return $this
     */
    public function reset_levelmax()
    {
        return $this->reset_defaultValue(self::DBKey_levelmax);
    }

    /**
     * 设置 当前可以升到的最高级,小于等于 默认值
     */
    protected function _set_defaultvalue_levelmax()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_levelmax, 1 );
    }
    /**
     * 厨师经验
     *
     * @var
     */
    const DBKey_exp = "exp";

	/**
	 * 获取 厨师经验
	 * @return int
	 */
	public function get_exp()
	{
		return $this->getdata ( self::DBKey_exp );
	}

	/**
	 * 设置 厨师经验
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_exp($value)
	{
		$this->setdata ( self::DBKey_exp, intval($value) );
		return $this;
	}

	/**
     * 重置 厨师经验
     * 设置为 0
     * @return $this
     */
    public function reset_exp()
    {
        return $this->reset_defaultValue(self::DBKey_exp);
    }

    /**
     * 设置 厨师经验 默认值
     */
    protected function _set_defaultvalue_exp()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_exp, 0 );
    }
    /**
     * 厨师总经验
     *
     * @var
     */
    const DBKey_exptotal = "exptotal";

	/**
	 * 获取 厨师总经验
	 * @return int
	 */
	public function get_exptotal()
	{
		return $this->getdata ( self::DBKey_exptotal );
	}

	/**
	 * 设置 厨师总经验
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_exptotal($value)
	{
		$this->setdata ( self::DBKey_exptotal, intval($value) );
		return $this;
	}

	/**
     * 重置 厨师总经验
     * 设置为 0
     * @return $this
     */
    public function reset_exptotal()
    {
        return $this->reset_defaultValue(self::DBKey_exptotal);
    }

    /**
     * 设置 厨师总经验 默认值
     */
    protected function _set_defaultvalue_exptotal()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_exptotal, 0 );
    }
    /**
     * 厨师阶段
     *
     * @var
     */
    const DBKey_stagelevel = "stagelevel";

	/**
	 * 获取 厨师阶段
	 * @return int
	 */
	public function get_stagelevel()
	{
		return $this->getdata ( self::DBKey_stagelevel );
	}

	/**
	 * 设置 厨师阶段
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_stagelevel($value)
	{
		$this->setdata ( self::DBKey_stagelevel, intval($value) );
		return $this;
	}

	/**
     * 重置 厨师阶段
     * 设置为 1
     * @return $this
     */
    public function reset_stagelevel()
    {
        return $this->reset_defaultValue(self::DBKey_stagelevel);
    }

    /**
     * 设置 厨师阶段 默认值
     */
    protected function _set_defaultvalue_stagelevel()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_stagelevel, 1 );
    }
    /**
     * 唯一id
     *
     * @var
     */
    const DBKey_guid = "guid";

	/**
	 * 获取 唯一id
	 * @return string
	 */
	public function get_guid()
	{
		return $this->getdata ( self::DBKey_guid );
	}

	/**
	 * 设置 唯一id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_guid($value)
	{
		$this->setdata ( self::DBKey_guid, strval($value) );
		return $this;
	}

	/**
     * 重置 唯一id
     * 设置为 ""
     * @return $this
     */
    public function reset_guid()
    {
        return $this->reset_defaultValue(self::DBKey_guid);
    }

    /**
     * 设置 唯一id 默认值
     */
    protected function _set_defaultvalue_guid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_guid, "" );
    }
    /**
     * 战斗力
     *
     * @var
     */
    const DBKey_battlepower = "battlepower";

	/**
	 * 获取 战斗力
	 * @return int
	 */
	public function get_battlepower()
	{
		return $this->getdata ( self::DBKey_battlepower );
	}

	/**
	 * 设置 战斗力
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_battlepower($value)
	{
		$this->setdata ( self::DBKey_battlepower, intval($value) );
		return $this;
	}

	/**
     * 重置 战斗力
     * 设置为 0
     * @return $this
     */
    public function reset_battlepower()
    {
        return $this->reset_defaultValue(self::DBKey_battlepower);
    }

    /**
     * 设置 战斗力 默认值
     */
    protected function _set_defaultvalue_battlepower()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_battlepower, 0 );
    }
    /**
     * 本体体力数据
     *
     * @var
     */
    const DBKey_mastervit = "mastervit";

	/**
	 * 获取 本体体力数据
	 * @return array
	 */
	public function get_mastervit()
	{
		return $this->getdata ( self::DBKey_mastervit );
	}

	/**
	 * 设置 本体体力数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_mastervit($value)
	{
		$this->setdata ( self::DBKey_mastervit, $value );
		return $this;
	}

	/**
     * 重置 本体体力数据
     * 设置为 []
     * @return $this
     */
    public function reset_mastervit()
    {
        return $this->reset_defaultValue(self::DBKey_mastervit);
    }

    /**
     * 设置 本体体力数据 默认值
     */
    protected function _set_defaultvalue_mastervit()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mastervit, [] );
    }
    /**
     * 时装数据
     *
     * @var
     */
    const DBKey_fashionDress = "fashionDress";

	/**
	 * 获取 时装数据
	 * @return array
	 */
	public function get_fashionDress()
	{
		return $this->getdata ( self::DBKey_fashionDress );
	}

	/**
	 * 设置 时装数据
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_fashionDress($value)
	{
		$this->setdata ( self::DBKey_fashionDress, $value );
		return $this;
	}

	/**
     * 重置 时装数据
     * 设置为 []
     * @return $this
     */
    public function reset_fashionDress()
    {
        return $this->reset_defaultValue(self::DBKey_fashionDress);
    }

    /**
     * 设置 时装数据 默认值
     */
    protected function _set_defaultvalue_fashionDress()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_fashionDress, [] );
    }
    /**
     * 是否是主角
     *
     * @var
     */
    const DBKey_isSelf = "isSelf";

	/**
	 * 获取 是否是主角
	 * @return bool
	 */
	public function get_isSelf()
	{
		return $this->getdata ( self::DBKey_isSelf );
	}

	/**
	 * 设置 是否是主角
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isSelf($value)
	{
		$this->setdata ( self::DBKey_isSelf, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否是主角
     * 设置为 false
     * @return $this
     */
    public function reset_isSelf()
    {
        return $this->reset_defaultValue(self::DBKey_isSelf);
    }

    /**
     * 设置 是否是主角 默认值
     */
    protected function _set_defaultvalue_isSelf()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isSelf, false );
    }
    /**
     * 培训数据
     *
     * @var
     */
    const DBKey_trainData = "trainData";

	/**
	 * 获取 培训数据
	 * @return array
	 */
	public function get_trainData()
	{
		return $this->getdata ( self::DBKey_trainData );
	}

	/**
	 * 设置 培训数据
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_trainData($value)
	{
		$this->setdata ( self::DBKey_trainData, $value );
		return $this;
	}

	/**
     * 重置 培训数据
     * 设置为 []
     * @return $this
     */
    public function reset_trainData()
    {
        return $this->reset_defaultValue(self::DBKey_trainData);
    }

    /**
     * 设置 培训数据 默认值
     */
    protected function _set_defaultvalue_trainData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_trainData, [] );
    }
    /**
     * 雇佣数据
     *
     * @var
     */
    const DBKey_employData = "employData";

	/**
	 * 获取 雇佣数据
	 * @return array
	 */
	protected function get_employData()
	{
		return $this->getdata ( self::DBKey_employData );
	}

	/**
	 * 设置 雇佣数据
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_employData($value)
	{
		$this->setdata ( self::DBKey_employData, $value );
		return $this;
	}

	/**
     * 重置 雇佣数据
     * 设置为 []
     * @return $this
     */
    public function reset_employData()
    {
        return $this->reset_defaultValue(self::DBKey_employData);
    }

    /**
     * 设置 雇佣数据 默认值
     */
    protected function _set_defaultvalue_employData()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_employData, [] );
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
        //设置 厨师目前状态 默认值
        $this->_set_defaultvalue_status();
        //设置 当前职位 默认值
        $this->_set_defaultvalue_currentJob();
        //设置 801帽子 默认值
        $this->_set_defaultvalue_equipment1();
        //设置 802衣服 默认值
        $this->_set_defaultvalue_equipment2();
        //设置 803厨具 默认值
        $this->_set_defaultvalue_equipment3();
        //设置 804鞋 默认值
        $this->_set_defaultvalue_equipment4();
        //设置 805奖牌 默认值
        $this->_set_defaultvalue_equipment5();
        //设置 806秘方 默认值
        $this->_set_defaultvalue_equipment6();
        //设置 厨师模板id 默认值
        $this->_set_defaultvalue_cheftemplateid();
        //设置 厨师等级 默认值
        $this->_set_defaultvalue_level();
        //设置 当前可以升到的最高级,小于等于 默认值
        $this->_set_defaultvalue_levelmax();
        //设置 厨师经验 默认值
        $this->_set_defaultvalue_exp();
        //设置 厨师总经验 默认值
        $this->_set_defaultvalue_exptotal();
        //设置 厨师阶段 默认值
        $this->_set_defaultvalue_stagelevel();
        //设置 唯一id 默认值
        $this->_set_defaultvalue_guid();
        //设置 战斗力 默认值
        $this->_set_defaultvalue_battlepower();
        //设置 本体体力数据 默认值
        $this->_set_defaultvalue_mastervit();
        //设置 时装数据 默认值
        $this->_set_defaultvalue_fashionDress();
        //设置 是否是主角 默认值
        $this->_set_defaultvalue_isSelf();
        //设置 培训数据 默认值
        $this->_set_defaultvalue_trainData();
        //设置 雇佣数据 默认值
        $this->_set_defaultvalue_employData();

    }
}