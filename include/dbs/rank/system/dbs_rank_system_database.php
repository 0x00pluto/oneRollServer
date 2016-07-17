<?php

namespace dbs\rank\system;

use dbs\dbs_basedatacell;
use dbs\dbs_player;

class dbs_rank_system_database extends dbs_basedatacell {

	/**
	 * userid
	 *
	 * @var string
	 */
	const DBKey_userid = "userid";
	/**
	 * 获取 userid
	 */
	public function get_userid() {
		return $this->getdata ( self::DBKey_userid );
	}
	/**
	 * 设置 userid
	 *
	 * @param unknown $value
	 */
	public function set_userid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_userid, $value );
	}
	/**
	 * 设置 userid 默认值
	 */
	protected function _set_defaultvalue_userid() {
		$this->set_defaultkeyandvalue ( self::DBKey_userid, null );
	}

	/**
	 * 用户名
	 *
	 * @var string
	 */
	const DBKey_rolename = "rolename";
	/**
	 * 获取 用户名
	 */
	public function get_rolename() {
		return $this->getdata ( self::DBKey_rolename );
	}
	/**
	 * 设置 用户名
	 *
	 * @param unknown $value
	 */
	public function set_rolename($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_rolename, $value );
	}
	/**
	 * 设置 用户名 默认值
	 */
	protected function _set_defaultvalue_rolename() {
		$this->set_defaultkeyandvalue ( self::DBKey_rolename, null );
	}

	/**
	 * 排行的值
	 *
	 * @var string
	 */
	const DBKey_rankvalue = "rankvalue";
	/**
	 * 获取 排行的值
	 */
	public function get_rankvalue() {
		return $this->getdata ( self::DBKey_rankvalue );
	}
	/**
	 * 设置 排行的值
	 *
	 * @param unknown $value
	 */
	public function set_rankvalue($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_rankvalue, $value );
	}
	/**
	 * 设置 排行的值 默认值
	 */
	protected function _set_defaultvalue_rankvalue() {
		$this->set_defaultkeyandvalue ( self::DBKey_rankvalue, 0 );
	}

	/**
	 * vip信息
	 *
	 * @var string
	 */
	const DBKey_vipinfo = "vipinfo";
	/**
	 * 获取 vip信息
	 */
	public function get_vipinfo() {
		return $this->getdata ( self::DBKey_vipinfo );
	}
	/**
	 * 设置 vip信息
	 *
	 * @param unknown $value
	 */
	public function set_vipinfo($value) {
		// $value = strval($value);
		$this->setdata ( self::DBKey_vipinfo, $value );
	}
	/**
	 * 设置 vip信息 默认值
	 */
	protected function _set_defaultvalue_vipinfo() {
		$this->set_defaultkeyandvalue ( self::DBKey_vipinfo, array () );
	}

	/**
	 * 排行扩展数据
	 *
	 * @var string
	 */
	const DBKey_rankextinfo = "rankextinfo";
	/**
	 * 获取 排行扩展数据
	 */
	public function get_rankextinfo() {
		return $this->getdata ( self::DBKey_rankextinfo );
	}
	/**
	 * 设置 排行扩展数据
	 *
	 * @param unknown $value
	 */
	public function set_rankextinfo($value) {
		// $value = strval($value);
		$this->setdata ( self::DBKey_rankextinfo, $value );
	}
	/**
	 * 设置 排行扩展数据 默认值
	 */
	protected function _set_defaultvalue_rankextinfo() {
		$this->set_defaultkeyandvalue ( self::DBKey_rankextinfo, array () );
	}
	function __construct() {
		parent::__construct ( array () );
	}

	/**
	 * 创建排行数据
	 *
	 * @param dbs_player $player
	 * @param unknown $rankvalue
	 * @return dbs_rank_system_database
	 */
	public static function create(dbs_player $player, $rankvalue, $rankextinfo = array()) {
		$ins = new self ();
		$ins->set_userid ( $player->get_userid () );
		$ins->set_rolename ( $player->db_role ()->get_rolename () );
		$ins->set_rankvalue ( $rankvalue );
		$ins->set_vipinfo ( $player->dbs_vip ()->get_viplevelinfo () );
		$ins->set_rankextinfo ( $rankextinfo );

		return $ins;
	}
}