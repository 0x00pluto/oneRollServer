<?php

namespace dbs;

use Common\Util\Common_Util_Configdata;
use configdata\configdata_vip_function_setting;
use configdata\configdata_vip_upgrade_setting;
use dbs\vip\dbs_vip_data;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use Common\Util\Common_Util_ReturnVar;
use err\err_dbs_vip_awardviplevelupgift;

/**
 * vip服务
 *
 * @author zhipeng
 *
 */
class dbs_vip extends dbs_baseplayer
{
    /**
     * 获取vip功能开启
     *
     * @param unknown $viplevel
     * @return Ambigous <multitype:, string>
     */
    static public function get_function_config($viplevel)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_vip_function_setting::class, configdata_vip_function_setting::k_viplevel, $viplevel);
    }

    /**
     * 获取vip升级配置
     *
     * @param unknown $viplevel
     */
    static public function get_upgrade_config($viplevel)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_vip_upgrade_setting::class, configdata_vip_upgrade_setting::k_level, $viplevel);
    }

    /**
     * 获取自己的vip配置
     *
     * @return Ambigous
     */
    function get_current_vip_function_config()
    {
        return self::get_function_config($this->db_owner->db_role()->get_viplevel());
    }

    /**
     * 获取厨师恢复体力次数
     *
     * @return number
     */
    function get_chef_fillvitcount()
    {
        return intval($this->get_current_vip_function_config()[configdata_vip_function_setting::k_cheffillvittime]);
    }

    /**
     * 获取每日可以雇佣的厨师的最大次数
     *
     * @return number
     */
    function get_chef_hire_times()
    {
        return intval($this->get_current_vip_function_config()[configdata_vip_function_setting::k_chefhiretime]);
    }

    /**
     * 获取赠送装备的次数
     */
    function get_give_equipment_max_times()
    {
        return intval($this->get_current_vip_function_config()[configdata_vip_function_setting::k_givechefequipmenttimes]);
    }

    /**
     * 获取可以发红包的次数
     *
     * @param unknown $quality
     * @return number
     */
    function get_send_neighboorhoodgiftpackagetimes($quality)
    {
        $quality = intval($quality);
        $times = 0;
        switch ($quality) {
            case 1 :
                $times = $this->get_current_vip_function_config()[configdata_vip_function_setting::k_neighboorhood_send_gift_1];
                break;
            case 2 :
                $times = $this->get_current_vip_function_config()[configdata_vip_function_setting::k_neighboorhood_send_gift_2];
                break;
            case 3 :
                $times = $this->get_current_vip_function_config()[configdata_vip_function_setting::k_neighboorhood_send_gift_3];
                break;
        }

        $times = intval($times);
        return $times;
    }

    /**
     * 获取可以通过感谢获得的威望经验总值
     *
     * @return number
     */
    function get_neighboorhood_thanks_award_reputation_exp_max()
    {
        return intval($this->get_current_vip_function_config()[configdata_vip_function_setting::k_neighboorhood_thanks_award_reputation]);
    }

    /**
     * 获取单次抽奖增加的权重值
     *
     * @return number
     */
    function get_lottery_one_add_weight()
    {
        return intval($this->get_current_vip_function_config()[configdata_vip_function_setting::k_frist_lottery_add_weight]);
    }

    /**
     * 获取每日恢复推图次数的上线
     *
     * @return number
     */
    function get_pve_daily_times_recharge_count()
    {
        return intval($this->get_current_vip_function_config()[configdata_vip_function_setting::k_pve_daily_times_recharge_count]);
    }

    /**
     * 获取每日购买邀请卷的次数
     *
     * @return number
     */
    function get_pve_daiky_ticket_buy_times()
    {
        return intval($this->get_current_vip_function_config()[configdata_vip_function_setting::k_pve_daily_ticket_buy_times]);
    }

    /**
     * 获取超级老虎机的摇奖次数
     *
     * @return number
     */
    function get_super_slotmachine_rolltimes()
    {
        return intval($this->get_current_vip_function_config()[configdata_vip_function_setting::k_supermachine_rolltimes]);
    }

    /**
     * vip等级信息
     *
     * @var string
     */
    const DBKey_viplevelinfo = "viplevelinfo";

    /**
     * 获取vip等级信息
     */
    public function get_viplevelinfo()
    {
        return $this->getdata(self::DBKey_viplevelinfo);
    }

    /**
     * 设置vip等级信息
     *
     * @param unknown $viplevelinfo
     */
    private function set_viplevelinfo($viplevelinfo)
    {
        $this->setdata(self::DBKey_viplevelinfo, $viplevelinfo);
    }

    /**
     * 设置vip等级信息 默认值
     */
    protected function _set_defaultvalue_viplevelinfo()
    {

        $this->set_defaultkeyandvalue(self::DBKey_viplevelinfo, dbs_vip_data::dumpDefaultValue());
    }

    /**
     * vip礼包领取等级
     *
     * @var string
     */
    const DBKey_awardvipgiftlevel = "awardvipgiftlevel";

    /**
     * 获取vip礼包领取等级
     */
    public function get_awardvipgiftlevel()
    {
        return $this->getdata(self::DBKey_awardvipgiftlevel);
    }

    /**
     * 设置vip礼包领取等级
     *
     * @param unknown $awardviplevel
     */
    private function set_awardvipgiftlevel($awardvipgiftlevel)
    {
        $this->setdata(self::DBKey_awardvipgiftlevel, $awardvipgiftlevel);
    }

    /**
     * 设置vip礼包领取等级 默认值
     */
    protected function _set_defaultvalue_awardvipgiftlevel()
    {
        $this->set_defaultkeyandvalue(self::DBKey_awardvipgiftlevel, 0);
    }

    const DBKey_tablename = "vip";

    function __construct()
    {
        parent::__construct(self::DBKey_tablename, array(
            self::DBKey_userid => ''
        ));
    }

    /**
     * 增加vip经验
     *
     * @param int $exp
     * @return Common_Util_ReturnVar
     */
    public function addvipexp($exp)
    {
        $viplevel = new dbs_vip_data ();
        $viplevel->fromArray($this->get_viplevelinfo());

        $ret = $viplevel->addvipexp($exp);
        if ($ret->is_succ()) {
            $this->set_viplevelinfo($viplevel->toArray());
        }
    }

    /**
     * 获取vip等级
     *
     * @return number
     */
    public function get_viplevel()
    {
        $viplevel = new dbs_vip_data ();
        $viplevel->fromArray($this->get_viplevelinfo());

        return $viplevel->get_viplevel();
    }

    /**
     * 改变vip等级,并改变vip经验,一般不要使用,只做特殊调整使用
     *
     * @param unknown $newlevel
     */
    public function modify_viplevel($newlevel)
    {
        $viplevel = dbs_vip_data::create_with_array($this->get_viplevelinfo());
        if ($viplevel->set_level_force($newlevel)) {
            $this->set_viplevelinfo($viplevel->toArray());
        }
    }

    /**
     * 领取vip等级礼包
     *
     * @return Common_Util_ReturnVar
     */
    function awardviplevelupgift()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_vip_awardviplevel{}

        // code
        $viplevel = $this->get_viplevel();
        $awardviplevel = $this->get_awardvipgiftlevel();
        if ($awardviplevel >= $viplevel) {
            $retCode = err_dbs_vip_awardviplevelupgift::VIPLEVEL_NOT_ENOUGH;
            $retCode_Str = 'VIPLEVEL_NOT_ENOUGH';
            goto failed;
        }

        $awardviplevel++;

        $vipconfig = self::get_upgrade_config($awardviplevel);
        $awarditemid = $vipconfig [configdata_vip_upgrade_setting::k_awarditemid];
        $awarditemcount = intval($vipconfig [configdata_vip_upgrade_setting::k_awarditemcount]);

        $gamecoin = intval($vipconfig [configdata_vip_upgrade_setting::k_awardgamecoin]);
        $diamond = intval($vipconfig [configdata_vip_upgrade_setting::k_awarddiamond]);

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $awarditemid);
        if (!is_null($warehouse)) {
            $warehouse->addItemByItemId($awarditemid, $awarditemcount);
        }

        $this->db_owner->db_role()->add_gamecoin_and_diamonds($gamecoin, $diamond, constants_moneychangereason::AWARD_VIP_LEVEL_UP_GIFT);

        $data [constants_returnkey::RK_DIAMOND] = $diamond;
        $data [constants_returnkey::RK_GAMECOIN] = $gamecoin;
        $data [constants_returnkey::RK_ITEMID] = $awarditemid;
        $data [constants_returnkey::RK_NUM] = $awarditemcount;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}