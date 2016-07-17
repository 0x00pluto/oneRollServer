<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/23
 * Time: 下午3:02
 */

namespace dbs\chef;


use configdata\configdata_item_fashion_dress_setting;
use dbs\dbs_player;
use dbs\item\dbs_item_fashionDress;
use dbs\item\dbs_item_normal;
use dbs\templates\chef\dbs_templates_chef_fashionDress;

class dbs_chef_dataFashionDress extends dbs_templates_chef_fashionDress
{
    /**
     * 穿着时装
     * @param dbs_player $player
     * @param dbs_chef_dataFashionDressEquipmentSlot $item
     * @return bool
     */
    public function putOn(dbs_player $player, dbs_chef_dataFashionDressEquipmentSlot $item)
    {
        $equipments = $this->get_equipments();
        $equipments[$item->get_position()] = $item->toArray();
        $this->set_equipments($equipments);
        $this->computeCharmValue();
        return true;
    }

    /**
     * 脱掉时装
     * @param dbs_player $player
     * @param $fashionDressPos
     * @return bool
     */
    public function takeOff(dbs_player $player, $fashionDressPos)
    {
        $equipments = $this->get_equipments();
        if (!isset($equipments[$fashionDressPos])) {
            return false;
        }
        unset($equipments[$fashionDressPos]);
        $this->set_equipments($equipments);

        $this->computeCharmValue();
        return true;
    }

    /**
     * 通过位置获取时装
     * @param $fashionDressType
     * @return null|dbs_item_normal
     */
    public function getFashionDressByType($fashionDressType)
    {
        $equipments = $this->get_equipments();
        if (!isset($equipments[$fashionDressType])) {
            return null;
        }
        $equipment = $equipments[$fashionDressType];

        return dbs_item_normal::create_with_array($equipment[dbs_chef_dataFashionDressEquipmentSlot::DBKey_itemInfo]);
    }

    /**
     * 计算魅力值
     */
    protected function computeCharmValue()
    {
        $equipments = $this->get_equipments();
        $totalCharmValue = 0;
        foreach ($equipments as $equipment) {
            $equipmentData = dbs_chef_dataFashionDressEquipmentSlot::create_with_array($equipment);
            if (!$equipmentData->get_isMaster()) {
                continue;
            }
            $itemData = $equipmentData->get_itemInfo();

            $fashionDressConfig = getConfigData(configdata_item_fashion_dress_setting::class,
                configdata_item_fashion_dress_setting::k_id,
                $itemData[dbs_item_normal::DBKey_itemid]);

            $totalCharmValue += intval($fashionDressConfig[configdata_item_fashion_dress_setting::k_charmvalue]);
        }
        $this->set_charmvalue($totalCharmValue);
    }

    /**
     * 删除过期的时装
     * @return array[dbs_item_normal]
     */
    public function removeExpiredFashionDresses()
    {
        $equipments = $this->get_equipments();
        $removeFashions = [];
        $dataChange = false;
        foreach ($equipments as $equipmentType => $equipment) {

            $equipmentData = dbs_chef_dataFashionDressEquipmentSlot::create_with_array($equipment);
            if (!$equipmentData->get_isMaster()) {
                continue;
            }
            $fashionDressItem = dbs_item_fashionDress::createByItemData($equipmentData->get_itemInfo());

            if ($fashionDressItem->get_expiredTime() < time()) {

                $removeFashions[] = $fashionDressItem->getItem();
                //处理多位置删除
                $equipmentTypes = $fashionDressItem->getAllPositionTypes();
                foreach ($equipmentTypes as $removeType) {
                    unset($equipments[$removeType]);
                }
                $dataChange = true;
            }
        }
        if ($dataChange) {
            $this->set_equipments($equipments);
            $this->computeCharmValue();
        }
        return $removeFashions;
    }


}