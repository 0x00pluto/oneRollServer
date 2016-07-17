<?php

namespace Common\Util;

/**
 * http请求
 *
 * @package common
 * @subpackage util
 * @author kain
 *
 */
class Common_Util_Http {
	static function http($url, $query = "", $method = 'POST') {
		$ch = curl_init ();
		switch (strtoupper ( $method )) {
			case 'GET' :
				if (false === stripos ( $url, '?' )) {
					$url .= '?' . $query;
				} else {
					$url .= '&' . $query;
				}
				break;
			case 'POST' :
				curl_setopt ( $ch, CURLOPT_POST, 1 );
				curl_setopt ( $ch, CURLOPT_POSTFIELDS, $query );
				break;
		}
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_FRESH_CONNECT, 1 );
		curl_setopt ( $ch, CURLOPT_FORBID_REUSE, 1 );

		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt ( $ch, CURLOPT_HEADER, FALSE );

		$response = trim ( curl_exec ( $ch ) );
		$http_code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
		curl_close ( $ch );

		$result = array (
				"response" => $response,
				"http_code" => $http_code
		);
		return $result;
	}

	/**
	 * 调用远程的方法
	 *
	 * @param unknown $url
	 * @param unknown $servicerpcfunction
	 * @param unknown $params
	 * @param string $verify
	 * @return NULL|Common_Util_ReturnVar
	 */
	static function call_remote_rpc($url, $servicerpcfunction, $params = [], $verify = NULL) {
		$message = Common_Util_Message::create_with_rpccall ( $servicerpcfunction, $params, $verify );
		$encodemessage = Common_Util_Message::encodeMessage ( [
				$message->toArray ()
		] );

		$response = self::http ( $url, [
				"data" => $encodemessage
		] );

		if ($response ['http_code'] != 200) {
			return null;
		}
		$response_str = $response ['response'];
		if ($response_str == "f") {
			return null;
		}

		$retmessage = Common_Util_Message::decodeMessage ( $response_str );
		if (is_null ( $retmessage )) {
			return null;
		}

		$retcode = null;

		foreach ( $retmessage as $rpc_return ) {

			if ($rpc_return [Common_Util_Message::DBKey_msgdata] [Common_Util_Message::DBKey_cmd] === $servicerpcfunction) {
				$retcode = Common_Util_ReturnVar::create_with_message_arr ( $rpc_return );
				break;
			}
		}
		return $retcode;
	}
}