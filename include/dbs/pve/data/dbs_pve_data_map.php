<?php

namespace dbs\pve\data;

use dbs\dbs_basedatacell;

class dbs_pve_data_map extends dbs_basedatacell {

	/**
	 * 地图id
	 *
	 * @var string
	 */
	const DBKey_mapid = "mapid";
	/**
	 * 获取 地图id
	 */
	public function get_mapid() {
		return $this->getdata ( self::DBKey_mapid );
	}
	/**
	 * 设置 地图id
	 *
	 * @param unknown $value
	 */
	public function set_mapid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_mapid, $value );
	}
	/**
	 * 设置 地图id 默认值
	 */
	protected function _set_defaultvalue_mapid() {
		$this->set_defaultkeyandvalue ( self::DBKey_mapid, 0 );
	}

	/**
	 * 普通地图点数
	 *
	 * @var string
	 */
	const DBKey_normalmappoints = "normalmappoints";
	/**
	 * 获取 普通地图点数
	 */
	public function get_normalmappoints() {
		return $this->getdata ( self::DBKey_normalmappoints );
	}
	/**
	 * 设置 普通地图点数
	 *
	 * @param unknown $value
	 */
	public function set_normalmappoints($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_normalmappoints, $value );
	}
	public function add_normalmappoints($points) {
		$points = intval ( $points );
		if ($points <= 0) {
			return false;
		}
		$this->set_normalmappoints ( $this->get_normalmappoints () + $points );
		return true;
	}
	public function cost_normalmappints($points) {
	}
	/**
	 * 设置 普通地图点数 默认值
	 */
	protected function _set_defaultvalue_normalmappoints() {
		$this->set_defaultkeyandvalue ( self::DBKey_normalmappoints, 0 );
	}

	/**
	 * 噩梦地图点数
	 *
	 * @var string
	 */
	const DBKey_hardmappoints = "hardmappoints";
	/**
	 * 获取 噩梦地图点数
	 */
	public function get_hardmappoints() {
		return $this->getdata ( self::DBKey_hardmappoints );
	}
	/**
	 * 设置 噩梦地图点数
	 *
	 * @param unknown $value
	 */
	public function set_hardmappoints($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_hardmappoints, $value );
	}
	public function add_hardmappoints($points) {
		$points = intval ( $points );
		if ($points <= 0) {
			return false;
		}
		$this->set_hardmappoints ( $this->get_hardmappoints () + $points );
		return true;
	}
	public function cost_hardmappints($points) {
	}
	/**
	 * 设置 噩梦地图点数 默认值
	 */
	protected function _set_defaultvalue_hardmappoints() {
		$this->set_defaultkeyandvalue ( self::DBKey_hardmappoints, 0 );
	}

	/**
	 * 已经领取的奖品列表
	 *
	 * @var string
	 */
	const DBKey_awardlist = "awardlist";
	/**
	 * 获取 已经领取的奖品列表
	 */
	public function get_awardlist() {
		return $this->getdata ( self::DBKey_awardlist );
	}
	/**
	 * 设置 已经领取的奖品列表
	 *
	 * @param unknown $value
	 */
	public function set_awardlist($value) {
		// $value = strval($value);
		$this->setdata ( self::DBKey_awardlist, $value );
	}

	/**
	 * 设置 已经领取的奖品列表 默认值
	 */
	protected function _set_defaultvalue_awardlist() {
		$this->set_defaultkeyandvalue ( self::DBKey_awardlist, array () );
	}
	function __construct() {
		parent::__construct ( array () );
	}

	/**
	 * 奖励是否已经领取
	 *
	 * @param unknown $awardid
	 */
	public function get_award_received($awardid) {
		$awardlist = $this->get_awardlist ();
		return isset ( $awardlist [$awardid] );
	}
	/**
	 * 标记奖励已经领取
	 *
	 * @param unknown $awardid
	 */
	public function mark_award_received($awardid) {
		$awardlist = $this->get_awardlist ();
		$awardlist [$awardid] = time ();
		$this->set_awardlist ( $awardlist );
	}
}