<?php

namespace dbs\templates\mailbox;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mailbox_maillist
 * @package dbs\templates\mailbox
 */
abstract class dbs_templates_mailbox_maillist extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "mailbox";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mailbox.maillist" );
    }
    /**
     * 邮件列表
     *
     * @var
     */
    const DBKey_maillist = "maillist";

	/**
	 * 获取 邮件列表
	 * @return array
	 */
	public function get_maillist()
	{
		return $this->getdata ( self::DBKey_maillist );
	}

	/**
	 * 设置 邮件列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_maillist($value)
	{
		$this->setdata ( self::DBKey_maillist, $value );
		return $this;
	}

	/**
     * 重置 邮件列表
     * 设置为 []
     * @return $this
     */
    public function reset_maillist()
    {
        return $this->reset_defaultValue(self::DBKey_maillist);
    }

    /**
     * 设置 邮件列表 默认值
     */
    protected function _set_defaultvalue_maillist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_maillist, [] );
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
        //设置 邮件列表 默认值
        $this->_set_defaultvalue_maillist();

    }
}