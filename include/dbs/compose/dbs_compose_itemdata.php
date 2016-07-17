<?php

namespace dbs\compose;

use dbs\i\dbs_i_iCooldown;

/**
 *  合成物品数据
 *
 * @author zhipeng
 *
 */
class dbs_compose_itemdata implements dbs_i_iCooldown {

	/**
	 * 是否在合成中
	 *
	 * @var string
	 */
	const DBKey_isbusy = "isbusy";
	/**
	 * 获取 是否在合成中
	 */
	public function get_isbusy() {
		return $this->_data [self::DBKey_isbusy];
	}
	/**
	 * 设置 是否在合成中
	 *
	 * @param unknown $value
	 */
	public function set_isbusy($value) {
		$value = boolval ( $value );
		$this->_data [self::DBKey_isbusy] = $value;
	}

	/**
	 * 合成id
	 *
	 * @var string
	 */
	const DBKey_composeid = "composeid";
	/**
	 * 获取 合成id
	 */
	public function get_composeid() {
		return $this->_data [self::DBKey_composeid];
	}
	/**
	 * 设置 合成id
	 *
	 * @param unknown $value
	 */
	public function set_composeid($value) {
		$value = strval ( $value );
		$this->_data [self::DBKey_composeid] = $value;
	}

	/**
	 * 槽位id
	 *
	 * @var string
	 */
	const DBKey_slotsid = "slotsid";
	/**
	 * 获取 槽位id
	 */
	public function get_slotsid() {
		return $this->_data [self::DBKey_slotsid];
	}
	/**
	 * 设置 槽位id
	 *
	 * @param unknown $value
	 */
	public function set_slotsid($value) {
		$value = strval ( $value );
		$this->_data [self::DBKey_slotsid] = $value;
	}

	/**
	 * 完成时间
	 *
	 * @var string
	 */
	const DBKey_finishtime = "finishtime";
	/**
	 * 获取 完成时间
	 */
	public function get_finishtime() {
		return $this->_data [self::DBKey_finishtime];
	}
	/**
	 * 设置 完成时间
	 *
	 * @param unknown $value
	 */
	public function set_finishtime($value) {
		$value = intval ( $value );
		$this->_data [self::DBKey_finishtime] = $value;
	}
	private $_data = array ();
	/**
	 * toArray
	 */
	public function toArray() {
		return $this->_data;
	}
	/**
	 * fromArray
	 */
	public function fromArray($arr) {
		$this->_data = $arr;
	}
	function __construct($slotid) {
		$this->set_composeid ( '' );
		$this->set_finishtime ( 0 );
		$this->set_slotsid ( $slotid );
		$this->set_isbusy ( false );
	}
	/**
	 * 获取冷却时间,没有冷却 return 0 秒,
	 */
	function getCooldownTime() {
		if (time () > $this->get_finishtime ()) {
			return 0;
		}
		return $this->get_finishtime () - time ();
	}
	/**
	 * 清除冷却
	 */
	function clearCooldown() {
		$this->set_finishtime ( 0 );
	}
	/**
	 * 获取清除冷却用的钻石 目前是系数,通用配置在文档
	 */
	function get_clearCooldownDiamond() {
		return 1;
	}

	/**
	 * 是否在冷却中
	 */
	function is_Cooldown() {
		return ($this->get_isbusy () && time () < $this->get_finishtime ());
	}
}