<?php

namespace dbs\chef;

use dbs\dbs_basedatacell;

/**
 * 属性
 *
 * @author zhipeng
 *
 */
class dbs_chef_property extends dbs_basedatacell {
	function __construct($defaultvalue = array()) {
		$this->set_defaultvalues ( $defaultvalue );

		parent::__construct ( array (
				self::DBKey_cookingability => 0,
				self::DBKey_chinesefood => 0,
				self::DBKey_westernfood => 0,
				self::DBKey_japenesefood => 0,
				self::DBKey_frenchfood => 0,
				self::DBKey_ideafood => 0
		) );
	}

	/**
	 * 烹饪能力
	 *
	 * @var string
	 */
	const DBKey_cookingability = "cookingability";
	/**
	 * 获取 烹饪能力
	 */
	public function get_cookingability() {
		return $this->getdata ( self::DBKey_cookingability );
	}
	/**
	 * 设置 烹饪能力
	 *
	 * @param unknown $value
	 */
	public function set_cookingability($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_cookingability, $value );
	}

	/**
	 * 中餐
	 *
	 * @var string
	 */
	const DBKey_chinesefood = "chinesefood";
	/**
	 * 获取 中餐
	 */
	public function get_chinesefood() {
		return $this->getdata ( self::DBKey_chinesefood );
	}
	/**
	 * 设置 中餐
	 *
	 * @param unknown $value
	 */
	public function set_chinesefood($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_chinesefood, $value );
	}

	/**
	 * 西餐加成
	 *
	 * @var string
	 */
	const DBKey_westernfood = "westernfood";
	/**
	 * 获取 西餐加成
	 */
	public function get_westernfood() {
		return $this->getdata ( self::DBKey_westernfood );
	}
	/**
	 * 设置 西餐加成
	 *
	 * @param unknown $value
	 */
	public function set_westernfood($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_westernfood, $value );
	}

	/**
	 * 日料加成
	 *
	 * @var string
	 */
	const DBKey_japenesefood = "japenesefood";
	/**
	 * 获取 日料加成
	 */
	public function get_japenesefood() {
		return $this->getdata ( self::DBKey_japenesefood );
	}
	/**
	 * 设置 日料加成
	 *
	 * @param unknown $value
	 */
	public function set_japenesefood($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_japenesefood, $value );
	}

	/**
	 * 法餐加成
	 *
	 * @var string
	 */
	const DBKey_frenchfood = "frenchfood";
	/**
	 * 获取 法餐加成
	 */
	public function get_frenchfood() {
		return $this->getdata ( self::DBKey_frenchfood );
	}
	/**
	 * 设置 法餐加成
	 *
	 * @param unknown $value
	 */
	public function set_frenchfood($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_frenchfood, $value );
	}

	/**
	 * 创意餐加成
	 *
	 * @var string
	 */
	const DBKey_ideafood = "ideafood";
	/**
	 * 获取 创意餐加成
	 */
	public function get_ideafood() {
		return $this->getdata ( self::DBKey_ideafood );
	}
	// dump('123');
	/**
	 * 设置 创意餐加成
	 *
	 * @param unknown $value
	 */
	public function set_ideafood($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_ideafood, $value );
	}
}