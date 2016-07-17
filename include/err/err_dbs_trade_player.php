<?php
namespace err;
class err_dbs_trade_player_expandtradebox {
	/**
	 * 位置最大了
	 *
	 * @var unknown
	 */
	const EXPAND_SIZE_MAX = 1;
	/**
	 * 钻石数量不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 2;
	/**
	 * 扩展配置错误
	 *
	 * @var unknown
	 */
	const EXPAND_CONFIG_ERROR = 3;
}
class err_dbs_trade_player_publicorder {
	/**
	 * 格子满了
	 *
	 * @var unknown
	 */
	const TRADE_BOXES_FULL = 1;
	/**
	 * 出售的物品不能被交易
	 *
	 * @var unknown
	 */
	const TRADE_ITEM_CANNOT_SELL = 2;
	/**
	 * 出售的物品数量不足
	 *
	 * @var unknown
	 */
	const TRADE_SELL_ITEM_NOT_ENOUGH = 3;
	/**
	 * 求购的物品不能被交易
	 *
	 * @var unknown
	 */
	const TRADE_ITEM_CANNOT_BUY = 4;
	/**
	 * 交换的物品价值不符合
	 *
	 * @var unknown
	 */
	const TRADE_BUY_ITEM_VALUE_NOT_MATCH = 5;

	/**
	 * 出售物品数量错误
	 *
	 * @var unknown
	 */
	const TRADE_ITEM_SELL_ITEM_NUM_ERROR = 6;
	/**
	 * 购买物品数量错误
	 *
	 * @var unknown
	 */
	const TRADE_ITEM_BUY_ITEM_NUM_ERROR = 7;

	/**
	 * 交易id一致
	 *
	 * @var unknown
	 */
	const TRADE_ITEM_ID_SAME = 8;
}
class err_dbs_trade_player_republicorder {
	/**
	 * 订单不存在
	 *
	 * @var unknown
	 */
	const ORDER_NOT_EXISTS = 1;
	/**
	 * 订单没有过期
	 *
	 * @var unknown
	 */
	const ORDER_NOT_EXPIRE = 2;
}
class err_dbs_trade_player_cancelorder {
	/**
	 * 订单不存在
	 *
	 * @var unknown
	 */
	const ORDER_NOT_EXISTS = 1;
	/**
	 * 订单过期了
	 *
	 * @var unknown
	 */
	const ORDER_EXPIRE = 2;

	/**
	 * 钻石不足
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_DIAMOND = 3;
}
class err_dbs_trade_player_takebackorderitem {
	/**
	 * 订单不存在
	 *
	 * @var unknown
	 */
	const ORDER_NOT_EXISTS = 1;
	/**
	 * 订单没有过期了
	 *
	 * @var unknown
	 */
	const ORDER_NOT_EXPIRE = 2;
	/**
	 * 仓库满了
	 *
	 * @var unknown
	 */
	const WAREHOUSE_FULL = 3;
}
class err_dbs_trade_player_completeorder {
	/**
	 * 不能和自己交易
	 *
	 * @var unknown
	 */
	const CANNOT_TRADE_ME = 1;
	/**
	 * 没有找到目标用户
	 *
	 * @var unknown
	 */
	const NOT_DEST_PLAYER = 2;
	/**
	 * 没有找到目标订单
	 *
	 * @var unknown
	 */
	const NOT_DEST_ORDER = 3;
	/**
	 * 达到每日限制次数
	 *
	 * @var unknown
	 */
	const LIMIT_TRADE_NUM_ALL = 4;
	/**
	 * 达到每日单人限制次数
	 *
	 * @var unknown
	 */
	const LIMIT_TRADE_SINGLE_PLAYER = 5;

	/**
	 * 自己道具不足
	 *
	 * @var unknown
	 */
	const ITEM_NOT_ENOUGH = 6;

	/**
	 * 仓库已满
	 *
	 * @var unknown
	 */
	const WAREHOUSE_FULL = 7;
	/**
	 * 订单已经完成
	 *
	 * @var unknown
	 */
	const ORDER_ALREADY_COMPLETE = 8;
}
class err_dbs_trade_player_takebackcompleteorder {
	/**
	 * 订单不存在
	 *
	 * @var unknown
	 */
	const ORDER_NOT_EXISTS = 1;
	/**
	 * 订单没有完成
	 *
	 * @var unknown
	 */
	const ORDER_NOT_COMPLETE = 2;
	/**
	 * 仓库已满
	 *
	 * @var unknown
	 */
	const WAREHOUSE_FULL = 3;
}

