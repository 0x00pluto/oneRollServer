<?php
namespace service;
/**
 * 装饰仓库
 *
 * @author zhipeng
 *
 */
class service_warehouse extends service_warehousebase
{
    function __construct()
    {
        parent::__construct();
    }

    protected function _getdbwarehouse()
    {
        return $this->callerUserInstance->db_warehouse();
    }
}