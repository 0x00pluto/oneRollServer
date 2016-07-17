<?php

namespace dbs\robot;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Guid;
use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_restaurant_level_setting;
use configdata\configdata_robot_create_setting;
use configdata\configdata_robot_headicon_resource_setting;
use configdata\configdata_robot_name_setting;
use constants\constants_platformtype;
use constants\constants_robot;
use constants\constants_role;
use dbs\dbs_account;
use dbs\dbs_player;
use dbs\dbs_restaurantinfo;
use dbs\dbs_role;
use dbs\dbs_thirdparty;
use dbs\thirdparty\dbs_thirdparty_userinfo;
use err\err_dbs_robot_manager_creategmnpc;
use err\err_dbs_robot_manager_createRobotWithConfig;
use hellaEngine\utils\schedule\utils_schedule_constants;
use hellaEngine\utils\schedule\utils_schedule_itask;
use hellaEngine\utils\schedule\utils_schedule_manager;
use utilphp\util;

/**
 * 机器人管理器
 *
 * @author zhipeng
 *
 */
class dbs_robot_manager implements utils_schedule_itask
{

    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
        // echo 'This is a Constructed method;';
        $taskName = 'task_' . 'dbs_robot_manager';
        $b_task = utils_schedule_manager::getInstance()->hasTask($taskName);
        if (!$b_task) {
            utils_schedule_manager::getInstance()->addTask($taskName, utils_schedule_constants::RUN_EVERY_SECOND, constants_robot::SCHEDULE_TIME, $this);
        }
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }
    /**
     */
    /**
     * 随机名称
     *
     * @param string $zoneid
     *            区域id
     * @param string $sex
     *            性别
     * @return Ambigous <string, NULL, unknown>
     */
    private function rollname($zoneid, $sex)
    {
        $frist = array();
        $mid = array();
        $last = array();

        $zoneid = strval($zoneid);
        $sex = strval($sex);
        $sexunknown = strval(constants_role::SEX_UNKNOWN);

        $data = configdata_robot_name_setting::data();
        foreach ($data as $value) {

            if ($value [configdata_robot_name_setting::k_zoneid] != $zoneid) {
                continue;
            }
            if ($value [configdata_robot_name_setting::k_sex] != $sex && $value [configdata_robot_name_setting::k_sex] != $sexunknown) {
                continue;
            }

            if (isset ($value [configdata_robot_name_setting::k_namepart1])) {
                $frist [$value [configdata_robot_name_setting::k_namepart1]] = 1;
            }
            if (isset ($value [configdata_robot_name_setting::k_namepart2])) {
                $mid [$value [configdata_robot_name_setting::k_namepart2]] = 1;
            }
            if (isset ($value [configdata_robot_name_setting::k_namepart3])) {
                $last [$value [configdata_robot_name_setting::k_namepart3]] = 1;
            }
        }

        $rollfunction = function () use ($frist, $mid, $last) {
            $randomname = "";
            $namepart = Common_Util_Random::RandomWithWeight($frist);
            if (!is_null($namepart)) {
                $randomname .= $namepart;
            }
            $namepart = Common_Util_Random::RandomWithWeight($mid);
            if (!is_null($namepart)) {
                $randomname .= $namepart;
            }
            $namepart = Common_Util_Random::RandomWithWeight($last);
            if (!is_null($namepart)) {
                $randomname .= $namepart;
            }
            return $randomname;
        };

        $randomname = "";
        do {
            $randomname = $rollfunction ();
            break;
        } while (!dbs_role::rolename_is_vaild($randomname));

        return $randomname;
    }


    /**
     * 根据配置创建机器人
     *
     * @param string $RobotId
     *            机器人id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function createRobotWithConfig($RobotId)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_robot_manager_createRobotWithConfig{}

        $partyManager = dbs_thirdparty::getInstance(constants_platformtype::ROBOT);

        $RobotConfigs = configdata_robot_create_setting::data();

        $created = 0;
        // dump ( $RobotConfigs );
        $RobotConfig = getConfigData(configdata_robot_create_setting::class, configdata_robot_create_setting::k_id, $RobotId);
        if (empty ($RobotConfig)) {
            $retCode = err_dbs_robot_manager_createRobotWithConfig::CONFIG_ERROR;
            $retCode_Str = 'CONFIG_ERROR';
            goto failed;
        }

        do {
            $RobotId = $RobotConfig [configdata_robot_create_setting::k_id];
            $returnCode = $partyManager->create($RobotId, util::random_string(), constants_platformtype::ROBOT, null, $RobotId);
            if ($returnCode->is_failed()) {
                break;
            }

            $thirduserinfo = $returnCode->get_retdata();
            if (!$thirduserinfo instanceof dbs_thirdparty_userinfo) {
                break;
            }

            $account = new dbs_account ();
            $returnCode = $account->create_account($thirduserinfo->get_link_username(),
                $thirduserinfo->get_link_password(),
                $thirduserinfo->get_link_userid());

            if ($returnCode->is_failed()) {

                break;
            }

            $role = new dbs_role ();
            $returnCode = $role->createrole($RobotConfig [configdata_robot_create_setting::k_name],
                $RobotConfig [configdata_robot_create_setting::k_sex],
                $account->get_userid(), FALSE);

            if ($returnCode->is_failed()) {
                break;
            }
        } while (0);

        $accountInfos = dbs_thirdparty_userinfo::all([
            dbs_thirdparty_userinfo::DBKey_username => $RobotConfig [configdata_robot_create_setting::k_id]
        ]);
        if (count($accountInfos) != 1) {
            goto failed;
        }
        $accountInfo = $accountInfos [0];
        if (!$accountInfo instanceof dbs_thirdparty_userinfo) {
            goto failed;
        }



        $robotplayer = dbs_player::newGuestPlayerWithLock($accountInfo->get_link_userid());
        $role = $robotplayer->db_role();
        $role->changerolename($RobotConfig [configdata_robot_create_setting::k_name]);

        $role->set_sex($RobotConfig [configdata_robot_create_setting::k_sex]);
        // $birthday = date_create ( time () );

        $birthday = new \DateTime ("@" . time());
        $birthday = date_sub($birthday, new \DateInterval ('P' . $RobotConfig [configdata_robot_create_setting::k_age] . 'Y'));
        $birthday = $birthday->format('Y-m-d');
        $role->set_birthday($birthday);
        $role->set_zoneid($RobotConfig [configdata_robot_create_setting::k_zoneid]);

        $robotplayer->dbs_robot_player()->mark_is_robot();
        $vip = intval($RobotConfig [configdata_robot_create_setting::k_vip]);
        if ($vip != 0) {
            $robotplayer->dbs_vip()->modify_viplevel($vip);
        }


        $restaruantLevel = intval($RobotConfig[configdata_robot_create_setting::k_restaurantlevel]);
        if ($restaruantLevel != 1) {
            $restaruantconf = dbs_restaurantinfo::getRestaurantLevelConfig($restaruantLevel);
            $restaruantexp = intval($restaruantconf [configdata_restaurant_level_setting::k_totalexp]);
            $robotplayer->db_restaurantinfo()->addrestaurantexp($restaruantexp);
        }

        $headiconConfig = getConfigData(configdata_robot_headicon_resource_setting::class, configdata_robot_headicon_resource_setting::k_id, $RobotConfig [configdata_robot_create_setting::k_headresourceid]);
        $role->set_headiconurl($headiconConfig [configdata_robot_headicon_resource_setting::k_headicon]);

        $created++;
        // }

        $robotData = dbs_robot_data::getRobotData($RobotId);
        $robotData->saveToDB();
        $this->processRobotLogic($robotData);
        //处理基础逻辑

        $data ['created'] = $created;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }


    /**
     * 创建公用机器人
     *
     * @param unknown $npcname
     *            ncp 名称
     * @return Common_Util_ReturnVar
     */
    function creategmnpc($npcname)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_robot_manager_creategmnpc{}

        $robotid = Common_Util_Configdata::getInstance()->get_global_config_value('ROBOT_GM_USERID')->string_value();

//        $partymanager = dbs_thirdparty::getInstance(constants_platformtype::ROBOT);
        $robotusername = Common_Util_Guid::gen_robot_username();

        $userinfo = new dbs_thirdparty_userinfo ();
        $succ = $userinfo->create(Common_Util_Guid::gen_userid(), $robotusername, $robotusername, constants_platformtype::ROBOT, $robotid, Common_Util_Guid::gen_userid(), Common_Util_Guid::gen_password());

        if (!$succ) {
            $retCode = err_dbs_robot_manager_creategmnpc::class;
            $retCode_Str = 'class';
            goto failed;
        }

        $account = new dbs_account ();
        $account->create_account($userinfo->get_link_username(), $userinfo->get_link_password(), $userinfo->get_link_userid());

        $role = new dbs_role ();
        $ret = $role->createrole($npcname, 0, $account->get_userid(), FALSE);

        $robotplayer = dbs_player::newGuestPlayerWithLock($robotid);
        $robotplayer->dbs_robot_player()->mark_is_robot();

        $data = $userinfo->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取gmnpc信息
     *
     * @return Common_Util_ReturnVar
     */
    function getgmnpcaccountinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_robot_manager_getgmnpcaccountinfo{}

        $robotid = Common_Util_Configdata::getInstance()->get_global_config_value('ROBOT_GM_USERID')->string_value();

        $userinfo = dbs_thirdparty_userinfo::getByLinkUserid($robotid);

        $data = $userinfo->toArray();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 随机获取一个机器人
     *
     * @param array $exclude 不包含的用户ID
     * @return string
     */
    function getRandomRobotId($exclude = [])
    {
        $robots = $this->getAllValidRobotDatasArray();
        $globalRobotId = Common_Util_Configdata::getInstance()->get_global_config_value('ROBOT_GM_USERID')->string_value();

        unset($robots[$globalRobotId]);
        $weight = [];
        foreach ($robots as $userid => $robot) {
            if (!isset($exclude[$userid])) {
                $weight[$userid] = 1;
            }
        }

//        $userids = array_keys($robots);

        $randomUserId = Common_Util_Random::RandomWithWeight($weight);
        return $randomUserId;
    }

    /**
     * 获取所有机器人
     * @return Common_Util_ReturnVar
     */
    function getallrobot()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $robotDatas = dbs_robot_data::all();

        foreach ($robotDatas as $robotData) {
            $data[$robotData->get_robotUserId()] = $robotData->toArray();
        }


//        dump($data);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * @return dbs_robot_data[]
     */
    private function getAllValidRobotDatas()
    {
        return dbs_robot_data::all([dbs_robot_data::DBKey_isDelete => false]);
    }
    /**
     * 获取所有有效的机器人
     * @return array
     */
    public function getAllValidRobotDatasArray()
    {
        $robots = [];

        $robotDatas = $this->getAllValidRobotDatas();

        foreach ($robotDatas as $robotData) {
            $robots[$robotData->get_robotUserId()] = $robotData->toArray();
        }
        return $robots;
    }

    function onSchedule($sheduleTime)
    {
        // dump ( "schedule:" . $sheduleTime );
        // $this->robot_action ( $sheduleTime );
    }

    private function robot_action($time)
    {
        $robotuserids = $this->getallrobot()->get_retdata();

        foreach ($robotuserids as $robotinfo) {
            $robotuserid = $robotinfo [dbs_thirdparty_userinfo::DBKey_link_userid];
            $robotins = dbs_player::newMasterPlayer($robotuserid);
            $robotins->db_restaurantinfo()->addrestaurantexp(1);
        }
    }

    /**
     * 检测Userid是否是机器人
     *
     * @param string $userid 用户id
     * @return boolean
     */
    function isRobot($userid)
    {
        $userid = strval($userid);
        if ($userid == Common_Util_Configdata::getInstance()->get_global_config_value('ROBOT_GM_USERID')->string_value()) {
            return true;
        }

        return dbs_robot_data::getRobotData($userid)->exist();
    }

    /**
     * 是否是普通机器人
     * @param $userid
     * @return bool
     */
    function isNormalRobot($userid)
    {
        $userid = strval($userid);
        if ($userid == Common_Util_Configdata::getInstance()->get_global_config_value('ROBOT_GM_USERID')->string_value()) {
            return false;
        }

        return dbs_robot_data::getRobotData($userid)->exist();
    }

    function processLogicToAll()
    {
        $robotDatas = $this->getAllValidRobotDatas();
        foreach ($robotDatas as  $robotData) {
            /**
             * @var dbs_robot_data $robotData
             */
            $this->processRobotLogic($robotData);

//            dump($robotData->get_robotUserId());
//            break;
        }
    }
    /**
     * @param dbs_robot_data $robotData
     */
    private function processRobotLogic(dbs_robot_data $robotData)
    {
        $robotPlayer = dbs_player::newMasterPlayer($robotData->get_robotUserId());
        dbs_robot_player::createWithPlayer($robotPlayer)->processRobotLogic($robotData);

    }

//    private function processLogic(dbs_player $robot)
//    {
//        dbs_role::createWithPlayer($robot)->login();
//    }
}