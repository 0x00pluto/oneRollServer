<?php

namespace dbs\pve\data;

use dbs\dbs_basedatacell;
use constants\constants_pvegrade;

class dbs_pve_data_battlerecord extends dbs_basedatacell {

	/**
	 * 关卡id
	 *
	 * @var string
	 */
	const DBKey_stageid = "stageid";
	/**
	 * 获取 关卡id
	 */
	public function get_stageid() {
		return $this->getdata ( self::DBKey_stageid );
	}
	/**
	 * 设置 关卡id
	 *
	 * @param unknown $value
	 */
	public function set_stageid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_stageid, $value );
	}
	/**
	 * 设置 关卡id 默认值
	 */
	protected function _set_defaultvalue_stageid() {
		$this->set_defaultkeyandvalue ( self::DBKey_stageid, null );
	}

	/**
	 * 关卡评级 S A B F
	 *
	 * @var string
	 */
	const DBKey_stagegrade = "stagegrade";
	/**
	 * 获取 关卡评级
	 */
	public function get_stagegrade() {
		return $this->getdata ( self::DBKey_stagegrade );
	}
	/**
	 * 设置 关卡评级
	 *
	 * @param unknown $value
	 */
	public function set_stagegrade($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_stagegrade, $value );
	}
	/**
	 * 设置 关卡评级 默认值
	 */
	protected function _set_defaultvalue_stagegrade() {
		$this->set_defaultkeyandvalue ( self::DBKey_stagegrade, constants_pvegrade::GRADE_F );
	}
	function __construct() {
		parent::__construct ( array () );
	}
}