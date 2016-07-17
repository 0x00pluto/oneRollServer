<?php

namespace dbs\rank\system;

use Common\Db\Common_Db_pools;
use constants\constants_ranktype;
use dbs\dbs_player;
use dbs\dbs_restaurantinfo;

/**
 * 美誉度排行
 *
 * @author zhipeng
 *
 */
class dbs_rank_system_restaurantreputation extends dbs_rank_system_base {

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
		parent::__construct ( constants_ranktype::TYPE_RESTAURANT_REPUTATION );
	}
	protected function sortall() {
		$dbins = Common_Db_pools::default_Db_pools ()->dbconnect ();
		$ret = $dbins->query ( dbs_restaurantinfo::DBKey_tablename, array (), array (
				dbs_restaurantinfo::DBKey_userid,
				dbs_restaurantinfo::DBKey_restauranttotalexp
		), $this->get_rank_count (), array (
				dbs_restaurantinfo::DBKey_restauranttotalexp => - 1
		) );

		return $this->_sortallarray ( $ret, dbs_restaurantinfo::DBKey_userid, dbs_restaurantinfo::DBKey_restauranttotalexp );
	}
	protected function create_rankdata(dbs_player $player, $rankvalue) {
		return dbs_rank_system_database::create ( $player, $rankvalue, $player->db_restaurantinfo ()->toArray () );
	}
}