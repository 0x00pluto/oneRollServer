<?php

namespace err;

class err_dbs_neighbourhood_playerdata_getmemberinfo {
	const NOT_IN_GROUP = 1;
}
class err_dbs_neighbourhood_playerdata_sendgiftpackage {
	/**
	 * 不在一个群组
	 *
	 * @var unknown
	 */
	const NOT_IN_GROUP = 1;
	/**
	 * 没有道具
	 *
	 * @var unknown
	 */
	const NOT_HAS_ITEM = 2;
	/**
	 * 次数上限
	 *
	 * @var unknown
	 */
	const TIMES_LIMIT = 3;

	/**
	 * 道具类型错误
	 *
	 * @var unknown
	 */
	const ITEM_TYPE_ERROR = 4;
	/**
	 * 配置错误
	 *
	 * @var unknown
	 */
	const ITEM_CONFIG_ERROR = 5;
}
class err_dbs_neighbourhood_playerdata_recvgiftpackage {
	/**
	 * 不在一个群组
	 *
	 * @var unknown
	 */
	const NOT_IN_GROUP = 1;
	/**
	 * 红包不存在
	 *
	 * @var unknown
	 */
	const GIFTPACKAGE_NOT_EXISTS = 2;
	/**
	 * 不能领取自己的红包
	 *
	 * @var unknown
	 */
	const CANNOT_RECV_SELF_GIFT_PACKAGE = 3;

	/**
	 * 不能再次领取
	 *
	 * @var unknown
	 */
	const CANNOT_RECV_GIFT_AGAIN = 4;

	/**
	 * 领取达到了上限
	 *
	 * @var unknown
	 */
	const RECV_TIMES_MAX = 5;
}
class err_dbs_neighbourhood_playerdata_thanksgiftpackagesender {
	/**
	 * 不在一个群组
	 *
	 * @var unknown
	 */
	const NOT_IN_GROUP = 1;
	/**
	 * 红包不存在
	 *
	 * @var unknown
	 */
	const GIFTPACKAGE_NOT_EXISTS = 2;
	/**
	 * 不能再次感谢
	 *
	 * @var unknown
	 */
	const CANNOT_THANKS_AGAIN = 3;
	/**
	 * 必须首先领取
	 *
	 * @var unknown
	 */
	const MUST_RECV_GIFT_PACKAGE_FRIST = 4;
	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const DIAMOND_NOT_ENOUGH = 5;
}
class err_dbs_neighbourhood_playerdata_buygiftpackage {
	/**
	 * 不在一个群组
	 *
	 * @var unknown
	 */
	const NOT_IN_GROUP = 1;

	/**
	 * 道具类型错误
	 *
	 * @var unknown
	 */
	const ITEM_TYPE_ERROR = 2;
	/**
	 * 游戏币不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_GAMECOIN = 3;
	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 4;
	const WAREHOUSE_FULL = 5;
}
class err_dbs_neighbourhood_playerdata_getinvitepos extends err_dbs_neighbourhood_groupdata_getinvitepos {
	/**
	 * 不在一个群组
	 *
	 * @var unknown
	 */
	const NOT_IN_GROUP = 100;
}
class err_dbs_neighbourhood_playerdata_accpetinvitepos extends err_dbs_neighbourhood_groupdata_joinbyinvite {
	/**
	 * 已经在一个群组中了
	 *
	 * @var unknown
	 */
	const IN_GROUP = 10;
	/**
	 * 邀请的组不存在
	 *
	 * @var unknown
	 */
	const INVITE_GROUP_NOT_EXIST = 11;
}

