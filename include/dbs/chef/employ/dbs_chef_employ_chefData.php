<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/26
 * Time: 上午11:59
 */

namespace dbs\chef\employ;


use Common\Util\Common_Util_Time;
use constants\constants_ChefEmployStatus;
use constants\constants_mailTemplates;
use dbs\chef\dbs_chef_list;
use dbs\dbs_player;
use dbs\mailbox\dbs_mailbox_data;
use dbs\templates\chef\employ\dbs_templates_chef_employ_chefData;

class dbs_chef_employ_chefData extends dbs_templates_chef_employ_chefData
{

    /**
     * 获取请求
     * @param $requestId
     * @return null|dbs_chef_employ_request
     */
    public function getRequestData($requestId)
    {
        $requests = $this->get_requests();
        if (!isset($requests[$requestId])) {
            return null;
        }
        return dbs_chef_employ_request::create_with_array($requests[$requestId]);
    }

    /**
     * 保存请求数据
     * @param dbs_chef_employ_request $data
     */
    public function setRequestData(dbs_chef_employ_request $data)
    {
        $requests = $this->get_requests();
        $requests[$data->get_requestId()] = $data->toArray();
        $this->set_requests($requests);
    }

    /**
     * 删除请求数据
     * @param $requestId
     */
    public function deleteRequest($requestId)
    {
        $requestId = strval($requestId);
        $requests = $this->get_requests();
        unset($requests[$requestId]);
        $this->set_requests($requests);
    }

    /**
     * 拒绝请求
     * @param $requestId
     * @return bool
     */
    public function refuseRequest($requestId)
    {
        $requests = $this->get_requests();
        if (!isset($requests[$requestId])) {
            return false;
        }

        $requestData = dbs_chef_employ_request::create_with_array($requests[$requestId]);

        //删除发送方的请求
        $fromPlayer = dbs_player::newGuestPlayerWithLock($requestData->get_fromUserId());
        dbs_chef_employ_player::createWithPlayer($fromPlayer)->deleteSendRequestData($requestId);

        //获取对方要雇佣我的厨师数据
        $selfPlayer = dbs_player::getMasterPlayer();
        $chefData = dbs_chef_list::createWithPlayer($selfPlayer)->get_chef($requestData->get_toChefId());

        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::HIRE_CHEF_REQUEST_REFUSE,
            [
                'requestData' => $requestData->toArray(),
                'toChefData' => $chefData->toArray()
            ]
            , $requestData->get_toUserId())
            ->addAttachmentGamecoinAndDiamond(
                $requestData->get_presentGameCoin(),
                $requestData->get_presentDiamond()
            )
            ->send($requestData->get_fromUserId());


        //删除请求
        unset($requests[$requestId]);
        $this->set_requests($requests);

        return true;

    }

    /**
     * 拒绝所有请求
     */
    public function refuseAllRequest()
    {
        $requests = $this->get_requests();
        foreach ($requests as $requestId => $requestValue) {
            $this->refuseRequest($requestId);
        }
    }

    /**
     * 是否空闲
     * @return bool
     */
    public function isFree()
    {
        return $this->get_status() === constants_ChefEmployStatus::STATUS_FREE;
    }

    /**
     * 是否雇佣中
     * @return bool
     */
    public function isEmployed()
    {
        return $this->get_status() === constants_ChefEmployStatus::STATUS_EMPLOYED;
    }

    /**
     * 被雇佣
     * @param string $employerUserid 雇主的用户ID
     * @return bool
     */
    public function employed($employerUserid)
    {
        if ($this->isFree()) {
            return false;
        }
        $this->set_status(constants_ChefEmployStatus::STATUS_EMPLOYED);
        $this->set_employerId($employerUserid);
        $this->set_employStartTime(time());
        $this->set_employEndTime(time() + \getGlobalValue("CHEF_HIRE_TIME_MAX")->int_value());
        return true;
    }

    /**
     * 是否过期
     * @return bool
     */
    public function isExpired()
    {
        if ($this->isEmployed()) {
            return $this->get_employEndTime() + Common_Util_Time::getDelayExpiredSecond() < time();
        }
        return false;
    }
}