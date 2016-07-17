<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 收藏品兑换服务
 *
 * @author zhipeng
 *
 */
class service_itemcollectionexchange extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'exchange'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_itemcollectionexchange();
    }

    /**
     * 获取信息
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_itemcollectionexchange_getinfo{}

        $data = $this->get_dbins()->toArray();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 兑换.
     *
     * @param string $id
     *            配方id
     * @return Common_Util_ReturnVar
     */
    function exchange($id)
    {
        typeCheckString($id, 10);
        return $this->callerUserInstance->dbs_itemcollectionexchange()->exchange($id);
    }
}