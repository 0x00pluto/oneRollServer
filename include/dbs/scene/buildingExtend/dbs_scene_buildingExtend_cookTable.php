<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/14
 * Time: 下午2:45
 */

namespace dbs\scene\buildingExtend;


use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_cook_book_setting;
use configdata\configdata_cook_dishes_setting;
use configdata\configdata_item_cooktable_upgrade_setting;
use configdata\configdata_item_dishes_setting;
use configdata\configdata_item_food_setting;
use constants\constants_cooktable;
use constants\constants_mission;
use constants\constants_returnkey;
use dbs\chef\dbs_chef_data;
use dbs\dbs_cookbook;
use dbs\dbs_player;
use dbs\dbs_warehouse;
use dbs\i\dbs_i_iCooldown;
use dbs\templates\scene\BuildingData\dbs_templates_scene_BuildingData_cookingTable;
use err\err_dbs_scene_buildingExtend_cookTable_BeginCookDishes;
use err\err_dbs_scene_buildingExtend_cookTable_cookDishesByStep;
use err\err_dbs_scene_buildingExtend_cookTable_harvest;

/**
 * 烹饪台
 * Class dbs_scene_buildingExtend_cookTable
 * @package dbs\scene\buildingExtend
 */
class dbs_scene_buildingExtend_cookTable extends dbs_templates_scene_BuildingData_cookingTable implements dbs_i_iCooldown
{
    use dbs_scene_buildingExtend_operate;

    /**
     * 烹饪台是否空闲
     * @return bool
     */
    public function isFree()
    {
        return $this->get_status() === constants_cooktable::STATUS_EMPTY;
    }

    /**
     * 是否在等待操作
     * @return bool
     */
    public function isStatusWaitCookOperate()
    {
        return $this->get_status() === constants_cooktable::STATUS_COOKING;
    }

    /**
     * 是否在等待完成时间
     */
    public function isStatusWaitFinish()
    {
        return $this->get_status() === constants_cooktable::STATUS_WAIT_FINISH;
    }

    /**
     * 清空餐厅状态
     */
    public function clearCookTable()
    {
        $this->reset_cookDishesId()
            ->reset_cookDishesCookbookId()
            ->reset_cookDishesPiece()
            ->reset_cookDishesCurrentStep()
            ->reset_cookDishesMaterialValue()
            ->reset_cookDishesStartTime()
            ->reset_cookDishesEndTime()
            ->reset_cookDishesMaterialDetails()
            ->reset_cookDishesChefAddValue()
            ->reset_status();
    }


    /**
     * @inheritDoc
     */
    public function getExtendKey()
    {
        return "cookTable";
    }

    /**
     * 获取食材的分类配置
     * @param $itemId
     * @return null
     */
    static function getFoodMaterialConfig($itemId)
    {
        return getConfigData(configdata_item_food_setting::class,
            configdata_item_food_setting::k_id,
            $itemId);
    }


    /**
     * 开始烹饪
     * @param dbs_player $player
     * @param $themeRestaurantId
     * @param $cookbookId
     * @param dbs_chef_data $chef
     * @param int $cookMaterialItemId1 食材1的ID如果没有为-1
     * @param int $cookMaterialItemId2 食材2的ID如果没有为-1
     * @param int $cookMaterialItemId3 食材3的ID如果没有为-1
     * @param int $cookMaterialItemId4 食材4的ID如果没有为-1
     * @return Common_Util_ReturnVar
     */
    public function BeginCookDishes(dbs_player $player,
                                    $themeRestaurantId,
                                    $cookbookId,
                                    dbs_chef_data $chef,
                                    $cookMaterialItemId1,
                                    $cookMaterialItemId2,
                                    $cookMaterialItemId3,
                                    $cookMaterialItemId4)
    {
        $data = [];
        //interface err_dbs_scene_buildingExtend_cookTable_BeginCookDishes

        typeCheckNumber($cookbookId);
        typeCheckNumber($themeRestaurantId);


        $cookbookConfig = dbs_cookbook::getCookbookConf($cookbookId);
        logicErrorCondition(!is_null($cookbookConfig),
            err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::COOKBOOK_ERROR,
            "COOKBOOK_ERROR");

        if ($cookbookConfig[configdata_cook_book_setting::k_themerestaurantid] !== "-1") {
            logicErrorCondition(intval($cookbookConfig[configdata_cook_book_setting::k_themerestaurantid]) === $themeRestaurantId,
                err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::THEME_RESTAURANT_NOT_MATCH,
                "THEME_RESTAURANT_NOT_MATCH");
        }

        //烹饪台不为空
        logicErrorCondition($this->isFree(),
            err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::COOKING_TABLE_IS_BUSY,
            "COOKING_TABLE_IS_BUSY");

        //烹饪出的菜品种类ID
        $cookDishesId = $cookbookConfig[configdata_cook_book_setting::k_cookdishesid];

        $cookMaterialConfig = getConfigData(configdata_cook_dishes_setting::class,
            configdata_cook_dishes_setting::k_id,
            $cookDishesId);

        logicErrorCondition(!is_null($cookMaterialConfig),
            err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::COOKBOOK_ERROR,
            "COOKBOOK_ERROR");

        //判断厨师体力
        $needVit = intval($cookbookConfig[configdata_cook_book_setting::k_needchefvit]);
        logicErrorCondition($chef->get_mastervitdata()->get_vit() >= $needVit,
            err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::CHEF_VIT_NOT_ENOUGH,
            "CHEF_VIT_NOT_ENOUGH");

        //所有烹饪材料
        $cookMaterialItemIds = [
            $cookMaterialItemId1,
            $cookMaterialItemId2,
            $cookMaterialItemId3,
            $cookMaterialItemId4
        ];

        //验证完的食材
        $validMaterialItems = [];
        //食材效果值
        $foodMaterialEffectValue = 0;

        for ($i = 1; $i <= 4; $i++) {
            $needFoodId = "needfoodid" . $i;
            $needFoodNum = "needfoodnum" . $i;
            $needFoodMinLevel = "needfoodminlevel" . $i;

            if (isset($cookMaterialConfig[$needFoodId])) {
                logicErrorCondition($cookMaterialItemIds[$i - 1] != -1,
                    err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::FOOD_MATERIAL_NOT_ENOUGH,
                    "FOOD_MATERIAL_NOT_ENOUGH");


                //客户端传上来的具体食材ID
                $foodMaterialItemId = $cookMaterialItemIds[$i - 1];
                $foodMaterialConfig = self::getFoodMaterialConfig($foodMaterialItemId);

//                dump([$cookMaterialConfig[$needFoodId],
//                    $foodMaterialItemId]);
                //传来的食材ID没有找到配置
                logicErrorCondition(!is_null($foodMaterialConfig),
                    err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::FOOD_MATERIAL_CONFIG_NOT_FOUND,
                    "FOOD_MATERIAL_CONFIG_NOT_FOUND");

                //食材ID不匹配
                $foodMaterialTypeId = intval($foodMaterialConfig[configdata_item_food_setting::k_typeid]);
                logicErrorCondition($foodMaterialTypeId === intval($cookMaterialConfig[$needFoodId]),
                    err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::FOOD_MATERIAL_NOT_MATCH,
                    "FOOD_MATERIAL_NOT_MATCH");
                //等级不匹配
                $foodMaterialLevel = intval($foodMaterialConfig[configdata_item_food_setting::k_level]);
                logicErrorCondition($foodMaterialLevel >= intval($cookMaterialConfig[$needFoodMinLevel]),
                    err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::FOOD_MATERIAL_LEVEL_NOT_MATCH,
                    "FOOD_MATERIAL_LEVEL_NOT_MATCH");

                //检测仓库里面是否有足够的道具
                $needMaterialNum = intval($cookMaterialConfig[$needFoodNum]);
                logicErrorCondition(dbs_warehouse::warehouseHasItem($player, $foodMaterialItemId, $needMaterialNum),
                    err_dbs_scene_buildingExtend_cookTable_BeginCookDishes::FOOD_MATERIAL_NOT_ENOUGH,
                    "FOOD_MATERIAL_NOT_ENOUGH");

                //验证完的食材
                $validMaterialItems[$foodMaterialItemId] = $needMaterialNum;
                //食材效果
                //目前取消数量加成,我估计最后还是一个算不清的坑
                $foodMaterialEffectValue += intval($foodMaterialConfig[configdata_item_food_setting::k_value]);// * $needMaterialNum;
            }
        }

        //清除烹饪台数据
        $this->clearCookTable();


        //设置烹饪台状态
        $this->set_status(constants_cooktable::STATUS_COOKING);
        $this->set_cookDishesCookbookId($cookbookId);
        $this->set_cookDishesId($cookDishesId);
        $this->set_cookDishesMaterialDetails($validMaterialItems);
        $this->set_cookDishesMaterialValue($foodMaterialEffectValue);

        $chef->computeability();

        //厨师能力值
        $chefAddValue = $chef->get_battlepower() /
            intval($cookMaterialConfig[configdata_cook_dishes_setting::k_chefbasevalue]);
        $chefAddValue = min([
            $chefAddValue,
            intval($cookMaterialConfig[configdata_cook_dishes_setting::k_chefaddmaxvalue])
        ]);
        $this->set_cookDishesChefAddValue($chefAddValue);

//        dump($validMaterialItems);
        //删除食材
        foreach ($validMaterialItems as $itemId => $num) {
            dbs_warehouse::warehouseRemoveItem($player, $itemId, $num);
        }
        //扣除厨师体力
//        dump($needVit);
        $chef->costVit($needVit);


        $this->save();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 开始一步一步制作
     * @param dbs_player $player
     * @return Common_Util_ReturnVar
     */
    public function cookDishesByStep(dbs_player $player)
    {
        $data = [];
        //interface err_dbs_scene_buildingExtend_cookTable_cookDishesByStep

        logicErrorCondition($this->isStatusWaitCookOperate(),
            err_dbs_scene_buildingExtend_cookTable_cookDishesByStep::COOKTABLE_STATUS_ERROR,
            "COOKTABLE_STATUS_ERROR");

        $cookbookId = $this->get_cookDishesCookbookId();
        $cookbookConfig = dbs_cookbook::getCookbookConf($cookbookId);

        $cookDishesId = $this->get_cookDishesId();
        $cookMaterialConfig = getConfigData(configdata_cook_dishes_setting::class,
            configdata_cook_dishes_setting::k_id,
            $cookDishesId);

        $stepExp = intval($cookMaterialConfig[configdata_cook_dishes_setting::k_cookingstepfinishexp]);
        //最大步数
        $maxStep = intval($cookMaterialConfig[configdata_cook_dishes_setting::k_cookstepcount]);

        $currentStep = $this->get_cookDishesCurrentStep();
        $currentStep++;

        if ($currentStep >= $maxStep) {
            //完成烹饪

            $this->set_status(constants_cooktable::STATUS_WAIT_FINISH);

            $this->set_cookDishesStartTime(time());
            $cookingTime = intval($cookMaterialConfig[configdata_cook_dishes_setting::k_cookingtime]);
            $cookingPiece = intval($cookMaterialConfig[configdata_cook_dishes_setting::k_piece]);

            // 升级配置
            $upgrade_config = getConfigData(configdata_item_cooktable_upgrade_setting::class,
                configdata_item_cooktable_upgrade_setting::k_id,
                $this->getUpgradeKey());
            if (!is_null($upgrade_config)) {
                // 时间减少
                $cookingTimePercent = floatval($upgrade_config [configdata_item_cooktable_upgrade_setting::k_cookingtime]) / 10000.0;
                $cookingTime = floor(floatval($cookingTime) * $cookingTimePercent);
                // 份数加成
                $cookingPiecePercent = floatval($upgrade_config [configdata_item_cooktable_upgrade_setting::k_cookingpiece]) / 10000.0;
                $cookingPiece = floor(floatval($cookingPiece) * $cookingPiecePercent);
            }

            $this->set_cookDishesEndTime(time() + $cookingTime);
            $this->set_cookDishesPiece($cookingPiece);


            //增加经验
            $player->db_restaurantinfo()->addrestaurantexp($stepExp);


        } else {

        }

        $this->set_cookDishesCurrentStep($currentStep);

        $data = $this->toArray();

        $this->save();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取烹饪台等级key
     * @return string
     */
    public function getUpgradeKey()
    {
        return $this->getBuildingData()->get_templateItemId() . '_' . $this->get_level();
    }


    /**
     * 收获
     * @return Common_Util_ReturnVar
     */
    public function harvest()
    {
        $data = [];
        //interface err_dbs_scene_buildingExtend_cookTable_harvest

        logicErrorCondition($this->isStatusWaitFinish(),
            err_dbs_scene_buildingExtend_cookTable_harvest::COOKTABLE_STATUS_ERROR,
            "COOKTABLE_STATUS_ERROR");

        logicErrorCondition(!$this->is_Cooldown(),
            err_dbs_scene_buildingExtend_cookTable_harvest::COOLDOWN,
            "COOLDOWN");


        $cookDishesId = $this->get_cookDishesId();
        $cookMaterialConfig = getConfigData(configdata_cook_dishes_setting::class,
            configdata_cook_dishes_setting::k_id,
            $cookDishesId);

        //决定做出什么菜
        $dishesLevels = [
            intval($cookMaterialConfig[configdata_cook_dishes_setting::k_dishesstarvalue1]),
            intval($cookMaterialConfig[configdata_cook_dishes_setting::k_dishesstarvalue2]),
            intval($cookMaterialConfig[configdata_cook_dishes_setting::k_dishesstarvalue3]),
            intval($cookMaterialConfig[configdata_cook_dishes_setting::k_dishesstarvalue4]),
            intval($cookMaterialConfig[configdata_cook_dishes_setting::k_dishesstarvalue5]),
        ];

        $maxLevel = 0;
        $materialEffect = $this->get_cookDishesMaterialValue() + $this->get_cookDishesChefAddValue();
        foreach ($dishesLevels as $level => $effectValue) {
            if ($materialEffect >= $effectValue) {
                $maxLevel = $level;
            }
        }
        //最终做出菜的等级
        $dishesLevel = strval($maxLevel + 1);
        $dishesItemId = null;

        foreach (configdata_item_dishes_setting::data() as $configData) {
            if ($configData[configdata_item_dishes_setting::k_typeid] === strval($cookDishesId) &&
                $configData[configdata_item_dishes_setting::k_level] === $dishesLevel
            ) {
                $dishesItemId = $configData[configdata_item_dishes_setting::k_id];
                break;
            }
        }
        //没有找到最后的生成的菜
        logicErrorCondition(!is_null($dishesItemId),
            err_dbs_scene_buildingExtend_cookTable_harvest::COOK_DISHES_ID_ERROR,
            "COOK_DISHES_ID_ERROR");


        $data [constants_returnkey::RK_PIECE] = $this->get_cookDishesPiece();
        $data [constants_returnkey::RK_ITEMID] = $dishesItemId;
        $data [constants_returnkey::RK_SCENEOBJECT_GUID] = $this->getBuildingData()->get_guid();

        $harvestExp = intval($cookMaterialConfig[configdata_cook_dishes_setting::k_cookingharvestexp]);
        $data[constants_returnkey::RK_EXP] = $harvestExp;

        //清台
        $this->clearCookTable();
        $this->set_status(constants_cooktable::STATUS_EMPTY);


        $this->save();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @inheritDoc
     */
    function getCooldownTime()
    {
        if ($this->is_Cooldown()) {
            return $this->get_cookDishesEndTime() - time();
        }
        return 0;
    }

    /**
     * @inheritDoc
     */
    function clearCooldown()
    {
        $this->set_cookDishesEndTime(0);
    }

    /**
     * @inheritDoc
     */
    function get_clearCooldownDiamond()
    {
        return 1;
    }

    /**
     * @inheritDoc
     */
    function is_Cooldown()
    {
        if ($this->isStatusWaitFinish()) {
            if (time() < $this->get_cookDishesEndTime()) {
                return true;
            }
        }
        return false;
    }

    /**
     * 减少冷却时间
     * @param $seconds
     */
    function reduceCooldownTime($seconds)
    {
        if ($this->is_Cooldown()) {
            $leftSeconds = $this->getCooldownTime();
            if ($leftSeconds <= $seconds) {
                $this->clearCooldown();
            } else {
                $this->set_cookDishesEndTime($this->get_cookDishesEndTime() - $seconds);
            }
        }
    }


}