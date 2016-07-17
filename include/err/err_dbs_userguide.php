<?php

namespace err;

class err_dbs_userguide_beginguide {
	/**
	 * 引导以及存在
	 *
	 * @var integer
	 */
	const GUIDE_IS_EXISTS = 1;

	/**
	 * 引导的键错误
	 *
	 * @var integer
	 */
	const GUIDE_KEY_ERROR = 2;

	/**
	 * 已经有开启的引导了
	 *
	 * @var integer
	 */
	const GUIDE_OPEN_DUPLICATE = 3;
}
class err_dbs_userguide_endguide {

	/**
	 * 没有开启中的用户引导
	 *
	 * @var integer
	 */
	const NOT_OPENED_GUIDE = 1;
}
class err_dbs_userguide_helpFriendSpeedUp {
	const ALREADY_SPEEDUP = 1;
}
class err_dbs_userguide_helpFriendEatDishes {
	const ALREADY_EAT_DISHES = 1;
}