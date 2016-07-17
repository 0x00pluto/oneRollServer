<?php

namespace dbs\trade;

use dbs\dbs_basedatacell;
use dbs\i\dbs_i_iday;
use Common\Util\Common_Util_Time;
use Common\Util\Common_Util_Array;
use Common\Util\Common_Util_Configdata;

/**
 * 交易限制
 *
 * @author zhipeng
 *
 */
class dbs_trade_limit extends dbs_basedatacell implements dbs_i_iday {

	/**
	 * 完成订单的用户id
	 *
	 * @var string
	 */
	const DBKey_completetradeuseridlist = "completetradeuseridlist";
	/**
	 * 获取 完成订单的用户id
	 */
	public function get_completetradeuseridlist() {
		return $this->getdata ( self::DBKey_completetradeuseridlist );
	}
	/**
	 * 设置 完成订单的用户id
	 *
	 * @param unknown $value
	 */
	public function set_completetradeuseridlist($value) {
		// $value = strval ( $value );
		$this->setdata ( self::DBKey_completetradeuseridlist, $value );
	}
	/**
	 * 设置 完成订单的用户id 默认值
	 */
	protected function _set_defaultvalue_completetradeuseridlist() {
		$this->set_defaultkeyandvalue ( self::DBKey_completetradeuseridlist, array () );
	}

	/**
	 * 每日完成交易的总次数
	 *
	 * @var string
	 */
	const DBKey_todaycompletetimes = "todaycompletetimes";
	/**
	 * 获取 每日完成交易的总次数
	 */
	public function get_todaycompletetimes() {
		return $this->getdata ( self::DBKey_todaycompletetimes );
	}
	/**
	 * 设置 每日完成交易的总次数
	 *
	 * @param unknown $value
	 */
	public function set_todaycompletetimes($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_todaycompletetimes, $value );
	}
	/**
	 * 设置 每日完成交易的总次数 默认值
	 */
	protected function _set_defaultvalue_todaycompletetimes() {
		$this->set_defaultkeyandvalue ( self::DBKey_todaycompletetimes, 0 );
	}

	/**
	 * 更新日期
	 *
	 * @var string
	 */
	const DBKey_dayflag = "dayflag";
	/**
	 * 获取 更新日期
	 */
	public function get_dayflag() {
		return $this->getdata ( self::DBKey_dayflag );
	}
	/**
	 * 设置 更新日期
	 *
	 * @param unknown $value
	 */
	public function set_dayflag($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_dayflag, $value );
	}
	/**
	 * 设置 更新日期 默认值
	 */
	protected function _set_defaultvalue_dayflag() {
		$this->set_defaultkeyandvalue ( self::DBKey_dayflag, 0 );
	}

	/**
	 * 交易完成的总次数
	 *
	 * @var string
	 */
	const DBKey_tradecompletetotalcount = "tradecompletetotalcount";
	/**
	 * 获取 交易完成的总次数
	 */
	public function get_tradecompletetotalcount() {
		return $this->getdata ( self::DBKey_tradecompletetotalcount );
	}
	/**
	 * 设置 交易完成的总次数
	 *
	 * @param unknown $value
	 */
	public function set_tradecompletetotalcount($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_tradecompletetotalcount, $value );
	}
	/**
	 * 设置 交易完成的总次数 默认值
	 */
	protected function _set_defaultvalue_tradecompletetotalcount() {
		$this->set_defaultkeyandvalue ( self::DBKey_tradecompletetotalcount, 0 );
	}
	function __construct() {
		parent::__construct ( array () );
	}
	function nextday() {
		if (Common_Util_Time::getGameDay () != $this->get_dayflag ()) {
			$this->set_dayflag ( Common_Util_Time::getGameDay () );
			$this->set_completetradeuseridlist ( array () );
			$this->set_todaycompletetimes ( 0 );
		}
	}
	/**
	 * 添加交易记录
	 *
	 * @param unknown $buyuserid
	 * @param dbs_trade_data $tradedata
	 */
	function addtrade($buyuserid, dbs_trade_data $tradedata) {
		$buyuserid = strval ( $buyuserid );
		$tradelist = $this->get_completetradeuseridlist ();
		$tradenum = Common_Util_Array::getvalue ( $tradelist, $buyuserid, 0 )->int_value ();
		$tradenum ++;
		$tradelist [$buyuserid] = $tradenum;
		$this->set_completetradeuseridlist ( $tradelist );

		// 每日次数增加
		$this->set_todaycompletetimes ( $this->get_todaycompletetimes () + 1 );

		// 总次数增加
		$this->set_tradecompletetotalcount ( $this->get_tradecompletetotalcount () + 1 );
	}

	/**
	 * 本日交易次数是否已经满了
	 *
	 * @return boolean
	 */
	function is_trade_times_max() {
		$maxtime = Common_Util_Configdata::getInstance ()->get_global_config_value ( 'TRADE_EVERYDAY_TOTAL_TIMES' )->int_value ();
		return $this->get_todaycompletetimes () >= $maxtime;
	}
	/**
	 * 单个用户交易次数已经满了
	 *
	 * @param unknown $userid
	 * @return boolean
	 */
	function is_trade_times_max_by_userid($userid) {
		$userid = strval ( $userid );
		$tradelist = $this->get_completetradeuseridlist ();
		$tradenum = Common_Util_Array::getvalue ( $tradelist, $userid, 0 )->int_value ();

		$maxtime = Common_Util_Configdata::getInstance ()->get_global_config_value ( 'TRADE_EVERYDAY_DESTUSER_TOTAL_TIMES' )->int_value ();
		return $tradenum >= $maxtime;
	}
}