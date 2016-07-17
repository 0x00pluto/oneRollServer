<?php
namespace service;
/**
 * 冰箱服务
 * @author zhipeng
 *
 */
class service_warehouseicebox extends service_warehousebase
{
    function __construct()
    {
        parent::__construct();
        $this->addFunctions(array(
            'upgrade'
        ));
    }

    protected function _getdbwarehouse()
    {
        return $this->callerUserInstance->db_warehouseicebox();
    }

    /**
     * 冰箱升级服务
     *
     * @return 数组
     */
    function upgrade()
    {
        return $this->_getdbwarehouse()->upgrade();
    }
}