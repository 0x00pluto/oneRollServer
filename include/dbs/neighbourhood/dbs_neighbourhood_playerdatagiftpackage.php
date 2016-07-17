<?php

namespace dbs\neighbourhood;

use dbs\dbs_basedatacell;
use dbs\i\dbs_i_iday;
use Common\Util\Common_Util_Configdata;
use configdata\configdata_item_neighboorhood_gift_package_setting;

/**
 * 发红包数据
 *
 * @author zhipeng
 *
 */
class dbs_neighbourhood_playerdatagiftpackage extends dbs_basedatacell implements dbs_i_iday {

	/**
	 * 获取红包配置
	 *
	 * @param string $itemid
	 */
	public static function get_giftconfig($itemid) {
		return Common_Util_Configdata::getInstance ()->getconfigdata ( configdata_item_neighboorhood_gift_package_setting::class, configdata_item_neighboorhood_gift_package_setting::k_id, $itemid );
	}
	/**
	 * 发送礼包的次数品质1
	 *
	 * @var string
	 */
	const DBKey_sendgiftcount1 = "sendgiftcount1";
	/**
	 * 获取 发送礼包的次数品质1
	 */
	public function get_sendgiftcount1() {
		return $this->getdata ( self::DBKey_sendgiftcount1 );
	}
	/**
	 * 设置 发送礼包的次数品质1
	 *
	 * @param unknown $value
	 */
	private function set_sendgiftcount1($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_sendgiftcount1, $value );
	}

	/**
	 * 发送礼包的次数 品质2
	 *
	 * @var string
	 */
	const DBKey_sendgiftcount2 = "sendgiftcount2";
	/**
	 * 获取 发送礼包的次数 品质2
	 */
	public function get_sendgiftcount2() {
		return $this->getdata ( self::DBKey_sendgiftcount2 );
	}
	/**
	 * 设置 发送礼包的次数 品质2
	 *
	 * @param unknown $value
	 */
	private function set_sendgiftcount2($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_sendgiftcount2, $value );
	}

	/**
	 * 发送礼包次数 品质3
	 *
	 * @var string
	 */
	const DBKey_sendgiftcount3 = "sendgiftcount3";
	/**
	 * 获取 发送礼包次数 品质3
	 */
	public function get_sendgiftcount3() {
		return $this->getdata ( self::DBKey_sendgiftcount3 );
	}
	/**
	 * 设置 发送礼包次数 品质3
	 *
	 * @param unknown $value
	 */
	private function set_sendgiftcount3($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_sendgiftcount3, $value );
	}
	/**
	 * 获取发送红包次数
	 *
	 * @param int $quality
	 *        	1,2,3
	 * @return number
	 */
	public function get_sendgiftcount($quality) {
		$quality = intval ( $quality );
		$count = 0;
		switch ($quality) {
			case 1 :
				$count = $this->get_sendgiftcount1 ();
				break;
			case 2 :
				$count = $this->get_sendgiftcount2 ();
				break;

			case 3 :
				$count = $this->get_sendgiftcount3 ();
				break;
		}
		return $count;
	}
	/**
	 * 设置发送红包的次数
	 *
	 * @param int $quality
	 *        	1,2,3
	 * @param unknown $value
	 */
	private function set_sendgiftcount($quality, $value) {
		$quality = intval ( $quality );
		switch ($quality) {
			case 1 :
				$this->set_sendgiftcount1 ( $value );
				break;
			case 2 :
				$this->set_sendgiftcount2 ( $value );
				break;

			case 3 :
				$this->set_sendgiftcount3 ( $value );
				break;
		}
	}

	/**
	 * 今日获得感谢的威望值
	 *
	 * @var string
	 */
	const DBKey_todayawardthankreputation = "todayawardthankreputation";
	/**
	 * 获取 今日获得感谢的威望值
	 */
	public function get_todayawardthankreputation() {
		return $this->getdata ( self::DBKey_todayawardthankreputation );
	}
	/**
	 * 设置 今日获得感谢的威望值
	 *
	 * @param unknown $value
	 */
	public function set_todayawardthankreputation($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_todayawardthankreputation, $value );
	}
	function __construct() {
		parent::__construct ( array (
				self::DBKey_sendgiftcount1 => 0,
				self::DBKey_sendgiftcount2 => 0,
				self::DBKey_sendgiftcount3 => 0,
				self::DBKey_todayawardthankreputation => 0
		) );
	}

	/**
	 * 发送红包
	 *
	 * @param unknown $quality
	 */
	public function sendgift($quality) {
		$count = $this->get_sendgiftcount ( $quality );
		$count ++;
		$this->set_sendgiftcount ( $quality, $count );
	}
	function nextday() {
		$this->set_sendgiftcount1 ( 0 );
		$this->set_sendgiftcount2 ( 0 );
		$this->set_sendgiftcount3 ( 0 );
		$this->set_todayawardthankreputation ( 0 );
	}
}