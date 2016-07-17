<?php
namespace service;
/**
 * 装备仓库
 * @author zhipeng
 *
 */
class service_warehouseequipment extends service_warehousebase
{
    protected function _getdbwarehouse()
    {
        return $this->callerUserInstance->dbs_warehouseequipment();
    }
}