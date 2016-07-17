<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 道具合成服务
 *
 * @author zhipeng
 *
 */
class service_composeitem extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'opendiamondslot',
            'compose',
            'harvestcomposeitem',
            'openlevelslots'
        ));

        $this->addFunction('test', TRUE);
    }

    /**
     * 获取信息
     *
     * @return Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_composeitem_getinfo{}

        $data = $this->callerUserInstance->db_compose_item()->toArray();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 测试代码
     *
     * @return Common_Util_ReturnVar
     */
    function test()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_composeitem_test{}

        $data = $this->callerUserInstance->db_compose_item()->toArray();
        // $this->callerUserInstance->db_compose_item ();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 开启槽位
     *
     * @return Common_Util_ReturnVar
     */
    function opendiamondslot()
    {
        return $this->callerUserInstance->db_compose_item()->opendiamondslot();
    }

    /**
     * 合成
     *
     * @param string $slotid
     *            合成位置
     * @param string $composeid
     *            合成道具id
     * @return Common_Util_ReturnVar
     */
    function compose($slotid, $composeid)
    {
//        typeCheckString($slotid);
//        typeCheckNumber($composeid);
        return $this->callerUserInstance->db_compose_item()->compose($slotid, $composeid);
    }

    /**
     * 收获合成物品
     *
     * @param unknown $slotid
     * @return Common_Util_ReturnVar
     */
    function harvestcomposeitem($slotid)
    {
//        typeCheckString($slotid);
        return $this->callerUserInstance->db_compose_item()->harvestcomposeitem($slotid);
    }

    /**
     * 开启根据等级开启的槽位
     *
     * @return Common_Util_ReturnVar
     */
    function openlevelslots()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_composeitem_function_name{}

        $this->callerUserInstance->db_compose_item()->openlevelslots();
        // code
        $data = $this->callerUserInstance->db_compose_item()->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}