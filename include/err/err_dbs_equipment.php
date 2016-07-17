<?php
namespace err;
class err_dbs_equipment_upgradelogic {
	/**
	 * 装备已经到最大强化等级
	 *
	 * @var unknown
	 */
	const UPGRADE_LEVEL_MAX = 2;
	/**
	 * 游戏币不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_GAMECOIN = 3;
	/**
	 * 材料不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_MATERIALS = 4;

	/**
	 * 升级配置错误
	 *
	 * @var unknown
	 */
	const UPGRADE_CONFIG_ERROR = 5;

	/**
	 * 不能升级
	 *
	 * @var unknown
	 */
	const CANNOT_UPGRADE = 6;
}
class err_dbs_equipment_upgrade extends err_dbs_equipment_upgradelogic {
	/**
	 * 装备不存在
	 *
	 * @var unknown
	 */
	const EQUIPMENT_NOT_EXISTS = 10;
}
class err_dbs_equipment_upgradegiveequipment extends err_dbs_equipment_upgradelogic {

	/**
	 * 目标用户没有找到
	 *
	 * @var unknown
	 */
	const DEST_USER_NOT_FOUND = 10;
	/**
	 * 目标厨师不存在
	 *
	 * @var unknown
	 */
	const DEST_CHEF_NOT_FOUND = 11;
	/**
	 * 装备没有找到
	 *
	 * @var unknown
	 */
	const EQUIPMENT_NOT_EXISTS = 12;
	/**
	 * 和自己一样的userid
	 *
	 * @var unknown
	 */
	const SAME_USERID = 13;
	/**
	 * 没有找到赠送的装备
	 *
	 * @var unknown
	 */
	const CANNOT_FOUND_GIVE_EQUIPMENT = 14;
}