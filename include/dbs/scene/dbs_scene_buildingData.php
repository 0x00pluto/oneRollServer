<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/30
 * Time: 下午3:52
 */

namespace dbs\scene;


use Common\Util\Common_Util_Array;
use Common\Util\Common_Util_Bit;
use Common\Util\Common_Util_Guid;
use configdata\configdata_item_building_setting;
use configdata\configdata_item_setting;
use constants\constants_sceneDirect;
use constants\constants_scenetype;
use dbs\templates\scene\dbs_templates_scene_sceneBuildingData;

class dbs_scene_buildingData extends dbs_templates_scene_sceneBuildingData
{
    /**
     * @inheritDoc
     */
    public function set_x($value)
    {
        parent::set_x($value);
        $this->fillCells();
    }

    /**
     * @inheritDoc
     */
    public function set_y($value)
    {
        parent::set_y($value);
        $this->fillCells();
    }

    /**
     * @inheritDoc
     */
    public function set_direct($value)
    {
        parent::set_direct($value);
        $this->fillCells();
    }


    /**
     * 获取道具配置
     * @return null
     */
    public function getItemConfig()
    {
        return getConfigData(configdata_item_setting::class,
            configdata_item_building_setting::k_id,
            $this->get_templateItemId());
    }


    /**
     * 获取建筑配置
     * @return null
     */
    public function getBuildingConfig()
    {
        return getConfigData(configdata_item_building_setting::class,
            configdata_item_building_setting::k_id,
            $this->get_templateItemId());

    }

    /**
     * 获取子分类
     */
    public function getSubtype()
    {
        return $this->getItemConfig()[configdata_item_setting::k_subtype];
    }

    /**
     * 是否参与碰撞
     */
    public function isCollision()
    {
        $subtype = $this->getSubtype();
        if ($subtype == constants_scenetype::SCENETYPE_8 ||
            $subtype == constants_scenetype::SCENETYPE_9 ||
            $subtype == constants_scenetype::SCENETYPE_16
        ) {
            return false;
        }
        return true;
    }

    /**
     * 填充地块
     */
    public function fillCells()
    {
        $buildingConfig = $this->getBuildingConfig();
        if ('wall' === $buildingConfig[configdata_item_building_setting::k_enableposition]
        ) {

            $this->fillCellsSimple();
            return;
        }

        $locationCell = [
            'x' => $this->get_x(),
            'y' => $this->get_y()
        ];

        $width = intval($buildingConfig [configdata_item_building_setting::k_width]);
        $height = intval($buildingConfig[configdata_item_building_setting::k_height]);

        $matrixDimension = max(array(
            $width,
            $height
        ));
        $minDimension = min(array(
            $width,
            $height
        ));

        $cellFills = array();

        $x_direct = constants_sceneDirect::DIRECT_RIGHT_UP;
        $y_direct = constants_sceneDirect::DIRECT_RIGHT_DOWN;

        for ($y = 0; $y < $matrixDimension; $y++) {

            $cellFills [] = $locationCell;

            $offsetXCell = $locationCell;
            for ($x = 1; $x < $matrixDimension; $x++) {
                $offsetXCell = dbs_scene_data::nextTile($offsetXCell ['x'], $offsetXCell ['y'], $x_direct);
                $cellFills [] = $offsetXCell;
            }
            $locationCell = dbs_scene_data::nextTile($locationCell ['x'], $locationCell ['y'], $y_direct);
        }

        $fillCells = array();
        $yDimension = $matrixDimension;
        $xDimension = $matrixDimension;

        if ($this->get_direct() == constants_sceneDirect::DIRECT_LEFT_UP ||
            $this->get_direct() == constants_sceneDirect::DIRECT_RIGHT_DOWN
        ) {
            if ($width > $height) {
                $yDimension = $matrixDimension;
                $xDimension = $minDimension;
            } else {
                $yDimension = $minDimension;
                $xDimension = $matrixDimension;
            }
        } elseif ($this->get_direct() == constants_sceneDirect::DIRECT_LEFT_DOWN ||
            $this->get_direct() == constants_sceneDirect::DIRECT_RIGHT_UP
        ) {
            if ($width > $height) {
                $yDimension = $minDimension;
                $xDimension = $matrixDimension;
            } else {
                $yDimension = $matrixDimension;
                $xDimension = $minDimension;
            }
        }

        for ($y = 0; $y < $yDimension; $y++) {
            for ($x = 0; $x < $xDimension; $x++) {
                $fillCells [] = $cellFills [$matrixDimension * ($y) + $x];
            }
        }


        $this->set_cells($fillCells);
    }

    /**
     * 简单填充地块
     */
    private function fillCellsSimple()
    {
        $locationCell = [
            'x' => $this->get_x(),
            'y' => $this->get_y()
        ];

        switch ($this->get_direct()) {
            case constants_sceneDirect::DIRECT_LEFT_UP :
                $x_direct = constants_sceneDirect::DIRECT_RIGHT_DOWN;
                $y_direct = constants_sceneDirect::DIRECT_LEFT_DOWN;
                break;
            case constants_sceneDirect::DIRECT_LEFT_DOWN :
                $x_direct = constants_sceneDirect::DIRECT_RIGHT_UP;
                $y_direct = constants_sceneDirect::DIRECT_RIGHT_DOWN;
                break;

            case constants_sceneDirect::DIRECT_RIGHT_DOWN :
                $x_direct = constants_sceneDirect::DIRECT_LEFT_UP;
                $y_direct = constants_sceneDirect::DIRECT_RIGHT_UP;
                break;
            case constants_sceneDirect::DIRECT_RIGHT_UP :
                $x_direct = constants_sceneDirect::DIRECT_LEFT_DOWN;
                $y_direct = constants_sceneDirect::DIRECT_LEFT_UP;
                break;

            default :
                $x_direct = constants_sceneDirect::DIRECT_RIGHT_UP;
                $y_direct = constants_sceneDirect::DIRECT_RIGHT_DOWN;
                break;
        }

        $cells = array();
        $buildingConfig = $this->getBuildingConfig();
        for ($y = 0; $y < $buildingConfig [configdata_item_building_setting::k_height]; $y++) {

            $cells [] = $locationCell;

            $offsetXCell = $locationCell;
            for ($x = 1; $x < $buildingConfig [configdata_item_building_setting::k_width]; $x++) {
                $offsetXCell = dbs_scene_data::nextTile($offsetXCell ['x'], $offsetXCell ['y'], $x_direct);
                $cells [] = $offsetXCell;

            }
            $locationCell = dbs_scene_data::nextTile($locationCell ['x'], $locationCell ['y'], $y_direct);
        }
        $this->set_cells($cells);
    }

    /**
     * 是否可以建筑
     * @param array $validCells
     * @param array $collisionData 用户数据中的碰撞信息
     * @return bool
     */
    public function canBuild(array $validCells, array $collisionData = [])
    {
        $itemConfig = $this->getItemConfig();
        if (is_null($itemConfig)) {
            return false;
        }
        $this->autoSetMapData();

        // 检测地图本身是否可以放至
        $width = $this->mapCollisions ['width'];
        $height = $this->mapCollisions ['height'];
        $mapData = $this->mapCollisions ['data'];

//        dump($width);

        $buildingConfig = $this->getBuildingConfig();
        $positionType = $buildingConfig [configdata_item_building_setting::k_enableposition];

        // 判断是否在可用的格子里
        if (!empty($validCells)) {
            foreach ($this->get_cells() as $cell) {
                $key = dbs_scene_data::getTileKey($cell ['x'], $cell ['y']);
                if (!isset($validCells[$key])) {
                    return false;
                }
            }
        }


        //地图上检测地块是否可以放置建筑
        $tilesets = $this->tilesets;
        foreach ($this->get_cells() as $cell) {
            $cellId = $cell ['y'] * $width + $cell ['x'];

            if ($mapData [$cellId] !== 0) {
                $blockId = $mapData [$cellId];
                if (isset($tilesets[$blockId])) {
                    $block_properties = $tilesets [$blockId];

                    //相应的地块可以放置建筑
                    if (isset($block_properties['canbuilding']) &&
                        isset($block_properties[$positionType])
                    ) {
                        continue;
                    } else {
                        dump($this->get_direct());
                        dump($this->get_cells());
                        dump($cell);
                        dump($blockId);
                        dump($positionType);
                        dump($block_properties);
                        dump("here");
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
//        dump("here");
        if ($this->isCollision()) {
            // 检测那个地方是否有建筑了
            $collision = $collisionData;

//            dump($collision);
            foreach ($this->get_cells() as $cell) {

                $key = dbs_scene_data::getTileKey($cell ['x'], $cell ['y']);
                if (isset($collision[$key]) && $collision [$key] !== $this->get_guid()) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 获取使用方向的占地格子
     */
    public function getUseCells()
    {
        // 使用方向
        $useDirect = intval($this->getBuildingConfig() [configdata_item_building_setting::k_usedirect]);
        $cells = array();
//        dump($useDirect);

        $fillCells = $this->get_cells();

        for ($i = 0; $i < constants_sceneDirect::DIRECT_MAX; $i++) {
            $direct = $i;
            // 转换位
            $direct_bit = $direct;
            // 包含方向
            if (Common_Util_Bit::has($useDirect, $direct_bit)) {

                // 转换为相对方向
                $realDirect = $direct + $this->get_direct() - constants_sceneDirect::DIRECT_LEFT_DOWN;
                $realDirect += constants_sceneDirect::DIRECT_MAX;
                $realDirect = $realDirect % constants_sceneDirect::DIRECT_MAX;

                foreach ($fillCells as $fillCell) {
                    $nextCell = dbs_scene_data::nextTile($fillCell ['x'], $fillCell ['y'], $realDirect);
                    $cells[] = $nextCell;
                }

            }
        }
//        dump($cells);

        // 排重
        $cells = Common_Util_Array::array_unique($cells);
        // 去除本身占地格子
        $cells = Common_Util_Array::array_remove_by_values($cells, $fillCells);
        return $cells;
    }

    /**
     * 地图地块信息
     * @var array
     */
    private $tilesets = [];
    /**
     * 地图碰撞信息
     * @var array
     */
    private $mapCollisions = [];

    /**
     * 设置地图数据
     */
    private function autoSetMapData()
    {

        if (!empty($this->tilesets)) {
            return;
        }
        $mapData = dbs_scene_data::getMapDataByThemeRestaurantId($this->get_themeRestaurantId());

        $collisionData = NULL;
        foreach ($mapData ['layers'] as $value) {
            if ($value ['name'] === 'coll') {
                $collisionData = $value;
                break;
            }
        }
        // 地图碰撞信息
        $this->mapCollisions = $collisionData;

        // 地块信息
        $mapTileSets = $mapData ['tilesets'];
        $tilesets = [];
        foreach ($mapTileSets as $value) {
            if (!empty ($value ['tileproperties'])) {
                foreach ($value ['tileproperties'] as $id => $tile) {
                    $tilesets [$value ['firstgid'] + $id] = $tile;
                }
            }
        }
        $this->tilesets = $tilesets;
    }

    /**
     * 是否可以放入仓库
     * @return bool
     */
    public function canPutInWarehouse()
    {
        $itemConfig = $this->getItemConfig();
        return $itemConfig[configdata_item_setting::k_warehousestate] !== "0";
    }

    /**
     * 是否可以出售
     *
     * @return bool
     */
    public function canSell()
    {
        $itemConfig = $this->getItemConfig();
        return $itemConfig[configdata_item_setting::k_selltype] !== "0";
    }

    /**
     * 是否是餐椅
     * @return bool
     */
    public function isChair()
    {
        $subtype = $this->getSubtype();
        return $subtype == constants_scenetype::SCENETYPE_7;
    }

    /**
     * 是否是餐台
     *
     * @return boolean
     */
    public function isDinnerTable()
    {
        $subtype = $this->getSubtype();
        return $subtype == constants_scenetype::SCENETYPE_3;
    }

    /**
     * 是否是餐台
     */
    public function isCooktable()
    {
        $subtype = $this->getSubtype();
        $cooktables = array(
            /**
             * 中餐烹饪台
             */
            constants_scenetype::SCENETYPE_1,
            /**
             * 西餐烹饪台
             */
            constants_scenetype::SCENETYPE_2,
            /**
             * 甜品烹饪台
             */
            constants_scenetype::SCENETYPE_18,
            /**
             * 日料烹饪台
             */
            constants_scenetype::SCENETYPE_19,
            /**
             * 创意烹饪台
             */
            constants_scenetype::SCENETYPE_20
        );


        if (Common_Util_Array::in_array($subtype, $cooktables)) {
            return true;
        }
        return false;
    }

    /**
     * 创建场景对象
     * @param $itemId
     * @param $x
     * @param $y
     * @param $direct
     * @param $themeRestaurantId
     * @return dbs_scene_buildingData
     */
    public static function create($itemId, $x, $y, $direct, $themeRestaurantId)
    {
        $ins = new self();
        $ins->set_guid(Common_Util_Guid::gen_buildingid());
        $ins->set_templateItemId($itemId);
        $ins->set_x($x);
        $ins->set_y($y);
        $ins->set_direct($direct);
        $ins->set_themeRestaurantId($themeRestaurantId);

        return $ins;
    }


}