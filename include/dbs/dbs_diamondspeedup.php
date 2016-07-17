<?php

namespace dbs;

use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_diamond_speedup_normal;
use configdata\configdata_diamond_speedup_trainchef;
use configdata\configdata_item_dishes_setting;
use constants\constants_mailTemplates;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use constants\constants_roleReputationChangeReason;
use dbs\chef\dbs_chef_list;
use dbs\chef\train\dbs_chef_train_Room;
use dbs\chef\train\dbs_chef_train_RoomData;
use dbs\i\dbs_i_iCooldown;
use dbs\itemgraft\dbs_itemgraft_player;
use dbs\mailbox\dbs_mailbox_data;
use dbs\payout\dbs_payout_player;
use dbs\scene\buildingExtend\dbs_scene_buildingExtend_cookTable;
use dbs\scene\buildingExtend\dbs_scene_buildingExtend_dinnerTable;
use dbs\scene\dbs_scene_player;
use dbs\templates\dbs_templates_diamondspeedup;
use dbs\themeRestaurant\dbs_themeRestaurant_Player;
use err\err_dbs_diamondspeedup_base;
use err\err_dbs_diamondspeedup_getSpeedUpCookTableDiamonds;
use err\err_dbs_diamondspeedup_getSpeedUpDinnerTableDiamonds;
use err\err_dbs_diamondspeedup_speedupcomposeitem;
use err\err_dbs_diamondspeedup_speedupcooktable;
use err\err_dbs_diamondspeedup_speedupdinnertable;
use err\err_dbs_diamondspeedup_speedUpGraft;
use err\err_dbs_diamondspeedup_speedupTrainChef;
use hellaEngine\exception\exception_logicError;

/**
 * 钻石加速
 *
 * @author zhipeng
 *
 */
class dbs_diamondspeedup extends dbs_templates_diamondspeedup
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 获取基础钻石消耗配置
     *
     * @param  $sec
     * @return :string
     */
    private static function _get_speedup_basediamond($sec)
    {
        // dump($sec);
        foreach (configdata_diamond_speedup_normal::data() as $key => $value) {
            // dump($value);
            if ($sec >= intval($value [configdata_diamond_speedup_normal::k_minsec]) && $sec < intval($value [configdata_diamond_speedup_normal::k_maxsec])) {
                return $value;
            }
        }
        return NULL;
    }

    /**
     * 获取清除冷却所用的钻石数量
     * @param dbs_i_iCooldown $coolDownIns
     * @return int
     */
    private static function getClearCoolDownDiamonds(dbs_i_iCooldown $coolDownIns)
    {
        logicErrorCondition($coolDownIns->is_Cooldown(),
            err_dbs_diamondspeedup_base::NOT_COOLDOWN,
            "NOT_COOLDOWN");

        $diamond_config = self::_get_speedup_basediamond($coolDownIns->getCooldownTime());

        logicErrorCondition(!is_null($diamond_config),
            err_dbs_diamondspeedup_base::DIAMOND_SPEEDUP_CONFIG_ERR,
            "DIAMOND_SPEEDUP_CONFIG_ERR",
            ["CooldownTime" => $coolDownIns->getCooldownTime()]);


        //计算需要钻石数量
        $diamonds = $coolDownIns->get_clearCooldownDiamond();
        $diamonds = $diamonds * intval($diamond_config [configdata_diamond_speedup_normal::k_diamond]);

        return $diamonds;
    }

    /**
     * 通用清楚冷却逻辑
     * @param dbs_player $player
     * @param dbs_i_iCooldown $coolDownIns
     * @return Common_Util_ReturnVar
     */
    private static function clearCoolDown(dbs_player $player, dbs_i_iCooldown $coolDownIns)
    {

        //计算需要钻石数量
        $diamonds = self::getClearCoolDownDiamonds($coolDownIns);

        logicErrorCondition($player->db_role()->cost_diamond($diamonds,
            constants_moneychangereason::SPEED_UP_COOKTABLE,
            'SPEED_UP_COOKTABLE'),
            err_dbs_diamondspeedup_base::NOT_ENOUGH_DIAMOND,
            "NOT_ENOUGH_DIAMOND");


        $coolDownIns->clearCooldown();
        $data = [];
        $data [constants_returnkey::RK_DIAMOND] = $diamonds;
        return Common_Util_ReturnVar::RetSucc($data);


    }

    /**
     * 清除冷却
     *
     * @param dbs_i_iCooldown $db_ins
     * @return Common_Util_ReturnVar
     */
    private function _clearcooldown(dbs_i_iCooldown $db_ins)
    {
        return self::clearCoolDown($this->db_owner, $db_ins);
    }

    /**
     * 获取加速做菜所用的钻石数量
     * @param $themeRestaurantId
     * @param string $cooktableGuid
     * @return Common_Util_ReturnVar
     */
    public function getSpeedUpCookTableDiamonds($themeRestaurantId, $cooktableGuid)
    {
        $data = [];

        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($cooktableGuid);

        $dbsScene = dbs_scene_player::createWithPlayer($this->db_owner)->
        getThemeRestaurantSceneData($themeRestaurantId);

        $buildingCell = $dbsScene->getBuildingByGuid($cooktableGuid);

        logicErrorCondition(!is_null($buildingCell),
            err_dbs_diamondspeedup_getSpeedUpCookTableDiamonds::NOT_FOUND_COOK_TABLE,
            "NOT_FOUND_COOK_TABLE");

        logicErrorCondition($buildingCell->isCooktable(),
            err_dbs_diamondspeedup_getSpeedUpCookTableDiamonds::GUID_IS_NOT_COOK_TABLE,
            "GUID_IS_NOT_COOK_TABLE");


        $cooktable = dbs_scene_buildingExtend_cookTable::create($buildingCell);
        $diamonds = self::getClearCoolDownDiamonds($cooktable);
        $data[constants_returnkey::RK_DIAMOND] = $diamonds;
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 加速炉灶做菜
     *
     * @param int $themeRestaurantId 主题餐厅ID
     * @param string $cooktableGuid
     * @return Common_Util_ReturnVar
     */
    function speedupcooktable($themeRestaurantId, $cooktableGuid)
    {

        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($cooktableGuid);

        $dbsScene = dbs_scene_player::createWithPlayer($this->db_owner)->
        getThemeRestaurantSceneData($themeRestaurantId);

        $buildingCell = $dbsScene->getBuildingByGuid($cooktableGuid);

        logicErrorCondition(!is_null($buildingCell),
            err_dbs_diamondspeedup_speedupcooktable::NOT_FOUND_COOK_TABLE,
            "NOT_FOUND_COOK_TABLE");

        logicErrorCondition($buildingCell->isCooktable(),
            err_dbs_diamondspeedup_speedupcooktable::GUID_IS_NOT_COOK_TABLE,
            "GUID_IS_NOT_COOK_TABLE");


        $cooktable = dbs_scene_buildingExtend_cookTable::create($buildingCell);

        // 通用逻辑//清除冷却
        $db_ins = $cooktable;
        $clearReturn = $this->_clearcooldown($db_ins);
        if ($clearReturn->is_succ()) {
            $db_ins->save();
            $dbsScene->saveBuildingExtend($buildingCell);
            // 任务
            $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_11, 1);
        }

        return $clearReturn;

    }

    /**
     * 获取加速扩建所用的钻石数量
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function getSpeedUpSceneExpandDiamonds($themeRestaurantId)
    {
        $data = [];
        $dbs_scene_data = dbs_scene_player::createWithPlayer($this->db_owner)->getThemeRestaurantSceneData($themeRestaurantId);

        $expandData = $dbs_scene_data->getExpandData();
        $diamonds = self::getClearCoolDownDiamonds($expandData);
        $data[constants_returnkey::RK_DIAMOND] = $diamonds;
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 加速场景扩地
     * @param string $themeRestaurantId 主题餐厅ID
     * @return Common_Util_ReturnVar
     */
    function speedupsceneexpand($themeRestaurantId)
    {

        // 通用逻辑//清除冷却

        $dbs_scene_data = dbs_scene_player::createWithPlayer($this->db_owner)->getThemeRestaurantSceneData($themeRestaurantId);

        $expandData = $dbs_scene_data->getExpandData();
        $clearReturn = self::clearCoolDown($this->db_owner, $expandData);

        $dbs_scene_data->setExpandData($expandData);
        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_13, 1);
        return $clearReturn;

    }

    /**
     * 加速合成
     *
     * @param int $slotid
     *            合成位置id
     * @return Common_Util_ReturnVar
     */
    function speedupcomposeitem($slotid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        $slotid = intval($slotid);

        $db_slotdata = $this->db_owner->db_compose_item()->get_slots_data($slotid);

        if (is_null($db_slotdata)) {
            $retCode = err_dbs_diamondspeedup_speedupcomposeitem::NOT_SLOT_DATA;
            $retCode_Str = 'NOT_SLOT_DATA';
            goto failed;
        }

        // 通用逻辑//清除冷却
        $clearret = self::clearCoolDown($this->db_owner, $db_slotdata);
        $this->db_owner->db_compose_item()->set_slots_data($db_slotdata);
        return $clearret;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取加速餐台吃饭钻石数
     * @param $themeRestaurantId
     * @param $dinnerTableGuid
     * @return Common_Util_ReturnVar
     */
    public function getSpeedUpDinnerTableDiamonds($themeRestaurantId, $dinnerTableGuid)
    {
        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($dinnerTableGuid);

        logicErrorCondition(dbs_themeRestaurant_Player::createWithPlayer($this)->isThemeRestaruantOpened($themeRestaurantId),
            err_dbs_diamondspeedup_getSpeedUpDinnerTableDiamonds::THEME_RESTAURANT_NOT_OPEN,
            "THEME_RESTAURANT_NOT_OPEN");

        $sceneData = dbs_scene_player::createWithPlayer($this)->getThemeRestaurantSceneData($themeRestaurantId);
        $building = $sceneData->getBuildingByGuid($dinnerTableGuid);
        logicErrorCondition(!is_null($building),
            err_dbs_diamondspeedup_getSpeedUpDinnerTableDiamonds::NOT_FOUND_DINNER_TABLE,
            "NOT_FOUND_DINNER_TABLE");

        logicErrorCondition($building->isDinnerTable(),
            err_dbs_diamondspeedup_getSpeedUpDinnerTableDiamonds::GUID_IS_NOT_DINNER_TABLE,
            "GUID_IS_NOT_DINNER_TABLE");
        $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($building);

        //吃菜加速的钻石数量是特殊的,需要特殊机选
        $dishedId = $dinnerTableExtend->get_dishesId();
        $dishesConfig = getConfigData(configdata_item_dishes_setting::class,
            configdata_item_dishes_setting::k_id, $dishedId);
        //加速吃单份菜用的钻石数量
        $diamondBase = $dishesConfig[configdata_item_dishes_setting::k_speedupeatdiamondonepiece];
        //加速需要的总的钻石数量
        $diamonds = $diamondBase * $dinnerTableExtend->getDishesCount();

        $data = [];
        $data [constants_returnkey::RK_DIAMOND] = $diamonds;
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 加速餐台吃饭
     * @param int $themeRestaurantId 主题餐厅ID
     * @param string $dinnerTableGuid 餐台ID
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function speedupdinnertable($themeRestaurantId, $dinnerTableGuid)
    {

        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($dinnerTableGuid);

        logicErrorCondition(dbs_themeRestaurant_Player::createWithPlayer($this)->isThemeRestaruantOpened($themeRestaurantId),
            err_dbs_diamondspeedup_speedupdinnertable::THEME_RESTAURANT_NOT_OPEN,
            "THEME_RESTAURANT_NOT_OPEN");

        $sceneData = dbs_scene_player::createWithPlayer($this)->getThemeRestaurantSceneData($themeRestaurantId);
        $building = $sceneData->getBuildingByGuid($dinnerTableGuid);
        logicErrorCondition(!is_null($building),
            err_dbs_diamondspeedup_speedupdinnertable::NOT_FOUND_DINNER_TABLE,
            "NOT_FOUND_DINNER_TABLE");

        logicErrorCondition($building->isDinnerTable(),
            err_dbs_diamondspeedup_speedupdinnertable::GUID_IS_NOT_DINNER_TABLE,
            "GUID_IS_NOT_DINNER_TABLE");


        $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($building);
        $awardGameCoin = $dinnerTableExtend->getPrice($dinnerTableExtend->getDishesCount());

        //吃菜加速的钻石数量是特殊的,需要特殊机选
        $dishedId = $dinnerTableExtend->get_dishesId();
        $dishesConfig = getConfigData(configdata_item_dishes_setting::class,
            configdata_item_dishes_setting::k_id, $dishedId);
        //加速吃单份菜用的钻石数量
        $diamondBase = $dishesConfig[configdata_item_dishes_setting::k_speedupeatdiamondonepiece];
        //加速需要的总的钻石数量
        $diamonds = $diamondBase * $dinnerTableExtend->getDishesCount();
        //扣除钻石
        logicErrorCondition($this->db_owner->db_role()->cost_diamond($diamonds,
            constants_moneychangereason::SPEED_UP_COOKTABLE,
            'SPEED_UP_COOKTABLE'),
            err_dbs_diamondspeedup_base::NOT_ENOUGH_DIAMOND,
            "NOT_ENOUGH_DIAMOND");

        //增加出售菜的游戏币
        dbs_role::createWithPlayer($this)->add_gamecoin($awardGameCoin, constants_moneychangereason::EAT_FOODS);

        $dinnerTableExtend->sellDishes($dinnerTableExtend->getDishesCount(), $this->db_owner);
        $sceneData->saveBuildingExtend($building);

        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_12, 1);

        $data = [];
        $data [constants_returnkey::RK_DIAMOND] = $diamonds;
        $data [constants_returnkey::RK_GAMECOIN] = $awardGameCoin;
        return Common_Util_ReturnVar::RetSucc($data);


    }


    /**
     * 加速嫁接
     * @param $destUserId
     * @param $slotId
     * @return Common_Util_ReturnVar
     */
    public function speedUpGraft($destUserId, $slotId)
    {

        typeCheckUserId($destUserId);
        typeCheckString($slotId, 10);

        $destPlayer = dbs_player::newGuestPlayerWithLock($destUserId);

        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_diamondspeedup_speedUpGraft::DEST_PLAYER_NOT_EXIST,
            "DEST_PLAYER_NOT_EXIST");


        $itemGraft = dbs_itemgraft_player::createWithPlayer($destPlayer);
        if (!$itemGraft instanceof dbs_itemgraft_player) {

        }

        $graftData = $itemGraft->getSlotData($slotId);
        logicErrorCondition(!is_null($graftData),
            err_dbs_diamondspeedup_speedUpGraft::SLOT_ID_ERROR,
            "SLOT_ID_ERROR");


        logicErrorCondition($graftData->isGrafting(),
            err_dbs_diamondspeedup_speedUpGraft::SLOT_STATUS_ERROR,
            "SLOT_STATUS_ERROR");


        $clearReturn = $this->_clearcooldown($graftData);
        if ($clearReturn->is_succ()) {
            $itemGraft->setSlotData($graftData);
            $costDiamond = $clearReturn->get_retdata()[constants_returnkey::RK_DIAMOND];


            //增加钻石价值
            //利益输送.钻石价值
            $graftUserId = $destUserId;
            $graftedUserId = $graftData->get_helpPlayerInfo()[self::DBKey_userid];
            //第三方加速.付出减半
            $thirdSpeedUp = false;
            if ($graftedUserId !== $this->get_userid() && $graftUserId !== $this->get_userid()) {
                $payoutValue = floor($costDiamond / 2);
                $thirdSpeedUp = true;
            } else {
                $payoutValue = $costDiamond;
            }

            $payout = dbs_payout_player::createWithPlayer($this->db_owner);
            if ($payout instanceof dbs_payout_player) {
                try {
                    $payout->addDiamondValue($graftUserId, $payoutValue);
                } catch (exception_logicError $e) {

                }
                try {
                    $payout->addDiamondValue($graftedUserId, $payoutValue);
                } catch (exception_logicError $e) {

                }
            }

            //如果是第三方加速
            if ($thirdSpeedUp) {
                //给被嫁接方发邮件
                dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_SPEEDUP,
                    [], $this->get_userid())->send($graftUserId);
                dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_SPEEDUP,
                    [], $this->get_userid())->send($graftedUserId);


            } else {
                //给对方发邮件
                $mailUserId = $graftUserId == $this->get_userid() ? $graftedUserId : $graftUserId;
                dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_SPEEDUP,
                    [], $this->get_userid())->send($mailUserId);

            }


            $role = $this->db_owner->db_role();
            //增加自己声望
            $reputation = $role->addReputationByDiamond($costDiamond, constants_roleReputationChangeReason::SPEEDUP_GRAFT);
            /**
             * 增加加速返回
             */
            $clearReturn->add_retData(constants_returnkey::RK_REPUTATION, $reputation);
        }


        return $clearReturn;

    }


    /**
     * 获取培训厨师使用钻石配置
     * @param $time
     * @return null
     */
    private function getSpeedUpTrainChefConfig($time)
    {
        foreach (configdata_diamond_speedup_trainchef::data() as $key => $data) {
            if ($time >= intval($data[configdata_diamond_speedup_trainchef::k_minsec])
                && $time < intval($data[configdata_diamond_speedup_trainchef::k_maxsec])
            ) {
                return $data;
            }
        }
        return null;
    }

    /**
     * 加速培训
     * @param string $chefId 自己参加培训的厨师ID
     * @return Common_Util_ReturnVar
     */
    public function speedupTrainChef($chefId)
    {
        //interface err_dbs_diamondspeedup_speedupTrainChef

        $chefData = dbs_chef_list::createWithPlayer($this->db_owner)->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_diamondspeedup_speedupTrainChef::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $chefTrainData = $chefData->getTrainData();
        logicErrorCondition($chefTrainData->isTraining(),
            err_dbs_diamondspeedup_speedupTrainChef::CHEF_NOT_IN_TRAIN,
            "CHEF_NOT_IN_TRAIN");


        logicErrorCondition(dbs_chef_list::createWithPlayer($this->db_owner)->
            get_todaySpeedUpTrainChefTimes() < getGlobalValue("CHEF_TRAIN_SPEEDUP_EVERYDAY_MAX_TIMES")->int_value(),
            err_dbs_diamondspeedup_speedupTrainChef::TODAY_SPEEDUP_TIMES_MAX,
            "TODAY_SPEEDUP_TIMES_MAX");


        $trainRoomData = dbs_chef_train_Room::getRoom($chefTrainData->get_trainRoomId());
        //是否是双休
        $isDoubleTrain = $trainRoomData->isDoubleTrain();
        //是否是房主
        $chefTrainIsMaster = $chefTrainData->get_isMaster();

//        $clearReturn = self::clearCoolDown($this->db_owner, $trainRoomData);


        logicErrorCondition($trainRoomData->is_Cooldown(),
            err_dbs_diamondspeedup_base::NOT_COOLDOWN,
            "NOT_COOLDOWN");

        $diamond_config = $this->getSpeedUpTrainChefConfig($trainRoomData->getCooldownTime());

        logicErrorCondition(!is_null($diamond_config),
            err_dbs_diamondspeedup_base::DIAMOND_SPEEDUP_CONFIG_ERR,
            "DIAMOND_SPEEDUP_CONFIG_ERR");
        //计算需要钻石数量
        $diamonds = intval($diamond_config [configdata_diamond_speedup_normal::k_diamond]);
        //扣除钻石
        logicErrorCondition($this->db_owner->db_role()->cost_diamond($diamonds,
            constants_moneychangereason::SPEED_UP_COOKTABLE,
            'SPEED_UP_COOKTABLE'),
            err_dbs_diamondspeedup_base::NOT_ENOUGH_DIAMOND,
            "NOT_ENOUGH_DIAMOND");

        $trainRoomData->clearCooldown();

        $costDiamond = $diamonds;

        //利益输送.钻石价值
        if ($isDoubleTrain) {
            if ($chefTrainIsMaster) {
                $payoutDestUserData = $trainRoomData->get_slaveTrainData();
            } else {
                $payoutDestUserData = $trainRoomData->get_masterTrainData();
            }
            $payoutDestUserId = $payoutDestUserData[dbs_chef_train_RoomData::DBKey_userid];

            dbs_payout_player::createWithPlayer($this->db_owner)->addDiamondValue($payoutDestUserId, $costDiamond);


            //发送邮件
            dbs_mailbox_data::createWithStandardId(constants_mailTemplates::CHEF_TRAIN_SPEEDUP,
                [
                    'diamonds' => $costDiamond,
                    'UserData' => $payoutDestUserData
                ], $this->get_userid())
                ->send($payoutDestUserId);

        }

        $role = $this->db_owner->db_role();
        $reputation = $role->addReputationByDiamond($costDiamond, constants_roleReputationChangeReason::SPEEDUP_TRAIN);

        //增加钻石加速双休的次数
        dbs_chef_list::createWithPlayer($this->db_owner)->addSpeedUpTrainChefTime();
        /**
         * 增加加速返回
         */
        $data = [];
        $data [constants_returnkey::RK_DIAMOND] = $diamonds;
        $data[constants_returnkey::RK_REPUTATION] = $reputation;
        $clearReturn = Common_Util_ReturnVar::RetSucc($data);
        //code...
        return $clearReturn;
    }

}