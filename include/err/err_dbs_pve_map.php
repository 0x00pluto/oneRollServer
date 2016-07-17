<?php

namespace err;

class err_dbs_pve_map_battle {
	/**
	 * 关卡没有开启
	 *
	 * @var unknown
	 */
	const STAGE_NOT_OPEN = 1;
	/**
	 * 关卡配置错误
	 *
	 * @var unknown
	 */
	const STAGE_CONF_ERROR = 2;

	/**
	 * 门票不足
	 *
	 * @var unknown
	 */
	const TICKET_NOT_ENOUGH = 3;

	/**
	 * 不能打
	 *
	 * @var unknown
	 */
	const CANNOT_ATTACK = 4;

	/**
	 * 仓库已满
	 *
	 * @var unknown
	 */
	const WAREHOUSE_FULL = 5;
	/**
	 * 掉落物品错误
	 *
	 * @var unknown
	 */
	const DROP_ITEM_CONFIG_ERROR = 6;
}
class err_dbs_pve_map_restorestagebattletimes {
	/**
	 * 关卡没有开启
	 *
	 * @var unknown
	 */
	const STAGE_NOT_OPEN = 1;
	/**
	 * 关卡配置错误
	 *
	 * @var unknown
	 */
	const STAGE_CONF_ERROR = 2;
	/**
	 * 不是boss关卡
	 *
	 * @var unknown
	 */
	const STAGE_NOT_BOSS_STAGE = 3;

	/**
	 * 恢复次数到达上限
	 *
	 * @var unknown
	 */
	const RESTORE_TIMES_MAX = 4;
	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUHG_DIAMOND = 5;

	/**
	 * 剩余的战斗次数不为0
	 *
	 * @var unknown
	 */
	const BATTLE_TIME_NOT_ZERO = 6;
}
class err_dbs_pve_map_buytickets {
	/**
	 * 邀请卷已达到上限
	 *
	 * @var unknown
	 */
	const TICKETS_COUNT_MAX = 1;

	/**
	 * 购买次数上限
	 *
	 * @var unknown
	 */
	const BUY_TIMES_MAX = 2;

	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 3;
}
class err_dbs_pve_map_getmapaward {
	/**
	 * 奖励id错误
	 *
	 * @var unknown
	 */
	const AWARD_ID_ERROR = 1;

	/**
	 * 奖励领取过了
	 *
	 * @var unknown
	 */
	const AWARD_ALEADY_RECEIVED = 2;

	/**
	 * 点数不足
	 *
	 * @var unknown
	 */
	const POINT_NOT_ENOUGH = 3;

	/**
	 * 仓库满了
	 *
	 * @var unknown
	 */
	const WAREHOUSE_FULL = 4;
}
class err_dbs_pve_map_battlebossstage {
	/**
	 * boss关卡配置错误
	 *
	 * @var unknown
	 */
	const BOSS_CONF_ERROR = 1;
}
class err_dbs_pve_map_awardbossstage {
	/**
	 * boss关卡配置错误
	 *
	 * @var unknown
	 */
	const BOSS_CONF_ERROR = 1;
}
class err_dbs_pve_map_battleinvitefriendchef {
}

