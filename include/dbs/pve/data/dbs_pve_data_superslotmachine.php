<?php

namespace dbs\pve\data;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Guid;
use configdata\configdata_pve_map_super_slot_machine_award_percent_setting;
use configdata\configdata_pve_map_super_slot_machine_award_setting;
use constants\constants_languagevar;
use constants\constants_mailactiontype;
use dbs\dbs_basedatacell;
use dbs\dbs_player;
use dbs\mailbox\dbs_mailbox_data;
use dbs\mailbox\dbs_mailbox_list;

/**
 * 超级老虎机数据
 *
 * @author zhipeng
 *
 */
class dbs_pve_data_superslotmachine extends dbs_basedatacell
{

    /**
     * 拥有者的guid
     *
     * @var string
     */
    const DBKey_ownerguid = "ownerguid";

    /**
     * 获取 拥有者的guid
     */
    public function get_ownerguid()
    {
        return $this->getdata(self::DBKey_ownerguid);
    }

    /**
     * 设置 拥有者的guid
     *
     * @param unknown $value
     */
    private function set_ownerguid($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_ownerguid, $value);
    }

    /**
     * 设置 拥有者的guid 默认值
     */
    protected function _set_defaultvalue_ownerguid()
    {
        $this->set_defaultkeyandvalue(self::DBKey_ownerguid, null);
    }

    /**
     * 超级老虎机id
     *
     * @var string
     */
    const DBKey_id = "id";

    /**
     * 获取 超级老虎机id
     */
    public function get_id()
    {
        return $this->getdata(self::DBKey_id);
    }

    /**
     * 设置 超级老虎机id
     *
     * @param unknown $value
     */
    private function set_id($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_id, $value);
    }

    /**
     * 设置 超级老虎机id 默认值
     */
    protected function _set_defaultvalue_id()
    {
        $this->set_defaultkeyandvalue(self::DBKey_id, '');
    }

    /**
     * 关卡id
     *
     * @var string
     */
    const DBKey_stageid = "stageid";

    /**
     * 获取 关卡id
     */
    public function get_stageid()
    {
        return $this->getdata(self::DBKey_stageid);
    }

    /**
     * 设置 关卡id
     *
     * @param unknown $value
     */
    private function set_stageid($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_stageid, $value);
    }

    /**
     * 设置 关卡id 默认值
     */
    protected function _set_defaultvalue_stageid()
    {
        $this->set_defaultkeyandvalue(self::DBKey_stageid, null);
    }

    /**
     * 摇奖人信息
     *
     * @var string
     */
    const DBKey_rollinfo1 = "rollinfo1";

    /**
     * 获取 摇奖人信息
     */
    public function get_rollinfo1()
    {
        return $this->getdata(self::DBKey_rollinfo1);
    }

    /**
     * 设置 摇奖人信息
     *
     * @param unknown $value
     */
    private function set_rollinfo1($value)
    {
        $this->setdata(self::DBKey_rollinfo1, $value);
    }

    /**
     * 设置 摇奖人信息 默认值
     */
    protected function _set_defaultvalue_rollinfo1()
    {
        $this->set_defaultkeyandvalue(self::DBKey_rollinfo1, null);
    }

    /**
     * 第二个摇奖人的信息
     *
     * @var string
     */
    const DBKey_rollinfo2 = "rollinfo2";

    /**
     * 获取 第二个摇奖人的信息
     */
    public function get_rollinfo2()
    {
        return $this->getdata(self::DBKey_rollinfo2);
    }

    /**
     * 设置 第二个摇奖人的信息
     *
     * @param unknown $value
     */
    private function set_rollinfo2($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_rollinfo2, $value);
    }

    /**
     * 设置 第二个摇奖人的信息 默认值
     */
    protected function _set_defaultvalue_rollinfo2()
    {
        $this->set_defaultkeyandvalue(self::DBKey_rollinfo2, null);
    }

    /**
     * 第三个摇奖人的信息
     *
     * @var string
     */
    const DBKey_rollinfo3 = "rollinfo3";

    /**
     * 获取 第三个摇奖人的信息
     */
    public function get_rollinfo3()
    {
        return $this->getdata(self::DBKey_rollinfo3);
    }

    /**
     * 设置 第三个摇奖人的信息
     *
     * @param unknown $value
     */
    private function set_rollinfo3($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_rollinfo3, $value);
    }

    /**
     * 设置 第三个摇奖人的信息 默认值
     */
    protected function _set_defaultvalue_rollinfo3()
    {
        $this->set_defaultkeyandvalue(self::DBKey_rollinfo3, null);
    }

    /**
     * 超时时间
     *
     * @var string
     */
    const DBKey_timeout = "timeout";

    /**
     * 获取 超时时间
     */
    public function get_timeout()
    {
        return $this->getdata(self::DBKey_timeout);
    }

    /**
     * 设置 超时时间
     *
     * @param unknown $value
     */
    public function set_timeout($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_timeout, $value);
    }

    /**
     * 设置 超时时间 默认值
     */
    protected function _set_defaultvalue_timeout()
    {
        $this->set_defaultkeyandvalue(self::DBKey_timeout, 0);
    }

    /**
     * 超级大奖信息
     *
     * @var string
     */
    const DBKey_jackpotinfo = "jackpotinfo";

    /**
     * 获取 超级大奖信息
     */
    public function get_jackpotinfo()
    {
        return $this->getdata(self::DBKey_jackpotinfo);
    }

    /**
     * 设置 超级大奖信息
     *
     * @param unknown $value
     */
    public function set_jackpotinfo($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_jackpotinfo, $value);
    }

    /**
     * 设置 超级大奖信息 默认值
     */
    protected function _set_defaultvalue_jackpotinfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_jackpotinfo, (new dbs_pve_data_superslotmachinejackpot ())->toArray());
    }

    /**
     * 邀请列表
     *
     * @var string
     */
    const DBKey_invitelist = "invitelist";

    /**
     * 获取 邀请列表
     */
    public function get_invitelist()
    {
        return $this->getdata(self::DBKey_invitelist);
    }

    /**
     * 设置 邀请列表
     *
     * @param unknown $value
     */
    public function set_invitelist($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_invitelist, $value);
    }

    /**
     * 设置 邀请列表 默认值
     */
    protected function _set_defaultvalue_invitelist()
    {
        $this->set_defaultkeyandvalue(self::DBKey_invitelist, array());
    }

    /**
     * 群组邀请
     *
     * @var string
     */
    const DBKey_invitegroup = "invitegroup";

    /**
     * 获取 群组邀请
     */
    public function get_invitegroup()
    {
        return $this->getdata(self::DBKey_invitegroup);
    }

    /**
     * 设置 群组邀请
     *
     * @param unknown $value
     */
    public function set_invitegroup($value)
    {
        $value = boolval($value);
        $this->setdata(self::DBKey_invitegroup, $value);
    }

    /**
     * 设置 群组邀请 默认值
     */
    protected function _set_defaultvalue_invitegroup()
    {
        $this->set_defaultkeyandvalue(self::DBKey_invitegroup, false);
    }

    function __construct()
    {
        parent::__construct(array());
    }

    /**
     * 获取奖励配置
     *
     * @param unknown $awardid
     * @return Ambigous <\Common\Util\multitype:, string>
     */
    static function get_awardidconfig($awardid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_pve_map_super_slot_machine_award_percent_setting::class, configdata_pve_map_super_slot_machine_award_percent_setting::k_id, $awardid);
    }

    /**
     * 获得奖励概率标识
     *
     * @param unknown $awardid
     */
    static function get_awardids($awardid)
    {
        $configdata = static::get_awardidconfig($awardid);
        if (is_null($configdata)) {
            return null;
        }

        $awardids = array();
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_0_0] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_0_0]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_0_1] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_0_1]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_0_2] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_0_2]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_1_0] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_1_0]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_1_1] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_1_1]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_1_2] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_1_2]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_2_0] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_2_0]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_2_1] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_2_1]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_2_2] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_2_2]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_3_0] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_3_0]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_3_1] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_3_1]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_3_2] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_3_2]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_4_0] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_4_0]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_4_1] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_4_1]);
        $awardids [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_4_2] = intval($configdata [configdata_pve_map_super_slot_machine_award_percent_setting::k_award_4_2]);

        return $awardids;
    }

    /**
     * 获取奖励道具
     *
     * @param unknown $awardid
     */
    static function get_awarditems($awardid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_pve_map_super_slot_machine_award_setting::class, configdata_pve_map_super_slot_machine_award_setting::k_awardid, $awardid);
    }

    /**
     * ..create
     *
     * @param unknown $ownerguid
     * @param unknown $stageid
     * @param unknown $awardid
     * @return \dbs\pve\data\dbs_pve_data_superslotmachine
     */
    static function create($ownerguid, $stageid, $awardid)
    {
        $ins = new self ();
        $ins->set_id(Common_Util_Guid::gen_superslotmachine_guid());
        $ins->set_stageid($stageid);
        $ins->set_ownerguid($ownerguid);

        $operatetimeout = Common_Util_Configdata::getInstance()->get_global_config_value('SUPER_SLOTMACHINE_OPERATE_TIMEOUT')->int_value();
        $ins->set_timeout(time() + $operatetimeout);

        $rollinfo = new dbs_pve_data_superslotmachinerollinfo ();
        $rollinfo->set_userid($ownerguid);
        $rollinfo->roll($awardid, 0);
        $rollinfo->set_isfinish(true);

        $ins->set_rollinfo1($rollinfo->toArray());

        return $ins;
    }

    /**
     * 获取摇奖信息
     *
     * @param unknown $destuserid
     * @return \dbs\pve\data\dbs_pve_data_superslotmachinerollinfo|NULL
     */
    public function get_rollinfo($destuserid)
    {
        $destuserid = strval($destuserid);

        $rolldata = new dbs_pve_data_superslotmachinerollinfo ();

        $data = $this->get_rollinfo1();
        if (!is_null($data) && $data [dbs_pve_data_superslotmachinerollinfo::DBKey_userid] == $destuserid) {
            $rolldata->fromArray($data);
            return $rolldata;
        }
        $data = $this->get_rollinfo2();
        if (!is_null($data) && $data [dbs_pve_data_superslotmachinerollinfo::DBKey_userid] == $destuserid) {
            $rolldata->fromArray($data);
            return $rolldata;
        }
        $data = $this->get_rollinfo3();
        if (!is_null($data) && $data [dbs_pve_data_superslotmachinerollinfo::DBKey_userid] == $destuserid) {
            $rolldata->fromArray($data);
            return $rolldata;
        }

        return NULL;
    }

    /**
     * 是否正在摇奖中
     */
    public function isbusy()
    {
        $rolldata = new dbs_pve_data_superslotmachinerollinfo ();
        for ($i = 1; $i <= 3; $i++) {
            $functionname = 'get_rollinfo' . $i;
            $data = $this->$functionname ();
            if (!is_null($data)) {
                $rolldata->fromArray($data);
                if (!$rolldata->get_isfinish()) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 是否摇奖完成
     *
     * @return boolean
     */
    public function isfinish()
    {
        $rolldata = new dbs_pve_data_superslotmachinerollinfo ();
        for ($i = 1; $i <= 3; $i++) {
            $functionname = 'get_rollinfo' . $i;
            $data = $this->$functionname ();
            if (!is_null($data)) {
                $rolldata->fromArray($data);
                if (!$rolldata->get_isfinish()) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 老虎机是否满了
     */
    public function isfull()
    {
        for ($i = 1; $i <= 3; $i++) {
            $functionname = 'get_rollinfo' . $i;
            if (is_null($this->$functionname ())) {
                return false;
            }
        }
        return true;
    }

    /**
     * 找到摇奖信息
     *
     * @param unknown $userid
     * @return \dbs\pve\data\dbs_pve_data_superslotmachinerollinfo|NULL|unknown
     */
    public function get_rollinfobyuserid($userid)
    {
        $_findrolldata = function ($data) use ($userid) {
            $rolldata = new dbs_pve_data_superslotmachinerollinfo ();
            if (!is_null($data)) {
                $rolldata->fromArray($data);
                if ($rolldata->get_userid() == $userid) {
                    return $rolldata;
                }
            }
            return null;
        };

        for ($i = 1; $i <= 3; $i++) {
            $functionname = 'get_rollinfo' . $i;
            $data = $this->$functionname ();
            $rolldata = $_findrolldata ($data);
            if (!is_null($rolldata)) {
                return $rolldata;
            }
        }
        return null;
    }

    /**
     * 通过位置获取摇奖信息
     *
     * @param int $pos
     *            1,2,3
     * @return \dbs\pve\data\dbs_pve_data_superslotmachinerollinfo|NULL
     */
    public function get_rollinfobypos($pos)
    {
        $functionname = 'get_rollinfo' . $pos;
        $data = $this->$functionname ();
        if (!is_null($data)) {
            $rolldata = new dbs_pve_data_superslotmachinerollinfo ();
            $rolldata->fromArray($data);
            return $rolldata;
        }
        return NULL;
    }

    /**
     * 通过userid获取位置
     *
     * @param unknown $userid
     * @return Ambigous <string, number>
     */
    public function get_posbyuserid($userid)
    {
        $pos = '-1';
        $userid = strval($userid);
        for ($i = 1; $i <= 3; $i++) {
            $functionname = 'get_rollinfo' . $i;
            $data = $this->$functionname ();
            if (!is_null($data) && $data [dbs_pve_data_superslotmachinerollinfo::DBKey_userid] == $userid) {
                $pos = $i;
                break;
            }
        }
        return $pos;
    }

    /**
     *  自动设置摇奖信息
     *
     * @param dbs_pve_data_superslotmachinerollinfo $rollinfo
     */
    public function set_rollinfo_auto(dbs_pve_data_superslotmachinerollinfo $rollinfo)
    {
        for ($i = 1; $i <= 3; $i++) {
            $functionname = 'get_rollinfo' . $i;
            $data = $this->$functionname ();
            if (is_null($data) || $data [dbs_pve_data_superslotmachinerollinfo::DBKey_userid] == $rollinfo->get_userid()) {
                $set_functionname = 'set_rollinfo' . $i;
                $this->$set_functionname ($rollinfo->toArray());
                break;
            }
        }
    }

    /**
     * 对应位置是否获取了超级奖励
     *
     * @param int $pos ,1,2,3
     * @return bool
     */
    public function is_jackpot_award($pos)
    {
        $functionname = 'get_rollinfo' . $pos;
        $data = $this->$functionname ();
        if (!is_null($data)) {
            $rolldata = new dbs_pve_data_superslotmachinerollinfo ();
            $rolldata->fromArray($data);
            // 摇奖还没有完成,
            if (!$rolldata->get_isfinish()) {
                return false;
            }

            $jackpot_awardid = Common_Util_Configdata::getInstance()->get_global_config_value('SUPER_SLOTMACHINE_JACKPOT_AWARDID_' . $pos)->string_value();
            return $jackpot_awardid === $rolldata->get_awardid();
        }
        return false;
    }

    /**
     * 计算超级大奖
     */
    public function compute_jackpot()
    {
        $jackpotdata = $this->get_jackpotinfo();
        $jackpot = new dbs_pve_data_superslotmachinejackpot ();
        $jackpot->fromArray($jackpotdata);
        if ($jackpot->get_iscompute()) {
            return false;
        }
        if (!$this->isfinish()) {
            return false;
        }

        $isjackpot = false;
        foreach ([
                     1,
                     2,
                     3
                 ] as $value) {
            if (!$this->is_jackpot_award($value)) {
                $isjackpot = FALSE;
                break;
            }
        }

        $jackpot->set_slotmachineid($this->get_id());
        $jackpot->set_iscompute(true);
        $jackpot->set_isactive($isjackpot);
        if ($isjackpot) {
            $jackpot->set_awarddiamonds(Common_Util_Configdata::getInstance()->get_global_config_value('SUPER_SLOTMACHINE_JACKPOT_AWARDDIAMOND')->int_value());
            $jackpot->set_timeout(time() + Common_Util_Configdata::getInstance()->get_global_config_value('SUPER_SLOTMACHINE_RECV_AWARD_TIMEOUT')->int_value());
        }
        $jackpot->set_recvlist(array());
        $this->set_jackpotinfo($jackpot->toArray());

        if ($isjackpot) {
            // 发放邮件
            $owneruserid = $this->get_ownerguid();
            $ownerplayer = dbs_player::newGuestPlayer($owneruserid);
            $rolename = $ownerplayer->db_role()->get_rolename();

            $lang = Common_Util_Configdata::getInstance()->get_lang('MESSAGE_SUPER_SLOTMACHINE_RECV_JACKPOT', array(
                constants_languagevar::ROLENAME => $rolename,
                constants_languagevar::NUM => '909'
            ));

//            $maildata = dbs_mailbox_data::create('system', $lang);
//            $maildata->addAttachAction(constants_mailactiontype::RECV_SUPER_SLOTMACHINE_JACKPOT, $this->toArray());
//            foreach ([
//                         1,
//                         2,
//                         3
//                     ] as $pos) {
//                $rollinfo = $this->get_rollinfobypos($pos);
//                dbs_mailbox_list::sendMailToUser($rollinfo->get_userid(), $maildata);
//            }
        }

        return true;
    }

    /**
     * 计算摇奖信息超时
     */
    public function compute_rollinfo_timeout()
    {
        $datachange = false;

        foreach ([
                     2,
                     3
                 ] as $value) {
            $get_functionname = 'get_rollinfo' . $value;
            $data = $this->$get_functionname ();
            if (!is_null($data)) {
                $rolldata = new dbs_pve_data_superslotmachinerollinfo ();
                $rolldata->fromArray($data);
                // 操作超时
                if (!$rolldata->get_isfinish() && $rolldata->get_rolltimeout() < time()) {
                    $set_functionname = 'set_rollinfo' . $value;
                    $rolldata->giveup();
                    $this->$set_functionname ($rolldata->toArray());

                    $datachange = true;
                }
            }
        }

        return $datachange;
    }

    /**
     * 是否可以邀请帮忙
     *
     * @return boolean
     */
    public function invite_friend_enable()
    {
        $list = $this->get_invitelist();
        return count($list) < 2;
    }

    /**
     * 邀请好友
     *
     * @param unknown $destuserid
     */
    public function invert_friend($destuserid)
    {
        $data = dbs_pve_data_superslotmachineinvitedata::create_invite_private_data($this->get_ownerguid(), $this->get_id());
        dbs_mailbox_list::sendMailToUser($destuserid, $data);

        $list = $this->get_invitelist();
        $list [$destuserid] = $data->toArray();
        $this->set_invitelist($list);

        return $data->toArray();
    }

    /**
     * 获取邀请好友数据
     *
     * @param unknown $destuserid
     * @return Ambigous <NULL, \dbs\pve\data\dbs_pve_data_superslotmachineinvitedata>
     */
    public function get_invert_friend($destuserid)
    {
        $data = null;
        $list = $this->get_invitelist();
        if (isset ($list [$destuserid])) {
            $data = new dbs_pve_data_superslotmachineinvitedata ();
            $data->fromArray($list [$destuserid]);
        }
        return $data;
    }
}