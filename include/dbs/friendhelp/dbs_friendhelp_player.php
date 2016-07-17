<?php

namespace dbs\friendhelp;

use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use configdata\configdata_friend_help_eat_award_setting;
use configdata\configdata_friend_help_normal_award_setting;
use constants\constants_globalkey;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\dbs_friend;
use dbs\dbs_player;
use dbs\dbs_role;
use dbs\dbs_userkvstore;
use dbs\dbs_warehouse;
use dbs\i\dbs_i_iday;
use dbs\scene\buildingExtend\dbs_scene_buildingExtend_cookTable;
use dbs\scene\buildingExtend\dbs_scene_buildingExtend_dinnerTable;
use dbs\scene\dbs_scene_player;
use dbs\templates\friendhelp\dbs_templates_friendhelp_player;
use dbs\themeRestaurant\dbs_themeRestaurant_Player;
use err\err_dbs_friendhelp_player;
use err\err_dbs_friendhelp_player_helpCookDishes;
use err\err_dbs_friendhelp_player_helpEatDishes;
use err\err_dbs_friendhelp_player_helpExpand;

/**
 * 说明
 * 2015年6月25日 下午4:34:33
 *
 * @author zhipeng
 *
 */
class dbs_friendhelp_player extends dbs_templates_friendhelp_player implements dbs_i_iday
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * @inheritDoc
     */
    function masterbeforecall()
    {

        $this->nextday();
    }

    /**
     * @inheritDoc
     */
    function nextday()
    {
        $dayFlag = dbs_userkvstore::createWithPlayer($this)->getvalue(constants_globalkey::PLAYER_FRIEND_HELP_DAY_FLAG, 0);
        if ($dayFlag !== Common_Util_Time::getGameDay()) {
            dbs_userkvstore::createWithPlayer($this)->setvalue(constants_globalkey::PLAYER_FRIEND_HELP_DAY_FLAG, Common_Util_Time::getGameDay());
        } else {
            return;
        }

        $this->reset_todayHelpCount()
            ->reset_todayHelpList()
            ->reset_todayRecvHelpCount();

    }


    /**
     * 增加帮忙记录
     * @param $friendUserId
     * @param int $times
     */
    private function addHelpRecord($friendUserId, $times = 1)
    {
        $helpList = $this->get_todayHelpList();
        if (isset($helpList[$friendUserId])) {
            $helpList[$friendUserId] = $helpList[$friendUserId] + $times;
        } else {
            $helpList[$friendUserId] = $times;
        }

        $this->set_todayHelpList($helpList);
        $this->set_todayHelpCount($this->get_todayHelpCount() + $times);
    }

    /**
     * 增加被帮助的次数
     * @param int $times
     */
    private function addRecvHelpTimes($times = 1)
    {
        $this->set_todayRecvHelpCount($this->get_todayRecvHelpCount() + $times);
    }

    /**
     * 获得单个好友今日帮忙的次数
     * @param $friendUserId
     * @return int
     */
    private function getHelpSinglePlayerCount($friendUserId)
    {
        $helpList = $this->get_todayHelpList();
        if (isset($helpList[$friendUserId])) {
            return $helpList[$friendUserId];
        } else {
            return 0;
        }
    }

    /**
     * 通用帮忙检测逻辑
     * @param $friendUserId
     */
    private function checkHelpNormalLogic($friendUserId)
    {

        typeCheckUserId($friendUserId);

        logicErrorCondition($friendUserId !== $this->get_userid(),
            err_dbs_friendhelp_player::CANNOT_HELP_SELF,
            "CANNOT_HELP_SELF");

        $singleHelpCount = $this->getHelpSinglePlayerCount($friendUserId);
        $singleHelpCountLimit = getGlobalValue("FRIEND_HELP_SINGLE_TIMES_LIMIT")->int_value();

        logicErrorCondition($singleHelpCount < $singleHelpCountLimit,
            err_dbs_friendhelp_player::HELP_SINGLE_PLAYER_COUNT_MAX,
            "HELP_SINGLE_PLAYER_COUNT_MAX");

        $totalHelpCount = $this->get_todayHelpCount();
        $totalHelpCountLimit = getGlobalValue("FRIEND_HELP_TOTAL_TIMES_LIMIT")->int_value();

        logicErrorCondition($totalHelpCount < $totalHelpCountLimit,
            err_dbs_friendhelp_player::HELP_TOTAL_COUNT_MAX,
            "HELP_TOTAL_COUNT_MAX");

        $destPlayer = dbs_player::newGuestPlayerWithLock($friendUserId);
        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_friendhelp_player::DEST_PLAYER_NOT_EXISTS,
            "DEST_PLAYER_NOT_EXISTS");


        $destFriendHelp = dbs_friendhelp_player::createWithPlayer($destPlayer);
        $totalRecvCount = $destFriendHelp->get_todayRecvHelpCount();
        $totalRecvCountLimit = getGlobalValue("FRIEND_HELP_RECV_TOTAL_TIMES_LIMIT")->int_value();

        logicErrorCondition($totalRecvCount < $totalRecvCountLimit,
            err_dbs_friendhelp_player::HELP_RECV_TOTAL_COUNT_MAX,
            "HELP_RECV_TOTAL_COUNT_MAX");
    }

    /**
     * 通用奖励逻辑
     * @param $friendUserId
     * @return array
     */
    private function addAwardNormalLogic($friendUserId)
    {
        $data = [];
        $destPlayer = dbs_player::newGuestPlayerWithLock($friendUserId);
        //增加今日我帮助别人的列表
        $this->addHelpRecord($friendUserId);
        //增加被帮助人的接收帮助的次数
        dbs_friendhelp_player::createWithPlayer($destPlayer)->addRecvHelpTimes(1);
        //奖励游戏币
        $awardGameCoin = getGlobalValue('FRIEND_HELP_AWARD_GAMECOIN')->int_value();
        dbs_role::createWithPlayer($this)->add_gamecoin($awardGameCoin, constants_moneychangereason::FRIEND_HELP_COOK_DISHES);

        $data[constants_returnkey::RK_GAMECOIN] = $awardGameCoin;
        //奖励好感度
        $awardGoodwill = getGlobalValue('FRIEND_HELP_AWARD_GOODWILL')->int_value();
        dbs_friend::createWithPlayer($this)->addFriendGoodWill($friendUserId, $awardGoodwill);
        //发放奖励道具
        $data[constants_returnkey::RK_GOODWILL] = $awardGoodwill;
        return $data;
    }

    /**
     * 帮忙吃菜
     * @param $friendUserId
     * @param int $themeRestaurantId
     * @param $dinnerTableId
     * @return Common_Util_ReturnVar
     */
    public function helpEatDishes($friendUserId, $themeRestaurantId, $dinnerTableId)
    {
        $data = [];
        typeCheckUserId($friendUserId);
        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($dinnerTableId);

        //interface err_dbs_friendhelp_player_helpEatDishes

        $this->checkHelpNormalLogic($friendUserId);

        $destPlayer = dbs_player::newGuestPlayerWithLock($friendUserId);


        logicErrorCondition(dbs_themeRestaurant_Player::createWithPlayer($destPlayer)->isThemeRestaruantOpened($themeRestaurantId),
            err_dbs_friendhelp_player_helpEatDishes::THEME_RESTAURANT_ID_INVALID,
            "THEME_RESTAURANT_ID_INVALID");


        $destSceneData = dbs_scene_player::createWithPlayer($destPlayer)->getThemeRestaurantSceneData($themeRestaurantId);
        $dinnerTableBuilding = $destSceneData->getBuildingByGuid($dinnerTableId);

        logicErrorCondition(!is_null($dinnerTableBuilding),
            err_dbs_friendhelp_player_helpEatDishes::DINNER_TABLE_NOT_EXISTS,
            "DINNER_TABLE_NOT_EXISTS");

        logicErrorCondition($dinnerTableBuilding->isDinnerTable(),
            err_dbs_friendhelp_player_helpEatDishes::DINNER_TABLE_TYPE_ERROR,
            "DINNER_TABLE_TYPE_ERROR");

        $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($dinnerTableBuilding);

//        dump($dinnerTableExtend->toArray());

        logicErrorCondition(!$dinnerTableExtend->isEmpty(),
            err_dbs_friendhelp_player_helpEatDishes::DINNER_TABLE_EMPTY,
            "DINNER_TABLE_EMPTY");

        $price = $dinnerTableExtend->getPrice(1);
        $dishesId = $dinnerTableExtend->get_dishesId();
        $dinnerTableExtend->sellDishes(1, $destPlayer);
        //给被帮助者增加游戏币
        dbs_role::createWithPlayer($destPlayer)->add_gamecoin($price,
            constants_moneychangereason::EAT_FOODS);

        $destSceneData->saveBuildingExtend($dinnerTableBuilding);

        //增加到对方的帮忙详细列表中
        dbs_friendhelp_player::createWithPlayer($destPlayer)
            ->addHelpDinnerTable($themeRestaurantId,
                $dinnerTableId,
                $this->db_owner);


        //处理通用逻辑,发放通用奖励
        $awardData = $this->addAwardNormalLogic($friendUserId);
        $data = array_merge($data, $awardData);


        //发放道具奖励,暂时先这样
        $awardConfig = getConfigData(configdata_friend_help_eat_award_setting::class,
            configdata_friend_help_eat_award_setting::k_itemid,
            $dishesId);
        if (!is_null($awardConfig)) {
            dbs_warehouse::additemtowarehouse($this->db_owner,
                $awardConfig[configdata_friend_help_eat_award_setting::k_awarditemid],
                $awardConfig[configdata_friend_help_eat_award_setting::k_awarditemcount],
                true);

            $data[constants_returnkey::RK_ITEMID] = $awardConfig[configdata_friend_help_eat_award_setting::k_awarditemid];
            $data[constants_returnkey::RK_ITEMCOUNT] = $awardConfig[configdata_friend_help_eat_award_setting::k_awarditemcount];

        }


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 增加帮忙吃在数据
     * @param $themeRestaurantId
     * @param $dinnerTableId
     * @param dbs_player $helper
     */
    private function addHelpDinnerTable($themeRestaurantId, $dinnerTableId, dbs_player $helper)
    {
        $helpDinnerTables = $this->get_helpedDinnerTables();
        if (isset($helpDinnerTables[$dinnerTableId])) {
            $helpDinnerTable = dbs_friendhelp_helpDinnerTableData::create_with_array($helpDinnerTables[$dinnerTableId]);
        } else {
            $helpDinnerTable = dbs_friendhelp_helpDinnerTableData::create($themeRestaurantId, $dinnerTableId);
        }
        $helpDinnerTable->addHelpData($helper->get_userid(), 1);
        $helpDinnerTables[$dinnerTableId] = $helpDinnerTable->toArray();
        $this->set_helpedDinnerTables($helpDinnerTables);

    }


    /**
     * 接收帮忙吃菜
     * @return Common_Util_ReturnVar
     */
    public function helpRecvEatDishes()
    {
        $data = [];
        //interface err_dbs_friendhelp_player_helpRecvEatDishes
        $helpDinnerTables = $this->get_helpedDinnerTables();
        if (!empty($helpDinnerTables)) {
            $this->set_helpedDinnerTables([]);
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 帮忙加速做菜
     * @param $friendUserId
     * @param $cookingTableId
     * @param int $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function helpCookDishes($friendUserId, $themeRestaurantId, $cookingTableId)
    {
        $data = [];
        typeCheckUserId($friendUserId);
        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($cookingTableId);

        $this->checkHelpNormalLogic($friendUserId);

        $destPlayer = dbs_player::newGuestPlayerWithLock($friendUserId);

        logicErrorCondition(dbs_themeRestaurant_Player::createWithPlayer($destPlayer)->isThemeRestaruantOpened($themeRestaurantId),
            err_dbs_friendhelp_player_helpCookDishes::THEME_RESTAURANT_ID_INVALID,
            "THEME_RESTAURANT_ID_INVALID");


        $destSceneData = dbs_scene_player::createWithPlayer($destPlayer)->getThemeRestaurantSceneData($themeRestaurantId);
        $cookingTableBuilding = $destSceneData->getBuildingByGuid($cookingTableId);

        logicErrorCondition(!is_null($cookingTableBuilding),
            err_dbs_friendhelp_player_helpCookDishes::COOKING_TABLE_NOT_EXISTS,
            "COOKING_TABLE_NOT_EXISTS");

        logicErrorCondition($cookingTableBuilding->isCooktable(),
            err_dbs_friendhelp_player_helpCookDishes::COOKING_TABLE_TYPE_ERROR,
            "COOKING_TABLE_TYPE_ERROR");
        $cookingTableExtend = dbs_scene_buildingExtend_cookTable::create($cookingTableBuilding);

        //不是在等待完成
        logicErrorCondition($cookingTableExtend->isStatusWaitFinish(),
            err_dbs_friendhelp_player_helpCookDishes::COOKING_TABLE_STATUS_ERROR,
            "COOKING_TABLE_STATUS_ERROR");

        logicErrorCondition($cookingTableExtend->is_Cooldown(),
            err_dbs_friendhelp_player_helpCookDishes::COOKING_TABLE_COOKING_FINISH,
            "COOKING_TABLE_COOKING_FINISH");

        $reduceTime = getGlobalValue("FRIEND_HELP_SPEEDUP_COOK_REDUCE_SECONDS")->int_value();

        $cookingTableExtend->reduceCooldownTime($reduceTime);
        $cookingTableExtend->save();
        //增加到对方的烹饪台帮忙列表中
        dbs_friendhelp_player::createWithPlayer($destPlayer)->addHelpCookingTable($themeRestaurantId,
            $cookingTableId,
            $this->db_owner);
        //保存烹饪台
        $destSceneData->saveBuildingExtend($cookingTableBuilding);


        //处理通用逻辑,发放通用奖励
        $awardData = $this->addAwardNormalLogic($friendUserId);
        $data = array_merge($data, $awardData);

        //发放奖励道具
        $awardItemPercent = getGlobalValue('FRIEND_HELP_AWARD_ITEM_PERCENT')->int_value();
        if (rand(0, 10000) < $awardItemPercent) {
            $awardConfigIds = [];

            foreach (configdata_friend_help_normal_award_setting::data() as $configData) {
                $awardConfigIds[$configData[configdata_friend_help_normal_award_setting::k_id]] =
                    intval($configData[configdata_friend_help_normal_award_setting::k_weight]);
            }

            $awardConfigId = Common_Util_Random::RandomWithWeight($awardConfigIds);
            //奖励道具配置
            $awardConfig = getConfigData(configdata_friend_help_normal_award_setting::class,
                configdata_friend_help_normal_award_setting::k_id,
                $awardConfigId);

            dbs_warehouse::additemtowarehouse($this->db_owner,
                $awardConfig[configdata_friend_help_normal_award_setting::k_awarditemid],
                $awardConfig[configdata_friend_help_normal_award_setting::k_awarditemcount],
                true);

            $data[constants_returnkey::RK_ITEMID] = $awardConfig[configdata_friend_help_normal_award_setting::k_awarditemid];
            $data[constants_returnkey::RK_ITEMCOUNT] = $awardConfig[configdata_friend_help_normal_award_setting::k_awarditemcount];

        }

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 增加帮忙烹饪数据
     * @param $themeRestaurantId
     * @param $cookingTableId
     * @param dbs_player $helper
     */
    private function addHelpCookingTable($themeRestaurantId, $cookingTableId, dbs_player $helper)
    {
        $helpCookingTables = $this->get_helpedCookingTables();
        if (isset($helpCookingTables[$cookingTableId])) {
            $helpCookingTable = dbs_friendhelp_helpCookingTableData::create_with_array($helpCookingTables[$cookingTableId]);
        } else {
            $helpCookingTable = dbs_friendhelp_helpCookingTableData::create($themeRestaurantId, $cookingTableId);
        }
        $helpCookingTable->addHelpData($helper->get_userid(), 1);
        $helpCookingTables[$cookingTableId] = $helpCookingTable->toArray();
        $this->set_helpedCookingTables($helpCookingTables);

    }

    /**
     * 获取帮忙烹饪台数据
     * @param $cookingTableId
     * @return dbs_friendhelp_helpCookingTableData|null
     */
    private function getHelpCookingTableData($cookingTableId)
    {
        $helpCookingTables = $this->get_helpedCookingTables();
        if (isset($helpCookingTables[$cookingTableId])) {
            $helpCookingTable = dbs_friendhelp_helpCookingTableData::create_with_array($helpCookingTables[$cookingTableId]);
            return $helpCookingTable;
        }
        return null;
    }

    /**
     * 接收帮忙做菜,只是清空帮忙数据
     * @param $themeRestaurantId
     * @param $cookingTableId
     * @return Common_Util_ReturnVar
     */
    public function helpRecvCookDishes($themeRestaurantId, $cookingTableId)
    {
        $data = [];
        //interface err_dbs_friendhelp_player_helpRecvCookDishes

        $helpCookingTables = $this->get_helpedCookingTables();
        if (isset($helpCookingTables[$cookingTableId])) {
            unset($helpCookingTables[$cookingTableId]);
            $this->set_helpedCookingTables($helpCookingTables);
        }
        //暂时不做任何处理了,日后发放天使翅膀

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 帮忙加速扩建
     * @param $friendUserId
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function helpExpand($friendUserId, $themeRestaurantId)
    {
        $data = [];
        //interface err_dbs_friendhelp_player_helpExpand

        typeCheckGUID($friendUserId);
        $this->checkHelpNormalLogic($friendUserId);

        $destPlayer = dbs_player::newGuestPlayerWithLock($friendUserId);
        logicErrorCondition(dbs_themeRestaurant_Player::createWithPlayer($destPlayer)->isThemeRestaruantOpened($themeRestaurantId),
            err_dbs_friendhelp_player_helpExpand::THEME_RESTAURANT_ID_INVALID,
            "THEME_RESTAURANT_ID_INVALID");

        $destSceneData = dbs_scene_player::createWithPlayer($destPlayer)->getThemeRestaurantSceneData($themeRestaurantId);

        $expandData = $destSceneData->getExpandData();

//        dump($expandData->toArray());
        logicErrorCondition($expandData->is_Cooldown(),
            err_dbs_friendhelp_player_helpExpand::EXPAND_STATUS_ERROR,
            "EXPAND_STATUS_ERROR");

        $reduceTime = getGlobalValue("FRIEND_HELP_EXPAND_SPEEDUP_REDUCE_TIME")->int_value();

        $expandData->reduceTime($reduceTime);
        $destSceneData->setExpandData($expandData);


        //增加到对方的扩建帮忙列表中
        dbs_friendhelp_player::createWithPlayer($destPlayer)->addHelpExpand($themeRestaurantId,
            $this->db_owner);

        //处理通用逻辑,发放通用奖励
        $awardData = $this->addAwardNormalLogic($friendUserId);
        $data = array_merge($data, $awardData);

        //发放奖励道具
        $awardItemPercent = getGlobalValue('FRIEND_HELP_AWARD_ITEM_PERCENT')->int_value();
        if (rand(0, 10000) < $awardItemPercent) {
            $awardConfigIds = [];

            foreach (configdata_friend_help_normal_award_setting::data() as $configData) {
                $awardConfigIds[$configData[configdata_friend_help_normal_award_setting::k_id]] =
                    intval($configData[configdata_friend_help_normal_award_setting::k_weight]);
            }

            $awardConfigId = Common_Util_Random::RandomWithWeight($awardConfigIds);
            //奖励道具配置
            $awardConfig = getConfigData(configdata_friend_help_normal_award_setting::class,
                configdata_friend_help_normal_award_setting::k_id,
                $awardConfigId);

            dbs_warehouse::additemtowarehouse($this->db_owner,
                $awardConfig[configdata_friend_help_normal_award_setting::k_awarditemid],
                $awardConfig[configdata_friend_help_normal_award_setting::k_awarditemcount],
                true);

            $data[constants_returnkey::RK_ITEMID] = $awardConfig[configdata_friend_help_normal_award_setting::k_awarditemid];
            $data[constants_returnkey::RK_ITEMCOUNT] = $awardConfig[configdata_friend_help_normal_award_setting::k_awarditemcount];

        }

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 增加帮忙扩建数据
     * @param $themeRestaurantId
     * @param dbs_player $helper
     */
    private function addHelpExpand($themeRestaurantId, dbs_player $helper)
    {
        $helpExpands = $this->get_helpedExpand();
        if (isset($helpExpands[$themeRestaurantId])) {
            $helpExpand = dbs_friendhelp_helpExpandData::create_with_array($helpExpands[$themeRestaurantId]);
        } else {
            $helpExpand = dbs_friendhelp_helpExpandData::create($themeRestaurantId);
        }
        $helpExpand->addHelpData($helper->get_userid(), 1);
        $helpExpands[$themeRestaurantId] = $helpExpand->toArray();
        $this->set_helpedExpand($helpExpands);

    }

    /**
     * 接收加速扩建
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function helpRecvExpand($themeRestaurantId)
    {
        $data = [];
        //interface err_dbs_friendhelp_player_helpRecvExpand
        $helpExpands = $this->get_helpedExpand();
        if (isset($helpExpands[$themeRestaurantId])) {
            unset($helpExpands[$themeRestaurantId]);
            $this->set_helpedExpand($helpExpands);
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


}