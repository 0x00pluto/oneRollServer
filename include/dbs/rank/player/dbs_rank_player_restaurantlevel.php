<?php

namespace dbs\rank\player;

use constants\constants_ranktype;
use dbs\dbs_role;
use dbs\dbs_restaurantinfo;
use dbs\dbs_player;
use dbs\rank\system\dbs_rank_system_database;
use Common\Db\Common_Db_pools;

class dbs_rank_player_restaurantlevel extends dbs_rank_player_base {
	function __construct($userid) {
		parent::__construct ( constants_ranktype::TYPE_RESTAURANTLEVEL, $userid );
	}
	protected function sortall() {
		$where = array (
				dbs_role::DBKey_userid => array (
						'$in' => $this->get_frienduserids ()
				)
		);

		$dbins = Common_Db_pools::default_Db_pools ()->dbconnect  ();
		$ret = $dbins->query ( dbs_restaurantinfo::DBKey_tablename, $where, array (
				dbs_restaurantinfo::DBKey_userid,
				dbs_restaurantinfo::DBKey_restaurantlevel
		), - 1, array (
				dbs_restaurantinfo::DBKey_restaurantlevel => - 1
		) );

		return $this->_sortallarray ( $ret, dbs_restaurantinfo::DBKey_userid, dbs_restaurantinfo::DBKey_restaurantlevel );
	}
	protected function create_rankdata(dbs_player $player, $rankvalue) {
		return dbs_rank_system_database::create ( $player, $rankvalue, $player->db_restaurantinfo ()->toArray () );
	}
}