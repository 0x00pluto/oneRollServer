<?php

namespace dbs\scenebox;

use dbs\dbs_basedatacell;
use Common\Util\Common_Util_Guid;

class dbs_scenebox_data extends dbs_basedatacell {

	/**
	 * 宝箱guid
	 *
	 * @var string
	 */
	const DBKey_boxid = "boxid";
	/**
	 * 获取 宝箱guid
	 */
	public function get_boxid() {
		return $this->getdata ( self::DBKey_boxid );
	}
	/**
	 * 设置 宝箱guid
	 *
	 * @param unknown $value
	 */
	public function set_boxid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_boxid, $value );
	}
	/**
	 * 设置 宝箱guid 默认值
	 */
	protected function _set_defaultvalue_boxid() {
		$this->set_defaultkeyandvalue ( self::DBKey_boxid, "" );
	}

	/**
	 * 宝箱配置id
	 *
	 * @var string
	 */
	const DBKey_boxconfigid = "boxconfigid";
	/**
	 * 获取 宝箱配置id
	 */
	public function get_boxconfigid() {
		return $this->getdata ( self::DBKey_boxconfigid );
	}
	/**
	 * 设置 宝箱配置id
	 *
	 * @param unknown $value
	 */
	public function set_boxconfigid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_boxconfigid, $value );
	}
	/**
	 * 设置 宝箱配置id 默认值
	 */
	protected function _set_defaultvalue_boxconfigid() {
		$this->set_defaultkeyandvalue ( self::DBKey_boxconfigid, "" );
	}

	/**
	 * 获取宝箱配置
	 *
	 * @return array
	 */
	public function get_boxconfig() {
		return dbs_scenebox_scenebox::get_box_config ( $this->get_boxconfigid () );
	}
	function __construct() {
		parent::__construct ( array () );
	}
	/**
	 * create...
	 *
	 * @param unknown $boxconfigid
	 * @return \dbs\scenebox\dbs_scenebox_data
	 */
	public static function create($boxconfigid) {
		$ins = new self ();

		$ins->set_boxid ( Common_Util_Guid::gen_box_guid () );
		$ins->set_boxconfigid ( $boxconfigid );

		return $ins;
	}
}