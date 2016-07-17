<?php

namespace dbs\friendvisitor;

use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\dbs_basedatacell;

class dbs_friendvisitor_data extends dbs_basedatacell {

	/**
	 * 用户id
	 *
	 * @var string
	 */
	const DBKey_userid = "userid";
	/**
	 * 获取 用户id
	 */
	public function get_userid() {
		return $this->getdata ( self::DBKey_userid );
	}
	/**
	 * 设置 用户id
	 *
	 * @param unknown $value
	 */
	private function set_userid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_userid, $value );
	}
	/**
	 * 设置 用户id 默认值
	 */
	protected function _set_defaultvalue_userid() {
		$this->set_defaultkeyandvalue ( self::DBKey_userid, null );
	}

	/**
	 * 用户信息
	 *
	 * @var string
	 */
	const DBKey_userinfo = "userinfo";
	/**
	 * 获取 用户信息
	 */
	public function get_userinfo() {
		return $this->getdata ( self::DBKey_userinfo );
	}
	/**
	 * 设置 用户信息
	 *
	 * @param unknown $value
	 */
	private function set_userinfo($value) {
		// $value = arr($value);
		$this->setdata ( self::DBKey_userinfo, $value );
	}
	/**
	 * 设置 用户信息 默认值
	 */
	protected function _set_defaultvalue_userinfo() {
		$this->set_defaultkeyandvalue ( self::DBKey_userinfo, array () );
	}

	/**
	 * 访问时间
	 *
	 * @var string
	 *
	 */
	const DBKey_visittime = "visittime";
	/**
	 * 获取 访问时间
	 */
	public function get_visittime() {
		return $this->getdata ( self::DBKey_visittime );
	}
	/**
	 * 设置 访问时间
	 *
	 * @param unknown $value
	 */
	private function set_visittime($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_visittime, $value );
	}
	/**
	 * 设置 访问时间 默认值
	 */
	protected function _set_defaultvalue_visittime() {
		$this->set_defaultkeyandvalue ( self::DBKey_visittime, 0 );
	}
	function __construct() {
		parent::__construct ( array () );
	}
	/**
	 * 创建数据
	 *
	 * @param string $userid 用户id
	 * @return \dbs\friendvisitor\dbs_friendvisitor_data
	 */
	static function create($userid) {
		$userid = strval ( $userid );
		$ins = new self ();

		$ins->set_userid ( $userid );
		$destplayer = dbs_player::newGuestPlayer( $userid );
		$ins->set_userinfo ( $destplayer->db_role ()->toArray ( dbs_filters_role::$filters_simple_info ) );
		$ins->set_visittime ( time () );

		return $ins;
	}
}