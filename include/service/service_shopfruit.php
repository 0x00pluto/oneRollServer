<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 果蔬店
 *
 * @author zhipeng
 *
 */
class service_shopfruit extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getallgoods',
            'getshopinfo',
            'buyitem',
            'upgrade',
        ));
    }

    /**
     * 获取所有道具列表
     *
     * @return Common_Util_ReturnVar
     */
    function getallgoods()
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code
        $data = $this->callerUserInstance->db_shopfruitplayer()->getgoods();
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * 获取果蔬信息
     *
     * @return 数组
     */
    function getshopinfo()
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code
        $data = $this->callerUserInstance->db_shopfruitplayer()->getshopinfo();
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * 购买道具
     *
     * @param string $mallid
     * @param number $num
     * @return 数组
     */
    function buyitem($mallid, $num)
    {
        typeCheckString($mallid, 32);
        typeCheckNumber($num, 1);

        $mallid = strval($mallid);
        $num = intval($num);
        return $this->callerUserInstance->db_shopfruitplayer()->buyitem($mallid, $num);
    }


    /**
     * 升级
     *
     * @return 数组
     */
    function upgrade()
    {
        return $this->callerUserInstance->db_shopfruitplayer()->upgrade();
    }

}