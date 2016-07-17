<?php
namespace Common\Util;
/**
 * ip类
 *
 * @package common
 * @subpackage util
 * @author kain
 *
 */
class Common_Util_Ip
{
	function getPlatform()
	{
		$cmd = "uname -a";
		$output = array();
		$platinfo = exec($cmd, $output);
		if (false !== strpos($platinfo, "x86_64"))
		{
			return "64";
		}
		return "32";
	}

	function getInnerIP()
	{
		$devices = exec("/sbin/ip addr|grep '^[0-9]'|awk '{print $2}'|sed s/://g|tr '\n' ' '");
		$device = explode(' ', $devices);
		foreach($device as $dev)
		{
			if ($dev == 'lo') { continue; }
			$ip = self::getLocalIp($dev);
			if (self::isInnerIP($ip))
			{
				return $ip;
			}
		}
	}

	function getLocalIp($interface = "eth0")
	{
		$str = exec("/sbin/ifconfig ".$interface." | grep 'inet addr'");
		$str = explode(":", $str, 2);
		$str = explode(" ", $str[1], 2);
		return $str[0];
	}

	function getInnerIP2()
	{
		$ip = self::getLocalIp("eth0");
		if (!self::isInnerIP($ip))
		{
			$ip = self::getLocalIp("eth1");
			if (!self::isInnerIP($ip))
			{
				$ip = self::getLocalIp("bond0");
				if (!self::isInnerIP($ip))
				{
					$ip = self::getLocalIp("bond1");
					if (!self::isInnerIP($ip))
					{
						$ip = "unknown";
					}
				}
			}
		}
		return $ip;
	}

	function isInnerIP($ip)
	{
		if ($ip == "127.0.0.1")
		{
			return true;
		}
		list($i1, $i2, $i3, $i4) = explode(".", $ip, 4);
		return ($i1 == 10 || ($i1 == 172 && 16 <= $i2 && $i2 < 32) || ($i1 == 192 && $i2 == 168));
	}

	function getOuterIP($str)
	{
		$ips = preg_split("/;|,|\s/", $str);
		$rip = "unknown";
		foreach ($ips as $ip)
		{
			$ip = trim($ip);
			if (ip2long($ip) === false)
			{
				continue;
			}
			if (!self::isInnerIP($ip))
			{
				return $ip;
			}
			else
			{
				$rip = $ip;
			}
		}
		return $rip;
	}

	function getIP()
	{
		$fip = getenv('HTTP_X_FORWARDED_FOR');
		$oip = self::getOuterIP($fip);
		if ($oip != "unknown")
		{
			return $oip;
		}

		$rip = getenv('REMOTE_ADDR');
		return self::getOuterIP($rip);
	}

	function checkIp($ip, $range)
	{
		list($range, $num) = explode("/", $range, 2);
		$num = intval($num);
		$range = ip2long($range);
		$ip = ip2long($ip);

		if ($num >= 32 || $num <= 0)
		{
			return $range == $ip;
		}
		else
		{
			$range = $range >> (32 - $num);
			$ip = $ip >> (32 - $num);
			return $range == $ip;
		}
	}

	function checkIpEx($ip, $ranges)
	{
		foreach ($ranges as $range)
		{
			if (self::checkIp($ip, $range))
			{
				return true;
			}
		}
		return false;
	}

	function getCallerIp()
	{
		$myip = $_SERVER['SERVER_ADDR'];
		if ($myip == '' || $myip == "127.0.0.1")
		{
			$filename = DATA_PATH."/localip";
			if (is_file($filename))
			{
				$myip = trim(file_get_contents($filename));
			}
			else if($myip == '')
			{
				$myip = "unknown";
			}
		}
		return $myip;
	}

	public static function getClientIP()
	{
		$fip = getenv('HTTP_X_FORWARDED_FOR').' '.getenv('HTTP_VIA').' '.getenv('REMOTE_ADDR');
		return self::getOuterIP($fip);
	}

	public static function getServerIp()
	{
		$sIp = getenv('SERVER_ADDR');
		if ($sIp == '' || $sIp == '127.0.0.1')
		{
			$sIp = 'unknown';
		}
		return $sIp;
	}
}

?>