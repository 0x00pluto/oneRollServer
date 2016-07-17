<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/12
 * Time: 上午11:03
 */

namespace dbs\themeRestaurant;


use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_restaurant_popularity_level_setting;
use configdata\configdata_theme_restaurant_manage_setting;
use configdata\configdata_theme_restaurant_setting;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\chef\jobs\dbs_chef_jobs_player;
use dbs\dbs_restaurantinfo;
use dbs\dbs_role;
use dbs\dishesHandbook\dbs_dishesHandbook_player;
use dbs\templates\themeRestaurant\dbs_templates_themeRestaurant_themeRestaurantPlayer;
use err\err_dbs_themeRestaurant_Player_harvestThemeRestaurantAutoManage;
use err\err_dbs_themeRestaurant_Player_openNewRestaruant;

class dbs_themeRestaurant_Player extends dbs_templates_themeRestaurant_themeRestaurantPlayer
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * 开启新的餐厅
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function openNewRestaruant($themeRestaurantId)
    {
        $data = [];
        //interface err_dbs_themeRestaurant_Player_openNewRestaruant

        typeCheckNumber($themeRestaurantId);

        $config = getConfigData(configdata_theme_restaurant_setting::class,
            configdata_theme_restaurant_setting::k_id,
            $themeRestaurantId);

        logicErrorCondition(!is_null($config),
            err_dbs_themeRestaurant_Player_openNewRestaruant::RESTAURANT_CONFIG_ERROR,
            "RESTAURANT_CONFIG_ERROR");

        $infos = $this->get_themeRestaurantInfos();

        logicErrorCondition(!isset($infos[$themeRestaurantId]),
            err_dbs_themeRestaurant_Player_openNewRestaruant::RESTAURANT_ALREADY_OPENED,
            "RESTAURANT_ALREADY_OPENED");

        $needRestaurantLevel = intval($config[configdata_theme_restaurant_setting::k_needrestaurantlevel]);
        $restaurantLevel = $this->db_owner->db_restaurantinfo()->get_restaurantlevel();


        logicErrorCondition($restaurantLevel >= $needRestaurantLevel,
            err_dbs_themeRestaurant_Player_openNewRestaruant::RESTAURANT_LEVEL_NOT_ENOUGH,
            "RESTAURANT_LEVEL_NOT_ENOUGH");

        //开启需要对应的菜品图鉴
        $dishesHandbookIds = [];
        if (isset($config[configdata_theme_restaurant_setting::k_needdisheshandbook1])) {
            $dishesHandbookIds[] = intval($config[configdata_theme_restaurant_setting::k_needdisheshandbook1]);
        }
        if (isset($config[configdata_theme_restaurant_setting::k_needdisheshandbook2])) {
            $dishesHandbookIds[] = intval($config[configdata_theme_restaurant_setting::k_needdisheshandbook2]);
        }


        $restaurantData = [];
        if (empty($dishesHandbookIds)) {
            $restaurantData = $this->openRestaurant($themeRestaurantId);
        } else {
            $isOpen = true;
            //图鉴没有达成
            foreach ($dishesHandbookIds as $dishesHandbookId) {
                if (!dbs_dishesHandbook_player::createWithPlayer($this->db_owner)->isComplete($dishesHandbookId)) {
                    $isOpen = false;
                    break;
                }
            }
            logicErrorCondition($isOpen,
                err_dbs_themeRestaurant_Player_openNewRestaruant::HANDBOOKS_NOT_ENOUGH,
                "HANDBOOKS_NOT_ENOUGH");
            if ($isOpen) {

                $restaurantData = $this->openRestaurant($themeRestaurantId);
            }
        }

        $data[constants_returnkey::RK_DATA] = $restaurantData;

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 自动开启餐厅
     */
    private function autoOpenRestaurant()
    {
        $restaurantLevel = $this->db_owner->db_restaurantinfo()->get_restaurantlevel();
        $configs = configdata_theme_restaurant_setting::data();
        $infos = $this->get_themeRestaurantInfos();

        foreach ($configs as $config) {
            $themeRestaurantId = intval($config[configdata_theme_restaurant_setting::k_id]);

            //没有开启过,并且先判断等级
            if (!isset($infos[$themeRestaurantId]) &&
                intval($config[configdata_theme_restaurant_setting::k_needrestaurantlevel]) <= $restaurantLevel
            ) {

                //开启需要对应的菜品图鉴
                $dishesHandbookIds = [];
                if (isset($config[configdata_theme_restaurant_setting::k_needdisheshandbook1])) {
                    $dishesHandbookIds[] = intval($config[configdata_theme_restaurant_setting::k_needdisheshandbook1]);
                }
                if (isset($config[configdata_theme_restaurant_setting::k_needdisheshandbook2])) {
                    $dishesHandbookIds[] = intval($config[configdata_theme_restaurant_setting::k_needdisheshandbook2]);
                }

                if (empty($dishesHandbookIds)) {
                    $this->openRestaurant($themeRestaurantId);
                } else {
                    $isOpen = true;
                    //图鉴没有达成
                    foreach ($dishesHandbookIds as $dishesHandbookId) {
                        if (!dbs_dishesHandbook_player::createWithPlayer($this->db_owner)->isComplete($dishesHandbookId)) {
                            $isOpen = false;
                            break;
                        }
                    }
                    if ($isOpen) {
                        $this->openRestaurant($themeRestaurantId);
                    }
                }
            }
        }

    }

    /**
     * 设置餐厅数据
     * @param dbs_themeRestaurant_Info $data
     */
    private function setThemeRestaurantInfo(dbs_themeRestaurant_Info $data)
    {
        $infos = $this->get_themeRestaurantInfos();
        $infos[$data->get_id()] = $data->toArray();
        $this->set_themeRestaurantInfos($infos);
    }

    /**
     * 设置开启餐厅
     * @param int $themeRestaurantId 主题餐厅ID
     * @return array|null
     */
    private function openRestaurant($themeRestaurantId)
    {
        $themeRestaurantId = intval($themeRestaurantId);
        $infos = $this->get_themeRestaurantInfos();
        $restaurantData = null;
        if (!isset($infos[$themeRestaurantId])) {

            $info = new dbs_themeRestaurant_Info();
            $info->set_id($themeRestaurantId);
            $this->setThemeRestaurantInfo($info);

            $this->setManageRestaurantId($themeRestaurantId);
            $restaurantData = $info->toArray();
        }
        return $restaurantData;
    }

    /**
     * 设置当前经营的餐厅ID
     * @param $id
     */
    private function setManageRestaurantId($id)
    {
        $id = intval($id);
        $infos = $this->get_themeRestaurantInfos();
        if (isset($infos[$id])) {
            foreach ($infos as $themeRestaurantId => $info) {
                if ($themeRestaurantId !== $id) {
                    $infoData = dbs_themeRestaurant_Info::create_with_array($info);
                    $manageData = $infoData->getManageData();
                    $manageData->set_autoManage(true);
                    $infoData->setManageData($manageData);
                    $infos[$themeRestaurantId] = $infoData->toArray();
                }
            }
            $this->set_themeRestaurantInfos($infos);

            $this->set_mainRestaurantId($id);
        }
    }

    /**
     * @param dbs_themeRestaurant_Info $data
     */
    public function setRestaurantData(dbs_themeRestaurant_Info $data)
    {
        $infos = $this->get_themeRestaurantInfos();
        $infos[$data->get_id()] = $data->toArray();
        $this->set_themeRestaurantInfos($infos);
    }

    /**
     * 主题餐厅是否开启
     * @param $themeRestaurantId
     * @return bool
     */
    public function isThemeRestaruantOpened($themeRestaurantId)
    {
        $themeRestaurantId = intval($themeRestaurantId);
        $infos = $this->get_themeRestaurantInfos();
        return isset($infos[$themeRestaurantId]);
    }

    /**
     * @param $themeRestaurantId
     * @return null|dbs_themeRestaurant_Info
     */
    public function getRestaurantData($themeRestaurantId)
    {
        $themeRestaurantId = intval($themeRestaurantId);
        $infos = $this->get_themeRestaurantInfos();
        if (isset($infos[$themeRestaurantId])) {
            return dbs_themeRestaurant_Info::create_with_array($infos[$themeRestaurantId]);
        }
        return null;
    }

    /**
     * 设置客流
     * @param $themeRestaurantId
     * @param int $value
     */
    public function setCustomFlow($themeRestaurantId, $value = 0)
    {
        $themeRestaurantInfo = $this->getRestaurantData($themeRestaurantId);
        if (!is_null($themeRestaurantInfo)) {
            $themeRestaurantInfo->set_customFlow($value);
            $this->setRestaurantData($themeRestaurantInfo);
        }
    }

    /**
     * 获得基础人气值
     * @param $themeRestaurantId
     * @return int
     */
    public function getBaseReputation($themeRestaurantId)
    {
        $themeRestaurantData = $this->getRestaurantData($themeRestaurantId);
        $config = $themeRestaurantData->getConfig();
        //主题餐厅人气值
        $themeRestaurantReputation = intval($config[configdata_theme_restaurant_setting::k_reputation]);
        //用户等级人气值
        $restaurantReputation = dbs_restaurantinfo::createWithPlayer($this->db_owner)->getReputation();
        //图鉴人气值
        $handBookReputation = dbs_dishesHandbook_player::createWithPlayer($this->db_owner)->getReputation($themeRestaurantId);
        //厨师魅力值
        $chefCharmValue = dbs_chef_jobs_player::createWithPlayer($this->db_owner)->get_totalCharms();
        $chefCharmValue = array_sum($chefCharmValue);

        return $themeRestaurantReputation + $restaurantReputation + $handBookReputation + $chefCharmValue;
    }

    /**
     * 获取人气值等级
     * @param $themeRestaurantId
     * @return int
     */
    public function getReputationLevel($themeRestaurantId)
    {
        $reputation = $this->getBaseReputation($themeRestaurantId);
        $level = 0;
        foreach (configdata_restaurant_popularity_level_setting::data() as $data) {
            if ($reputation >= intval($data[configdata_restaurant_popularity_level_setting::k_popularityminvalue])
                && $reputation < intval($data[configdata_restaurant_popularity_level_setting::k_popularitymaxvalue])
            ) {
                $level = intval($data[configdata_restaurant_popularity_level_setting::k_level]);
                return $level;
            }
        }
        return $level;
    }


    /**
     * 收获餐厅自动经营所得
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function harvestThemeRestaurantAutoManage($themeRestaurantId)
    {
        $data = [];
        //interface err_dbs_themeRestaurant_Player_harvestThemeRestaurantAutoManage

        typeCheckNumber($themeRestaurantId);

        $themeRestaurantInfo = $this->getRestaurantData($themeRestaurantId);
        logicErrorCondition(!is_null($themeRestaurantInfo),
            err_dbs_themeRestaurant_Player_harvestThemeRestaurantAutoManage::RESTAURANT_ID_ERROR,
            "RESTAURANT_ID_ERROR");

        $themeRestaurantManageData = $themeRestaurantInfo->getManageData();
        logicErrorCondition($themeRestaurantManageData->get_autoManage(),
            err_dbs_themeRestaurant_Player_harvestThemeRestaurantAutoManage::RESTAURANT_NOT_IN_AUTO_MODE,
            "RESTAURANT_NOT_IN_AUTO_MODE");


        logicErrorCondition(time() > $themeRestaurantManageData->get_nextHarvestEndTime(),
            err_dbs_themeRestaurant_Player_harvestThemeRestaurantAutoManage::RESTAURANT_HARVEST_COOL_DOWN,
            "RESTAURANT_HARVEST_COOL_DOWN");


        $manageConfig = getConfigData(configdata_theme_restaurant_manage_setting::class,
            configdata_theme_restaurant_manage_setting::k_id,
            $themeRestaurantId);

        logicErrorCondition(!is_null($manageConfig),
            err_dbs_themeRestaurant_Player_harvestThemeRestaurantAutoManage::MANAGE_CONFIG_ERROR,
            "MANAGE_CONFIG_ERROR");


        //游戏币
        $awardGameCoin = intval($manageConfig[configdata_theme_restaurant_manage_setting::k_basegamecoin]);
        dbs_role::createWithPlayer($this->db_owner)->add_gamecoin($awardGameCoin, constants_moneychangereason::HARVEST_AUTO_MANAGE_RESTAURANT);

        //下次收获的周期
        $timeInterval = intval($manageConfig[configdata_theme_restaurant_manage_setting::k_timeinterval]);
        $themeRestaurantManageData->set_nextHarvestStartTime(time());
        $themeRestaurantManageData->set_nextHarvestEndTime(time() + $timeInterval);
        $themeRestaurantInfo->setManageData($themeRestaurantManageData);
        $this->setRestaurantData($themeRestaurantInfo);


        $data[constants_returnkey::RK_GAMECOIN] = $awardGameCoin;
        $data[constants_returnkey::RK_DATA] = $themeRestaurantManageData->toArray();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @inheritDoc
     */
    public function toArray($filter = [], $excludefilter = [])
    {
        return parent::toArray($filter, $excludefilter);
    }


}