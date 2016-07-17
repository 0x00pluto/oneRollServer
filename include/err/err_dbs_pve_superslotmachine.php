<?php

namespace err;

class err_dbs_pve_superslotmachine_rollslotmachine {
	/**
	 * 不能是自己的用户id
	 *
	 * @var unknown
	 */
	const CANNOT_SELF_USERID = 1;
	/**
	 * 目标用户不存在
	 *
	 * @var unknown
	 */
	const DEST_USER_NOT_EXIST = 2;
	/**
	 * 目标老虎机不存在
	 *
	 * @var unknown
	 */
	const DEST_SLOT_MACHINE_NOT_EXIST = 3;
	/**
	 * 老虎机正在摇奖中
	 *
	 * @var unknown
	 */
	const DEST_SLOT_MACHINE_BUSY = 4;
	/**
	 * 老虎机满了
	 *
	 * @var unknown
	 */
	const DEST_SLOT_MACHINE_FULL = 5;
	/**
	 * 到达最大的摇奖次数
	 *
	 * @var unknown
	 */
	const ROLL_TIMES_MAX = 7;
	/**
	 * 摇奖已经完成
	 *
	 * @var unknown
	 */
	const ROLL_FINISHED = 8;

	/**
	 * 摇奖超时
	 *
	 * @var unknown
	 */
	const ROLL_TIMEOUT = 9;

	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 10;

	/**
	 * 奖励概率表配置错误
	 *
	 * @var unknown
	 */
	const AWARD_PERCENT_CONFIG_ERROR = 11;
}
class err_dbs_pve_superslotmachine_giveupslotmachine {
	/**
	 * 目标老虎机不存在
	 *
	 * @var unknown
	 */
	const SLOTMACHINE_NOT_EXIST = 1;
	/**
	 * 摇奖信息不存在
	 *
	 * @var unknown
	 */
	const SLOTMACHINE_ROLLINFO_NOT_EXIST = 2;

	/**
	 * 已经过期了
	 *
	 * @var unknown
	 */
	const SLOTMACHINE_ROLL_AREADY_FINISH = 3;
}
class err_dbs_pve_superslotmachine_recvjackpot {
	/**
	 * 目标老虎机不存在
	 *
	 * @var unknown
	 */
	const SLOTMACHINE_NOT_EXIST = 1;
	/**
	 * 摇奖信息不存在
	 *
	 * @var unknown
	 */
	const SLOTMACHINE_ROLLINFO_NOT_EXIST = 2;

	/**
	 * 没有激活超级大奖
	 *
	 * @var unknown
	 */
	const SLOTMACHINE_NOT_ACTIVE_JACKPOT = 3;
	/**
	 * 已经领取了超级大奖
	 *
	 * @var unknown
	 */
	const ALREADY_RECV_JACKPOT = 4;
}
class err_dbs_pve_superslotmachine_sendinvitetouser {
	/**
	 * 不能是自己的用户id
	 *
	 * @var unknown
	 */
	const CANNOT_SELF_USERID = 1;
	/**
	 * 目标用户不存在
	 *
	 * @var unknown
	 */
	const DEST_USER_NOT_EXIST = 2;
	/**
	 * 目标老虎机不存在
	 *
	 * @var unknown
	 */
	const SLOT_MACHINE_NOT_EXIST = 3;
	/**
	 * 邀请次数已经满了
	 *
	 * @var unknown
	 */
	const INVITE_TIME_FULL = 4;

	/**
	 * 已经可以邀请
	 *
	 * @var unknown
	 */
	const ALREADY_INVERTED = 5;

	/**
	 * 老虎机位置已经满了
	 *
	 * @var unknown
	 */
	const SLOT_MACHINE_IS_FULL = 6;
}
class err_dbs_pve_superslotmachine_sendinvitetogroup {
	/**
	 * 目标老虎机不存在
	 *
	 * @var unknown
	 */
	const SLOT_MACHINE_NOT_EXIST = 1;

	/**
	 * 已经可以邀请
	 *
	 * @var unknown
	 */
	const ALREADY_INVERTED = 2;

	/**
	 * 老虎机位置已经满了
	 *
	 * @var unknown
	 */
	const SLOT_MACHINE_IS_FULL = 3;

	/**
	 * 不在一个群组中
	 *
	 * @var unknown
	 */
	const NOT_IN_GROUP = 4;
}


