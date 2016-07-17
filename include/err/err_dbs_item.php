<?php

namespace err;

class err_dbs_item_useitemWithOptions {
	/**
	 * 道具数量错误
	 *
	 * @var unknown
	 */
	const ITEM_NUM_ERROR = 1;
	/**
	 * 道具id错误
	 *
	 * @var unknown
	 */
	const ITEM_ID_ERROR = 2;
	/**
	 * 道具数量不足
	 *
	 * @var unknown
	 */
	const ITEM_NOT_ENOUGH = 3;
	/**
	 * 道具不能被使用
	 *
	 * @var unknown
	 */
	const ITEM_CANNOT_USE = 4;
	/**
	 * 使用逻辑错误
	 *
	 * @var unknown
	 */
	const USE_LOGIC_ERROR = 5;
}
class err_dbs_item_useitem extends err_dbs_item_useitemWithOptions {
}