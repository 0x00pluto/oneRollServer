<?php

namespace err;

class err_dbs_custom_eat {
	/**
	 * 没有到消耗时间
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_TIME = 1;
	/**
	 * 没有餐台有吃的
	 */
	const NOT_DINNERTABLE_HAS_FOOD = 2;
}
class err_dbs_custom_eatByRecipt {
	/**
	 * 票据错误
	 *
	 * @var unknown
	 */
	const RECPIT_ERROR = 1;
	/**
	 * 没有餐台有吃的
	 */
	const NOT_DINNERTABLE_HAS_FOOD = 2;
}
class err_dbs_custom_eatByReceiptAndCustom {
	/**
	 * 票据错误
	 *
	 * @var unknown
	 */
	const RECPIT_ERROR = 1;
	/**
	 * 指定餐台id无效
	 */
	const DINNERTABLE_ID_INVALID = 2;

	/**
	 * 顾客id无效
	 *
	 * @var integer
	 */
	const CUSTOM_GUID_INVALID = 3;
	/**
	 * 吃菜失败 原因未知
	 *
	 * @var unknown
	 */
	const EAT_FAILED = 4;
}
class err_dbs_custom_eatByOffline {
	/**
	 * 没有到消耗时间
	 *
	 * @var unknown
	 */
	const NOT_ENOUGH_TIME = 1;
	/**
	 * 没有餐台有吃的
	 */
	const NOT_DINNERTABLE_HAS_FOOD = 2;
	/**
	 * 离线吃菜系统没有开启
	 *
	 * @var unknown
	 */
	const EAT_OFFLINE_SYSTEM_NOT_OPEN = 3;
}