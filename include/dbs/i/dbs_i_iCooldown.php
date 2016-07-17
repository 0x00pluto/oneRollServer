<?php

namespace dbs\i;

interface dbs_i_iCooldown {
	/**
	 * 获取冷却时间,没有冷却 return 0 秒,
	 *
	 * @return integer
	 */
	function getCooldownTime();
	/**
	 * 清除冷却
	 */
	function clearCooldown();
	/**
	 * 获取清除冷却用的钻石 目前是系数,通用配置在文档
	 *
	 * @return integer
	 */
	function get_clearCooldownDiamond();

	/**
	 * 是否在冷却中
	 *
	 * @return boolean
	 */
	function is_Cooldown();
}