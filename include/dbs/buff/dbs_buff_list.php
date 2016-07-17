<?php

namespace dbs\buff;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_item_buff_effect_setting;
use dbs\dbs_baseplayer;
use err\err_dbs_buff_list_addbuff;

/**
 *
 * buff类
 *
 * @author zhipeng
 *
 */
class dbs_buff_list extends dbs_baseplayer {

	/**
	 * buff列表
	 *
	 * @var string
	 */
	const DBKey_bufflist = "bufflist";
	/**
	 * 获取 buff列表
	 */
	public function get_bufflist() {
		return $this->getdata ( self::DBKey_bufflist );
	}
	/**
	 * 设置 buff列表
	 *
	 * @param unknown $value
	 */
	private function set_bufflist($value) {
		// $value = strval($value);
		$this->setdata ( self::DBKey_bufflist, $value );
	}
	/**
	 * 设置 buff列表 默认值
	 */
	protected function _set_defaultvalue_bufflist() {
		$this->set_defaultkeyandvalue ( self::DBKey_bufflist, array () );
	}

	/**
	 * 表名
	 *
	 * @var string
	 */
	const DBKey_tablename = "buff_list";
	function __construct() {
		parent::__construct ( self::DBKey_tablename );
	}

	/**
	 * 获取buff配置
	 *
	 * @param unknown $buffid
	 * @return Ambigous <\Common\Util\multitype:, string>
	 */
	static function get_buffconfig($buffid) {
		return Common_Util_Configdata::getInstance ()->getconfigdata ( configdata_item_buff_effect_setting::class, configdata_item_buff_effect_setting::k_id, $buffid );
	}

	/**
	 * 获取buff
	 *
	 * @param string $buffkindid
	 * @return dbs_buff_data|NULL
	 */
	public function get_buff($buffkindid) {
		$buffkindid = strval ( $buffkindid );
		$buffs = $this->get_bufflist ();
		if (isset ( $buffs [$buffkindid] )) {
			$data = dbs_buff_data::create_with_array ( $buffs [$buffkindid] );
			return $data;
		}
		return null;
	}

	/**
	 * 设置buff数据
	 *
	 * @param dbs_buff_data $data
	 */
	private function set_buff(dbs_buff_data $data) {
		$buffs = $this->get_bufflist ();
		$buffs [$data->get_buffkindid ()] = $data->toArray ();
		$this->set_bufflist ( $buffs );
	}

	/**
	 * 增加buff
	 *
	 * @param unknown $buffid
	 */
	function addbuff($buffid) {
		$retCode = 0;
		$retCode_Str = 'SUCC';
		$data = array ();
		// class err_dbs_buff_list_addbuff{}
		$buffid = strval ( $buffid );

		$buffconfig = self::get_buffconfig ( $buffid );
		if (is_null ( $buffconfig )) {
			$retCode = err_dbs_buff_list_addbuff::BUFFID_NOT_EXIST;
			$retCode_Str = 'BUFFID_NOT_EXIST';
			goto failed;
		}

		$buffdata = $this->get_buff ( $buffconfig [configdata_item_buff_effect_setting::k_kinds] );
		if (is_null ( $buffdata )) {
			$buffdata = dbs_buff_data::create ( $buffid );
		} else {
			if (! $buffdata->addbuff ( $buffid )) {
				$retCode = err_dbs_buff_list_addbuff::BUFF_ADD_ERROR;
				$retCode_Str = 'BUFF_ADD_ERROR';
				goto failed;
			}
		}
		$this->set_buff ( $buffdata );

		$data = $buffdata->toArray ();

		// code

		succ:
		return Common_Util_ReturnVar::Ret ( true, $retCode, $data, $retCode_Str );
		failed:
		return Common_Util_ReturnVar::Ret ( false, $retCode, $data, $retCode_Str );
	}
	function masterbeforecall() {
		$datachange = false;
		$buffs = $this->get_bufflist ();
		foreach ( $buffs as $key => $value ) {
			$buffdata = dbs_buff_data::create_with_array ( $value );
			if (time () > $buffdata->get_timeout ()) {
				unset ( $buffs [$key] );
				$datachange = true;
			}
		}
		if ($datachange) {
			$this->set_bufflist ( $buffs );
		}
	}
}