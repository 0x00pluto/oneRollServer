<?php
namespace err;
class err_dbs_compose_item_base {
	/**
	 * 合成服务没有开启
	 *
	 * @var unknown
	 */
	const COMPOSE_SERVICE_NOT_OPEN = 1;
}
class err_dbs_compose_item_opendiamondslot extends err_dbs_compose_item_base {
	/**
	 * 插槽数量最大了
	 *
	 * @var unknown
	 */
	const SLOTS_COUNT_MAX = 10;
	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 11;
}
class err_dbs_compose_item_compose extends err_dbs_compose_item_base {
	/**
	 * 插槽不存在
	 *
	 * @var unknown
	 */
	const SLOTS_NOT_EXISTS = 10;

	/**
	 * 合成繁忙
	 *
	 * @var unknown
	 */
	const SLOTS_IS_BUSY = 11;
	/**
	 * 合成材料不足
	 *
	 * @var unknown
	 */
	const COMPOSE_MATERIAL_NOT_ENOUGH = 12;

	/**
	 * 合成配置错误
	 *
	 * @var unknown
	 */
	const COMPOSE_CONFIG_ERR = 13;

	/**
	 * 餐厅等级不够
	 *
	 * @var unknown
	 */
	const RESTARUANT_LEVEL_NOT_ENOUGH = 14;
}
class err_dbs_compose_item_harvestcomposeitem extends err_dbs_compose_item_base {
	/**
	 * 插槽不存在
	 *
	 * @var unknown
	 */
	const SLOTS_NOT_EXISTS = 10;

	/**
	 * 槽位为空
	 *
	 * @var unknown
	 */
	const SLOT_EMPTY = 11;

	/**
	 * 仓库满了
	 *
	 * @var unknown
	 */
	const WAREHOUSE_FULL = 12;

	/**
	 * 冷却中
	 *
	 * @var unknown
	 */
	const COOLDOWN = 13;
}