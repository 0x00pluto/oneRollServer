<?php

namespace dbs\templates\notice;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_notice_noticeData
 * @package dbs\templates\notice
 */
abstract class dbs_templates_notice_noticeData extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "notices";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "notice.noticeData" );
    }
    /**
     * 公告ID
     *
     * @var
     */
    const DBKey_noticeid = "noticeid";

	/**
	 * 获取 公告ID
	 * @return string
	 */
	public function get_noticeid()
	{
		return $this->getdata ( self::DBKey_noticeid );
	}

	/**
	 * 设置 公告ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_noticeid($value)
	{
		$this->setdata ( self::DBKey_noticeid, strval($value) );
		return $this;
	}

	/**
     * 重置 公告ID
     * 设置为 ""
     * @return $this
     */
    public function reset_noticeid()
    {
        return $this->reset_defaultValue(self::DBKey_noticeid);
    }

    /**
     * 设置 公告ID 默认值
     */
    protected function _set_defaultvalue_noticeid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_noticeid, "" );
    }
    /**
     * 过期时间
     *
     * @var
     */
    const DBKey_expireTime = "expireTime";

	/**
	 * 获取 过期时间
	 * @return int
	 */
	public function get_expireTime()
	{
		return $this->getdata ( self::DBKey_expireTime );
	}

	/**
	 * 设置 过期时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_expireTime($value)
	{
		$this->setdata ( self::DBKey_expireTime, intval($value) );
		return $this;
	}

	/**
     * 重置 过期时间
     * 设置为 0
     * @return $this
     */
    public function reset_expireTime()
    {
        return $this->reset_defaultValue(self::DBKey_expireTime);
    }

    /**
     * 设置 过期时间 默认值
     */
    protected function _set_defaultvalue_expireTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_expireTime, 0 );
    }
    /**
     * 开启时间
     *
     * @var
     */
    const DBKey_startTime = "startTime";

	/**
	 * 获取 开启时间
	 * @return int
	 */
	public function get_startTime()
	{
		return $this->getdata ( self::DBKey_startTime );
	}

	/**
	 * 设置 开启时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_startTime($value)
	{
		$this->setdata ( self::DBKey_startTime, intval($value) );
		return $this;
	}

	/**
     * 重置 开启时间
     * 设置为 0
     * @return $this
     */
    public function reset_startTime()
    {
        return $this->reset_defaultValue(self::DBKey_startTime);
    }

    /**
     * 设置 开启时间 默认值
     */
    protected function _set_defaultvalue_startTime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_startTime, 0 );
    }
    /**
     * 显示次序
     *
     * @var
     */
    const DBKey_orderId = "orderId";

	/**
	 * 获取 显示次序
	 * @return int
	 */
	public function get_orderId()
	{
		return $this->getdata ( self::DBKey_orderId );
	}

	/**
	 * 设置 显示次序
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_orderId($value)
	{
		$this->setdata ( self::DBKey_orderId, intval($value) );
		return $this;
	}

	/**
     * 重置 显示次序
     * 设置为 0
     * @return $this
     */
    public function reset_orderId()
    {
        return $this->reset_defaultValue(self::DBKey_orderId);
    }

    /**
     * 设置 显示次序 默认值
     */
    protected function _set_defaultvalue_orderId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_orderId, 0 );
    }
    /**
     * 公告模板ID
     *
     * @var
     */
    const DBKey_templateId = "templateId";

	/**
	 * 获取 公告模板ID
	 * @return int
	 */
	public function get_templateId()
	{
		return $this->getdata ( self::DBKey_templateId );
	}

	/**
	 * 设置 公告模板ID
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_templateId($value)
	{
		$this->setdata ( self::DBKey_templateId, intval($value) );
		return $this;
	}

	/**
     * 重置 公告模板ID
     * 设置为 0
     * @return $this
     */
    public function reset_templateId()
    {
        return $this->reset_defaultValue(self::DBKey_templateId);
    }

    /**
     * 设置 公告模板ID 默认值
     */
    protected function _set_defaultvalue_templateId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_templateId, 0 );
    }
    /**
     * 公告模板变量
     *
     * @var
     */
    const DBKey_templateVariables = "templateVariables";

	/**
	 * 获取 公告模板变量
	 * @return array
	 */
	public function get_templateVariables()
	{
		return $this->getdata ( self::DBKey_templateVariables );
	}

	/**
	 * 设置 公告模板变量
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_templateVariables($value)
	{
		$this->setdata ( self::DBKey_templateVariables, $value );
		return $this;
	}

	/**
     * 重置 公告模板变量
     * 设置为 []
     * @return $this
     */
    public function reset_templateVariables()
    {
        return $this->reset_defaultValue(self::DBKey_templateVariables);
    }

    /**
     * 设置 公告模板变量 默认值
     */
    protected function _set_defaultvalue_templateVariables()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_templateVariables, [] );
    }
    /**
     * 公告标题
     *
     * @var
     */
    const DBKey_title = "title";

	/**
	 * 获取 公告标题
	 * @return string
	 */
	public function get_title()
	{
		return $this->getdata ( self::DBKey_title );
	}

	/**
	 * 设置 公告标题
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
     * 重置 公告标题
     * 设置为 ""
     * @return $this
     */
    public function reset_title()
    {
        return $this->reset_defaultValue(self::DBKey_title);
    }

    /**
     * 设置 公告标题 默认值
     */
    protected function _set_defaultvalue_title()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_title, "" );
    }
    /**
     * 公告内容
     *
     * @var
     */
    const DBKey_content = "content";

	/**
	 * 获取 公告内容
	 * @return string
	 */
	public function get_content()
	{
		return $this->getdata ( self::DBKey_content );
	}

	/**
	 * 设置 公告内容
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
     * 重置 公告内容
     * 设置为 ""
     * @return $this
     */
    public function reset_content()
    {
        return $this->reset_defaultValue(self::DBKey_content);
    }

    /**
     * 设置 公告内容 默认值
     */
    protected function _set_defaultvalue_content()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_content, "" );
    }
    /**
     * 渠道号
     *
     * @var
     */
    const DBKey_channel = "channel";

	/**
	 * 获取 渠道号
	 * @return string
	 */
	public function get_channel()
	{
		return $this->getdata ( self::DBKey_channel );
	}

	/**
	 * 设置 渠道号
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_channel($value)
	{
		$this->setdata ( self::DBKey_channel, strval($value) );
		return $this;
	}

	/**
     * 重置 渠道号
     * 设置为 ""
     * @return $this
     */
    public function reset_channel()
    {
        return $this->reset_defaultValue(self::DBKey_channel);
    }

    /**
     * 设置 渠道号 默认值
     */
    protected function _set_defaultvalue_channel()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_channel, "" );
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
        //设置 公告ID 默认值
        $this->_set_defaultvalue_noticeid();
        //设置 过期时间 默认值
        $this->_set_defaultvalue_expireTime();
        //设置 开启时间 默认值
        $this->_set_defaultvalue_startTime();
        //设置 显示次序 默认值
        $this->_set_defaultvalue_orderId();
        //设置 公告模板ID 默认值
        $this->_set_defaultvalue_templateId();
        //设置 公告模板变量 默认值
        $this->_set_defaultvalue_templateVariables();
        //设置 公告标题 默认值
        $this->_set_defaultvalue_title();
        //设置 公告内容 默认值
        $this->_set_defaultvalue_content();
        //设置 渠道号 默认值
        $this->_set_defaultvalue_channel();

    }
}