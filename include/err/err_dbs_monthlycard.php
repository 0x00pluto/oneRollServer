<?php
namespace err;
class err_dbs_monthlycard_active {
	/**
	 * 已经激活了月卡
	 *
	 * @var unknown
	 */
	const ALREADY_ACTIVE = 1;
	/**
	 * 没有购买次数了
	 *
	 * @var unknown
	 */
	const NOT_LEFT_TIMES = 2;
}
class err_dbs_monthlycard_award {
	/**
	 * 没有激活月卡
	 *
	 * @var unknown
	 */
	const NOT_ACTIVE = 1;

	/**
	 * 已经领取了奖励
	 *
	 * @var unknown
	 */
	const ALREADY_AWARD = 2;
}