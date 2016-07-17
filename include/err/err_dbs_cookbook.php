<?php
namespace err;
class err_dbs_cookbook_learncookbook {
	const LEVEL_NOT_ENOUGH = 1;
	/**
	 * 需要变异
	 *
	 * @var unknown
	 */
	const NEED_VARIATION = 2;
	/**
	 * 配方数量不足
	 *
	 * @var unknown
	 */
	const FORMULA_NOT_ENOUGH = 3;

	/**
	 * 配置错误
	 *
	 * @var unknown
	 */
	const CONFIG_ERROR = 4;

	/**
	 * 菜谱已经存在
	 *
	 * @var unknown
	 */
	const COOKBOOK_EXIST = 5;
	/**
	 * 前置菜谱没有开启
	 *
	 * @var unknown
	 */
	const PRE_COOKBOOK_NOT_EXIST = 6;

	/**
	 * 不能到等级自动开启
	 *
	 * @var unknown
	 */
	const CANNOT_AUTO_OPEN = 7;
}

/**
 * 升级菜谱
 *
 * @author zhipeng
 *
 */
class err_dbs_cookbook_upgradecookbook {
	const CANNOT_UPGRAGE = 1;
	const CONFIG_ERROR = 2;
	/**
	 * 烹饪次数不够
	 *
	 * @var unknown
	 */
	const COOKTIMES_NOT_ENOUGH = 3;
	/**
	 * 当前菜谱不存在
	 *
	 * @var unknown
	 */
	const COOKBOOS_NOT_EXIST = 4;
	/**
	 * 已经升过级了
	 *
	 * @var unknown
	 */
	const ALREADY_UPGRADED = 5;
}

