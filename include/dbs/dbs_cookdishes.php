<?php

namespace dbs;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_item_cooktable_upgrade_setting;
use configdata\configdata_item_dishes_setting;
use constants\constants_mission;
use constants\constants_returnkey;
use constants\constants_scenetype;
use dbs\chef\dbs_chef_list;
use dbs\chef\employ\dbs_chef_employ_player;
use dbs\chef\jobs\dbs_chef_jobs_player;
use dbs\dishesHandbook\dbs_dishesHandbook_player;
use dbs\friendhelp\dbs_friendhelp_player;
use dbs\scene\buildingExtend\dbs_scene_buildingExtend_cookTable;
use dbs\scene\buildingExtend\dbs_scene_buildingExtend_dinnerTable;
use dbs\scene\dbs_scene_player;
use err\err_dbs_cookdishes_BeginCookDishes;
use err\err_dbs_cookdishes_clearcooktable;
use err\err_dbs_cookdishes_cleardinnertable;
use err\err_dbs_cookdishes_cookDishesByStep;
use err\err_dbs_cookdishes_cookDishesHarvest;
use err\err_dbs_cookdishes_ungradecooktable;
use hellaEngine\exception\exception_logicError;

class dbs_cookdishes extends dbs_baseplayer
{
    function __construct()
    {
        parent::__construct('cook', array(
            self::DBKey_userid => ''
        ), array(
            self::DBKey_userid
        ));
    }

    /**
     * 开始烹饪
     * @param $themeRestaurantId
     * @param string $buildingGuid 建筑ID
     * @param $cookbookId
     * @param int $cookMaterialItemId1 食材1的ID如果没有为-1
     * @param int $cookMaterialItemId2 食材2的ID如果没有为-1
     * @param int $cookMaterialItemId3 食材3的ID如果没有为-1
     * @param int $cookMaterialItemId4 食材4的ID如果没有为-1
     * @return Common_Util_ReturnVar
     */
    public function BeginCookDishes(
        $themeRestaurantId,
        $buildingGuid,
        $cookbookId,
        $cookMaterialItemId1,
        $cookMaterialItemId2,
        $cookMaterialItemId3,
        $cookMaterialItemId4)
    {
        $data = [];
        //interface err_dbs_cookdishes_BeginCookDishes


        typeCheckGUID($buildingGuid);
//        typeCheckGUID($chefId);

        typeCheckString($cookbookId);
        typeCheckNumber($themeRestaurantId);

        $chefData = dbs_chef_jobs_player::createWithPlayer($this->db_owner)->getJobChefData();
        logicErrorCondition(!is_null($chefData),
            err_dbs_cookdishes_BeginCookDishes::JOB_CHEF_NOT_PERSON,
            "JOB_CHEF_NOT_PERSON");

        $chefId = $chefData->get_chefId();

        logicErrorCondition(dbs_cookbook::createWithPlayer($this->db_owner)->enabled($cookbookId),
            err_dbs_cookdishes_BeginCookDishes::COOKBOOK_INVALID,
            "COOKBOOK_INVALID");

        $sceneData = dbs_scene_player::createWithPlayer($this->db_owner)->getThemeRestaurantSceneData($themeRestaurantId);
        $cooktableCell = $sceneData->getBuildingByGuid($buildingGuid);
        logicErrorCondition(!is_null($cooktableCell),
            err_dbs_cookdishes_BeginCookDishes::COOKTABLE_NOT_EXISTS,
            "COOKTABLE_NOT_EXISTS");


        logicErrorCondition($cooktableCell->isCooktable(),
            err_dbs_cookdishes_BeginCookDishes::COOKTABLE_NOT_EXISTS,
            "COOKTABLE_NOT_EXISTS");

        $isHired = false;
        $chef = dbs_chef_list::createWithPlayer($this->db_owner)->get_chef($chefId);
        if (is_null($chef)) {
            $isHired = true;
            $chef = dbs_chef_employ_player::createWithPlayer($this->db_owner)->getEmployeeChefData($chefId);
        }

        logicErrorCondition(!is_null($chef),
            err_dbs_cookdishes_BeginCookDishes::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $cooktableExtend = dbs_scene_buildingExtend_cookTable::create($cooktableCell);
        $data = $cooktableExtend->BeginCookDishes($this->db_owner,
            $themeRestaurantId,
            $cookbookId,
            $chef,
            $cookMaterialItemId1,
            $cookMaterialItemId2,
            $cookMaterialItemId3,
            $cookMaterialItemId4)->get_retdata();

        //保存数据
        $sceneData->saveBuildingExtend($cooktableCell);

//        dump($chef-
        if ($isHired) {
            dbs_chef_employ_player::createWithPlayer($this->db_owner)->setEmployeeChefData($chef);
        } else {
            dbs_chef_list::createWithPlayer($this->db_owner)->set_chef($chef);
        }

        $data = $cooktableCell->toArray();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取做菜的配置
     *
     * @param string $dishesid
     * @return Ambigous <multitype:, string>
     */
    static function getdishesConf($dishesid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_dishes_setting::class, configdata_item_dishes_setting::k_id, $dishesid);
    }

    /**
     * 做菜步骤
     * @param $themeRestaurantId
     * @param $buildingGuid
     * @return Common_Util_ReturnVar
     */
    public function cookDishesByStep($themeRestaurantId,
                                     $buildingGuid)
    {
        $data = [];
        //interface err_dbs_cookdishes_cookDishesByStep

        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($buildingGuid);


        $sceneData = dbs_scene_player::createWithPlayer($this->db_owner)->getThemeRestaurantSceneData($themeRestaurantId);
        $cooktableCell = $sceneData->getBuildingByGuid($buildingGuid);
        logicErrorCondition(!is_null($cooktableCell),
            err_dbs_cookdishes_cookDishesByStep::COOKTABLE_NOT_EXISTS,
            "COOKTABLE_NOT_EXISTS");

        $cooktableExtend = dbs_scene_buildingExtend_cookTable::create($cooktableCell);
        $data = $cooktableExtend->cookDishesByStep($this->db_owner)->get_retdata();
        $sceneData->saveBuildingExtend($cooktableCell);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 烹饪收获
     * @param $themeRestaurantId
     * @param $buildingGuid
     * @return Common_Util_ReturnVar
     */
    public function cookDishesHarvest($themeRestaurantId, $buildingGuid)
    {
        $data = [];
        //interface err_dbs_cookdishes_cookDishesHarvest
        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($buildingGuid);

        $sceneData = dbs_scene_player::createWithPlayer($this->db_owner)->getThemeRestaurantSceneData($themeRestaurantId);
        $cooktableCell = $sceneData->getBuildingByGuid($buildingGuid);
        logicErrorCondition(!is_null($cooktableCell),
            err_dbs_cookdishes_cookDishesHarvest::COOKTABLE_NOT_EXISTS,
            "COOKTABLE_NOT_EXISTS");


        $cooktableExtend = dbs_scene_buildingExtend_cookTable::create($cooktableCell);

        $cookbookId = $cooktableExtend->get_cookDishesCookbookId();


        $data = $cooktableExtend->harvest()->get_retdata();
//

        //做出来的菜品ID
        $dishesId = $data[constants_returnkey::RK_ITEMID];
        $dishesCount = $data[constants_returnkey::RK_PIECE];


        $dinnerTables = $sceneData->getBuildingCellsBySubtype(constants_scenetype::SCENETYPE_3);
        logicErrorCondition(!empty($dinnerTables),
            err_dbs_cookdishes_cookDishesHarvest::NOT_DINNER_TABLE,
            "NOT_DINNER_TABLE");


        $findDinnerTable = null;
        foreach ($dinnerTables as $dinnerTable) {
            $tempDinnerTable = dbs_scene_buildingExtend_dinnerTable::create($dinnerTable);
            if (!$tempDinnerTable->isEmpty() && $tempDinnerTable->canPut($dishesId)) {
                $findDinnerTable = $tempDinnerTable;
                break;
            }
        }
        if (is_null($findDinnerTable)) {
            foreach ($dinnerTables as $dinnerTable) {
                $tempDinnerTable = dbs_scene_buildingExtend_dinnerTable::create($dinnerTable);
                if ($tempDinnerTable->canPut($dishesId)) {
                    $findDinnerTable = $tempDinnerTable;
                    break;
                }

            }
        }

        /**
         * @var $findDinnerTable dbs_scene_buildingExtend_dinnerTable
         */
        logicErrorCondition($findDinnerTable instanceof dbs_scene_buildingExtend_dinnerTable,
            err_dbs_cookdishes_cookDishesHarvest::NOT_EMPTY_DINNERTABLE,
            "NOT_EMPTY_DINNERTABLE");


        //放入菜品
        $findDinnerTable->putDishes($dishesId, $dishesCount);
        //保存炉灶数据
        $sceneData->saveBuildingExtend($cooktableCell);
        //保存餐台
        $sceneData->saveBuildingExtend($findDinnerTable->getBuildingData());
        //增加烹饪次数
        dbs_cookbook::createWithPlayer($this->db_owner)->addCookTimes($cookbookId);
        //增加餐厅经验
        $exp = $data[constants_returnkey::RK_EXP];
        dbs_restaurantinfo::createWithPlayer($this->db_owner)->addrestaurantexp($exp);

        // 完成任务接口
        $piece = $data [constants_returnkey::RK_PIECE];

        $this->db_owner->db_mission()->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_1,
            $dishesId,
            $piece);
        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_3, 1);

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_4, $piece);


        $dishesConfig = self::getdishesConf($dishesId);

        dbs_mission::createWithPlayer($this)->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_5,
            $dishesId, 1);
        dbs_mission::createWithPlayer($this)->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_7,
            intval($dishesConfig[configdata_item_dishes_setting::k_level]), 1);
        dbs_mission::createWithPlayer($this)->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_8,
            intval($dishesConfig[configdata_item_dishes_setting::k_level]), $piece);

        //处理帮助接收
        try {
            dbs_friendhelp_player::createWithPlayer($this)->helpRecvCookDishes($themeRestaurantId, $buildingGuid);
        } catch (exception_logicError $e) {

        }

        $data[constants_returnkey::RK_SCENEOBJECT_DINNERTABLEID] = $findDinnerTable->getBuildingData()->get_guid();

        //记录图鉴
        dbs_dishesHandbook_player::createWithPlayer($this)->activeHandBook($dishesId);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 升级炉台
     * @param $themeRestaurantId
     * @param $buildingGuid
     * @return Common_Util_ReturnVar
     */
    function ungradecooktable($themeRestaurantId, $buildingGuid)
    {
        $retCode = 0;
        $data = array();
        // $retCodeArr = array();
        // code
        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($buildingGuid);
        // code
        // 没有找到餐台
        $sceneData = dbs_scene_player::createWithPlayer($this->db_owner)->getThemeRestaurantSceneData($themeRestaurantId);

        $cookingTableCell = $sceneData->getBuildingByGuid($buildingGuid);
        logicErrorCondition(!is_null($cookingTableCell),
            err_dbs_cookdishes_ungradecooktable::COOKINGTABLE_NOT_FOUND,
            "COOKINGTABLE_NOT_FOUND");


        // 转换餐台类
        $cookingtable = dbs_scene_buildingExtend_cookTable::create($cookingTableCell);
        $cookingTableLevel = $cookingtable->get_level();

        $cooktableupgradeid = $cookingTableCell->get_templateItemId() . '_' . $cookingTableLevel;

        $cooktable_upgrade_config = Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_cooktable_upgrade_setting::class, configdata_item_cooktable_upgrade_setting::k_id, $cooktableupgradeid);

        logicErrorCondition(!is_null($cooktable_upgrade_config),
            err_dbs_cookdishes_ungradecooktable::UPGRADE_CONFIG_ERROR,
            "UPGRADE_CONFIG_ERROR");

        // 等级最大了
        logicErrorCondition($cooktable_upgrade_config [configdata_item_cooktable_upgrade_setting::k_upgradeenable] === '1',
            err_dbs_cookdishes_ungradecooktable::COOKINGTABLE_LEVEL_MAX,
            "COOKINGTABLE_LEVEL_MAX");


        // 下级配置
        $next_cookingtable_level = $cookingTableLevel + 1;
        $next_cookingtableupgradeid = $cookingTableCell->get_templateItemId() . '_' . $next_cookingtable_level;
        $next_cooktable_upgrade_config = Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_cooktable_upgrade_setting::class, configdata_item_cooktable_upgrade_setting::k_id, $next_cookingtableupgradeid);

        logicErrorCondition(!is_null($next_cooktable_upgrade_config),
            err_dbs_cookdishes_ungradecooktable::UPGRADE_CONFIG_ERROR,
            "UPGRADE_CONFIG_ERROR");


        $needitem = array();
        $needitem [$next_cooktable_upgrade_config [configdata_item_cooktable_upgrade_setting::k_upgradeitemid1]] = intval($next_cooktable_upgrade_config [configdata_item_cooktable_upgrade_setting::k_upgradeitemcount1]);
        $needitem [$next_cooktable_upgrade_config [configdata_item_cooktable_upgrade_setting::k_upgradeitemid2]] = intval($next_cooktable_upgrade_config [configdata_item_cooktable_upgrade_setting::k_upgradeitemcount2]);
        $needitem [$next_cooktable_upgrade_config [configdata_item_cooktable_upgrade_setting::k_upgradeitemid3]] = intval($next_cooktable_upgrade_config [configdata_item_cooktable_upgrade_setting::k_upgradeitemcount3]);

        // 道具数量不足
        foreach ($needitem as $itemid => $itemcount) {
            logicErrorCondition($this->db_owner->db_warehousebuildingitem()->hasItem($itemid, $itemcount),
                err_dbs_cookdishes_ungradecooktable::COOKINGTABLE_NOT_ENOUGH_ITEMS,
                "COOKINGTABLE_NOT_ENOUGH_ITEMS");
        }

        foreach ($needitem as $itemid => $itemcount) {
            $this->db_owner->db_warehousebuildingitem()->removeItemByItemId($itemid, $itemcount);
        }

        // 升级
        $cookingtable->set_level($next_cookingtable_level);
        // 保存数据
        $cookingtable->save();
        $sceneData->saveBuildingExtend($cookingTableCell);

        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
    }

    /**
     * 清除炉灶上的菜
     *
     * @param $themeRestaurantId
     * @param string $buildingGuid
     *            炉灶guid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function clearcooktable($themeRestaurantId, $buildingGuid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_cookdishes_clearcooktable{}
        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($buildingGuid);
        // code
        $dbsScene = dbs_scene_player::createWithPlayer($this->db_owner)->getThemeRestaurantSceneData($themeRestaurantId);

        $cookingTableCell = $dbsScene->getBuildingByGuid($buildingGuid);
        // 没有找到餐台
        logicErrorCondition(!is_null($cookingTableCell),
            err_dbs_cookdishes_clearcooktable::COOKINGTABLE_NOT_FOUND,
            "COOKINGTABLE_NOT_FOUND");

        logicErrorCondition($cookingTableCell->isCooktable(),
            err_dbs_cookdishes_clearcooktable::IS_NOT_COOKTABLE,
            "IS_NOT_COOKTABLE");

        // 转换餐台类
        $cookingTable = dbs_scene_buildingExtend_cookTable::create($cookingTableCell);

        if (!$cookingTable->isFree()) {
            $cookingTable->clearCookTable();
            $cookingTable->save();
        }

        $data = $cookingTableCell->toArray();
        $dbsScene->saveBuildingExtend($cookingTableCell);

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }

    /**
     * 清除餐台
     *
     * @param $themeRestaurantId
     * @param string $buildingGuid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function cleardinnertable($themeRestaurantId, $buildingGuid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_cookdishes_cleardinnertable{}

        typeCheckNumber($themeRestaurantId);
        typeCheckGUID($buildingGuid);

        $dbsScene = dbs_scene_player::createWithPlayer($this->db_owner)->getThemeRestaurantSceneData($themeRestaurantId);


        $dinnerTableCell = $dbsScene->getBuildingByGuid($buildingGuid);
        logicErrorCondition(!is_null($dinnerTableCell),
            err_dbs_cookdishes_cleardinnertable::DINNER_TABLE_NOT_FOUND,
            "DINNER_TABLE_NOT_FOUND");

        logicErrorCondition($dinnerTableCell->isDinnerTable(),
            err_dbs_cookdishes_cleardinnertable::IS_NOT_DINNERTABLE,
            "IS_NOT_DINNERTABLE");

        $dinnertable = dbs_scene_buildingExtend_dinnerTable::create($dinnerTableCell);
        $dinnertable->clearTable();
        $dinnertable->save();

        $dbsScene->saveBuildingExtend($dinnerTableCell);

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }
}