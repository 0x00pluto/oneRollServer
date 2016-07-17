<?php

namespace dbs\templates\chef;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_trainserviceTrainData
 * @package dbs\templates\chef
 */
class dbs_templates_chef_trainserviceTrainData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.trainserviceTrainData" );
    }
    /**
     * 用户ID
     *
     * @var
     */
    const DBKey_userid = "userid";

	/**
	 * 获取 用户ID
	 * @return string
	 */
	public function get_userid()
	{
		return $this->getdata ( self::DBKey_userid );
	}

	/**
	 * 设置 用户ID
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
     * 重置 用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_userid()
    {
        return $this->reset_defaultValue(self::DBKey_userid);
    }

    /**
     * 设置 用户ID 默认值
     */
    protected function _set_defaultvalue_userid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userid, "" );
    }
    /**
     * 用户简要信息
     *
     * @var
     */
    const DBKey_userinfo = "userinfo";

	/**
	 * 获取 用户简要信息
	 * @return array
	 */
	public function get_userinfo()
	{
		return $this->getdata ( self::DBKey_userinfo );
	}

	/**
	 * 设置 用户简要信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_userinfo($value)
	{
		$this->setdata ( self::DBKey_userinfo, $value );
		return $this;
	}

	/**
     * 重置 用户简要信息
     * 设置为 []
     * @return $this
     */
    public function reset_userinfo()
    {
        return $this->reset_defaultValue(self::DBKey_userinfo);
    }

    /**
     * 设置 用户简要信息 默认值
     */
    protected function _set_defaultvalue_userinfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userinfo, [] );
    }
    /**
     * 厨师ID
     *
     * @var
     */
    const DBKey_chefid = "chefid";

	/**
	 * 获取 厨师ID
	 * @return string
	 */
	public function get_chefid()
	{
		return $this->getdata ( self::DBKey_chefid );
	}

	/**
	 * 设置 厨师ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_chefid($value)
	{
		$this->setdata ( self::DBKey_chefid, strval($value) );
		return $this;
	}

	/**
     * 重置 厨师ID
     * 设置为 ""
     * @return $this
     */
    public function reset_chefid()
    {
        return $this->reset_defaultValue(self::DBKey_chefid);
    }

    /**
     * 设置 厨师ID 默认值
     */
    protected function _set_defaultvalue_chefid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_chefid, "" );
    }
    /**
     * 厨师简要信息
     *
     * @var
     */
    const DBKey_chefinfo = "chefinfo";

	/**
	 * 获取 厨师简要信息
	 * @return array
	 */
	public function get_chefinfo()
	{
		return $this->getdata ( self::DBKey_chefinfo );
	}

	/**
	 * 设置 厨师简要信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_chefinfo($value)
	{
		$this->setdata ( self::DBKey_chefinfo, $value );
		return $this;
	}

	/**
     * 重置 厨师简要信息
     * 设置为 []
     * @return $this
     */
    public function reset_chefinfo()
    {
        return $this->reset_defaultValue(self::DBKey_chefinfo);
    }

    /**
     * 设置 厨师简要信息 默认值
     */
    protected function _set_defaultvalue_chefinfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_chefinfo, [] );
    }
    /**
     * 是否领取了修炼奖励
     *
     * @var
     */
    const DBKey_receiveAward = "receiveAward";

	/**
	 * 获取 是否领取了修炼奖励
	 * @return bool
	 */
	public function get_receiveAward()
	{
		return $this->getdata ( self::DBKey_receiveAward );
	}

	/**
	 * 设置 是否领取了修炼奖励
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_receiveAward($value)
	{
		$this->setdata ( self::DBKey_receiveAward, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否领取了修炼奖励
     * 设置为 false
     * @return $this
     */
    public function reset_receiveAward()
    {
        return $this->reset_defaultValue(self::DBKey_receiveAward);
    }

    /**
     * 设置 是否领取了修炼奖励 默认值
     */
    protected function _set_defaultvalue_receiveAward()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_receiveAward, false );
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
        //设置 用户ID 默认值
        $this->_set_defaultvalue_userid();
        //设置 用户简要信息 默认值
        $this->_set_defaultvalue_userinfo();
        //设置 厨师ID 默认值
        $this->_set_defaultvalue_chefid();
        //设置 厨师简要信息 默认值
        $this->_set_defaultvalue_chefinfo();
        //设置 是否领取了修炼奖励 默认值
        $this->_set_defaultvalue_receiveAward();

    }
}