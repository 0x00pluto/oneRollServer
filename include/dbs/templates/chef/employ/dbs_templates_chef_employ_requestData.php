<?php

namespace dbs\templates\chef\employ;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_chef_employ_requestData
 * @package dbs\templates\chef\employ
 */
class dbs_templates_chef_employ_requestData extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "chef.employ.requestData" );
    }
    /**
     * 请求ID
     *
     * @var
     */
    const DBKey_requestId = "requestId";

	/**
	 * 获取 请求ID
	 * @return string
	 */
	public function get_requestId()
	{
		return $this->getdata ( self::DBKey_requestId );
	}

	/**
	 * 设置 请求ID
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
     * 重置 请求ID
     * 设置为 ""
     * @return $this
     */
    public function reset_requestId()
    {
        return $this->reset_defaultValue(self::DBKey_requestId);
    }

    /**
     * 设置 请求ID 默认值
     */
    protected function _set_defaultvalue_requestId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_requestId, "" );
    }
    /**
     * 来自用户ID
     *
     * @var
     */
    const DBKey_fromUserId = "fromUserId";

	/**
	 * 获取 来自用户ID
	 * @return string
	 */
	public function get_fromUserId()
	{
		return $this->getdata ( self::DBKey_fromUserId );
	}

	/**
	 * 设置 来自用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_fromUserId($value)
	{
		$this->setdata ( self::DBKey_fromUserId, strval($value) );
		return $this;
	}

	/**
     * 重置 来自用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_fromUserId()
    {
        return $this->reset_defaultValue(self::DBKey_fromUserId);
    }

    /**
     * 设置 来自用户ID 默认值
     */
    protected function _set_defaultvalue_fromUserId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_fromUserId, "" );
    }
    /**
     * 发到的用户ID
     *
     * @var
     */
    const DBKey_toUserId = "toUserId";

	/**
	 * 获取 发到的用户ID
	 * @return string
	 */
	public function get_toUserId()
	{
		return $this->getdata ( self::DBKey_toUserId );
	}

	/**
	 * 设置 发到的用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_toUserId($value)
	{
		$this->setdata ( self::DBKey_toUserId, strval($value) );
		return $this;
	}

	/**
     * 重置 发到的用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_toUserId()
    {
        return $this->reset_defaultValue(self::DBKey_toUserId);
    }

    /**
     * 设置 发到的用户ID 默认值
     */
    protected function _set_defaultvalue_toUserId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_toUserId, "" );
    }
    /**
     * 发送到的厨子ID
     *
     * @var
     */
    const DBKey_toChefId = "toChefId";

	/**
	 * 获取 发送到的厨子ID
	 * @return string
	 */
	public function get_toChefId()
	{
		return $this->getdata ( self::DBKey_toChefId );
	}

	/**
	 * 设置 发送到的厨子ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_toChefId($value)
	{
		$this->setdata ( self::DBKey_toChefId, strval($value) );
		return $this;
	}

	/**
     * 重置 发送到的厨子ID
     * 设置为 ""
     * @return $this
     */
    public function reset_toChefId()
    {
        return $this->reset_defaultValue(self::DBKey_toChefId);
    }

    /**
     * 设置 发送到的厨子ID 默认值
     */
    protected function _set_defaultvalue_toChefId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_toChefId, "" );
    }
    /**
     * 礼物游戏币
     *
     * @var
     */
    const DBKey_presentGameCoin = "presentGameCoin";

	/**
	 * 获取 礼物游戏币
	 * @return int
	 */
	public function get_presentGameCoin()
	{
		return $this->getdata ( self::DBKey_presentGameCoin );
	}

	/**
	 * 设置 礼物游戏币
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_presentGameCoin($value)
	{
		$this->setdata ( self::DBKey_presentGameCoin, intval($value) );
		return $this;
	}

	/**
     * 重置 礼物游戏币
     * 设置为 0
     * @return $this
     */
    public function reset_presentGameCoin()
    {
        return $this->reset_defaultValue(self::DBKey_presentGameCoin);
    }

    /**
     * 设置 礼物游戏币 默认值
     */
    protected function _set_defaultvalue_presentGameCoin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_presentGameCoin, 0 );
    }
    /**
     * 礼物钻石
     *
     * @var
     */
    const DBKey_presentDiamond = "presentDiamond";

	/**
	 * 获取 礼物钻石
	 * @return int
	 */
	public function get_presentDiamond()
	{
		return $this->getdata ( self::DBKey_presentDiamond );
	}

	/**
	 * 设置 礼物钻石
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_presentDiamond($value)
	{
		$this->setdata ( self::DBKey_presentDiamond, intval($value) );
		return $this;
	}

	/**
     * 重置 礼物钻石
     * 设置为 0
     * @return $this
     */
    public function reset_presentDiamond()
    {
        return $this->reset_defaultValue(self::DBKey_presentDiamond);
    }

    /**
     * 设置 礼物钻石 默认值
     */
    protected function _set_defaultvalue_presentDiamond()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_presentDiamond, 0 );
    }
    /**
     * 请求发送时间
     *
     * @var
     */
    const DBKey_sendtime = "sendtime";

	/**
	 * 获取 请求发送时间
	 * @return int
	 */
	public function get_sendtime()
	{
		return $this->getdata ( self::DBKey_sendtime );
	}

	/**
	 * 设置 请求发送时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_sendtime($value)
	{
		$this->setdata ( self::DBKey_sendtime, intval($value) );
		return $this;
	}

	/**
     * 重置 请求发送时间
     * 设置为 0
     * @return $this
     */
    public function reset_sendtime()
    {
        return $this->reset_defaultValue(self::DBKey_sendtime);
    }

    /**
     * 设置 请求发送时间 默认值
     */
    protected function _set_defaultvalue_sendtime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sendtime, 0 );
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
        //设置 请求ID 默认值
        $this->_set_defaultvalue_requestId();
        //设置 来自用户ID 默认值
        $this->_set_defaultvalue_fromUserId();
        //设置 发到的用户ID 默认值
        $this->_set_defaultvalue_toUserId();
        //设置 发送到的厨子ID 默认值
        $this->_set_defaultvalue_toChefId();
        //设置 礼物游戏币 默认值
        $this->_set_defaultvalue_presentGameCoin();
        //设置 礼物钻石 默认值
        $this->_set_defaultvalue_presentDiamond();
        //设置 请求发送时间 默认值
        $this->_set_defaultvalue_sendtime();

    }
}