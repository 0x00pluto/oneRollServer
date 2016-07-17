<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
class Common_Util_KxApiTool {
	function toutf8($data) {
		$newdata = array ();
		if (is_array ( $data )) {
			foreach ( $data as $k => $v ) {
				$newk = iconv ( "GB18030", "UTF-8//IGNORE", $k );

				// iconv转换失败处理
				if ($newk === false && $k !== false) {
					global $multilog;
					$multilog->addSysDebugLog ( "iconv_failed_1: " . $k . " => " . mb_convert_encoding ( $k, "UTF-8", "GBK" ) );
					$newk = mb_convert_encoding ( $k, "UTF-8", "GBK" );
				}

				if (is_array ( $v )) {
					$newdata [$newk] = Common_Util_KxApiTool::toutf8 ( $v );
				} else if (is_string ( $v )) {
					$newdata [$newk] = iconv ( "GB18030", "UTF-8//IGNORE", $v );

					// iconv转换失败处理
					if ($newdata [$newk] === false && $v !== false) {
						global $multilog;
						$multilog->addSysDebugLog ( "iconv_failed_2: uid:" . $_COOKIE ["_uid"] . ", " . $_SERVER ['HTTP_HOST'] . ", " . $_SERVER ['SCRIPT_NAME'] . ", " . $v . " => " . mb_convert_encoding ( $v, "UTF-8", "GBK" ) );
						$newdata [$newk] = mb_convert_encoding ( $v, "UTF-8", "GBK" );
					}
				} else {
					$newdata [$newk] = $v;
				}
			}
		}
		return $newdata;
	}
	function togb18030($data) {
		$newdata = array ();
		if (is_array ( $data )) {
			foreach ( $data as $k => $v ) {
				$newk = iconv ( "UTF-8", "GB18030//IGNORE", $k );

				// iconv转换失败处理
				if ($newk === false && $k !== false) {
					global $multilog;
					$multilog->addSysDebugLog ( "iconv_failed_3: " . $k . " => " . mb_convert_encoding ( $k, "GBK", "UTF-8" ) );
					$newk = mb_convert_encoding ( $k, "GBK", "UTF-8" );
				}

				if (is_array ( $v )) {
					$newdata [$newk] = Common_Util_KxApiTool::togb18030 ( $v );
				} else if (is_string ( $v )) {
					$newdata [$newk] = iconv ( "UTF-8", "GB18030//IGNORE", $v );

					// iconv转换失败处理
					if ($newdata [$newk] === false && $v !== false) {
						global $multilog;
						$multilog->addSysDebugLog ( "iconv_failed_4: " . $v . " => " . mb_convert_encoding ( $v, "GBK", "UTF-8" ) );
						$newdata [$newk] = mb_convert_encoding ( $v, "GBK", "UTF-8" );
					}
				} else {
					$newdata [$newk] = $v;
				}
			}
		}
		return $newdata;
	}
	function postfile($url, $post, $file, $timeout = 10, $ip = "", $ex = false, $x_forwarded_for = "") {
		$boundary = "---------------------------0123456789012";

		$postdata = "";
		foreach ( $post as $n => $v ) {
			if (is_array ( $v )) {
				foreach ( $v as $vv ) {
					$postdata .= "--" . $boundary . "\r\nContent-Disposition: form-data; name=\"" . $n . "[]\"\r\n\r\n" . $vv . "\r\n";
				}
			} else {
				$postdata .= "--" . $boundary . "\r\nContent-Disposition: form-data; name=\"" . $n . "\"\r\n\r\n" . $v . "\r\n";
			}
		}
		foreach ( $file as $n => $v ) {
			if (UPLOAD_ERR_OK != $v ["error"]) {
				$postdata .= "--" . $boundary . "\r\nContent-Disposition: form-data; name=\"" . $n . "\"; filename=\"\"\r\nContent-Type: application/octet-stream\r\n\r\n\r\n";
			} else {
				$postdata .= "--" . $boundary . "\r\nContent-Disposition: form-data; name=\"" . $n . "\"; filename=\"" . $v ["name"] . "\"\r\nContent-Type: " . $v ["type"] . "\r\n\r\n" . file_get_contents ( $v ["tmp_name"] ) . "\r\n";
			}
		}
		$postdata .= "--" . $boundary . "--\r\n";

		$info = parse_url ( $url );
		if (0 == strlen ( $info [path] )) {
			$info [path] = "/";
		}
		if (strlen ( $info ["query"] )) {
			$head = "POST " . $info [path] . "?" . $info ["query"] . " HTTP/1.0\r\n";
		} else {
			$head = "POST " . $info [path] . " HTTP/1.0\r\n";
		}
		$head .= "Host: " . $info [host] . "\r\n";
		$head .= "Content-type: multipart/form-data; boundary=" . $boundary . "\r\n";
		$head .= "Content-Length: " . strlen ( $postdata ) . "\r\n";
		if (strlen ( $x_forwarded_for )) {
			$head .= "X-Forwarded-For: " . $x_forwarded_for . "\r\n";
		}
		$head .= "\r\n";
		$head .= $postdata;

		if ($ex) {
			return Common_Util_KxApiTool::reqEx ( $info ["host"], $info ["port"], $head, $timeout, $ip );
		}
		return Common_Util_KxApiTool::req ( $info ["host"], $info ["port"], $head, $timeout, $ip );
	}
	function post($url, $query, $timeout = 10, $ip = "", $ex = false, $x_forwarded_for = "", $showerror = false) {
		$info = parse_url ( $url );
		if (0 == strlen ( $info [path] )) {
			$info [path] = "/";
		}
		if (strlen ( $info ["query"] )) {
			$head = "POST " . $info [path] . "?" . $info ["query"] . " HTTP/1.0\r\n";
		} else {
			$head = "POST " . $info [path] . " HTTP/1.0\r\n";
		}
		$head .= "Host: " . $info [host] . "\r\n";
		$head .= "Content-type: application/x-www-form-urlencoded\r\n";
		$head .= "Content-Length: " . strlen ( trim ( $query ) ) . "\r\n";
		if (strlen ( $x_forwarded_for )) {
			$head .= "X-Forwarded-For: " . $x_forwarded_for . "\r\n";
		}
		$head .= "\r\n";
		$head .= trim ( $query );

		if ($ex) {
			return Common_Util_KxApiTool::reqEx ( $info ["host"], $info ["port"], $head, $timeout, $ip, $showerror );
		}
		return Common_Util_KxApiTool::req ( $info ["host"], $info ["port"], $head, $timeout, $ip, $showerror );
	}
	function get($url, $timeout = 10, $ip = "", $ex = false, $x_forwarded_for = "", $showerror = false) {
		$info = parse_url ( $url );
		if (0 == strlen ( $info [path] )) {
			$info [path] = "/";
		}
		if (strlen ( $info ["query"] )) {
			$head = "GET " . $info [path] . "?" . $info ["query"] . " HTTP/1.0\r\n";
		} else {
			$head = "GET " . $info [path] . " HTTP/1.0\r\n";
		}
		$head .= "Host: " . $info [host] . "\r\n";
		if (strlen ( $x_forwarded_for )) {
			$head .= "X-Forwarded-For: " . $x_forwarded_for . "\r\n";
		}
		$head .= "\r\n";

		if ($ex) {
			return Common_Util_KxApiTool::reqEx ( $info ["host"], $info ["port"], $head, $timeout, $ip, $showerror );
		}
		return Common_Util_KxApiTool::req ( $info ["host"], $info ["port"], $head, $timeout, $ip, $showerror );
	}
	function head($url, $timeout = 1, $ip = "", $showerror = false) {
		$info = parse_url ( $url );
		if (0 == strlen ( $info [path] )) {
			$info [path] = "/";
		}
		if (strlen ( $info ["query"] )) {
			$head = "HEAD " . $info [path] . "?" . $info ["query"] . " HTTP/1.0\r\n";
		} else {
			$head = "HEAD " . $info [path] . " HTTP/1.0\r\n";
		}
		$head .= "Host: " . $info [host] . "\r\n";
		$head .= "\r\n";

		return Common_Util_KxApiTool::reqEx ( $info ["host"], $info ["port"], $head, $timeout, $ip, $showerror );
	}
	function reqEx($host, $port, $head, $timeout = 10, $ip = "", $showerror = false) {
		global $multilog;

		$port = intval ( $port );
		if (! $port) {
			$port = 80;
		}
		if (strlen ( $ip )) {
			$fp = fsockopen ( $ip, $port, $errno, $errstr, $timeout );
		} else {
			$gotolocal = false;
			if (strtolower ( $host ) == WWW_HOST && $port == 80) {
				$portfile = DATA_PATH . "/port";
				if (is_file ( $portfile )) {
					$port = trim ( file_get_contents ( $portfile ) );
					$gotolocal = true;
				}
			}

			if ($gotolocal) {
				$fp = fsockopen ( "127.0.0.1", $port, $errno, $errstr, $timeout );
			} else {
				$fp = fsockopen ( $host, $port, $errno, $errstr, $timeout );
			}
		}
		if (! $fp) {
			$multilog->addDebugLog ();
			return false;
		}
		fputs ( $fp, $head );
		stream_set_timeout ( $fp, $timeout );
		$result = "";
		$sts = 0;
		$i = 0;
		while ( ! feof ( $fp ) ) {
			$line = fread ( $fp, 4096 );
			if ($line === false) {
				fclose ( $fp );
				$multilog->addFileLog ( "req", "fread\t" . $host . "\t" . $ip . "\t" . $port . "\t" . $head );
				return false;
			}
			if ($i == 0) {
				list ( $protocol, $sts, $statuswork ) = explode ( " ", $line, 3 );
				if ($sts >= 400) {
					fclose ( $fp );
					$multilog->addFileLog ( "req", "status\t" . $sts . "\t" . $host . "\t" . $ip . "\t" . $port . "\t" . $head );
					if ($showerror) {
						return $sts;
					} else {
						return false;
					}
				}
				$i = 1;
			}
			$result .= $line;
			$status = stream_get_meta_data ( $fp );
			if ($status ["timed_out"]) {
				fclose ( $fp );
				$multilog->addFileLog ( "req", "timeout\t" . $timeout . "\t" . $host . "\t" . $ip . "\t" . $port . "\t" . $head );
				if ($showerror) {
					return "timeout " . $timeout;
				} else {
					return false;
				}
			}
		}
		fclose ( $fp );
		$result = explode ( "\r\n\r\n", $result, 2 );
		return array (
				$sts,
				$result [0],
				$result [1]
		);
	}
	function req($host, $port, $head, $timeout = 10, $ip = "", $showerror = false) {
		$ret = Common_Util_KxApiTool::reqEx ( $host, $port, $head, $timeout, $ip, $showerror );
		if ($ret && ! is_array ( $ret )) {
			return $ret;
		}
		if ($ret === false || $ret [0] >= 300) {
			return false;
		}
		return $ret [2];
	}
}

?>