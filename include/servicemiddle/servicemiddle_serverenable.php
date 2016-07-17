<?php

namespace servicemiddle;

use hellaEngine\interfaces\service\middleWare;
use dbs\serverstatus\dbs_serverstatus_manager;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_serverstatus;
use constants\constants_globalerrcode;

/**
 * 服务器是否开启
 *
 * @author zhipeng
 *
 */
class servicemiddle_serverenable implements middleWare {
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \hellaEngine\interfaces\service\middleWare::handle()
	 */
	function handle(array $context, \Closure $next) {
		if (dbs_serverstatus_manager::getInstance ()->getServerState () != constants_serverstatus::STATE_OPEN) {
			return Common_Util_ReturnVar::RetFail ( constants_globalerrcode::SERVER_STATE_ERROR, [
					'ServerStateCode' => dbs_serverstatus_manager::getInstance ()->getServerState ()
			], 'SERVER_CLOSE' );
		}

		return $next ( $context );
	}

	/**
	 * singleton
	 */
	private static $_instance;
	private function __construct() {
		// echo 'This is a Constructed method;';
	}
	public function __clone() {
		trigger_error ( 'Clone is not allow!', E_USER_ERROR );
	}
	// 单例方法,用于访问实例的公共的静态方法
	public static function getInstance() {
		if (! (self::$_instance instanceof static)) {
			self::$_instance = new static ();
		}
		return self::$_instance;
	}
}