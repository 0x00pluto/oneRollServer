<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 交易服务
 * @auther zhipengca
 */
class service_trade extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'expandtradebox',
            'publicorder',
            'cancelorder',
            'completeorder',
            'takebackcompleteorder',
            'getneighbourhoodorderlist',
            'getfriendorderlist'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_trade_player();
    }

    protected function get_err_class_name()
    {
        return 'err\\' . "err_dbs_trade_player_";
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
        // class err_service_trade_getinfo{}

        // code

        $data = $this->get_dbins()->toArray();
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 扩充交易格子
     *
     * @return Common_Util_ReturnVar
     */
    function expandtradebox()
    {
        return $this->get_dbins()->expandtradebox();
    }

    /**
     * 发布订单
     *
     * @param string $sellitemid
     *            出售物品id
     * @param int $sellitemnum
     *            出售物品数量 1~10
     * @param string $buyitemid
     *            求购物品id
     * @param int $buyitemnum
     *            求购物品数量 1~10
     * @return Common_Util_ReturnVar
     */
    function publicorder($sellitemid, $sellitemnum, $buyitemid, $buyitemnum)
    {
        typeCheckString($sellitemid, 32);
        typeCheckNumber($sellitemnum, 1, 10);
        typeCheckString($buyitemid, 32);
        typeCheckNumber($buyitemnum, 1, 10);

        return $this->get_dbins()->publicorder($sellitemid, $sellitemnum, $buyitemid, $buyitemnum);
    }

    /**
     * 取消订单
     *
     * @param unknown $tradeid
     * @return Common_Util_ReturnVar
     */
    function cancelorder($tradeid)
    {
        typeCheckGUID($tradeid);
        return $this->get_dbins()->cancelorder($tradeid);
    }

    /**
     * 完成订单
     *
     * @param string $destuserid
     * @param string $tradeid
     * @return Common_Util_ReturnVar
     */
    function completeorder($destuserid, $tradeid)
    {
        typeCheckUserId($destuserid);
        typeCheckGUID($tradeid);
        return $this->get_dbins()->completeorder($destuserid, $tradeid);
    }

    /**
     * 获取邻居的出售列表
     *
     * @return Common_Util_ReturnVar
     */
    function getneighbourhoodorderlist()
    {
        return $this->get_dbins()->getneighbourhoodorderlist();
    }

    /**
     * 获取好友出售列表
     *
     * @return Common_Util_ReturnVar
     */
    function getfriendorderlist()
    {
        return $this->get_dbins()->getfriendorderlist();
    }

    /**
     * 取回完成的订单物品
     *
     * @param unknown $tradeid
     * @return Common_Util_ReturnVar
     */
    function takebackcompleteorder($tradeid)
    {
        typeCheckGUID($tradeid);
        return $this->get_dbins()->takebackcompleteorder($tradeid);
    }
}