<?php

namespace service;

use Common\Db\Common_Db_pools;
use constants\constants_platformtype;
use dbs\robot\dbs_robot_data;
use dbs\robot\dbs_robot_manager;
use Common\Util\Common_Util_ReturnVar;
use dbs\thirdparty\dbs_thirdparty_userinfo;

/**
 * @auther zhipeng
 */
class service_robot extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getallrobot',
            'creategmnpc',
            'getgmnpcaccountinfo',
            'createRobotWithConfig',
            'isRobot',
            'fixRobotData',
            'processLogicToAll'
        ), TRUE);

        $this->exportForLuaCode = false;
    }

    public function isNeedLogin()
    {
        return false;
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_robot_player();
    }

    protected function get_err_class_name()
    {
        return 'err\\' . "err_dbs_robot_manager_";
    }

    /**
     * 获取所有的机器人id
     *
     * @return Common_Util_ReturnVar
     */
    function getallrobot()
    {
        return dbs_robot_manager::getInstance()->getallrobot();
    }



    /**
     * 创建公用机器人
     *
     * @param unknown $npcname
     * @return Common_Util_ReturnVar
     */
    function creategmnpc($npcname)
    {
        return dbs_robot_manager::getInstance()->creategmnpc($npcname);
    }

    /**
     * 获取gmnpc信息
     *
     * @return Common_Util_ReturnVar
     */
    function getgmnpcaccountinfo()
    {
        return dbs_robot_manager::getInstance()->getgmnpcaccountinfo();
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
        return dbs_robot_manager::getInstance()->createRobotWithConfig($RobotId);
    }

    /**
     * 是否是机器人
     *
     * @param unknown $userid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function isRobot($userid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_robot_isRobot{}

        $data = dbs_robot_manager::getInstance()->isRobot($userid);
        // code
        
        $robotData = dbs_robot_data::getRobotData($userid);


        dump(dbs_robot_manager::getInstance()->getRandomRobotId());
//        dump($robotData);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 修复机器人数据,主要是从以前的数据升级
     * @return Common_Util_ReturnVar
     */
    public function fixRobotData()
    {
        $data = [];
        //interface err_service_robot_fixRobotData

        $db = Common_Db_pools::default_Db_pools()->dbconnect();
        $ret = $db->query(dbs_thirdparty_userinfo::DBKey_tablename, array(
            dbs_thirdparty_userinfo::DBKey_thirdpartytype => constants_platformtype::ROBOT
        ), array(
            dbs_thirdparty_userinfo::DBKey_link_userid,
            dbs_thirdparty_userinfo::DBKey_username,
            dbs_thirdparty_userinfo::DBKey_password
        ));
        $robots = $ret;

        foreach ($robots as $robot)
        {
//            dump($robot);
            $robotData = dbs_robot_data::getRobotData($robot[dbs_thirdparty_userinfo::DBKey_link_userid]);
//            $robotData->set_readonly(false);
            $robotData->saveToDB(true);
            if(!$robotData->exist()) {
//                dump($robotData->saveToDB());
            }
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @return Common_Util_ReturnVar
     */
    public function processLogicToAll()
    {
        $data = [];
        //interface err_service_robot_processLogicToAll
        dbs_robot_manager::getInstance()->processLogicToAll();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }
}