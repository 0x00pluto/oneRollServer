<?php

namespace dbs\push;

use dbs\push\service\dbs_push_service_base;
use dbs\push\service\dbs_push_service_iphone;
use dbs\push\service\dbs_push_service_android;

class dbs_push_service {
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
		if (! (self::$_instance instanceof self)) {
			self::$_instance = new self ();
		}
		return self::$_instance;
	}

	/**
	 *
	 * @var dbs_push_service_base
	 */
	private $androidpushservice;
	/**
	 *
	 * @return dbs_push_service_base
	 */
	public function get_android() {
		if (is_null ( $this->androidpushservice )) {
			$this->androidpushservice = new dbs_push_service_android ( "5526240bfd98c5a328000565", "mzrlcqooqyafctvhgqzxqyokekydrtld" );
		}
		return $this->androidpushservice;
	}

	/**
	 *
	 * @var dbs_push_service_base
	 */
	private $iphonepushserivce;
	/**
	 *
	 * @return dbs_push_service_base
	 */
	public function get_iphone() {
		if (is_null ( $this->iphonepushserivce )) {
			$this->iphonepushserivce = new dbs_push_service_iphone ( "555304a8e0f55a1d150018b6", "pveolouzurvilx87dir27xcmtbymomeh" );
		}
		return $this->iphonepushserivce;
	}
}