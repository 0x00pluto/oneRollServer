<?php

namespace err;

class err_dbs_chef_hirelist_hire {
	/**
	 * 自己今日雇佣次数到达上限
	 *
	 * @var unknown
	 */
	const HIRE_TIMES_MAX = 1;
	/**
	 * 同时拥有厨师到了最大
	 *
	 * @var unknown
	 */
	const HIRE_CHEF_COUNT_MAX = 2;
	/**
	 * 目的玩家没有找到
	 *
	 * @var unknown
	 */
	const DEST_PLAYER_NOT_FOUND = 3;
	/**
	 * 目的厨师没有找到
	 *
	 * @var unknown
	 */
	const DEST_CHEF_NOT_FOUND = 4;

	/**
	 * 厨师雇佣总次数已满
	 *
	 * @var unknown
	 */
	const CHEF_HIRE_TIMES_MAX = 5;
	/**
	 * 钻石数量不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 6;

	/**
	 * 厨师体力不足
	 *
	 * @var unknown
	 */
	const CHEF_NOT_ENOUGH_VITS = 7;
	/**
	 * 厨师已经被我雇佣了
	 *
	 * @var unknown
	 */
	const CHEF_AREADY_EXISTS = 8;

	/**
	 * 不能雇佣自己
	 *
	 * @var unknown
	 */
	const CANNOT_HIRE_SELF = 9;

	/**
	 * 战斗力不足
	 *
	 * @var unknown
	 */
	const BATTLE_POWER_NOT_ENOUGH = 10;
}
class err_dbs_chef_hirelist_fire {
	/**
	 * 厨师不存在
	 *
	 * @var unknown
	 */
	const CHEF_NOT_EXISTS = 1;
}
