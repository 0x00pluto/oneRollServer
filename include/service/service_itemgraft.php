<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/15
 * Time: 下午3:26
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\itemgraft\dbs_itemgraft_player;

/**
 * 道具嫁接服务
 * Class service_itemgraft
 * @package service
 */
class service_itemgraft extends service_base
{
    function __construct()
    {
        $this->addFunctions([
            'getinfo',
            'prepareGraft',
            'answerGraft',
            'acceptGraft',
            'refuseGraft',
            'refuseGraftAll',
            'harvestGraft',
            'publishAdvertisement',
            'getRecommendItemGraftData',
            'getRecommendFriendsItemGraftData',
            'getRecommendNeighbourhoodItemGraftData'
        ]);

        $this->addFunctions([
            'addResultWeight'
        ], true);
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_itemgraft_player_";
    }

    /**
     * @return dbs_itemgraft_player|null
     */
    protected function get_dbins()
    {
        return dbs_itemgraft_player::createWithPlayer($this->callerUserInstance);
    }

    /**
     * 获取信息
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {

        $data = $this->get_dbins()->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 准备嫁接
     * @param $slotId
     * @param $itemId
     * @param $itemCount
     * @return Common_Util_ReturnVar
     */
    public function prepareGraft($slotId, $itemId, $itemCount)
    {
        return $this->get_dbins()->prepareGraft($slotId, $itemId, $itemCount);
    }

    /**
     * 开始嫁接
     * @param $destUserId
     * @param $slotId
     * @param $itemId
     * @param $itemCount
     * @return Common_Util_ReturnVar
     */
    public function answerGraft($destUserId, $slotId, $itemId, $itemCount)
    {
        return $this->get_dbins()->answerGraft($destUserId, $slotId, $itemId, $itemCount);
    }

    /**
     * 接收嫁接
     * @param $slotId
     * @param string $destUserId 目标用户id
     * @return Common_Util_ReturnVar
     */
    public function acceptGraft($slotId, $destUserId)
    {
        return $this->get_dbins()->acceptGraft($slotId, $destUserId);
    }

    /**
     * 拒绝嫁接
     * @param $slotId
     * @param string $destUserId 目标用户id
     * @return Common_Util_ReturnVar
     */
    public function refuseGraft($slotId, $destUserId)
    {
        return $this->get_dbins()->refuseGraft($slotId, $destUserId);
    }

    /**
     * 拒绝所有请求
     * @param $slotId
     * @return Common_Util_ReturnVar
     */
    public function refuseGraftAll($slotId)
    {
        return $this->get_dbins()->refuseGraftAll($slotId);
    }

    /**
     * 增加结果加成
     * @param $destUserId
     * @param $slotId
     * @param $index
     * @param int $num
     * @return Common_Util_ReturnVar
     */
    public function addResultWeight($destUserId, $slotId, $index, $num)
    {
        return $this->get_dbins()->addResultWeight($destUserId, $slotId, $index, $num);
    }

    /**
     * 收获嫁接
     * @param $destUserId
     * @param $slotId
     * @return Common_Util_ReturnVar
     */
    public function harvestGraft($destUserId, $slotId)
    {
        return $this->get_dbins()->harvestGraft($destUserId, $slotId);
    }

    /**
     * 发布广告
     * @param string $slotId 槽位ID
     * @param int $useDiamond [0,1] 是否使用钻石
     * @return Common_Util_ReturnVar
     */
    public function publishAdvertisement($slotId, $useDiamond)
    {
        return $this->get_dbins()->publishAdvertisement($slotId, $useDiamond);
    }

    /**
     * 获取推荐道具合成用户数据
     * @return Common_Util_ReturnVar
     */
    public function getRecommendItemGraftData()
    {
        return $this->get_dbins()->getRecommendItemGraftData();
    }

    /**
     * 获取好友的嫁接数据
     * @return Common_Util_ReturnVar
     */
    public function getRecommendFriendsItemGraftData()
    {
        return $this->get_dbins()->getRecommendFriendsItemGraftData();
    }

    /**
     * 获取社区人的嫁接数据
     * @return Common_Util_ReturnVar
     */
    public function getRecommendNeighbourhoodItemGraftData()
    {
        return $this->get_dbins()->getRecommendNeighbourhoodItemGraftData();
    }
}