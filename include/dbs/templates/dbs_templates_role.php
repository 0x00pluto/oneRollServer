<?php

namespace dbs\templates;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_role
 * @package dbs\templates
 */
abstract class dbs_templates_role extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "role";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "role" );
    }
    /**
     * 用户昵称
     *
     * @var
     */
    const DBKey_rolename = "rolename";

	/**
	 * 获取 用户昵称
	 * @return string
	 */
	public function get_rolename()
	{
		return $this->getdata ( self::DBKey_rolename );
	}

	/**
	 * 设置 用户昵称
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_rolename($value)
	{
		$this->setdata ( self::DBKey_rolename, strval($value) );
		return $this;
	}

	/**
     * 重置 用户昵称
     * 设置为 ""
     * @return $this
     */
    public function reset_rolename()
    {
        return $this->reset_defaultValue(self::DBKey_rolename);
    }

    /**
     * 设置 用户昵称 默认值
     */
    protected function _set_defaultvalue_rolename()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rolename, "" );
    }
    /**
     * 职业
     *
     * @var
     */
    const DBKey_job = "job";

	/**
	 * 获取 职业
	 * @return int
	 */
	public function get_job()
	{
		return $this->getdata ( self::DBKey_job );
	}

	/**
	 * 设置 职业
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_job($value)
	{
		$this->setdata ( self::DBKey_job, intval($value) );
		return $this;
	}

	/**
     * 重置 职业
     * 设置为 0
     * @return $this
     */
    public function reset_job()
    {
        return $this->reset_defaultValue(self::DBKey_job);
    }

    /**
     * 设置 职业 默认值
     */
    protected function _set_defaultvalue_job()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_job, 0 );
    }
    /**
     * 性别(0男1女)
     *
     * @var
     */
    const DBKey_sex = "sex";

	/**
	 * 获取 性别(0男1女)
	 * @return int
	 */
	public function get_sex()
	{
		return $this->getdata ( self::DBKey_sex );
	}

	/**
	 * 设置 性别(0男1女)
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_sex($value)
	{
		$this->setdata ( self::DBKey_sex, intval($value) );
		return $this;
	}

	/**
     * 重置 性别(0男1女)
     * 设置为 0
     * @return $this
     */
    public function reset_sex()
    {
        return $this->reset_defaultValue(self::DBKey_sex);
    }

    /**
     * 设置 性别(0男1女) 默认值
     */
    protected function _set_defaultvalue_sex()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sex, 0 );
    }
    /**
     * 游戏币
     *
     * @var
     */
    const DBKey_gamecoin = "gamecoin";

	/**
	 * 获取 游戏币
	 * @return int
	 */
	public function get_gamecoin()
	{
		return $this->getdata ( self::DBKey_gamecoin );
	}

	/**
	 * 设置 游戏币
	 *
	 * @param int $value
	 * @return $this
	 */
	protected function set_gamecoin($value)
	{
		$this->setdata ( self::DBKey_gamecoin, intval($value) );
		return $this;
	}

	/**
     * 重置 游戏币
     * 设置为 0
     * @return $this
     */
    public function reset_gamecoin()
    {
        return $this->reset_defaultValue(self::DBKey_gamecoin);
    }

    /**
     * 设置 游戏币 默认值
     */
    protected function _set_defaultvalue_gamecoin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_gamecoin, 0 );
    }
    /**
     * 钻石数量
     *
     * @var
     */
    const DBKey_diamond = "diamond";

	/**
	 * 获取 钻石数量
	 * @return int
	 */
	public function get_diamond()
	{
		return $this->getdata ( self::DBKey_diamond );
	}

	/**
	 * 设置 钻石数量
	 *
	 * @param int $value
	 * @return $this
	 */
	protected function set_diamond($value)
	{
		$this->setdata ( self::DBKey_diamond, intval($value) );
		return $this;
	}

	/**
     * 重置 钻石数量
     * 设置为 0
     * @return $this
     */
    public function reset_diamond()
    {
        return $this->reset_defaultValue(self::DBKey_diamond);
    }

    /**
     * 设置 钻石数量 默认值
     */
    protected function _set_defaultvalue_diamond()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_diamond, 0 );
    }
    /**
     * 声望值
     *
     * @var
     */
    const DBKey_reputation = "reputation";

	/**
	 * 获取 声望值
	 * @return int
	 */
	public function get_reputation()
	{
		return $this->getdata ( self::DBKey_reputation );
	}

	/**
	 * 设置 声望值
	 *
	 * @param int $value
	 * @return $this
	 */
	protected function set_reputation($value)
	{
		$this->setdata ( self::DBKey_reputation, intval($value) );
		return $this;
	}

	/**
     * 重置 声望值
     * 设置为 0
     * @return $this
     */
    public function reset_reputation()
    {
        return $this->reset_defaultValue(self::DBKey_reputation);
    }

    /**
     * 设置 声望值 默认值
     */
    protected function _set_defaultvalue_reputation()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_reputation, 0 );
    }
    /**
     * 可以增加的声望剩余值
     *
     * @var
     */
    const DBKey_reputationAmount = "reputationAmount";

	/**
	 * 获取 可以增加的声望剩余值
	 * @return int
	 */
	public function get_reputationAmount()
	{
		return $this->getdata ( self::DBKey_reputationAmount );
	}

	/**
	 * 设置 可以增加的声望剩余值
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_reputationAmount($value)
	{
		$this->setdata ( self::DBKey_reputationAmount, intval($value) );
		return $this;
	}

	/**
     * 重置 可以增加的声望剩余值
     * 设置为 0
     * @return $this
     */
    public function reset_reputationAmount()
    {
        return $this->reset_defaultValue(self::DBKey_reputationAmount);
    }

    /**
     * 设置 可以增加的声望剩余值 默认值
     */
    protected function _set_defaultvalue_reputationAmount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_reputationAmount, 0 );
    }
    /**
     * GM等级
     *
     * @var
     */
    const DBKey_gmlevel = "gmlevel";

	/**
	 * 获取 GM等级
	 * @return int
	 */
	public function get_gmlevel()
	{
		return $this->getdata ( self::DBKey_gmlevel );
	}

	/**
	 * 设置 GM等级
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_gmlevel($value)
	{
		$this->setdata ( self::DBKey_gmlevel, intval($value) );
		return $this;
	}

	/**
     * 重置 GM等级
     * 设置为 0
     * @return $this
     */
    public function reset_gmlevel()
    {
        return $this->reset_defaultValue(self::DBKey_gmlevel);
    }

    /**
     * 设置 GM等级 默认值
     */
    protected function _set_defaultvalue_gmlevel()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_gmlevel, 0 );
    }
    /**
     * 创建日期
     *
     * @var
     */
    const DBKey_create_time = "create_time";

	/**
	 * 获取 创建日期
	 * @return int
	 */
	public function get_create_time()
	{
		return $this->getdata ( self::DBKey_create_time );
	}

	/**
	 * 设置 创建日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_create_time($value)
	{
		$this->setdata ( self::DBKey_create_time, intval($value) );
		return $this;
	}

	/**
     * 重置 创建日期
     * 设置为 time()
     * @return $this
     */
    public function reset_create_time()
    {
        return $this->reset_defaultValue(self::DBKey_create_time);
    }

    /**
     * 设置 创建日期 默认值
     */
    protected function _set_defaultvalue_create_time()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_create_time, time() );
    }
    /**
     * 最后一次登录日期
     *
     * @var
     */
    const DBKey_lastest_logintime = "lastest_logintime";

	/**
	 * 获取 最后一次登录日期
	 * @return int
	 */
	public function get_lastest_logintime()
	{
		return $this->getdata ( self::DBKey_lastest_logintime );
	}

	/**
	 * 设置 最后一次登录日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_lastest_logintime($value)
	{
		$this->setdata ( self::DBKey_lastest_logintime, intval($value) );
		return $this;
	}

	/**
     * 重置 最后一次登录日期
     * 设置为 0
     * @return $this
     */
    public function reset_lastest_logintime()
    {
        return $this->reset_defaultValue(self::DBKey_lastest_logintime);
    }

    /**
     * 设置 最后一次登录日期 默认值
     */
    protected function _set_defaultvalue_lastest_logintime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_lastest_logintime, 0 );
    }
    /**
     * 联系登录日期
     *
     * @var
     */
    const DBKey_continuelogin = "continuelogin";

	/**
	 * 获取 联系登录日期
	 * @return int
	 */
	public function get_continuelogin()
	{
		return $this->getdata ( self::DBKey_continuelogin );
	}

	/**
	 * 设置 联系登录日期
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_continuelogin($value)
	{
		$this->setdata ( self::DBKey_continuelogin, intval($value) );
		return $this;
	}

	/**
     * 重置 联系登录日期
     * 设置为 0
     * @return $this
     */
    public function reset_continuelogin()
    {
        return $this->reset_defaultValue(self::DBKey_continuelogin);
    }

    /**
     * 设置 联系登录日期 默认值
     */
    protected function _set_defaultvalue_continuelogin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_continuelogin, 0 );
    }
    /**
     * 经度
     *
     * @var
     */
    const DBKey_Lng = "Lng";

	/**
	 * 获取 经度
	 * @return float
	 */
	public function get_Lng()
	{
		return $this->getdata ( self::DBKey_Lng );
	}

	/**
	 * 设置 经度
	 *
	 * @param float $value
	 * @return $this
	 */
	public function set_Lng($value)
	{
		$this->setdata ( self::DBKey_Lng, floatval($value) );
		return $this;
	}

	/**
     * 重置 经度
     * 设置为 0.0
     * @return $this
     */
    public function reset_Lng()
    {
        return $this->reset_defaultValue(self::DBKey_Lng);
    }

    /**
     * 设置 经度 默认值
     */
    protected function _set_defaultvalue_Lng()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_Lng, 0.0 );
    }
    /**
     * 纬度
     *
     * @var
     */
    const DBKey_Lat = "Lat";

	/**
	 * 获取 纬度
	 * @return float
	 */
	public function get_Lat()
	{
		return $this->getdata ( self::DBKey_Lat );
	}

	/**
	 * 设置 纬度
	 *
	 * @param float $value
	 * @return $this
	 */
	public function set_Lat($value)
	{
		$this->setdata ( self::DBKey_Lat, floatval($value) );
		return $this;
	}

	/**
     * 重置 纬度
     * 设置为 0.0
     * @return $this
     */
    public function reset_Lat()
    {
        return $this->reset_defaultValue(self::DBKey_Lat);
    }

    /**
     * 设置 纬度 默认值
     */
    protected function _set_defaultvalue_Lat()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_Lat, 0.0 );
    }
    /**
     * 住址
     *
     * @var
     */
    const DBKey_address = "address";

	/**
	 * 获取 住址
	 * @return string
	 */
	public function get_address()
	{
		return $this->getdata ( self::DBKey_address );
	}

	/**
	 * 设置 住址
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_address($value)
	{
		$this->setdata ( self::DBKey_address, strval($value) );
		return $this;
	}

	/**
     * 重置 住址
     * 设置为 ""
     * @return $this
     */
    public function reset_address()
    {
        return $this->reset_defaultValue(self::DBKey_address);
    }

    /**
     * 设置 住址 默认值
     */
    protected function _set_defaultvalue_address()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_address, "" );
    }
    /**
     * 生日
     *
     * @var
     */
    const DBKey_birthday = "birthday";

	/**
	 * 获取 生日
	 * @return string
	 */
	public function get_birthday()
	{
		return $this->getdata ( self::DBKey_birthday );
	}

	/**
	 * 设置 生日
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_birthday($value)
	{
		$this->setdata ( self::DBKey_birthday, strval($value) );
		return $this;
	}

	/**
     * 重置 生日
     * 设置为 "1995-1-1"
     * @return $this
     */
    public function reset_birthday()
    {
        return $this->reset_defaultValue(self::DBKey_birthday);
    }

    /**
     * 设置 生日 默认值
     */
    protected function _set_defaultvalue_birthday()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_birthday, "1995-1-1" );
    }
    /**
     * 签名
     *
     * @var
     */
    const DBKey_sign = "sign";

	/**
	 * 获取 签名
	 * @return string
	 */
	public function get_sign()
	{
		return $this->getdata ( self::DBKey_sign );
	}

	/**
	 * 设置 签名
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_sign($value)
	{
		$this->setdata ( self::DBKey_sign, strval($value) );
		return $this;
	}

	/**
     * 重置 签名
     * 设置为 ""
     * @return $this
     */
    public function reset_sign()
    {
        return $this->reset_defaultValue(self::DBKey_sign);
    }

    /**
     * 设置 签名 默认值
     */
    protected function _set_defaultvalue_sign()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sign, "" );
    }
    /**
     * 兴趣
     *
     * @var
     */
    const DBKey_interests = "interests";

	/**
	 * 获取 兴趣
	 * @return string
	 */
	public function get_interests()
	{
		return $this->getdata ( self::DBKey_interests );
	}

	/**
	 * 设置 兴趣
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_interests($value)
	{
		$this->setdata ( self::DBKey_interests, strval($value) );
		return $this;
	}

	/**
     * 重置 兴趣
     * 设置为 ""
     * @return $this
     */
    public function reset_interests()
    {
        return $this->reset_defaultValue(self::DBKey_interests);
    }

    /**
     * 设置 兴趣 默认值
     */
    protected function _set_defaultvalue_interests()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_interests, "" );
    }
    /**
     * 头像链接
     *
     * @var
     */
    const DBKey_headiconurl = "headiconurl";

	/**
	 * 获取 头像链接
	 * @return string
	 */
	public function get_headiconurl()
	{
		return $this->getdata ( self::DBKey_headiconurl );
	}

	/**
	 * 设置 头像链接
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_headiconurl($value)
	{
		$this->setdata ( self::DBKey_headiconurl, strval($value) );
		return $this;
	}

	/**
     * 重置 头像链接
     * 设置为 ""
     * @return $this
     */
    public function reset_headiconurl()
    {
        return $this->reset_defaultValue(self::DBKey_headiconurl);
    }

    /**
     * 设置 头像链接 默认值
     */
    protected function _set_defaultvalue_headiconurl()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_headiconurl, "" );
    }
    /**
     * 历史增加游戏币数量
     *
     * @var
     */
    const DBKey_addgamecoins = "addgamecoins";

	/**
	 * 获取 历史增加游戏币数量
	 * @return int
	 */
	public function get_addgamecoins()
	{
		return $this->getdata ( self::DBKey_addgamecoins );
	}

	/**
	 * 设置 历史增加游戏币数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_addgamecoins($value)
	{
		$this->setdata ( self::DBKey_addgamecoins, intval($value) );
		return $this;
	}

	/**
     * 重置 历史增加游戏币数量
     * 设置为 0
     * @return $this
     */
    public function reset_addgamecoins()
    {
        return $this->reset_defaultValue(self::DBKey_addgamecoins);
    }

    /**
     * 设置 历史增加游戏币数量 默认值
     */
    protected function _set_defaultvalue_addgamecoins()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_addgamecoins, 0 );
    }
    /**
     * 地域id
     *
     * @var
     */
    const DBKey_zoneid = "zoneid";

	/**
	 * 获取 地域id
	 * @return int
	 */
	public function get_zoneid()
	{
		return $this->getdata ( self::DBKey_zoneid );
	}

	/**
	 * 设置 地域id
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_zoneid($value)
	{
		$this->setdata ( self::DBKey_zoneid, intval($value) );
		return $this;
	}

	/**
     * 重置 地域id
     * 设置为 1
     * @return $this
     */
    public function reset_zoneid()
    {
        return $this->reset_defaultValue(self::DBKey_zoneid);
    }

    /**
     * 设置 地域id 默认值
     */
    protected function _set_defaultvalue_zoneid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_zoneid, 1 );
    }
    /**
     * 序号ID
     *
     * @var
     */
    const DBKey_sequenceId = "sequenceId";

	/**
	 * 获取 序号ID
	 * @return int
	 */
	public function get_sequenceId()
	{
		return $this->getdata ( self::DBKey_sequenceId );
	}

	/**
	 * 设置 序号ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_sequenceId($value)
	{
		$this->setdata ( self::DBKey_sequenceId, intval($value) );
		return $this;
	}

	/**
     * 重置 序号ID
     * 设置为 0
     * @return $this
     */
    public function reset_sequenceId()
    {
        return $this->reset_defaultValue(self::DBKey_sequenceId);
    }

    /**
     * 设置 序号ID 默认值
     */
    protected function _set_defaultvalue_sequenceId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sequenceId, 0 );
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
        //设置 用户昵称 默认值
        $this->_set_defaultvalue_rolename();
        //设置 职业 默认值
        $this->_set_defaultvalue_job();
        //设置 性别(0男1女) 默认值
        $this->_set_defaultvalue_sex();
        //设置 游戏币 默认值
        $this->_set_defaultvalue_gamecoin();
        //设置 钻石数量 默认值
        $this->_set_defaultvalue_diamond();
        //设置 声望值 默认值
        $this->_set_defaultvalue_reputation();
        //设置 可以增加的声望剩余值 默认值
        $this->_set_defaultvalue_reputationAmount();
        //设置 GM等级 默认值
        $this->_set_defaultvalue_gmlevel();
        //设置 创建日期 默认值
        $this->_set_defaultvalue_create_time();
        //设置 最后一次登录日期 默认值
        $this->_set_defaultvalue_lastest_logintime();
        //设置 联系登录日期 默认值
        $this->_set_defaultvalue_continuelogin();
        //设置 经度 默认值
        $this->_set_defaultvalue_Lng();
        //设置 纬度 默认值
        $this->_set_defaultvalue_Lat();
        //设置 住址 默认值
        $this->_set_defaultvalue_address();
        //设置 生日 默认值
        $this->_set_defaultvalue_birthday();
        //设置 签名 默认值
        $this->_set_defaultvalue_sign();
        //设置 兴趣 默认值
        $this->_set_defaultvalue_interests();
        //设置 头像链接 默认值
        $this->_set_defaultvalue_headiconurl();
        //设置 历史增加游戏币数量 默认值
        $this->_set_defaultvalue_addgamecoins();
        //设置 地域id 默认值
        $this->_set_defaultvalue_zoneid();
        //设置 序号ID 默认值
        $this->_set_defaultvalue_sequenceId();

    }
}