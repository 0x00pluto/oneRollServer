<?php

namespace dbs\pve;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use configdata\configdata_pve_map_super_slot_machine_award_percent_setting;
use configdata\configdata_pve_map_super_slot_machine_award_setting;
use constants\constants_globalkey;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\chat\dbs_chat_data;
use dbs\dbs_baseplayer;
use dbs\dbs_item;
use dbs\dbs_player;
use dbs\dbs_warehouse;
use dbs\pve\data\dbs_pve_data_superslotmachine;
use dbs\pve\data\dbs_pve_data_superslotmachineaccpetdata;
use dbs\pve\data\dbs_pve_data_superslotmachineinvitedata;
use dbs\pve\data\dbs_pve_data_superslotmachinejackpot;
use dbs\pve\data\dbs_pve_data_superslotmachinerollinfo;
use err\err_dbs_pve_superslotmachine_giveupslotmachine;
use err\err_dbs_pve_superslotmachine_recvjackpot;
use err\err_dbs_pve_superslotmachine_rollslotmachine;
use err\err_dbs_pve_superslotmachine_sendinvitetogroup;
use err\err_dbs_pve_superslotmachine_sendinvitetouser;

/**
 * 老虎机数据
 * 2015年7月9日 上午11:17:26
 *
 * @author zhipeng
 *
 */
class dbs_pve_superslotmachine extends dbs_baseplayer
{

    /**
     * 我自己的老虎机
     *
     * @var string
     */
    const DBKey_myslotmachines = "myslotmachines";

    /**
     * 获取 我自己的老虎机
     */
    public function get_myslotmachines()
    {
        return $this->getdata(self::DBKey_myslotmachines);
    }

    /**
     * 设置 我自己的老虎机
     *
     * @param unknown $value
     */
    private function set_myslotmachines($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_myslotmachines, $value);
    }

    /**
     * 设置 我自己的老虎机 默认值
     */
    protected function _set_defaultvalue_myslotmachines()
    {
        $this->set_defaultkeyandvalue(self::DBKey_myslotmachines, array());
    }

    /**
     * 今日接受的老虎机请求
     *
     * @var string
     */
    const DBKey_todayaccpetslotmachines = "todayaccpetslotmachines";

    /**
     * 获取 今日接受的老虎机请求
     */
    public function get_todayaccpetslotmachines()
    {
        return $this->getdata(self::DBKey_todayaccpetslotmachines);
    }

    /**
     * 设置 今日接受的老虎机请求
     *
     * @param unknown $value
     */
    public function set_todayaccpetslotmachines($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_todayaccpetslotmachines, $value);
    }

    /**
     * 设置 今日接受的老虎机请求 默认值
     */
    protected function _set_defaultvalue_todayaccpetslotmachines()
    {
        $this->set_defaultkeyandvalue(self::DBKey_todayaccpetslotmachines, array());
    }

    /**
     * 接收的老虎机列表
     *
     * @var string
     */
    const DBKey_accpetslotmachinelist = "accpetslotmachinelist";

    /**
     * 获取 接收的老虎机列表
     */
    public function get_accpetslotmachinelist()
    {
        return $this->getdata(self::DBKey_accpetslotmachinelist);
    }

    /**
     * 设置 接收的老虎机列表
     *
     * @param unknown $value
     */
    private function set_accpetslotmachinelist($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_accpetslotmachinelist, $value);
    }

    /**
     * 设置 接收的老虎机列表 默认值
     */
    protected function _set_defaultvalue_accpetslotmachinelist()
    {
        $this->set_defaultkeyandvalue(self::DBKey_accpetslotmachinelist, array());
    }

    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "pve_slotmachine";

    function __construct()
    {
        parent::__construct(self::DBKey_tablename);
    }

    /**
     * 保存老虎机到接收列表
     *
     * @param dbs_pve_superslotmachine $slotmachine
     */
    private function set_accpetslotmachine(dbs_pve_data_superslotmachine $slotmachine)
    {
        $list = $this->get_accpetslotmachinelist();
        $data = dbs_pve_data_superslotmachineaccpetdata::create($slotmachine);
        $list [$data->get_slotmachineid()] = $data->toArray();
        $this->set_accpetslotmachinelist($list);
    }

    /**
     * 获取老虎机接收
     *
     * @param unknown $slotmachineid
     * @return \dbs\pve\data\dbs_pve_data_superslotmachineaccpetdata|NULL
     */
    public function get_accpetslotmachine($slotmachineid)
    {
        $slotmachineid = strval($slotmachineid);
        $list = $this->get_accpetslotmachinelist();
        if (isset ($list [$slotmachineid])) {
            $data = new dbs_pve_data_superslotmachineaccpetdata ();
            $data->fromArray($list [$slotmachineid]);
            return $data;
        }
        return NULL;
    }

    /**
     * 增加老虎机
     *
     * @param dbs_pve_data_superslotmachine $data
     */
    public function addslotmachine(dbs_pve_data_superslotmachine $data)
    {
        $list = $this->get_myslotmachines();
        foreach ($list as $value) {
            if ($value [dbs_pve_data_superslotmachine::DBKey_stageid] == $data->get_stageid()) {
                return;
            }
        }
        $list [$data->get_id()] = $data->toArray();
        $this->set_myslotmachines($list);
    }

    /**
     * 获取老虎机
     *
     * @param unknown $machineid
     * @return \dbs\pve\data\dbs_pve_data_superslotmachine|NULL
     */
    public function get_slotmachine($machineid)
    {
        $machineid = strval($machineid);
        $list = $this->get_myslotmachines();
        if (isset ($list [$machineid])) {
            $data = new dbs_pve_data_superslotmachine ();
            $data->fromArray($list [$machineid]);
            return $data;
        }
        return NULL;
    }

    /**
     * 设置老虎机信息
     *
     * @param dbs_pve_data_superslotmachine $data
     */
    private function set_slotmachine(dbs_pve_data_superslotmachine $data)
    {
        $list = $this->get_myslotmachines();
        $list [$data->get_id()] = $data->toArray();
        $this->set_myslotmachines($list);
    }

    /**
     * 摇动老虎机
     *
     * @param string $destuserid
     *            老虎机发布者的id
     * @param string $slotmachineguid
     *            老虎机id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function rollslotmachine($destuserid, $slotmachineguid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_superslotmachine_rollslotmachine{}
        $destuserid = strval($destuserid);
        $slotmachineguid = strval($slotmachineguid);
        if ($destuserid == $this->get_userid()) {
            $retCode = err_dbs_pve_superslotmachine_rollslotmachine::CANNOT_SELF_USERID;
            $retCode_Str = 'CANNOT_SELF_USERID';
            goto failed;
        }

        // dump ( $slotmachineguid );

        $destplayer = dbs_player::newGuestPlayerWithLock($destuserid);
        if (!$destplayer->isRoleExists()) {
            $retCode = err_dbs_pve_superslotmachine_rollslotmachine::DEST_USER_NOT_EXIST;
            $retCode_Str = 'DEST_USER_NOT_EXIST';
            goto failed;
        }

        $machinedata = $destplayer->dbs_pve_superslotmachine();
        $slotmachine = $machinedata->get_slotmachine($slotmachineguid);
        if (is_null($slotmachine)) {
            $retCode = err_dbs_pve_superslotmachine_rollslotmachine::DEST_SLOT_MACHINE_NOT_EXIST;
            $retCode_Str = 'DEST_SLOT_MACHINE_NOT_EXIST';
            goto failed;
        }

        $accpetdata = $this->get_accpetslotmachine($slotmachineguid);
        $frist_roll = false;
        $rollinfo = new dbs_pve_data_superslotmachinerollinfo ();

        if (is_null($accpetdata)) {
            // 第一次摇奖
            $frist_roll = true;
            $rollinfo->set_userid($this->get_userid());
        } else {
            // 后续摇奖
            $rollinfo = $slotmachine->get_rollinfobyuserid($this->get_userid());
        }
        // dump ( $slotmachine->toArray () );
        // dump ( $destuserid );
        // dump ( $rollinfo );

        if ($frist_roll) {
            if ($slotmachine->isfull()) {
                $retCode = err_dbs_pve_superslotmachine_rollslotmachine::DEST_SLOT_MACHINE_FULL;
                $retCode_Str = 'DEST_SLOT_MACHINE_FULL';
                goto failed;
            }
            // 老虎机正在工作中
            if ($slotmachine->isbusy()) {
                $retCode = err_dbs_pve_superslotmachine_rollslotmachine::DEST_SLOT_MACHINE_BUSY;
                $retCode_Str = 'DEST_SLOT_MACHINE_BUSY';
                goto failed;
            }
            $slotmachine->set_rollinfo_auto($rollinfo);
        } else {
            // 已经摇完了
        }

        // 摇奖超时
        // if ($rollinfo->get_rolltimeout () < time ()) {
        // $retCode = err_dbs_pve_superslotmachine_rollslotmachine::ROLL_TIMEOUT;
        // $retCode_Str = 'ROLL_TIMEOUT';
        // goto failed;
        // }
        // 摇奖已经结束
        if ($rollinfo->get_isfinish()) {
            $retCode = err_dbs_pve_superslotmachine_rollslotmachine::ROLL_FINISHED;
            $retCode_Str = 'ROLL_FINISHED';
            goto failed;
        }
        // 摇奖
        $maxrolltimes = $this->db_owner->dbs_vip()->get_super_slotmachine_rolltimes();
        // dump ( $rollinfo );
        $rolltimes = $rollinfo->get_rolltimes() + 1;
        if ($rolltimes > $maxrolltimes) {
            $retCode = err_dbs_pve_superslotmachine_rollslotmachine::ROLL_TIMES_MAX;
            $retCode_Str = 'ROLL_TIMES_MAX';
            goto failed;
        }

        $needdiamond = 0;
        if ($rolltimes > 1) {
            $needdiamond = Common_Util_Configdata::getInstance()->get_global_config_value('SUPER_SLOTMACHINE_ROLL_COST_DIAMOND')->int_value();
        }

        // 钻石不足
        if ($needdiamond > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_pve_superslotmachine_rollslotmachine::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        // 开始摇奖.
        // 获取对应的概率

        // 获取是第几个摇奖者
        $pos = $slotmachine->get_posbyuserid($this->get_userid());

        // dump ( $pos );
        // 检测是否触发特殊概率
        $jackpot_percent = true;
        for ($i = 1; $i < intval($pos); $i++) {
            if (!$slotmachine->is_jackpot_award($i)) {
                $jackpot_percent = false;
                break;
            }
        }

        // dump ( $jackpot_percent );
        $costdiamond = $rollinfo->get_costdiamond();
        $percentid = '';
        $percentidtmp = '';
        if ($jackpot_percent) {
            // 特殊概率
            // 第二个位置
            if (intval($pos) === 2) {
                $percentid = '1_0_1';
            } elseif (intval($pos) === 3) {
                // 第三个位置
                for ($i = 1; $i < 3; $i++) {
                    $percentidtmp = '1_1_' . $i;
                    $percentidconfig = dbs_pve_data_superslotmachine::get_awardidconfig($percentidtmp);
                    if (is_null($percentidconfig)) {
                        $retCode = err_dbs_pve_superslotmachine_rollslotmachine::AWARD_PERCENT_CONFIG_ERROR;
                        $retCode_Str = 'AWARD_PERCENT_CONFIG_ERROR';
                        goto failed;
                    }
                    if ($costdiamond >= intval($percentidconfig [configdata_pve_map_super_slot_machine_award_percent_setting::k_costdiamondmin]) && $costdiamond < intval($percentidconfig [configdata_pve_map_super_slot_machine_award_percent_setting::k_costdiamondmax])) {
                        $percentid = $percentidtmp;
                        break;
                    }
                }
            }
        } else {
            // 普通逻辑
            for ($i = 1; $i < 10; $i++) {
                $percentidtmp = '0_0_' . $i;
                $percentidconfig = dbs_pve_data_superslotmachine::get_awardidconfig($percentidtmp);
                if (is_null($percentidconfig)) {
                    $retCode = err_dbs_pve_superslotmachine_rollslotmachine::AWARD_PERCENT_CONFIG_ERROR;
                    $retCode_Str = 'AWARD_PERCENT_CONFIG_ERROR';
                    goto failed;
                }
                if ($costdiamond >= intval($percentidconfig [configdata_pve_map_super_slot_machine_award_percent_setting::k_costdiamondmin]) && $costdiamond < intval($percentidconfig [configdata_pve_map_super_slot_machine_award_percent_setting::k_costdiamondmax])) {
                    $percentid = $percentidtmp;
                    break;
                }
            }
        }

        // code
        // dump ( $percentidtmp );

        // 抽奖道具
        $awardids = dbs_pve_data_superslotmachine::get_awardids($percentidtmp);
        $awardid = Common_Util_Random::RandomWithWeight($awardids);
        $awarditemconfig = dbs_pve_data_superslotmachine::get_awarditems($awardid);

        // 扣钻石
        $this->db_owner->db_role()->cost_diamond($needdiamond, constants_moneychangereason::SUPER_SLOTMACHINE_ROLL);

        // 获得道具
        $awarditemid = $awarditemconfig [configdata_pve_map_super_slot_machine_award_setting::k_itemid];
        $awarditemcount = intval($awarditemconfig [configdata_pve_map_super_slot_machine_award_setting::k_itemcount]);
        if (dbs_item::is_gamecoin($awarditemid)) {
            $this->db_owner->db_role()->add_gamecoin($awarditemcount, constants_moneychangereason::SUPER_SLOTMACHINE_ROLL);
        } elseif (dbs_item::is_diamond($awarditemid)) {
            $this->db_owner->db_role()->add_diamond($awarditemcount, constants_moneychangereason::SUPER_SLOTMACHINE_ROLL);
        } elseif ($awarditemid == Common_Util_Configdata::getInstance()->get_global_config_value('SUPER_SLOTMACHINE_JACKPOT_ITEMID')->string_value()) {
            // jackpot 不处理
        } else {
            // 放入仓库
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $awarditemid);
            $warehouse->addItemByItemId($awarditemid, $awarditemcount, true);
        }

        $data [constants_returnkey::RK_AWARD] = array(
            constants_returnkey::RK_ITEMID => $awarditemid,
            constants_returnkey::RK_ITEMCOUNT => $awarditemcount
        );

        // 记录摇奖信息
        $rollinfo->roll($awardid, $costdiamond);

        $slotmachine->set_rollinfo_auto($rollinfo);
        $machinedata->set_slotmachine($slotmachine);

        // 记录到今日接收列表中
        if ($frist_roll) {
            $list = $this->get_todayaccpetslotmachines();
            $list [$slotmachine->get_id()] = $destuserid;
            $this->set_todayaccpetslotmachines($list);
        }

        // 接受老虎机
        // 增加到自己的关联列表中
        $this->set_accpetslotmachine($slotmachine);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 放弃老虎机
     *
     * @param unknown $slotmachineguid
     *            老虎机id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function giveupslotmachine($slotmachineguid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_superslotmachine_giveupslotmachine{}

        $accpetdata = $this->get_accpetslotmachine($slotmachineguid);
        if (is_null($accpetdata)) {
            $retCode = err_dbs_pve_superslotmachine_giveupslotmachine::SLOTMACHINE_NOT_EXIST;
            $retCode_Str = 'SLOTMACHINE_NOT_EXIST';
            goto failed;
        }

        $slotmachineid = $accpetdata->get_slotmachineid();
        $slotmachineowneruserid = $accpetdata->get_owneruserid();
        $destplayer = dbs_player::newGuestPlayerWithLock($slotmachineowneruserid);
        $dest_dbs_slotmachine = $destplayer->dbs_pve_superslotmachine();

        $slotmachine = $dest_dbs_slotmachine->get_slotmachine($slotmachineid);
        if (is_null($slotmachine)) {
            $retCode = err_dbs_pve_superslotmachine_giveupslotmachine::SLOTMACHINE_NOT_EXIST;
            $retCode_Str = 'SLOTMACHINE_NOT_EXIST';
            goto failed;
        }

        $rollinfo = $slotmachine->get_rollinfo($this->get_userid());
        if (is_null($rollinfo)) {
            $retCode = err_dbs_pve_superslotmachine_giveupslotmachine::SLOTMACHINE_ROLLINFO_NOT_EXIST;
            $retCode_Str = 'SLOTMACHINE_ROLLINFO_NOT_EXIST';
            goto failed;
        }

        if ($rollinfo->get_isfinish()) {
            $retCode = err_dbs_pve_superslotmachine_giveupslotmachine::SLOTMACHINE_ROLL_AREADY_FINISH;
            $retCode_Str = 'SLOTMACHINE_ROLL_AREADY_FINISH';
            goto failed;
        }

        if ($rollinfo->giveup()) {
            $slotmachine->set_rollinfo_auto($rollinfo);

            $pos = $slotmachine->get_posbyuserid($this->get_userid());
            // 最后一位放弃,直接计算大奖
            if (intval($pos) == 3) {
                $slotmachine->compute_jackpot();
                $data [constants_returnkey::RK_SLOTMACHINE_JACKPOT] = $slotmachine->get_jackpotinfo();
            }
            $dest_dbs_slotmachine->set_slotmachine($slotmachine);
        }

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 领取超级奖励
     *
     * @param unknown $superslotmachineid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function recvjackpot($superslotmachineid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_superslotmachine_recvjackpot{}

        $superslotmachineid = strval($superslotmachineid);

        // 是否是自己的老虎机
        $slotmachine = $this->get_slotmachine($superslotmachineid);
        // 老虎机数据库
        $superslotmachinedb = $this;

        if (is_null($slotmachine)) {
            $accpetinfo = $this->get_accpetslotmachine($superslotmachineid);
            if (is_null($accpetinfo)) {
                $retCode = err_dbs_pve_superslotmachine_recvjackpot::SLOTMACHINE_NOT_EXIST;
                $retCode_Str = 'SLOTMACHINE_NOT_EXIST';
                goto failed;
            }
            $destuserid = $accpetinfo->get_owneruserid();
            $destplayer = dbs_player::newGuestPlayerWithLock($destuserid);
            $superslotmachinedb = $destplayer->dbs_pve_superslotmachine();
            $slotmachine = $superslotmachinedb->get_slotmachine($superslotmachineid);
            if (is_null($slotmachine)) {
                $retCode = err_dbs_pve_superslotmachine_recvjackpot::SLOTMACHINE_NOT_EXIST;
                $retCode_Str = 'SLOTMACHINE_NOT_EXIST';
                goto failed;
            }
        }

        $rollinfo = $slotmachine->get_rollinfo($this->get_userid());
        if (is_null($rollinfo)) {
            $retCode = err_dbs_pve_superslotmachine_recvjackpot::SLOTMACHINE_ROLLINFO_NOT_EXIST;
            $retCode_Str = 'SLOTMACHINE_ROLLINFO_NOT_EXIST';
            goto failed;
        }

        $jackpotinfo = $slotmachine->get_jackpotinfo();
        $jackpot = new dbs_pve_data_superslotmachinejackpot ();
        $jackpot->fromArray($jackpotinfo);
        // 超级大奖没有激活
        if (!$jackpot->get_isactive()) {
            $retCode = err_dbs_pve_superslotmachine_recvjackpot::SLOTMACHINE_NOT_ACTIVE_JACKPOT;
            $retCode_Str = 'SLOTMACHINE_NOT_ACTIVE_JACKPOT';
            goto failed;
        }

        if ($jackpot->isrecv($this->get_userid())) {
            $retCode = err_dbs_pve_superslotmachine_recvjackpot::ALREADY_RECV_JACKPOT;
            $retCode_Str = 'ALREADY_RECV_JACKPOT';
            goto failed;
        }

        $diamonds = $jackpot->get_awarddiamonds();
        // 发钻石
        $this->db_owner->db_role()->add_diamond($diamonds, constants_moneychangereason::SUPER_SLOT_MACHINE_JACKPOT);
        // 增加领奖信息
        $jackpot->recvawarid($this->get_userid());
        $slotmachine->set_jackpotinfo($jackpot->toArray());

        // 保存老虎机信息
        $superslotmachinedb->set_slotmachine($slotmachine);

        $data [constants_returnkey::RK_DIAMOND] = $diamonds;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 发送用户邀请
     *
     * @param string $slotmachineid
     * @param string $destuserid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function sendinvitetouser($slotmachineid, $destuserid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_superslotmachine_sendinvitetouser{}

        $destuserid = strval($destuserid);
        $slotmachineid = strval($slotmachineid);
        if ($this->get_userid() == $destuserid) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetouser::CANNOT_SELF_USERID;
            $retCode_Str = 'CANNOT_SELF_USERID';
            goto failed;
        }

        $destplayer = dbs_player::newGuestPlayerWithLock($destuserid);
        if (!$destplayer->isRoleExists()) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetouser::DEST_USER_NOT_EXIST;
            $retCode_Str = 'DEST_USER_NOT_EXIST';
            goto failed;
        }

        $slotmachine = $this->get_slotmachine($slotmachineid);
        if (is_null($slotmachine)) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetouser::SLOT_MACHINE_NOT_EXIST;
            $retCode_Str = 'SLOT_MACHINE_NOT_EXIST';
            goto failed;
        }

        /**
         * 是否已经帮忙满了
         */
        if (!$slotmachine->invite_friend_enable()) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetouser::INVITE_TIME_FULL;
            $retCode_Str = 'INVITE_TIME_FULL';
            goto failed;
        }

        $invite = $slotmachine->get_invert_friend($destuserid);
        if (!is_null($invite)) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetouser::ALREADY_INVERTED;
            $retCode_Str = 'ALREADY_INVERTED';
            goto failed;
        }

        if ($slotmachine->isfull()) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetouser::SLOT_MACHINE_IS_FULL;
            $retCode_Str = 'SLOT_MACHINE_IS_FULL';
            goto failed;
        }
        $data = $slotmachine->invert_friend($destuserid);
        $this->set_slotmachine($slotmachine);

        // code
        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_98, 1);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 向群组发送邀请
     *
     * @param string $slotmachineid
     *            老虎机id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function sendinvitetogroup($slotmachineid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_superslotmachine_sendinvitetogroup{}
        $slotmachineid = strval($slotmachineid);
        $slotmachine = $this->get_slotmachine($slotmachineid);
        if (is_null($slotmachine)) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetogroup::SLOT_MACHINE_NOT_EXIST;
            $retCode_Str = 'SLOT_MACHINE_NOT_EXIST';
            goto failed;
        }

        if ($slotmachine->isfull()) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetogroup::SLOT_MACHINE_IS_FULL;
            $retCode_Str = 'SLOT_MACHINE_IS_FULL';
            goto failed;
        }

        if ($slotmachine->get_invitegroup()) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetogroup::ALREADY_INVERTED;
            $retCode_Str = 'ALREADY_INVERTED';
            goto failed;
        }

        if (!$this->db_owner->dbs_neighbourhood_playerdata()->hasgroup()) {
            $retCode = err_dbs_pve_superslotmachine_sendinvitetogroup::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }

        $groupdata = $this->db_owner->dbs_neighbourhood_playerdata()->get_groupdata();
        $invitedata = dbs_pve_data_superslotmachineinvitedata::create_invite_group_data($this->get_userid(), $slotmachineid);

        $chat = new dbs_chat_data ();
        $chat->fromArray($invitedata->toArray());

        $groupdata->chat($chat);

        $data = $chat->toArray();
        $slotmachine->set_invitegroup(true);
        $this->set_slotmachine($slotmachine);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    // 第二天
    private function nextday()
    {
        $gameday = Common_Util_Time::getGameDay();
        if ($gameday == $this->db_owner->dbs_userkvstore()->getvalue(constants_globalkey::PLAYER_SUPER_SLOTMACHINE_DAY_FLAG, 0)) {
            return;
        }
        $this->db_owner->dbs_userkvstore()->setvalue(constants_globalkey::PLAYER_SUPER_SLOTMACHINE_DAY_FLAG, $gameday);
        $this->set_todayaccpetslotmachines(array());
    }

    /**
     * 计算超时
     */
    private function compute_slotmachinerolltimeout()
    {
        $list = $this->get_myslotmachines();
        $datachange = false;
        foreach ($list as $key => $value) {
            $slotmachine = new dbs_pve_data_superslotmachine ();
            $slotmachine->fromArray($value);
            if ($slotmachine->compute_rollinfo_timeout()) {
                $list [$key] = $slotmachine->toArray();
                $datachange = true;
            }

            // 计算超级大奖
            if ($slotmachine->compute_jackpot()) {
                $list [$key] = $slotmachine->toArray();
                $datachange = true;
            }
        }

        if ($datachange) {
            $this->set_myslotmachines($list);
        }
    }

    function masterbeforecall()
    {
        $this->compute_slotmachinerolltimeout();
        $this->nextday();
    }
}