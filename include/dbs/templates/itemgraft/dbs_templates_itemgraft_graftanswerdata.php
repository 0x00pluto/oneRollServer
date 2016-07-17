<?php

namespace dbs\templates\itemgraft;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_itemgraft_graftanswerdata
 * @package dbs\templates\itemgraft
 */
class dbs_templates_itemgraft_graftanswerdata extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "itemgraft.graftanswerdata" );
    }
    /**
     * 道具ID
     *
     * @var
     */
    const DBKey_itemid = "itemid";

	/**
	 * 获取 道具ID
	 * @return string
	 */
	public function get_itemid()
	{
		return $this->getdata ( self::DBKey_itemid );
	}

	/**
	 * 设置 道具ID
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_itemid($value)
	{
		$this->setdata ( self::DBKey_itemid, strval($value) );
		return $this;
	}

	/**
     * 重置 道具ID
     * 设置为 ""
     * @return $this
     */
    public function reset_itemid()
    {
        return $this->reset_defaultValue(self::DBKey_itemid);
    }

    /**
     * 设置 道具ID 默认值
     */
    protected function _set_defaultvalue_itemid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemid, "" );
    }
    /**
     * 道具数量
     *
     * @var
     */
    const DBKey_itemcount = "itemcount";

	/**
	 * 获取 道具数量
	 * @return int
	 */
	public function get_itemcount()
	{
		return $this->getdata ( self::DBKey_itemcount );
	}

	/**
	 * 设置 道具数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_itemcount($value)
	{
		$this->setdata ( self::DBKey_itemcount, intval($value) );
		return $this;
	}

	/**
     * 重置 道具数量
     * 设置为 0
     * @return $this
     */
    public function reset_itemcount()
    {
        return $this->reset_defaultValue(self::DBKey_itemcount);
    }

    /**
     * 设置 道具数量 默认值
     */
    protected function _set_defaultvalue_itemcount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_itemcount, 0 );
    }
    /**
     * 配方id
     *
     * @var
     */
    const DBKey_formulaid = "formulaid";

	/**
	 * 获取 配方id
	 * @return int
	 */
	public function get_formulaid()
	{
		return $this->getdata ( self::DBKey_formulaid );
	}

	/**
	 * 设置 配方id
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_formulaid($value)
	{
		$this->setdata ( self::DBKey_formulaid, intval($value) );
		return $this;
	}

	/**
     * 重置 配方id
     * 设置为 -1
     * @return $this
     */
    public function reset_formulaid()
    {
        return $this->reset_defaultValue(self::DBKey_formulaid);
    }

    /**
     * 设置 配方id 默认值
     */
    protected function _set_defaultvalue_formulaid()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_formulaid, -1 );
    }
    /**
     * 应答嫁接请求的人群信息
     *
     * @var
     */
    const DBKey_answerPlayerInfo = "answerPlayerInfo";

	/**
	 * 获取 应答嫁接请求的人群信息
	 * @return array
	 */
	public function get_answerPlayerInfo()
	{
		return $this->getdata ( self::DBKey_answerPlayerInfo );
	}

	/**
	 * 设置 应答嫁接请求的人群信息
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_answerPlayerInfo($value)
	{
		$this->setdata ( self::DBKey_answerPlayerInfo, $value );
		return $this;
	}

	/**
     * 重置 应答嫁接请求的人群信息
     * 设置为 []
     * @return $this
     */
    public function reset_answerPlayerInfo()
    {
        return $this->reset_defaultValue(self::DBKey_answerPlayerInfo);
    }

    /**
     * 设置 应答嫁接请求的人群信息 默认值
     */
    protected function _set_defaultvalue_answerPlayerInfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_answerPlayerInfo, [] );
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
        //设置 道具ID 默认值
        $this->_set_defaultvalue_itemid();
        //设置 道具数量 默认值
        $this->_set_defaultvalue_itemcount();
        //设置 配方id 默认值
        $this->_set_defaultvalue_formulaid();
        //设置 应答嫁接请求的人群信息 默认值
        $this->_set_defaultvalue_answerPlayerInfo();

    }
}