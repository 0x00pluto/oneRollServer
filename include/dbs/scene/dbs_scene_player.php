<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/29
 * Time: 下午8:25
 */

namespace dbs\scene;


use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_theme_restaurant_setting;
use dbs\templates\scene\dbs_templates_scene_scenePlayer;
use dbs\themeRestaurant\dbs_themeRestaurant_Player;
use err\err_dbs_scene_player;

class dbs_scene_player extends dbs_templates_scene_scenePlayer
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * 获取主题餐厅数据,service 接口,功能扥同于 getThemeRestaurantSceneData
     * @param string $themeRestaurantId 主题餐厅ID
     * @return Common_Util_ReturnVar
     */
    public function getThemeRestaurantSceneInfo($themeRestaurantId)
    {
        $data = $this->getThemeRestaurantSceneData($themeRestaurantId)->toArray();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取当前经验餐厅的数据
     * @return dbs_scene_data
     */
    public function getMainThemeRestaurantSceneData()
    {
        $themeRestaurantId = dbs_themeRestaurant_Player::createWithPlayer($this->db_owner)->get_mainRestaurantId();
        return $this->getThemeRestaurantSceneData($themeRestaurantId);
    }

    /**
     * 获取主题餐台场景数据
     * @param string $themeRestaurantId 主题餐厅ID
     * @return dbs_scene_data
     * @throws \hellaEngine\exception\exception_logicError
     */
    public function getThemeRestaurantSceneData($themeRestaurantId)
    {
        $themeRestaurantId = intval($themeRestaurantId);

        $restaurantConfig = getConfigData(configdata_theme_restaurant_setting::class,
            configdata_theme_restaurant_setting::k_id,
            $themeRestaurantId);
        logicErrorCondition(!is_null($restaurantConfig),
            err_dbs_scene_player::RESTAURANT_INFO_NOT_FOUND,
            "RESTAURANT_INFO_NOT_FOUND");

        logicErrorCondition(dbs_themeRestaurant_Player::createWithPlayer($this)->
        isThemeRestaruantOpened($themeRestaurantId),
            err_dbs_scene_player::RESTAURANT_INFO_NOT_OPEN,
            "RESTAURANT_INFO_NOT_OPEN");

        $themeRestaurantSceneData = dbs_scene_data::getSceneData($this->get_userid(), $themeRestaurantId);
        if (!$themeRestaurantSceneData->exist()) {
            $themeRestaurantSceneData->initializeScene($this->get_userid(), $themeRestaurantId);
            $themeRestaurantSceneData->saveToDB(true);
        }
        return $themeRestaurantSceneData;
    }

    /**
     * 增加建筑
     * @param string $themeRestaurantId 主题餐厅ID
     * @param string $buildingItemId 建筑道具ID
     * @param int $x x坐标
     * @param int $y y坐标
     * @param int $direct 方向
     *            'LEFT_UP' => 0,
     *            'LEFT_DOWN' => 1,
     *            'RIGHT_DOWN' => 2,
     *            'RIGHT_UP' => 3
     * @param bool|true $removeItemFromWarehouse
     * @return Common_Util_ReturnVar
     */
    public function addBuilding($themeRestaurantId, $buildingItemId, $x, $y, $direct, $removeItemFromWarehouse = true)
    {
        $data = $this->getThemeRestaurantSceneData($themeRestaurantId);
        return $data->addBuilding($buildingItemId, $x, $y, $direct, $removeItemFromWarehouse);
    }

    /**
     * @param $themeRestaurantId
     * @param $buildingItemId
     * @param array $positions
     * @return Common_Util_ReturnVar
     */
    public function batchAddBuildings($themeRestaurantId, $buildingItemId, $positions = [])
    {
        $data = $this->getThemeRestaurantSceneData($themeRestaurantId);
        return $data->batchAddBuildings($buildingItemId, $positions);
    }

    /**
     * 修改建筑
     * @param string $themeRestaurantId 主题餐厅ID
     * @param $buildingGUID
     * @param $x
     * @param $y
     * @param $direct
     * @return Common_Util_ReturnVar
     */
    public function modifyBuilding($themeRestaurantId, $buildingGUID, $x, $y, $direct)
    {
        return $this->getThemeRestaurantSceneData($themeRestaurantId)->modifyBuilding($buildingGUID, $x, $y, $direct);
    }

    /**
     * 移除建筑到仓库
     * @param string $themeRestaurantId 主题餐厅ID
     * @param $buildingGUID
     * @return Common_Util_ReturnVar
     */
    public function removeBuildingToWarehouse($themeRestaurantId, $buildingGUID)
    {
        return $this->getThemeRestaurantSceneData($themeRestaurantId)->removeBuildingToWarehouse($buildingGUID);
    }

    /**
     * 直接出售场景装饰
     * @param string $themeRestaurantId 主题餐厅ID
     * @param $buildingGUID
     *
     * @return Common_Util_ReturnVar
     */
    public function removeBuildingToSell($themeRestaurantId, $buildingGUID)
    {
        return $this->getThemeRestaurantSceneData($themeRestaurantId)
            ->removeBuildingToSell($buildingGUID);
    }

    /**
     * 根据扩建等级获取地块信息
     * @param string $themeRestaurantId 主题餐厅ID
     * @return Common_Util_ReturnVar
     */
    public function getValidCellsByExpandLevel($themeRestaurantId)
    {
        $data = [];
        //interface err_dbs_scene_player_getValidCellsByExpandLevel
        $data = $this->getThemeRestaurantSceneData($themeRestaurantId)->getValidCellsByExpandLevel();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 扩地
     * @param string $themeRestaurantId 主题餐厅ID
     * @param int $useDiamond 0 不使用 ,1使用
     * @return Common_Util_ReturnVar
     */
    public function expand($themeRestaurantId, $useDiamond)
    {
        return $this->getThemeRestaurantSceneData($themeRestaurantId)->expand($useDiamond);
    }

    /**
     * 完成扩建
     * @param string $themeRestaurantId 主题餐厅ID
     * @return Common_Util_ReturnVar
     */
    public function expandfinish($themeRestaurantId)
    {
        return $this->getThemeRestaurantSceneData($themeRestaurantId)->expandfinish();

    }
}