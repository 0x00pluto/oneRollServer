<?php

namespace dbs\notice;

use dbs\dbs_basedatacell;

/**
 * 滚动公告数据
 *
 * @author zhipeng
 *
 */
class dbs_notice_publicdata extends dbs_basedatacell {

	/**
	 * 发送时间
	 *
	 * @var string
	 */
	const DBKey_sendtime = "sendtime";
	/**
	 * 获取 发送时间
	 */
	public function get_sendtime() {
		return $this->getdata ( self::DBKey_sendtime );
	}
	/**
	 * 设置 发送时间
	 *
	 * @param unknown $value
	 */
	public function set_sendtime($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_sendtime, $value );
	}
	/**
	 * 设置 发送时间 默认值
	 */
	protected function _set_defaultvalue_sendtime() {
		$this->set_defaultkeyandvalue ( self::DBKey_sendtime, 0 );
	}

	/**
	 * 持续时间
	 *
	 * @var string
	 */
	const DBKey_duringtime = "duringtime";
	/**
	 * 获取 持续时间
	 */
	public function get_duringtime() {
		return $this->getdata ( self::DBKey_duringtime );
	}
	/**
	 * 设置 持续时间
	 *
	 * @param unknown $value
	 */
	public function set_duringtime($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_duringtime, $value );
	}
	/**
	 * 设置 持续时间 默认值
	 */
	protected function _set_defaultvalue_duringtime() {
		$this->set_defaultkeyandvalue ( self::DBKey_duringtime, null );
	}

	/**
	 * 发送者guid
	 *
	 * @var string
	 */
	const DBKey_senduserid = "senduserid";
	/**
	 * 获取 发送者guid
	 */
	public function get_senduserid() {
		return $this->getdata ( self::DBKey_senduserid );
	}
	/**
	 * 设置 发送者guid
	 *
	 * @param unknown $value
	 */
	public function set_senduserid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_senduserid, $value );
	}
	/**
	 * 设置 发送者guid 默认值
	 */
	protected function _set_defaultvalue_senduserid() {
		$this->set_defaultkeyandvalue ( self::DBKey_senduserid, null );
	}

	/**
	 * 内容
	 *
	 * @var string
	 */
	const DBKey_contents = "contents";
	/**
	 * 获取 内容
	 */
	public function get_contents() {
		return $this->getdata ( self::DBKey_contents );
	}
	/**
	 * 设置 内容
	 *
	 * @param unknown $value
	 */
	public function set_contents($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_contents, $value );
	}
	/**
	 * 设置 内容 默认值
	 */
	protected function _set_defaultvalue_contents() {
		$this->set_defaultkeyandvalue ( self::DBKey_contents, null );
	}
	function __construct() {
		parent::__construct ( array () );
	}

	/**
	 * 创建聊天消息
	 *
	 * @param unknown $contents
	 * @param unknown $duringtime
	 * @param string $senduserid
	 * @return dbs_notice_publicdata
	 */
	static function create($contents, $duringtime, $senduserid = "-1") {
		$ins = new self ();
		$ins->set_contents ( $contents );
		$ins->set_duringtime ( $duringtime );
		$ins->set_senduserid ( $senduserid );

		return $ins;
	}
}