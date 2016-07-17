<?php

namespace dbs\templates;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_bulletinboarddata
 * @package dbs\templates
 */
class dbs_templates_bulletinboarddata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "bulletinboarddata" );
    }
    /**
     * 公告唯一ID
     *
     * @var
     */
    const DBKey_guid = "guid";

	/**
	 * 获取 公告唯一ID
	 * @return string
	 */
	public function get_guid()
	{
		return $this->getdata ( self::DBKey_guid );
	}

	/**
	 * 设置 公告唯一ID
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
     * 重置 公告唯一ID
     * 设置为 ""
     * @return $this
     */
    public function reset_guid()
    {
        return $this->reset_defaultValue(self::DBKey_guid);
    }

    /**
     * 设置 公告唯一ID 默认值
     */
    protected function _set_defaultvalue_guid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_guid, "" );
    }
    /**
     * 公告类型
     *
     * @var
     */
    const DBKey_type = "type";

	/**
	 * 获取 公告类型
	 * @return int
	 */
	public function get_type()
	{
		return $this->getdata ( self::DBKey_type );
	}

	/**
	 * 设置 公告类型
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_type($value)
	{
		$this->setdata ( self::DBKey_type, intval($value) );
		return $this;
	}

	/**
     * 重置 公告类型
     * 设置为 0
     * @return $this
     */
    public function reset_type()
    {
        return $this->reset_defaultValue(self::DBKey_type);
    }

    /**
     * 设置 公告类型 默认值
     */
    protected function _set_defaultvalue_type()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_type, 0 );
    }
    /**
     * 发公告的人
     *
     * @var
     */
    const DBKey_fromUserId = "fromUserId";

	/**
	 * 获取 发公告的人
	 * @return string
	 */
	public function get_fromUserId()
	{
		return $this->getdata ( self::DBKey_fromUserId );
	}

	/**
	 * 设置 发公告的人
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
     * 重置 发公告的人
     * 设置为 ""
     * @return $this
     */
    public function reset_fromUserId()
    {
        return $this->reset_defaultValue(self::DBKey_fromUserId);
    }

    /**
     * 设置 发公告的人 默认值
     */
    protected function _set_defaultvalue_fromUserId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_fromUserId, "" );
    }
    /**
     * 发公告的人的信息
     *
     * @var
     */
    const DBKey_fromUserInfo = "fromUserInfo";

	/**
	 * 获取 发公告的人的信息
	 * @return array
	 */
	public function get_fromUserInfo()
	{
		return $this->getdata ( self::DBKey_fromUserInfo );
	}

	/**
	 * 设置 发公告的人的信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_fromUserInfo($value)
	{
		$this->setdata ( self::DBKey_fromUserInfo, $value );
		return $this;
	}

	/**
     * 重置 发公告的人的信息
     * 设置为 []
     * @return $this
     */
    public function reset_fromUserInfo()
    {
        return $this->reset_defaultValue(self::DBKey_fromUserInfo);
    }

    /**
     * 设置 发公告的人的信息 默认值
     */
    protected function _set_defaultvalue_fromUserInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_fromUserInfo, [] );
    }
    /**
     * 发送时间
     *
     * @var
     */
    const DBKey_sendTime = "sendTime";

	/**
	 * 获取 发送时间
	 * @return int
	 */
	public function get_sendTime()
	{
		return $this->getdata ( self::DBKey_sendTime );
	}

	/**
	 * 设置 发送时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_sendTime($value)
	{
		$this->setdata ( self::DBKey_sendTime, intval($value) );
		return $this;
	}

	/**
     * 重置 发送时间
     * 设置为 0
     * @return $this
     */
    public function reset_sendTime()
    {
        return $this->reset_defaultValue(self::DBKey_sendTime);
    }

    /**
     * 设置 发送时间 默认值
     */
    protected function _set_defaultvalue_sendTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sendTime, 0 );
    }
    /**
     * 过期时间
     *
     * @var
     */
    const DBKey_expiredTime = "expiredTime";

	/**
	 * 获取 过期时间
	 * @return int
	 */
	public function get_expiredTime()
	{
		return $this->getdata ( self::DBKey_expiredTime );
	}

	/**
	 * 设置 过期时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_expiredTime($value)
	{
		$this->setdata ( self::DBKey_expiredTime, intval($value) );
		return $this;
	}

	/**
     * 重置 过期时间
     * 设置为 0
     * @return $this
     */
    public function reset_expiredTime()
    {
        return $this->reset_defaultValue(self::DBKey_expiredTime);
    }

    /**
     * 设置 过期时间 默认值
     */
    protected function _set_defaultvalue_expiredTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expiredTime, 0 );
    }
    /**
     * 标题
     *
     * @var
     */
    const DBKey_title = "title";

	/**
	 * 获取 标题
	 * @return string
	 */
	public function get_title()
	{
		return $this->getdata ( self::DBKey_title );
	}

	/**
	 * 设置 标题
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_title($value)
	{
		$this->setdata ( self::DBKey_title, strval($value) );
		return $this;
	}

	/**
     * 重置 标题
     * 设置为 ""
     * @return $this
     */
    public function reset_title()
    {
        return $this->reset_defaultValue(self::DBKey_title);
    }

    /**
     * 设置 标题 默认值
     */
    protected function _set_defaultvalue_title()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_title, "" );
    }
    /**
     * 内容
     *
     * @var
     */
    const DBKey_content = "content";

	/**
	 * 获取 内容
	 * @return string
	 */
	public function get_content()
	{
		return $this->getdata ( self::DBKey_content );
	}

	/**
	 * 设置 内容
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_content($value)
	{
		$this->setdata ( self::DBKey_content, strval($value) );
		return $this;
	}

	/**
     * 重置 内容
     * 设置为 ""
     * @return $this
     */
    public function reset_content()
    {
        return $this->reset_defaultValue(self::DBKey_content);
    }

    /**
     * 设置 内容 默认值
     */
    protected function _set_defaultvalue_content()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_content, "" );
    }
    /**
     * 附加操作类型
     *
     * @var
     */
    const DBKey_attachactiontype = "attachactiontype";

	/**
	 * 获取 附加操作类型
	 * @return string
	 */
	public function get_attachactiontype()
	{
		return $this->getdata ( self::DBKey_attachactiontype );
	}

	/**
	 * 设置 附加操作类型
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_attachactiontype($value)
	{
		$this->setdata ( self::DBKey_attachactiontype, strval($value) );
		return $this;
	}

	/**
     * 重置 附加操作类型
     * 设置为 ""
     * @return $this
     */
    public function reset_attachactiontype()
    {
        return $this->reset_defaultValue(self::DBKey_attachactiontype);
    }

    /**
     * 设置 附加操作类型 默认值
     */
    protected function _set_defaultvalue_attachactiontype()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_attachactiontype, "" );
    }
    /**
     * 附加操作值
     *
     * @var
     */
    const DBKey_attachactionvalue = "attachactionvalue";

	/**
	 * 获取 附加操作值
	 * @return array
	 */
	public function get_attachactionvalue()
	{
		return $this->getdata ( self::DBKey_attachactionvalue );
	}

	/**
	 * 设置 附加操作值
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_attachactionvalue($value)
	{
		$this->setdata ( self::DBKey_attachactionvalue, $value );
		return $this;
	}

	/**
     * 重置 附加操作值
     * 设置为 []
     * @return $this
     */
    public function reset_attachactionvalue()
    {
        return $this->reset_defaultValue(self::DBKey_attachactionvalue);
    }

    /**
     * 设置 附加操作值 默认值
     */
    protected function _set_defaultvalue_attachactionvalue()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_attachactionvalue, [] );
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
        //设置 公告唯一ID 默认值
        $this->_set_defaultvalue_guid();
        //设置 公告类型 默认值
        $this->_set_defaultvalue_type();
        //设置 发公告的人 默认值
        $this->_set_defaultvalue_fromUserId();
        //设置 发公告的人的信息 默认值
        $this->_set_defaultvalue_fromUserInfo();
        //设置 发送时间 默认值
        $this->_set_defaultvalue_sendTime();
        //设置 过期时间 默认值
        $this->_set_defaultvalue_expiredTime();
        //设置 标题 默认值
        $this->_set_defaultvalue_title();
        //设置 内容 默认值
        $this->_set_defaultvalue_content();
        //设置 附加操作类型 默认值
        $this->_set_defaultvalue_attachactiontype();
        //设置 附加操作值 默认值
        $this->_set_defaultvalue_attachactionvalue();

    }
}