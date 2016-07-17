<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/27
 * Time: 下午3:03
 */

namespace dbs\custom\eatDishes;


use Common\Db\Common_Db_memcacheObject;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_restaurant_popularity_level_setting;
use constants\constants_chefjob;
use constants\constants_custom;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use constants\constants_scenetype;
use dbs\chef\jobs\dbs_chef_jobs_player;
use dbs\dbs_mission;
use dbs\dbs_role;
use dbs\dbs_userguide;
use dbs\scene\buildingExtend\dbs_scene_buildingExtend_dinnerTable;
use dbs\scene\dbs_scene_buildingData;
use dbs\scene\dbs_scene_player;
use dbs\templates\custom\eatDishes\dbs_templates_custom_eatDishes_player;
use dbs\themeRestaurant\dbs_themeRestaurant_Player;
use err\err_dbs_custom_eatDishes_player_buildEatReceipt;
use err\err_dbs_custom_eatDishes_player_eatByOffline;
use err\err_dbs_custom_eatDishes_player_eatByReceiptAndCustom;
use hellaEngine\exception\exception_logicError;

/**
 * 吃菜服务
 * Class dbs_custom_eatDishes_player
 * @package dbs\custom
 */
class dbs_custom_eatDishes_player extends dbs_templates_custom_eatDishes_player
{
    /**
     * 吃菜票据缓存时间
     *
     * @var int
     */
    const EAT_RECEIPT_CACHE_TIME = 3600;

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
    protected function _set_defaultvalue_offlineEatData()
    {
        $this->set_defaultkeyandvalue(self::DBKey_offlineEatData, dbs_custom_eatDishes_offlineData::dumpDefaultValue());
    }


    /**
     * 更新离线吃饭时间
     */
    private function updateLastOfflineEatTimespan()
    {
        //
        $offline_time_now = time();
//        $offline_time_now = $offline_time_now - ($offline_time_now % constants_custom::EAT_OFFLINE_TIME_INTERVAL);
        $this->set_lastOfflineEatTime($offline_time_now);
    }

    /**
     * @return string
     */
    private function getEatReceiptKey()
    {
        return 'EatReceipt' . $this->get_userid();
    }

    /**
     * 获取票据数据结构
     * @return dbs_custom_eatDishes_receipts
     */
    private function getEatReceiptsData()
    {
        $eatReceiptMemCache = Common_Db_memcacheObject::create($this->getEatReceiptKey());
        $ReceiptsArray = $eatReceiptMemCache->get_value([]);

        return dbs_custom_eatDishes_receipts::create_with_array($ReceiptsArray);
    }

    /**
     * 保存票据数据
     * @param dbs_custom_eatDishes_receipts $data
     */
    private function setEatReceiptsData(dbs_custom_eatDishes_receipts $data)
    {
        $eatReceiptMemCache = Common_Db_memcacheObject::create($this->getEatReceiptKey());
        $eatReceiptMemCache->setExpiration(self::EAT_RECEIPT_CACHE_TIME);
        $eatReceiptMemCache->set_value($data->toArray());
    }

    /**
     * 获取票据
     * @return Common_Util_ReturnVar
     */
    public function getEatReceipts()
    {
        $data = [];
        //interface err_dbs_custom_eatDishesPlayer_getEatReceipts
        $data['receipts'] = $this->getEatReceiptsData()->get_recepits();
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 通过票据的顾客id吃饭
     * @param string $receipt
     * @param string $dinnerTableGuid
     * @param string $customGuid
     * @return Common_Util_ReturnVar
     */
    public function eatByReceiptAndCustom($receipt, $dinnerTableGuid, $customGuid)
    {
        $data = [];
        //interface err_dbs_custom_eatDishes_player_eatByReceiptAndCustom

        typeCheckGUID($receipt);
        typeCheckGUID($dinnerTableGuid);
        $customGuid = strval($customGuid);

        $eatReceiptData = $this->getEatReceiptsData();
        logicErrorCondition($eatReceiptData->receiptInvalid($receipt),
            err_dbs_custom_eatDishes_player_eatByReceiptAndCustom::RECEIPT_ERROR,
            "RECEIPT_ERROR");

        $sceneData = dbs_scene_player::createWithPlayer($this->db_owner)->getMainThemeRestaurantSceneData();

        $dinnerTableBuilding = $sceneData->getBuildingByGuid($dinnerTableGuid);
//        dump($sceneData);
//        dump($dinnerTableBuilding);
        logicErrorCondition(!is_null($dinnerTableBuilding) && $dinnerTableBuilding->isDinnerTable(),
            err_dbs_custom_eatDishes_player_eatByReceiptAndCustom::DINNERTABLE_ID_INVALID,
            "DINNERTABLE_ID_INVALID");

        //TODO 缺少特殊NPC好感度增加

        $eatReturnData = $this->eatDishesByDinnerTableGUID(1, $dinnerTableGuid);

        $data = $eatReturnData->get_retdata();

        //删除票据
        $eatReceiptData->deleteReceipt($receipt);
        $this->setEatReceiptsData($eatReceiptData);


        $this->updateLastOfflineEatTimespan();


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取小费
     * @param $dishesPrice
     * @return float
     */
    private function getTipGameCoin($dishesPrice)
    {
        //目前暂时定10%小费
        $tipGameCoin = 0.1 * intval($dishesPrice);
        $tipGameCoin = floor($tipGameCoin);
        return $tipGameCoin;

    }

    /**
     * 吃特定餐厅的菜品
     * @param $eatCount
     * @param $dinnerTableGuid
     * @return Common_Util_ReturnVar
     */
    private function eatDishesByDinnerTableGUID($eatCount, $dinnerTableGuid)
    {
        $data = [];
        //interface err_dbs_custom_eatDishes_player_eatDishesByDinnerTableGUID
        $sceneData = dbs_scene_player::createWithPlayer($this->db_owner)->getMainThemeRestaurantSceneData();

        typeCheckNumber($eatCount);
        typeCheckString($dinnerTableGuid);

        $dinnerTableBuilding = $sceneData->getBuildingByGuid($dinnerTableGuid);
        if (!is_null($dinnerTableBuilding)) {
            $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($dinnerTableBuilding);
            $earnGameCoin = $dinnerTableExtend->getPrice($eatCount);
            $realEatCount = $dinnerTableExtend->sellDishes($eatCount, $this->db_owner);

            //保存数据
            $sceneData->saveBuildingExtend($dinnerTableBuilding);
            $tipGameCoin = $this->getTipGameCoin($earnGameCoin);

            //出售价格
            dbs_role::createWithPlayer($this->db_owner)->add_gamecoin($earnGameCoin + $tipGameCoin, constants_moneychangereason::EAT_FOODS);
            dbs_mission::createWithPlayer($this->db_owner)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_59, $earnGameCoin + $tipGameCoin);

            $data[constants_returnkey::RK_PIECE] = $realEatCount;
            $data[constants_returnkey::RK_GAMECOIN] = $earnGameCoin;
            $data[constants_returnkey::RK_TIP_GAMECOIN] = $tipGameCoin;

        }

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 查找有食物的餐台
     * @return array
     */
    private function findHasFoodDinnerTables()
    {
        $sceneData = dbs_scene_player::createWithPlayer($this->db_owner)->getMainThemeRestaurantSceneData();
        $buildings = $sceneData->getBuildingCellsBySubtype(constants_scenetype::SCENETYPE_3);

        $validDinnerTables = [];


        foreach ($buildings as $building) {

            if ($building instanceof dbs_scene_buildingData) {
                $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($building);
                if (!$dinnerTableExtend->isEmpty()) {
                    $validDinnerTables[$dinnerTableExtend->getBuildingData()->get_guid()] = $building;
                }
            }
        }

        return $validDinnerTables;
    }

    /**
     * 生成吃菜的票据
     * @return Common_Util_ReturnVar
     */
    private function buildEatReceipt()
    {
        $data = [];
        //interface err_dbs_custom_eatDishes_player_buildEatReceipt

        $receiptsObject = $this->getEatReceiptsData();

        $receipts = $receiptsObject->get_recepits();
        $time_now = time();
        $time_now = $time_now - ($time_now % constants_custom::EAT_TIME_INTERVAL);
        $lastBuildReceiptsTime = $time_now - constants_custom::EAT_TIME_INTERVAL;
        if ($receiptsObject->get_lastBuildReceiptsTime() !== 0) {
            $lastBuildReceiptsTime = $receiptsObject->get_lastBuildReceiptsTime();
        }
        $time_interval = $time_now - $lastBuildReceiptsTime;

        // 可以吃的次数
        $eatTimes = intval($time_interval / constants_custom::EAT_TIME_INTERVAL);
        // $eattimes = 1;
        // 修正最多吃一次
        $eatTimes = min([
            $eatTimes,
            1
        ]);

//        dump($eatTimes);

        logicErrorCondition($eatTimes >= 1,
            err_dbs_custom_eatDishes_player_buildEatReceipt::NOT_ENOUGH_TIME,
            "NOT_ENOUGH_TIME");

        // 本次可以生产的票据数量
        $eat_total_count = $eatTimes * $this->getCustomFlow();
        $dinnerTables = $this->findHasFoodDinnerTables();

        logicErrorCondition($eat_total_count != 0 && !empty($dinnerTables),
            err_dbs_custom_eatDishes_player_buildEatReceipt::NOT_DINNERTABLE_HAS_FOOD,
            "NOT_DINNERTABLE_HAS_FOOD");
        // 设置最后一次吃饭的时间
        $lastBuildReceiptsTime = $time_now;


        // 剩余菜品总数量
        $dishesCount = 0;
        foreach ($dinnerTables as $dinnertable) {
            $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($dinnertable);
            $dishesCount += $dinnerTableExtend->getDishesCount();
        }

        // 最多可以生产的票据数量
        $availableReceiptMaxCount = max([
            $dishesCount - count($receipts),
            0
        ]);
        $loopCount = min([
            $eat_total_count,
            $availableReceiptMaxCount
        ]);

        logicErrorCondition($loopCount > 0,
            err_dbs_custom_eatDishes_player_buildEatReceipt::RECEIPTS_FULL,
            "RECEIPTS_FULL");

        //创建票据
        $receiptsObject->createNewReceipt($loopCount);
        $receiptsObject->set_lastBuildReceiptsTime($lastBuildReceiptsTime);

        $this->setEatReceiptsData($receiptsObject);

        $data = $receiptsObject->toArray();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取客流
     * @return int
     */
    private function getCustomFlow()
    {
        $mainRestaurantId = dbs_themeRestaurant_Player::createWithPlayer($this->db_owner)->get_mainRestaurantId();
        if($mainRestaurantId == 0)
        {
            return 0;
        }
        $reputationLevel = dbs_themeRestaurant_Player::createWithPlayer($this->db_owner)->getReputationLevel($mainRestaurantId);

        $restaurantPopularityConfig = getConfigData(configdata_restaurant_popularity_level_setting::class,
            configdata_restaurant_popularity_level_setting::k_level, $reputationLevel);
        $customFlow = intval($restaurantPopularityConfig[configdata_restaurant_popularity_level_setting::k_customflow]);
        return $customFlow;
    }

    /**
     * 获取离线吃饭间隔.秒
     * @return int
     */
    private function getEatIntervalOffline()
    {
        return getGlobalValue("CUSTOM_EAT_TIME_INTERVAL_OFFLINE")->int_value();
    }

    /**
     * 离线吃饭
     * @return Common_Util_ReturnVar
     */
    public function eatByOffline()
    {
        $data = [];
        //interface err_dbs_custom_eatDishes_player_eatByOffline

        logicErrorCondition(dbs_userguide::createWithPlayer($this->db_owner)->isOffLineEat(),
            err_dbs_custom_eatDishes_player_eatByOffline::EAT_OFFLINE_SYSTEM_NOT_OPEN,
            "EAT_OFFLINE_SYSTEM_NOT_OPEN");

        $eatTimeInterval = $this->getEatIntervalOffline();
//        dump($eatTimeInterval);

        $startTime = $this->get_lastOfflineEatTime();

        $time_now = time();
        //修正时间戳为间隔时间戳
        $time_now = $time_now - ($time_now % $eatTimeInterval);

        $time_interval = $time_now - $startTime;
        // 可以吃的次数
        $eatTimes = intval($time_interval / $eatTimeInterval);

        logicErrorCondition($eatTimes > 0,
            err_dbs_custom_eatDishes_player_eatByOffline::NOT_ENOUGH_TIME,
            "NOT_ENOUGH_TIME");

        $eatTotalCount = $eatTimes * $this->getCustomFlow();
        // 设置最后一次吃饭的时间
        $this->set_lastOfflineEatTime($time_now);

        //所有有菜的餐台
        $dinnerTables = $this->findHasFoodDinnerTables();

        $canEatTotal = 0;
        foreach ($dinnerTables as $guid => $dinnerTable) {
            $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($dinnerTable);
            $canEatTotal += $dinnerTableExtend->getDishesCount();
        }

        //最终可以出售的数量
        $sellTotalCount = $sellCount = min([$eatTotalCount, $canEatTotal]);
        $sellPrice = 0;


        while (true) {
            foreach ($dinnerTables as $guid => $dinnerTable) {
                $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($dinnerTable);
                if ($dinnerTableExtend->getDishesCount() > 0) {
                    //出售总价格
                    $sellPrice += $dinnerTableExtend->getPrice();
                    $dinnerTableExtend->sellDishes(1, $this->db_owner);
                    $sellCount--;
                    if ($sellCount <= 0) {
                        break;
                    }
                }
            }
            if ($sellCount <= 0) {
                break;
            }
        }

        //保存场景数据
        $sceneData = dbs_scene_player::createWithPlayer($this->db_owner)->getMainThemeRestaurantSceneData();
        foreach ($dinnerTables as $guid => $dinnerTable) {
            $sceneData->saveBuildingExtend($dinnerTable);
        }

        $sellPriceTip = $this->getTipGameCoin($sellPrice);

        $offlineData = new dbs_custom_eatDishes_offlineData();
        $offlineData->set_startTime($startTime);
        $offlineData->set_endTime($this->get_lastOfflineEatTime());
        $offlineData->set_pieces($sellTotalCount);
        $offlineData->set_earnGameCoin($sellPrice);
        $offlineData->set_earnTipGameCoin($sellPriceTip);

        $this->set_offlineEatData($offlineData->toArray());


        $this->db_owner->db_role()->add_gamecoin($sellPrice + $sellPriceTip
            , constants_moneychangereason::EAT_FOODS);
        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_59,
            $sellPrice + $sellPriceTip);


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @inheritDoc
     */
    function masterbeforecall()
    {
        try {
            $this->buildEatReceipt();
        } catch (exception_logicError $e) {

        }
    }


}