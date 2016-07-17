<?php

namespace dbs\rank\system;

use Common\Db\Common_Db_pools;
use constants\constants_ranktype;
use dbs\dbs_player;
use dbs\dbs_restaurantinfo;

/**
 * 排行demo
 *
 * @author zhipeng
 *
 */
class dbs_rank_system_restaurantlevel extends dbs_rank_system_base {

	/**
	 * singleton
	 */
	private static $_instance;
	public function __clone() {
		trigger_error ( 'Clone is not allow!', E_USER_ERROR );
	}
	// 单例方法,用于访问实例的公共的静态方法
	public static function getInstance() {
		if (! (self::$_instance instanceof self)) {
			self::$_instance = new self ();
		}
		return self::$_instance;
	}
	function __construct() {
		parent::__construct ( constants_ranktype::TYPE_RESTAURANTLEVEL );
	}
	protected function sortall() {
		$dbins = Common_Db_pools::default_Db_pools ()->dbconnect ();
		$ret = $dbins->query ( dbs_restaurantinfo::DBKey_tablename, array (), array (
				dbs_restaurantinfo::DBKey_userid,
				dbs_restaurantinfo::DBKey_restaurantlevel
		), $this->get_rank_count (), array (
				dbs_restaurantinfo::DBKey_restaurantlevel => - 1
		) );

		return $this->_sortallarray ( $ret, dbs_restaurantinfo::DBKey_userid, dbs_restaurantinfo::DBKey_restaurantlevel );
	}
	protected function create_rankdata(dbs_player $player, $rankvalue) {
		return dbs_rank_system_database::create ( $player, $rankvalue, $player->db_restaurantinfo ()->toArray () );
	}
}