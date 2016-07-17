<?php

namespace dbs\equipment;

use dbs\dbs_basedatacell;

/**
 * 赠与出去装备的数据
 *
 * @author zhipeng
 *
 */
class dbs_equipment_givedata extends dbs_basedatacell {

	/**
	 * 赠与的用户id
	 *
	 * @var string
	 */
	const DBKey_giveuserid = "giveuserid";
	/**
	 * 获取 赠与的用户id
	 */
	public function get_giveuserid() {
		return $this->getdata ( self::DBKey_giveuserid );
	}
	/**
	 * 设置 赠与的用户id
	 *
	 * @param unknown $value
	 */
	public function set_giveuserid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_giveuserid, $value );
	}

	/**
	 * 装备位置列表
	 *
	 * @var string
	 */
	const DBKey_equipmentposlist = "equipmentposlist";
	/**
	 * 获取 装备位置列表
	 */
	public function get_equipmentposlist() {
		return $this->getdata ( self::DBKey_equipmentposlist );
	}
	/**
	 * 设置 装备位置列表
	 *
	 * @param unknown $value
	 */
	private function set_equipmentposlist($value) {
		// $value = strval ( $value );
		$this->setdata ( self::DBKey_equipmentposlist, $value );
	}
	function __construct() {
		parent::__construct ( array (
				self::DBKey_giveuserid => '',
				self::DBKey_equipmentposlist => array ()
		) );
	}

	/**
	 * 赠与装备
	 *
	 * @param string $newpos
	 *        	新的装备
	 * @param string $replacepos
	 *        	需要替换的装备
	 */
	public function giveequipment($newpos, $replacepos = NULL) {
		$equipmentlist = $this->get_equipmentposlist ();
		$equipmentlist [$newpos] = time ();
		if (! is_null ( $replacepos )) {
			unset ( $equipmentlist [$replacepos] );
		}
		$this->set_equipmentposlist ( $equipmentlist );
	}
}