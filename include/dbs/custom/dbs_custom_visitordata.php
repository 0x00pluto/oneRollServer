<?php

namespace dbs\custom;

use dbs\dbs_basedatacell;
use constants\constants_customtype;
use Common\Util\Common_Util_Guid;
use constants\constants_defaultvalue;

class dbs_custom_visitordata extends dbs_basedatacell {
	// private $_data = array ();

	/**
	 * 生成时间
	 *
	 * @var string
	 */
	const DBKey_timeborn = "timeborn";
	/**
	 * 获取 生成时间
	 */
	public function get_timeborn() {
		return $this->getdata ( self::DBKey_timeborn );
	}
	/**
	 * 设置 生成时间
	 *
	 * @param unknown $value
	 */
	public function set_timeborn($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_timeborn, $value );
	}
	/**
	 * 设置 生成时间 默认值
	 */
	protected function _set_defaultvalue_timeborn() {
		$this->set_defaultkeyandvalue ( self::DBKey_timeborn, 0 );
	}

	/**
	 * 死亡时间
	 *
	 * @var string
	 */
	const DBKey_timedead = "timedead";
	/**
	 * 获取 死亡时间
	 */
	public function get_timedead() {
		return $this->getdata ( self::DBKey_timedead );
	}
	/**
	 * 设置 死亡时间
	 *
	 * @param unknown $value
	 */
	public function set_timedead($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_timedead, $value );
	}
	/**
	 * 设置 死亡时间 默认值
	 */
	protected function _set_defaultvalue_timedead() {
		$this->set_defaultkeyandvalue ( self::DBKey_timedead, 0 );
	}

	/**
	 * guid
	 *
	 * @var string
	 */
	const DBKey_guid = "guid";
	/**
	 * 获取 guid
	 */
	public function get_guid() {
		return $this->getdata ( self::DBKey_guid );
	}
	/**
	 * 设置 guid
	 *
	 * @param unknown $value
	 */
	public function set_guid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_guid, $value );
	}
	/**
	 * 设置 guid 默认值
	 */
	protected function _set_defaultvalue_guid() {
		$this->set_defaultkeyandvalue ( self::DBKey_guid, null );
	}

	/**
	 * npcid
	 *
	 * @var string
	 */
	const DBKey_npcid = "npcid";
	/**
	 * 获取 npcid
	 */
	public function get_npcid() {
		return $this->getdata ( self::DBKey_npcid );
	}
	/**
	 * 设置 npcid
	 *
	 * @param unknown $value
	 */
	public function set_npcid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_npcid, $value );
	}
	/**
	 * 设置 npcid 默认值
	 */
	protected function _set_defaultvalue_npcid() {
		$this->set_defaultkeyandvalue ( self::DBKey_npcid, null );
	}

	/**
	 * 任务id
	 *
	 * @var string
	 */
	const DBKey_missionid = "missionid";
	/**
	 * 获取 任务id
	 */
	public function get_missionid() {
		return $this->getdata ( self::DBKey_missionid );
	}
	/**
	 * 设置 任务id
	 *
	 * @param unknown $value
	 */
	public function set_missionid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_missionid, $value );
	}
	/**
	 * 设置 任务id 默认值
	 */
	protected function _set_defaultvalue_missionid() {
		$this->set_defaultkeyandvalue ( self::DBKey_missionid, null );
	}

	/**
	 * 掉落物品id
	 *
	 * @var string
	 */
	const DBKey_itemid1 = "itemid1";
	/**
	 * 获取 掉落物品id
	 */
	public function get_itemid1() {
		return $this->getdata ( self::DBKey_itemid1 );
	}
	/**
	 * 设置 掉落物品id
	 *
	 * @param unknown $value
	 */
	public function set_itemid1($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_itemid1, $value );
	}
	/**
	 * 设置 掉落物品id 默认值
	 */
	protected function _set_defaultvalue_itemid1() {
		$this->set_defaultkeyandvalue ( self::DBKey_itemid1, null );
	}

	/**
	 * 掉落物品数量
	 *
	 * @var string
	 */
	const DBKey_itemcount1 = "itemcount1";
	/**
	 * 获取 掉落物品数量
	 */
	public function get_itemcount1() {
		return $this->getdata ( self::DBKey_itemcount1 );
	}
	/**
	 * 设置 掉落物品数量
	 *
	 * @param unknown $value
	 */
	public function set_itemcount1($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_itemcount1, $value );
	}
	/**
	 * 设置 掉落物品数量 默认值
	 */
	protected function _set_defaultvalue_itemcount1() {
		$this->set_defaultkeyandvalue ( self::DBKey_itemcount1, 0 );
	}

	/**
	 * 掉了物品id2
	 *
	 * @var string
	 */
	const DBKey_itemid2 = "itemid2";
	/**
	 * 获取 掉了物品id2
	 */
	public function get_itemid2() {
		return $this->getdata ( self::DBKey_itemid2 );
	}
	/**
	 * 设置 掉了物品id2
	 *
	 * @param unknown $value
	 */
	public function set_itemid2($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_itemid2, $value );
	}
	/**
	 * 设置 掉了物品id2 默认值
	 */
	protected function _set_defaultvalue_itemid2() {
		$this->set_defaultkeyandvalue ( self::DBKey_itemid2, null );
	}

	/**
	 * 掉落物品数量2
	 *
	 * @var string
	 */
	const DBKey_itemcount2 = "itemcount2";
	/**
	 * 获取 掉落物品数量2
	 */
	public function get_itemcount2() {
		return $this->getdata ( self::DBKey_itemcount2 );
	}
	/**
	 * 设置 掉落物品数量2
	 *
	 * @param unknown $value
	 */
	public function set_itemcount2($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_itemcount2, $value );
	}
	/**
	 * 设置 掉落物品数量2 默认值
	 */
	protected function _set_defaultvalue_itemcount2() {
		$this->set_defaultkeyandvalue ( self::DBKey_itemcount2, 0 );
	}

	/**
	 * npc类型 1访客 2好友
	 *
	 * @var string
	 */
	const DBKey_npctype = "npctype";
	/**
	 * 获取 npc类型 1访客 2好友
	 */
	public function get_npctype() {
		return $this->getdata ( self::DBKey_npctype );
	}
	/**
	 * 设置 npc类型 1访客 2好友
	 *
	 * @param unknown $value
	 */
	public function set_npctype($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_npctype, $value );
	}
	/**
	 * 设置 npc类型 1访客 2好友 默认值
	 */
	protected function _set_defaultvalue_npctype() {
		$this->set_defaultkeyandvalue ( self::DBKey_npctype, constants_customtype::NPC );
	}

	/**
	 * 是否已经吃过饭了
	 *
	 * @var string
	 */
	const DBKey_alreadyEat = "alreadyEat";
	/**
	 * 获取 是否已经吃过饭了
	 */
	public function get_alreadyEat() {
		return $this->getdata ( self::DBKey_alreadyEat );
	}
	/**
	 * 设置 是否已经吃过饭了
	 *
	 * @param unknown $value
	 */
	public function set_alreadyEat($value) {
		$value = boolval ( $value );
		$this->setdata ( self::DBKey_alreadyEat, $value );
	}
	/**
	 * 设置 是否已经吃过饭了 默认值
	 */
	protected function _set_defaultvalue_alreadyEat() {
		$this->set_defaultkeyandvalue ( self::DBKey_alreadyEat, false );
	}
	function __construct() {
		parent::__construct ();
	}

	/**
	 *
	 * @param unknown $npcid
	 * @return \dbs\custom\dbs_custom_visitordata
	 */
	static function create($npcid) {
		$ins = new self ();
		$ins->set_npcid ( $npcid );
		$ins->set_guid ( Common_Util_Guid::gen_visitor () );
		$ins->set_itemcount1 ( 0 );
		$ins->set_itemid1 ( constants_defaultvalue::ITEM_ID_EMPTY );
		$ins->set_itemid2 ( constants_defaultvalue::ITEM_ID_EMPTY );
		$ins->set_itemcount2 ( 0 );

		$ins->set_timeborn ( time () );
		$ins->set_timedead ( time () );
		$ins->set_missionid ( constants_defaultvalue::MISSIONID_EMPTY );

		return $ins;
	}

	/**
	 * 添加道具
	 *
	 * @param string $itemid
	 * @param integer $itemcount
	 */
	public function addItem($itemid, $itemcount) {
		$itemid = strval ( $itemid );
		$itemcount = intval ( $itemcount );

		if (empty ( $this->get_itemid1 () )) {
			$this->set_itemid1 ( $itemid );
			$this->set_itemcount1 ( $itemcount );
		} else {
			$this->set_itemid2 ( $itemid );
			$this->set_itemcount2 ( $itemcount );
		}
	}
	/**
	 * 是否已经死亡
	 *
	 * @return boolean
	 */
	public function isdead() {
		return time () > $this->get_timedead ();
	}
}