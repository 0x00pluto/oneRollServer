<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/12
 * Time: 下午3:55
 */

namespace dbs\chef;


use dbs\item\dbs_item_normal;
use dbs\templates\chef\dbs_templates_chef_fashionDressEquipmentSlot;

class dbs_chef_dataFashionDressEquipmentSlot extends dbs_templates_chef_fashionDressEquipmentSlot
{
    /**
     * @param dbs_item_normal $item
     * @return dbs_chef_dataFashionDressEquipmentSlot
     */
    public static function createMasterEquipment(dbs_item_normal $item)
    {
        $ins = new self();
        $ins->set_itemInfo($item->toArray());
        $ins->set_isMaster(true);
        return $ins;
    }

    /**
     * @param dbs_item_normal $item
     * @return dbs_chef_dataFashionDressEquipmentSlot
     */
    public static function createSlaveEquipment(dbs_item_normal $item)
    {
        $ins = new self();
        $ins->set_itemInfo($item->toArray());
        $ins->set_isMaster(false);
        return $ins;
    }
}