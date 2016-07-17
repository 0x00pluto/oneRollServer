<?php

namespace dbs\managers;

use dbs\dbs_base;
use dbs\i\dbs_i_iUpdate;

abstract class dbs_managers_base extends dbs_base implements dbs_i_iUpdate {
	/**
	 * 访问开始调用
	 */
	public function update_beforecall() {
	}
	/**
	 * 访问完成调用
	 */
	public function update_aftercall() {
	}

	/**
	 * 调用方法前调用,dbs_player 控制在调用实际接口前一次
	 */
	public function beforecall() {
	}
	protected function onLoadingFromDB($db) {
	}
}