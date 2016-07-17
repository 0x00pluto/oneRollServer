<?php

namespace err;

class err_dbs_custom_goodwill_addgoodwillexp extends err_dbs_custom_goodwilldata_addexp {
	const NPCID_ERROR = 10;
	const NPCID_NOT_HAS_GOODWILL = 11;
}
class err_dbs_custom_goodwill_getgoodwill {
	const NPCID_ERROR = 1;
	const NPCID_NOT_HAS_GOODWILL = 11;
}
class err_dbs_custom_goodwill_set_missionfinish {
	const NPCID_ERROR = 10;
	const NPCID_NOT_HAS_GOODWILL = 11;
}
class err_dbs_custom_goodwill_awardGoodwillLevelupPackage {
	const NPCID_ERROR = 10;
	const NPCID_NOT_HAS_GOODWILL = 11;

	/**
	 * 不能奖励升级礼包
	 *
	 * @var integer
	 */
	const CANNOT_AWARD_PACKAGE = 12;
}
