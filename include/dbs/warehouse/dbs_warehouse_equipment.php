<?php

namespace dbs\warehouse;

use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\dbs_warehousebase;
use dbs\item\dbs_item_equipment;
use dbs\item\dbs_item_normal;

/**
 * 装备仓库
 *
 * @author zhipeng
 *
 */
class dbs_warehouse_equipment extends dbs_warehousebase
{

    protected function configure()
    {
        $this->set_tablename("warehouse_equipment");
    }


    /**
     * 直接添加装备数据
     * @param dbs_item_normal $equipmentData
     * @param string $pos 位置
     */
    public function addEquipment(dbs_item_normal $equipmentData, $pos)
    {
        $items = $this->get_items();
        $items [$pos] = $equipmentData->toArray();
        $this->set_items($items);
    }

    /**
     * 出售仓库中的道具
     * @param string $pos
     * @param int $num
     * @return \Common\Util\Common_Util_ReturnVar
     */
    public function removeItemToSell($pos, $num = 1)
    {
        $itemData = $this->getitem($pos);

        $ret = parent::removeItemToSell($pos, $num);
        if ($ret->is_failed()) {
            return $ret;
        }
        $itemEquipment = dbs_item_equipment::create_with_itemdata($itemData);
        $addGamecoin = $itemEquipment->get_upgradecostgamecoin() / 2;
        $this->db_owner->db_role()->add_gamecoin_and_diamonds($addGamecoin,
            0,
            constants_moneychangereason::SELL_WAREHOUSE_ITEM);
        $data = $ret->get_retdata();
        $data [constants_returnkey::RK_GAMECOIN] = $data [constants_returnkey::RK_GAMECOIN] + $addGamecoin;
        $ret->set_retdata($data);
        return $ret;
    }
}