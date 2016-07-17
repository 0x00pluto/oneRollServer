<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
date_default_timezone_set('Asia/Shanghai');

class Common_Util_Date
{
	const MIN_YEAR = 1900;
	const SAME = 0;
	const EARLIER = -1;
	const LATER = 1;

	private $year = self::MIN_YEAR;
	private $month = 1;
	private $day = 1;

	private $hour = 0;
	private $minute = 0;
	private $second = 0;

	private $defaultWriter = null;

	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		$this->setYear();
		$this->setMonth();
		$this->setDay();

		$this->setHour();
		$this->setMinute();
		$this->setSecond();
	}

	public function __toString()
	{
		return $this->output();
	}

	public function isEmpty()
	{
		return $this->year == self::MIN_YEAR && $this->month == 1 && $this->day == 1 &&
		       $this->hour == 0 && $this->minute == 0 && $this->second == 0;
	}

	/**
	 * 比较两个对象
	 * @param Common_Util_Date $date1
	 * @param Common_Util_Date $date2
	 * @return -1|0|1
	 */
	public function compare(Common_Util_Date $date)
	{
		$defaultWriter = $this->getDefaultWriter();

		$datestr1 = $this->output($defaultWriter);
		$datestr2 = $date->output($defaultWriter);

		if ($datestr1 == $datestr2)
		{
			return self::SAME;
		}
		else if ($datestr1 < $datestr2)
		{
			return self::EARLIER;
		}
		else
		{
			return self::LATER;
		}
	}

	/**
	 * 返回相差的天数
	 * @param Common_Util_Date $date
	 * @return number
	 */
	public function diffDays(Common_Util_Date $date)
	{
		$seconds = $this->toTimestamp() - $date->toTimestamp();
		$sign = ($seconds < 0) ? -1 : 1;
		return $sign * ceil(abs($seconds) / (24 * 3600));
	}

	/**
	 * @return the $year
	 */
	public function getYear()
	{
		return $this->year;
	}

	/**
	 * @return the $month
	 */
	public function getMonth()
	{
		return $this->month;
	}

	/**
	 * @return the $day
	 */
	public function getDay()
	{
		return $this->day;
	}

	/**
	 * @return the $hour
	 */
	public function getHour()
	{
		return $this->hour;
	}

	/**
	 * @return the $minute
	 */
	public function getMinute()
	{
		return $this->minute;
	}

	/**
	 * @return the $second
	 */
	public function getSecond()
	{
		return $this->second;
	}

	/**
	 * @param $year the $year to set
	 */
	public function setYear($year = self::MIN_YEAR)
	{
		if (! Common_Util_DataValidator::isPositiveInteger($year) || $year < self::MIN_YEAR)
		{
			throw new CException("无效的年份", "invalid year", array('year' => $year));
		}
		$this->year = intval($year);
	}

	/**
	 * @param $month the $month to set
	 */
	public function setMonth($month = 1)
	{
		if (! Common_Util_DataValidator::isPositiveInteger($month) || $month > 12)
		{
			throw new CException("无效的月份", "invalid month", array('month' => $month));
		}

		$this->month = intval($month);
	}

	/**
	 * @param $day the $day to set
	 */
	public function setDay($day = 1)
	{
		if (! Common_Util_DataValidator::isPositiveInteger($day) || ! checkdate($this->month, $day, $this->year))
		{
			throw new CException("无效的日", "invalid day",
			                     array('year' => $this->year, 'month' => $this->month, 'day' => $day));
		}

		$this->day = intval($day);
	}

	/**
	 * @param $hour the $hour to set
	 */
	public function setHour($hour = 0)
	{
		if (! Common_Util_DataValidator::isNaturalNumber($hour) || $hour > 23)
		{
			throw new CException("无效的时", "invalid hour", array('hour' => $hour));
		}

		$this->hour = intval($hour);
	}

	/**
	 * @param $minute the $minute to set
	 */
	public function setMinute($minute = 0)
	{
		if (! Common_Util_DataValidator::isNaturalNumber($minute) || $minute > 59)
		{
			throw new CException("无效的分", "invalid minute", array('minute' => $minute));
		}

		$this->minute = intval($minute);
	}

	/**
	 * @param $second the $second to set
	 */
	public function setSecond($second = 0)
	{
		if (! Common_Util_DataValidator::isNaturalNumber($second) || $second > 59)
		{
			throw new CException("无效的秒", "invalid second", array('second' => $second));
		}

		$this->second = intval($second);
	}

	/**
	 *
	 * @param Common_Util_DateWriter $writer
	 */
	public function output($writer = null)
	{
		if (! $writer || ! ($writer instanceof Common_Util_DateWriter))
		{
			$writer = $this->getDefaultWriter();
		}

		return $writer->output($this);
	}

	public function toTimestamp()
	{
		return mktime($this->hour, $this->minute, $this->second,
		              $this->month, $this->day, $this->year);
	}

	/**
	 * @return the $defaultWriter
	 */
	public function getDefaultWriter()
	{
		if (! $this->defaultWriter)
		{
			$this->defaultWriter = new Cmomon_Util_DateCommonWriter();
		}
		return $this->defaultWriter;
	}

	/**
	 * @param $defaultWriter the $defaultWriter to set
	 */
	public function setDefaultWriter(Common_Util_DateWriter $writer)
	{
		$this->defaultWriter = $writer;
	}

}

class Cmomon_Util_DateCommonWriter implements Common_Util_DateWriter
{
	public function output(Common_Util_Date $date)
	{
		if ($date->isEmpty())
		{
			return '0000-00-00 00:00:00';
		}
		else
		{
			return sprintf("%4d-%02d-%02d %02d:%02d:%02d",
		                   $date->getYear(), $date->getMonth(), $date->getDay(),
		                   $date->getHour(), $date->getMinute(), $date->getSecond());
		}
	}
}

class Cmomon_Util_DateWriterDay implements Common_Util_DateWriter
{
	public function output(Common_Util_Date $date)
	{
		if ($date->isEmpty())
		{
			return '0000-00-00';
		}
		else
		{
			return sprintf("%4d-%02d-%02d",
		                   $date->getYear(), $date->getMonth(), $date->getDay());
		}
	}
}

?>