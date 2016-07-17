<?php

namespace err;

class err_dbs_pve_rollcard_roll {

	/**
	 * 到达最大的摇奖次数
	 *
	 * @var unknown
	 */
	const ROLL_TIMES_MAX = 1;
	/**
	 * 摇奖钻石不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 2;
	/**
	 * 没有摇奖信息
	 *
	 * @var unknown
	 */
	const NOT_ROLL_INFO = 3;

	/**
	 * 摇奖信息错误
	 *
	 * @var unknown
	 */
	const ROLL_AWARD_ITEMS_INFO_ERROR = 4;
}