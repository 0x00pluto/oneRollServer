<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 好友帮忙
 * @auther zhipeng
 */
class service_friendhelp extends service_base
{
    function __construct()
    {
        $this->addFunctions([
            'getinfo',
            'helpEatDishes',
            'helpRecvEatDishes',
            'helpCookDishes',
            'helpRecvCookDishes',
            'helpExpand',
            'helpRecvExpand'

        ]);
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_friendhelp_player();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_friendhelp_player_";
    }

    /**
     * 获取帮助信息
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_friendhelp_getinfo{}

        $data = $this->get_dbins()->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }


    /**
     * 帮忙吃菜
     * @param $friendUserId
     * @param int $themeRestaurantId
     * @param $dinnerTableId
     * @return Common_Util_ReturnVar
     */
    public function helpEatDishes($friendUserId, $themeRestaurantId, $dinnerTableId)
    {
        return $this->get_dbins()->helpEatDishes($friendUserId, $themeRestaurantId, $dinnerTableId);
    }

    /**
     * 接收帮忙吃菜
     * @return Common_Util_ReturnVar
     */
    public function helpRecvEatDishes()
    {
        return $this->get_dbins()->helpRecvEatDishes();
    }


    /**
     * 帮忙加速做菜
     * @param $friendUserId
     * @param $cookingTableId
     * @param int $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function helpCookDishes($friendUserId, $themeRestaurantId, $cookingTableId)
    {
        return $this->get_dbins()->helpCookDishes($friendUserId, $themeRestaurantId, $cookingTableId);
    }

    /**
     * 接收帮忙做菜,只是清空帮忙数据
     * @param $themeRestaurantId
     * @param $cookingTableId
     * @return Common_Util_ReturnVar
     */
    public function helpRecvCookDishes($themeRestaurantId, $cookingTableId)
    {
        return $this->get_dbins()->helpRecvCookDishes($themeRestaurantId, $cookingTableId);
    }

    /**
     * 帮忙加速扩建
     * @param $friendUserId
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function helpExpand($friendUserId, $themeRestaurantId)
    {
        return $this->get_dbins()->helpExpand($friendUserId, $themeRestaurantId);
    }


    /**
     * 接收加速扩建
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function helpRecvExpand($themeRestaurantId)
    {
        return $this->get_dbins()->helpRecvExpand($themeRestaurantId);
    }


}