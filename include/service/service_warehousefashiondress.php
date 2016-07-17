<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/23
 * Time: 上午11:53
 */

namespace service;


use dbs\warehouse\dbs_warehouse_fashionDress;

/**
 * 时装仓库服务
 * @package service
 */
class service_warehousefashiondress extends service_warehousebase
{
    protected function _getdbwarehouse()
    {
        return dbs_warehouse_fashionDress::createWithPlayer($this->callerUserInstance);
    }
}
