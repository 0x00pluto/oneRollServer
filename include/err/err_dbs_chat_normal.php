<?php
namespace err;
class err_dbs_chat_normal_chat {
	/**
	 * 不能和自己聊天
	 *
	 * @var unknown
	 */
	const CANNOT_CHAT_WITH_SELF = 1;
	/**
	 * 没有找到目标用户
	 *
	 * @var unknown
	 */
	const DEST_USER_NOT_FOUND = 2;
}
class err_dbs_chat_normal_chattoneighbourhood {
	/**
	 * 不在群组
	 */
	const NOT_IN_GROUP = 1;
}
class err_dbs_chat_normal_recvneighbourhoodchat
{
	/**
	 * 不在群组
	 */
	const NOT_IN_GROUP = 1;

}