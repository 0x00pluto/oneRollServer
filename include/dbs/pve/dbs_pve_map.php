<?php

namespace dbs\pve;

use Common\Db\Common_Db_memcacheObject;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use configdata\configdata_pve_attacktime_recharge_setting;
use configdata\configdata_pve_awarditem_setting;
use configdata\configdata_pve_map_award_setting;
use configdata\configdata_pve_map_boss_awarditem_setting;
use configdata\configdata_pve_map_boss_stage_setting;
use configdata\configdata_pve_map_setting;
use configdata\configdata_pve_map_super_slot_machine_award_setting;
use configdata\configdata_pve_ticket_buy_setting;
use constants\constants_globalkey;
use constants\constants_memcachekey;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_pvegrade;
use constants\constants_pvestagetype;
use constants\constants_returnkey;
use dbs\dbs_baseplayer;
use dbs\dbs_item;
use dbs\dbs_warehouse;
use dbs\pve\data\dbs_pve_data_invitechef;
use dbs\pve\data\dbs_pve_data_map;
use dbs\pve\data\dbs_pve_data_mapstageinfo;
use dbs\pve\data\dbs_pve_data_rollcardrollinfo;
use dbs\pve\data\dbs_pve_data_superslotmachine;
use dbs\pve\data\dbs_pve_data_ticket;
use err\err_dbs_pve_map_awardbossstage;
use err\err_dbs_pve_map_battle;
use err\err_dbs_pve_map_battlebossstage;
use err\err_dbs_pve_map_buytickets;
use err\err_dbs_pve_map_getmapaward;
use err\err_dbs_pve_map_restorestagebattletimes;

/**
 * pve地图
 * 2015年6月9日 下午3:47:35
 *
 * @author zhipeng
 *
 */
class dbs_pve_map extends dbs_baseplayer
{
    /**
     * 获取关卡配置
     *
     * @param unknown $stageid
     * @return Ambigous <multitype:, string>
     */
    static function get_stage_conf($stageid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_pve_map_setting::class, configdata_pve_map_setting::k_stageid, $stageid);
    }

    /**
     * 获取重置配置
     *
     * @param unknown $restoretimes
     * @return Ambigous <multitype:, string>
     */
    static function get_stage_restore_config($restoretimes)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_pve_attacktime_recharge_setting::class, configdata_pve_attacktime_recharge_setting::k_rechargecount, $restoretimes);
    }

    static function get_ticket_buy_config($buycount)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_pve_ticket_buy_setting::class, configdata_pve_ticket_buy_setting::k_rechargeid, $buycount);
    }

    static function get_map_awards_config($awardid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_pve_map_award_setting::class, configdata_pve_map_award_setting::k_awardid, $awardid);
    }

    /**
     * 获取boss关配置
     *
     * @param unknown $stageid
     * @return Ambigous <\Common\Util\multitype:, string>
     */
    static function get_pve_boss_config($stageid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_pve_map_boss_stage_setting::class, configdata_pve_map_boss_stage_setting::k_stageid, $stageid);
    }

    /**
     * 获取boss关奖励配置
     *
     * @param unknown $groupid
     */
    static function get_pve_boss_awards($groupid)
    {
        $groupid = strval($groupid);
        $awardconfig = [];
        foreach (configdata_pve_map_boss_awarditem_setting::data() as $value) {
            if ($value [configdata_pve_map_boss_awarditem_setting::k_groupid] === $groupid) {
                $awardconfig [$value [configdata_pve_map_boss_awarditem_setting::k_id]] = $value;
            }
        }
        return $awardconfig;
    }

    /**
     * 关卡开启记录
     *
     * @var string
     */
    const DBKey_stageopenrecord = "stageopenrecord";

    /**
     * 获取 关卡开启记录
     */
    public function get_stageopenrecord()
    {
        return $this->getdata(self::DBKey_stageopenrecord);
    }

    /**
     * 设置 关卡开启记录
     *
     * @param unknown $value
     */
    private function set_stageopenrecord($value)
    {
        // $value = strval ( $value );
        $this->setdata(self::DBKey_stageopenrecord, $value);
    }

    /**
     * 设置 关卡开启记录 默认值
     */
    protected function _set_defaultvalue_stageopenrecord()
    {
        $this->set_defaultkeyandvalue(self::DBKey_stageopenrecord, array(
            '1' => 0,
            '10001' => 0
        ));
    }

    /**
     * 门票信息
     *
     * @var string
     */
    const DBKey_ticketinfo = "ticketinfo";

    /**
     * 获取 门票信息
     */
    public function get_ticketinfo()
    {
        return $this->getdata(self::DBKey_ticketinfo);
    }

    /**
     * 获取 门票信息
     *
     * @return dbs_pve_data_ticket
     */
    public function get_ticketinfo_data()
    {
        $data = new dbs_pve_data_ticket ();
        $data->fromArray($this->get_ticketinfo());
        return $data;
    }

    /**
     * 设置 门票信息
     *
     * @param unknown $value
     */
    public function set_ticketinfo($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_ticketinfo, $value);
    }

    /**
     * 设置 门票信息 默认值
     */
    protected function _set_defaultvalue_ticketinfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_ticketinfo, (new dbs_pve_data_ticket ())->toArray());
    }

    /**
     * 地图信息
     *
     * @var string
     */
    const DBKey_mapinfo = "mapinfo";

    /**
     * 获取 地图信息
     */
    public function get_mapinfo()
    {
        return $this->getdata(self::DBKey_mapinfo);
    }

    /**
     * 获取地图信息
     *
     * @param unknown $mapid
     * @return dbs_pve_data_map
     */
    public function get_mapinfo_data($mapid)
    {
        $mapinfos = $this->get_mapinfo();
        $mapdata = new dbs_pve_data_map ();
        $mapdata->set_mapid($mapid);
        if (isset ($mapinfos [$mapid])) {
            $mapdata->fromArray($mapinfos [$mapid]);
        }
        return $mapdata;
    }

    /**
     * 设置 地图信息
     *
     * @param unknown $value
     */
    private function set_mapinfo($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_mapinfo, $value);
    }

    /**
     * 设置地图数据
     *
     * @param dbs_pve_data_map $data
     */
    public function set_mapinfo_data(dbs_pve_data_map $data)
    {
        $mapinfos = $this->get_mapinfo();
        $mapinfos [$data->get_mapid()] = $data->toArray();
        $this->set_mapinfo($mapinfos);
    }

    /**
     * 设置 地图信息 默认值
     */
    protected function _set_defaultvalue_mapinfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_mapinfo, array());
    }

    /**
     * 关卡信息
     *
     * @var string
     */
    const DBKey_stageinfos = "stageinfos";

    /**
     * 获取 关卡信息
     */
    public function get_stageinfos()
    {
        return $this->getdata(self::DBKey_stageinfos);
    }

    /**
     * 设置 关卡信息
     *
     * @param unknown $value
     */
    private function set_stageinfos($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_stageinfos, $value);
    }

    /**
     * 设置 关卡信息 默认值
     */
    protected function _set_defaultvalue_stageinfos()
    {
        $this->set_defaultkeyandvalue(self::DBKey_stageinfos, array());
    }

    private function set_stageinfo(dbs_pve_data_mapstageinfo $data)
    {
        $infos = $this->get_stageinfos();
        $infos [$data->get_stageid()] = $data->toArray();
        $this->set_stageinfos($infos);
    }

    /**
     * 获取关卡信息
     *
     * @param unknown $stageid
     * @return NULL|dbs_pve_data_mapstageinfo
     */
    private function get_stageinfo($stageid)
    {
        $info = null;
        $infos = $this->get_stageinfos();
        if (isset ($infos [$stageid])) {
            $info = new dbs_pve_data_mapstageinfo ();
            $info->fromArray($infos [$stageid]);
        } else {
            $info = dbs_pve_data_mapstageinfo::createwithconfig($stageid);
        }
        return $info;
    }

    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "pve_map";

    function __construct()
    {
        parent::__construct(self::DBKey_tablename, array(), array());
    }

    /**
     * 关卡是否已经通过
     *
     * @param unknown $stageid
     */
    private function get_stage_passed($stageid)
    {
        $battlerecord = $this->get_stageinfos();

        return isset ($battlerecord [$stageid]);
    }

    /**
     *
     * @param unknown $stageid
     * @return number|null
     */
    private function get_prev_stageid($stageid)
    {
        $config = self::get_stage_conf($stageid);
        if (empty ($config)) {
            return null;
        }
        if (isset ($config [configdata_pve_map_setting::k_needopenstageid])) {
            return intval($config [configdata_pve_map_setting::k_needopenstageid]);
        }
        return null;
    }

    /**
     * 获取掉落物品
     *
     * @param unknown $groupid
     * @return multitype:multitype:string
     */
    private static function get_dropitems_group($groupid)
    {
        $groupid = strval($groupid);
        $dropitems = array();
        $datas = configdata_pve_awarditem_setting::data();
        foreach ($datas as $data) {
            if ($data [configdata_pve_awarditem_setting::k_groupid] == $groupid) {
                $dropitems [$data [configdata_pve_awarditem_setting::k_id]] = $data;
            }
        }
        return $dropitems;
    }

    /**
     * 通过地图id获取掉落
     *
     * @param unknown $stageid
     */
    public static function get_dropitems_group_by_stageid($stageid)
    {
        $stageconfig = self::get_stage_conf($stageid);
        if (is_null($stageconfig) || !isset ($stageconfig [configdata_pve_map_setting::k_awarditem])) {
            return null;
        }
        return self::get_dropitems_group($stageconfig [configdata_pve_map_setting::k_awarditem]);
    }

    private function update_battletimes()
    {
        $days = $this->db_owner->dbs_userkvstore()->getvalue(constants_globalkey::PLAYER_PVE_BATTLE_TIMES_DAY_FLAG, 0);
        if ($days == Common_Util_Time::getGameDay()) {
            return;
        }
        $this->db_owner->dbs_userkvstore()->setvalue(constants_globalkey::PLAYER_PVE_BATTLE_TIMES_DAY_FLAG, Common_Util_Time::getGameDay());

        $stageinfos = $this->get_stageinfos();
        foreach ($stageinfos as $stageid => $stageinfo) {
            $stagedata = new dbs_pve_data_mapstageinfo ();
            $stagedata->fromArray($stageinfo);
            $stagedata->restorebattletimes();
            $stagedata->set_dailyrestoretimes(0);
            $stageinfos [$stageid] = $stagedata->toArray();
        }
        $this->set_stageinfos($stageinfos);
    }

    /**
     * 翻牌子关卡
     *
     * @param string $stageid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    private function battlebossstage($stageid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_map_battleboss{}

        $config = self::get_pve_boss_config($stageid);
        if (is_null($config)) {
            $retCode = err_dbs_pve_map_battlebossstage::BOSS_CONF_ERROR;
            $retCode_Str = 'BOSS_CONF_ERROR';
            goto failed;
        }
        // code

        $stagebattlepower = intval($config [configdata_pve_map_boss_stage_setting::k_battlepower]);

        // 计算自己所有厨师的战斗力
        $selfbattlepower = $this->db_owner->dbs_chef_list()->get_all_battlepowers();

        // 计算好友战斗力
        $key = constants_memcachekey::DBKey_Pve_Map_Invite_Friend . $this->get_userid();
        $memObj = Common_Db_memcacheObject::create($key);
        if ($memObj->has_value()) {
            $invitechefdata = new dbs_pve_data_invitechef ();
            $invitechefdata->fromArray($memObj->get_value());

            $friendbattlepower = $invitechefdata->get_battlepower1($this->db_owner) + $invitechefdata->get_battlepower2($this->db_owner);
            $friendaddpercent = Common_Util_Configdata::getInstance()->get_global_config_value('PVE_INVITE_FRIEND_ADD_BATTLEPOWER_PERCENT')->float_value() / 10000;
            $friendbattlepower = $friendbattlepower * $friendaddpercent;
            $selfbattlepower += $friendbattlepower;

            // 删除助战数据
            $memObj->del_value();
        }

        $selfbattlepower = ceil($selfbattlepower);

        $S_stagebattlepower = $stagebattlepower * Common_Util_Configdata::getInstance()->get_global_config_value('PVE_BOSS_GRADE_S')->float_value() / 10000;
        $A_stagebattlepower = $stagebattlepower * Common_Util_Configdata::getInstance()->get_global_config_value('PVE_BOSS_GRADE_A')->float_value() / 10000;
        $B_stagebattlepower = $stagebattlepower * Common_Util_Configdata::getInstance()->get_global_config_value('PVE_BOSS_GRADE_B')->float_value() / 10000;
        $F_stagebattlepower = $stagebattlepower * Common_Util_Configdata::getInstance()->get_global_config_value('PVE_BOSS_GRADE_F')->float_value() / 10000;

        // dump ( $stagebattlepower );
        // dump ( $S_stagebattlepower );
        // dump ( $A_stagebattlepower );
        // dump ( $B_stagebattlepower );
        // dump ( $F_stagebattlepower );
        // dump ( $selfbattlepower );

        $grade = constants_pvegrade::GRADE_F;
        if ($selfbattlepower >= $S_stagebattlepower) {
            $grade = constants_pvegrade::GRADE_S;
        } elseif ($selfbattlepower >= $A_stagebattlepower) {
            $grade = constants_pvegrade::GRADE_A;
        } elseif ($selfbattlepower >= $B_stagebattlepower) {
            $grade = constants_pvegrade::GRADE_B;
        } else {
            $grade = constants_pvegrade::GRADE_F;
        }

        $data [constants_returnkey::RK_PVE_GRADE] = $grade;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 领取boss关奖励
     *
     * @param unknown $stageid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    private function awardbossstage($stageid, $battlegrade)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_map_awardbossstage{}

        $config = self::get_pve_boss_config($stageid);
        if (is_null($config)) {
            $retCode = err_dbs_pve_map_awardbossstage::BOSS_CONF_ERROR;
            $retCode_Str = 'BOSS_CONF_ERROR';
            goto failed;
        }

        if ($battlegrade != constants_pvegrade::GRADE_F) {

            // 奖励道具
            $awarditems = [];
            for ($i = 0; $i < 4; $i++) {
                $key_award = 'award_' . $i;
                if (isset ($config [$key_award])) {
                    $key_award_percent = 'award_percent_' . $i;
                    $award_percent = intval($config [$key_award_percent]);
                    $random = mt_rand(0, 10000);
                    if ($random <= $award_percent) {
                        $awardgroupid = $config [$key_award];
                        // 奖励组id
                        $awardconfigs = self::get_pve_boss_awards($awardgroupid);
                        $weights = [];
                        foreach ($awardconfigs as $key => $value) {
                            $weights [$key] = intval($value [configdata_pve_map_boss_awarditem_setting::k_weight]);
                        }
                        // 奖励id
                        $awardid = Common_Util_Random::RandomWithWeight($weights);
                        $awardconfig = $awardconfigs [$awardid];

                        // 奖励道具
                        $awarditemid = $awardconfig [configdata_pve_map_boss_awarditem_setting::k_itemid];
                        // 奖励数量
                        $awarditemcount = $awardconfig [configdata_pve_map_boss_awarditem_setting::k_itemcount];

                        $awarditems [$awarditemid] = $awarditemcount;
                    }
                }
            }
            $data [constants_returnkey::RK_ITEMS] = $awarditems;
        }

        // 奖励游戏币
        $stageconfig = self::get_stage_conf($stageid);
        $awardgamecoin = intval($stageconfig [configdata_pve_map_setting::k_ticket]) * intval($config [configdata_pve_map_boss_stage_setting::k_awardgamecoinadd]);
        $data [constants_returnkey::RK_GAMECOIN] = $awardgamecoin;
        // 失败获取游戏币减半
        if ($battlegrade == constants_pvegrade::GRADE_F) {
            $data [constants_returnkey::RK_GAMECOIN] = intval($awardgamecoin / 2);
        }

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 刷地图,单次
     *
     * @param unknown $stageid
     * @return Common_Util_ReturnVar
     */
    function battle($stageid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_map_battle{}

        $stageid = strval($stageid);
        $stageconf = self::get_stage_conf($stageid);
        if (is_null($stageconf)) {
            $retCode = err_dbs_pve_map_battle::STAGE_CONF_ERROR;
            $retCode_Str = 'STAGE_CONF_ERROR';
            goto failed;
        }

        // 关卡开启状态
        $stageopenrecord = $this->get_stageopenrecord();
        // 是否是噩梦模式
        $hardmode = $stageconf [configdata_pve_map_setting::k_level] == '1';
        // 是否是boss模式
        $boss = $stageconf [configdata_pve_map_setting::k_stagetype] == constants_pvestagetype::TYPE_BOSS;

        $mapid = $stageconf [configdata_pve_map_setting::k_mapid];
        // 关卡类型
        $stagetype = $stageconf [configdata_pve_map_setting::k_stagetype];

        if ($hardmode) {
            // 检测对应的普通关是否通过
            $normalstageid = intval($stageid) % 10000;

            if (!$this->get_stage_passed($normalstageid)) {
                $retCode = err_dbs_pve_map_battle::STAGE_NOT_OPEN;
                $retCode_Str = 'STAGE_NOT_OPEN';
                goto failed;
            }

            // 检测上一个英雄关是否通过
            $prevstageid = $this->get_prev_stageid($stageid);

            if (empty ($prevstageid)) {
                // 噩梦模式第一关
                if (!isset ($stageopenrecord [$stageid])) {
                    $retCode = err_dbs_pve_map_battle::STAGE_NOT_OPEN;
                    $retCode_Str = 'STAGE_NOT_OPEN';
                    goto failed;
                }
            } else {

                if (!$this->get_stage_passed($prevstageid)) {
                    $retCode = err_dbs_pve_map_battle::STAGE_NOT_OPEN;
                    $retCode_Str = 'STAGE_NOT_OPEN';
                    goto failed;
                }
            }
        } else {
            if (!isset ($stageopenrecord [$stageid])) {
                $retCode = err_dbs_pve_map_battle::STAGE_NOT_OPEN;
                $retCode_Str = 'STAGE_NOT_OPEN';
                goto failed;
            }
        }

        // 门票是否充足

        $needtickets = intval($stageconf [configdata_pve_map_setting::k_ticket]);
        $ticketinfo = $this->get_ticketinfo_data();
        if ($needtickets > $ticketinfo->get_num()) {
            $retCode = err_dbs_pve_map_battle::TICKET_NOT_ENOUGH;
            $retCode_Str = 'TICKET_NOT_ENOUGH';
            goto failed;
        }

        // 是否可以打
        $stageinfo = $this->get_stageinfo($stageid);
        if (!$stageinfo->canattack()) {
            $retCode = err_dbs_pve_map_battle::CANNOT_ATTACK;
            $retCode_Str = 'CANNOT_ATTACK';
            goto failed;
        }

        // 仓库满了
        // if (dbs_warehouse::warehouse_normal_is_full ( $this->db_owner )) {
        // $retCode = err_dbs_pve_map_battle::WAREHOUSE_FULL;
        // $retCode_Str = 'WAREHOUSE_FULL';
        // goto failed;
        // }

        // pk....

        if ($stagetype == constants_pvestagetype::TYPE_NORMAL) {
            $battleresult_grade = constants_pvegrade::GRADE_S;
        } elseif ($stagetype == constants_pvestagetype::TYPE_BOSS) {
            $ret = $this->battlebossstage($stageid);
            if ($ret->is_failed()) {
                $retCode = err_dbs_pve_map_battle::CANNOT_ATTACK;
                $retCode_Str = 'CANNOT_ATTACK';
                goto failed;
            }
            $battleresult_grade = $ret->get_retdata() [constants_returnkey::RK_PVE_GRADE];

            // goto succ;
        } else {
            // 老虎机默认为S
            $battleresult_grade = constants_pvegrade::GRADE_S;
        }

        // $battleresult_grade = constants_pvegrade::GRADE_F;

        // 是否过关
        $passed = ($battleresult_grade != constants_pvegrade::GRADE_F);

        if (!$passed) {
            // 失败
            $needtickets = $needtickets / 2;
        }
        // 扣除门票
        $ticketinfo->costticket($needtickets);
        $this->set_ticketinfo($ticketinfo->toArray());

        // 原始的战斗记录
        $old_grade = $stageinfo->get_bestgrade();
        // 记录战斗结果
        $stageinfo->set_battle_grade($battleresult_grade);
        $stageinfo->attack(1);
        // 发放奖励物品

        $awards = array();

        if ($stagetype == constants_pvestagetype::TYPE_CARD) {
            // 翻牌子
            $this->db_owner->dbs_pve_rollcard()->create_rollcard($stageid);

            $ret = $this->db_owner->dbs_pve_rollcard()->roll();

            if ($ret->is_failed()) {
                return $ret;
            }
            $retdata = $ret->get_retdata();
            // dump ( $retdata );
            $awardinfo = $retdata [constants_returnkey::RK_AWARD];
            // 奖励道具
            $awarditems = [];
            $awarditems [$awardinfo [dbs_pve_data_rollcardrollinfo::DBKey_awarditemid]] = $awardinfo [dbs_pve_data_rollcardrollinfo::DBKey_awarditemcount];
            $awards [constants_returnkey::RK_ITEMS] = $awarditems;

            $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_97, 1);
//			$this->db_owner->db_mission ()->set_mission_object_type_count ( constants_mission::MISSION_FINISH_CONDITION_100, $awardinfo [dbs_pve_data_rollcardrollinfo::DBKey_awarditemid], $awardinfo [dbs_pve_data_rollcardrollinfo::DBKey_awarditemcount] );
        } elseif ($stagetype == constants_pvestagetype::TYPE_NORMAL_SLOT_MACHINE) {
            // 关闭翻牌子
            $this->db_owner->dbs_pve_rollcard()->dispose_rollcard();
            // 普通老虎机

            // 发放物品
            $dropitems = self::get_dropitems_group($stageconf [configdata_pve_map_setting::k_awarditem]);
            if (empty ($dropitems)) {
                $retCode = err_dbs_pve_map_battle::DROP_ITEM_CONFIG_ERROR;
                $retCode_Str = 'DROP_ITEM_CONFIG_ERROR';
                goto failed;
            }
            $weight = array();
            foreach ($dropitems as $id => $dropitem) {
                $weight [$id] = intval($dropitem [configdata_pve_awarditem_setting::k_weight]);
            }
            // dump ( $weight );
            $dropid = Common_Util_Random::RandomWithWeight($weight);
            $dropconfig = $dropitems [$dropid];

            $itemid = $dropconfig [configdata_pve_awarditem_setting::k_itemid];
            $itemcount = intval($dropconfig [configdata_pve_awarditem_setting::k_itemcount]);
            // 奖励道具
            $awarditems = array(
                $itemid => $itemcount
            );
            $awards [constants_returnkey::RK_ITEMS] = $awarditems;

            $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_95, 1);
        } elseif ($stagetype == constants_pvestagetype::TYPE_SUPER_SLOT_MACHINE) {
            // 关闭翻牌子
            $this->db_owner->dbs_pve_rollcard()->dispose_rollcard();

            // 超级老虎机

            $awardids = dbs_pve_data_superslotmachine::get_awardids('0_0_1');
            $awardid = Common_Util_Random::RandomWithWeight($awardids);
            $awardconfig = dbs_pve_data_superslotmachine::get_awarditems($awardid);
            $awarditems = array(
                $awardconfig [configdata_pve_map_super_slot_machine_award_setting::k_itemid] => intval($awardconfig [configdata_pve_map_super_slot_machine_award_setting::k_itemcount])
            );

            $awards [constants_returnkey::RK_ITEMS] = $awarditems;

            // 增加到老虎机
            $slotmachine = dbs_pve_data_superslotmachine::create($this->get_userid(), $stageid, $awardid);

            $this->db_owner->dbs_pve_superslotmachine()->addslotmachine($slotmachine);

            $awards [constants_returnkey::RK_SLOTMACHINE] = $slotmachine->toArray();

            $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_96, 1);
        } elseif ($stagetype == constants_pvestagetype::TYPE_BOSS) {
            // 关闭翻牌子
            $this->db_owner->dbs_pve_rollcard()->dispose_rollcard();
            // boss关

            $ret = $this->awardbossstage($stageid, $battleresult_grade);

            if ($ret->is_failed()) {
                goto succ;
            }
            $awards = $ret->get_retdata();
        } else {
            // 关闭翻牌子
            $this->db_owner->dbs_pve_rollcard()->dispose_rollcard();
        }

        // 只有boss关计算地图成就点数
        if ($stagetype == constants_pvestagetype::TYPE_BOSS) {

            if ($battleresult_grade > $old_grade) {
                // 增加成就点数
                $mappoints = array();
                $mappoints [constants_pvegrade::GRADE_S] = Common_Util_Configdata::getInstance()->get_global_config_value('PVE_GRADE_S_POINT')->int_value();
                $mappoints [constants_pvegrade::GRADE_A] = Common_Util_Configdata::getInstance()->get_global_config_value('PVE_GRADE_A_POINT')->int_value();
                $mappoints [constants_pvegrade::GRADE_B] = Common_Util_Configdata::getInstance()->get_global_config_value('PVE_GRADE_B_POINT')->int_value();
                $mappoints [constants_pvegrade::GRADE_F] = Common_Util_Configdata::getInstance()->get_global_config_value('PVE_GRADE_F_POINT')->int_value();

                $addmappoints = $mappoints [$battleresult_grade] - $mappoints [$old_grade];

                $mapinfo = $this->get_mapinfo_data($mapid);
                if ($hardmode) {
                    $mapinfo->add_hardmappoints($addmappoints);
                } else {
                    $mapinfo->add_normalmappoints($addmappoints);
                }
                $this->set_mapinfo_data($mapinfo);

//                $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_101, $addmappoints);
            }
        }

        // 发游戏币
        $gamecoin = 0;
        if (isset ($awards [constants_returnkey::RK_GAMECOIN])) {
            $gamecoin = $awards [constants_returnkey::RK_GAMECOIN];
            $this->db_owner->db_role()->add_gamecoin($gamecoin, constants_moneychangereason::BATTLE_PVE);
        }

        // 发钻石
        $diamond = 0;
        if (isset ($awards [constants_returnkey::RK_DIAMOND])) {
            $diamond = $awards [constants_returnkey::RK_DIAMOND];
            $this->db_owner->db_role()->add_diamond($diamond, constants_moneychangereason::BATTLE_PVE);
        }

        // 发灵感泡泡
        if (isset ($awards [constants_returnkey::RK_EXP]) && $awards [constants_returnkey::RK_EXP] != 0) {
            $expitemid = Common_Util_Configdata::getInstance()->get_global_config_value('CHEF_TRAIN_ITEM_ID')->string_value();
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $expitemid);
            $warehouse->addItemByItemId($expitemid, $awards [constants_returnkey::RK_EXP], true);
        }

        // 发道具
        if (isset ($awards [constants_returnkey::RK_ITEMS])) {
            $awarditems = $awards [constants_returnkey::RK_ITEMS];
            foreach ($awarditems as $itemid => $itemcount) {
                if (dbs_item::is_gamecoin($itemid)) {
                    $this->db_owner->db_role()->add_gamecoin($gamecoin, constants_moneychangereason::BATTLE_PVE_FROM_ITEM);
                } else if (dbs_item::is_diamond($itemid)) {
                    $this->db_owner->db_role()->add_diamond($gamecoin, constants_moneychangereason::BATTLE_PVE_FROM_ITEM);
                } else {
                    // dump ( $itemid );
                    $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);
                    $warehouse->addItemByItemId($itemid, $itemcount, true);
                }
            }
        }

        // 记录新开启的关卡

        if ($stageopenrecord [$stageid] == 0) {
            // 本关第一次通过

            // 标记本关已经通过
            $stageopenrecord [$stageid] = 1;

            // 标记新关可以打
            if (isset ($stageconf [configdata_pve_map_setting::k_nextstageid])) {
                $nextstageid = $stageconf [configdata_pve_map_setting::k_nextstageid];
                $stageopenrecord [$nextstageid] = 0;
            }
            $this->set_stageopenrecord($stageopenrecord);
        }

        // dump ( $stageinfo->toArray () );
        $this->set_stageinfo($stageinfo);

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_93, 1);
        $this->db_owner->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_94, $stageid, 1);

        // 战斗评级
        $data [constants_returnkey::RK_PVE_GRADE] = $battleresult_grade;
        // 发放物品
        $data [constants_returnkey::RK_AWARD] = $awards;

        $data [constants_returnkey::RK_COST_TICKETS] = $needtickets;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 战斗邀请好友厨师
     *
     * @param string $selfchefid1
     * @param string $frienduserid1
     * @param string $friendchefid1
     * @param string $selfchefid2
     * @param string $frienduserid2
     * @param string $friendchefid2
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function battleinvitefriendchef($selfchefid1 = '', $frienduserid1 = '', $friendchefid1 = '', $selfchefid2 = '', $frienduserid2 = '', $friendchefid2 = '')
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_map_battleinvitefriendchef{}

        $key = constants_memcachekey::DBKey_Pve_Map_Invite_Friend . $this->get_userid();
        $memObj = Common_Db_memcacheObject::create($key);
        $memObj->setExpiration(30);
        $invitedata = new dbs_pve_data_invitechef ();
        $invitedata->set_selfchefid1($selfchefid1);
        $invitedata->set_frienduserid1($frienduserid1);
        $invitedata->set_friendchefid1($friendchefid1);
        $invitedata->set_selfchefid2($selfchefid2);
        $invitedata->set_frienduserid2($frienduserid2);
        $invitedata->set_friendchefid2($friendchefid2);

        $memObj->set_value($invitedata->toArray());

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 恢复地图的战斗次数
     *
     * @param unknown $stageid
     * @return Common_Util_ReturnVar
     */
    function restorestagebattletimes($stageid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_map_restorestagebattletimes{}

        if (!$this->get_stage_passed($stageid)) {
            $retCode = err_dbs_pve_map_restorestagebattletimes::STAGE_NOT_OPEN;
            $retCode_Str = 'STAGE_NOT_OPEN';
            goto failed;
        }

        $stageconf = self::get_stage_conf($stageid);
        if (is_null($stageconf)) {
            $retCode = err_dbs_pve_map_restorestagebattletimes::STAGE_CONF_ERROR;
            $retCode_Str = 'STAGE_CONF_ERROR';
            goto failed;
        }

        // 是否是boss模式
        $boss = $stageconf [configdata_pve_map_setting::k_stagetype] == constants_pvestagetype::TYPE_BOSS;
        if (!$boss) {
            $retCode = err_dbs_pve_map_restorestagebattletimes::STAGE_NOT_BOSS_STAGE;
            $retCode_Str = 'STAGE_NOT_BOSS_STAGE';
            goto failed;
        }

        $stageinfo = $this->get_stageinfo($stageid);

        if ($stageinfo->get_battletimes() != 0) {
            $retCode = err_dbs_pve_map_restorestagebattletimes::BATTLE_TIME_NOT_ZERO;
            $retCode_Str = 'BATTLE_TIME_NOT_ZERO';
            goto failed;
        }

        $restoretimes = $stageinfo->get_dailyrestoretimes();
        $restoretimesmax = $this->db_owner->dbs_vip()->get_pve_daily_times_recharge_count();
        if ($restoretimes >= $restoretimesmax) {
            $retCode = err_dbs_pve_map_restorestagebattletimes::RESTORE_TIMES_MAX;
            $retCode_Str = 'RESTORE_TIMES_MAX';
            goto failed;
        }

        $restoretimes = $restoretimes + 1;
        // 钻石不足
        $restoreconf = self::get_stage_restore_config($restoretimes);
        $diamond = intval($restoreconf [configdata_pve_attacktime_recharge_setting::k_needdiamonds]);
        if ($diamond > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_pve_map_restorestagebattletimes::NOT_ENOUHG_DIAMOND;
            $retCode_Str = 'NOT_ENOUHG_DIAMOND';
            goto failed;
        }

        // 恢复次数
        $stageinfo->set_dailyrestoretimes($restoretimes);
        $stageinfo->restorebattletimes();
        $this->set_stageinfo($stageinfo);

        // 扣除钻石
        $this->db_owner->db_role()->cost_diamond($diamond, constants_moneychangereason::RESTORE_PVE_STAGE_BATTLE_TIMES);

        $data [constants_returnkey::RK_DIAMOND] = $diamond;
        $data [constants_returnkey::RK_STAGE_INFO] = $stageinfo->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 购买邀请卷
     *
     * @return Common_Util_ReturnVar
     */
    function buytickets()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_map_buytickets{}

        $ticketinfo = $this->get_ticketinfo_data();
        $addtickets = Common_Util_Configdata::getInstance()->get_global_config_value('PVE_TICKET_BUY_NUM')->int_value();
        $maxtickets = Common_Util_Configdata::getInstance()->get_global_config_value('PVE_TICKET_MAX')->int_value();

        if ($ticketinfo->get_num() + $addtickets >= $maxtickets) {
            $retCode = err_dbs_pve_map_buytickets::TICKETS_COUNT_MAX;
            $retCode_Str = 'TICKETS_COUNT_MAX';
            goto failed;
        }

        $buytimesmax = $this->db_owner->dbs_vip()->get_pve_daiky_ticket_buy_times();
        $buytimes = $ticketinfo->get_todaybuytickettimes();
        if ($buytimes >= $buytimesmax) {
            $retCode = err_dbs_pve_map_buytickets::BUY_TIMES_MAX;
            $retCode_Str = 'BUY_TIMES_MAX';
            goto failed;
        }

        $buyticketconf = self::get_ticket_buy_config($buytimes);
        $diamond = intval($buyticketconf [configdata_pve_ticket_buy_setting::k_needdiamonds]);
        if ($diamond > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_pve_map_buytickets::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        // 扣钱
        $this->db_owner->db_role()->cost_diamond($diamond, constants_moneychangereason::BUY_PVE_TICKETS);
        // 增加邀请卷
        $ticketinfo->buyticket($addtickets);

        $this->set_ticketinfo($ticketinfo->toArray());
        $data [constants_returnkey::RK_DIAMOND] = $diamond;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取地图奖励
     *
     * @param unknown $awardid
     * @return Common_Util_ReturnVar
     */
    function getmapaward($awardid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_pve_map_getmapaward{}

        $awardconfig = self::get_map_awards_config($awardid);
        if (is_null($awardconfig)) {
            $retCode = err_dbs_pve_map_getmapaward::AWARD_ID_ERROR;
            $retCode_Str = 'AWARD_ID_ERROR';
            goto failed;
        }

        $awardidarr = explode('_', $awardid);
        $mapid = $awardidarr [0];
        $mode = intval($awardidarr [1]);
        $order = $awardidarr [2];

        $mapinfo = $this->get_mapinfo_data($mapid);

        // dump ( $mapinfo );
        // 奖励已经领取
        if ($mapinfo->get_award_received($awardid)) {
            $retCode = err_dbs_pve_map_getmapaward::AWARD_ALEADY_RECEIVED;
            $retCode_Str = 'AWARD_ALEADY_RECEIVED';
            goto failed;
        }

        $needpoint = intval($awardconfig [configdata_pve_map_award_setting::k_point]);

        $mappoints = 0;
        if ($mode == 0) {
            $mappoints = $mapinfo->get_normalmappoints();
        } else {
            $mappoints = $mapinfo->get_hardmappoints();
        }
        if ($needpoint > $mappoints) {
            $retCode = err_dbs_pve_map_getmapaward::POINT_NOT_ENOUGH;
            $retCode_Str = 'POINT_NOT_ENOUGH';
            goto failed;
        }

        if (isset ($awardconfig [configdata_pve_map_award_setting::k_itemid])) {
            $itemid = $awardconfig [configdata_pve_map_award_setting::k_itemid];
            $itemcount = intval($awardconfig [configdata_pve_map_award_setting::k_itemcount]);
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);
            if (is_null($warehouse) || !$warehouse->testItemCanPut($itemid, $itemcount)) {
                $retCode = err_dbs_pve_map_getmapaward::WAREHOUSE_FULL;
                $retCode_Str = 'WAREHOUSE_FULL';
                goto failed;
            }
        }

        // 扣除点数
        $mappoints = $mappoints - $needpoint;
        if ($mode == 0) {
            $mapinfo->set_normalmappoints($mappoints);
        } else {
            $mapinfo->set_hardmappoints($mappoints);
        }

        // 标记奖励已经领取
        $mapinfo->mark_award_received($awardid);

        // 发放奖励
        $diamond = intval($awardconfig [configdata_pve_map_award_setting::k_awarddiamond]);
        $gamecoin = intval($awardconfig [configdata_pve_map_award_setting::k_awardgamecoin]);
        $this->db_owner->db_role()->add_gamecoin_and_diamonds($gamecoin, $diamond, constants_moneychangereason::RECV_PVE_MAP_AWARD);

        // 发放道具
        if (isset ($awardconfig [configdata_pve_map_award_setting::k_itemid])) {
            $itemid = $awardconfig [configdata_pve_map_award_setting::k_itemid];
            $itemcount = intval($awardconfig [configdata_pve_map_award_setting::k_itemcount]);

            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);
            if (!is_null($warehouse)) {
                $warehouse->addItemByItemId($itemid, $itemcount);
            }
        }
        // $itemid = $awardconfig

        $this->set_mapinfo_data($mapinfo);

//        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_102, 1);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    function masterbeforecall()
    {
        $ticketinfo = $this->get_ticketinfo_data();
        $datachange = $ticketinfo->computetickets($this->db_owner->db_restaurantinfo()->get_restaurantlevel());
        if ($datachange) {
            $this->set_ticketinfo($ticketinfo->toArray());
        }
        $datachange = $ticketinfo->nextday();
        if ($datachange) {
            $this->set_ticketinfo($ticketinfo->toArray());
        }

        $this->update_battletimes();
    }
}