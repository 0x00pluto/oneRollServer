<?php

namespace dbs;

use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_mission_setting;
use constants\constants_messagecmd;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\mission\dbs_mission_data;
use dbs\mission\dbs_mission_finishdata;
use dbs\templates\mission\dbs_templates_mission_mission;
use dbs\themeRestaurant\dbs_themeRestaurant_Player;
use err\err_dbs_mission_missioncomplete;
use err\err_dbs_mission_missioncompleteconditionusediamond;
use err\err_dbs_mission_missioncompleteusediamond;

class dbs_mission extends dbs_templates_mission_mission
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 获取正在进行中的任务
     *
     * @param string $missionType
     * @return array
     */
    private function getMissionWorking($missionType)
    {
        $missionType = strval($missionType);
        $missions = null;
        switch ($missionType) {
            case constants_mission::MISSION_TYPE_NORMAL :
                $missions = $this->get_normalmissionworking();
                break;
            case constants_mission::MISSION_TYPE_ACTIVITY :
                $missions = $this->get_activitymissionworking();
                break;
            case constants_mission::MISSION_TYPE_ACHIEVEMENT :
                $missions = $this->get_achievementmissionworking();
                break;
        }
        return $missions;
    }

    /**
     * 设置正在进行中的任务
     *
     * @param string $missionType
     * @param $value
     */
    private function setMissionWorking($missionType, $value)
    {
        $missionType = strval($missionType);
        switch ($missionType) {
            case constants_mission::MISSION_TYPE_NORMAL :
                $this->set_normalmissionworking($value);
                break;
            case constants_mission::MISSION_TYPE_ACTIVITY :
                $this->set_activitymissionworking($value);
                break;
            case constants_mission::MISSION_TYPE_ACHIEVEMENT :
                $this->set_achievementmissionworking($value);
                break;
        }
    }

    /**
     * 获取完成的任务
     *
     * @param string $missionType
     * @return array
     */
    private function getCompleteMissions($missionType)
    {
        $missionType = strval($missionType);
        $missions = null;
        switch ($missionType) {
            case constants_mission::MISSION_TYPE_NORMAL :
                $missions = $this->get_normalmissioncomplete();
                break;
            case constants_mission::MISSION_TYPE_ACTIVITY :
                $missions = $this->get_activitymissioncomplete();
                break;
            case constants_mission::MISSION_TYPE_ACHIEVEMENT :
                $missions = $this->get_achievementmissioncomplete();
                break;
            default :
                $missions = $this->get_normalmissioncomplete();
                break;
        }
        return $missions;
    }

    /**
     * 设置完成的任务列表
     *
     * @param string $missionType
     * @param array $value
     */
    private function setCompleteMissions($missionType, $value)
    {
        $missionType = strval($missionType);
        switch ($missionType) {
            case constants_mission::MISSION_TYPE_NORMAL :
                $this->set_normalmissioncomplete($value);
                break;
            case constants_mission::MISSION_TYPE_ACTIVITY :
                $this->set_activitymissioncomplete($value);
                break;
            case constants_mission::MISSION_TYPE_ACHIEVEMENT :
                $this->set_achievementmissioncomplete($value);
                break;
        }
    }


    /**
     * 自动开启的普通合集
     * @var null
     */
    private static $autoOpenNormalMissionIds = null;


    /**
     * 获取可以自动接受的任务集合
     *
     * @return array
     */
    private function getAutoOpenNormalMissions()
    {
        if (is_null(self::$autoOpenNormalMissionIds)) {
            self::$autoOpenNormalMissionIds = [];
            foreach (configdata_mission_setting::data() as $key => $value) {
                if ($value [configdata_mission_setting::k_type] == constants_mission::MISSION_TYPE_NORMAL &&
                    $value [configdata_mission_setting::k_autoopen] == '1'
                ) {
                    self::$autoOpenNormalMissionIds [$key] = $value;
                }
            }
        }
        return self::$autoOpenNormalMissionIds;
    }


    /**
     * 获取是否有已经完成的任务
     *
     * @param string $missionId
     *            任务id
     * @param string $missionType
     * @return bool
     */
    private function missionIsComplete($missionId, $missionType = constants_mission::MISSION_TYPE_NORMAL)
    {
        $missionId = strval($missionId);
        $completeMissions = $this->getCompleteMissions($missionType);
        return isset($completeMissions[$missionId]);
    }

    /**
     * 任务是否已经在执行了
     *
     * @param string $missionId
     * @param string $missionType
     * @return boolean
     */
    private function missionIsWorking($missionId, $missionType = constants_mission::MISSION_TYPE_NORMAL)
    {
        $missionId = strval($missionId);
        $missions = $this->getMissionWorking($missionType);
        return isset($missions[$missionId]);
    }

    /**
     * 获取普通进行任务
     *
     * @param string $missionId
     * @return dbs_mission_data|null
     */
    private function getMissionWorkingData($missionId, $missionType = constants_mission::MISSION_TYPE_NORMAL)
    {
        $missionId = strval($missionId);
        $missions = $this->getMissionWorking($missionType);
        $missionData = null;
        if (isset($missions[$missionId])) {
            $missionData = dbs_mission_data::create_with_array($missions[$missionId]);
        }

        return $missionData;
    }

    /**
     * 设置任务数据
     *
     * @param dbs_mission_data $missionData
     * @param string $missionType
     */
    private function setMissionWorkingData(dbs_mission_data $missionData, $missionType = constants_mission::MISSION_TYPE_NORMAL)
    {
        $missions = $this->getMissionWorking($missionType);
        $missions [$missionData->get_missionid()] = $missionData->toArray();
        $this->setMissionWorking($missionType, $missions);
    }

    /**
     * 检测开启条件
     *
     * @param string $conditionId
     * @param number $conditionValue
     * @return boolean
     */
    private function checkOpenCondition($conditionId, $conditionValue)
    {
        $succ = false;
        $conditionId = strval($conditionId);
        switch ($conditionId) {
            case constants_mission::MISSION_OPEN_CONDITION_1 : {
                // 人气值经验
                $conditionValue = intval($conditionValue);
                $mainThemeRestaurantId = dbs_themeRestaurant_Player::createWithPlayer($this)->get_mainRestaurantId();
                if (dbs_themeRestaurant_Player::createWithPlayer($this)->getBaseReputation($mainThemeRestaurantId) >= $conditionValue) {
                    $succ = true;
                }
                break;
            }
            case constants_mission::MISSION_OPEN_CONDITION_2 : {
                // 人气值等级
                $conditionValue = intval($conditionValue);
                $mainThemeRestaurantId = dbs_themeRestaurant_Player::createWithPlayer($this)->get_mainRestaurantId();
                if (dbs_themeRestaurant_Player::createWithPlayer($this)->getReputationLevel($mainThemeRestaurantId) >= $conditionValue) {
                    $succ = true;
                }
                break;
            }
            case constants_mission::MISSION_OPEN_CONDITION_3 : {
                // 餐厅经验
                $conditionValue = intval($conditionValue);
                if ($this->db_owner->db_restaurantinfo()->get_restauranttotalexp() >= $conditionValue) {
                    $succ = true;
                }
                break;
            }
            case constants_mission::MISSION_OPEN_CONDITION_4: {
                //餐厅等级
                $conditionValue = intval($conditionValue);
                if (dbs_restaurantinfo::createWithPlayer($this)->get_restaurantlevel() >= $conditionValue) {
                    $succ = true;
                }
                break;
            }
        }

        return $succ;
    }

    /**
     * 检测任务是否完成
     *
     * @param string $missionId
     * @param dbs_mission_data $missionData
     * @return boolean
     */
    private function checkMissionComplete($missionId, $missionData)
    {
        $missionConfig = self::getMissionConfig($missionId);
        if (is_null($missionConfig)) {
            return false;
        }

        if (isset ($missionConfig [configdata_mission_setting::k_completeconditionid1])) {
            if (!$this->checkFinishCondition($missionData, 1)) {
                return false;
            }
        }
        if (isset ($missionConfig [configdata_mission_setting::k_completeconditionid2])) {
            if (!$this->checkFinishCondition($missionData, 2)) {
                return false;
            }
        }
        if (isset ($missionConfig [configdata_mission_setting::k_completeconditionid3])) {
            if (!$this->checkFinishCondition($missionData, 3)) {
                return false;
            }
        }

        return true;
    }

    /**
     * 检测是否完成任务条件
     *
     * @param dbs_mission_data $missionData
     * @param integer $conditionPos
     *            条件位置
     * @return bool
     */
    private function checkFinishCondition(dbs_mission_data $missionData, $conditionPos)
    {
        $conditionPos = intval($conditionPos);
        if ($conditionPos == 1) {
            $missionConditionComplete = $missionData->get_iscompletevalue1();
        } elseif ($conditionPos == 2) {
            $missionConditionComplete = $missionData->get_iscompletevalue2();
        } else {
            $missionConditionComplete = $missionData->get_iscompletevalue3();
        }

        return $missionConditionComplete;
    }


    /**
     * 接受npc任务
     *
     * @param $missionId
     * @return bool
     */
    public function acceptNpcMission($missionId)
    {
        return $this->acceptMission($missionId, constants_mission::MISSION_TYPE_NORMAL);
    }

    /**
     * 接受任务
     *
     * @param string $missionId
     * @param string $missionType
     * @return bool
     */
    private function acceptMission($missionId, $missionType = constants_mission::MISSION_TYPE_NORMAL)
    {
        $missionConfig = self::getMissionConfig($missionId);
        if (is_null($missionConfig)) {
            return false;
        }
        if ($this->missionIsComplete($missionId, $missionType)) {
            return false;
        }
        if ($this->missionIsWorking($missionId, $missionType)) {
            return false;
        }

        //整合任务开启条件
        $openConditions = [];
        if (isset($missionConfig[configdata_mission_setting::k_openconditionid1])) {
            $openConditions [$missionConfig [configdata_mission_setting::k_openconditionid1]] =
                $missionConfig [configdata_mission_setting::k_openconditionvalue1];
        }
        if (isset($missionConfig[configdata_mission_setting::k_openconditionid2])) {
            $openConditions [$missionConfig [configdata_mission_setting::k_openconditionid2]] =
                $missionConfig [configdata_mission_setting::k_openconditionvalue2];
        }

        foreach ($openConditions as $key => $value) {
            if (!$this->checkOpenCondition($key, $value)) {
                return false;
            }
        }

        $missionData = dbs_mission_data::create($missionId);

        $missions = $this->getMissionWorking($missionType);
        $missions [$missionData->get_missionid()] = $missionData->toArray();
        $this->setMissionWorking($missionType, $missions);

        return true;
    }

    /**
     * 重置活动任务
     */
    private function _reset_active_mission()
    {
        $this->set_activitymissioncomplete([]);
        $this->set_activitymissionworking([]);
    }

    /**
     * 自动接取普通任务
     */
    private function autoAcceptNormalMissions()
    {
        $autoOpenMissionConfigs = $this->getAutoOpenNormalMissions();
        foreach ($autoOpenMissionConfigs as $key => $value) {
            $missionId = $value [configdata_mission_setting::k_id];
            if (!$this->missionIsComplete($missionId, constants_mission::MISSION_TYPE_NORMAL)) {
                $this->acceptMission($missionId);
            }
        }
    }

    /**
     * 自动领取活动任务
     */
    private function autoAcceptActivityMission()
    {
        $missions = dbs_missionactivity::get_active_missions();

        foreach ($missions as $key => $value) {
            $missionId = $value [configdata_mission_setting::k_id];
            if (!$this->missionIsComplete($missionId, constants_mission::MISSION_TYPE_ACTIVITY)) {
                $this->acceptMission($missionId, constants_mission::MISSION_TYPE_ACTIVITY);
            }
        }
    }

    /**
     * 自动领取成就
     */
    private function autoAcceptAchievementMission()
    {
        $auto_open_missions = dbs_missionachievement::get_autoopenachievements();
        foreach ($auto_open_missions as $key => $value) {
            if (!$this->missionIsComplete($value [configdata_mission_setting::k_id], constants_mission::MISSION_TYPE_ACHIEVEMENT)) {
                $this->acceptMission($value [configdata_mission_setting::k_id], constants_mission::MISSION_TYPE_ACHIEVEMENT);
            }
        }
    }

    /**
     *  添加道具到仓库
     *
     * @param string $itemid
     * @param integer $itemcount
     * @return bool
     */
    private function addItemToWarehouse($itemid, $itemcount)
    {
        return dbs_warehouse::additemtowarehouse($this->db_owner, $itemid, $itemcount);
    }

    /**
     * 获取任务配置
     *
     * @param string $missionId
     * @return null
     */
    public static function getMissionConfig($missionId)
    {
        return getConfigData(configdata_mission_setting::class, configdata_mission_setting::k_id, $missionId);
    }

    /**
     * 完成任务
     *
     * @param string $missionId
     * @param $missionType
     */
    private function _missionComplete($missionId, $missionType)
    {
        $missionConfig = self::getMissionConfig($missionId);
        // 奖励金币
        $awardGamecoin = intval($missionConfig [configdata_mission_setting::k_awardgamecoin]);
        $this->db_owner->db_role()->add_gamecoin($awardGamecoin, constants_moneychangereason::MISSION_AWARD);
        $awardDiamond = intval($missionConfig [configdata_mission_setting::k_awarddiamond]);
        $this->db_owner->db_role()->add_diamond($awardDiamond, constants_moneychangereason::MISSION_AWARD);
        $awardRestaurantExp = intval($missionConfig [configdata_mission_setting::k_awardrestaurantexp]);
        $this->db_owner->db_restaurantinfo()->addrestaurantexp($awardRestaurantExp);

        // 奖励物品

        if (isset ($missionConfig [configdata_mission_setting::k_awarditemid1])) {
            $awardItemId1 = strval($missionConfig [configdata_mission_setting::k_awarditemid1]);
            $awardItemCount1 = intval($missionConfig [configdata_mission_setting::k_awarditemidcount1]);
            $this->addItemToWarehouse($awardItemId1, $awardItemCount1);
        }
        if (isset ($missionConfig [configdata_mission_setting::k_awarditemid2])) {
            $awardItemId2 = strval($missionConfig [configdata_mission_setting::k_awarditemid2]);
            $awardItemCount2 = intval($missionConfig [configdata_mission_setting::k_awarditemidcount2]);
            $this->addItemToWarehouse($awardItemId2, $awardItemCount2);
        }

        if (isset ($missionConfig [configdata_mission_setting::k_awarditemid3])) {
            $awardItemId3 = strval($missionConfig [configdata_mission_setting::k_awarditemid3]);
            $awardItemCount3 = intval($missionConfig [configdata_mission_setting::k_awarditemidcount3]);
            $this->addItemToWarehouse($awardItemId3, $awardItemCount3);
        }

        // 删除任务
        $missions = $this->getMissionWorking($missionType);
        unset ($missions [$missionId]);
        $this->setMissionWorking($missionType, $missions);

        // 设置完成任务
        $completeMissions = $this->getCompleteMissions($missionType);
        $completeMission = dbs_mission_finishdata::create($missionId);
        $completeMissions [$completeMission->get_missionId()] = $completeMission->toArray();
        $this->setCompleteMissions($missionType, $completeMissions);

        // 接受下一个任务
        if (isset ($missionConfig [configdata_mission_setting::k_nextmissionid])) {
            $nextMissionId = $missionConfig [configdata_mission_setting::k_nextmissionid];
            $this->acceptMission($nextMissionId, $missionType);
        }
    }

    /**
     *  钻石完成任务
     *
     * @deprecated 目前没有这个需求
     *
     * @param string $missionid
     *            任务id
     * @param string $missiontype
     *            任务类型
     * @return Common_Util_ReturnVar
     */
    function missioncompleteusediamond($missionid, $missiontype = constants_mission::MISSION_TYPE_NORMAL)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_mission_missioncompleteusediamond{}
        $missionid = strval($missionid);
        if (!$this->missionIsWorking($missionid, $missiontype)) {
            $retCode = err_dbs_mission_missioncompleteusediamond::MISSION_NOT_ACTIVITY;
            $retCode_Str = 'MISSION_NOT_ACTIVITY';
            goto failed;
        }
        // code
        // $missionData = $this->_get_missionworking_data ( $missionId, $missionType );

        $missionconfig = self::getMissionConfig($missionid);

        $diamonds = intval($missionconfig [configdata_mission_setting::k_diamondfinish]);
        if ($diamonds == 0) {
            $retCode = err_dbs_mission_missioncompleteusediamond::CANNOT_FINISH_USE_DIAMOND;
            $retCode_Str = 'CANNOT_FINISH_USE_DIAMOND';
            goto failed;
        }

        if ($this->db_owner->db_role()->get_diamond() < $diamonds) {
            $retCode = err_dbs_mission_missioncompleteusediamond::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        // 扣钱
        $this->db_owner->db_role()->cost_diamond($diamonds, constants_moneychangereason::FINISH_MISSION);

        // code
        $this->_missionComplete($missionid, $missiontype);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 完成普通任务
     *
     * @param string $missionid
     * @return Common_Util_ReturnVar
     */
    function missioncomplete($missionid, $missiontype = constants_mission::MISSION_TYPE_NORMAL)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $missionid = strval($missionid);
        if (!$this->missionIsWorking($missionid, $missiontype)) {
            $retCode = err_dbs_mission_missioncomplete::MISSION_NOT_ACTIVITY;
            $retCode_Str = 'MISSION_NOT_ACTIVITY';
            goto failed;
        }

        // code
        $missiondata = $this->getMissionWorkingData($missionid, $missiontype);

        if (!$this->checkMissionComplete($missionid, $missiondata)) {
            $retCode = err_dbs_mission_missioncomplete::MISSION_NOT_COMPLETE;
            $retCode_Str = 'MISSION_NOT_COMPLETE';
            goto failed;
        }

        // 完成任务
        $this->_missionComplete($missionid, $missiontype);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 使用钻石完整任务条件
     *
     * @param string $missionid 任务id
     * @param int $conditionposition 条件位置
     *            1,2,3
     * @param int $missiontype 任务类型
     * @return Common_Util_ReturnVar
     */
    function missioncompleteconditionusediamond($missionid, $conditionposition, $missiontype = constants_mission::MISSION_TYPE_NORMAL)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_mission_function_missioncompleteconditionusediamond{}

        $missionid = strval($missionid);
        $conditionposition = intval($conditionposition);
        if (!$this->missionIsWorking($missionid, $missiontype)) {
            $retCode = err_dbs_mission_missioncompleteconditionusediamond::MISSION_NOT_ACTIVITY;
            $retCode_Str = 'MISSION_NOT_ACTIVITY';
            goto failed;
        }

        $missionconifg = self::getMissionConfig($missionid);
        if (!isset ($missionconifg ['completeconditionid' . $conditionposition])) {
            $retCode = err_dbs_mission_missioncompleteconditionusediamond::CONDITION_NOT_EXISTS;
            $retCode_Str = 'CONDITION_NOT_EXISTS';
            goto failed;
        }

//        $conditionid = $missionconifg ['completeconditionid' . $conditionposition];
//        $conditionvalue = $missionconifg ['completeconditionvalue' . $conditionposition];

        $key_diamond = 'completeconditionusediamond' . $conditionposition;
        // configdata_mission_setting::k_awardgamecoin
        $TotalDiamond = intval($missionconifg [$key_diamond]);
        if ($TotalDiamond == 0) {
            $retCode = err_dbs_mission_missioncompleteconditionusediamond::CANNOT_FINISH_USE_DIAMOND;
            $retCode_Str = 'CANNOT_FINISH_USE_DIAMOND';
            goto failed;
        }

        $missionData = $this->getMissionWorkingData($missionid, $missiontype);
        if ($this->checkFinishCondition($missionData, $conditionposition)) {
            $retCode = err_dbs_mission_missioncompleteconditionusediamond::CONDITION_HAS_BEEN_COMPETED;
            $retCode_Str = 'CONDITION_HAS_BEEN_COMPETED';
            goto failed;
        }

        $totalNum = $missionData->getConditionMaxNum($conditionposition);
        $perDiamond = floatval($TotalDiamond)/$totalNum;

        //具体使用的钻石数量
        $num = $missionData->getConditionLeftNum($conditionposition);
        $use_diamond = $num * $perDiamond;
        //向上取整
        $use_diamond = ceil($use_diamond);
        
        if ($use_diamond > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_mission_missioncompleteconditionusediamond::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        // 扣除钻石
        $this->db_owner->db_role()->cost_diamond($use_diamond, constants_moneychangereason::FINISH_MISSION_CONDITION);

        // 完成条件
        $missionData->completeCondition($conditionposition);
//        dump($use_diamond);
//        dump($missionData->toArray());

        $this->setMissionWorkingData($missionData, $missiontype);
        // $this->_set_mission_object($missionType, $conditionId, $params)

        $data[constants_returnkey::RK_DIAMOND] = $use_diamond;
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 各个任务完成接口
     *
     * @param string $missiontype
     * @param array $params
     */
    private function _set_mission_object($missiontype, $conditionid, $params)
    {
        $missiontype = strval($missiontype);
        $conditionid = strval($conditionid);

        $workingMissions = $this->getMissionWorking($missiontype);
        $dataChange = false;
        foreach ($workingMissions as $key => $value) {
            $mission = dbs_mission_data::create_with_array($value);
            if ($mission->missionComplete($conditionid, $params)) {
                $workingMissions [$key] = $mission->toArray();
                $dataChange = true;
            }
        }
        if ($dataChange) {
            // 通知客户端数据变化
            $this->db_owner->db_sync()->mark_sync(constants_messagecmd::S2C_MISSION_DATA_CHANGE);
            $this->setMissionWorking($missiontype, $workingMissions);
        }
    }

    /**
     * 各个模块的完成任务接口
     *
     * @param string $conditionId 任务ID
     * @param mixed $conditionValue
     */
    function set_mission_object($conditionId, $conditionValue)
    {
        $conditionId = strval($conditionId);
        $params = array(
            $conditionValue
        );

        $this->_set_mission_object(constants_mission::MISSION_TYPE_NORMAL, $conditionId, $params);
        $this->_set_mission_object(constants_mission::MISSION_TYPE_ACTIVITY, $conditionId, $params);
        $this->_set_mission_object(constants_mission::MISSION_TYPE_ACHIEVEMENT, $conditionId, $params);
    }

    /**
     * 完成任务接口 类似 什么 需要多少个
     *
     * @param string $conditionId 任务ID
     * @param string $type
     * @param integer $count
     */
    function set_mission_object_type_count($conditionId, $type, $count)
    {
        $conditionId = strval($conditionId);
        $params = array(
            $type,
            $count
        );
        $this->_set_mission_object(constants_mission::MISSION_TYPE_NORMAL, $conditionId, $params);
        $this->_set_mission_object(constants_mission::MISSION_TYPE_ACTIVITY, $conditionId, $params);
        $this->_set_mission_object(constants_mission::MISSION_TYPE_ACHIEVEMENT, $conditionId, $params);
    }

    function masterbeforecall()
    {
        // dump ( "accpet" );
        // 更新活动任务
        $period = $this->db_owner->db_missionactivity()->get_activity_period();
        if ($period != $this->get_period()) {
            $this->_reset_active_mission();
        }
        $this->set_period($period);

        $this->autoAcceptNormalMissions();
        // 接受活动
        $this->autoAcceptActivityMission();
        // 接受成就
        $this->autoAcceptAchievementMission();
    }
}