<?php

namespace dbs\buff;

use dbs\dbs_basedatacell;
use configdata\configdata_item_buff_effect_setting;

class dbs_buff_data extends dbs_basedatacell {

	/**
	 * buffid
	 *
	 * @var string
	 */
	const DBKey_buffid = "buffid";
	/**
	 * 获取 buffid
	 */
	public function get_buffid() {
		return $this->getdata ( self::DBKey_buffid );
	}
	/**
	 * 设置 buffid
	 *
	 * @param unknown $value
	 */
	public function set_buffid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_buffid, $value );
	}
	/**
	 * 设置 buffid 默认值
	 */
	protected function _set_defaultvalue_buffid() {
		$this->set_defaultkeyandvalue ( self::DBKey_buffid, '' );
	}

	/**
	 * buff种类id
	 *
	 * @var string
	 */
	const DBKey_buffkindid = "buffkindid";
	/**
	 * 获取 buff种类id
	 */
	public function get_buffkindid() {
		return $this->getdata ( self::DBKey_buffkindid );
	}
	/**
	 * 设置 buff种类id
	 *
	 * @param unknown $value
	 */
	public function set_buffkindid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_buffkindid, $value );
	}
	/**
	 * 设置 buff种类id 默认值
	 */
	protected function _set_defaultvalue_buffkindid() {
		$this->set_defaultkeyandvalue ( self::DBKey_buffkindid, '' );
	}

	/**
	 * timeout
	 *
	 * @var string
	 */
	const DBKey_timeout = "timeout";
	/**
	 * 获取 timeout
	 */
	public function get_timeout() {
		return $this->getdata ( self::DBKey_timeout );
	}
	/**
	 * 设置 timeout
	 *
	 * @param unknown $value
	 */
	private function set_timeout($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_timeout, $value );
	}
	/**
	 * 设置 timeout 默认值
	 */
	protected function _set_defaultvalue_timeout() {
		$this->set_defaultkeyandvalue ( self::DBKey_timeout, 0 );
	}
	function __construct() {
		parent::__construct ( array () );
	}

	/**
	 * 获取当前buff配置
	 */
	public function getbuffconfig() {
		return dbs_buff_list::get_buffconfig ( $this->get_buffid () );
	}

	/**
	 * 叠加buff
	 *
	 * @param unknown $buffid
	 */
	public function addbuff($buffid) {
		$buffconfig = dbs_buff_list::get_buffconfig ( $buffid );
		if (is_null ( $buffconfig )) {
			return false;
		}
		if ($buffconfig [configdata_item_buff_effect_setting::k_kinds] != $this->get_buffkindid ()) {
			return false;
		}
		// 相同的buff,增加持续时间
		if ($buffid == $this->get_buffid ()) {
			$this->set_timeout ( $this->get_timeout () + intval ( $buffconfig [configdata_item_buff_effect_setting::k_duringtime] ) );
		} else {
			$currentconfig = dbs_buff_list::get_buffconfig ( $this->get_buffid () );
			// 低级效果不替换
			if (intval ( $currentconfig [configdata_item_buff_effect_setting::k_level] ) > intval ( $buffconfig [configdata_item_buff_effect_setting::k_level] )) {
				return false;
			} else {
				// 高级效果替换
				$this->set_buffid ( $buffid );
				$this->set_timeout ( time () + intval ( $buffconfig [configdata_item_buff_effect_setting::k_duringtime] ) );
			}
		}

		return TRUE;
	}

	/**
	 * create....
	 *
	 * @param unknown $buffid
	 * @return NULL|\dbs\buff\dbs_buff_data
	 */
	static function create($buffid) {
		$buffconfig = dbs_buff_list::get_buffconfig ( $buffid );
		if (is_null ( $buffconfig )) {
			return null;
		}
		$ins = new self ();
		$ins->set_buffid ( $buffid );
		$ins->set_buffkindid ( $buffconfig [configdata_item_buff_effect_setting::k_kinds] );
		$ins->set_timeout ( time () + intval ( $buffconfig [configdata_item_buff_effect_setting::k_duringtime] ) );
		return $ins;
	}
}