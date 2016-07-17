<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 海鲜店
 *
 * @author zhipeng
 *
 */
class service_shopseafood extends service_base
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
     * @return 数组
     */
    function getallgoods()
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code
        $data = $this->callerUserInstance->db_shopseafoodplayer()->getgoods();
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * 获取海鲜店信息
     *
     * @return 数组
     */
    function getshopinfo()
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code
        $data = $this->callerUserInstance->db_shopseafoodplayer()->getshopinfo();
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
        return $this->callerUserInstance->db_shopseafoodplayer()->buyitem($mallid, $num);
    }


    /**
     * 升级
     *
     * @return 数组
     */
    function upgrade()
    {
        return $this->callerUserInstance->db_shopseafoodplayer()->upgrade();
    }

}