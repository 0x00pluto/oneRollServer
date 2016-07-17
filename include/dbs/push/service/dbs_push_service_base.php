<?php

namespace dbs\push\service;

require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/android/AndroidBroadcast.php');
require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/android/AndroidFilecast.php');
require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/android/AndroidGroupcast.php');
require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/android/AndroidUnicast.php');
require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/android/AndroidCustomizedcast.php');
require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/ios/IOSBroadcast.php');
require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/ios/IOSFilecast.php');
require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/ios/IOSGroupcast.php');
require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/ios/IOSUnicast.php');
require_once (dirname ( __FILE__ ) . '/../../../' . 'notification/ios/IOSCustomizedcast.php');

/**
 * push服务基类
 *
 * @author zhipeng
 *
 */
abstract class dbs_push_service_base {
	protected $appkey = NULL;
	protected $appMasterSecret = NULL;
	protected $timestamp = NULL;
	protected $validation_token = NULL;
	/**
	 * 是否是线上环境
	 *
	 * @var unknown
	 */
	protected $production = "false";
	function __construct($key, $secret) {
		$this->appkey = $key;
		$this->appMasterSecret = $secret;
		$this->timestamp = strval ( time () );
	}

	/**
	 * 组播
	 *
	 * @param unknown $devicetokens
	 * @param unknown $title
	 * @param unknown $contents
	 * @param unknown $attachkeyvalues
	 */
	abstract function sendBroadcast($devicetokens, $title, $contents, $attachkeyvalues = array());

	/**
	 * 单播
	 *
	 * @param unknown $devicetoken
	 * @param unknown $title
	 * @param unknown $contents
	 * @param unknown $attachkeyvalues
	 */
	abstract function sendUnicast($devicetoken, $title, $contents, $attachkeyvalues = array());
}