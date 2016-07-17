<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/26
 * Time: 下午3:12
 */

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\chef\employ\dbs_chef_employ_player;

/**
 * 厨师雇佣
 * Class service_chefEmploy
 * @package service
 */
class service_chefEmploy extends service_base
{

    /**
     * service_chefEmploy constructor.
     */
    public function __construct()
    {
        $this->addFunctions([
            'getinfo',
            'sendRequest',
            'cancelRequest',
            'refuseRequest',
            'refuseAllRequest',
            'acceptRequest'
        ]);

        $this->addFunctions([
            'fireChef'
        ]);
    }

    /**
     * @return dbs_chef_employ_player
     */
    protected function get_dbins()
    {
        return dbs_chef_employ_player::createWithPlayer($this->callerUserInstance);
    }

    /**
     * @inheritDoc
     */
    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_chef_employ_player_";
    }


    /**
     * 信息
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {
        $data = [];
        //interface err_service_chefEmploy_getinfo

        $data = $this->get_dbins()->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 发送雇佣请求
     * @param string $destUserId 目标用户ID
     * @param string $destChefId 目标厨师ID
     * @param int $presentType 0游戏币,1钻石
     * @param int $presentValue 聘礼数量
     * @return Common_Util_ReturnVar
     */
    public function sendRequest($destUserId, $destChefId, $presentType, $presentValue)
    {
        return $this->get_dbins()->sendRequest($destUserId, $destChefId, $presentType, $presentValue);
    }

    /**
     * 取消请求
     * @param $requestId
     * @return Common_Util_ReturnVar
     */
    public function cancelRequest($requestId)
    {
        return $this->get_dbins()->cancelRequest($requestId);
    }

    /**
     * 拒绝单个请求
     * @param string $chefId 厨师ID
     * @param string $requestId 请求ID
     * @return Common_Util_ReturnVar
     */
    public function refuseRequest($chefId, $requestId)
    {
        return $this->get_dbins()->refuseRequest($chefId, $requestId);
    }

    /**
     * 拒绝所有请求
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function refuseAllRequest($chefId)
    {
        return $this->get_dbins()->refuseAllRequest($chefId);
    }

    /**
     * 接收请求
     * @param string $chefId 厨师ID
     * @param string $requestId 请求ID
     * @return Common_Util_ReturnVar
     */
    public function acceptRequest($chefId, $requestId)
    {
        return $this->get_dbins()->acceptRequest($chefId, $requestId);
    }

    /**
     * 开除厨师
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function fireChef($chefId)
    {
        return $this->get_dbins()->fireChef($chefId);
    }
}