<?php

namespace dbs\pve\data;

use dbs\dbs_basedatacell;
use configdata\configdata_pve_map_super_slot_machine_award_setting;
use Common\Util\Common_Util_Configdata;

/**
 * 超级老虎机摇奖信息
 *
 * @author zhipeng
 *
 */
class dbs_pve_data_superslotmachinerollinfo extends dbs_basedatacell {

	/**
	 * 用户id
	 *
	 * @var string
	 */
	const DBKey_userid = "userid";
	/**
	 * 获取 用户id
	 */
	public function get_userid() {
		return $this->getdata ( self::DBKey_userid );
	}
	/**
	 * 设置 用户id
	 *
	 * @param unknown $value
	 */
	public function set_userid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_userid, $value );
	}
	/**
	 * 设置 用户id 默认值
	 */
	protected function _set_defaultvalue_userid() {
		$this->set_defaultkeyandvalue ( self::DBKey_userid, null );
	}

	/**
	 * 摇奖超时时间
	 *
	 * @var string
	 */
	const DBKey_rolltimeout = "rolltimeout";
	/**
	 * 获取 摇奖超时时间
	 */
	public function get_rolltimeout() {
		return $this->getdata ( self::DBKey_rolltimeout );
	}
	/**
	 * 设置 摇奖超时时间
	 *
	 * @param unknown $value
	 */
	private function set_rolltimeout($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_rolltimeout, $value );
	}
	/**
	 * 设置 摇奖超时时间 默认值
	 */
	protected function _set_defaultvalue_rolltimeout() {
		$this->set_defaultkeyandvalue ( self::DBKey_rolltimeout, null );
	}

	/**
	 * 摇奖次数
	 *
	 * @var string
	 */
	const DBKey_rolltimes = "rolltimes";
	/**
	 * 获取 摇奖次数
	 */
	public function get_rolltimes() {
		return $this->getdata ( self::DBKey_rolltimes );
	}
	/**
	 * 设置 摇奖次数
	 *
	 * @param unknown $value
	 */
	private function set_rolltimes($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_rolltimes, $value );
	}
	/**
	 * 设置 摇奖次数 默认值
	 */
	protected function _set_defaultvalue_rolltimes() {
		$this->set_defaultkeyandvalue ( self::DBKey_rolltimes, 0 );
	}

	/**
	 * 花费的钻石数量
	 *
	 * @var string
	 */
	const DBKey_costdiamond = "costdiamond";
	/**
	 * 获取 花费的钻石数量
	 */
	public function get_costdiamond() {
		return $this->getdata ( self::DBKey_costdiamond );
	}
	/**
	 * 设置 花费的钻石数量
	 *
	 * @param unknown $value
	 */
	private function set_costdiamond($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_costdiamond, $value );
	}
	/**
	 * 设置 花费的钻石数量 默认值
	 */
	protected function _set_defaultvalue_costdiamond() {
		$this->set_defaultkeyandvalue ( self::DBKey_costdiamond, 0 );
	}

	/**
	 * 领取的奖励id
	 *
	 * @var string
	 */
	const DBKey_awardid = "awardid";
	/**
	 * 获取 领取的奖励id
	 */
	public function get_awardid() {
		return $this->getdata ( self::DBKey_awardid );
	}
	/**
	 * 设置 领取的奖励id
	 *
	 * @param unknown $value
	 */
	private function set_awardid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_awardid, $value );
	}
	/**
	 * 设置 领取的奖励id 默认值
	 */
	protected function _set_defaultvalue_awardid() {
		$this->set_defaultkeyandvalue ( self::DBKey_awardid, null );
	}

	/**
	 * 奖励道具i
	 *
	 * @var string
	 */
	const DBKey_awarditemid = "awarditemid";
	/**
	 * 获取 奖励道具i
	 */
	public function get_awarditemid() {
		return $this->getdata ( self::DBKey_awarditemid );
	}
	/**
	 * 设置 奖励道具i
	 *
	 * @param unknown $value
	 */
	private function set_awarditemid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_awarditemid, $value );
	}
	/**
	 * 设置 奖励道具i 默认值
	 */
	protected function _set_defaultvalue_awarditemid() {
		$this->set_defaultkeyandvalue ( self::DBKey_awarditemid, null );
	}

	/**
	 * 奖励道具数量
	 *
	 * @var string
	 */
	const DBKey_awarditemcount = "awarditemcount";
	/**
	 * 获取 奖励道具数量
	 */
	public function get_awarditemcount() {
		return $this->getdata ( self::DBKey_awarditemcount );
	}
	/**
	 * 设置 奖励道具数量
	 *
	 * @param unknown $value
	 */
	private function set_awarditemcount($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_awarditemcount, $value );
	}
	/**
	 * 设置 奖励道具数量 默认值
	 */
	protected function _set_defaultvalue_awarditemcount() {
		$this->set_defaultkeyandvalue ( self::DBKey_awarditemcount, 0 );
	}

	/**
	 * 是否完成
	 *
	 * @var string
	 */
	const DBKey_isfinish = "isfinish";
	/**
	 * 获取 是否完成
	 */
	public function get_isfinish() {
		return $this->getdata ( self::DBKey_isfinish );
	}
	/**
	 * 设置 是否完成
	 *
	 * @param unknown $value
	 */
	public function set_isfinish($value) {
		$value = boolval ( $value );
		$this->setdata ( self::DBKey_isfinish, $value );
	}
	/**
	 * 设置 是否完成 默认值
	 */
	protected function _set_defaultvalue_isfinish() {
		$this->set_defaultkeyandvalue ( self::DBKey_isfinish, false );
	}
	function __construct() {
		parent::__construct ( array () );
	}

	/**
	 * 摇奖
	 *
	 * @param unknown $awardid
	 * @param unknown $costdiamond
	 */
	function roll($awardid, $costdiamond) {
		$this->set_rolltimes ( $this->get_rolltimes () + 1 );
		$this->set_awardid ( $awardid );

		$awardconfig = dbs_pve_data_superslotmachine::get_awarditems ( $awardid );
		$this->set_awarditemid ( $awardconfig [configdata_pve_map_super_slot_machine_award_setting::k_itemid] );
		$this->set_awarditemcount ( $awardconfig [configdata_pve_map_super_slot_machine_award_setting::k_itemcount] );

		$rolltimeout = Common_Util_Configdata::getInstance ()->get_global_config_value ( 'SUPER_SLOTMACHINE_ROLL_TIMEOUT' )->int_value ();
		$this->set_rolltimeout ( time () + $rolltimeout );
		$this->set_costdiamond ( $this->get_costdiamond () + $costdiamond );
	}
	/**
	 * 放弃
	 *
	 * @return boolean 是否有数据变化
	 */
	function giveup() {
		if ($this->get_isfinish ()) {
			return false;
		}
		$this->set_rolltimeout ( 0 );
		$this->set_isfinish ( true );
		return true;
	}
}