<?php

namespace dbs\templates\chef;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_trainserviceTrainJoinRequestData
 * @package dbs\templates\chef
 */
class dbs_templates_chef_trainserviceTrainJoinRequestData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.trainserviceTrainJoinRequestData" );
    }
    /**
     * 请求的唯一ID
     *
     * @var
     */
    const DBKey_requestId = "requestId";

	/**
	 * 获取 请求的唯一ID
	 * @return string
	 */
	public function get_requestId()
	{
		return $this->getdata ( self::DBKey_requestId );
	}

	/**
	 * 设置 请求的唯一ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_requestId($value)
	{
		$this->setdata ( self::DBKey_requestId, strval($value) );
		return $this;
	}

	/**
     * 重置 请求的唯一ID
     * 设置为 ""
     * @return $this
     */
    public function reset_requestId()
    {
        return $this->reset_defaultValue(self::DBKey_requestId);
    }

    /**
     * 设置 请求的唯一ID 默认值
     */
    protected function _set_defaultvalue_requestId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_requestId, "" );
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
     * 聘礼钻石
     *
     * @var
     */
    const DBKey_giftDiamond = "giftDiamond";

	/**
	 * 获取 聘礼钻石
	 * @return int
	 */
	public function get_giftDiamond()
	{
		return $this->getdata ( self::DBKey_giftDiamond );
	}

	/**
	 * 设置 聘礼钻石
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_giftDiamond($value)
	{
		$this->setdata ( self::DBKey_giftDiamond, intval($value) );
		return $this;
	}

	/**
     * 重置 聘礼钻石
     * 设置为 0
     * @return $this
     */
    public function reset_giftDiamond()
    {
        return $this->reset_defaultValue(self::DBKey_giftDiamond);
    }

    /**
     * 设置 聘礼钻石 默认值
     */
    protected function _set_defaultvalue_giftDiamond()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_giftDiamond, 0 );
    }
    /**
     * 聘礼游戏币
     *
     * @var
     */
    const DBKey_giftGamecoin = "giftGamecoin";

	/**
	 * 获取 聘礼游戏币
	 * @return int
	 */
	public function get_giftGamecoin()
	{
		return $this->getdata ( self::DBKey_giftGamecoin );
	}

	/**
	 * 设置 聘礼游戏币
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_giftGamecoin($value)
	{
		$this->setdata ( self::DBKey_giftGamecoin, intval($value) );
		return $this;
	}

	/**
     * 重置 聘礼游戏币
     * 设置为 0
     * @return $this
     */
    public function reset_giftGamecoin()
    {
        return $this->reset_defaultValue(self::DBKey_giftGamecoin);
    }

    /**
     * 设置 聘礼游戏币 默认值
     */
    protected function _set_defaultvalue_giftGamecoin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_giftGamecoin, 0 );
    }
    /**
     * 请求时间
     *
     * @var
     */
    const DBKey_requestTime = "requestTime";

	/**
	 * 获取 请求时间
	 * @return int
	 */
	public function get_requestTime()
	{
		return $this->getdata ( self::DBKey_requestTime );
	}

	/**
	 * 设置 请求时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_requestTime($value)
	{
		$this->setdata ( self::DBKey_requestTime, intval($value) );
		return $this;
	}

	/**
     * 重置 请求时间
     * 设置为 0
     * @return $this
     */
    public function reset_requestTime()
    {
        return $this->reset_defaultValue(self::DBKey_requestTime);
    }

    /**
     * 设置 请求时间 默认值
     */
    protected function _set_defaultvalue_requestTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_requestTime, 0 );
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
        //设置 请求的唯一ID 默认值
        $this->_set_defaultvalue_requestId();
        //设置 用户ID 默认值
        $this->_set_defaultvalue_userid();
        //设置 用户简要信息 默认值
        $this->_set_defaultvalue_userinfo();
        //设置 厨师ID 默认值
        $this->_set_defaultvalue_chefid();
        //设置 厨师简要信息 默认值
        $this->_set_defaultvalue_chefinfo();
        //设置 聘礼钻石 默认值
        $this->_set_defaultvalue_giftDiamond();
        //设置 聘礼游戏币 默认值
        $this->_set_defaultvalue_giftGamecoin();
        //设置 请求时间 默认值
        $this->_set_defaultvalue_requestTime();

    }
}