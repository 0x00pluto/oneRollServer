<?php

namespace dbs\i;

/**
 * 好友帮忙接口
 *
 * @author zhipeng
 *
 */
interface dbs_i_friendhelp {
	/**
	 * 帮忙
	 *
	 * @param string $helpuserid
	 *        	帮忙的用户id,就是谁来帮忙
	 */
	function friendhelp($helpuserid);

	/**
	 * 是否可以帮忙
	 *
	 * @param string $helpuserid
	 *        	帮忙的用户id,就是谁来帮忙
	 * @return bool
	 */
	function canfriendhelp($helpuserid);

	/**
	 * 接受帮忙
	 */
	function recvfriendhelp();
	/**
	 * 好友帮忙的数量
	 *
	 * @return int
	 */
	function friendhelpnum();
}