<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_warehousebase;

abstract class service_warehousebase extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'removeitembypos',
            'removeitemtosell'
        ));
    }

    /**
     * 仓库实际访问接口
     *
     * @return dbs_warehousebase
     */
    abstract protected function _getdbwarehouse();

    /**
     * 获取基础信息
     *
     * @return 数组
     */
    function getinfo()
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code
        $data = $this->_getdbwarehouse()->toArray();
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * 删除道具
     *
     * @param string $pos
     *            位置信息
     * @param int $num
     *            数量
     */
    function removeitembypos($pos, $num)
    {
        typeCheckGUID($pos);
        typeCheckNumber($num, 1);
        $pos = strval($pos);
        $num = intval($num);
        return $this->_getdbwarehouse()->removeitem($pos, $num);
    }

    /**
     * 出售道具
     *
     * @param unknown $pos
     * @param number $num
     * @return Common_Util_ReturnVar
     */
    function removeitemtosell($pos, $num)
    {
        typeCheckGUID($pos);
        typeCheckNumber($num, 1);
        return $this->_getdbwarehouse()->removeitemtosell($pos, $num);
    }
}