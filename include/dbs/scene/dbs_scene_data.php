<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/29
 * Time: 下午8:38
 */

namespace dbs\scene;


use Common\Db\Common_Db_memcacheObject;
use Common\Db\Common_Db_mongo;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_item_building_setting;
use configdata\configdata_item_setting;
use configdata\configdata_restaurant_level_setting;
use configdata\configdata_scene_expand;
use configdata\configdata_scene_expand_layout_setting;
use configdata\configdata_scene_init_layout_setting;
use configdata\configdata_theme_restaurant_setting;
use constants\constants_configure;
use constants\constants_item;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use constants\constants_sceneDirect;
use constants\constants_scenetype;
use constants\constants_time;
use dbs\dbs_item;
use dbs\dbs_mission;
use dbs\dbs_player;
use dbs\dbs_restaurantinfo;
use dbs\dbs_warehouse;
use dbs\scene\buildingExtend\dbs_scene_buildingExtend_cookTable;
use dbs\scene\buildingExtend\dbs_scene_buildingExtend_dinnerTable;
use dbs\templates\scene\dbs_templates_scene_sceneData;
use err\err_dbs_scene_data_addBuilding;
use err\err_dbs_scene_data_batchAddBuildings;
use err\err_dbs_scene_data_expand;
use err\err_dbs_scene_data_expandfinish;
use err\err_dbs_scene_data_modifyBuilding;
use err\err_dbs_scene_data_removeBuildingToSell;
use err\err_dbs_scene_data_removeBuildingToWarehouse;
use err\err_dbs_scene_expand;
use hellaEngine\exception\exception_logicError;

/**
 * 场景数据
 * Class dbs_scene_data
 * @package dbs\scene
 */
class dbs_scene_data extends dbs_templates_scene_sceneData
{
    /**
     * dbs_scene_data constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->set_tablename(self::DBKey_tablename);
        $this->set_primary_key([self::DBKey_sceneGUID]);

        //不自动保存数据
//        $this->setAutoSave(false);
        $this->ensureIndex(
            [
                self::DBKey_userid => 1,
                self::DBKey_themeRestaurantId => 1
            ]);
    }

    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_expandInfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_expandInfo, dbs_scene_expandInfo::dumpDefaultValue());
    }


    /**
     * 设置用户ID和主题餐厅ID
     * @param $userId
     * @param $themeRestaurantId
     */
    public function setUserIdAndThemeRestaurantId($userId, $themeRestaurantId)
    {
        $this->set_userid($userId);
        $this->set_themeRestaurantId($themeRestaurantId);

        $guid = md5($userId . $themeRestaurantId);
        $this->set_sceneGUID($guid);
    }

    /**
     * 获取场景数据
     * @param $userId
     * @param $themeRestaurantId
     * @return dbs_scene_data
     */
    public static function getSceneData($userId, $themeRestaurantId)
    {
        $ins = self::findOrNew([
            self::DBKey_userid => strval($userId),
            self::DBKey_themeRestaurantId => intval($themeRestaurantId)
        ]);
        return $ins;
    }

    /**
     * 通过主题餐厅ID,获取地图数据
     * @param $themeRestaurantId
     * @return array|mixed|null
     */
    public static function getMapDataByThemeRestaurantId($themeRestaurantId)
    {
        $mapCacheObject = Common_Db_memcacheObject::create("Restaruant_Map_" . $themeRestaurantId);
        $mapCacheObject->setExpiration(constants_time::SECONDS_ONE_DAY);
        $crcCacheObject = Common_Db_memcacheObject::create("Restaruant_Cache_Map_" . $themeRestaurantId);
        $crcCacheObject->setExpiration(constants_time::SECONDS_ONE_DAY);

        $themeConfig = getConfigData(configdata_theme_restaurant_setting::class,
            configdata_theme_restaurant_setting::k_id, $themeRestaurantId);

        if (is_null($themeConfig)) {
            return [];
        }

        $mapFilePath = C(constants_configure::RESTAURANT_MAP_DATA_PATH) . DIRECTORY_SEPARATOR .
            $themeConfig[configdata_theme_restaurant_setting::k_mapfilename] . ".json";
        if (!file_exists($mapFilePath)) {
            return [];
        }
        $mapData = file_get_contents($mapFilePath);
        $md5MapData = md5($mapData);

        $isCreate = false;
        if ($crcCacheObject->get_value() !== $md5MapData) {
            $isCreate = true;
        } elseif (!$mapCacheObject->has_value()) {
            $isCreate = true;
        }

        if ($isCreate) {
            $crcCacheObject->set_value($md5MapData);
            $mapInfo = json_decode($mapData, true);
            $mapCacheObject->set_value($mapInfo);

            self::setMapStartPos($mapInfo, $themeRestaurantId);
        } else {
            $mapInfo = $mapCacheObject->get_value();
        }
        return $mapInfo;

    }

    /**
     * 设置地图起点
     * @param array $mapData
     * @param $themeRestaurantId
     */
    private static function setMapStartPos(array $mapData, $themeRestaurantId)
    {
        $collisionData = null;
        foreach ($mapData ['layers'] as $value) {
            if ($value ['name'] == 'coll') {
                $collisionData = $value;
                break;
            }
        }


        $width = $collisionData ['width'];
        $height = $collisionData ['height'];
        $layerData = $collisionData ['data'];

        // 开始点的全局id
        $startPosGid = 0;
        foreach ($mapData ['tilesets'] as $value) {
            if (!empty ($value ['tileproperties'])) {
                foreach ($value ['tileproperties'] as $id => $tile) {
                    if (array_key_exists('groundstartpoint', $tile)) {
                        $startPosGid = $value ['firstgid'] + $id;
                        break;
                    }
                }
            }
        }

        $pos = [];
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $cellId = $y * $width + $x;
                if ($layerData [$cellId] == $startPosGid) {

                    $pos = array(
                        'x' => $x,
                        'y' => $y
                    );
                    break;
                }
            }
        }
        $memcache = Common_Db_memcacheObject::create("Restaruant_Cache_Map_Start_Pos_" . $themeRestaurantId);
        $memcache->setExpiration(constants_time::SECONDS_ONE_DAY);
        $memcache->set_value($pos);
    }


    /**
     * 获取地图起点
     * @param $themeRestaurantId
     * @return array|null
     */
    public static function getMapStartPos($themeRestaurantId)
    {
        $memcache = Common_Db_memcacheObject::create("Restaruant_Cache_Map_Start_Pos_" . $themeRestaurantId);
        return $memcache->get_value();
    }

    /**
     * 有效的地图格子缓存
     * @var array
     */
    private static $validMapCells = [];

    /**
     *
     * 获取有效格子数量
     * @param $themeRestaurantId
     * @param $width
     * @param $height
     * @return array
     */
    public static function getValidMapCells($themeRestaurantId, $width, $height)
    {
        $width = intval($width);
        $height = intval($height);
        $cacheKey = $themeRestaurantId . "_" . $width . '_' . $height;
        self::getMapDataByThemeRestaurantId($themeRestaurantId);
        if (isset(self::$validMapCells[$cacheKey])) {
            return self::$validMapCells[$cacheKey];
        }

        $pos = self::getMapStartPos($themeRestaurantId);

        $cells = array();

        $cell = $pos;

        for ($y = 0; $y < $height; $y++) {
            $cells [$cell ['y'] . '_' . $cell ['x']] = $cell;
            for ($x = 0; $x < $width - 1; $x++) {
                $cell = self::nextTile($cell ['x'], $cell ['y'], constants_sceneDirect::DIRECT_LEFT_DOWN);
                $cells [$cell ['y'] . '_' . $cell ['x']] = $cell;
            }
            // 右下移动一格
            $cell = self::nextTile($pos ['x'], $pos ['y'], constants_sceneDirect::DIRECT_RIGHT_DOWN);
            $pos = $cell;
        }

        // 计算墙体
        $pos = self::getMapStartPos($themeRestaurantId);
        $cell = $pos;
        // 左上移动一格
        $cell = self::nextTile($cell ['x'], $cell ['y'], constants_sceneDirect::DIRECT_LEFT_UP);
        // dump ( $cell );
        $cells [$cell ['y'] . '_' . $cell ['x']] = $cell;
        for ($x = 0; $x < $width - 1; $x++) {
            $cell = self::nextTile($cell ['x'], $cell ['y'], constants_sceneDirect::DIRECT_LEFT_DOWN);
            $cells [$cell ['y'] . '_' . $cell ['x']] = $cell;
            // dump ( $cell );
        }

        $cell = $pos;
        // 右上移动一格
        $cell = self::nextTile($cell ['x'], $cell ['y'], constants_sceneDirect::DIRECT_RIGHT_UP);
        $cells [$cell ['y'] . '_' . $cell ['x']] = $cell;
        for ($x = 0; $x < $height - 1; $x++) {
            $cell = self::nextTile($cell ['x'], $cell ['y'], constants_sceneDirect::DIRECT_RIGHT_DOWN);
            $cells [$cell ['y'] . '_' . $cell ['x']] = $cell;
        }

        self::$validMapCells[$cacheKey] = $cells;

        return $cells;
    }

    /**
     * 下一个地块
     * @param int $tileX
     * @param int $tileY
     * @param int $direct
     * @return array
     */
    public static function nextTile($tileX = 0, $tileY = 0, $direct = 0)
    {
        $nextPos = [];
        $invertOperate = 1;

        if ($direct == constants_sceneDirect::DIRECT_LEFT_UP) {
            if ($tileY % 2 == 0) {
                $nextPos = array(
                    'x' => $tileX - 1,
                    'y' => $tileY - 1 * $invertOperate
                );
            } else {
                $nextPos = array(
                    'x' => $tileX,
                    'y' => $tileY - 1 * $invertOperate
                );
            }
        } elseif ($direct == constants_sceneDirect::DIRECT_LEFT_DOWN) {
            if ($tileY % 2 == 0) {
                $nextPos = array(
                    'x' => $tileX - 1,
                    'y' => $tileY + 1 * $invertOperate
                );
            } else {
                $nextPos = array(
                    'x' => $tileX,
                    'y' => $tileY + 1 * $invertOperate
                );
            }
        } elseif ($direct == constants_sceneDirect::DIRECT_RIGHT_DOWN) {
            if ($tileY % 2 == 0) {
                $nextPos = array(
                    'x' => $tileX,
                    'y' => $tileY + 1 * $invertOperate
                );
            } else {
                $nextPos = array(
                    'x' => $tileX + 1,
                    'y' => $tileY + 1 * $invertOperate
                );
            }
        } elseif ($direct == constants_sceneDirect::DIRECT_RIGHT_UP) {
            if ($tileY % 2 == 0) {
                $nextPos = array(
                    'x' => $tileX,
                    'y' => $tileY - 1 * $invertOperate
                );
            } else {
                $nextPos = array(
                    'x' => $tileX + 1,
                    'y' => $tileY - 1 * $invertOperate
                );
            }
        }
        return $nextPos;
    }

    /**
     * 初始化场景
     * @param $userId
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function initializeScene($userId, $themeRestaurantId)
    {
        $data = [];
        $this->setUserIdAndThemeRestaurantId($userId, $themeRestaurantId);
        $initializeItems = configdata_scene_init_layout_setting::data();
        $themeRestaurantId = strval($this->get_themeRestaurantId());

        foreach ($initializeItems as $item) {

            if ($item[configdata_scene_init_layout_setting::k_themerestaurantid] ===
                $themeRestaurantId
            ) {
                try {
                    $this->addBuilding($item[configdata_scene_init_layout_setting::k_itemid],
                        $item[configdata_scene_init_layout_setting::k_x],
                        $item[configdata_scene_init_layout_setting::k_y],
                        $item[configdata_scene_init_layout_setting::k_direct],
                        false);
                } catch (exception_logicError $e) {
                    dump($e->getRetData()->get_retdata());
                }

            }
        }


        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 通过道具ID获取层级ID
     * @param $itemId
     * @return null|string
     */
    private function getLayerIdByItemId($itemId)
    {
        $itemId = strval($itemId);
        $itemConfig = dbs_item::getInstance()->getItemConfig($itemId);
        if (is_null($itemConfig)) {
            return $itemConfig;
        }
        $itemSubtype = $itemConfig[configdata_item_setting::k_subtype];
//        dump($itemSubtype);
        if (isset(constants_scenetype::$itemSubtype2LayerId[$itemSubtype])) {
            return constants_scenetype::$itemSubtype2LayerId[$itemSubtype];
        }
        return null;
    }

    /**
     * 通过层级ID,场景数据
     * @param $layerId
     * @return dbs_scene_layerData
     */
    private function getLayerData($layerId)
    {
        $layerDatas = $this->get_layerDatas();
        if (isset($layerDatas[$layerId])) {
            return dbs_scene_layerData::create_with_array($layerDatas[$layerId]);
        }
        $layerData = new dbs_scene_layerData();
        $layerData->set_layerId($layerId);
        return $layerData;
    }


    /**
     * 保存地图图层数据
     * @param dbs_scene_layerData $layerData
     */
    private function setLayerData(dbs_scene_layerData $layerData)
    {
        $layerDatas = $this->get_layerDatas();
        $layerDatas[$layerData->get_layerId()] = $layerData->toArray();
        $this->set_layerDatas($layerDatas);
    }

    /**
     * 设置建筑碰撞信息
     * @param dbs_scene_buildingData $building
     */
    private function setCollisionData(dbs_scene_buildingData $building)
    {
        $layerId = $this->getLayerIdByItemId($building->get_templateItemId());
        $layerData = $this->getLayerData($layerId);
        $collisionData = $layerData->get_collision();


        foreach ($building->get_cells() as $cell) {
            $collisionData[self::getTileKey($cell["x"], $cell["y"])] = $building->get_guid();
        }

        $layerData->set_collision($collisionData);
        $this->setLayerData($layerData);
    }

    /**
     * 删除建筑碰撞信息
     * @param dbs_scene_buildingData $building
     */
    private function removeCollisionData(dbs_scene_buildingData $building)
    {
        $layerId = $this->getLayerIdByItemId($building->get_templateItemId());
        $layerData = $this->getLayerData($layerId);
        $collisionData = $layerData->get_collision();


        foreach ($building->get_cells() as $cell) {
            unset($collisionData[self::getTileKey($cell["x"], $cell["y"])]);
        }
        $layerData->set_collision($collisionData);
        $this->setLayerData($layerData);
    }

    /**
     * 获取扩地信息
     * @return dbs_scene_expandInfo
     */
    public function getExpandData()
    {
        return dbs_scene_expandInfo::create_with_array($this->get_expandInfo());
    }

    /**
     * 设置扩地信息
     * @param dbs_scene_expandInfo $data
     */
    public function setExpandData(dbs_scene_expandInfo $data)
    {
        $this->set_expandInfo($data->toArray());
    }

    /**
     * 根据当前扩地等级 获取可用的地块
     * @return array
     */
    public function getValidCellsByExpandLevel()
    {
        $expandData = $this->getExpandData();
        $expandConfig = $expandData->getExpandConfig($this->get_themeRestaurantId());
        $cells = self::getValidMapCells($this->get_themeRestaurantId(),
            $expandConfig[configdata_scene_expand::k_width],
            $expandConfig[configdata_scene_expand::k_height]);
        return $cells;
    }

    /**
     * 增加建筑
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
    public function addBuilding($buildingItemId, $x, $y, $direct, $removeItemFromWarehouse = true)
    {
        $data = [];

        typeCheckString($buildingItemId);
        typeCheckNumber($x);
        typeCheckNumber($y);
        typeCheckNumber($direct);


        $player = dbs_player::newGuestPlayerWithLock($this->get_userid());

        if ($removeItemFromWarehouse) {
            logicErrorCondition(dbs_warehouse::warehouseHasItem($player, $buildingItemId, 1),
                err_dbs_scene_data_addBuilding::BUILDING_NOT_EXISTS,
                "BUILDING_NOT_EXISTS");
        }
        $layerId = $this->getLayerIdByItemId($buildingItemId);

        logicErrorCondition(!is_null($layerId),
            err_dbs_scene_data_addBuilding::ITEM_SUBTYPE_ERROR,
            "ITEM_SUBTYPE_ERROR");

        $mapData = self::getMapDataByThemeRestaurantId($this->get_themeRestaurantId());
        logicErrorCondition(!empty($mapData),
            err_dbs_scene_data_addBuilding::NOT_FIND_MAP_DATA,
            "NOT_FIND_MAP_DATA");

        //所有建筑


        $newBuilding = dbs_scene_buildingData::create($buildingItemId,
            $x,
            $y,
            $direct,
            $this->get_themeRestaurantId());

        $buildingConfig = $newBuilding->getBuildingConfig();
        $needThemeRestaruantId = intval($buildingConfig[configdata_item_building_setting::k_themerestaurantid]);

        if ($needThemeRestaruantId !== -1) {
            logicErrorCondition($needThemeRestaruantId === $this->get_themeRestaurantId(),
                err_dbs_scene_data_addBuilding::NOT_ALLOW_IN_THEME_RESTAURANT,
                "NOT_ALLOW_IN_THEME_RESTAURANT");
        }

        // 不参与碰撞,执行替换规则,没有碰撞的只有地板层
        if (!$newBuilding->isCollision()) {
            $fillCells = $newBuilding->get_cells();
            $existsBuildings = [];

            foreach ($fillCells as $value) {
                $building = $this->getBuildingByTilePosition($layerId, $value ['x'], $value ['y']);
                if (!is_null($building)) {
                    $existsBuildings [$building->get_guid()] = $building;
                }
            }
            foreach ($existsBuildings as $guid => $value) {
                try {
                    $this->removeBuildingToWarehouse($guid);
                } catch (exception_logicError $e) {

                }
            }

        }

        $layerData = $this->getLayerData($layerId);
        $buildings = $this->get_buildings();

        //是否可以放置
        $validCells = $this->getValidCellsByExpandLevel();
//        dump([
//            $newBuilding->toArray(),
//            $validCells,
//            $layerData->get_collision()
//        ]);
        logicErrorCondition($newBuilding->canBuild($validCells,
            $layerData->get_collision()),
            err_dbs_scene_data_addBuilding::CANNOT_PLACE,
            "CANNOT_PLACE");


        //计算种类上限
        if ($newBuilding->isCooktable()) {

            $cookingTableCount = 0;
            $cookingTableDatas = $this->get_buildings();
            foreach ($cookingTableDatas as $cookingTableData) {
                $cookingTable = dbs_scene_buildingData::create_with_array($cookingTableData);
                if ($cookingTable->isCooktable()) {
                    $cookingTableCount++;
                }
            }
            $restaurantConfig = dbs_restaurantinfo::createWithPlayer($player)->get_restaurant_config();
            logicErrorCondition($cookingTableCount < intval($restaurantConfig[configdata_restaurant_level_setting::k_cookingtable_max]),
                err_dbs_scene_data_addBuilding::REACH_COUNT_LIMIT, "REACH_COUNT_LIMIT");


        } elseif ($newBuilding->isDinnerTable()) {
            $dinnerTables = $this->getBuildingCellsBySubtype(constants_scenetype::SCENETYPE_3);
            $dinnerTablesCount = count($dinnerTables);
            $restaurantConfig = dbs_restaurantinfo::createWithPlayer($player)->get_restaurant_config();

            logicErrorCondition($dinnerTablesCount < intval($restaurantConfig[configdata_restaurant_level_setting::k_dinnertablemax]),
                err_dbs_scene_data_addBuilding::REACH_COUNT_LIMIT, "REACH_COUNT_LIMIT");


        } elseif ($newBuilding->isChair()) {
            $chairs = $this->getBuildingCellsBySubtype(constants_scenetype::SCENETYPE_7);
            $chairsCount = count($chairs);
            $restaurantConfig = dbs_restaurantinfo::createWithPlayer($player)->get_restaurant_config();

            logicErrorCondition($chairsCount < intval($restaurantConfig[configdata_restaurant_level_setting::k_chairs]),
                err_dbs_scene_data_addBuilding::REACH_COUNT_LIMIT, "REACH_COUNT_LIMIT");
        }


        //从仓库删除道具
        if ($removeItemFromWarehouse) {
            $warehouse = dbs_warehouse::getwarehousebyitemid($player, $buildingItemId);
            $warehouse->removeItemByItemId($buildingItemId, 1);
        }

        $buildings[$newBuilding->get_guid()] = $newBuilding->toArray();
        $this->set_buildings($buildings);
        $this->setCollisionData($newBuilding);

        $data = $newBuilding->toArray();


        $this->computeValidChairCount();


        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 批量添加
     * @param $buildingItemId
     * @param array $positions
     * @return Common_Util_ReturnVar
     */
    public function batchAddBuildings($buildingItemId, $positions)
    {
        $data = [];
        //interface err_dbs_scene_data_batchAddBuildings
        typeCheckString($buildingItemId);

        $player = dbs_player::newGuestPlayerWithLock($this->get_userid());


        logicErrorCondition(is_array($positions),
            err_dbs_scene_data_batchAddBuildings::POSITIONS_ERROR,
            "POSITIONS_ERROR");

        logicErrorCondition(!empty($positions),
            err_dbs_scene_data_batchAddBuildings::POSITIONS_ERROR,
            "POSITIONS_ERROR");
        $itemConfig = dbs_item::getInstance()->getItemConfig($buildingItemId);

        logicErrorCondition(!is_null($itemConfig),
            err_dbs_scene_data_batchAddBuildings::BUILDING_CONFIG_ERROR,
            "BUILDING_CONFIG_ERROR");

        logicErrorCondition($itemConfig[configdata_item_setting::k_maintype] == constants_item::ITEM_TYPE_1,
            err_dbs_scene_data_batchAddBuildings::BUILDING_MAIN_TYPE_ERROR,
            "BUILDING_MAIN_TYPE_ERROR");

        $itemSubType = $itemConfig [configdata_item_setting::k_subtype];
        logicErrorCondition($itemSubType == constants_scenetype::SCENETYPE_8 || $itemSubType == constants_scenetype::SCENETYPE_9,
            err_dbs_scene_data_batchAddBuildings::BUILDING_SUBTYPE_ERROR,
            "BUILDING_SUBTYPE_ERROR");

        $needBuildingCount = count($positions);

        $warehouse = dbs_warehouse::getwarehousebyitemid($player, $buildingItemId);

        logicErrorCondition($warehouse->hasItem($buildingItemId, $needBuildingCount),
            err_dbs_scene_data_batchAddBuildings::BUILDING_NOT_ENOUGH,
            "BUILDING_NOT_ENOUGH");

        $enableCells = $this->getValidCellsByExpandLevel();
        foreach ($positions as $position) {

            logicErrorCondition(isset($position['x']) && isset($position['y']) &&
                isset($position['direct']),
                err_dbs_scene_data_batchAddBuildings::POSITION_INVALID,
                "POSITION_INVALID");

            $posKey = self::getTileKey($position ['x'], $position ['y']);
            logicErrorCondition(isset($enableCells[$posKey]),
                err_dbs_scene_data_batchAddBuildings::POSITION_INVALID,
                "POSITION_INVALID");
        }

        foreach ($positions as $position) {
            $addBuildingReturnCode = $this->addBuilding($buildingItemId, $position ['x'], $position ['y'], $position ['direct']);
            logicErrorCondition($addBuildingReturnCode->is_succ(),
                err_dbs_scene_data_batchAddBuildings::FILL_PROGRESS_BREAK,
                "FILL_PROGRESS_BREAK");
        }

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 保存扩展信息
     * @param dbs_scene_buildingData $buildingData
     */
    public function saveBuildingExtend(dbs_scene_buildingData $buildingData)
    {
        $buildings = $this->get_buildings();
        if (isset($buildings[$buildingData->get_guid()])) {

            $oldBuildingData = dbs_scene_buildingData::create_with_array($buildings[$buildingData->get_guid()]);
            $oldBuildingData->set_extendInfo($buildingData->get_extendInfo());
            $buildings[$buildingData->get_guid()] = $oldBuildingData->toArray();

            $this->set_buildings($buildings);
        }

    }

    /**
     * 通过地块位置获取建筑
     * @param $layerId
     * @param $x
     * @param $y
     * @return dbs_scene_buildingData|null
     */
    public function getBuildingByTilePosition($layerId, $x, $y)
    {
        $layerId = strval($layerId);
        $x = intval($x);
        $y = intval($y);

        $layerData = $this->getLayerData($layerId);

        $key = self::getTileKey($x, $y);
        if (isset($layerData->get_collision()[$key])) {
            return $this->getBuildingByGuid($layerData->get_collision()[$key]);
        }
        return null;

    }

    /**
     * 获取一类建筑
     * @param string $subtype 道具表中的subtype
     * @param bool|true $returnBuildingData
     * @return array
     */
    function getBuildingCellsBySubtype($subtype, $returnBuildingData = true)
    {
        $subtype = strval($subtype);
        $buildings = $this->get_buildings();
        $returnArr = array();
        foreach ($buildings as $value) {
            $itemId = $value [dbs_scene_buildingData::DBKey_templateItemId];
            $itemConfig = dbs_item::getInstance()->getItemConfig($itemId);
            if ($itemConfig [configdata_item_setting::k_subtype] == $subtype) {

                $buildingData = $value;
                if ($returnBuildingData) {
                    $buildingData = dbs_scene_buildingData::create_with_array($value);
                }
                $returnArr [] = $buildingData;
            }
        }
        return $returnArr;
    }

    /**
     * 通过guid获取地块数据
     * @param $guid
     * @return null|dbs_scene_buildingData
     */
    public function getBuildingByGuid($guid)
    {
        $guid = strval($guid);

        $buildings = $this->get_buildings();
        if (isset($buildings[$guid])) {
            $buildingData = dbs_scene_buildingData::create_with_array($buildings[$guid]);
            return $buildingData;
        }
        return null;
    }

    /**
     * 地块关键字
     * @param $x
     * @param $y
     * @return string
     */
    static function getTileKey($x, $y)
    {
        return $y . "_" . $x;
    }


    /**
     * 移除建筑到仓库
     * @param $buildingGUID
     * @return Common_Util_ReturnVar
     */
    public function removeBuildingToWarehouse($buildingGUID)
    {
        $data = [];
        //class err_dbs_scene_data_removeBuildingToWarehouse

        typeCheckGUID($buildingGUID);
        $player = dbs_player::newGuestPlayerWithLock($this->get_userid());

        $buildings = $this->get_buildings();

        logicErrorCondition(isset($buildings[$buildingGUID]),
            err_dbs_scene_data_removeBuildingToWarehouse::BUILDING_NOT_EXIST,
            "BUILDING_NOT_EXIST");


        $buildingData = dbs_scene_buildingData::create_with_array($buildings[$buildingGUID]);

        //餐台和炉灶工作中不能移动
        if ($buildingData->isCooktable()) {
            $cookingTableExtend = dbs_scene_buildingExtend_cookTable::create($buildingData);
            logicErrorCondition($cookingTableExtend->isFree(),
                err_dbs_scene_data_removeBuildingToWarehouse::BUILDING_IS_BUSY,
                "BUILDING_IS_BUSY");
        } elseif ($buildingData->isDinnerTable()) {
            $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($buildingData);
            logicErrorCondition($dinnerTableExtend->isEmpty(),
                err_dbs_scene_data_removeBuildingToWarehouse::BUILDING_IS_BUSY,
                "BUILDING_IS_BUSY");
        }

        logicErrorCondition($buildingData->canPutInWarehouse(),
            err_dbs_scene_data_removeBuildingToWarehouse::CANNOT_REMOVE,
            "CANNOT_REMOVE");

        //移除建筑
        unset($buildings[$buildingGUID]);
        $this->set_buildings($buildings);

        //移除碰撞信息
        $this->removeCollisionData($buildingData);

        //添加到仓库
        dbs_warehouse::additemtowarehouse($player, $buildingData->get_templateItemId(), 1);


        dbs_mission::createWithPlayer($player)->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_18,
            $buildingData->get_templateItemId(), 1);

        $this->computeValidChairCount();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 直接出售场景装饰
     * @param $buildingGUID
     *
     * @return Common_Util_ReturnVar
     */
    public function removeBuildingToSell($buildingGUID)
    {
        $data = [];
        //class err_dbs_scene_data_removeBuildingToSell
        typeCheckGUID($buildingGUID);
        $player = dbs_player::newGuestPlayerWithLock($this->get_userid());

        $buildings = $this->get_buildings();

        logicErrorCondition(isset($buildings[$buildingGUID]),
            err_dbs_scene_data_removeBuildingToSell::BUILDING_NOT_EXIST,
            "BUILDING_NOT_EXIST");

        $buildingData = dbs_scene_buildingData::create_with_array($buildings[$buildingGUID]);

        logicErrorCondition($buildingData->canSell(),
            err_dbs_scene_data_removeBuildingToSell::CANNOT_SELL,
            "CANNOT_SELL");

        if ($buildingData->isCooktable()) {
            $cookTableExtend = dbs_scene_buildingExtend_cookTable::create($buildingData);
            logicErrorCondition($cookTableExtend->isFree(),
                err_dbs_scene_data_removeBuildingToSell::BUILDING_IS_BUSY,
                "BUILDING_IS_BUSY");
        } elseif ($buildingData->isDinnerTable()) {
            $dinnerTableExtend = dbs_scene_buildingExtend_dinnerTable::create($buildingData);
            logicErrorCondition($dinnerTableExtend->isEmpty(),
                err_dbs_scene_data_removeBuildingToSell::BUILDING_IS_BUSY,
                "BUILDING_IS_BUSY");
        }
        //移除建筑
        unset($buildings[$buildingGUID]);
        $this->set_buildings($buildings);

        //移除碰撞信息
        $this->removeCollisionData($buildingData);

        $itemConfig = $buildingData->getItemConfig();
        $sellPrice = intval($itemConfig [configdata_item_setting::k_sellprice]);

        if ($sellPrice > 0) {
            if ($itemConfig ['selltype'] == '1') {
                $player->db_role()->add_gamecoin($sellPrice, constants_moneychangereason::SELL_BUILDING);
            } elseif ($itemConfig ['selltype'] == '2') {
                $player->db_role()->add_diamond($sellPrice, constants_moneychangereason::SELL_BUILDING);
            }
        }

        $data[constants_returnkey::RK_GAMECOIN] = $sellPrice;

        dbs_mission::createWithPlayer($player)->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_19,
            $buildingData->get_templateItemId(), 1);

        $this->computeValidChairCount();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 修改建筑
     * @param $buildingGUID
     * @param $x
     * @param $y
     * @param $direct
     * @return Common_Util_ReturnVar
     */
    public function modifyBuilding($buildingGUID, $x, $y, $direct)
    {
        $data = [];
        //class err_dbs_scene_data_modifyBuilding
        typeCheckGUID($buildingGUID);
        typeCheckNumber($x);
        typeCheckNumber($y);
        typeCheckNumber($direct);
        typeCheckChoice($direct, [0, 1, 2, 3]);

        $buildings = $this->get_buildings();

        logicErrorCondition(isset($buildings[$buildingGUID]),
            err_dbs_scene_data_modifyBuilding::BUILDING_NOT_EXIST,
            "BUILDING_NOT_EXIST");

        //原始建筑信息
        $oldBuilding = dbs_scene_buildingData::create_with_array($buildings[$buildingGUID]);
        //新建筑信息
        $newBuilding = dbs_scene_buildingData::create_with_array($buildings[$buildingGUID]);

        $newBuilding->set_x($x);
        $newBuilding->set_y($y);
        $newBuilding->set_direct($direct);

        $layerId = $this->getLayerIdByItemId($oldBuilding->get_templateItemId());
        $layerData = $this->getLayerData($layerId);
        $collisionData = $layerData->get_collision();
        //暂时移除本建筑的碰撞信息
        foreach ($oldBuilding->get_cells() as $cell) {
            unset($collisionData[self::getTileKey($cell["x"], $cell["y"])]);
        }

        logicErrorCondition($newBuilding->canBuild($this->getValidCellsByExpandLevel(),
            $collisionData),
            err_dbs_scene_data_modifyBuilding::CANNOT_PLACE,
            "CANNOT_PLACE");

        //不参与碰撞,执行替换规则,没有碰撞的只有地板层
        if (!$newBuilding->isCollision()) {
            $fillCells = $newBuilding->get_cells();
            $existsBuildings = [];

            foreach ($fillCells as $value) {
                $building = $this->getBuildingByTilePosition($layerId, $value ['x'], $value ['y']);
                if (!is_null($building)) {
                    $existsBuildings [$building->get_guid()] = $building;
                }
            }
            foreach ($existsBuildings as $guid => $value) {
                try {
                    $this->removeBuildingToWarehouse($guid);
                } catch (exception_logicError $e) {

                }
            }


            //重新获取建筑和碰撞信息
            $buildings = $this->get_buildings();
        }
        //保存新的建筑信息
        $buildings[$newBuilding->get_guid()] = $newBuilding->toArray();
        //
        $this->set_buildings($buildings);
        //删除原先的碰撞信息
        $this->removeCollisionData($oldBuilding);

//        dump($this->getLayerData($layerId)->toArray());
//        dump($newBuilding->toArray());
        //保存新的碰撞信息
        $this->setCollisionData($newBuilding);


        $this->computeValidChairCount();


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 扩地
     * @param int $useDiamond 0 不使用 ,1使用
     * @return Common_Util_ReturnVar
     */
    public function expand($useDiamond)
    {
        $data = [];
        //interface err_dbs_scene_data_expand

        typeCheckNumber($useDiamond);
        $player = dbs_player::newGuestPlayerWithLock($this->get_userid());

        $expandData = $this->getExpandData();
        logicErrorCondition(!$expandData->get_expanding(),
            err_dbs_scene_data_expand::ALREADY_EXPANDING,
            "ALREADY_EXPANDING");

        logicErrorCondition(!$expandData->is_Cooldown(),
            err_dbs_scene_data_expand::COOL_DOWN,
            "COOL_DOWN");

        $expandConfig = $expandData->getExpandConfig($this->get_themeRestaurantId());

        logicErrorCondition(!is_null($expandConfig),
            err_dbs_scene_expand::NEXT_LEVEL_CONFIG_ERROR,
            "NEXT_LEVEL_CONFIG_ERROR");

        logicErrorCondition(!is_null($expandConfig[configdata_scene_expand::k_upgradeid]),
            err_dbs_scene_data_expand::LEVEL_MAX,
            "LEVEL_MAX");

        logicErrorCondition(isset($expandConfig[configdata_scene_expand::k_upgradeid]),
            err_dbs_scene_data_expand::NEXT_LEVEL_CONFIG_ERROR,
            "NEXT_LEVEL_CONFIG_ERROR");

        $nextExpandConfig = $expandData->getExpandConfigById($expandConfig[configdata_scene_expand::k_upgradeid]);
        $needRestaurantLevel = intval($nextExpandConfig[configdata_scene_expand::k_restaurantlevel]);

        logicErrorCondition($player->db_restaurantinfo()->get_restaurantlevel() >= $needRestaurantLevel,
            err_dbs_scene_data_expand::NOT_ENOUGH_RESTAURANT_LEVEL,
            "NOT_ENOUGH_RESTAURANT_LEVEL");

        $needDiamond = 0;
        $needGameCoin = 0;
        $coolDownTime = 0;
        if ($useDiamond !== 0) {
            $needDiamond = intval($nextExpandConfig[configdata_scene_expand::k_diamond]);
            logicErrorCondition($player->db_role()->get_diamond() >= $needDiamond,
                err_dbs_scene_data_expand::NOT_ENOUGH_DIAMOND,
                "NOT_ENOUGH_DIAMOND");
        } else {
            $needGameCoin = intval($nextExpandConfig [configdata_scene_expand::k_gamecoin]);
            $coolDownTime = intval($nextExpandConfig [configdata_scene_expand::k_time]);

            logicErrorCondition($player->db_role()->get_gamecoin() >= $needGameCoin,
                err_dbs_scene_data_expand::NOT_ENOUGH_GAMECOIN,
                "NOT_ENOUGH_GAMECOIN");

            // 需要道具
            $needItems = array();
            if (isset($nextExpandConfig [configdata_scene_expand::k_needitemid1])) {
                $needItems [$nextExpandConfig [configdata_scene_expand::k_needitemid1]] = intval($nextExpandConfig [configdata_scene_expand::k_needitemcount1]);
            }
            if (isset($nextExpandConfig [configdata_scene_expand::k_needitemid2])) {
                $needItems [$nextExpandConfig [configdata_scene_expand::k_needitemid2]] = intval($nextExpandConfig [configdata_scene_expand::k_needitemcount2]);
            }
            if (isset($nextExpandConfig [configdata_scene_expand::k_needitemid3])) {
                $needItems [$nextExpandConfig [configdata_scene_expand::k_needitemid3]] = intval($nextExpandConfig [configdata_scene_expand::k_needitemcount3]);
            }

            //TODO 根据帮忙,修正最终需要的道具

            foreach ($needItems as $itemId => $itemCount) {
                $warehouse = dbs_warehouse::getwarehousebyitemid($player, $itemId);
                logicErrorCondition($warehouse->hasItem($itemId, $itemCount),
                    err_dbs_scene_data_expand::NOT_ENOUGH_MATERIALS,
                    "NOT_ENOUGH_MATERIALS");
            }


            //删除道具
            foreach ($needItems as $itemId => $itemCount) {
                $warehouse = dbs_warehouse::getwarehousebyitemid($player, $itemId);
                $warehouse->removeItemByItemId($itemId, $itemCount);
            }
        }

        $player->db_role()->cost_gamecoin($needGameCoin, constants_moneychangereason::UPGRADE_SCENE);
        $player->db_role()->cost_diamond($needDiamond, constants_moneychangereason::UPGRADE_SCENE);

        $expandData->set_cooldown(time() + $coolDownTime);
        $expandData->set_expanding(true);

        $this->set_expandInfo($expandData->toArray());

        //TODO 清除帮忙数据

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 完成扩建
     * @return Common_Util_ReturnVar
     */
    public function expandfinish()
    {
        $data = [];
        //interface err_dbs_scene_data_expandfinish
        $expandData = $this->getExpandData();
        $player = dbs_player::newGuestPlayerWithLock($this->get_userid());

        logicErrorCondition($expandData->get_expanding(),
            err_dbs_scene_data_expandfinish::NOT_IN_EXPANDING,
            "NOT_IN_EXPANDING");

        logicErrorCondition(!$expandData->is_Cooldown(),
            err_dbs_scene_data_expandfinish::COOLDOWN,
            "COOLDOWN");

        $expandConfig = $expandData->getExpandConfig($this->get_themeRestaurantId());

        $expandData->set_expanding(false);
        $nextExpandId = $expandConfig[configdata_scene_expand::k_upgradeid];
        $nextExpandConfig = $expandData->getExpandConfigById($nextExpandId);
        $nextExpandLevel = intval($nextExpandConfig[configdata_scene_expand::k_expandlevel]);
        $expandData->set_level($nextExpandLevel);
        $expandData->set_cooldown(0);
        //保存扩地信息
        $this->set_expandInfo($expandData->toArray());

//        dump($nextExpandConfig[configdata_scene_expand::k_packageid]);
        //发放扩地礼包
        if (isset($nextExpandConfig[configdata_scene_expand::k_packageid])) {

            $packageId = $nextExpandConfig [configdata_scene_expand::k_packageid];

            dbs_item::getInstance()->usepackage($player, $packageId);
        }

        //填充新的地块
        $expandItems = configdata_scene_expand_layout_setting::data();
        $fillItems = array_filter($expandItems, function ($value) use ($nextExpandLevel) {
            if (intval($value [configdata_scene_expand_layout_setting::k_expandlevel]) === $nextExpandLevel
                && $this->get_themeRestaurantId() === intval($value[configdata_scene_expand_layout_setting::k_themerestaurantid])
            ) {
                return true;
            }
            return false;
        });

        foreach ($fillItems as $item) {
            try {
                $this->addBuilding(
                    $item [configdata_scene_expand_layout_setting::k_itemid],
                    $item [configdata_scene_expand_layout_setting::k_x],
                    $item [configdata_scene_expand_layout_setting::k_y],
                    $item [configdata_scene_expand_layout_setting::k_direct],
                    false);
            } catch (exception_logicError $e) {
                dump($e->getData());
            }

        }
        // 完成任务
        $player->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_51, 1);
        dbs_mission::createWithPlayer($player)->set_mission_object_type_count(constants_mission::MISSION_FINISH_CONDITION_55,
            $this->get_themeRestaurantId(),
            $expandData->get_level());


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 统计有效椅子数量
     */
    private function computeValidChairCount()
    {
        // 获取所有的桌子
        $tables = $this->getBuildingCellsBySubtype(constants_scenetype::SCENETYPE_6);


//        dump($tables);
        $num = 0;
        foreach ($tables as $table) {
            if ($table instanceof dbs_scene_buildingData) {
                $fillCells = $table->get_cells();
//                dump($fillCells);
                $useCells = $table->getUseCells();
//                dump($useCells);
                $layerId = $this->getLayerIdByItemId($table->get_templateItemId());

//                dump($layerId);
                foreach ($useCells as $useCell) {

                    $chair = $this->getBuildingByTilePosition($layerId, $useCell ['x'], $useCell ['y']);
                    if (!is_null($chair) && $chair->getSubtype() === constants_scenetype::SCENETYPE_7) {
                        $chairUseCells = $chair->getUseCells();

                        foreach ($chairUseCells as $chairUseCell) {
                            // 椅子的使用位置上有桌子
                            foreach ($fillCells as $fillCell) {
                                if ($fillCell ['x'] == $chairUseCell ['x'] && $fillCell ['y'] == $chairUseCell ['y']) {
                                    $num++;
                                    goto next_table;
                                }
                            }
                        }
                    }
                }
            }

            next_table:
        }

        $this->set_validChairCount($num);

    }

    /**
     * @inheritDoc
     */
    protected function loadFromDBAfter(Common_Db_mongo $db)
    {
        $this->computeValidChairCount();
    }


}