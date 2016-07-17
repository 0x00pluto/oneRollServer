<?php

namespace dbs\neighbourhood;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use configdata\configdata_item_neighboorhood_gift_package_setting;
use constants\constants_defaultvalue;
use constants\constants_globalkey;
use constants\constants_mission;
use constants\constants_moneychangereason;
use dbs\bulletinboard\dbs_bulletinboard_bulletinboarddata;
use dbs\dbs_item;
use dbs\dbs_player;
use dbs\dbs_warehouse;
use dbs\rank\system\dbs_rank_system_neighboorhoodreputation;
use dbs\templates\neighbourhood\dbs_templates_neighbourhood_playerdata;
use err\err_dbs_neighbourhood_playerdata_accpetinvitepos;
use err\err_dbs_neighbourhood_playerdata_buygiftpackage;
use err\err_dbs_neighbourhood_playerdata_getinvitepos;
use err\err_dbs_neighbourhood_playerdata_getmemberinfo;
use err\err_dbs_neighbourhood_playerdata_recvgiftpackage;
use err\err_dbs_neighbourhood_playerdata_sendgiftpackage;
use err\err_dbs_neighbourhood_playerdata_thanksgiftpackagesender;

/**
 * 邻居用户数据,在用户身上
 *
 * @author zhipeng
 *
 */
class dbs_neighbourhood_playerdata extends dbs_templates_neighbourhood_playerdata
{

    /**
     * 加入组
     *
     * @param unknown $groupid
     */
    public function joingroup($groupid)
    {
        $this->set_groupid($groupid);
    }

    /**
     * 退出群组,
     * 应该去主动调用 groupmanager的退出群组的方法!!
     * 本方法不能主动调用!!
     */
    public function exitgroup()
    {
        $this->set_groupid(constants_defaultvalue::USERID_EMPTY);
    }

    /**
     * 是否有组了
     *
     * @return boolean
     */
    public function hasgroup()
    {
        return !empty ($this->get_groupid());
    }


    /**
     * 获取发送红包数据
     *
     * @return dbs_neighbourhood_playerdatagiftpackage
     */
    public function get_sendgiftdata()
    {
        $data = new dbs_neighbourhood_playerdatagiftpackage ();
        $data->fromArray($this->get_sendgift());
        return $data;
    }

    /**
     * 设置发红包数据
     *
     * @param dbs_neighbourhood_playerdatagiftpackage $data
     */
    public function set_sendgiftdata(dbs_neighbourhood_playerdatagiftpackage $data)
    {
        $this->set_sendgift($data->toArray());
    }


    /**
     * @return \dbs\neighbourhood\dbs_neighbourhood_groupmemberreputationdata
     */
    public function get_reputation()
    {
        $data = new dbs_neighbourhood_groupmemberreputationdata ();
        $data->fromArray($this->toArray());
        return $data;
    }

    /**
     * @param dbs_neighbourhood_groupmemberreputationdata $value
     */
    public function set_reputation(dbs_neighbourhood_groupmemberreputationdata $value)
    {
        // $this->fromArray ( $value->toArray () );
        $this->setdatas($value);
// 		$this->mark_dirty ();

        dbs_rank_system_neighboorhoodreputation::getInstance()->rank_valuechange($this->db_owner, $value->get_reputationlevel());
    }

    function __construct()
    {
        $this->set_defaultvalues((new dbs_neighbourhood_groupmemberreputationdata ())->toArray());
        parent::__construct(self::DBKey_tablename, array(
            self::DBKey_userid => constants_defaultvalue::USERID_EMPTY,
            self::DBKey_groupid => '',
            self::DBKey_sendgift => (new dbs_neighbourhood_playerdatagiftpackage ())->toArray()
        ));
    }

    /**
     * 获取群组信息
     *
     * @return dbs_neighbourhood_groupdata|NULL
     */
    function get_groupdata()
    {
        if (!$this->hasgroup()) {
            return null;
        }
        $groupid = $this->get_groupid();
        $groupdata = dbs_neighbourhood_groupmanager::getInstance()->get_groupbyid($groupid);
        return $groupdata;
    }

    /**
     * 获取自己的群组信息
     *
     * @return Common_Util_ReturnVar
     */
    function getmemberinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_playerdata_getmemberinfo{}

        if (!$this->hasgroup()) {
            $retCode = err_dbs_neighbourhood_playerdata_getmemberinfo::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }
        // code

        $groupdata = $this->get_groupdata();

        $memberdata = $groupdata->get_singlemember($this->get_userid());
        $data ['memberinfo'] = $memberdata->toArray();
        $data ['playerinfo'] = $this->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 购买红包
     *
     * @param string $itemid
     *            红包id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function buygiftpackage($itemid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_playerdata_buygiftpackage{}

        $itemid = strval($itemid);
        // class err_dbs_neighbourhood_playerdata_sendgiftpackage{}
        if (!$this->hasgroup()) {
            $retCode = err_dbs_neighbourhood_playerdata_buygiftpackage::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }

        $itemgiftconifg = dbs_neighbourhood_playerdatagiftpackage::get_giftconfig($itemid);
        if (is_null($itemgiftconifg)) {
            $retCode = err_dbs_neighbourhood_playerdata_buygiftpackage::ITEM_TYPE_ERROR;
            $retCode_Str = 'ITEM_TYPE_ERROR';
            goto failed;
        }

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);
        if (!$warehouse->testItemCanPut($itemid, 1)) {
            $retCode = err_dbs_neighbourhood_playerdata_buygiftpackage::WAREHOUSE_FULL;
            $retCode_Str = 'WAREHOUSE_FULL';
            goto failed;
        }

        $gamecoin = $itemgiftconifg [configdata_item_neighboorhood_gift_package_setting::k_sellgamecoin];
        $diamond = $itemgiftconifg [configdata_item_neighboorhood_gift_package_setting::k_selldiamond];

        if ($gamecoin > $this->db_owner->db_role()->get_gamecoin()) {
            $retCode = err_dbs_neighbourhood_playerdata_buygiftpackage::NOT_ENOUGH_GAMECOIN;
            $retCode_Str = 'NOT_ENOUGH_GAMECOIN';
            goto failed;
        }

        if ($diamond > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_neighbourhood_playerdata_buygiftpackage::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        $this->db_owner->db_role()->cost_gamecoin($gamecoin, constants_moneychangereason::BUY_NEIGHBOORHOOD_GIFT_PACKAGE);
        $this->db_owner->db_role()->cost_diamond($diamond, constants_moneychangereason::BUY_NEIGHBOORHOOD_GIFT_PACKAGE);

        // 发放物品
        $warehouse->addItemByItemId($itemid, 1, true);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 发送红包
     *
     * @param unknown $itemid
     */
    function sendgiftpackage($itemid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $itemid = strval($itemid);
        // class err_dbs_neighbourhood_playerdata_sendgiftpackage{}
        if (!$this->hasgroup()) {
            $retCode = err_dbs_neighbourhood_playerdata_sendgiftpackage::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);
        if (is_null($warehouse)) {
            $retCode = err_dbs_neighbourhood_playerdata_sendgiftpackage::NOT_HAS_ITEM;
            $retCode_Str = 'NOT_HAS_ITEM';
            goto failed;
        }

        if (!$warehouse->hasItem($itemid)) {
            $retCode = err_dbs_neighbourhood_playerdata_sendgiftpackage::NOT_HAS_ITEM;
            $retCode_Str = 'NOT_HAS_ITEM';
            goto failed;
        }

        $itemconfig = dbs_item::getInstance()->getItemConfig($itemid);
        if (is_null($itemconfig)) {
            $retCode = err_dbs_neighbourhood_playerdata_sendgiftpackage::ITEM_TYPE_ERROR;
            $retCode_Str = 'ITEM_TYPE_ERROR';
            goto failed;
        }

        $itemgiftconifg = dbs_neighbourhood_playerdatagiftpackage::get_giftconfig($itemid);
        if (is_null($itemgiftconifg)) {
            $retCode = err_dbs_neighbourhood_playerdata_sendgiftpackage::ITEM_CONFIG_ERROR;
            $retCode_Str = 'ITEM_CONFIG_ERROR';
            goto failed;
        }

        // 用户发红包的设置
        $playergiftdata = $this->get_sendgiftdata();
        $quality = $itemgiftconifg [configdata_item_neighboorhood_gift_package_setting::k_quality];

        $maxtime = $this->db_owner->dbs_vip()->get_send_neighboorhoodgiftpackagetimes($quality);
        $currenttime = $playergiftdata->get_sendgiftcount($quality);

        if ($currenttime >= $maxtime) {
            $retCode = err_dbs_neighbourhood_playerdata_sendgiftpackage::TIMES_LIMIT;
            $retCode_Str = 'TIMES_LIMIT';
            goto failed;
        }

        // 删除道具
        $warehouse->removeItemByItemId($itemid, 1);
        // 实际发送红包
        $groupdata = $this->get_groupdata();
        $groupdata->send_giftpackage($itemid, $this->get_userid());

        // 记录数据
        $playergiftdata->sendgift($quality);
        $this->set_sendgiftdata($playergiftdata);

        // 增加发送威望
        $reputationdata = $this->get_reputation();
        $reputationdata->addreputationexp($reputationdata);
        $this->set_reputation($reputationdata);

        $this->db_owner->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_69, $itemid, 1);
        // code

        succ:

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 抢红包
     *
     * @param unknown $giftguid
     * @return Common_Util_ReturnVar
     */
    function recvgiftpackage($giftguid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_playerdata_recvgiftpackage{}

        $giftguid = strval($giftguid);

        $groupdata = $this->get_groupdata();
        if (is_null($groupdata)) {
            $retCode = err_dbs_neighbourhood_playerdata_recvgiftpackage::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }

        $giftpackagedata = $groupdata->get_giftpackagedata($giftguid);
        if (is_null($giftpackagedata)) {
            $retCode = err_dbs_neighbourhood_playerdata_recvgiftpackage::GIFTPACKAGE_NOT_EXISTS;
            $retCode_Str = 'GIFTPACKAGE_NOT_EXISTS';
            goto failed;
        }

        if ($giftpackagedata->get_owneruserid() == $this->db_owner->get_userid()) {
            $retCode = err_dbs_neighbourhood_playerdata_recvgiftpackage::CANNOT_RECV_SELF_GIFT_PACKAGE;
            $retCode_Str = 'CANNOT_RECV_SELF_GIFT_PACKAGE';
            goto failed;
        }

        if ($giftpackagedata->is_recvtimes_max()) {
            $retCode = err_dbs_neighbourhood_playerdata_recvgiftpackage::RECV_TIMES_MAX;
            $retCode_Str = 'RECV_TIMES_MAX';
            goto failed;
        }

        if ($giftpackagedata->is_already_recv($this->get_userid())) {
            $retCode = err_dbs_neighbourhood_playerdata_recvgiftpackage::CANNOT_RECV_GIFT_AGAIN;
            $retCode_Str = 'CANNOT_RECV_GIFT_AGAIN';
            goto failed;
        }

        // 领取红包
        $gamecoin = $giftpackagedata->get_eachgamecoin();
        $diamond = $giftpackagedata->get_eachdiamond();

        $this->db_owner->db_role()->add_gamecoin_and_diamonds($gamecoin, $diamond, constants_moneychangereason::RECV_NEIGHBOURHOOD_GIFTPACKAGE);
        // code

        // 增加记录
        $giftpackagedata->recvpackage($this->get_userid());
        $groupdata->set_giftpackagedata($giftpackagedata);

        $this->db_owner->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_70, $giftpackagedata->get_gitfitemid(), 1);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 感谢红包发送者
     *
     * @param string $giftguid
     * @param int $thankstype
     *            0 忽略 1 普通感谢 2 钻石感谢
     * @return Common_Util_ReturnVar
     */
    function thanksgiftpackagesender($giftguid, $thankstype)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_playerdata_thanksgiftpackagesender{}
        $giftguid = strval($giftguid);
        $thankstype = intval($thankstype);

        $groupdata = $this->get_groupdata();
        if (is_null($groupdata)) {
            $retCode = err_dbs_neighbourhood_playerdata_thanksgiftpackagesender::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }

        $giftpackagedata = $groupdata->get_giftpackagedata($giftguid);
        if (is_null($giftpackagedata)) {
            $retCode = err_dbs_neighbourhood_playerdata_thanksgiftpackagesender::GIFTPACKAGE_NOT_EXISTS;
            $retCode_Str = 'GIFTPACKAGE_NOT_EXISTS';
            goto failed;
        }

        if (!$giftpackagedata->is_already_recv($this->get_userid())) {
            $retCode = err_dbs_neighbourhood_playerdata_thanksgiftpackagesender::MUST_RECV_GIFT_PACKAGE_FRIST;
            $retCode_Str = 'MUST_RECV_GIFT_PACKAGE_FRIST';
            goto failed;
        }

        $recvlist = $giftpackagedata->get_recvuserlist();
        $answerd = $recvlist [$this->get_userid()];
        if ($answerd != 0) {
            $retCode = err_dbs_neighbourhood_playerdata_thanksgiftpackagesender::CANNOT_THANKS_AGAIN;
            $retCode_Str = 'CANNOT_THANKS_AGAIN';
            goto failed;
        }

        // $cost_gamecoin = 0;
        $cost_diamond = 0;
        $add_reputation_exp = 0;

        switch ($thankstype) {
            case 0 :
                break;
            case 1 :
                $add_reputation_exp = Common_Util_Configdata::getInstance()->get_global_config_value('NEIGHBOURHOOD_NORMAL_THANKS_ADD_REPUTATION')->int_value();
                // 普通感谢
                break;
            case 2 :
                $add_reputation_exp = Common_Util_Configdata::getInstance()->get_global_config_value('NEIGHBOURHOOD_DIAMOND_THANKS_ADD_REPUTATION')->int_value();
                $cost_diamond = Common_Util_Configdata::getInstance()->get_global_config_value('NEIGHBOURHOOD_DIAMOND_THANKS_COST')->int_value();
                // 钻石膜拜
                break;
            default :
                ;
                break;
        }

        if ($cost_diamond > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_neighbourhood_playerdata_thanksgiftpackagesender::DIAMOND_NOT_ENOUGH;
            $retCode_Str = 'DIAMOND_NOT_ENOUGH';
            goto failed;
        }

        // 标记感谢
        $giftpackagedata->thanks($this->get_userid());
        // $groupdata->set_sendgiftdata ( $giftpackagedata );
        $groupdata->set_giftpackagedata($giftpackagedata);
        // 消耗钻石
        $this->db_owner->db_role()->cost_diamond($cost_diamond, constants_moneychangereason::THANKS_NEIGHBOURHOOD_GIFTPACKAGE);


        // 红包的发送者
        $owneruser = dbs_player::newGuestPlayerWithLock($giftpackagedata->get_owneruserid());
        // 发送红包的数据
        $sendgiftdata = $owneruser->dbs_neighbourhood_playerdata()->get_sendgiftdata();
        // 目前还可以获得的总经验
        $awardexp = $owneruser->dbs_vip()->get_neighboorhood_thanks_award_reputation_exp_max() - $sendgiftdata->get_todayawardthankreputation();
        // 实际可以获得的经验
        $awardexp = min(array(
            $awardexp,
            $add_reputation_exp
        ));

        if ($awardexp > 0) {
            // 增加威望
            $repuationdata = $owneruser->dbs_neighbourhood_playerdata()->get_reputation();
            $repuationdata->addreputationexp($awardexp);
            $owneruser->dbs_neighbourhood_playerdata()->set_reputation($repuationdata);
        }

        // TODO 需要给红包发送者发个邮件
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
    function getinvitepos()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_playerdata_getinvitepos{}
        $groupdata = $this->get_groupdata();
        if (is_null($groupdata)) {
            $retCode = err_dbs_neighbourhood_playerdata_getinvitepos::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }

        return $groupdata->getinvitepos($this->get_userid());

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 接收位置申请
     *
     * @param unknown $groupid
     * @param unknown $invitecode
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function accpetinvitepos($groupid, $invitecode)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_playerdata_accpetinvitepos{}
        $groupid = strval($groupid);
        $invitecode = strval($invitecode);
        if ($this->hasgroup()) {
            $retCode = err_dbs_neighbourhood_playerdata_accpetinvitepos::IN_GROUP;
            $retCode_Str = 'IN_GROUP';
            goto failed;
        }
        $groupdata = dbs_neighbourhood_groupmanager::getInstance()->get_groupbyid($groupid);

        if (is_null($groupdata)) {
            $retCode = err_dbs_neighbourhood_playerdata_accpetinvitepos::INVITE_GROUP_NOT_EXIST;
            $retCode_Str = 'INVITE_GROUP_NOT_EXIST';
            goto failed;
        }

        $invitedata = $groupdata->get_invite_data_byinvitecode($invitecode);
        if (is_null($invitedata)) {
            $retCode = err_dbs_neighbourhood_playerdata_accpetinvitepos::INVITECODE_NOT_EXIST;
            $retCode_Str = 'INVITECODE_NOT_EXIST';
            goto failed;
        }

        return $groupdata->joinbyinvite($this->db_owner, $invitecode);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取公告版
     * @return dbs_neighbourhood_groupbulletinboard
     */
    private function getBulletinBoard()
    {
        $bulletinBroad = dbs_neighbourhood_groupbulletinboard::findOrNew([
            dbs_neighbourhood_groupbulletinboard::DBKey_guid => $this->get_groupid()
        ]);
        if (!$bulletinBroad->exist()) {
            $bulletinBroad->set_guid($this->get_groupid());
        }
        return $bulletinBroad;
    }

    /**
     * 获取公告信息
     * @return Common_Util_ReturnVar
     */
    public function getBulletinBoardInfo()
    {
        $data = [];
        //class err_dbs_neighbourhood_playerdata_getBulletinBoardInfo

        $bulletinBroad = $this->getBulletinBoard();
        $data = $bulletinBroad->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 发布公告
     * @param dbs_bulletinboard_bulletinboarddata $data
     * @return array
     */
    public function publishBulletin(dbs_bulletinboard_bulletinboarddata $data)
    {
        $bulletinBroad = $this->getBulletinBoard();
        $bulletinBroad->publishBulletin($data);

        return $bulletinBroad->toArray();
    }

    /**
     * 通过id 删除公告
     * @param $bulletinId
     * @return array
     */
    public function deleteBulletin($bulletinId)
    {
        $bulletinBroad = $this->getBulletinBoard();
        $bulletinBroad->deleteBulletin($bulletinId);

        return $bulletinBroad->toArray();
    }


    private function nextday()
    {
        $dayflag = $this->db_owner->dbs_userkvstore()->getvalue(constants_globalkey::PLAYER_NEIGHBOORHOOD_SENDGIFTPACKAGE_DAY_FLAG, 0);
        if ($dayflag == Common_Util_Time::getGameDay()) {
            return;
        }
        $this->db_owner->dbs_userkvstore()->setvalue(constants_globalkey::PLAYER_NEIGHBOORHOOD_SENDGIFTPACKAGE_DAY_FLAG, Common_Util_Time::getGameDay());

        $giftdata = $this->get_sendgiftdata();
        $giftdata->nextday();
        $this->set_sendgiftdata($giftdata);
    }

    function masterbeforecall()
    {
        // dump ( "here" );
        $this->nextday();
    }
}