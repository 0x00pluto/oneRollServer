<?php

namespace dbs\templates\mall;

use dbs\dbs_base as super;

/**
 * auto create by gameConsole!!
 * sourceFile:
 * Class dbs_templates_mall_goodsSellInfoDetail
 * @package dbs\templates\mall
 */
abstract class dbs_templates_mall_goodsSellInfoDetail extends super
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "mall_goodsSellInfoDetails";
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
     * 商品流水号
     *
     * @var
     */
    const DBKey_mallGoodsId = "mallGoodsId";

	/**
	 * 获取 商品流水号
	 * @return string
	 */
	public function get_mallGoodsId()
	{
		return $this->getdata ( self::DBKey_mallGoodsId );
	}

	/**
	 * 设置 商品流水号
	 *
	 * @param string $value
	 * @return $this
	 */
	public function set_mallGoodsId($value)
	{
		$this->setdata ( self::DBKey_mallGoodsId, strval($value) );
		return $this;
	}

	/**
     * 重置 商品流水号
     * 设置为 ""
     * @return $this
     */
    public function reset_mallGoodsId()
    {
        return $this->reset_defaultValue(self::DBKey_mallGoodsId);
    }

    /**
     * 设置 商品流水号 默认值
     */
    protected function _set_defaultvalue_mallGoodsId()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_mallGoodsId, "" );
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
     * 抽奖时间戳
     *
     * @var
     */
    const DBKey_rolltimeSpan = "rolltimeSpan";

	/**
	 * 获取 抽奖时间戳
	 * @return int
	 */
	public function get_rolltimeSpan()
	{
		return $this->getdata ( self::DBKey_rolltimeSpan );
	}

	/**
	 * 设置 抽奖时间戳
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_rolltimeSpan($value)
	{
		$this->setdata ( self::DBKey_rolltimeSpan, intval($value) );
		return $this;
	}

	/**
     * 重置 抽奖时间戳
     * 设置为 0
     * @return $this
     */
    public function reset_rolltimeSpan()
    {
        return $this->reset_defaultValue(self::DBKey_rolltimeSpan);
    }

    /**
     * 设置 抽奖时间戳 默认值
     */
    protected function _set_defaultvalue_rolltimeSpan()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rolltimeSpan, 0 );
    }
    /**
     * 抽奖码
     *
     * @var
     */
    const DBKey_rollCode = "rollCode";

	/**
	 * 获取 抽奖码
	 * @return int
	 */
	public function get_rollCode()
	{
		return $this->getdata ( self::DBKey_rollCode );
	}

	/**
	 * 设置 抽奖码
	 *
	 * @param int $value
	 * @return $this
	 */
	public function set_rollCode($value)
	{
		$this->setdata ( self::DBKey_rollCode, intval($value) );
		return $this;
	}

	/**
     * 重置 抽奖码
     * 设置为 0
     * @return $this
     */
    public function reset_rollCode()
    {
        return $this->reset_defaultValue(self::DBKey_rollCode);
    }

    /**
     * 设置 抽奖码 默认值
     */
    protected function _set_defaultvalue_rollCode()
    {
        $this->set_defaultkeyandvalue ( self::DBKey_rollCode, 0 );
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
        //设置 商品流水号 默认值
        $this->_set_defaultvalue_mallGoodsId();
        //设置 售出的数量 默认值
        $this->_set_defaultvalue_sellcount();
        //设置 购买时间 默认值
        $this->_set_defaultvalue_selltime();
        //设置 抽奖时间戳 默认值
        $this->_set_defaultvalue_rolltimeSpan();
        //设置 抽奖码 默认值
        $this->_set_defaultvalue_rollCode();
        //设置 用户ID 默认值
        $this->_set_defaultvalue_userid();
        //设置 购买者信息 默认值
        $this->_set_defaultvalue_userinfo();

    }
}