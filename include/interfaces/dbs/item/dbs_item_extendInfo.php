<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/23
 * Time: 下午2:32
 */

namespace interfaces\dbs\item;

use dbs\item\dbs_item_normal;


/**
 * Class dbs_item_extendInfo
 * @package interfaces\dbs\item
 */
trait dbs_item_extendInfo
{
    /**
     * 属性关键字
     * @return string
     */
    abstract public function getPropertyKey();

    /**
     * 获取原本道具数据
     * @return dbs_item_normal
     */
    abstract public function getItem();

    /**
     * 设置道具
     * @param dbs_item_normal $item
     */
    abstract public function setItem(dbs_item_normal $item);

    /**
     * 保存扩展属性
     */
    public function save()
    {
        $itemInstance = $this->getItem();
        if (is_null($itemInstance)) {
            return;
        }
        $extendInfo = $itemInstance->get_extendinfo();
        $extendInfo[$this->getPropertyKey()] = $this->toArray();
        $itemInstance->set_extendinfo($extendInfo);
    }

    /**
     * 加载扩展属性
     */
    public function load()
    {
        $itemInstance = $this->getItem();
        if (is_null($itemInstance)) {
            return;
        }
        $extendInfo = $itemInstance->get_extendinfo();
        if (isset($extendInfo[$this->getPropertyKey()])) {
            $this->fromArray($extendInfo[$this->getPropertyKey()]);
        } else {
            $this->save();
        }
    }

}