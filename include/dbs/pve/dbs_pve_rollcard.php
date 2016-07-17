<?php

namespace dbs\pve;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_pve_awarditem_setting;
use constants\constants_returnkey;
use dbs\dbs_baseplayer;
use dbs\pve\data\dbs_pve_data_rollcardrollinfo;
use err\err_dbs_pve_rollcard_roll;

/**
 * 翻牌子服务
 * 2015年8月10日 上午11:09:36
 *
 * @author zhipeng
 *
 */
class dbs_pve_rollcard extends dbs_baseplayer {
	/**
	 * 表名
	 *
	 * @var string
	 */
	const DBKey_tablename = "pve_rollcard";
	function __construct() {
		parent::__construct ( self::DBKey_tablename );
	}

	/**
	 * 抽卡信息
	 *
	 * @var string
	 */
	const DBKey_rollinfos = "rollinfos";
	/**
	 * 获取 抽卡信息
	 */
	public function get_rollinfos() {
		return $this->getdata ( self::DBKey_rollinfos );
	}
	/**
	 * 设置 抽卡信息
	 *
	 * @param unknown $value
	 */
	private function set_rollinfos($value) {
		// $value = strval($value);
		$this->setdata ( self::DBKey_rollinfos, $value );
	}
	/**
	 * 设置 抽卡信息 默认值
	 */
	protected function _set_defaultvalue_rollinfos() {
		$this->set_defaultkeyandvalue ( self::DBKey_rollinfos, [ ] );
	}

	/**
	 * 当前摇奖信息
	 *
	 * @var string
	 */
	const DBKey_currentrollstageid = "currentrollstageid";
	/**
	 * 获取 当前摇奖信息
	 */
	public function get_currentrollstageid() {
		return $this->getdata ( self::DBKey_currentrollstageid );
	}
	/**
	 * 设置 当前摇奖信息
	 *
	 * @param unknown $value
	 */
	private function set_currentrollstageid($value) {
		$value = strval ( $value );
		$this->setdata ( self::DBKey_currentrollstageid, $value );
	}
	/**
	 * 设置 当前摇奖信息 默认值
	 */
	protected function _set_defaultvalue_currentrollstageid() {
		$this->set_defaultkeyandvalue ( self::DBKey_currentrollstageid, '' );
	}

	/**
	 * 创建抽卡信息
	 *
	 * @param unknown $stageid
	 */
	public function create_rollcard($stageid) {
		if (! empty ( $this->get_currentrollstageid () )) {
			$this->set_rollinfos ( [ ] );
		}
		$this->set_currentrollstageid ( $stageid );
	}

	/**
	 * 销毁抽卡信息
	 */
	public function dispose_rollcard() {
		if (! empty ( $this->get_currentrollstageid () )) {
			$this->set_currentrollstageid ( '' );
			$this->set_rollinfos ( [ ] );
		}
	}
	/**
	 * 摇奖
	 *
	 * @return \Common\Util\Common_Util_ReturnVar
	 */
	function roll() {
		$retCode = 0;
		$retCode_Str = 'SUCC';
		$data = array ();
		// class err_dbs_pve_rollcard_roll{}

		$stageid = $this->get_currentrollstageid ();
		if (empty ( $stageid )) {
			$retCode = err_dbs_pve_rollcard_roll::NOT_ROLL_INFO;
			$retCode_Str = 'NOT_ROLL_INFO';
			goto failed;
		}

		$rolltimes = count ( $this->get_rollinfos () ) + 1;
		$rollmaxtimes = Common_Util_Configdata::getInstance ()->get_global_config_value ( 'PVE_ROLL_CARD_MAX_TIMES' )->int_value ();
		if ($rolltimes > $rollmaxtimes) {
			$retCode = err_dbs_pve_rollcard_roll::ROLL_TIMES_MAX;
			$retCode_Str = 'ROLL_TIMES_MAX';
			goto failed;
		}

		// 钻石不足
		$need_diamond_key = "PVE_ROLL_CARD_NEED_DIAMOND_" . $rolltimes;
		$need_diamond = Common_Util_Configdata::getInstance ()->get_global_config_value ( $need_diamond_key )->int_value ();
		if ($this->db_owner->db_role ()->get_diamond () < $need_diamond) {
			$retCode = err_dbs_pve_rollcard_roll::NOT_ENOUGH_DIAMOND;
			$retCode_Str = 'NOT_ENOUGH_DIAMOND';
			goto failed;
		}

		// 不存在奖励物品
		$awardconfigs = dbs_pve_map::get_dropitems_group_by_stageid ( $stageid );
		if (is_null ( $awardconfigs )) {
			$retCode = err_dbs_pve_rollcard_roll::ROLL_AWARD_ITEMS_INFO_ERROR;
			$retCode_Str = 'ROLL_AWARD_ITEMS_INFO_ERROR';
			goto failed;
		}

		$weights = [ ];
		$awarditems = [ ];
		foreach ( $awardconfigs as $value ) {
			$weights [$value [configdata_pve_awarditem_setting::k_id]] = intval ( $value [configdata_pve_awarditem_setting::k_weight] );
			$awarditems [$value [configdata_pve_awarditem_setting::k_id]] = $value;
		}

		$award_id = Common_Util_Random::RandomWithWeight ( $weights );
		$awardconfig = $awarditems [$award_id];

		$awarddata = new dbs_pve_data_rollcardrollinfo ();
		$awarddata->set_awarditemid ( $awardconfig [configdata_pve_awarditem_setting::k_itemid] );
		$awarddata->set_awarditemcount ( $awardconfig [configdata_pve_awarditem_setting::k_itemcount] );

		$rollinfos = $this->get_rollinfos ();
		$rollinfos [] = $awarddata->toArray ();

		$this->set_rollinfos ( $rollinfos );

		$data [constants_returnkey::RK_AWARD] = $awarddata->toArray ();
		$data [constants_returnkey::RK_DIAMOND] = $need_diamond;
		// code

		succ:
		return Common_Util_ReturnVar::Ret ( true, $retCode, $data, $retCode_Str );
		failed:
		return Common_Util_ReturnVar::Ret ( false, $retCode, $data, $retCode_Str );
	}
}