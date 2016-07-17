<?php

namespace constants;

class constants_memcachekey {
	/**
	 * 任务第几期
	 *
	 * @var string
	 */
	const DBKey_missionround = "missionround";

	/**
	 * 场景地图的id
	 *
	 * @var string
	 */
	const DBKey_scenemap = "scenemap";

	/**
	 * 场景坐标起始位置
	 *
	 * @var string
	 */
	const DBKey_scenemapstartpos = "scenemapstartpos";

	/**
	 * 全局存储的key
	 *
	 * @var string
	 */
	const DBKey_globalstorekey = "globalstorekey";

	/**
	 * verify的key
	 *
	 * @var unknown
	 */
	const DBKey_Verify_Userid = "thridparty_cache_username_";

	/**
	 * 是否需要同步回调sync
	 */
	const DBKey_Need_Sync = "DBKey_Need_Sync_";

	/**
	 * 是否需要同步回调sync
	 */
	const DBKey_Need_Class_Sync = "DBKey_Need_Class_Sync_";

	/**
	 * 群聊
	 *
	 * @var unknown
	 */
	const DBKey_GROUP_CHAT = 'DBKey_GROUP_CHAT_';

	/**
	 * 排行关键字
	 */
	const DBKey_Rank = 'DBkey_Rank_';

	/**
	 * 是否需要强制更新
	 *
	 * @var unknown
	 */
	const DBKey_Rank_Need_Update = 'DBKey_Rank_Need_Update_';

	/**
	 * 公告板子
	 *
	 * @var unknown
	 */
	const DBkey_NOTICE_PLANE = 'DBkey_NOTICE_PLANE';

	/**
	 * 滚动公告
	 *
	 * @var unknown
	 */
	const DBkey_Notice_Public = 'DBkey_Notice_Public';

	/**
	 * 好友推荐列表
	 */
	const DBKey_Friend_Recommend = 'DBKey_Friend_Recommend_';

	/**
	 * pve 地图邀请好友缓存
	 *
	 * @var unknown
	 */
	const DBKey_Pve_Map_Invite_Friend = 'DBKey_Pve_Map_Invite_Friend_';
}