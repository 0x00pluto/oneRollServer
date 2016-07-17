<?php

namespace dbs\templates\mailbox;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mailbox_maildata
 * @package dbs\templates\mailbox
 */
class dbs_templates_mailbox_maildata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mailbox.maildata" );
    }
    /**
     * 邮件id
     *
     * @var
     */
    const DBKey_mailid = "mailid";

	/**
	 * 获取 邮件id
	 * @return string
	 */
	public function get_mailid()
	{
		return $this->getdata ( self::DBKey_mailid );
	}

	/**
	 * 设置 邮件id
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_mailid($value)
	{
		$this->setdata ( self::DBKey_mailid, strval($value) );
		return $this;
	}

	/**
     * 重置 邮件id
     * 设置为 ""
     * @return $this
     */
    public function reset_mailid()
    {
        return $this->reset_defaultValue(self::DBKey_mailid);
    }

    /**
     * 设置 邮件id 默认值
     */
    protected function _set_defaultvalue_mailid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mailid, "" );
    }
    /**
     * 邮件大类型
     *
     * @var
     */
    const DBKey_mailType = "mailType";

	/**
	 * 获取 邮件大类型
	 * @return string
	 */
	public function get_mailType()
	{
		return $this->getdata ( self::DBKey_mailType );
	}

	/**
	 * 设置 邮件大类型
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_mailType($value)
	{
		$this->setdata ( self::DBKey_mailType, strval($value) );
		return $this;
	}

	/**
     * 重置 邮件大类型
     * 设置为 ""
     * @return $this
     */
    public function reset_mailType()
    {
        return $this->reset_defaultValue(self::DBKey_mailType);
    }

    /**
     * 设置 邮件大类型 默认值
     */
    protected function _set_defaultvalue_mailType()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mailType, "" );
    }
    /**
     * 邮件子类型
     *
     * @var
     */
    const DBKey_mailSubtype = "mailSubtype";

	/**
	 * 获取 邮件子类型
	 * @return string
	 */
	public function get_mailSubtype()
	{
		return $this->getdata ( self::DBKey_mailSubtype );
	}

	/**
	 * 设置 邮件子类型
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_mailSubtype($value)
	{
		$this->setdata ( self::DBKey_mailSubtype, strval($value) );
		return $this;
	}

	/**
     * 重置 邮件子类型
     * 设置为 ""
     * @return $this
     */
    public function reset_mailSubtype()
    {
        return $this->reset_defaultValue(self::DBKey_mailSubtype);
    }

    /**
     * 设置 邮件子类型 默认值
     */
    protected function _set_defaultvalue_mailSubtype()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mailSubtype, "" );
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
     * 用户自定义内容
     *
     * @var
     */
    const DBKey_customContent = "customContent";

	/**
	 * 获取 用户自定义内容
	 * @return string
	 */
	public function get_customContent()
	{
		return $this->getdata ( self::DBKey_customContent );
	}

	/**
	 * 设置 用户自定义内容
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_customContent($value)
	{
		$this->setdata ( self::DBKey_customContent, strval($value) );
		return $this;
	}

	/**
     * 重置 用户自定义内容
     * 设置为 ""
     * @return $this
     */
    public function reset_customContent()
    {
        return $this->reset_defaultValue(self::DBKey_customContent);
    }

    /**
     * 设置 用户自定义内容 默认值
     */
    protected function _set_defaultvalue_customContent()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_customContent, "" );
    }
    /**
     * 标准邮件ID,从000008中获取,为空就显示customContent内容
     *
     * @var
     */
    const DBKey_mailStandardId = "mailStandardId";

	/**
	 * 获取 标准邮件ID,从000008中获取,为空就显示customContent内容
	 * @return string
	 */
	public function get_mailStandardId()
	{
		return $this->getdata ( self::DBKey_mailStandardId );
	}

	/**
	 * 设置 标准邮件ID,从000008中获取,为空就显示customContent内容
	 *
	 * @param string $value
	 * @return $this
	 */
	protected function set_mailStandardId($value)
	{
		$this->setdata ( self::DBKey_mailStandardId, strval($value) );
		return $this;
	}

	/**
     * 重置 标准邮件ID,从000008中获取,为空就显示customContent内容
     * 设置为 ""
     * @return $this
     */
    public function reset_mailStandardId()
    {
        return $this->reset_defaultValue(self::DBKey_mailStandardId);
    }

    /**
     * 设置 标准邮件ID,从000008中获取,为空就显示customContent内容 默认值
     */
    protected function _set_defaultvalue_mailStandardId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mailStandardId, "" );
    }
    /**
     * 标准邮件的变量
     *
     * @var
     */
    const DBKey_mailStandardVariables = "mailStandardVariables";

	/**
	 * 获取 标准邮件的变量
	 * @return array
	 */
	public function get_mailStandardVariables()
	{
		return $this->getdata ( self::DBKey_mailStandardVariables );
	}

	/**
	 * 设置 标准邮件的变量
	 *
	 * @param array $value
	 * @return $this
	 */
	protected function set_mailStandardVariables($value)
	{
		$this->setdata ( self::DBKey_mailStandardVariables, $value );
		return $this;
	}

	/**
     * 重置 标准邮件的变量
     * 设置为 []
     * @return $this
     */
    public function reset_mailStandardVariables()
    {
        return $this->reset_defaultValue(self::DBKey_mailStandardVariables);
    }

    /**
     * 设置 标准邮件的变量 默认值
     */
    protected function _set_defaultvalue_mailStandardVariables()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mailStandardVariables, [] );
    }
    /**
     * 是否包含附件
     *
     * @var
     */
    const DBKey_hasAttachment = "hasAttachment";

	/**
	 * 获取 是否包含附件
	 * @return bool
	 */
	public function get_hasAttachment()
	{
		return $this->getdata ( self::DBKey_hasAttachment );
	}

	/**
	 * 设置 是否包含附件
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_hasAttachment($value)
	{
		$this->setdata ( self::DBKey_hasAttachment, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否包含附件
     * 设置为 false
     * @return $this
     */
    public function reset_hasAttachment()
    {
        return $this->reset_defaultValue(self::DBKey_hasAttachment);
    }

    /**
     * 设置 是否包含附件 默认值
     */
    protected function _set_defaultvalue_hasAttachment()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_hasAttachment, false );
    }
    /**
     * 是否已经领取了附件
     *
     * @var
     */
    const DBKey_receivedAttachments = "receivedAttachments";

	/**
	 * 获取 是否已经领取了附件
	 * @return bool
	 */
	public function get_receivedAttachments()
	{
		return $this->getdata ( self::DBKey_receivedAttachments );
	}

	/**
	 * 设置 是否已经领取了附件
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_receivedAttachments($value)
	{
		$this->setdata ( self::DBKey_receivedAttachments, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否已经领取了附件
     * 设置为 false
     * @return $this
     */
    public function reset_receivedAttachments()
    {
        return $this->reset_defaultValue(self::DBKey_receivedAttachments);
    }

    /**
     * 设置 是否已经领取了附件 默认值
     */
    protected function _set_defaultvalue_receivedAttachments()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_receivedAttachments, false );
    }
    /**
     * 游戏币
     *
     * @var
     */
    const DBKey_attachmentGamecoin = "attachmentGamecoin";

	/**
	 * 获取 游戏币
	 * @return int
	 */
	public function get_attachmentGamecoin()
	{
		return $this->getdata ( self::DBKey_attachmentGamecoin );
	}

	/**
	 * 设置 游戏币
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_attachmentGamecoin($value)
	{
		$this->setdata ( self::DBKey_attachmentGamecoin, intval($value) );
		return $this;
	}

	/**
     * 重置 游戏币
     * 设置为 0
     * @return $this
     */
    public function reset_attachmentGamecoin()
    {
        return $this->reset_defaultValue(self::DBKey_attachmentGamecoin);
    }

    /**
     * 设置 游戏币 默认值
     */
    protected function _set_defaultvalue_attachmentGamecoin()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_attachmentGamecoin, 0 );
    }
    /**
     * 钻石
     *
     * @var
     */
    const DBKey_attachmentDiamond = "attachmentDiamond";

	/**
	 * 获取 钻石
	 * @return int
	 */
	public function get_attachmentDiamond()
	{
		return $this->getdata ( self::DBKey_attachmentDiamond );
	}

	/**
	 * 设置 钻石
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_attachmentDiamond($value)
	{
		$this->setdata ( self::DBKey_attachmentDiamond, intval($value) );
		return $this;
	}

	/**
     * 重置 钻石
     * 设置为 0
     * @return $this
     */
    public function reset_attachmentDiamond()
    {
        return $this->reset_defaultValue(self::DBKey_attachmentDiamond);
    }

    /**
     * 设置 钻石 默认值
     */
    protected function _set_defaultvalue_attachmentDiamond()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_attachmentDiamond, 0 );
    }
    /**
     * 附加道具
     *
     * @var
     */
    const DBKey_attachmentitems = "attachmentitems";

	/**
	 * 获取 附加道具
	 * @return array
	 */
	public function get_attachmentitems()
	{
		return $this->getdata ( self::DBKey_attachmentitems );
	}

	/**
	 * 设置 附加道具
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_attachmentitems($value)
	{
		$this->setdata ( self::DBKey_attachmentitems, $value );
		return $this;
	}

	/**
     * 重置 附加道具
     * 设置为 []
     * @return $this
     */
    public function reset_attachmentitems()
    {
        return $this->reset_defaultValue(self::DBKey_attachmentitems);
    }

    /**
     * 设置 附加道具 默认值
     */
    protected function _set_defaultvalue_attachmentitems()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_attachmentitems, [] );
    }
    /**
     * 邮件发送时间
     *
     * @var
     */
    const DBKey_sendTime = "sendTime";

	/**
	 * 获取 邮件发送时间
	 * @return int
	 */
	public function get_sendTime()
	{
		return $this->getdata ( self::DBKey_sendTime );
	}

	/**
	 * 设置 邮件发送时间
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
     * 重置 邮件发送时间
     * 设置为 0
     * @return $this
     */
    public function reset_sendTime()
    {
        return $this->reset_defaultValue(self::DBKey_sendTime);
    }

    /**
     * 设置 邮件发送时间 默认值
     */
    protected function _set_defaultvalue_sendTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sendTime, 0 );
    }
    /**
     * 邮件过期时间
     *
     * @var
     */
    const DBKey_expiredTime = "expiredTime";

	/**
	 * 获取 邮件过期时间
	 * @return int
	 */
	public function get_expiredTime()
	{
		return $this->getdata ( self::DBKey_expiredTime );
	}

	/**
	 * 设置 邮件过期时间
	 *
	 * @param int $value
	 * @return $this
	 */
	protected function set_expiredTime($value)
	{
		$this->setdata ( self::DBKey_expiredTime, intval($value) );
		return $this;
	}

	/**
     * 重置 邮件过期时间
     * 设置为 0
     * @return $this
     */
    public function reset_expiredTime()
    {
        return $this->reset_defaultValue(self::DBKey_expiredTime);
    }

    /**
     * 设置 邮件过期时间 默认值
     */
    protected function _set_defaultvalue_expiredTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expiredTime, 0 );
    }
    /**
     * 邮件是否已读
     *
     * @var
     */
    const DBKey_isRead = "isRead";

	/**
	 * 获取 邮件是否已读
	 * @return bool
	 */
	public function get_isRead()
	{
		return $this->getdata ( self::DBKey_isRead );
	}

	/**
	 * 设置 邮件是否已读
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_isRead($value)
	{
		$this->setdata ( self::DBKey_isRead, boolval($value) );
		return $this;
	}

	/**
     * 重置 邮件是否已读
     * 设置为 false
     * @return $this
     */
    public function reset_isRead()
    {
        return $this->reset_defaultValue(self::DBKey_isRead);
    }

    /**
     * 设置 邮件是否已读 默认值
     */
    protected function _set_defaultvalue_isRead()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_isRead, false );
    }
    /**
     * 是否有附加操作
     *
     * @var
     */
    const DBKey_hasAttachaction = "hasAttachaction";

	/**
	 * 获取 是否有附加操作
	 * @return bool
	 */
	public function get_hasAttachaction()
	{
		return $this->getdata ( self::DBKey_hasAttachaction );
	}

	/**
	 * 设置 是否有附加操作
	 *
	 * @param bool $value
	 * @return $this
	 */
	public function set_hasAttachaction($value)
	{
		$this->setdata ( self::DBKey_hasAttachaction, boolval($value) );
		return $this;
	}

	/**
     * 重置 是否有附加操作
     * 设置为 false
     * @return $this
     */
    public function reset_hasAttachaction()
    {
        return $this->reset_defaultValue(self::DBKey_hasAttachaction);
    }

    /**
     * 设置 是否有附加操作 默认值
     */
    protected function _set_defaultvalue_hasAttachaction()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_hasAttachaction, false );
    }
    /**
     * 附加操作guid
     *
     * @var
     */
    const DBKey_attachactionId = "attachactionId";

	/**
	 * 获取 附加操作guid
	 * @return string
	 */
	public function get_attachactionId()
	{
		return $this->getdata ( self::DBKey_attachactionId );
	}

	/**
	 * 设置 附加操作guid
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_attachactionId($value)
	{
		$this->setdata ( self::DBKey_attachactionId, strval($value) );
		return $this;
	}

	/**
     * 重置 附加操作guid
     * 设置为 ""
     * @return $this
     */
    public function reset_attachactionId()
    {
        return $this->reset_defaultValue(self::DBKey_attachactionId);
    }

    /**
     * 设置 附加操作guid 默认值
     */
    protected function _set_defaultvalue_attachactionId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_attachactionId, "" );
    }
    /**
     * 附加操作结束时间
     *
     * @var
     */
    const DBKey_attachactionEndtime = "attachactionEndtime";

	/**
	 * 获取 附加操作结束时间
	 * @return int
	 */
	public function get_attachactionEndtime()
	{
		return $this->getdata ( self::DBKey_attachactionEndtime );
	}

	/**
	 * 设置 附加操作结束时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_attachactionEndtime($value)
	{
		$this->setdata ( self::DBKey_attachactionEndtime, intval($value) );
		return $this;
	}

	/**
     * 重置 附加操作结束时间
     * 设置为 0
     * @return $this
     */
    public function reset_attachactionEndtime()
    {
        return $this->reset_defaultValue(self::DBKey_attachactionEndtime);
    }

    /**
     * 设置 附加操作结束时间 默认值
     */
    protected function _set_defaultvalue_attachactionEndtime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_attachactionEndtime, 0 );
    }
    /**
     * 附加操作类型
     *
     * @var
     */
    const DBKey_attachactionType = "attachactionType";

	/**
	 * 获取 附加操作类型
	 * @return string
	 */
	public function get_attachactionType()
	{
		return $this->getdata ( self::DBKey_attachactionType );
	}

	/**
	 * 设置 附加操作类型
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_attachactionType($value)
	{
		$this->setdata ( self::DBKey_attachactionType, strval($value) );
		return $this;
	}

	/**
     * 重置 附加操作类型
     * 设置为 ""
     * @return $this
     */
    public function reset_attachactionType()
    {
        return $this->reset_defaultValue(self::DBKey_attachactionType);
    }

    /**
     * 设置 附加操作类型 默认值
     */
    protected function _set_defaultvalue_attachactionType()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_attachactionType, "" );
    }
    /**
     * 附加操作值
     *
     * @var
     */
    const DBKey_attachactionValue = "attachactionValue";

	/**
	 * 获取 附加操作值
	 * @return mixed
	 */
	public function get_attachactionValue()
	{
		return $this->getdata ( self::DBKey_attachactionValue );
	}

	/**
	 * 设置 附加操作值
	 *
	 * @param mixed $value
	 * @return $this
	 */
	public function set_attachactionValue($value)
	{
		$this->setdata ( self::DBKey_attachactionValue, $value );
		return $this;
	}

	/**
     * 重置 附加操作值
     * 设置为 ""
     * @return $this
     */
    public function reset_attachactionValue()
    {
        return $this->reset_defaultValue(self::DBKey_attachactionValue);
    }

    /**
     * 设置 附加操作值 默认值
     */
    protected function _set_defaultvalue_attachactionValue()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_attachactionValue, "" );
    }
    /**
     * 发用用户ID
     *
     * @var
     */
    const DBKey_fromUserid = "fromUserid";

	/**
	 * 获取 发用用户ID
	 * @return string
	 */
	public function get_fromUserid()
	{
		return $this->getdata ( self::DBKey_fromUserid );
	}

	/**
	 * 设置 发用用户ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_fromUserid($value)
	{
		$this->setdata ( self::DBKey_fromUserid, strval($value) );
		return $this;
	}

	/**
     * 重置 发用用户ID
     * 设置为 ""
     * @return $this
     */
    public function reset_fromUserid()
    {
        return $this->reset_defaultValue(self::DBKey_fromUserid);
    }

    /**
     * 设置 发用用户ID 默认值
     */
    protected function _set_defaultvalue_fromUserid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_fromUserid, "" );
    }
    /**
     * 发送者用户信息
     *
     * @var
     */
    const DBKey_fromUserinfo = "fromUserinfo";

	/**
	 * 获取 发送者用户信息
	 * @return array
	 */
	public function get_fromUserinfo()
	{
		return $this->getdata ( self::DBKey_fromUserinfo );
	}

	/**
	 * 设置 发送者用户信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_fromUserinfo($value)
	{
		$this->setdata ( self::DBKey_fromUserinfo, $value );
		return $this;
	}

	/**
     * 重置 发送者用户信息
     * 设置为 []
     * @return $this
     */
    public function reset_fromUserinfo()
    {
        return $this->reset_defaultValue(self::DBKey_fromUserinfo);
    }

    /**
     * 设置 发送者用户信息 默认值
     */
    protected function _set_defaultvalue_fromUserinfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_fromUserinfo, [] );
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
        //设置 邮件id 默认值
        $this->_set_defaultvalue_mailid();
        //设置 邮件大类型 默认值
        $this->_set_defaultvalue_mailType();
        //设置 邮件子类型 默认值
        $this->_set_defaultvalue_mailSubtype();
        //设置 标题 默认值
        $this->_set_defaultvalue_title();
        //设置 用户自定义内容 默认值
        $this->_set_defaultvalue_customContent();
        //设置 标准邮件ID,从000008中获取,为空就显示customContent内容 默认值
        $this->_set_defaultvalue_mailStandardId();
        //设置 标准邮件的变量 默认值
        $this->_set_defaultvalue_mailStandardVariables();
        //设置 是否包含附件 默认值
        $this->_set_defaultvalue_hasAttachment();
        //设置 是否已经领取了附件 默认值
        $this->_set_defaultvalue_receivedAttachments();
        //设置 游戏币 默认值
        $this->_set_defaultvalue_attachmentGamecoin();
        //设置 钻石 默认值
        $this->_set_defaultvalue_attachmentDiamond();
        //设置 附加道具 默认值
        $this->_set_defaultvalue_attachmentitems();
        //设置 邮件发送时间 默认值
        $this->_set_defaultvalue_sendTime();
        //设置 邮件过期时间 默认值
        $this->_set_defaultvalue_expiredTime();
        //设置 邮件是否已读 默认值
        $this->_set_defaultvalue_isRead();
        //设置 是否有附加操作 默认值
        $this->_set_defaultvalue_hasAttachaction();
        //设置 附加操作guid 默认值
        $this->_set_defaultvalue_attachactionId();
        //设置 附加操作结束时间 默认值
        $this->_set_defaultvalue_attachactionEndtime();
        //设置 附加操作类型 默认值
        $this->_set_defaultvalue_attachactionType();
        //设置 附加操作值 默认值
        $this->_set_defaultvalue_attachactionValue();
        //设置 发用用户ID 默认值
        $this->_set_defaultvalue_fromUserid();
        //设置 发送者用户信息 默认值
        $this->_set_defaultvalue_fromUserinfo();

    }
}