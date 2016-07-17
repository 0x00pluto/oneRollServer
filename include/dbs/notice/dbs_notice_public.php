<?php

namespace dbs\notice;

use Common\Db\Common_Db_memcacheObject;
use constants\constants_memcachekey;
use Common\Util\Common_Util_ReturnVar;

/**
 * 说明
 * 2015年5月20日 下午3:52:39
 *
 * @author zhipeng
 *
 */
class dbs_notice_public {

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
	 * 刷新公告列表
	 */
	private function _flush_notice_list() {
		$memcacheObj = Common_Db_memcacheObject::create ( constants_memcachekey::DBkey_Notice_Public );

		$noticelist = $memcacheObj->get_value ( array () );
		$now = time ();
		$noticedata = new dbs_notice_publicdata ();

		$datachange = false;
		foreach ( $noticelist as $key => $value ) {
			$noticedata->fromArray ( $value );
			if ($noticedata->get_sendtime () + $noticedata->get_duringtime () < $now) {
				unset ( $noticelist [$key] );
				$datachange = true;
			} else {
				break;
			}
		}

		$validnoticelist = array ();
		// 最后一个通知
		foreach ( $noticelist as $value ) {
			$validnoticelist [] = $value;
		}
		if ($datachange) {
			$memcacheObj->set_value ( $validnoticelist );
		}

		return $validnoticelist;
	}
	/**
	 * 发送通知
	 *
	 * @param unknown $content
	 * @param unknown $senduserid
	 * @return Common_Util_ReturnVar
	 */
	function sendnotice($content, $senduserid) {
		$retCode = 0;
		$retCode_Str = 'SUCC';
		$data = array ();
		// class err_dbs_notice_public_sendnotice{}

		$new_noticedata = dbs_notice_publicdata::create ( $content, 30, $senduserid );

		$memcacheObj = Common_Db_memcacheObject::create ( constants_memcachekey::DBkey_Notice_Public );

		// 有效的通知列表
		$validnoticelist = $this->_flush_notice_list ();
		$sendtime = time ();
		$count = count ( $validnoticelist );
		// 已经有消息了
		if ($count != 0) {
			$lastnoticedata_value = $validnoticelist [$count - 1];
			$lastnoticedata = new dbs_notice_publicdata ();
			$lastnoticedata->fromArray ( $lastnoticedata_value );
			$sendtime = $lastnoticedata->get_sendtime () + $lastnoticedata->get_duringtime ();
		}

		$new_noticedata->set_sendtime ( $sendtime );
		$validnoticelist [] = $new_noticedata->toArray ();
		$memcacheObj->set_value ( $validnoticelist );

		// code
		$data = $validnoticelist;

		succ:
		return Common_Util_ReturnVar::Ret ( true, $retCode, $data, $retCode_Str );
		failed:
		return Common_Util_ReturnVar::Ret ( false, $retCode, $data, $retCode_Str );
	}

	/**
	 * 获取通知
	 *
	 * @return Common_Util_ReturnVar
	 */
	function getnotice() {
		$retCode = 0;
		$retCode_Str = 'SUCC';
		$data = array ();
		// class err_dbs_notice_public_getnotice{}

		$noticelist = $this->_flush_notice_list ();
		if (count ( $noticelist ) != 0) {
			$data = $noticelist [0];
		}
		// code

		succ:
		return Common_Util_ReturnVar::Ret ( true, $retCode, $data, $retCode_Str );
		failed:
		return Common_Util_ReturnVar::Ret ( false, $retCode, $data, $retCode_Str );
	}
}