<?php

namespace dbs\templates\friend;

use dbs\dbs_baseplayer as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_friend_friend
 * @package dbs\templates\friend
 */
abstract class dbs_templates_friend_friend extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "friends";
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "friend.friend" );
    }
    /**
     * 好友列表
     *
     * @var
     */
    const DBKey_friendlist = "friendlist";

	/**
	 * 获取 好友列表
	 * @return array
	 */
	public function get_friendlist()
	{
		return $this->getdata ( self::DBKey_friendlist );
	}

	/**
	 * 设置 好友列表
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_friendlist($value)
	{
		$this->setdata ( self::DBKey_friendlist, $value );
		return $this;
	}

	/**
     * 重置 好友列表
     * 设置为 []
     * @return $this
     */
    public function reset_friendlist()
    {
        return $this->reset_defaultValue(self::DBKey_friendlist);
    }

    /**
     * 设置 好友列表 默认值
     */
    protected function _set_defaultvalue_friendlist()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_friendlist, [] );
    }
    /**
     * 推荐好友下次刷新时间
     *
     * @var
     */
    const DBKey_recommendfriendnextrefreshtime = "recommendfriendnextrefreshtime";

	/**
	 * 获取 推荐好友下次刷新时间
	 * @return int
	 */
	public function get_recommendfriendnextrefreshtime()
	{
		return $this->getdata ( self::DBKey_recommendfriendnextrefreshtime );
	}

	/**
	 * 设置 推荐好友下次刷新时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_recommendfriendnextrefreshtime($value)
	{
		$this->setdata ( self::DBKey_recommendfriendnextrefreshtime, intval($value) );
		return $this;
	}

	/**
     * 重置 推荐好友下次刷新时间
     * 设置为 0
     * @return $this
     */
    public function reset_recommendfriendnextrefreshtime()
    {
        return $this->reset_defaultValue(self::DBKey_recommendfriendnextrefreshtime);
    }

    /**
     * 设置 推荐好友下次刷新时间 默认值
     */
    protected function _set_defaultvalue_recommendfriendnextrefreshtime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_recommendfriendnextrefreshtime, 0 );
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
        //设置 好友列表 默认值
        $this->_set_defaultvalue_friendlist();
        //设置 推荐好友下次刷新时间 默认值
        $this->_set_defaultvalue_recommendfriendnextrefreshtime();

    }
}