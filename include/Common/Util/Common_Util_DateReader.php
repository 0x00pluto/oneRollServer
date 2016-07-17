<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
/**
 * 按照各种格式读入日期数据, 生成Common_Util_Date
 *
 * @author jishu
 */
class Common_Util_DateReader
{
	/**
	 *
	 * @param string $date
	 * @return Common_Util_Date
	 */
	static public function readFromDate($date)
	{
		$parts = array();
		if (! self::isValidDate($date, $parts))
		{
			throw new CException("无效的日期 '{$date}'", "invalid date '{$date}'", array('date' => $date));
		}
		$date = new Common_Util_Date();

		$date->setYear($parts[0]);
		$date->setMonth($parts[1]);
		$date->setDay($parts[2]);

		return $date;
	}

	/**
	 * @param string $datetime
	 * @return Common_Util_Date
	 */
	static public function readFromDatetime($datetime, &$date = null)
	{
		$parts = array();
		$datetime = trim($datetime);

		if (! self::isValidDatetime($datetime, $parts))
		{
			throw new CException("无效的日期时间 '{$datetime}'", "invalid datetime '{$datetime}'", array('datetime' => $datetime));
		}

		if (! $date instanceof Common_Util_Date)
		{
			$date = new Common_Util_Date();
		}
		else
		{
			$date->init();
		}

		$date->setYear($parts[0]);
		$date->setMonth($parts[1]);
		$date->setDay($parts[2]);

		$date->setHour($parts[3]);
		$date->setMinute($parts[4]);
		$date->setSecond($parts[5]);

		return $date;
	}

	/**
	 *
	 * @param long $timestamp
	 * @return Common_Util_Date
	 */
	static public function readFromTimestamp($timestamp)
	{
		if (! Common_Util_DataValidator::isPositiveInteger($timestamp))
		{
			throw new CException("无效的时间戳 '{$timestamp}'", "invalid timestamp '{$timestamp}'", array('timestamp' => $timestamp));
		}

		$day = date("YmdHis", $timestamp);

		return self::readFromDatetime($day);
	}

	/**
	 * 支持格式为 yyyy-mm-dd 或者 yyyymmdd
	 *
	 * @param string $param
	 * @param array $parts
	 * @return string|string|string|string
	 */
	static public function isValidDate($param, array &$parts = array())
	{
		$param = trim($param);

		$len = strlen($param);
		if ($len != 8 && $len != 10) return false;

		$matches = null;

		if (! preg_match('#^(\d{4})[\-/]?(\d{2})[\-/]?(\d{2})$#', $param, $matches))
		{
			return false;
		}

		if (! checkdate($matches[2], $matches[3], $matches[1]))
		{
			return false;
		}

		array_splice($parts, 0, count($parts));
		for ($i = 0; $i <= 2; $i++)
		{
			$parts[$i] = intval($matches[$i+1]);
		}

		return true;
	}

	/**
	 * 支持格式为 yyyy-mm-dd hh:mm:ss 或者 yyyymmddhhmmss
	 *
	 * @param unknown_type $param
	 * @param array $parts
	 * @return string|string|string|string
	 */
	static public function isValidDatetime($param , array &$parts = array())
	{
		$param = trim($param);
		$len = strlen($param);
		if ($len != 14 && $len != 19) return false;

		$matches = null;

		if (! preg_match('#^(\d{4})[\-/]?(\d{2})[\-/]?(\d{2})\s?(\d{2}):?(\d{2}):?(\d{2})$#', $param, $matches))
		{
			return false;
		}

		if (! checkdate($matches[2], $matches[3], $matches[1]))
		{
			return false;
		}

		if ($matches[4] > 23 || $matches[5] > 59 || $matches[6] > 59)
		{
			return false;
		}

		array_splice($parts, 0, count($parts));
		for ($i = 0; $i <= 5; $i++)
		{
			$parts[$i] = intval($matches[$i+1]);
		}

		return true;
	}

}

?>