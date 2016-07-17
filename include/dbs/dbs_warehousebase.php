<?php

namespace dbs;

use Common\Util\Common_Util_Guid;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_item_setting;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use constants\constants_warehouse;
use dbs\item\dbs_item_base;
use dbs\item\dbs_item_normal;
use dbs\templates\warehouse\dbs_templates_warehouse_base;
use err\err_dbs_warehousebase_removeitem;
use err\err_dbs_warehousebase_removeitemtosell;

/**
 * 仓库基础类
 *
 * @author zhipeng
 *
 */
class dbs_warehousebase extends dbs_templates_warehouse_base
{

    /**
     * 获得仓库容量
     */
    protected function get_warehouse_size()
    {
        return $this->get_size();
    }

    /**
     * 测试物品是否可以放入仓库,计算堆叠数量
     *
     * @param string $itemId
     *            物品ID
     * @param int $num 数量 >1
     * @return boolean
     */
    public function testItemCanPut($itemId, $num = 1)
    {
        //仓库大小无限
        if ($this->sizeUnlimited()) {
            return true;
        }

        $itemId = strval($itemId);
        $num = intval($num);
        if ($num < 1) {
            return false;
        }

        $items = $this->get_items();
        $itemdata = new dbs_item_normal ();
        $itemtotalcount = 0;
        foreach ($items as $value) {
            $itemdata->fromArray($value);
            $itemtotalcount += $itemdata->get_num();
        }

        if ($num + $itemtotalcount > $this->get_warehouse_size()) {
            return false;
        }
        return true;
    }

    /**
     *  测试物品是否可以放入仓库,根据坑的位置
     *
     * @deprecated
     * @param $itemId
     * @param $num
     * @return bool
     */
    public function testItemCanPutBySlot($itemId, $num)
    {
        if ($this->sizeUnlimited()) {
            return true;
        }

        $itemId = strval($itemId);
        $num = intval($num);
        if ($num < 1) {
            return false;
        }
        // $item = dbs_item::getInstance ()->newitem ( $itemId, $num );
//        $needpos = 0;
        $itemconfig = dbs_item::getInstance()->getItemConfig($itemId);
        // 不可以堆叠的道具,直接生成一个新的位置
        if (is_null($itemconfig)) {
            return false;
        }

        $maxcount = intval($itemconfig [configdata_item_setting::k_maxcount]);

        if ($maxcount == 1) {
            $needpos = $num;
        } else {

            $needpos = ($num - 1) / $maxcount + 1;
        }

        $items = $this->get_items();
        if (count($items) + $needpos > $this->get_warehouse_size()) {
            return false;
        }
        return true;
    }

    /**
     * 通过道具id增加道具
     *
     * @param string $itemId
     * @param int $num
     * @param boolean $force
     *            如果为true 则不管空间大小 直接放入
     * @return boolean
     */
    public function addItemByItemId($itemId, $num = 1, $force = FALSE)
    {
        $itemId = strval($itemId);
        $num = intval($num);
        $item = dbs_item::getInstance()->newItem($itemId, $num);
        $item->set_itemowneruserid($this->get_userid());
        return $this->addItem($item, $force);
    }


    /**
     * 向仓库中增加道具
     * @param dbs_item_normal $item
     * @param bool|FALSE $force
     * @return bool
     */
    public function addItem(dbs_item_normal $item, $force = FALSE)
    {
        // dump ( $item );
        $num = $item->get_num();
        $itemId = $item->get_itemid();
        // 没有位置
        if (!$force && !$this->testItemCanPut($itemId, $num)) {
            return false;
        }
        $items = $this->get_items();
        $itemConfig = dbs_item::getInstance()->getItemConfig($itemId);
        if (is_null($itemConfig)) {
            return false;
        }
        // 道具最大堆叠数量
        $itemMaxCount = intval($itemConfig [configdata_item_setting::k_maxcount]);
        // 不可以堆叠的道具,直接生成一个新的位置
        if ($itemMaxCount === 1) {
            $itemNum = $num;
            while ($itemNum > 0) {
                $newItem = new dbs_item_normal ($itemId);
                $newItem->fromArray($item->toArray());
                $newItem->set_num(1);

                $pos = Common_Util_Guid::gen_warehousepos();
                $newItem->set_warehousepos($pos);
                $items [$pos] = $newItem->toArray();;
                $itemNum--;
            }
        } else {

            $itemNum = $num;

            foreach ($items as &$value) {
                if ($value [dbs_item_base::DBKey_itemid] == $itemId &&
                    $value [dbs_item_base::DBKey_num] < $itemMaxCount
                ) {
                    // 空格子数量
                    $emptyNum = $itemMaxCount - $value [dbs_item_base::DBKey_num];

                    // 本次需要填充的物品数量
                    $needNum = min(array(
                        $emptyNum,
                        $itemNum
                    ));

                    $value [dbs_item_base::DBKey_num] += $needNum;
                    $itemNum = $itemNum - $needNum;
                    // 没有剩余的物品数量了
                    if ($itemNum <= 0) {
                        break;
                    }
                }
            }

            // 还有物品
            if ($itemNum > 0) {

                while ($itemNum > 0) {
                    $needNum = min(array(
                        $itemMaxCount,
                        $itemNum
                    ));

                    $newItem = new dbs_item_normal ($itemId, $needNum);
                    $newItem->fromArray($item->toArray());
                    $newItem->set_num($num);
                    $pos = Common_Util_Guid::gen_warehousepos();
                    $newItem->set_warehousepos($pos);
                    $items [$pos] = $newItem->toArray();

                    $itemNum = $itemNum - $needNum;
                    // 没有剩余的物品数量了
                    if ($itemNum <= 0) {
                        break;
                    }
                }
            }
        }

        $this->set_items($items);

        return true;
    }


    /**
     * 通过道具id和数量删除道具
     * @param $itemId
     * @param $num
     * @return bool
     */
    function removeItemByItemId($itemId, $num)
    {
        $itemId = strval($itemId);
        $num = intval($num);
        if (!$this->hasItem($itemId, $num)) {
            return FALSE;
        }

//        $itemconfig = dbs_item::getInstance()->getItemconfig($itemId);

        $items = $this->get_items();
        // 需要删除的位置
        $needRemovePos = array();

        foreach ($items as $pos => &$value) {
            if ($value [dbs_item_normal::DBKey_itemid] == $itemId) {
                // 需要删除的数量
                $needRemoveNum = min($num, $value [dbs_item_normal::DBKey_num]);
                $num -= $needRemoveNum;

                if ($value [dbs_item_normal::DBKey_num] == $needRemoveNum) {
                    $value [dbs_item_normal::DBKey_num] = 0;
                    $needRemovePos [] = $pos;
                } else {
                    $value [dbs_item_normal::DBKey_num] -= $needRemoveNum;
                }

                // 已经删除了足够多的道具
                if ($num <= 0) {
                    break;
                }
            }
        }

        // 删除空位置
        foreach ($needRemovePos as $pos) {
            unset ($items [$pos]);
        }

        $this->set_items($items);

        return true;
    }

    /**
     * 出售道具
     *
     * @param string $pos
     * @param int $num
     * @return Common_Util_ReturnVar
     */
    function removeItemToSell($pos, $num = 1)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_warehousebase_removeitemtosell{}

        $items = $this->get_items();
        $num = intval($num);

        if (!array_key_exists($pos, $items)) {
            $retCode = err_dbs_warehousebase_removeitemtosell::POSITON_NOT_HAS_ITEM;
            goto failed;
        }

        $item = $items [$pos];

        $itemnormal = new dbs_item_normal ();
        $itemnormal->fromArray($item);

        $itemConfig = dbs_item::getInstance()->getItemConfig($itemnormal->get_itemid());
        if ($itemConfig [configdata_item_setting::k_sellstate] != '1') {
            $retCode = err_dbs_warehousebase_removeitemtosell::ITEM_CANNOT_SELL;
            $retCode_Str = 'ITEM_CANNOT_SELL';
            goto failed;
        }

        if ($num > $itemnormal->get_num()) {
            $retCode = err_dbs_warehousebase_removeitemtosell::NUM_ERROR;
            goto failed;
        } elseif ($num == $itemnormal->get_num()) {
            unset ($items [$pos]);
        } else {
            $itemnormal->set_num($itemnormal->get_num() - $num);
            $items [$pos] = $itemnormal->toArray();
        }
        // 保存道具
        $this->set_items($items);

        $gamecoin = 0;
        $diamond = 0;
        if ($itemConfig [configdata_item_setting::k_selltype] == '0') {
            // 游戏币
            $gamecoin = intval($itemConfig [configdata_item_setting::k_sellprice]) * $num;
        } else {
            $diamond = intval($itemConfig [configdata_item_setting::k_sellprice]) * $num;
        }

        $this->db_owner->db_role()->add_gamecoin_and_diamonds($gamecoin, $diamond, constants_moneychangereason::SELL_WAREHOUSE_ITEM);

        $data [constants_returnkey::RK_GAMECOIN] = $gamecoin;
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }


    /**
     * 删除道具
     * @param $pos
     * @param int $num
     * @return Common_Util_ReturnVar
     */
    function removeItem($pos, $num = 1)
    {
        $retCode = 0;
        $data = array();
//        $retCodeArr = array();

        // code
        $items = $this->get_items();
        $num = intval($num);

        if (!array_key_exists($pos, $items)) {
            $retCode = err_dbs_warehousebase_removeitem::POSITON_NOT_HAS_ITEM;
            goto failed;
        }

        $item = &$items [$pos];
        if ($num > $item [dbs_item_normal::DBKey_num]) {
            $retCode = err_dbs_warehousebase_removeitem::NUM_ERROR;
            goto failed;
        } elseif ($num == $item [dbs_item_normal::DBKey_num]) {

            unset ($items [$pos]);
        } else {
            $item [dbs_item_normal::DBKey_num] -= $num;
        }

        $this->set_items($items);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * 获取道具位置道具
     *
     * @param $pos
     * @return NULL|array
     */
    public function getitem($pos)
    {
        $pos = strval($pos);
        $items = $this->get_items();
        if (!isset($items[$pos])) {
            return null;
        }
        return $items [$pos];
    }

    /**
     * 修改道具
     * @param string $pos 位置
     * @param dbs_item_normal $item
     * @return bool
     */
    public function modifyItem($pos, dbs_item_normal $item)
    {
        $itemData = $this->getitem($pos);
        if (is_null($itemData)) {
            return false;
        }

        // 不是同一个道具了
        if ($itemData [dbs_item_base::DBKey_itemid] != $item->get_itemid()) {
            return false;
        }

        $items = $this->get_items();
        $items [$pos] = $item->toArray();

        // dump ( $items );

        $this->set_items($items);
        return true;
    }

    /**
     *  通过道具id获取道具 ,获取第一个出现此道具位置
     * @param $itemId
     * @return int|null|string
     */
    public function getWarehousePosByItemId($itemId)
    {
        $itemId = strval($itemId);
        $items = $this->get_items();
        foreach ($items as $pos => $value) {
            if ($value [dbs_item_base::DBKey_itemid] == $itemId) {
                return $pos;
            }
        }
        return null;
    }


    /**
     * 是否拥有道具
     * @param $itemId
     * @param int $num
     * @return bool
     */
    public function hasItem($itemId, $num = 1)
    {
        $itemId = strval($itemId);
        $num = intval($num);

        if ($num <= 0) {
            return true;
        }

        $items = $this->get_items();
        foreach ($items as $pos => $value) {
            if ($value [dbs_item_base::DBKey_itemid] == $itemId) {
                $num -= $value [dbs_item_base::DBKey_num];

                // 拥有足够多的道具
                if ($num <= 0) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 升级
     *
     *
     * @return array
     */
    function upgrade()
    {
    }


    /**
     * 获取仓库已有道具数量
     *
     * @return int;
     */
    public function get_itemcount()
    {
        $items = $this->get_items();
        $itemtotalcount = 0;
        foreach ($items as $value) {
            $itemtotalcount += $value [dbs_item_normal::DBKey_num];
        }
        return $itemtotalcount;
    }

    /**
     * 仓库是否已满
     *
     * @return boolean
     */
    public function isFull()
    {
        if ($this->sizeUnlimited()) {
            return false;
        }
        return $this->get_itemcount() >= $this->get_warehouse_size();
    }

    /**
     * 仓库是否无限制
     * @return bool
     */
    public function sizeUnlimited()
    {
        return $this->get_warehouse_size() === constants_warehouse::SIZE_INVALID;
    }
}