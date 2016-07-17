<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/27
 * Time: 下午4:15
 */

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\custom\eatDishes\dbs_custom_eatDishes_player;

/**
 * 顾客吃菜系统
 * Class service_customEatDishes
 * @package service
 */
class service_customEatDishes extends service_base
{

    /**
     * service_customEatDishes constructor.
     */
    public function __construct()
    {
        $this->addFunctions([
            'getinfo',
            'getEatReceipts',
            'eatByReceiptAndCustom',
            'eatByOffline'
        ]);
        $this->addFunctions(['eatByOffline']
            , true);
    }

    /**
     * @inheritDoc
     */
    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_custom_eatDishes_player_";
    }

    /**
     * @return dbs_custom_eatDishes_player
     */
    protected function get_dbins()
    {
        return dbs_custom_eatDishes_player::createWithPlayer($this->callerUserInstance);
    }

    /**
     * 获取信息
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {
        $data = [];
        //interface err_service_customEatDishes_getinfo

        $data = $this->get_dbins()->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取票据
     * @return Common_Util_ReturnVar
     */
    public function getEatReceipts()
    {
        return $this->get_dbins()->getEatReceipts();
    }

    /**
     * 通过票据的顾客id吃饭
     * @param $receipt
     * @param $dinnerTableGuid
     * @param $customGuid
     * @return Common_Util_ReturnVar
     */
    public function eatByReceiptAndCustom($receipt, $dinnerTableGuid, $customGuid)
    {
        return $this->get_dbins()->eatByReceiptAndCustom($receipt, $dinnerTableGuid, $customGuid);
    }

    /**
     * 离线吃饭
     * @return Common_Util_ReturnVar
     */
    public function eatByOffline()
    {
        return $this->get_dbins()->eatByOffline();
    }


}