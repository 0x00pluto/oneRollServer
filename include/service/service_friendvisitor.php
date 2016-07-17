<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 好友访问
 * @auther zhipeng
 */
class service_friendvisitor extends service_base {
	function __construct() {
		$this->addFunctions ( array (
				'getinfo',
				'visit'
		) );
	}
	protected function get_dbins() {
		return $this->callerUserInstance->dbs_friendvisitor_visitor ();
	}
	protected function get_err_class_name() {
		return "err\\" . "err_dbs_friendvisitor_visitor" . "_";
	}
	/**
	 * 获得信息
	 *
	 * @return \Common\Util\Common_Util_ReturnVar
	 */
	function getinfo() {
		$retCode = 0;
		$retCode_Str = 'SUCC';
		$data = array ();
		// class err_service_friendvisitor_getinfo{}

		$data = $this->get_dbins ()->toArray ();
		// code

		succ:
		return Common_Util_ReturnVar::Ret ( true, $retCode, $data, $retCode_Str );
		failed:
		return Common_Util_ReturnVar::Ret ( false, $retCode, $data, $retCode_Str );
	}

	/**
	 * 访问
	 *
	 * @param unknown $destuserid
	 * @return \Common\Util\Common_Util_ReturnVar
	 */
	function visit($destuserid) {
		typeCheckUserId($destuserid);
		return $this->get_dbins ()->visit ( $destuserid );
	}
}