<?php

namespace err;

class err_dbs_custom_visitor_vistorborn {
}
class err_dbs_custom_visitor_harvestawarditem {
	const NOT_FOUND_NPC = 1;
	const NPC_NOT_HAS_ITEM = 2;
}
class err_dbs_custom_visitor_accpetmission {
	const NOT_FOUND_NPC = 1;
	const NPC_NOT_HAS_MISSION = 2;
	/**
	 * 接收任务错误
	 *
	 * @var unknown
	 */
	const ACCPET_MISSION_ERROR = 3;
}
class err_dbs_custom_visitor_vipVisitorBorn {
	/**
	 * NPC配置错误
	 *
	 * @var unknown
	 */
	const NPC_CONFIG_ERROR = 1;
}
class err_dbs_custom_visitor_VisitorEatDishes {
	/**
	 * GUID 无效
	 *
	 * @var integer
	 */
	const GUID_INVALID = 1;

	/**
	 * 已经吃过了
	 *
	 * @var integer
	 */
	const ALREADY_EAT = 2;
}