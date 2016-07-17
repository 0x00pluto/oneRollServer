<?php

namespace dbs\neighbourhood;

use Common\Db\Common_Db_memcached;
use Common\Util\Common_Util_Array;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_neighboorhood_agerange_setting;
use configdata\configdata_neighboorhood_joinrole_setting;
use constants\constants_globalkey;
use constants\constants_memcachekey;
use constants\constants_time;
use dbs\chat\dbs_chat_data;
use dbs\dbs_player;
use dbs\mailbox\dbs_mailbox_data;
use dbs\managers\dbs_managers_globalkvstore;
use dbs\templates\neighbourhood\dbs_templates_neighbourhood_groupdata;
use err\err_dbs_neighbourhood_groupdata_getinvitepos;
use err\err_dbs_neighbourhood_groupdata_join;
use err\err_dbs_neighbourhood_groupdata_joinbyinvite;
use err\err_dbs_neighbourhood_groupdata_knockout;

/**
 * 群组数据
 *
 * @author zhipeng
 *
 */
class dbs_neighbourhood_groupdata extends dbs_templates_neighbourhood_groupdata
{


    /**
     * 设置自动增长的guid
     */
    public function set_autoguid()
    {
        $groupid = dbs_managers_globalkvstore::getvalue(constants_globalkey::KEY_NEIGHBOURHOOD_GROUPID, 10000);
        $this->set_guid($groupid);
        $groupid++;
        dbs_managers_globalkvstore::setvalue(constants_globalkey::KEY_NEIGHBOURHOOD_GROUPID, $groupid);
    }

    /**
     * 获取单个成员
     *
     * @param string $userid
     * @return NULL|dbs_neighbourhood_groupmemberdata
     */
    public function get_singlemember($userid)
    {
        $userid = strval($userid);
        // 设置群组数据
        $members = $this->get_member();
        $memberdatavalue = Common_Util_Array::getvalue($members, $userid);
        if ($memberdatavalue->is_null()) {
            return NULL;
        }
        $memberdata = new dbs_neighbourhood_groupmemberdata ();
        $memberdata->fromArray($memberdatavalue->value());
        return $memberdata;
    }

    /**
     * 设置单个成员信息
     *
     * @param dbs_neighbourhood_groupmemberdata $memberdata
     */
    public function set_singlemember(dbs_neighbourhood_groupmemberdata $memberdata)
    {
        $member = $this->get_member();
        if (array_key_exists_faster($memberdata->get_playerguid(), $member)) {
            $member [$memberdata->get_playerguid()] = $memberdata->toArray();
            $this->set_member($member);
        }
    }


    /**
     * 获取单个红包数据
     *
     * @param unknown $packageid
     * @return NULL|dbs_neighbourhood_groupgiftpackagedata
     */
    public function get_giftpackagedata($packageid)
    {
        $dataarr = Common_Util_Array::getvalue($this->get_giftpackagelist(), $packageid)->value();
        if (is_null($dataarr)) {
            return null;
        }
        $data = new dbs_neighbourhood_groupgiftpackagedata ();
        $data->fromArray($dataarr);
        return $data;
    }

    /**
     * 设置红包数据
     *
     * @param dbs_neighbourhood_groupgiftpackagedata $data
     */
    public function set_giftpackagedata(dbs_neighbourhood_groupgiftpackagedata $data)
    {
        $giftlist = $this->get_giftpackagelist();
        $giftlist [$data->get_guid()] = $data->toArray();
        $this->set_giftpackagelist($giftlist);
    }


    /**
     * 设置邀请数据
     *
     * @param dbs_neighbourhood_groupinvitedata $data
     */
    public function set_invite_data(dbs_neighbourhood_groupinvitedata $data)
    {
        $list = $this->get_invitelist();
        $list [$data->get_userid()] = $data->toArray();
        $this->set_invitelist($list);
    }

    /**
     * 获取邀请数据
     *
     * @param unknown $userid
     * @return \dbs\neighbourhood\dbs_neighbourhood_groupinvitedata|NULL
     */
    public function get_invite_data($userid)
    {
        $userid = strval($userid);
        $list = $this->get_invitelist();
        if (isset ($list [$userid])) {
            $data = new dbs_neighbourhood_groupinvitedata ();
            $data->fromArray($list [$userid]);
            return $data;
        }
        return NULL;
    }

    /**
     * 删除邀请数据
     *
     * @param unknown $userid
     */
    private function remove_invite_data($userid)
    {
        $userid = strval($userid);
        $list = $this->get_invitelist();
        if (isset ($list [$userid])) {
            unset ($list [$userid]);
            $this->set_invitelist($list);
        }
    }

    /**
     * 获取邀请数据
     *
     * @param unknown $invitecode
     * @return \dbs\neighbourhood\dbs_neighbourhood_groupinvitedata|NULL
     */
    public function get_invite_data_byinvitecode($invitecode)
    {
        $invitecode = strval($invitecode);
        $list = $this->get_invitelist();
        foreach ($list as $value) {
            if ($value [dbs_neighbourhood_groupinvitedata::DBKey_inviteguid] == $invitecode) {
                $data = new dbs_neighbourhood_groupinvitedata ();
                $data->fromArray($value);
                return $data;
            }
        }
        return NULL;
    }


    function __construct()
    {
        parent::__construct(self::DBKey_tablename, [], [self::DBKey_guid]);
    }

    /**
     * 群聊的关键字
     *
     * @return string
     */
    private function getChatkey()
    {
        return constants_memcachekey::DBKey_GROUP_CHAT . $this->get_guid();
    }


    /**
     * @param dbs_mailbox_data $chatdata
     */
    private function insert_chat_data(dbs_mailbox_data $chatdata)
    {
        $chatlist = Common_Db_memcached::getInstance()->get($this->getChatkey());
        if (!$chatlist) {
            $chatlist = array();
        }

        $maxcount = Common_Util_Configdata::getInstance()->get_global_config_value('CHAT_GROUP_HISTORY_MAX')->int_value();
        while (count($chatlist) > $maxcount) {
            array_shift($chatlist);
        }

        array_push($chatlist, $chatdata->toArray());
        Common_Db_memcached::getInstance()->set($this->getChatkey(), $chatlist, constants_time::SECONDS_ONE_DAY);
    }

    /**
     * 群聊
     *
     * @param dbs_chat_data $chatdata
     */
    function chat(dbs_mailbox_data $chatdata)
    {
        $this->insert_chat_data($chatdata);
    }

    /**
     * 接收群聊
     */
    function recvchat()
    {
        $chatlist = Common_Db_memcached::getInstance()->get($this->getChatkey());
        if (!$chatlist) {
            $chatlist = array();
        }
        return $chatlist;
    }

    /**
     * 发送红包
     *
     * @param string $itemid
     *            红包的道具id
     * @param string $senduserid
     *            发送红包的玩家id
     */
    public function send_giftpackage($itemid, $senduserid)
    {
        $giftdata = dbs_neighbourhood_groupgiftpackagedata::create_giftpackage($itemid, $senduserid);
        $this->set_giftpackagedata($giftdata);
    }

    /**
     * 是否满员了
     */
    public function isFull()
    {
        $maxmembers = Common_Util_Configdata::getInstance()->get_global_config_value('NEIGHBOURHOOD_MAX_PERSONS')->int_value();

        // dump ( $maxmembers );
        if ($maxmembers <= count($this->get_member()) + count($this->get_invitelist())) {
            return true;
        }
        return false;
    }

    /**
     * 加入群组
     * @param dbs_player $player
     * @return Common_Util_ReturnVar
     */
    public function join(dbs_player $player)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $members = $this->get_member();
        if (count($members) >= $this->get_joinmember_limit()) {
            $retCode = err_dbs_neighbourhood_groupdata_join::JOIN_MEMBER_IS_FULL;
            $retCode_Str = 'JOIN_MEMBER_IS_FULL';
            goto failed;
        }

        if ($this->isFull()) {
            $retCode = err_dbs_neighbourhood_groupdata_join::GROUP_IS_FULL;
            $retCode_Str = 'GROUP_IS_FULL';
            goto failed;
        }
        if ($player->dbs_neighbourhood_playerdata()->hasgroup()) {
            $retCode = err_dbs_neighbourhood_groupdata_join::PLAYER_HAS_GROUP_AREADY;
            $retCode_Str = 'PLAYER_HAS_GROUP_AREADY';
            goto failed;
        }
        // 第一个加入的用户
        if (count($members) == 0) {
            $fristageid = self::get_ageid_by_age($player->db_role()->get_age());
            $this->set_ageid($fristageid);
        }

        $_emptyconfig = $this->_get_empty_pos_config();

        $sex = strval($player->db_role()->get_sex());
        // 筛选性别
        // dump ( $_emptyconfig );
        foreach ($_emptyconfig as $pos => $value) {
            if ($value [configdata_neighboorhood_joinrole_setting::k_sexlimit] != $sex && $value [configdata_neighboorhood_joinrole_setting::k_sexlimit] != '2') {
                unset ($_emptyconfig [$pos]);
            }
        }
        if (count($_emptyconfig) == 0) {
            $retCode = err_dbs_neighbourhood_groupdata_join::SEX_NOT_MATCH;
            $retCode_Str = 'SEX_NOT_MATCH';
            goto failed;
        }

        // dump ( $_emptyconfig );
        // 筛选年龄

        $joinageid = $this->get_ageid_by_age($player->db_role()->get_age());
        // 年龄操作符
        $ageoperate = 0;
        $ageoperate = intval($joinageid) - intval($this->get_ageid());

        foreach ($_emptyconfig as $pos => $value) {
            if ($ageoperate <= 0) {
                // 同龄人
                if ($value [configdata_neighboorhood_joinrole_setting::k_sameageid] != strval($ageoperate)) {
                    unset ($_emptyconfig [$pos]);
                }
            } else {
                if ($value [configdata_neighboorhood_joinrole_setting::k_sameageid] == '0') {
                    // 删除同龄人

                    unset ($_emptyconfig [$pos]);
                } elseif (intval($value [configdata_neighboorhood_joinrole_setting::k_sameageid]) > intval($ageoperate)) {
                    dump($pos);
                    unset ($_emptyconfig [$pos]);
                }
            }
        }

        if (count($_emptyconfig) == 0) {
            $retCode = err_dbs_neighbourhood_groupdata_join::AGE_NOT_MATCH;
            $retCode_Str = 'AGE_NOT_MATCH';
            goto failed;
        }

        // dump ( $_emptyconfig );
        // 处理vip
        $vip = $player->dbs_vip()->get_viplevel();
        // dump ( $vip );
        foreach ($_emptyconfig as $pos => $value) {
            if (intval($value [configdata_neighboorhood_joinrole_setting::k_viplevellimitmin]) > $vip) {
                unset ($_emptyconfig [$pos]);
            }
        }
        // dump ( $_emptyconfig );
        if (count($_emptyconfig) == 0) {
            $retCode = err_dbs_neighbourhood_groupdata_join::VIP_NOT_MATCH;
            $retCode_Str = 'VIP_NOT_MATCH';
            goto failed;
        }

        // 处理邀请位置
        $noinviteconifg = [];
        foreach ($_emptyconfig as $pos => $value) {
            if (intval($value [configdata_neighboorhood_joinrole_setting::k_invite]) == '0') {
                $noinviteconifg [$pos] = $value;
            }
        }
        // dump ( $noinviteconifg );
        if (count($noinviteconifg) != 0) {
            $posid = array_shift($noinviteconifg) [configdata_neighboorhood_joinrole_setting::k_posid];
        } else {
            $posid = array_shift($_emptyconfig) [configdata_neighboorhood_joinrole_setting::k_posid];
        }

        // 设置群组数据
        $member = $this->get_member();
        $memberdata = new dbs_neighbourhood_groupmemberdata ();
        $memberdata->set_playerguid($player->get_userid());
        $memberdata->set_groupid($this->get_guid());
        $memberdata->set_posid($posid);
        $memberdata->set_joindate(time());
        $member [$memberdata->get_playerguid()] = $memberdata->toArray();
        $this->set_member($member);

        // 用户反向数据
        $player->dbs_neighbourhood_playerdata()->joingroup($this->get_guid());

        // code;

        // $this->dumpDB ();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 踢出用户
     *
     * @param dbs_player $player
     * @return Common_Util_ReturnVar
     */
    function knockout(dbs_player $player)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_groupdata_knockout{}

        if ($player->dbs_neighbourhood_playerdata()->get_groupid() != $this->get_guid()) {
            $retCode = err_dbs_neighbourhood_groupdata_knockout::NOT_SAME_GROUPID;
            $retCode_Str = 'NOT_SAME_GROUPID';
            goto failed;
        }

        $member = $this->get_member();
        if (!array_key_exists_faster($player->get_userid(), $member)) {
            $retCode = err_dbs_neighbourhood_groupdata_knockout::MEMBER_NOT_EXISTS;
            $retCode_Str = 'MEMBER_NOT_EXISTS';
            goto failed;
        }

        unset ($member [$player->get_userid()]);

        $this->set_member($member);
        $player->dbs_neighbourhood_playerdata()->exitgroup();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取位置邀请码
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getinvitepos($userid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_groupdata_getinvitepos{}

        $userid = strval($userid);
        $config = $this->_get_empty_invite_pos_config();

        $member = $this->get_singlemember($userid);
        if (is_null($member)) {
            $retCode = err_dbs_neighbourhood_groupdata_getinvitepos::NOT_GROUP_MEMBER;
            $retCode_Str = 'NOT_GROUP_MEMBER';
            goto failed;
        }

        if ($this->isFull()) {
            $retCode = err_dbs_neighbourhood_groupdata_getinvitepos::GROUP_IS_FULL;
            $retCode_Str = 'GROUP_IS_FULL';
            goto failed;
        }

        $invitedata = $this->get_invite_data($userid);
        if (!is_null($invitedata)) {
            $retCode = err_dbs_neighbourhood_groupdata_getinvitepos::ALREADY_INVITE;
            $retCode_Str = 'ALREADY_INVITE';
            goto failed;
        }

        if (count($config) == 0) {
            $retCode = err_dbs_neighbourhood_groupdata_getinvitepos::GROUP_INVITE_FULL;
            $retCode_Str = 'GROUP_INVITE_FULL';
            goto failed;
        }

        $posid = '';
        foreach ($config as $key => $value) {
            $posid = $key;
            break;
        }
        $invitedata = dbs_neighbourhood_groupinvitedata::create($userid, $posid, $this->get_guid());
        // dump ( $config );
        // dump ( $data->toArray () );
        $this->set_invite_data($invitedata);
        $data = $invitedata->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 通过邀请加入组
     * @param dbs_player $player
     * @param $inviteCode
     * @return Common_Util_ReturnVar
     */
    function joinbyinvite(dbs_player $player, $inviteCode)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_groupdata_joinbyinvite{}

        $invitedata = $this->get_invite_data_byinvitecode($inviteCode);
        if (is_null($invitedata)) {
            $retCode = err_dbs_neighbourhood_groupdata_joinbyinvite::INVITECODE_NOT_EXIST;
            $retCode_Str = 'INVITECODE_NOT_EXIST';
            goto failed;
        }
        $this->remove_invite_data($invitedata->get_userid());
        $posid = $invitedata->get_lockposid();

        // 设置群组数据
        $member = $this->get_member();
        $memberdata = new dbs_neighbourhood_groupmemberdata ();
        $memberdata->set_playerguid($player->get_userid());
        $memberdata->set_groupid($this->get_guid());
        $memberdata->set_posid($posid);
        $memberdata->set_joindate(time());
        $member [$memberdata->get_playerguid()] = $memberdata->toArray();
        $this->set_member($member);

        // 用户反向数据
        $player->dbs_neighbourhood_playerdata()->joingroup($this->get_guid());

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 数据加载完成
     */
    protected function _db_loaded()
    {
        $giftlist = $this->get_giftpackagelist();
        $datachange = false;
        foreach ($giftlist as $key => $value) {

            $giftdata = new dbs_neighbourhood_groupgiftpackagedata ();
            $giftdata->fromArray($value);
            if ($giftdata->is_expired()) {
                unset ($giftlist [$key]);
                $datachange = true;
            }
        }

        if ($datachange) {
            $this->set_giftpackagelist($giftlist);
        }

        $datachange = false;
        $invitelist = $this->get_invitelist();
        foreach ($invitelist as $key => $value) {
            if ($value [dbs_neighbourhood_groupinvitedata::DBKey_timeout] < time()) {
                unset ($invitelist [$key]);
                $datachange = true;
            }
        }
        if ($datachange) {
            $this->set_invitelist($invitelist);
        }
    }

    protected function onLoadingFromDB($db)
    {
        $ret = $db->query($this->get_tablename(), $this->primary_key_query_where());
        if (count($ret) > 0) {
            $this->fromDBData($ret [0]);
            $this->_db_loaded();
        }
    }

    /**
     * 获取创建日期
     *
     * @return number
     */
    public function get_createdays()
    {
        $createtime = time() - $this->get_createtime();
        return ceil($createtime / constants_time::SECONDS_ONE_DAY);
    }

    /**
     * 获取加入玩家上限
     *
     * @return number|mixed
     */
    public function get_joinmember_limit()
    {
        $joinnumlimit = [
            21,
            1,
            1,
            1,
            1,
            1,
            1
        ];

        $maxjoinnum = Common_Util_Configdata::getInstance()->get_global_config_value('NEIGHBOURHOOD_MAX_PERSONS')->int_value();
        $days = $this->get_createdays();
        if ($days >= count($joinnumlimit)) {
            return $maxjoinnum;
        } else {
            $joinnum = array_sum(array_slice($joinnumlimit, 0, $days));
            return min([
                $maxjoinnum,
                $joinnum
            ]);
        }
    }

    /**
     * 获取空的邀请位置配置
     */
    private function _get_empty_invite_pos_config()
    {
        $configs = $this->_get_empty_pos_config();
        foreach ($configs as $key => $value) {
            if ($value [configdata_neighboorhood_joinrole_setting::k_invite] != '1') {
                unset ($configs [$key]);
            }
        }

        return $configs;
    }

    /**
     * 获取空位配置
     */
    private function _get_empty_pos_config()
    {
        $configs = [];
        $ageid = $this->get_ageid();
        foreach (configdata_neighboorhood_joinrole_setting::data() as $value) {
            if ($ageid == $value [configdata_neighboorhood_joinrole_setting::k_ageid]) {
                $configs [$value [configdata_neighboorhood_joinrole_setting::k_posid]] = $value;
            }
        }

        $members = $this->get_member();
        $member = new dbs_neighbourhood_groupmemberdata ();
        foreach ($members as $userid => $value) {
            $member->fromArray($value);
            unset ($configs [$member->get_posid()]);
        }

        $invitelist = $this->get_invitelist();
        foreach ($invitelist as $invitedata) {
            unset ($configs [$invitedata [dbs_neighbourhood_groupinvitedata::DBKey_lockposid]]);
        }

        return $configs;
    }


    /**
     * 通过年龄计算ageId
     * @param int $age 实际年龄
     * @return null
     */
    static function get_ageid_by_age($age)
    {
        $age = intval($age);

        $ageid = null;
        foreach (configdata_neighboorhood_agerange_setting::data() as $value) {
            if ($age >= intval($value [configdata_neighboorhood_agerange_setting::k_agemin]) && $age < intval($value [configdata_neighboorhood_agerange_setting::k_agemax])) {
                $ageid = $value [configdata_neighboorhood_agerange_setting::k_ageid];
                break;
            }
        }
        return $ageid;
    }
}