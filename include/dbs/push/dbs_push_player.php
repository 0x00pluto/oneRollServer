<?php

namespace dbs\push;

use dbs\dbs_baseplayer;
use constants\constants_devicetype;
use dbs\push\service\dbs_push_service_base;
use err\err_dbs_push_player_sendpush;
use Common\Util\Common_Util_ReturnVar;

/**
 * push服务
 * 2015年5月13日 下午5:23:01
 *
 * @author zhipeng
 *
 */
class dbs_push_player extends dbs_baseplayer {
	/**
	 * 表名
	 *
	 * @var string
	 */
	const DBKey_tablename = "push_player";
	function __construct() {
		parent::__construct ( self::DBKey_tablename );
	}
	/**
	 * 发送push
	 *
	 * @param string $title
	 *        	标题.iphone没有.
	 * @param string $contents
	 *        	内容.iPhone就是这个
	 * @return Common_Util_ReturnVar
	 */
	function sendpush($title, $contents) {
		$retCode = 0;
		$retCode_Str = 'SUCC';
		$data = array ();
		// class err_dbs_push_player_sendpush{}

		$device = $this->db_owner->dbs_deviceinfo ();

		/**
		 *
		 * @var dbs_push_service_base
		 */
		$pushservice = null;
		$devicetype = $device->get_devicetype ();

		// code
		switch ($devicetype) {
			case constants_devicetype::TYPE_IPhone :
				$pushservice = dbs_push_service::getInstance ()->get_iphone ();
				break;

			case constants_devicetype::TYPE_Android :
				$pushservice = dbs_push_service::getInstance ()->get_android ();
				break;
			default :
				;
				break;
		}

		if (is_null ( $pushservice )) {
			$retCode = err_dbs_push_player_sendpush::PLATFROMTYPE_NOT_PUSH_SYSYTEM;
			$retCode_Str = 'PLATFROMTYPE_NOT_PUSH_SYSYTEM';
			goto failed;
		}

		$devicetoken = $device->get_devicetoken ();
		if (empty ( $devicetoken )) {
			$retCode = err_dbs_push_player_sendpush::NOT_DEVICE_TOKEN;
			$retCode_Str = 'NOT_DEVICE_TOKEN';
			goto failed;
		}

		$pushservice->sendUnicast ( $devicetoken, $title, $contents );

		succ:
		return Common_Util_ReturnVar::Ret ( true, $retCode, $data, $retCode_Str );
		failed:
		return Common_Util_ReturnVar::Ret ( false, $retCode, $data, $retCode_Str );
	}
}