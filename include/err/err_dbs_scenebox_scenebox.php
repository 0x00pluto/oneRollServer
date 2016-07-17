<?php

namespace err;

class err_dbs_scenebox_scenebox_openboxlogic {

	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const DIAMOND_NOT_ENOUGH = 1;
	/**
	 * 需要好友好感度
	 *
	 * @var unknown
	 */
	const FRIEND_GOODWILL_NOT_ENOUGH = 2;
}
class err_dbs_scenebox_scenebox_opennormalbox extends err_dbs_scenebox_scenebox_openboxlogic {
	/**
	 * 宝箱id不存在
	 *
	 * @var unknown
	 */
	const BOXID_NOT_EXISTS = 10;
	/**
	 * 存在主人宝箱
	 *
	 * @var unknown
	 */
	const HAS_MASTER_BOX = 11;
}
class err_dbs_scenebox_scenebox_opennormalboxfriend extends err_dbs_scenebox_scenebox_openboxlogic {
	/**
	 * 宝箱id不存在
	 *
	 * @var unknown
	 */
	const BOXID_NOT_EXISTS = 10;

	/**
	 * 好友不存在
	 *
	 * @var unknown
	 */
	const FRIEND_NOT_EXISTS = 11;

	/**
	 * 存在主人宝箱
	 *
	 * @var unknown
	 */
	const HAS_MASTER_BOX = 12;
}
class err_dbs_scenebox_scenebox_dropnormalbox {
	/**
	 * 宝箱不存在
	 *
	 * @var unknown
	 */
	const BOX_NOT_EXISTS = 10;
}
class err_dbs_scenebox_scenebox_openmasterbox extends err_dbs_scenebox_scenebox_openboxlogic {
	/**
	 * 宝箱id不存在
	 *
	 * @var unknown
	 */
	const BOXID_NOT_EXISTS = 10;
}
class err_dbs_scenebox_scenebox_noticeopenmasterbox {
	/**
	 * 目标用户不存在
	 *
	 * @var unknown
	 */
	const DEST_USER_NOT_EXISTS = 1;
	/**
	 * 目标用户没有主人宝箱
	 *
	 * @var unknown
	 */
	const DEST_USER_NOT_HAS_MASTERBOX = 2;
	/**
	 * 已经通知过了
	 *
	 * @var unknown
	 */
	const DEST_USER_MASTER_ALREADY_NOTICE = 3;

	/**
	 * 不能通知自己
	 *
	 * @var unknown
	 */
	const CANNOT_NOTICE_SELF = 4;
}
