<?php
namespace err;
class err_dbs_mission_missioncomplete {
	/**
	 * 任务没有激活
	 *
	 * @var unknown
	 */
	const MISSION_NOT_ACTIVITY = 1;
	/**
	 * 任务没有完成
	 *
	 * @var unknown
	 */
	const MISSION_NOT_COMPLETE = 2;
}
class err_dbs_mission_missioncompleteusediamond {
	/**
	 * 任务没有激活
	 *
	 * @var unknown
	 */
	const MISSION_NOT_ACTIVITY = 1;
	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 2;
	/**
	 * 不能使用钻石完成
	 *
	 * @var unknown
	 */
	const CANNOT_FINISH_USE_DIAMOND = 3;
}
class err_dbs_mission_missioncompleteconditionusediamond {
	/**
	 * 任务没有激活
	 *
	 * @var unknown
	 */
	const MISSION_NOT_ACTIVITY = 1;
	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 2;
	/**
	 * 不能使用钻石完成
	 *
	 * @var unknown
	 */
	const CANNOT_FINISH_USE_DIAMOND = 3;
	/**
	 * 条件已经完成
	 *
	 * @var unknown
	 */
	const CONDITION_HAS_BEEN_COMPETED = 4;

	/**
	 * 条件不存在
	 *
	 * @var unknown
	 */
	const CONDITION_NOT_EXISTS = 5;
}