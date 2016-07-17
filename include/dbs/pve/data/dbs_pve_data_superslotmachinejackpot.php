<?php

namespace dbs\pve\data;

use dbs\dbs_basedatacell;

class dbs_pve_data_superslotmachinejackpot extends dbs_basedatacell {

	/**
	 * 超级老虎机id
	 *
	 * @var string
	 */
	const DBKey_slotmachineid = "slotmachineid";
	/**
	 * 获取 超级老虎机id
	 */
	public function get_slotmachineid() {
		return $this->getdata ( self::DBKey_slotmachineid );
	}
	/**
	 * 设置 超级老虎机id
	 *
	 * @param unknown $value
	 */
	public function set_slotmachineid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_slotmachineid, $value );
	}
	/**
	 * 设置 超级老虎机id 默认值
	 */
	protected function _set_defaultvalue_slotmachineid() {
		$this->set_defaultkeyandvalue ( self::DBKey_slotmachineid, '' );
	}

	/**
	 * 是否计算了超级大奖
	 *
	 * @var string
	 */
	const DBKey_iscompute = "iscompute";
	/**
	 * 获取 是否计算了超级大奖
	 */
	public function get_iscompute() {
		return $this->getdata ( self::DBKey_iscompute );
	}
	/**
	 * 设置 是否计算了超级大奖
	 *
	 * @param unknown $value
	 */
	public function set_iscompute($value) {
		$value = boolval ( $value );
		$this->setdata ( self::DBKey_iscompute, $value );
	}
	/**
	 * 设置 是否计算了超级大奖 默认值
	 */
	protected function _set_defaultvalue_iscompute() {
		$this->set_defaultkeyandvalue ( self::DBKey_iscompute, false );
	}

	/**
	 * 奖励钻石数
	 *
	 * @var string
	 */
	const DBKey_awarddiamonds = "awarddiamonds";
	/**
	 * 获取 奖励钻石数
	 */
	public function get_awarddiamonds() {
		return $this->getdata ( self::DBKey_awarddiamonds );
	}
	/**
	 * 设置 奖励钻石数
	 *
	 * @param unknown $value
	 */
	public function set_awarddiamonds($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_awarddiamonds, $value );
	}
	/**
	 * 设置 奖励钻石数 默认值
	 */
	protected function _set_defaultvalue_awarddiamonds() {
		$this->set_defaultkeyandvalue ( self::DBKey_awarddiamonds, 0 );
	}

	/**
	 * 是否激活超级大奖
	 *
	 * @var string
	 */
	const DBKey_isactive = "isactive";
	/**
	 * 获取 是否激活超级大奖
	 */
	public function get_isactive() {
		return $this->getdata ( self::DBKey_isactive );
	}
	/**
	 * 设置 是否激活超级大奖
	 *
	 * @param unknown $value
	 */
	public function set_isactive($value) {
		$value = boolval ( $value );
		$this->setdata ( self::DBKey_isactive, $value );
	}
	/**
	 * 设置 是否激活超级大奖 默认值
	 */
	protected function _set_defaultvalue_isactive() {
		$this->set_defaultkeyandvalue ( self::DBKey_isactive, false );
	}

	/**
	 * 领取列表
	 *
	 * @var string
	 */
	const DBKey_recvlist = "recvlist";
	/**
	 * 获取 领取列表
	 */
	public function get_recvlist() {
		return $this->getdata ( self::DBKey_recvlist );
	}
	/**
	 * 设置 领取列表
	 *
	 * @param unknown $value
	 */
	public function set_recvlist($value) {
		// $value = strval($value);
		$this->setdata ( self::DBKey_recvlist, $value );
	}
	/**
	 * 设置 领取列表 默认值
	 */
	protected function _set_defaultvalue_recvlist() {
		$this->set_defaultkeyandvalue ( self::DBKey_recvlist, array () );
	}

	/**
	 * 超时时间
	 *
	 * @var string
	 */
	const DBKey_timeout = "timeout";
	/**
	 * 获取 超时时间
	 */
	public function get_timeout() {
		return $this->getdata ( self::DBKey_timeout );
	}
	/**
	 * 设置 超时时间
	 *
	 * @param unknown $value
	 */
	public function set_timeout($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_timeout, $value );
	}
	/**
	 * 设置 超时时间 默认值
	 */
	protected function _set_defaultvalue_timeout() {
		$this->set_defaultkeyandvalue ( self::DBKey_timeout, 0 );
	}
	function __construct() {
		parent::__construct ( array () );
	}
	/**
	 * 领取奖励
	 *
	 * @param unknown $userid
	 */
	function recvawarid($userid) {
		$userid = strval ( $userid );
		$list = $this->get_recvlist ();
		$list [$userid] = time ();
		$this->set_recvlist ( $list );
	}

	/**
	 * 是否领取奖励
	 *
	 * @param unknown $userid
	 */
	function isrecv($userid) {
		$userid = strval ( $userid );
		$list = $this->get_recvlist ();
		return isset ( $list [$userid] );
	}
}