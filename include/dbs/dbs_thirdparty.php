<?php

namespace dbs;

use dbs\thirdparty\dbs_thirdparty_default;

class dbs_thirdparty {
	static function getInstance($partyId) {
		// 这里有个判断
		//
		return new dbs_thirdparty_default ();
	}
}



