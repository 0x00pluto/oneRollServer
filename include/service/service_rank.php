<?php
namespace service;
use Common\Util\Common_Util_ReturnVar;

/**
 * 排行榜服务
 * @auther zhipeng
 *
 */
class service_rank extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getrestaurantrank',
            'getrestaurantreputationrank',
            'getaddgamecoinrank',
            'getdiamondsrank',
            'getneighboorhoodreputationrank',

            'getfrienddiamondsrank',
            'getfriendaddgamecoinrank',
            'getfriendrestaurantrank',
            'getfriendrestaurantreputationrank'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_rank_player();
    }

    protected function get_err_class_name()
    {
        return "err_dbs_rank_player_";
    }

    /**
     * 获取餐厅等级排行
     *
     * @return Common_Util_ReturnVar
     */
    function getrestaurantrank()
    {
        return $this->get_dbins()->getrestaurantrank();
    }

    /**
     * 获取美誉度排行
     *
     * @return Common_Util_ReturnVar
     */
    function getrestaurantreputationrank()
    {
        return $this->get_dbins()->getrestaurantreputationrank();
    }

    /**
     * 获取收入排行
     *
     * @return Common_Util_ReturnVar
     */
    function getaddgamecoinrank()
    {
        return $this->get_dbins()->getaddgamecoinrank();
    }

    /**
     * 获取钻石排行
     *
     * @return Common_Util_ReturnVar
     */
    function getdiamondsrank()
    {
        return $this->get_dbins()->getdiamondsrank();
    }

    /**
     * 获取社区声望排行
     *
     * @return Common_Util_ReturnVar
     */
    function getneighboorhoodreputationrank()
    {
        return $this->get_dbins()->getneighboorhoodreputationrank();
    }

    /**
     * 获取好友钻石排行
     *
     * @return Common_Util_ReturnVar
     */
    function getfrienddiamondsrank()
    {
        return $this->get_dbins()->getfrienddiamondsrank();
    }

    /**
     * 获取好友收入排行
     *
     * @return Common_Util_ReturnVar
     */
    function getfriendaddgamecoinrank()
    {
        return $this->get_dbins()->getfriendaddgamecoinrank();
    }

    /**
     * 获取好友餐厅等级排行
     *
     * @return Common_Util_ReturnVar
     */
    function getfriendrestaurantrank()
    {
        return $this->get_dbins()->getfriendrestaurantrank();
    }

    /**
     * 获取好友美誉度排行
     *
     * @return Common_Util_ReturnVar
     */
    function getfriendrestaurantreputationrank()
    {
        return $this->get_dbins()->getfriendrestaurantreputationrank();
    }
}