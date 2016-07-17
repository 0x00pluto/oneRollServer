<?php

namespace dbs\rank\player;

use Common\Db\Common_Db_pools;
use constants\constants_ranktype;
use dbs\dbs_player;
use dbs\dbs_role;
use dbs\rank\system\dbs_rank_system_database;

class dbs_rank_player_addgamecoins extends dbs_rank_player_base {
	function __construct($userid) {
		parent::__construct ( constants_ranktype::TYPE_ADDGAMECOINS, $userid );
	}
	protected function sortall() {
		$dbins = Common_Db_pools::default_Db_pools ()->dbconnect ();

		$where = array (
				dbs_role::DBKey_userid => array (
						'$in' => $this->get_frienduserids ()
				)
		);

		$ret = $dbins->query ( dbs_role::DBKey_tablename, $where, array (
				dbs_role::DBKey_userid,
				dbs_role::DBKey_addgamecoins
		), - 1, array (
				dbs_role::DBKey_addgamecoins => - 1
		) );
		return $this->_sortallarray ( $ret, dbs_role::DBKey_userid, dbs_role::DBKey_addgamecoins );
	}
	protected function create_rankdata(dbs_player $player, $rankvalue) {
		return dbs_rank_system_database::create ( $player, $rankvalue, $player->db_role ()->toArray () );
	}
}