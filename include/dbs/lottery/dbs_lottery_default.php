<?php

namespace dbs\lottery;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_lottery_award_setting;
use configdata\configdata_lottery_setting;
use constants\constants_mailTemplates;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\dbs_baseplayer;
use dbs\dbs_mission;
use dbs\dbs_warehouse;
use dbs\mailbox\dbs_mailbox_data;
use err\err_dbs_lottery_default_lotteryone;
use err\err_dbs_lottery_default_lotteryten;

/**
 * 十连抽数据服务
 * 2015年5月20日 下午8:05:51
 *
 * @author zhipeng
 *
 */
class dbs_lottery_default extends dbs_baseplayer
{
    /**
     * 获取抽奖配置
     *
     * @param unknown $id
     * @return Ambigous <multitype:, string>
     */
    static function get_lottery_config($id)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_lottery_setting::class, configdata_lottery_setting::k_id, $id);
    }

    /**
     * 单抽的总次数
     *
     * @var string
     */
    const DBKey_totallotteryone = "totallotteryone";

    /**
     * 获取单抽的总次数
     */
    public function get_totallotteryone()
    {
        return $this->getdata(self::DBKey_totallotteryone);
    }

    /**
     * 设置单抽的总次数
     *
     * @param unknown $totallotteryone
     */
    private function set_totallotteryone($totallotteryone)
    {
        $this->setdata(self::DBKey_totallotteryone, $totallotteryone);
    }

    /**
     * 设置单抽的总次数 默认值
     */
    protected function _set_defaultvalue_totallotteryone()
    {
        $this->set_defaultkeyandvalue(self::DBKey_totallotteryone, 0);
    }

    /**
     * 十连抽总次数
     *
     * @var string
     */
    const DBKey_totallotteryten = "totallotteryten";

    /**
     * 获取十连抽总次数
     */
    public function get_totallotteryten()
    {
        return $this->getdata(self::DBKey_totallotteryten);
    }

    /**
     * 设置十连抽总次数
     *
     * @param unknown $totallotteryten
     */
    private function set_totallotteryten($totallotteryten)
    {
        $this->setdata(self::DBKey_totallotteryten, $totallotteryten);
    }

    /**
     * 设置十连抽总次数 默认值
     */
    protected function _set_defaultvalue_totallotteryten()
    {
        $this->set_defaultkeyandvalue(self::DBKey_totallotteryten, 0);
    }

    /**
     * 单抽次数
     *
     * @var string
     */
    const DBKey_lotteryonefreetimes = "lotteryonefreetimes";

    /**
     * 获取单抽次数
     */
    public function get_lotteryonefreetimes()
    {
        return $this->getdata(self::DBKey_lotteryonefreetimes);
    }

    /**
     * 设置单抽次数
     *
     * @param unknown $lotteryonefreetimes
     */
    private function set_lotteryonefreetimes($lotteryonefreetimes)
    {
        $this->setdata(self::DBKey_lotteryonefreetimes, $lotteryonefreetimes);
    }

    /**
     * 设置单抽次数 默认值
     */
    protected function _set_defaultvalue_lotteryonefreetimes()
    {
        $this->set_defaultkeyandvalue(self::DBKey_lotteryonefreetimes, 1);
    }

    /**
     * 单抽免费次数冷却时间
     *
     * @var string
     */
    const DBKey_lotteryonefreetimescooldown = "lotteryonefreetimescooldown";

    /**
     * 获取单抽免费次数冷却时间
     */
    public function get_lotteryonefreetimescooldown()
    {
        return $this->getdata(self::DBKey_lotteryonefreetimescooldown);
    }

    /**
     * 设置单抽免费次数冷却时间
     *
     * @param unknown $lotteryonefreetimescooldown
     */
    private function set_lotteryonefreetimescooldown($lotteryonefreetimescooldown)
    {
        $this->setdata(self::DBKey_lotteryonefreetimescooldown, $lotteryonefreetimescooldown);
    }

    /**
     * 设置单抽免费次数冷却时间 默认值
     */
    protected function _set_defaultvalue_lotteryonefreetimescooldown()
    {
        $this->set_defaultkeyandvalue(self::DBKey_lotteryonefreetimescooldown, 0);
    }

    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "lottery_default";

    function __construct()
    {
        parent::__construct(self::DBKey_tablename);
    }

    /**
     * 获取抽奖威望
     *
     * @return number
     */
    private function get_lottery_reputation()
    {
        return $this->db_owner->dbs_recharge_player()->get_totalrechargemoney() * 1 + 100;
    }

    /**
     * 获取奖励物品
     *
     * @param unknown $groupid
     * @return multitype:multitype:string
     */
    private function get_lottery_awards($groupid)
    {
        $groupid = strval($groupid);
        $data = configdata_lottery_award_setting::data();
        $restaurantlevel = $this->db_owner->db_restaurantinfo()->get_restaurantlevel();
        $reputation = $this->get_lottery_reputation();

        $awarditems = array();

        foreach ($data as $awardconfig) {
            // 组id不一样
            if ($awardconfig [configdata_lottery_award_setting::k_groupid] != $groupid) {
                continue;
            }
            // 餐厅等级不足
            if (intval($awardconfig [configdata_lottery_award_setting::k_restaurantlevel]) > $restaurantlevel) {
                continue;
            }
            // 威望不够
            if (intval($awardconfig [configdata_lottery_award_setting::k_reputation]) > $reputation) {
                continue;
            }

            $awarditems [$awardconfig [configdata_lottery_award_setting::k_id]] = $awardconfig;
        }
        return $awarditems;
    }

    /**
     * 单抽
     *
     * @return Common_Util_ReturnVar
     */
    function lotteryone()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_lottery_default_lotteryone{}

        $lotteryconfig = self::get_lottery_config('1');
        $needdiamonds = 0;
        if ($this->get_lotteryonefreetimes() <= 0) {
            // 次数不足,在冷却中.//判断钻石是否充足
            $needdiamonds = intval($lotteryconfig [configdata_lottery_setting::k_diamond]);
        }
        // 钻石不足
        if ($this->db_owner->db_role()->get_diamond() < $needdiamonds) {
            $retCode = err_dbs_lottery_default_lotteryone::DIAMOND_NOT_ENOUGH;
            $retCode_Str = 'DIAMOND_NOT_ENOUGH';
            goto failed;
        }

        $lowweight = intval($lotteryconfig [configdata_lottery_setting::k_lotterylowawardweight]);
        $lowawardgroupid = intval($lotteryconfig [configdata_lottery_setting::k_lotterylowawardgroupid]);
        $highweight = intval($lotteryconfig [configdata_lottery_setting::k_lotteryhighawardweight]);
        $highawardgroupid = intval($lotteryconfig [configdata_lottery_setting::k_lotteryhighawardgroupid]);

        // 是否是首抽
        // 增加权重
        if ($this->get_totallotteryone() == 0) {
            $addweight = $this->db_owner->dbs_vip()->get_lottery_one_add_weight();
            $highweight = $addweight + $highweight;
        }

        // 奖励组id
        $awardgroupid = Common_Util_Random::RandomWithWeight(array(
            $lowawardgroupid => $lowweight,
            $highawardgroupid => $highweight
        ));

        $awarditems = $this->get_lottery_awards($awardgroupid);
        $randomawarditems = array();
        foreach ($awarditems as $id => $value) {
            $randomawarditems [$id] = intval($value [configdata_lottery_award_setting::k_weight]);
        }

        // dump ( $awarditems );

        // 最终奖励的物品配置id
        $awardid = Common_Util_Random::RandomWithWeight($randomawarditems);
        $awardconfig = $awarditems [$awardid];

        // 奖励的物品
        $awarditemid = $awardconfig [configdata_lottery_award_setting::k_itemid];
        $awarditemnum = intval($awardconfig [configdata_lottery_award_setting::k_itemcount]);

        // dump ( $awardconfig );
        // 扣钻石
        $this->db_owner->db_role()->cost_diamond($needdiamonds, constants_moneychangereason::LOTTERY_ONE);
        // 记录次数cd
        if ($this->get_lotteryonefreetimes() > 0) {
            $this->set_lotteryonefreetimes($this->get_lotteryonefreetimes() - 1);

            if ($this->get_lotteryonefreetimes() == 0) {
                // 开始cd
                $cdtime = intval($lotteryconfig [configdata_lottery_setting::k_cdtime]);
                // cd
                $this->set_lotteryonefreetimescooldown(time() + $cdtime);
            }
        }

        $this->set_totallotteryone($this->get_totallotteryone() + 1);

        // 发东西
        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $awarditemid);
        if (!is_null($warehouse)) {
            $warehouse->addItemByItemId($awarditemid, $awarditemnum, true);
        }

        // 发送固定奖励
        if (isset ($lotteryconfig [configdata_lottery_setting::k_awarditemid])) {

            $fixedawarditemid = $lotteryconfig [configdata_lottery_setting::k_awarditemid];
            $fixedawarditemcount = intval($lotteryconfig [configdata_lottery_setting::k_awarditemcount]);

            $fixedwarehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $fixedawarditemid);
            $fixedwarehouse->addItemByItemId($fixedawarditemid, $fixedawarditemcount, true);

            $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_32, $fixedawarditemcount);
        }

        $data [constants_returnkey::RK_ITEMID] = $awarditemid;
        $data [constants_returnkey::RK_NUM] = $awarditemnum;

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_27, 1);
        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_32, 1);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 十连抽
     *
     * @return Common_Util_ReturnVar
     */
    function lotteryten()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_lottery_default_lotteryten{}

        $lotteryconfig = self::get_lottery_config("2");
        $needdiamonds = 0;
        $needdiamonds = intval($lotteryconfig [configdata_lottery_setting::k_diamond]);

        // 钻石不足
        if ($this->db_owner->db_role()->get_diamond() < $needdiamonds) {
            $retCode = err_dbs_lottery_default_lotteryten::DIAMOND_NOT_ENOUGH;
            $retCode_Str = 'DIAMOND_NOT_ENOUGH';
            goto failed;
        }

        $lowweight = intval($lotteryconfig [configdata_lottery_setting::k_lotterylowawardweight]);
        $lowawardgroupid = intval($lotteryconfig [configdata_lottery_setting::k_lotterylowawardgroupid]);
        $highweight = intval($lotteryconfig [configdata_lottery_setting::k_lotteryhighawardweight]);
        $highawardgroupid = intval($lotteryconfig [configdata_lottery_setting::k_lotteryhighawardgroupid]);

        // 最少获得的高级物品数量
        $min_high_num = Common_Util_Configdata::getInstance()->get_global_config_value('LOTTERY_TEN_MIN_GIFT_NUM')->int_value();
        // 最多获得的高级物品数量
        $max_high_num = Common_Util_Configdata::getInstance()->get_global_config_value('LOTTERY_TEN_MAX_GIFT_NUM')->int_value();

        // 是否是首抽
        // 增加权重
        if ($this->get_totallotteryten() == 0) {
            // 最少获得的高级物品数量
            $min_high_num = Common_Util_Configdata::getInstance()->get_global_config_value('LOTTERY_TEN_FRIST_MIN_GIFT_NUM')->int_value();
            // 最多获得的高级物品数量
            $max_high_num = Common_Util_Configdata::getInstance()->get_global_config_value('LOTTERY_TEN_FRIST_MAX_GIFT_NUM')->int_value();
        }

        $weightarray = array();
        for ($i = $min_high_num; $i <= $max_high_num; $i++) {
            $weightarray [$i] = 1;
        }
        // dump ( $weightarray );
        $highnum = Common_Util_Random::RandomWithWeight($weightarray);
        // dump ( $highnum );

        $awardhighitemconfigs = $this->get_lottery_awards($highawardgroupid);
        $randomawardhighitemconfigs = array();
        foreach ($awardhighitemconfigs as $id => $value) {
            $randomawardhighitemconfigs [$id] = intval($value [configdata_lottery_award_setting::k_weight]);
        }
        // dump ( $randomawardhighitemconfigs );

        $awardlowitemconfigs = $this->get_lottery_awards($lowawardgroupid);
        $randomawardlowitemconfigs = array();
        foreach ($awardlowitemconfigs as $id => $value) {
            $randomawardlowitemconfigs [$id] = intval($value [configdata_lottery_award_setting::k_weight]);
        }
        // dump ( $randomawardlowitemconfigs );

        // 最终奖励物品
        $awarditems = array();

        for ($i = 0; $i < $highnum; $i++) {
            $awardconfigid = Common_Util_Random::RandomWithWeight($randomawardhighitemconfigs);
            $awardconfig = $awardhighitemconfigs [$awardconfigid];

            $awarditems [] = array(
                'itemid' => $awardconfig [configdata_lottery_award_setting::k_itemid],
                'num' => intval($awardconfig [configdata_lottery_award_setting::k_itemcount])
            );
        }

        for ($i = 0; $i < 10 - $highnum; $i++) {
            $awardconfigid = Common_Util_Random::RandomWithWeight($randomawardlowitemconfigs);
            $awardconfig = $awardlowitemconfigs [$awardconfigid];

            $awarditems [] = array(
                'itemid' => $awardconfig [configdata_lottery_award_setting::k_itemid],
                'num' => intval($awardconfig [configdata_lottery_award_setting::k_itemcount])
            );
        }

        // 扣钱
        $this->db_owner->db_role()->cost_diamond($needdiamonds, constants_moneychangereason::LOTTERY_TEN);
        // 记录次数
        $this->set_totallotteryten($this->get_totallotteryten() + 1);
        // 发放物品

        // 没有发出去的物品
        $leftItems = [];

        foreach ($awarditems as $item) {
            $itemId = $item ['itemid'];
            $num = $item ['num'];
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemId);
            if (!is_null($warehouse)) {
                if (!$warehouse->addItemByItemId($itemId, $num)) {
                    $leftItems [] = $item;
                }
            }
        }
        // 发邮件
        if (count($leftItems) > 0) {
            $mailData = dbs_mailbox_data::createWithStandardId(constants_mailTemplates::MAIL_RAFFLE_TEN_OFF_CAPACITY);

            foreach ($leftItems as $item) {
                $itemId = $item ['itemid'];
                $num = $item ['num'];
                $mailData->addAttachmentItem($itemId, $num);
            }
            $mailData->send($this->get_userid());

        }

        // 发送固定奖励

        if (isset ($lotteryconfig [configdata_lottery_setting::k_awarditemid])) {

            $fixedawarditemid = $lotteryconfig [configdata_lottery_setting::k_awarditemid];
            $fixedawarditemcount = intval($lotteryconfig [configdata_lottery_setting::k_awarditemcount]);

            $fixedwarehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $fixedawarditemid);
            $fixedwarehouse->addItemByItemId($fixedawarditemid, $fixedawarditemcount, true);
        }

        $data = $awarditems;

        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_26, 1);
        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_27, 10);
        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_32, 10);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    function masterbeforecall()
    {
        if ($this->get_lotteryonefreetimescooldown() != 0) {
            if (time() > $this->get_lotteryonefreetimescooldown()) {
                $this->set_lotteryonefreetimescooldown(0);
                $this->set_lotteryonefreetimes($this->get_lotteryonefreetimes() + 1);
            }
        }
    }
}