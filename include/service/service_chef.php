<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\chef\dbs_chef_data;
use dbs\chef\dbs_chef_list;

/**
 * 厨师服务
 *
 * @author zhipeng
 *
 */
class service_chef extends service_base
{

    function __construct()
    {
        $this->addFunctions(array(
            'choose',
            'getinfo',
            'fillchefvit',
            'puton',
            'takeoff',
            'giveequipment',
            'trainChef',
            'trainChefFinish',
            'getTrainChefInfo',
            'joinTrainChef',
            'sendGiftToJoinRequest',
            'cancelJoinTrainChef',
            'acceptJoinTrainChef',
            'refuseJoinTrainChef',
            'trainChefFashionShopBuy',
            'trainChefPublishAdvertisement',
            'trainChefGetRecommend',
            'trainChefGetRecommendFriend',
            'trainChefGetRecommendNeighbourhood',
            'getchefupgradeabilitys',
            'fashionDressPutOn',
            'fashionDressTakeOff'
        ));

        $this->addFunction('costvit', true);
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_chef_list_";
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_chef_list();
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
        // class err_service_chef_getinfo{}

        $data = $this->get_dbins()->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 选择厨子
     * @param int $chefOrderId 厨师选择顺序ID
     * @param string $selectedAwardIdsJsonString 选择奖励数组,[]为不选择,json数组
     * @return Common_Util_ReturnVar
     */
    function choose($chefOrderId, $selectedAwardIdsJsonString)
    {

        typeCheckJsonString($selectedAwardIdsJsonString);
        $selectedAwardIds = json_decode($selectedAwardIdsJsonString, true);
        return $this->callerUserInstance->dbs_chef_list()->choose($chefOrderId, $selectedAwardIds);
    }

    /**
     * 回复厨师体力
     *
     * @param string $chefid 厨师id
     * @return Common_Util_ReturnVar
     */
    function fillchefvit($chefid)
    {
        typeCheckGUID($chefid);
        return $this->get_dbins()->fillchefvit($chefid);
    }

    /**
     * 扣除体力
     *
     * @param unknown $chefid
     * @return Common_Util_ReturnVar
     */
    function costvit($chefid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_chef_costvit{}

        typeCheckString($chefid, 64, 32);

        $chef = $this->get_dbins()->get_chef($chefid);
        $chef->costVit(10);
        $this->get_dbins()->set_chef($chef);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 装备
     *
     * @param 装备仓库位置 $equipmentwarehousepos
     * @param 厨师id $chefid
     * @return Common_Util_ReturnVar
     */
    function puton($equipmentwarehousepos, $chefid)
    {
        typeCheckString($equipmentwarehousepos, 64, 32);
        typeCheckString($chefid, 64, 32);
        return $this->get_dbins()->puton($equipmentwarehousepos, $chefid);
    }

    /**
     * 脱下
     *
     * @param string $equipmentwarehousepos
     * @return Common_Util_ReturnVar
     */
    function takeoff($equipmentwarehousepos)
    {
        typeCheckString($equipmentwarehousepos, 64, 32);
        return $this->get_dbins()->takeoff($equipmentwarehousepos);
    }


    /**
     * 赠送装备
     *
     * @param string $destuserid
     * @param string $destchefid
     * @param string $equipmentwarehousepos
     *            装备在自己仓库的位置
     * @param bool $isputon
     *            是否直接穿上 1穿上 0不穿
     * @return Common_Util_ReturnVar
     */
    function giveequipment($destuserid, $destchefid, $equipmentwarehousepos, $isputon)
    {
        typeCheckUserId($destuserid);
        typeCheckString($destchefid, 64, 32);
        typeCheckString($equipmentwarehousepos, 64, 32);
        typeCheckChoice(intval($isputon), [0, 1]);

        return $this->get_dbins()->giveequipment($destuserid, $destchefid, $equipmentwarehousepos, $isputon);
    }

    /**
     * 培养自己的厨师
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function trainChef($chefId)
    {
        typeCheckGUID($chefId);
        return $this->get_dbins()->trainChef($chefId);
    }

    /**
     * 完成训练
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function trainChefFinish($chefId)
    {
        typeCheckGUID($chefId);
        return $this->get_dbins()->trainChefFinish($chefId);
    }

    /**
     * 获取培训数据
     * @return Common_Util_ReturnVar
     */
    public function getTrainChefInfo()
    {
        return $this->get_dbins()->getTrainChefInfo();
    }

    /**
     * 加入双休
     * @param string $chefId 我自己要参加双休的厨师ID
     * @param string $trainRoomId 对方已经修炼开出的房间ID
     * @return Common_Util_ReturnVar
     */
    public function joinTrainChef($chefId, $trainRoomId)
    {
        return $this->get_dbins()->joinTrainChef($chefId, $trainRoomId);
    }

    /**
     * 给已经发送的请求发送聘礼
     * @param string $chefId 自己的厨师ID
     * @param int $giftDiamond 聘礼钻石数
     * @param int $giftGamecoin 聘礼游戏币
     * @return Common_Util_ReturnVar
     */
    public function sendGiftToJoinRequest($chefId, $giftDiamond, $giftGamecoin)
    {
        return $this->get_dbins()->sendGiftToJoinRequest($chefId, $giftDiamond, $giftGamecoin);
    }

    /**
     * 取消加入双休的请求
     * @param string $chefId 我自己的厨师ID
     * @return Common_Util_ReturnVar
     */
    public function cancelJoinTrainChef($chefId)
    {
        return $this->get_dbins()->cancelJoinTrainChef($chefId);
    }

    /**
     * 接收加入双休的申请
     * @param string $chefId 我自己的修炼的厨师ID
     * @param string $requestId 请求ID
     * @return Common_Util_ReturnVar
     * @throws
     */
    public function acceptJoinTrainChef($chefId, $requestId)
    {
        return $this->get_dbins()->acceptJoinTrainChef($chefId, $requestId);
    }

    /**
     * 拒绝单个请求
     * @param $chefId
     * @param $requestId
     * @return Common_Util_ReturnVar
     */
    public function refuseJoinTrainChef($chefId, $requestId)
    {
        return $this->get_dbins()->refuseJoinTrainChef($chefId, $requestId);
    }

    /**
     * 培训厨师时装商店购买
     * @param int $shopId 商店的ID
     * @param int $slotId 购买第几个位置的物品,1,2,3
     * @return Common_Util_ReturnVar
     */
    public function trainChefFashionShopBuy($shopId, $slotId)
    {
        return $this->get_dbins()->trainChefFashionShopBuy($shopId, $slotId);
    }

    /**
     * 培训厨师发布广告
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function trainChefPublishAdvertisement($chefId)
    {
        return $this->get_dbins()->trainChefPublishAdvertisement($chefId);
    }

    /**
     * 获取推荐房间信息
     * @return Common_Util_ReturnVar
     */
    public function trainChefGetRecommend()
    {
        return $this->get_dbins()->trainChefGetRecommend();
    }

    /**
     * 获取好友培训房间信息
     * @return Common_Util_ReturnVar
     */
    public function trainChefGetRecommendFriend()
    {
        return $this->get_dbins()->trainChefGetRecommendFriend();
    }

    /**
     * 获取社区好友培训房间数据
     * @return Common_Util_ReturnVar
     */
    public function trainChefGetRecommendNeighbourhood()
    {
        return $this->get_dbins()->trainChefGetRecommendNeighbourhood();
    }


    /**
     * 获取厨师升级后的属性
     *
     * @param string $chefTemplateID
     *            厨师模板id
     * @param int $newlevel
     *            等级
     * @return Common_Util_ReturnVar
     */
    function getchefupgradeabilitys($chefTemplateID, $newlevel)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        // class err_service_chef_getchefupgradeabilitys{}
        typeCheckString($chefTemplateID);
        typeCheckNumber($newlevel, 0, 300);

        $chefTemplateID = strval($chefTemplateID);

        $chefConfig = dbs_chef_list::get_chef_config($chefTemplateID);
        logicErrorCondition(!is_null($chefConfig),
            1,
            'chef config error');


        $newlevel = intval($newlevel);
        $chefdata = new dbs_chef_data ();
        $chefdata->set_cheftemplateid($chefTemplateID);
        $chefdata->set_level($newlevel);
        $chefdata->computeability();

        $data = $chefdata->toArray();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 收获好感度礼包
     *
     * @param string $destuserid
     * @param string $destchefid
     * @return Common_Util_ReturnVar
     */
    function awardgoodwillgift($destuserid, $destchefid)
    {
        typeCheckUserId($destuserid);
        typeCheckGUID($destchefid);

        return $this->get_dbins()->awardgoodwillgift($destuserid, $destchefid);
    }


    /**
     * 时装穿着
     * @param string $chefId 厨师ID
     * @param string $fashionDressWarehousePositionId 时装仓库的位置
     * @return Common_Util_ReturnVar
     */
    public function fashionDressPutOn($chefId, $fashionDressWarehousePositionId)
    {
        return $this->get_dbins()->fashionDressPutOn($chefId, $fashionDressWarehousePositionId);
    }

    /**
     * 脱掉时装
     * @param string $chefId
     * @param string $fashionDressType 时装部位类型:type_0..type_11
     * @return Common_Util_ReturnVar
     */
    public function fashionDressTakeOff($chefId, $fashionDressType)
    {
        return $this->get_dbins()->fashionDressTakeOff($chefId, $fashionDressType);
    }
}