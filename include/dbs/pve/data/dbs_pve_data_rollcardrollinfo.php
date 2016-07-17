<?php

namespace dbs\pve\data;

use dbs\dbs_basedatacell;

class dbs_pve_data_rollcardrollinfo extends dbs_basedatacell {
	function __construct() {
		parent::__construct ( [ ] );
	}

	/**
	 * awarditemid
	 *
	 * @var string
	 */
	const DBKey_awarditemid = "awarditemid";
	/**
	 * 获取 awarditemid
	 */
	public function get_awarditemid() {
		return $this->getdata ( self::DBKey_awarditemid );
	}
	/**
	 * 设置 awarditemid
	 *
	 * @param unknown $value
	 */
	public function set_awarditemid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_awarditemid, $value );
	}
	/**
	 * 设置 awarditemid 默认值
	 */
	protected function _set_defaultvalue_awarditemid() {
		$this->set_defaultkeyandvalue ( self::DBKey_awarditemid, '' );
	}

	/**
	 * awarditemcount
	 *
	 * @var string
	 */
	const DBKey_awarditemcount = "awarditemcount";
	/**
	 * 获取 awarditemcount
	 */
	public function get_awarditemcount() {
		return $this->getdata ( self::DBKey_awarditemcount );
	}
	/**
	 * 设置 awarditemcount
	 *
	 * @param unknown $value
	 */
	public function set_awarditemcount($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_awarditemcount, $value );
	}
	/**
	 * 设置 awarditemcount 默认值
	 */
	protected function _set_defaultvalue_awarditemcount() {
		$this->set_defaultkeyandvalue ( self::DBKey_awarditemcount, 0 );
	}
}