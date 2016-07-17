<?php

namespace dbs\chef;

use dbs\dbs_basedatacell;

/**
 * 厨师选择数据
 *
 * @author zhipeng
 *
 */
class dbs_chef_choosedata extends dbs_basedatacell {

	/**
	 * 厨师id
	 *
	 * @var string
	 */
	const DBKey_chefid = "chefid";
	/**
	 * 获取 厨师id
	 */
	public function get_chefid() {
		return $this->getdata ( self::DBKey_chefid );
	}
	/**
	 * 设置 厨师id
	 *
	 * @param unknown $value
	 */
	public function set_chefid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_chefid, $value );
	}

	/**
	 * 厨师选择时间
	 *
	 * @var string
	 */
	const DBKey_choosedate = "choosedate";
	/**
	 * 获取 厨师选择时间
	 */
	public function get_choosedate() {
		return $this->getdata ( self::DBKey_choosedate );
	}
	/**
	 * 设置 厨师选择时间
	 *
	 * @param unknown $value
	 */
	public function set_choosedate($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_choosedate, $value );
	}

	/**
	 * 选择时的等级
	 *
	 * @var string
	 */
	const DBKey_chooselevel = "chooselevel";
	/**
	 * 获取 选择时的等级
	 */
	public function get_chooselevel() {
		return $this->getdata ( self::DBKey_chooselevel );
	}
	/**
	 * 设置 选择时的等级
	 *
	 * @param unknown $value
	 */
	public function set_chooselevel($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_chooselevel, $value );
	}
	function __construct() {
		parent::__construct ( array (
				self::DBKey_chefid => '',
				self::DBKey_choosedate => 0,
				self::DBKey_chooselevel => 0
		) );
	}
}