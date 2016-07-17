<?php

namespace dbs\custom;

use Common\Util\Common_Util_Guid;
use constants\constants_customtype;

/**
 * 好友信息
 *
 * @author zhipeng
 *
 */
class dbs_custom_visitordatafriend extends dbs_custom_visitordata {

	/**
	 * 用户信息
	 *
	 * @var string
	 */
	const DBKey_friendinfo = "friendinfo";
	/**
	 * 获取 用户信息
	 */
	public function get_friendinfo() {
		return $this->getdata ( self::DBKey_friendinfo );
	}
	/**
	 * 设置 用户信息
	 *
	 * @param unknown $value
	 */
	public function set_friendinfo($value) {
		// $value = strval($value);
		$this->setdata ( self::DBKey_friendinfo, $value );
	}
	/**
	 * 设置 用户信息 默认值
	 */
	protected function _set_defaultvalue_friendinfo() {
		$this->set_defaultkeyandvalue ( self::DBKey_friendinfo, array () );
	}

	/**
	 * 是否是我的好友
	 *
	 * @var string
	 */
	const DBKey_isfriend = "isfriend";
	/**
	 * 获取 是否是我的好友
	 */
	public function get_isfriend() {
		return $this->getdata ( self::DBKey_isfriend );
	}
	/**
	 * 设置 是否是我的好友
	 *
	 * @param unknown $value
	 */
	public function set_isfriend($value) {
		$value = boolval ( $value );
		$this->setdata ( self::DBKey_isfriend, $value );
	}
	/**
	 * 设置 是否是我的好友 默认值
	 */
	protected function _set_defaultvalue_isfriend() {
		$this->set_defaultkeyandvalue ( self::DBKey_isfriend, false );
	}
	function __construct() {
		parent::__construct ();
	}

	/**
	 *
	 * @param unknown $npcid
	 * @return dbs_custom_visitordatafriend
	 */
	static function create($npcid) {
		$ins = new self ();
		$ins->set_npcid ( $npcid );
		$ins->set_guid ( Common_Util_Guid::gen_visitor () );
		$ins->set_npctype ( constants_customtype::FRIEND );
		return $ins;
	}
}