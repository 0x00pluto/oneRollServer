<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_scene;
use dbs\scene\dbs_scene_player;

/**
 * 场景服务接口
 *
 * @author zhipeng
 *
 */
class service_scene extends service_base
{
    function __construct()
    {
        $this->addFunctions([

                'getinfo',
                'getThemeRestaurantInfo',
                'addBuilding',
                'batchAddBuildings',
                'modifyBuilding',
                'removeBuildingToSell',
                'removeBuildingToWarehouse',
                'getValidCellsByExpandLevel',
//                'getexpandinfo',
                'expand',
                'expandfinish'

            ]
        );

    }

    /**
     * @return dbs_scene_player
     */
    protected function get_dbins()
    {
        return dbs_scene_player::createWithPlayer($this->callerUserInstance);
    }

    /**
     * @inheritDoc
     */
    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_scene_player_";
    }


    /**
     * 获取信息
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {

        $sceneService = dbs_scene_player::createWithPlayer($this->callerUserInstance);
        $data = $sceneService->toArray();

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取主题餐厅数据
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function getThemeRestaurantInfo($themeRestaurantId)
    {
        return $this->get_dbins()->getThemeRestaurantSceneInfo($themeRestaurantId);
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
     * @return Common_Util_ReturnVar
     */
    public function addBuilding($themeRestaurantId, $buildingItemId, $x, $y, $direct)
    {
        return $this->get_dbins()->addBuilding($themeRestaurantId, $buildingItemId, $x, $y, $direct, true);
    }

    /**
     * 批量添加地砖墙纸
     * @param string $themeRestaurantId 主题餐厅ID
     * @param string $buildingItemId
     *            建材道具id
     * @param string $positionjsonstring
     *            位置数组[{'x'=>1,'y'=>0,'direct'=>0}]
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function batchAddBuildings($themeRestaurantId, $buildingItemId, $positionjsonstring)
    {

        $positions = json_decode($positionjsonstring, true);

        return $this->get_dbins()->batchAddBuildings($themeRestaurantId, $buildingItemId, $positions);
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


        return $this->get_dbins()->modifyBuilding($themeRestaurantId, $buildingGUID, $x, $y, $direct);
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

        // code
        return $this->get_dbins()->removeBuildingToSell($themeRestaurantId, $buildingGUID);
    }

    /**
     * 移除建筑到仓库
     * @param string $themeRestaurantId 主题餐厅ID
     * @param $buildingGUID
     * @return Common_Util_ReturnVar
     */
    public function removeBuildingToWarehouse($themeRestaurantId, $buildingGUID)
    {

        return $this->get_dbins()->removeBuildingToWarehouse($themeRestaurantId, $buildingGUID);
    }

    /**
     * 根据扩建等级获取地块信息
     * @param string $themeRestaurantId 主题餐厅ID
     * @return Common_Util_ReturnVar
     */
    public function getValidCellsByExpandLevel($themeRestaurantId)
    {
        return $this->get_dbins()->getValidCellsByExpandLevel($themeRestaurantId);
    }


    /**
     * 扩地
     * @param string $themeRestaurantId 主题餐厅ID
     * @param int $useDiamond 0 不使用 ,1使用
     * @return Common_Util_ReturnVar
     */
    public function expand($themeRestaurantId, $useDiamond)
    {
        typeCheckChoice(intval($useDiamond), [0, 1]);
        return $this->get_dbins()->expand($themeRestaurantId, $useDiamond);
    }

    /**
     * 完成扩建
     * @param string $themeRestaurantId 主题餐厅ID
     * @return Common_Util_ReturnVar
     */
    public function expandfinish($themeRestaurantId)
    {
        return $this->get_dbins()->expandfinish($themeRestaurantId);
    }
}