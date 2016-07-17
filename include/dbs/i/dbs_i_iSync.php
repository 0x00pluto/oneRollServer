<?php
namespace dbs\i;
/**
 * 同步接口
 * @author zhipeng
 *
 */
interface dbs_i_iSync {
	/**
	 * 同步访问,主要用于产生反向消息
	 */
	public function sync();
}