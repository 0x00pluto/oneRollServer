<?php

namespace dbs\custom;

use constants\constants_returnkey;
use dbs\dbs_basedatacell;
use Common\Util\Common_Util_Configdata;
use configdata\configdata_npc_custom_goodwill_setting;
use Common\Util\Common_Util_ReturnVar;
use err\err_dbs_custom_goodwilldata_addexp;

/**
 *
 * @author zhipeng
 *
 */
class dbs_custom_goodwilldata extends dbs_basedatacell {

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
		$this->set_defaultkeyandvalue ( self::DBKey_npcid, '' );
	}

	/**
	 * 好感度经验
	 *
	 * @var string
	 */
	const DBKey_exp = "exp";
	/**
	 * 获取 好感度经验
	 */
	public function get_exp() {
		return $this->getdata ( self::DBKey_exp );
	}
	/**
	 * 设置 好感度经验
	 *
	 * @param unknown $value
	 */
	public function set_exp($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_exp, $value );
	}
	/**
	 * 设置 好感度经验 默认值
	 */
	protected function _set_defaultvalue_exp() {
		$this->set_defaultkeyandvalue ( self::DBKey_exp, 0 );
	}

	/**
	 * 增加经验
	 *
	 * @param int $exp
	 */
	public function addexp($exp) {
		$retCode = 0;
		$retCode_Str = 'SUCC';
		$data = array ();
		// class err_dbs_custom_goodwilldata_addexp{}
		$exp = intval ( $exp );
		if ($exp <= 0) {

			$retCode = err_dbs_custom_goodwilldata_addexp::EXP_FORMAT_ERROR;
			$retCode_Str = 'EXP_FORMAT_ERROR';
			goto failed;
		}

		// 等级配置
		$levelconfig = self::get_customgoodwillconfig ( $this->get_level () );

		// 满级了
		if (is_null ( $levelconfig [configdata_npc_custom_goodwill_setting::k_upgradeid] )) {
			$retCode = err_dbs_custom_goodwilldata_addexp::LEVEL_MAX;
			$retCode_Str = 'LEVEL_MAX';
			goto failed;
		}

		$level = $this->get_level ();
		$nextlevel = $level + 1;
		$newexp = $this->get_exp () + $exp;

		$this->set_totalexp ( $this->get_totalexp () + $exp );

		while ( TRUE ) {
			$nextlevelconf = self::get_customgoodwillconfig ( $nextlevel );
			// 等级最大了
			if (is_null ( $nextlevelconf )) {
				// 修正剩余的经验.
				$this->set_totalexp ( $this->get_totalexp () - $newexp );
				$newexp = 0;
				break;
			} else {
				$needexp = intval ( $nextlevelconf [configdata_npc_custom_goodwill_setting::k_needexp] );
				if ($newexp >= $needexp) {
					$newexp -= $needexp;
					// 升级
					$level ++;
					// 下一等级
					$nextlevel = $level + 1;
				} else {
					break;
				}
			}
		}

		$this->set_exp ( $newexp );
		if ($level != $this->get_level ()) {
			$this->set_level ( $level );
			// 设置需要开启任务
			$this->set_completelevelupmission ( false );
			$data [constants_returnkey::RK_UPGRADE] = true;
			$data [constants_returnkey::RK_LEVEL] = $level;
		}

		// code

		succ:
		return Common_Util_ReturnVar::Ret ( true, $retCode, $data, $retCode_Str );
		failed:
		return Common_Util_ReturnVar::Ret ( false, $retCode, $data, $retCode_Str );
	}

	/**
	 * 总好感度经验
	 *
	 * @var string
	 */
	const DBKey_totalexp = "totalexp";
	/**
	 * 获取 总好感度经验
	 */
	public function get_totalexp() {
		return $this->getdata ( self::DBKey_totalexp );
	}
	/**
	 * 设置 总好感度经验
	 *
	 * @param unknown $value
	 */
	private function set_totalexp($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_totalexp, $value );
	}
	/**
	 * 设置 总好感度经验 默认值
	 */
	protected function _set_defaultvalue_totalexp() {
		$this->set_defaultkeyandvalue ( self::DBKey_totalexp, 0 );
	}

	/**
	 * 获得好感度配置
	 *
	 * @param int $level
	 * @return Ambigous <multitype:, string>
	 */
	public static function get_customgoodwillconfig($level) {
		return Common_Util_Configdata::getInstance ()->getconfigdata ( configdata_npc_custom_goodwill_setting::class, configdata_npc_custom_goodwill_setting::k_id, $level );
	}

	/**
	 * 好感度等级
	 *
	 * @var string
	 */
	const DBKey_level = "level";
	/**
	 * 获取 好感度等级
	 */
	public function get_level() {
		return $this->getdata ( self::DBKey_level );
	}
	/**
	 * 设置 好感度等级
	 *
	 * @param unknown $value
	 */
	public function set_level($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_level, $value );
	}
	/**
	 * 设置 好感度等级 默认值
	 */
	protected function _set_defaultvalue_level() {
		$this->set_defaultkeyandvalue ( self::DBKey_level, 1 );
	}

	/**
	 * 是否完成好感度升级任务
	 *
	 * @var string
	 */
	const DBKey_completelevelupmission = "completelevelupmission";
	/**
	 * 获取 是否完成好感度升级任务
	 */
	public function get_completelevelupmission() {
		return $this->getdata ( self::DBKey_completelevelupmission );
	}
	/**
	 * 设置 是否完成好感度升级任务
	 *
	 * @param unknown $value
	 */
	private function set_completelevelupmission($value) {
		$value = boolval ( $value );
		$this->setdata ( self::DBKey_completelevelupmission, $value );
	}
	/**
	 * 设置 是否完成好感度升级任务 默认值
	 */
	protected function _set_defaultvalue_completelevelupmission() {
		$this->set_defaultkeyandvalue ( self::DBKey_completelevelupmission, true );
	}

	/**
	 * 设置完成升级任务
	 */
	public function completelevelupmission() {
		$this->set_completelevelupmission ( true );
	}

	/**
	 * 领取升级礼包的等级
	 *
	 * @var string
	 */
	const DBKey_awardleveluppackage = "awardleveluppackage";
	/**
	 * 获取 领取升级礼包的等级
	 */
	public function get_awardleveluppackage() {
		return $this->getdata ( self::DBKey_awardleveluppackage );
	}
	/**
	 * 设置 领取升级礼包的等级
	 *
	 * @param unknown $value
	 */
	private function set_awardleveluppackage($value) {
		$value = intval ( $value );
		$this->setdata ( self::DBKey_awardleveluppackage, $value );
	}
	/**
	 * 设置 领取升级礼包的等级 默认值
	 */
	protected function _set_defaultvalue_awardleveluppackage() {
		$this->set_defaultkeyandvalue ( self::DBKey_awardleveluppackage, 1 );
	}
	function __construct($npcid) {
		$this->set_npcid ( $npcid );

		parent::__construct ();
	}

	/**
	 * 是否可以领取好感度升级礼包
	 *
	 * @return boolean
	 */
	function canAwardLevelUpPackage() {
		return $this->get_level () > $this->get_awardleveluppackage ();
	}
	/**
	 * 领取升级礼包
	 *
	 * @return boolean
	 */
	function awardLevelUpPackage() {
		if (! $this->canAwardLevelUpPackage ()) {
			return false;
		}
		$level = $this->get_awardleveluppackage () + 1;
		$this->set_awardleveluppackage ( $level );

		return true;
	}
}