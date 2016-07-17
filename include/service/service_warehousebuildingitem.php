<?php
namespace service;
/**
 * 建材商店服务
 * @author zhipeng
 *
 */
class service_warehousebuildingitem extends service_warehousebase
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
        return $this->callerUserInstance->db_warehousebuildingitem();
    }

    /**
     * 升级
     *
     * @return 数组
     */
    function upgrade()
    {
        return $this->_getdbwarehouse()->upgrade();
    }
}