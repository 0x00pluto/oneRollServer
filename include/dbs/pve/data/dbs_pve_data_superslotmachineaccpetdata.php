<?php

namespace dbs\pve\data;

use dbs\dbs_basedatacell;

/**
 * 老虎机接收数据
 *
 * @author zhipeng
 *
 */
class dbs_pve_data_superslotmachineaccpetdata extends dbs_basedatacell {

	/**
	 * 老虎机id
	 *
	 * @var string
	 */
	const DBKey_slotmachineid = "slotmachineid";
	/**
	 * 获取 老虎机id
	 */
	public function get_slotmachineid() {
		return $this->getdata ( self::DBKey_slotmachineid );
	}
	/**
	 * 设置 老虎机id
	 *
	 * @param unknown $value
	 */
	public function set_slotmachineid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_slotmachineid, $value );
	}
	/**
	 * 设置 老虎机id 默认值
	 */
	protected function _set_defaultvalue_slotmachineid() {
		$this->set_defaultkeyandvalue ( self::DBKey_slotmachineid, null );
	}

	/**
	 * 拥有者id
	 *
	 * @var string
	 */
	const DBKey_owneruserid = "owneruserid";
	/**
	 * 获取 拥有者id
	 */
	public function get_owneruserid() {
		return $this->getdata ( self::DBKey_owneruserid );
	}
	/**
	 * 设置 拥有者id
	 *
	 * @param unknown $value
	 */
	public function set_owneruserid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_owneruserid, $value );
	}
	/**
	 * 设置 拥有者id 默认值
	 */
	protected function _set_defaultvalue_owneruserid() {
		$this->set_defaultkeyandvalue ( self::DBKey_owneruserid, null );
	}

	/**
	 * 接收时间
	 *
	 * @var string
	 */
	const DBKey_accpettime = "accpettime";
	/**
	 * 获取 接收时间
	 */
	public function get_accpettime() {
		return $this->getdata ( self::DBKey_accpettime );
	}
	/**
	 * 设置 接收时间
	 *
	 * @param unknown $value
	 */
	public function set_accpettime($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_accpettime, $value );
	}
	/**
	 * 设置 接收时间 默认值
	 */
	protected function _set_defaultvalue_accpettime() {
		$this->set_defaultkeyandvalue ( self::DBKey_accpettime, 0 );
	}
	function __construct() {
		parent::__construct ( array () );
	}

	/**
	 * create...
	 *
	 * @param dbs_pve_data_superslotmachine $slotmachine
	 * @return \dbs\pve\data\dbs_pve_data_superslotmachineaccpetdata
	 */
	static function create(dbs_pve_data_superslotmachine $slotmachine) {
		$ins = new self ();
		$ins->set_owneruserid ( $slotmachine->get_ownerguid () );
		$ins->set_accpettime ( time () );
		$ins->set_slotmachineid ( $slotmachine->get_id () );
		return $ins;
	}
}