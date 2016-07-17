<?php
namespace service;
/**
 * 通用背包服务
 * @author zhipeng
 *
 */
class service_warehousenormal extends service_warehousebase
{
    function __construct()
    {
        parent::__construct();
    }

    protected function _getdbwarehouse()
    {
        return $this->callerUserInstance->db_warehousenormal();
    }
}