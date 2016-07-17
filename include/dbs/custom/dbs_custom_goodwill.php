<?php

namespace dbs\custom;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_npc_custom_setting;
use constants\constants_messagecmd;
use constants\constants_mission;
use constants\constants_returnkey;
use dbs\dbs_baseplayer;
use err\err_dbs_custom_goodwill_addgoodwillexp;
use err\err_dbs_custom_goodwill_getgoodwill;
use err\err_dbs_custom_goodwill_set_missionfinish;
use err\err_dbs_custom_goodwill_awardGoodwillLevelupPackage;
use dbs\dbs_warehouse;

/**
 * 顾客好感度
 *
 * @author zhipeng
 *
 */
class dbs_custom_goodwill extends dbs_baseplayer
{

    /**
     * 获取顾客配置
     *
     * @param unknown $npcid
     * @return Ambigous <multitype:, string>
     */
    static function get_customconfig($npcid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_npc_custom_setting::class, configdata_npc_custom_setting::k_id, $npcid);
    }

    /**
     * 好感度
     *
     * @var string
     */
    const DBKey_customgoodwills = "customgoodwills";

    /**
     * 获取好感度
     */
    public function get_customgoodwills()
    {
        return $this->getdata(self::DBKey_customgoodwills);
    }

    /**
     * 设置好感度
     *
     * @param unknown $value
     */
    private function set_customgoodwills($value)
    {
        $this->setdata(self::DBKey_customgoodwills, $value);
    }

    /**
     * 获取指定顾客好感度
     *
     * @param string $npcid
     * @return \dbs\custom\dbs_custom_goodwilldata
     */
    public function getCustomGoodwill($npcid)
    {
        $goodwill = new dbs_custom_goodwilldata ($npcid);
        $goodwills = $this->get_customgoodwills();
        if (isset ($goodwills [$npcid])) {

            $goodwill->fromArray($goodwills [$npcid]);
        }
        return $goodwill;
    }

    /**
     * 保存顾客好感度
     *
     * @param dbs_custom_goodwilldata $goodwill
     */
    private function setCustomGoodwill(dbs_custom_goodwilldata $goodwill)
    {
        $goodwills = $this->get_customgoodwills();
        $goodwills [$goodwill->get_npcid()] = $goodwill->toArray();
        $this->set_customgoodwills($goodwills);
    }

    /**
     *
     * @var string
     */
    const DBKey_tablename = "customgoodwill";

    function __construct()
    {
        parent::__construct('customgoodwill', array(
            self::DBKey_userid => '',
            self::DBKey_customgoodwills => array()
        ));
    }

    /**
     * 增加好感度经验
     *
     * @param string $npcid
     * @param int $exp
     * @return Common_Util_ReturnVar
     */
    function addgoodwillexp($npcid, $exp)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $npcid = strval($npcid);
        $exp = intval($exp);

        $customconfig = self::get_customconfig($npcid);
        if (is_null($customconfig)) {
            $retCode = err_dbs_custom_goodwill_addgoodwillexp::NPCID_ERROR;
            $retCode_Str = 'NPCID_ERROR';
            goto failed;
        }

        if ($customconfig [configdata_npc_custom_setting::k_hasgoodwill] != '1') {
            $retCode = err_dbs_custom_goodwill_addgoodwillexp::NPCID_NOT_HAS_GOODWILL;
            $retCode_Str = 'NPCID_NOT_HAS_GOODWILL';
            goto failed;
        }

        $customlist = $this->get_customgoodwills();
        $goodwilldata = new dbs_custom_goodwilldata ($npcid);
        if (array_key_exists($npcid, $customlist)) {
            $goodwilldata->fromArray($customlist [$npcid]);
        }
        // $goodwilldata->set_npcid ( $npcid );

        $ret = $goodwilldata->addexp($exp);
        if ($ret->is_succ()) {
            $customlist [$npcid] = $goodwilldata->toArray();
            $this->set_customgoodwills($customlist);

            $retdata = $ret->get_retdata();
            if (array_key_exists_faster(constants_returnkey::RK_UPGRADE, $retdata)) {
                $syncdata = $ret->get_retdata();
                $syncdata ['npc'] = $this->toArray();
                $this->db_owner->db_sync()->mark_sync(constants_messagecmd::S2C_CUSTOM_GOODWILLLEVELUP, $syncdata);

                // 统计等级大于5的美食家数量
                if (intval($goodwilldata->get_level() >= 5)) {
                    $customlist = $this->get_customgoodwills();
                    $fivestarcount = 0;
                    foreach ($customlist as $goodwillnpcid => $value) {
                        $customgoodwilldata = new dbs_custom_goodwilldata ($goodwillnpcid);
                        $customgoodwilldata->fromArray($value);
                        $customconfig = self::get_customconfig($goodwillnpcid);
                        if ($customconfig [configdata_npc_custom_setting::k_type] == '2' && $customgoodwilldata->get_level() >= 5) {
                            $fivestarcount++;
                        }
                    }
                    $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_15, $fivestarcount);
                }

                // 记录升级美食家
//				$this->db_owner->db_mission ()->set_mission_object ( constants_mission::MISSION_FINISH_CONDITION_73, $retdata [constants_returnkey::RK_LEVEL] );
            }
        }
        return $ret;

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 设置任务完成
     *
     * @param string $npcid
     * @return Common_Util_ReturnVar
     */
    function set_missionfinish($npcid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $npcid = strval($npcid);
        $customconfig = self::get_customconfig($npcid);
        if (is_null($customconfig)) {
            $retCode = err_dbs_custom_goodwill_set_missionfinish::NPCID_ERROR;
            $retCode_Str = 'NPCID_ERROR';
            goto failed;
        }

        if ($customconfig [configdata_npc_custom_setting::k_hasgoodwill] != '1') {
            $retCode = err_dbs_custom_goodwill_set_missionfinish::NPCID_NOT_HAS_GOODWILL;
            $retCode_Str = 'NPCID_NOT_HAS_GOODWILL';
            goto failed;
        }
        $customlist = $this->get_customgoodwills();
        $goodwilldata = new dbs_custom_goodwilldata ($npcid);
        if (array_key_exists($npcid, $customlist)) {
            $goodwilldata->fromArray($customlist [$npcid]);
        }

//        $goodwilldata->set_completelevelupmission(true);
        $customlist [$npcid] = $goodwilldata->toArray();
        $this->set_customgoodwills($customlist);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取npc好感度
     *
     * @param string $npcid
     * @return Common_Util_ReturnVar
     */
    function getgoodwill($npcid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        $npcid = strval($npcid);
        $customconfig = self::get_customconfig($npcid);

        if (is_null($customconfig)) {
            $retCode = err_dbs_custom_goodwill_getgoodwill::NPCID_ERROR;
            $retCode_Str = 'NPCID_ERROR';
            goto failed;
        }

        if ($customconfig [configdata_npc_custom_setting::k_hasgoodwill] != '1') {
            $retCode = err_dbs_custom_goodwill_getgoodwill::NPCID_NOT_HAS_GOODWILL;
            $retCode_Str = 'NPCID_NOT_HAS_GOODWILL';
            goto failed;
        }

        $customlist = $this->get_customgoodwills();
        $goodwilldata = new dbs_custom_goodwilldata ($npcid);
        if (array_key_exists($npcid, $customlist)) {
            $goodwilldata->fromArray($customlist [$npcid]);
        }

        $data = $goodwilldata->toArray();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 领取好感度升级礼包
     *
     * @param string $npcid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function awardGoodwillLevelupPackage($npcid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_custom_goodwill_awardGoodwillLevelupPackage{}

        $npcid = strval($npcid);
        $customconfig = self::get_customconfig($npcid);

        if (is_null($customconfig)) {
            $retCode = err_dbs_custom_goodwill_awardGoodwillLevelupPackage::NPCID_ERROR;
            $retCode_Str = 'NPCID_ERROR';
            goto failed;
        }
        if ($customconfig [configdata_npc_custom_setting::k_hasgoodwill] != '1') {
            $retCode = err_dbs_custom_goodwill_awardGoodwillLevelupPackage::NPCID_NOT_HAS_GOODWILL;
            $retCode_Str = 'NPCID_NOT_HAS_GOODWILL';
            goto failed;
        }

        $goodwill = $this->getCustomGoodwill($npcid);

        if (!$goodwill->canAwardLevelUpPackage()) {
            $retCode = err_dbs_custom_goodwill_awardGoodwillLevelupPackage::CANNOT_AWARD_PACKAGE;
            $retCode_Str = 'CANNOT_AWARD_PACKAGE';
            goto failed;
        }

        /**
         * 需要领取礼包的等级
         *
         * @var Ambiguous $awardLevel
         */
        $awardLevel = $goodwill->get_awardleveluppackage() + 1;
        $awardConfigKey = "";
        switch ($awardLevel) {
            case 2 :
                $awardConfigKey = configdata_npc_custom_setting::k_levelupawarditemid2;
                break;
            case 3 :
                $awardConfigKey = configdata_npc_custom_setting::k_levelupawarditemid3;
                break;
            case 4 :
                $awardConfigKey = configdata_npc_custom_setting::k_levelupawarditemid4;
                break;
            case 5 :
                $awardConfigKey = configdata_npc_custom_setting::k_levelupawarditemid5;
                break;
            default :
                ;
                break;
        }
        if (isset ($customconfig [$awardConfigKey])) {
            $awardItemId = $customconfig [$awardConfigKey];
            dbs_warehouse::additemtowarehouse($this->db_owner, $awardItemId, 1, true);

            $data [constants_returnkey::RK_ITEMID] = $awardItemId;
            $data [constants_returnkey::RK_ITEMCOUNT] = 1;
        }

        $goodwill->awardLevelUpPackage();
        $this->setCustomGoodwill($goodwill);
        $data [constants_returnkey::RK_GOODWILL_DATA] = $goodwill->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}