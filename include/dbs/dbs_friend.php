<?php

namespace dbs;

use Common\Db\Common_Db_memcacheObject;
use Common\Db\Common_Db_pools;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use configdata\configdata_friend_goodwill_level_setting;
use constants\constants_globalkey;
use constants\constants_memcachekey;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use constants\constants_role;
use dbs\filters\dbs_filters_role;
use dbs\friend\dbs_friend_data;
use dbs\friend\dbs_friend_goodwill;
use dbs\friend\dbs_friend_recommenddata;
use dbs\robot\dbs_robot_data;
use dbs\robot\dbs_robot_player;
use dbs\templates\friend\dbs_templates_friend_friend;
use err\err_dbs_friend_addFriend;
use err\err_dbs_friend_awardGoodwillGift;
use err\err_dbs_friend_getfriend;
use err\err_dbs_friend_getGoodwill;
use err\err_dbs_friend_getrecommendfriends;
use err\err_dbs_friend_removefriend;

/**
 * Class dbs_friend
 * @package dbs
 */
class dbs_friend extends dbs_templates_friend_friend
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * 获取好友好感度等级
     * @param $goodwilllevel
     * @return null
     */
    public static function getgoodwillconfig($goodwilllevel)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_friend_goodwill_level_setting::class, configdata_friend_goodwill_level_setting::k_level, $goodwilllevel);
    }


    /**
     * 是否是好友
     * @param string $destUserId
     * @return bool
     */
    public function is_friend($destUserId)
    {
        // 如果是公用大号,则默认是好友
        $destUserId = strval($destUserId);
        if ($destUserId == Common_Util_Configdata::getInstance()->get_global_config_value('ROBOT_GM_USERID')->string_value()) {
            return true;
        }

        return !is_null($this->get_frienddata($destUserId));
    }

    /**
     * 获取好友数据
     *
     * @param string $destuserid
     * @return dbs_friend_data|null
     */
    public function get_frienddata($destuserid)
    {
        $destuserid = strval($destuserid);
        $friendlist = $this->get_friendlist();
        $frienddata = null;
        if (isset ($friendlist [$destuserid])) {
            $frienddata = new dbs_friend_data ();
            $frienddata->fromArray($friendlist [$destuserid]);
        }
        return $frienddata;
    }

    /**
     * 设置好友数据
     *
     * @param dbs_friend_data $frienddata
     * @return dbs_friend_data
     */
    public function set_frienddata(dbs_friend_data $frienddata)
    {
        $destuserid = $frienddata->get_frienduserid();
        $friendlist = $this->get_friendlist();

        if (array_key_exists_faster($destuserid, $friendlist)) {

            $friendlist [$destuserid] = $frienddata->toArray();
            $this->set_friendlist($friendlist);
        }
    }


    /**
     * 好友是否数量到了上限
     *
     * @return boolean
     */
    private function _friends_is_full()
    {
        $friendlistmax = intval(Common_Util_Configdata::getInstance()->get_global_config('FRIEND_LIST_MAX'));
        if (count($this->get_friendlist()) >= $friendlistmax) {
            return true;
        }
        return false;
    }


    /**
     * 添加好友
     * @param string $destUserId
     * @return array
     */
    private function _addfriend($destUserId)
    {
        // 已经存在好友关系
        if ($this->getfriend($destUserId)->is_succ()) {
            return $this->getfriend($destUserId)->to_Array();
        }
        $friendData = new dbs_friend_data ();
        $friendData->set_frienduserid($destUserId);
        $friendData->set_timespan(time());
        $friendData->set_goodwillGUID(dbs_friend_goodwill::createGoodWillGUID($this->get_userid(), $destUserId));

        $destFriend = dbs_player::newGuestPlayer($destUserId);
        if ($destFriend->isRoleExists()) {
            $friendData->set_lastlogin($destFriend->db_role()->get_lastest_logintime());
        }

        $friendList = $this->get_friendlist();
        $friendList [$friendData->get_frienduserid()] = $friendData->toArray();
        $this->set_friendlist($friendList);

        $this->db_owner->dbs_friend_recommemd()->set_friendcount(count($friendList));


        $goodwillData = dbs_friend_goodwill::getGoodWill($this->get_userid(), $destUserId);
        if (!$goodwillData->exist()) {
            $goodwillData->setFriendUserIds($this->get_userid(), $destUserId);
        }

        return $friendData->toArray();
    }

    /**
     * 删除好友
     *
     * @param string $destUserId
     */
    private function _removefriend($destUserId)
    {
        $friendList = $this->get_friendlist();
        unset ($friendList [$destUserId]);
        $this->set_friendlist($friendList);
        $this->db_owner->dbs_friend_recommemd()->set_friendcount(count($friendList));
    }


    /**
     * 增加好友
     * @param $friendUserId
     * @return Common_Util_ReturnVar
     */
    public function addFriend($friendUserId)
    {
        typeCheckUserId($friendUserId);

        $friendList = $this->get_friendlist();

        logicErrorCondition(!$this->_friends_is_full(),
            err_dbs_friend_addFriend::FRIEND_LIST_MAX,
            "FRIEND_LIST_MAX");

        logicErrorCondition(!isset($friendList[$friendUserId]),
            err_dbs_friend_addFriend::EXIST_FRIEND,
            'EXIST_FRIEND');

        $destPlayer = dbs_player::newGuestPlayer($friendUserId);
        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_friend_addFriend::USER_NOT_EXISTS, "USER_NOT_EXISTS");


        logicErrorCondition($friendUserId !== $this->get_userid(),
            err_dbs_friend_addFriend::CANNOT_ADD_SELF, "CANNOT_ADD_SELF");

        $data = $this->_addfriend($friendUserId);
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 删除好友
     * @param string $friendUserid 删除好友
     * @return Common_Util_ReturnVar
     */
    function removefriend($friendUserid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // $retCodeArr = array();
        // code
        $friendUserid = strval($friendUserid);

        if (!$this->getfriend($friendUserid)->is_succ()) {
            $retCode = err_dbs_friend_removefriend::FRIEND_NOT_EXISTS;
            $retCode_Str = 'FRIEND_NOT_EXISTS';
            goto failed;
        }

        $this->_removefriend($friendUserid);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取信息
     * @return array
     */
    function getinfo()
    {
        $this->db_owner->dbs_friend_recommemd()->set_friendcount(count($this->get_friendlist()));
        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_75, count($this->get_friendlist()));

        $this->get_friendlist();

        $data = [];
        $data[constants_returnkey::RK_FRIENDS] = $this->toArray();
        $goodwills = [];
        foreach ($this->get_friendlist() as $friendData) {
            $goodwill = dbs_friend_goodwill::getGoodWill($this->get_userid(),
                $friendData[dbs_friend_data::DBKey_frienduserid]);
            if (!$goodwill->exist()) {
                $goodwill->setFriendUserIds($this->get_userid(),
                    $friendData[dbs_friend_data::DBKey_frienduserid]);
            }
            $goodwills[$goodwill->get_guid()] = $goodwill->toArray();

        }
        $data[constants_returnkey::RK_FRIEND_GOODWILL] = $goodwills;
        return $data;
    }

    /**
     * 获取好友
     *
     * @param string $userid
     *            好友用户id
     * @return Common_Util_ReturnVar
     */
    function getfriend($userid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // $retCodeArr = array();
        // code
        $userid = strval($userid);
        $friendlist = $this->get_friendlist();
        if (!array_key_exists($userid, $friendlist)) {
            $retCode = err_dbs_friend_getfriend::NOT_FOUND_USER;
            $retCode_Str = 'NOT_FOUND_USER';
            goto failed;
        }

        $data = $friendlist [$userid];

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }


    /**
     * 通用推荐规则
     * @param array $extensionRule 扩展规则,key=>value
     * @param bool|true $fillEmptyUseRobot 是否使用机器人填充剩下不足的推荐用户
     * @return array
     */
    public function normalRecommendRule(array $extensionRule = [], $fillEmptyUseRobot = true)
    {
        $ninArray = array(
            $this->get_userid()
        );
        $friendList = $this->get_friendlist();
        foreach ($friendList as $key => $value) {
            $ninArray [] = $key;
        }

        $limitCount = 100;
        $recommendCount = Common_Util_Configdata::getInstance()->get_global_config_value('FRIEND_RECOMMEND_COUNT')->int_value();
        $rangeLevel = Common_Util_Configdata::getInstance()->get_global_config_value('FRIEND_RECOMMEND_LEVEL_RANGE')->int_value();
        $rangeLevel = 100;
        $db = Common_Db_pools::default_Db_pools()->dbconnect();

        $restaurantLevel = $this->db_owner->db_restaurantinfo()->get_restaurantlevel();
        $levelMin = $restaurantLevel - $rangeLevel;
        $levelMax = $restaurantLevel + $rangeLevel;

        $where = [
            dbs_friend_recommenddata::DBKey_restaurantlevel => array(
                '$gte' => $levelMin,
                '$lte' => $levelMax
            ),

            dbs_friend_recommenddata::DBKey_lastlogintime => [
                '$gte' => time() - 7 * 24 * 60 * 60
            ],
            dbs_friend_recommenddata::DBKey_friendcount => [
                '$ne' => 30
            ],

            dbs_friend_recommenddata::DBKey_isDeleteAccount => false,

            dbs_friend_recommenddata::DBKey_userid => array(
                '$nin' => $ninArray
            )
        ];

        $where = array_merge($where, $extensionRule);


        // 暂时关闭根据真实头像推荐

        $ret = $db->query(dbs_friend_recommenddata::DBKey_tablename, $where, [], $limitCount);

        $finalRet = $ret;
        $males = [];
        $females = [];

        foreach ($finalRet as $recommendData) {
            if (intval($recommendData [dbs_friend_recommenddata::DBKey_sex]) == constants_role::SEX_MALE) {
                $males [$recommendData [dbs_friend_recommenddata::DBKey_userid]] = 1;
            } else {
                $females [$recommendData [dbs_friend_recommenddata::DBKey_userid]] = 1;
            }
        }

        // 男性推荐规则
        if ($this->db_owner->db_role()->get_sex() == constants_role::SEX_MALE) {
            $recommendMaleNum = ceil($recommendCount * 0.2);
        } else {
            // 女性推荐规则
            $recommendMaleNum = ceil($recommendCount * 0.5);
        }
        $recommendFeMaleNum = $recommendCount - $recommendMaleNum;

        // dump ( $where );
        // dump ( $ret );

        // 按照默认规则推荐的好友数量不够,其它补充
        $recommendList = [];
        // 数量任然不够
        if (count($males) + count($females) <= $recommendCount) {
            $recommendList = array_merge($males, $females);
        } else {
            // 推荐男性
            for ($i = 0; $i < $recommendMaleNum && count($males) > 0; $i++) {
                $randomuserid = Common_Util_Random::RandomWithWeight($males);
                $recommendList [$randomuserid] = 1;
                unset ($males [$randomuserid]);
            }

            // 推荐女性
            for ($i = 0; $i < $recommendFeMaleNum && count($females) > 0; $i++) {
                $randomuserid = Common_Util_Random::RandomWithWeight($females);
                $recommendList [$randomuserid] = 1;
                unset ($females [$randomuserid]);
            }
        }

        // 随机补充推荐机器人
        if ($fillEmptyUseRobot && count($recommendList) < $recommendCount) {
            // $leftusers = array_merge ( $males, $females );
            $where = [
                dbs_robot_data::DBKey_robotUserId => [
                    '$nin' => $ninArray
                ],
                dbs_robot_data::DBKey_robotUserId => [
                    '$ne' => Common_Util_Configdata::getInstance()->get_global_config_value('ROBOT_GM_USERID')->string_value()
                ]
            ];
            $recommendRobots = $db->query(dbs_robot_data::DBKey_tablename, $where, [
                dbs_robot_data::DBKey_robotUserId
            ], $limitCount);

            $recommendRobotIds = [];
            foreach ($recommendRobots as $RobotData) {
                $recommendRobotIds [$RobotData [dbs_robot_data::DBKey_robotUserId]] = 1;
            }

            $supplyNum = $recommendCount - count($recommendList);
            for ($i = 0; $i < $supplyNum && count($recommendRobotIds) > 0; $i++) {
                $randomuserid = Common_Util_Random::RandomWithWeight($recommendRobotIds);
                $recommendList [$randomuserid] = 1;
                unset ($recommendRobotIds [$randomuserid]);
            }
        }
        // dump ( [
        // count ( $males ) + count ( $females ),
        // $recommendcount,
        // $recommandMaleNum,
        // $recommandFeMaleNum,
        // $recommendlist
        // ] );

        // 填充数据


        return $recommendList;
    }

    /**
     * 获取推荐好友
     *
     * @param bool $force_refresh
     *            是否强制刷新
     * @return Common_Util_ReturnVar
     */
    function getrecommendfriends($force_refresh = FALSE)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_friend_data_getrecommendfriends{}

        $force_refresh = boolval($force_refresh);

        $memcachekey = constants_memcachekey::DBKey_Friend_Recommend . self::get_userid();

        if ($force_refresh && time() > $this->get_recommendfriendnextrefreshtime()) {
            // 强制刷新,但是已经过了刷新间隔,默认为普通刷新
            $force_refresh = FALSE;
        }

        $memObj = Common_Db_memcacheObject::create($memcachekey);

        if ($force_refresh) {
            // 强制刷新
            $needdiamond = Common_Util_Configdata::getInstance()->get_global_config_value('FRIEND_RECOMMEND_REFRESH_DIAMOND')->int_value();
            if ($this->db_owner->db_role()->get_diamond() < $needdiamond) {
                $retCode = err_dbs_friend_getrecommendfriends::DIAMOND_NOT_ENOUGH;
                $retCode_Str = 'DIAMOND_NOT_ENOUGH';
                goto failed;
            }

            $this->db_owner->db_role()->cost_diamond($needdiamond, constants_moneychangereason::REFRESH_RECOMMEND_FRIEND);
            $memObj->del_value();
        }

        $recommendList = $memObj->get_value();
        if (!is_null($recommendList)) {
            $data = $recommendList;
            // dump ( "memcache" );
            goto succ;
        }

        //使用默认规则推荐
        $recommendList = $this->normalRecommendRule();

        foreach ($recommendList as $userid => $value) {
            $data = array();

            $destplayer = dbs_player::newGuestPlayer($userid);
            $data [dbs_role::DBKey_tablename] = dbs_filters_role::getNormalInfo($destplayer);
            $data [dbs_restaurantinfo::DBKey_tablename] = $destplayer->db_restaurantinfo()->toArray();
            $data [dbs_vip::DBKey_tablename] = $destplayer->dbs_vip()->toArray();

            $recommendList [$userid] = $data;
        }


        $data = $recommendList;
        $cachetime = Common_Util_Configdata::getInstance()->get_global_config_value('FRIEND_RECOMMEND_REFRESH_INTERVAL')->int_value();
        $memObj->setExpiration($cachetime);
        $memObj->set_value($data);

        $this->set_recommendfriendnextrefreshtime(time() + $cachetime);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 更新好友的最后登录时间
     */
    private function updateFriendsLastLoginTime()
    {
        $dayflag = $this->db_owner->dbs_userkvstore()->getvalue(constants_globalkey::PLAYER_UPDATE_FRIEND_DAY_FLAG, 0);
        if ($dayflag !== Common_Util_Time::getGameDay()) {
            $this->db_owner->dbs_userkvstore()->setvalue(constants_globalkey::PLAYER_UPDATE_FRIEND_DAY_FLAG, Common_Util_Time::getGameDay());
        } else {
            return;
        }

        $friends = $this->get_friendlist();

        foreach ($friends as $frienduserid => $frienddata) {
            $friend = dbs_friend_data::create_with_array($frienddata);
            if ($friend instanceof dbs_friend_data) {
                $friendplayer = dbs_player::newGuestPlayer($friend->get_frienduserid());
                if ($friendplayer->isRoleExists()) {
                    $friend->set_lastlogin($friendplayer->db_role()->get_lastest_logintime());
                }
            }
            $friends [$frienduserid] = $friend->toArray();
        }
        $this->set_friendlist($friends);
    }


    /**
     * 增加好友好感度
     * @param $friendUserId
     * @param $goodwillExp
     * @return Common_Util_ReturnVar
     */
    public function addFriendGoodWill($friendUserId, $goodwillExp)
    {
        $goodwillData = dbs_friend_goodwill::getGoodWill($this->get_userid(), $friendUserId);
        if (!$goodwillData->exist()) {
            $goodwillData->setFriendUserIds($this->get_userid(), $friendUserId);
        }
        return $goodwillData->addGoodwillExp($goodwillExp);
    }

    /**
     * 获取目标用户的好感度
     * @param $userId
     * @return Common_Util_ReturnVar
     */
    public function getGoodwill($userId)
    {
        $data = [];
        typeCheckUserId($userId);

        logicErrorCondition($userId !== $this->get_userid(),
            err_dbs_friend_getGoodwill::CANNOT_SELF,
            "CANNOT_SELF");

        $destPlayer = dbs_player::newGuestPlayer($userId);
        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_friend_getGoodwill::DEST_USER_NOT_EXISTS,
            "DEST_USER_NOT_EXISTS");

        $goodwillData = dbs_friend_goodwill::getGoodWill($this->get_userid(),
            $userId);
        if (!$goodwillData->exist()) {
            $goodwillData->setFriendUserIds($this->get_userid(), $userId);
        }
        $data = $goodwillData->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 领取好感度礼包
     * @param string $userId 特定用户的用户ID
     * @return Common_Util_ReturnVar
     */
    public function awardGoodwillGift($userId)
    {
        $data = [];
        typeCheckUserId($userId);

        logicErrorCondition($userId !== $this->get_userid(),
            err_dbs_friend_awardGoodwillGift::CANNOT_SELF,
            "CANNOT_SELF");

        $destPlayer = dbs_player::newGuestPlayer($userId);
        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_friend_awardGoodwillGift::DEST_USER_NOT_EXISTS,
            "DEST_USER_NOT_EXISTS");

        $goodwillData = dbs_friend_goodwill::getGoodWill($this->get_userid(),
            $userId);
        if (!$goodwillData->exist()) {
            $goodwillData->setFriendUserIds($this->get_userid(), $userId);
        }

        $awardLevel = $goodwillData->getAwardGiftLevel($this->get_userid());
        logicErrorCondition($awardLevel < $goodwillData->get_level(),
            err_dbs_friend_awardGoodwillGift::NOT_REACH_AWARD_LEVEL,
            "NOT_REACH_AWARD_LEVEL");

        $awardItemId = null;
        $awardItemCount = 0;
        do {
            $awardLevel++;

            $awardConfig = getConfigData(configdata_friend_goodwill_level_setting::class,
                configdata_friend_goodwill_level_setting::k_level,
                $awardLevel);

            logicErrorCondition(!is_null($awardConfig),
                err_dbs_friend_awardGoodwillGift::AWARD_CONFIG_ERROR,
                "AWARD_CONFIG_ERROR");

            if (isset($awardConfig[configdata_friend_goodwill_level_setting::k_awarditemid])) {
                //奖励存在道具的等级
                $awardItemId = $awardConfig[configdata_friend_goodwill_level_setting::k_awarditemid];
                $awardItemCount = intval($awardConfig[configdata_friend_goodwill_level_setting::k_awarditemcount]);
                break;
            }
        } while ($awardLevel < $goodwillData->get_level());

        //发放道具
        if (!is_null($awardItemId)) {
            logicErrorCondition(dbs_warehouse::additemtowarehouse($this->db_owner, $awardItemId, $awardItemCount),
                err_dbs_friend_awardGoodwillGift::WAREHOUSE_FULL,
                "WAREHOUSE_FULL");
            $data[constants_returnkey::RK_AWARD] = [
                constants_returnkey::RK_ITEMID => $awardItemId,
                constants_returnkey::RK_ITEMCOUNT => $awardItemCount
            ];
        }

        //保存领取等级
        $goodwillData->setAwardGiftLevel($this->get_userid(), $awardLevel);
        $data[constants_returnkey::RK_FRIEND_GOODWILL] = $goodwillData->toArray();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    function masterbeforecall()
    {
        $this->updateFriendsLastLoginTime();
    }
}