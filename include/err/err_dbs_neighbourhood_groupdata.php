<?php

namespace err;

class err_dbs_neighbourhood_groupdata_join {
	/**
	 * 组满了
	 *
	 * @var unknown
	 */
	const GROUP_IS_FULL = 1;
	/**
	 * 用户已经有组了
	 *
	 * @var unknown
	 */
	const PLAYER_HAS_GROUP_AREADY = 2;
	/**
	 * 加入用户已满,有可能是今日加入名额已经满了
	 *
	 * @var unknown
	 */
	const JOIN_MEMBER_IS_FULL = 3;

	/**
	 * 性别不匹配
	 *
	 * @var unknown
	 */
	const SEX_NOT_MATCH = 4;

	/**
	 * 年龄不匹配
	 *
	 * @var unknown
	 */
	const AGE_NOT_MATCH = 5;

	/**
	 * VIP不匹配
	 *
	 * @var unknown
	 */
	const VIP_NOT_MATCH = 6;
}
class err_dbs_neighbourhood_groupdata_knockout {
	/**
	 * 组id不存在
	 *
	 * @var unknown
	 */
	const NOT_SAME_GROUPID = 1;
	/**
	 * 成员不存在
	 *
	 * @var unknown
	 */
	const MEMBER_NOT_EXISTS = 2;
}
class err_dbs_neighbourhood_groupdata_getinvitepos {
	/**
	 * 群组人数满了
	 *
	 * @var unknown
	 */
	const GROUP_IS_FULL = 1;

	/**
	 * 群组邀请位置满了
	 *
	 * @var unknown
	 */
	const GROUP_INVITE_FULL = 2;

	/**
	 * 已经在申请中了
	 *
	 * @var unknown
	 */
	const ALREADY_INVITE = 3;
	/**
	 * 不是群组成员
	 *
	 * @var unknown
	 */
	const NOT_GROUP_MEMBER = 4;
}
class err_dbs_neighbourhood_groupdata_joinbyinvite{
	/**
	 * 邀请码不存在
	 * @var unknown
	 */
	const INVITECODE_NOT_EXIST = 1;
}




