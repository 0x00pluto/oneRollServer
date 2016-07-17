<?php

namespace dbs\scenebox;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use configdata\configdata_scene_box_award_setting;
use configdata\configdata_scene_box_setting;
use constants\constants_globalkey;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\dbs_baseplayer;
use dbs\dbs_item;
use dbs\dbs_player;
use dbs\dbs_warehouse;
use dbs\friend\dbs_friend_goodwill;
use dbs\robot\dbs_robot_manager;
use err\err_dbs_scenebox_scenebox_dropnormalbox;
use err\err_dbs_scenebox_scenebox_noticeopenmasterbox;
use err\err_dbs_scenebox_scenebox_openboxlogic;
use err\err_dbs_scenebox_scenebox_openmasterbox;
use err\err_dbs_scenebox_scenebox_opennormalbox;
use err\err_dbs_scenebox_scenebox_opennormalboxfriend;

/**
 * 说明
 * 2015年6月18日 下午7:55:48
 *
 * @author zhipeng
 *
 */
class dbs_scenebox_scenebox extends dbs_baseplayer
{
    /**
     * 获取宝箱基础配置
     *
     * @param unknown $boxid
     * @return Ambigous <\Common\Util\multitype:, string>
     */
    public static function get_box_config($boxid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_scene_box_setting::class, configdata_scene_box_setting::k_boxid, $boxid);
    }

    /**
     * 通过类型获取宝箱配置.
     *
     * @param int $boxtype
     *            1日常宝箱 2主人宝箱
     */
    public static function get_boxes_config_by_type($boxtype)
    {
        $boxtype = strval($boxtype);
        $boxesconf = array();
        foreach (configdata_scene_box_setting::data() as $value) {
            if ($value [configdata_scene_box_setting::k_type] == $boxtype) {
                $boxesconf [$value [configdata_scene_box_setting::k_boxid]] = $value;
            }
        }
        return $boxesconf;
    }

    /**
     *
     * @param string $groupid
     */
    public static function get_box_awardconfig($groupid)
    {
        $groupid = strval($groupid);
        $awarditems = array();
        foreach (configdata_scene_box_award_setting::data() as $value) {
            if ($value [configdata_scene_box_award_setting::k_groupid] == $groupid) {
                $awarditems [$value [configdata_scene_box_award_setting::k_id]] = $value;
            }
        }
        return $awarditems;
    }

    /**
     * 普通宝箱id
     *
     * @var string
     */
    const DBKey_normalboxinfo = "normalboxinfo";

    /**
     * 获取 普通宝箱id
     */
    public function get_normalboxinfo()
    {
        return $this->getdata(self::DBKey_normalboxinfo);
    }

    /**
     * 设置 普通宝箱id
     *
     * @param unknown $value
     */
    private function set_normalboxinfo($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_normalboxinfo, $value);
    }

    /**
     * 设置 普通宝箱id 默认值
     */
    protected function _set_defaultvalue_normalboxinfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_normalboxinfo, null);
    }

    /**
     * 普通宝箱开启cd
     *
     * @var string
     */
    const DBKey_normalboxopencooldown = "normalboxopencooldown";

    /**
     * 获取 普通宝箱开启cd
     */
    public function get_normalboxopencooldown()
    {
        return $this->getdata(self::DBKey_normalboxopencooldown);
    }

    /**
     * 设置 普通宝箱开启cd
     *
     * @param unknown $value
     */
    public function set_normalboxopencooldown($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_normalboxopencooldown, $value);
    }

    /**
     * 设置 普通宝箱开启cd 默认值
     */
    protected function _set_defaultvalue_normalboxopencooldown()
    {
        $this->set_defaultkeyandvalue(self::DBKey_normalboxopencooldown, 0);
    }

    /**
     * 普通宝箱今日开启个数
     *
     * @var string
     */
    const DBKey_normalboxtodayopencount = "normalboxtodayopencount";

    /**
     * 获取 普通宝箱今日开启个数
     */
    public function get_normalboxtodayopencount()
    {
        return $this->getdata(self::DBKey_normalboxtodayopencount);
    }

    /**
     * 设置 普通宝箱今日开启个数
     *
     * @param unknown $value
     */
    public function set_normalboxtodayopencount($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_normalboxtodayopencount, $value);
    }

    /**
     * 设置 普通宝箱今日开启个数 默认值
     */
    protected function _set_defaultvalue_normalboxtodayopencount()
    {
        $this->set_defaultkeyandvalue(self::DBKey_normalboxtodayopencount, 0);
    }

    /**
     * 主人宝箱
     *
     * @var string
     */
    const DBKey_masterboxinfo = "masterboxinfo";

    /**
     * 获取 主人宝箱
     */
    public function get_masterboxinfo()
    {
        return $this->getdata(self::DBKey_masterboxinfo);
    }

    /**
     * 设置 主人宝箱
     *
     * @param unknown $value
     */
    public function set_masterboxinfo($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_masterboxinfo, $value);
    }

    /**
     * 设置 主人宝箱 默认值
     */
    protected function _set_defaultvalue_masterboxinfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_masterboxinfo, null);
    }

    /**
     * 主人宝箱每日开启个数
     *
     * @var string
     */
    const DBKey_masterboxtodayopencount = "masterboxtodayopencount";

    /**
     * 获取 主人宝箱每日开启个数
     */
    public function get_masterboxtodayopencount()
    {
        return $this->getdata(self::DBKey_masterboxtodayopencount);
    }

    /**
     * 设置 主人宝箱每日开启个数
     *
     * @param unknown $value
     */
    public function set_masterboxtodayopencount($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_masterboxtodayopencount, $value);
    }

    /**
     * 设置 主人宝箱每日开启个数 默认值
     */
    protected function _set_defaultvalue_masterboxtodayopencount()
    {
        $this->set_defaultkeyandvalue(self::DBKey_masterboxtodayopencount, 0);
    }

    /**
     * 主人宝箱是否通知了
     *
     * @var string
     */
    const DBKey_masterboxnotice = "masterboxnotice";

    /**
     * 获取 主人宝箱是否通知了
     */
    public function get_masterboxnotice()
    {
        return $this->getdata(self::DBKey_masterboxnotice);
    }

    /**
     * 设置 主人宝箱是否通知了
     *
     * @param unknown $value
     */
    public function set_masterboxnotice($value)
    {
        $value = boolval($value);
        $this->setdata(self::DBKey_masterboxnotice, $value);
    }

    /**
     * 设置 主人宝箱是否通知了 默认值
     */
    protected function _set_defaultvalue_masterboxnotice()
    {
        $this->set_defaultkeyandvalue(self::DBKey_masterboxnotice, false);
    }

    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "scenebox";

    function __construct()
    {
        parent::__construct(self::DBKey_tablename);
    }

    /**
     * 创建普通宝箱
     */
    private function create_normalbox()
    {
        $selfopencount = Common_Util_Configdata::getInstance()->get_global_config_value('SCENE_BOX_NORMAL_SELF_OPEN_LIMIT')->int_value();
        $friendopencount = Common_Util_Configdata::getInstance()->get_global_config_value('SCENE_BOX_NORMAL_FRIEND_OPEN_LIMIT')->int_value();

        $limitopencount = $selfopencount + $friendopencount;
        // 已经达到上限
        if ($this->get_normalboxtodayopencount() >= $limitopencount) {
            return;
        }
        // cd中
        if (time() < $this->get_normalboxopencooldown()) {
            return;
        }

        // 是否已经有宝箱
        $boxinfo = $this->get_normalboxinfo();
        if (!is_null($boxinfo)) {
            return;
        }

        // 生成宝箱

        $boxesconf = self::get_boxes_config_by_type(1);

        $weightarray = array();
        foreach ($boxesconf as $boxid => $boxconf) {
            $weightarray [$boxid] = intval($boxconf [configdata_scene_box_setting::k_weight]);
        }
        $boxconfigid = Common_Util_Random::RandomWithWeight($weightarray);

        $box = dbs_scenebox_data::create($boxconfigid);

        $this->set_normalboxinfo($box->toArray());
    }

    /**
     * 创建主人宝箱
     */
    private function create_masterbox()
    {
        // 已经达到上限
        if ($this->get_masterboxtodayopencount() >= 1) {
            return;
        }

        // 是否已经有宝箱
        $boxinfo = $this->get_masterboxinfo();
        if (!is_null($boxinfo)) {
            return;
        }

        // 生成宝箱

        $boxesconf = self::get_boxes_config_by_type(2);

        $weightarray = array();
        foreach ($boxesconf as $boxid => $boxconf) {
            $weightarray [$boxid] = intval($boxconf [configdata_scene_box_setting::k_weight]);
        }
        $boxconfigid = Common_Util_Random::RandomWithWeight($weightarray);

        $box = dbs_scenebox_data::create($boxconfigid);

        $this->set_masterboxinfo($box->toArray());
    }

    private function nextday()
    {
        $gameday = Common_Util_Time::getGameDay();
        if ($gameday != $this->db_owner->dbs_userkvstore()->getvalue(constants_globalkey::PLAYER_SCENE_BOX_DAY_FLAG, 0)) {
            $this->db_owner->dbs_userkvstore()->setvalue(constants_globalkey::PLAYER_SCENE_BOX_DAY_FLAG, $gameday);
        } else {
            return;
        }

        $this->set_normalboxtodayopencount(0);
        $this->set_masterboxtodayopencount(0);
        $this->set_masterboxnotice(false);
    }

    function masterbeforecall()
    {
        $this->nextday();
        $this->create_normalbox();
        $this->create_masterbox();
    }

    /**
     * 开普通宝箱,不需要friendguid
     *
     * @param unknown $boxid
     */
    function opennormalbox($boxid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_scenebox_scenebox_opennormalbox{}

        $boxid = strval($boxid);

        if (!is_null($this->get_masterboxinfo())) {
            $retCode = err_dbs_scenebox_scenebox_opennormalbox::HAS_MASTER_BOX;
            $retCode_Str = 'HAS_MASTER_BOX';
            goto failed;
        }

        $boxinfo = $this->get_normalboxinfo();
        if (is_null($boxinfo)) {
            $retCode = err_dbs_scenebox_scenebox_opennormalbox::BOXID_NOT_EXISTS;
            $retCode_Str = 'BOXID_NOT_EXISTS';
            goto failed;
        }

        $boxdata = new dbs_scenebox_data ();
        $boxdata->fromArray($boxinfo);

        if ($boxid != $boxdata->get_boxid()) {
            $retCode = err_dbs_scenebox_scenebox_opennormalbox::BOXID_NOT_EXISTS;
            $retCode_Str = 'BOXID_NOT_EXISTS';
            goto failed;
        }

        $openret = $this->openboxlogic($boxdata, 0, true);
        if ($openret->is_succ()) {
            $this->openandclearnormalbox();
//			$this->db_owner->db_mission ()->set_mission_object ( constants_mission::MISSION_FINISH_CONDITION_115, 1 );
        }

        return $openret;
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 开启好友宝箱
     *
     * @param string $boxid
     *            宝箱id
     * @param string $frienduserid
     *            好友的id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function opennormalboxfriend($boxid, $frienduserid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_scenebox_scenebox_opennormalboxfriend{}

        $boxid = strval($boxid);
        $frienduserid = strval($frienduserid);

        if (!is_null($this->get_masterboxinfo())) {
            $retCode = err_dbs_scenebox_scenebox_opennormalboxfriend::HAS_MASTER_BOX;
            $retCode_Str = 'HAS_MASTER_BOX';
            goto failed;
        }

        $boxinfo = $this->get_normalboxinfo();
        if (is_null($boxinfo)) {
            $retCode = err_dbs_scenebox_scenebox_opennormalboxfriend::BOXID_NOT_EXISTS;
            $retCode_Str = 'BOXID_NOT_EXISTS';
            goto failed;
        }

        $boxdata = new dbs_scenebox_data ();
        $boxdata->fromArray($boxinfo);

        if ($boxid != $boxdata->get_boxid()) {
            $retCode = err_dbs_scenebox_scenebox_opennormalboxfriend::BOXID_NOT_EXISTS;
            $retCode_Str = 'BOXID_NOT_EXISTS';
            goto failed;
        }

        if (!$this->db_owner->db_friend()->is_friend($frienduserid)) {
            $retCode = err_dbs_scenebox_scenebox_opennormalboxfriend::FRIEND_NOT_EXISTS;
            $retCode_Str = 'FRIEND_NOT_EXISTS';
            goto failed;
        }

        $goodwill = 0;
        if (dbs_robot_manager::getInstance()->isRobot($frienduserid)) {
            $goodwill = 1000000;
        } else {
            $goodwillData = dbs_friend_goodwill::getGoodWill($this->get_userid(), $frienduserid);
            if ($goodwillData->exist()) {
                $goodwill = $goodwillData->get_expTotal() + 100;
            }
        }

        $openret = $this->openboxlogic($boxdata, $goodwill);
        if ($openret->is_succ()) {
            $this->openandclearnormalbox();
//            $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_115, 1);
        }

        // code
        return $openret;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 放弃普通宝箱
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function dropnormalbox()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_scenebox_scenebox_dropnormalbox{}

        $boxinfo = $this->get_normalboxinfo();
        if (is_null($boxinfo)) {
            $retCode = err_dbs_scenebox_scenebox_dropnormalbox::BOX_NOT_EXISTS;
            $retCode_Str = 'BOX_NOT_EXISTS';
            goto failed;
        }

        $this->openandclearnormalbox();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 清除普通宝箱
     */
    private function openandclearnormalbox()
    {
        // 清除宝箱
        $this->set_normalboxinfo(null);
        // cd
        $cdtime = Common_Util_Configdata::getInstance()->get_global_config_value('SCENE_BOX_OPEN_COOLDOWN')->int_value();
        $this->set_normalboxopencooldown(time() + $cdtime);
        // 增加开启次数
        $this->set_normalboxtodayopencount($this->get_normalboxtodayopencount() + 1);
    }

    /**
     * 开启宝箱通用逻辑
     *
     * @param dbs_scenebox_data $boxdata
     * @param number $friendgoodwill
     * @param bool $inhome
     *            是否在在开自己家宝箱
     * @return \Common\Util\Common_Util_ReturnVar
     */
    private function openboxlogic($boxdata, $friendgoodwill = 0, $inhome = FALSE)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_scenebox_scenebox_openboxlogic{}

        $friendgoodwill = intval($friendgoodwill);

        $boxconfig = $boxdata->get_boxconfig();

        $needfriendship = intval($boxconfig [configdata_scene_box_setting::k_needfriendgoodwill]);
        $needdiamond = intval($boxconfig [configdata_scene_box_setting::k_needdiamond]);
        if ($inhome && $needfriendship > $friendgoodwill) {
            $retCode = err_dbs_scenebox_scenebox_openboxlogic::FRIEND_GOODWILL_NOT_ENOUGH;
            $retCode_Str = 'FRIEND_GOODWILL_NOT_ENOUGH';
            goto failed;
        }

        if ($needdiamond > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_scenebox_scenebox_openboxlogic::DIAMOND_NOT_ENOUGH;
            $retCode_Str = 'DIAMOND_NOT_ENOUGH';
            goto failed;
        }

        // 扣钱
        $this->db_owner->db_role()->cost_diamond($needdiamond, constants_moneychangereason::OPEN_SCENE_BOX);

        // 发东西
        $awardconfigs = self::get_box_awardconfig($boxconfig [configdata_scene_box_setting::k_awardgroupid]);

        $awardweights = array();
        foreach ($awardconfigs as $awardid => $value) {
            $awardweights [$awardid] = intval($value [configdata_scene_box_award_setting::k_weight]);
        }

        $awardid = Common_Util_Random::RandomWithWeight($awardweights);
        $awardconfig = $awardconfigs [$awardid];

        $awarditemid = $awardconfig [configdata_scene_box_award_setting::k_itemid];
        $awarditemcount = intval($awardconfig [configdata_scene_box_award_setting::k_itemcount]);

        if (dbs_item::is_gamecoin($awarditemid)) {
            $this->db_owner->db_role()->add_gamecoin($awarditemcount, constants_moneychangereason::OPEN_SCENE_BOX);
        } else if (dbs_item::is_diamond($awarditemid)) {
            $this->db_owner->db_role()->add_diamond($awarditemcount, constants_moneychangereason::OPEN_SCENE_BOX);
        } else {
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $awarditemid);
            if (!is_null($warehouse)) {
                $warehouse->addItemByItemId($awarditemid, $awarditemcount, true);
            }
        }

        $data [constants_returnkey::RK_DIAMOND] = $needdiamond;
        $data [constants_returnkey::RK_ITEMID] = $awarditemid;
        $data [constants_returnkey::RK_ITEMCOUNT] = $awarditemcount;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 开启主人宝箱
     *
     * @param unknown $boxid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function openmasterbox($boxid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_scenebox_scenebox_openmasterbox{}
        $boxid = strval($boxid);

        $boxinfo = $this->get_masterboxinfo();
        if (is_null($boxinfo)) {
            $retCode = err_dbs_scenebox_scenebox_openmasterbox::BOXID_NOT_EXISTS;
            $retCode_Str = 'BOXID_NOT_EXISTS';
            goto failed;
        }

        $boxdata = new dbs_scenebox_data ();
        $boxdata->fromArray($boxinfo);

        if ($boxid != $boxdata->get_boxid()) {
            $retCode = err_dbs_scenebox_scenebox_openmasterbox::BOXID_NOT_EXISTS;
            $retCode_Str = 'BOXID_NOT_EXISTS';
            goto failed;
        }

        $openret = $this->openboxlogic($boxdata, 0, true);
        if ($openret->is_succ()) {

            // 清除宝箱
            $this->set_masterboxinfo(null);
            // 增加开启次数
            $this->set_masterboxtodayopencount($this->get_masterboxtodayopencount() + 1);

//			$this->db_owner->db_mission ()->set_mission_object ( constants_mission::MISSION_FINISH_CONDITION_115, 1 );
        }

        return $openret;

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 通知开启宝箱
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function noticeopenmasterbox($destuserid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $destuserid = strval($destuserid);
        if ($destuserid == $this->get_userid()) {
            $retCode = err_dbs_scenebox_scenebox_noticeopenmasterbox::CANNOT_NOTICE_SELF;
            $retCode_Str = 'CANNOT_NOTICE_SELF';
            goto failed;
        }

        $destplayer = dbs_player::newGuestPlayerWithLock($destuserid);
        if (!$destplayer->isRoleExists()) {
            $retCode = err_dbs_scenebox_scenebox_noticeopenmasterbox::DEST_USER_NOT_EXISTS;
            $retCode_Str = 'DEST_USER_NOT_EXISTS';
            goto failed;
        }

        $dest_scenebox = $destplayer->dbs_scene_box();

        if (is_null($dest_scenebox->get_masterboxinfo())) {
            $retCode = err_dbs_scenebox_scenebox_noticeopenmasterbox::DEST_USER_NOT_HAS_MASTERBOX;
            $retCode_Str = 'DEST_USER_NOT_HAS_MASTERBOX';
            goto failed;
        }

        if ($dest_scenebox->get_masterboxnotice()) {
            $retCode = err_dbs_scenebox_scenebox_noticeopenmasterbox::DEST_USER_MASTER_ALREADY_NOTICE;
            $retCode_Str = 'DEST_USER_MASTER_ALREADY_NOTICE';
            goto failed;
        }

        $dest_scenebox->set_masterboxnotice(true);

        $destplayer->dbs_pushplayer()->sendpush('快来取东西', '快来取东西');
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}