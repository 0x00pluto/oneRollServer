<?php

namespace dbs\trade;

use Common\Util\Common_Util_Guid;
use dbs\dbs_basedatacell;

/**
 * 交易数据
 *
 * @author zhipeng
 *
 */
class dbs_trade_data extends dbs_basedatacell {

	/**
	 * 交易id
	 *
	 * @var string
	 */
	const DBKey_tradeid = "tradeid";
	/**
	 * 获取 交易id
	 */
	public function get_tradeid() {
		return $this->getdata ( self::DBKey_tradeid );
	}
	/**
	 * 设置 交易id
	 *
	 * @param unknown $value
	 */
	public function set_tradeid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_tradeid, $value );
	}
	/**
	 * 设置 交易id 默认值
	 */
	protected function _set_defaultvalue_tradeid() {
		$this->set_defaultkeyandvalue ( self::DBKey_tradeid, null );
	}

	/**
	 * 发布者的userid
	 *
	 * @var string
	 */
	const DBKey_publicuserid = "publicuserid";
	/**
	 * 获取 发布者的userid
	 */
	public function get_publicuserid() {
		return $this->getdata ( self::DBKey_publicuserid );
	}
	/**
	 * 设置 发布者的userid
	 *
	 * @param unknown $value
	 */
	public function set_publicuserid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_publicuserid, $value );
	}
	/**
	 * 设置 发布者的userid 默认值
	 */
	protected function _set_defaultvalue_publicuserid() {
		$this->set_defaultkeyandvalue ( self::DBKey_publicuserid, null );
	}

	/**
	 * 发布时间
	 *
	 * @var string
	 */
	const DBKey_publictime = "publictime";
	/**
	 * 获取 发布时间
	 */
	public function get_publictime() {
		return $this->getdata ( self::DBKey_publictime );
	}
	/**
	 * 设置 发布时间
	 *
	 * @param unknown $value
	 */
	public function set_publictime($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_publictime, $value );
	}
	/**
	 * 设置 发布时间 默认值
	 */
	protected function _set_defaultvalue_publictime() {
		$this->set_defaultkeyandvalue ( self::DBKey_publictime, 0 );
	}

	/**
	 * 出售的物品id
	 *
	 * @var string
	 */
	const DBKey_sellitemid = "sellitemid";
	/**
	 * 获取 出售的物品id
	 */
	public function get_sellitemid() {
		return $this->getdata ( self::DBKey_sellitemid );
	}
	/**
	 * 设置 出售的物品id
	 *
	 * @param unknown $value
	 */
	public function set_sellitemid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_sellitemid, $value );
	}
	/**
	 * 设置 出售的物品id 默认值
	 */
	protected function _set_defaultvalue_sellitemid() {
		$this->set_defaultkeyandvalue ( self::DBKey_sellitemid, "" );
	}

	/**
	 * 出售物品数量
	 *
	 * @var string
	 */
	const DBKey_sellitemnum = "sellitemnum";
	/**
	 * 获取 出售物品数量
	 */
	public function get_sellitemnum() {
		return $this->getdata ( self::DBKey_sellitemnum );
	}
	/**
	 * 设置 出售物品数量
	 *
	 * @param unknown $value
	 */
	public function set_sellitemnum($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_sellitemnum, $value );
	}
	/**
	 * 设置 出售物品数量 默认值
	 */
	protected function _set_defaultvalue_sellitemnum() {
		$this->set_defaultkeyandvalue ( self::DBKey_sellitemnum, 0 );
	}

	/**
	 * 收购的物品id
	 *
	 * @var string
	 */
	const DBKey_buyitemid = "buyitemid";
	/**
	 * 获取 收购的物品id
	 */
	public function get_buyitemid() {
		return $this->getdata ( self::DBKey_buyitemid );
	}
	/**
	 * 设置 收购的物品id
	 *
	 * @param unknown $value
	 */
	public function set_buyitemid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_buyitemid, $value );
	}
	/**
	 * 设置 收购的物品id 默认值
	 */
	protected function _set_defaultvalue_buyitemid() {
		$this->set_defaultkeyandvalue ( self::DBKey_buyitemid, null );
	}

	/**
	 * 收购物品数量
	 *
	 * @var string
	 */
	const DBKey_buyitemnum = "buyitemnum";
	/**
	 * 获取 收购物品数量
	 */
	public function get_buyitemnum() {
		return $this->getdata ( self::DBKey_buyitemnum );
	}
	/**
	 * 设置 收购物品数量
	 *
	 * @param unknown $value
	 */
	public function set_buyitemnum($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_buyitemnum, $value );
	}
	/**
	 * 设置 收购物品数量 默认值
	 */
	protected function _set_defaultvalue_buyitemnum() {
		$this->set_defaultkeyandvalue ( self::DBKey_buyitemnum, 0 );
	}

	/**
	 * 是否完成订单
	 *
	 * @var string
	 */
	const DBKey_iscomplete = "iscomplete";
	/**
	 * 获取 是否完成订单
	 */
	public function get_iscomplete() {
		return $this->getdata ( self::DBKey_iscomplete );
	}
	/**
	 * 设置 是否完成订单
	 *
	 * @param unknown $value
	 */
	public function set_iscomplete($value) {
		$value = boolval ( $value );
		$this->setdata ( self::DBKey_iscomplete, $value );
	}
	/**
	 * 设置 是否完成订单 默认值
	 */
	protected function _set_defaultvalue_iscomplete() {
		$this->set_defaultkeyandvalue ( self::DBKey_iscomplete, false );
	}

	/**
	 * 购买用户信息
	 *
	 * @var string
	 */
	const DBKey_buyplayerinfo = "buyplayerinfo";
	/**
	 * 获取 购买用户信息
	 */
	public function get_buyplayerinfo() {
		return $this->getdata ( self::DBKey_buyplayerinfo );
	}
	/**
	 * 设置 购买用户信息
	 *
	 * @param unknown $value
	 */
	public function set_buyplayerinfo($value) {
		// $value = strval($value);
		$this->setdata ( self::DBKey_buyplayerinfo, $value );
	}
	/**
	 * 设置 购买用户信息 默认值
	 */
	protected function _set_defaultvalue_buyplayerinfo() {
		$this->set_defaultkeyandvalue ( self::DBKey_buyplayerinfo, array () );
	}

	/**
	 * npc自动试图购买
	 *
	 * @var string
	 */
	const DBKey_npctrybuy = "npctrybuy";
	/**
	 * 获取 npc自动试图购买
	 */
	public function get_npctrybuy() {
		return $this->getdata ( self::DBKey_npctrybuy );
	}
	/**
	 * 设置 npc自动试图购买
	 *
	 * @param unknown $value
	 */
	public function set_npctrybuy($value) {
		$value = boolval ( $value );
		$this->setdata ( self::DBKey_npctrybuy, $value );
	}
	/**
	 * 设置 npc自动试图购买 默认值
	 */
	protected function _set_defaultvalue_npctrybuy() {
		$this->set_defaultkeyandvalue ( self::DBKey_npctrybuy, false );
	}
	function __construct() {
		parent::__construct ( array () );
	}
	/**
	 * create...
	 *
	 * @param string $publicuserid
	 * @param string $sellitemid
	 * @param int $sellitemnum
	 * @param string $buyitemid
	 * @param int $buyitemnum
	 * @return dbs_trade_data
	 */
	static function create($publicuserid, $sellitemid, $sellitemnum, $buyitemid, $buyitemnum) {
		$ins = new self ();

		$ins->set_tradeid ( Common_Util_Guid::gen_trade_guid () );
		$ins->set_publicuserid ( $publicuserid );
		$ins->set_publictime ( time () );
		$ins->set_sellitemid ( $sellitemid );
		$ins->set_sellitemnum ( $sellitemnum );

		$ins->set_buyitemid ( $buyitemid );
		$ins->set_buyitemnum ( $buyitemnum );
		// $ins->set_iscomplete(false)

		return $ins;
	}
}