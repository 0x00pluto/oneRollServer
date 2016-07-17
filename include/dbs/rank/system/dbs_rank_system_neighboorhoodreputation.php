<?php

namespace dbs\rank\system;

use Common\Db\Common_Db_pools;
use constants\constants_ranktype;
use dbs\dbs_player;
use dbs\neighbourhood\dbs_neighbourhood_groupmemberreputationdata;
use dbs\neighbourhood\dbs_neighbourhood_playerdata;

class dbs_rank_system_neighboorhoodreputation extends dbs_rank_system_base {

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
		parent::__construct ( constants_ranktype::TYPE_NEIGHBOORHOOD_REPUTATION );
	}
	protected function sortall() {
		$dbins = Common_Db_pools::default_Db_pools ()->dbconnect ();
		$ret = $dbins->query ( dbs_neighbourhood_playerdata::DBKey_tablename, array (), array (
				dbs_neighbourhood_playerdata::DBKey_userid,
				dbs_neighbourhood_groupmemberreputationdata::DBKey_reputationlevel
		), $this->get_rank_count (), array (
				dbs_neighbourhood_groupmemberreputationdata::DBKey_reputationlevel => - 1
		) );

		return $this->_sortallarray ( $ret, dbs_neighbourhood_playerdata::DBKey_userid, dbs_neighbourhood_groupmemberreputationdata::DBKey_reputationlevel );
	}
	protected function create_rankdata(dbs_player $player, $rankvalue) {
		return dbs_rank_system_database::create ( $player, $rankvalue, $player->dbs_neighbourhood_playerdata ()->toArray () );
	}
}