<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 餐厅基础服务接口
 *
 * @author zhipeng
 *
 */
class service_restaurant extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo'
        ));
        $this->addFunctions([
            'test',
        ], true);
    }

    /**
     * 获取餐厅基础信息
     *
     * @return Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $data = array();
        // $retCodeArr = array();
        // code
        // $this->callerUserInstance->db_restaurantinfo ()->addreputationexp ( 1 );
        $data = $this->callerUserInstance->db_restaurantinfo()->toArray();

        $this->callerUserInstance->dbs_friend_recommemd()->set_restaurantlevel($this->callerUserInstance->db_restaurantinfo()->get_restaurantlevel());
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }


    /**
     *
     * @return Common_Util_ReturnVar
     */
    function test()
    {
        $retCode = 0;
        $data = array();
        // $retCodeArr = array();
        // code
//        $this->callerUserInstance->db_restaurantinfo()->addrestaurantexp(200);

        // $this->callerUserInstance->db_restaurantinfo ()->addreputationexp ( 1999 );
        // $this->callerUserInstance->db_restaurantinfo ()->reduecreputationexp ( 199 );

        // $this->callerUserInstance->db_restaurantinfo ()->computecustoms ( 20 );
//        $data = $this->callerUserInstance->db_restaurantinfo()->toArray();

//        dbs_restaurantinfo::createWithPlayer($this->callerUserInstance)->awardLevelUpAward();
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }
}