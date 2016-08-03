<?php

namespace dbs\templates\mall;

use dbs\dbs_basedatacell as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_goodsSellInfoDetail
 * @package dbs\templates\mall
 */
class dbs_templates_mall_goodsSellInfoDetail extends super
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
        $this->set_defaultkeyandvalue ( self::DBKey_dataTemplateType, "mall.goodsSellInfoDetail" );
    }
    /**
     * 销售流水号
     *
     * @var
     */
    const DBKey_id = "id";

	/**
	 * 获取 销售流水号
	 * @return string
	 */
	public function get_id()
	{
		return $this->getdata ( self::DBKey_id );
	}

	/**
	 * 设置 销售流水号
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_id($value)
	{
		$this->setdata ( self::DBKey_id, strval($value) );
		return $this;
	}

	/**
     * 重置 销售流水号
     * 设置为 ""
     * @return $this
     */
    public function reset_id()
    {
        return $this->reset_defaultValue(self::DBKey_id);
    }

    /**
     * 设置 销售流水号 默认值
     */
    protected function _set_defaultvalue_id()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_id, "" );
    }
    /**
     * 售出的数量
     *
     * @var
     */
    const DBKey_sellcount = "sellcount";

	/**
	 * 获取 售出的数量
	 * @return int
	 */
	public function get_sellcount()
	{
		return $this->getdata ( self::DBKey_sellcount );
	}

	/**
	 * 设置 售出的数量
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_sellcount($value)
	{
		$this->setdata ( self::DBKey_sellcount, intval($value) );
		return $this;
	}

	/**
     * 重置 售出的数量
     * 设置为 0
     * @return $this
     */
    public function reset_sellcount()
    {
        return $this->reset_defaultValue(self::DBKey_sellcount);
    }

    /**
     * 设置 售出的数量 默认值
     */
    protected function _set_defaultvalue_sellcount()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_sellcount, 0 );
    }
    /**
     * 购买时间
     *
     * @var
     */
    const DBKey_selltime = "selltime";

	/**
	 * 获取 购买时间
	 * @return int
	 */
	public function get_selltime()
	{
		return $this->getdata ( self::DBKey_selltime );
	}

	/**
	 * 设置 购买时间
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_selltime($value)
	{
		$this->setdata ( self::DBKey_selltime, intval($value) );
		return $this;
	}

	/**
     * 重置 购买时间
     * 设置为 0
     * @return $this
     */
    public function reset_selltime()
    {
        return $this->reset_defaultValue(self::DBKey_selltime);
    }

    /**
     * 设置 购买时间 默认值
     */
    protected function _set_defaultvalue_selltime()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_selltime, 0 );
    }
    /**
     * 抽奖码
     *
     * @var
     */
    const DBKey_rollCodes = "rollCodes";

	/**
	 * 获取 抽奖码
	 * @return array
	 */
	public function get_rollCodes()
	{
		return $this->getdata ( self::DBKey_rollCodes );
	}

	/**
	 * 设置 抽奖码
	 *
	 * @param array $value
	 * @return $this
	 */
	public function set_rollCodes($value)
	{
		$this->setdata ( self::DBKey_rollCodes, $value );
		return $this;
	}

	/**
     * 重置 抽奖码
     * 设置为 []
     * @return $this
     */
    public function reset_rollCodes()
    {
        return $this->reset_defaultValue(self::DBKey_rollCodes);
    }

    /**
     * 设置 抽奖码 默认值
     */
    protected function _set_defaultvalue_rollCodes()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rollCodes, [] );
    }
    /**
     * 购买者信息
     *
     * @var
     */
    const DBKey_userinfo = "userinfo";

	/**
	 * 获取 购买者信息
	 * @return array
	 */
	public function get_userinfo()
	{
		return $this->getdata ( self::DBKey_userinfo );
	}

	/**
	 * 设置 购买者信息
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
     * 重置 购买者信息
     * 设置为 []
     * @return $this
     */
    public function reset_userinfo()
    {
        return $this->reset_defaultValue(self::DBKey_userinfo);
    }

    /**
     * 设置 购买者信息 默认值
     */
    protected function _set_defaultvalue_userinfo()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_userinfo, [] );
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
        //设置 销售流水号 默认值
        $this->_set_defaultvalue_id();
        //设置 售出的数量 默认值
        $this->_set_defaultvalue_sellcount();
        //设置 购买时间 默认值
        $this->_set_defaultvalue_selltime();
        //设置 抽奖码 默认值
        $this->_set_defaultvalue_rollCodes();
        //设置 购买者信息 默认值
        $this->_set_defaultvalue_userinfo();

    }
}