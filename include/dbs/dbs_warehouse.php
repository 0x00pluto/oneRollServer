<?php

namespace dbs;

use Common\Util\Common_Util_Configdata;
use configdata\configdata_item_itemtowarehouse_setting;
use configdata\configdata_item_setting;
use constants\constants_warehousetype;
use dbs\warehouse\dbs_warehouse_fashionDress;

/**
 * 装饰仓库
 *
 * @author zhipeng
 *
 */
class dbs_warehouse extends dbs_warehousebase
{

    protected function configure()
    {
        $this->set_tablename("warehouse");
    }


    /**
     *
     *  根据分类不同,添加道具到不同的仓库
     *
     * @param dbs_player $player
     * @param string $itemid
     *            道具id
     * @param int $itemCount
     *            道具数量
     * @param bool $force
     *            如果为true 则不管空间大小 直接放入
     * @return boolean
     */
    static public function additemtowarehouse(dbs_player $player, $itemid, $itemCount, $force = FALSE)
    {
        $itemConfig = dbs_item::getInstance()->getItemConfig($itemid);
        $itemCount = intval($itemCount);

        if (is_null($itemConfig)) {
            return false;
        }
        $warehouse = self::getwarehousebyitemid($player, $itemid);
        if (is_null($warehouse)) {
            return false;
        }

        return $warehouse->addItemByItemId($itemid, $itemCount, $force);
    }

    /**
     * 通过道具获取仓库
     *
     * @param dbs_player $player
     * @param string $itemid
     * @return dbs_warehousebase|NULL
     */
    static public function getwarehousebyitemid(dbs_player $player, $itemid)
    {
        $warehouse = NULL;
        $itemid = strval($itemid);
        $itemconfig = dbs_item::getInstance()->getItemConfig($itemid);

        if (!is_null($itemconfig)) {
            $maintype = $itemconfig [configdata_item_setting::k_maintype];
            $warehouseConfig = Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_itemtowarehouse_setting::class, configdata_item_itemtowarehouse_setting::k_itemmaintype, $maintype);

            if (!is_null($warehouseConfig)) {
                $warehousetype = $warehouseConfig [configdata_item_itemtowarehouse_setting::k_warehousetype];
                $warehouse = self::getWarehouseByType($player, $warehousetype);
            }
        }
        return $warehouse;
    }

    /**
     * 仓库是否有足够的道具
     * @param dbs_player $player
     * @param $itemId
     * @param $itemCount
     * @return bool
     */
    public static function warehouseHasItem(dbs_player $player, $itemId, $itemCount)
    {
        $warehouse = self::getwarehousebyitemid($player, $itemId);
        if (is_null($warehouse)) {
            return false;
        }
        return $warehouse->hasItem($itemId, $itemCount);
    }

    /**
     * 直接删除道具
     * @param dbs_player $player
     * @param $itemId
     * @param $itemCount
     * @return bool
     */
    public static function warehouseRemoveItem(dbs_player $player, $itemId, $itemCount)
    {
        $warehouse = self::getwarehousebyitemid($player, $itemId);
        if (is_null($warehouse)) {
            return false;
        }
        return $warehouse->removeItemByItemId($itemId, $itemCount);
    }

    /**
     * 根据仓库类型获取仓库
     *
     * @param dbs_player $player
     * @param string $warehouseType
     * @see constants_warehousetype
     * @return NULL|dbs_warehousebase
     */
    private static function getWarehouseByType(dbs_player $player, $warehouseType)
    {
        $warehouse = NULL;
        $warehouseType = strval($warehouseType);
        switch ($warehouseType) {
            case constants_warehousetype::TYPE_DEFAULT :

                // 默认仓库
                $warehouse = $player->db_warehousenormal();

                break;
            case constants_warehousetype::TYPE_ICEBOX :

                // 冰箱
                $warehouse = $player->db_warehouseicebox();
                break;

            case constants_warehousetype::TYPE_BUILDING_MATERIALS_WAREHOUSE :

                // 建材仓库
                $warehouse = $player->db_warehousebuildingitem();
                break;
            case constants_warehousetype::TYPE_BUILDING_WAREHOUSE :

                // 装饰仓库
                $warehouse = $player->db_warehouse();
                break;
            case constants_warehousetype::TYPE_EQUIPMENT_WAREHOUSE :

                // 装备仓库
                $warehouse = $player->dbs_warehouseequipment();
                break;

            case constants_warehousetype::TYPE_FASHION_DRESS :
                //时装仓库
                $warehouse = dbs_warehouse_fashionDress::createWithPlayer($player);
                break;

            default:

                // 默认仓库
                $warehouse = $player->db_warehousenormal();

                break;
        }
        return $warehouse;
    }

    /**
     * 通用检测仓库已满,包括建材和冰箱
     *
     * @param dbs_player $player
     * @return boolean
     */
    static function warehouse_normal_is_full(dbs_player $player)
    {
        return $player->db_warehouseicebox()->isFull() || $player->db_warehousebuildingitem()->isFull();
    }
}