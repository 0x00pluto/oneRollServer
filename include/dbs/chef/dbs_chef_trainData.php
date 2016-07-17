<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/24
 * Time: 下午4:29
 */

namespace dbs\chef;


use constants\constants_trainChef;
use dbs\chef\train\dbs_chef_train_Room;
use dbs\chef\train\dbs_chef_train_RoomData;
use dbs\chef\train\dbs_chef_train_RoomRequestData;
use dbs\i\dbs_i_iCooldown;
use dbs\templates\chef\dbs_templates_chef_traindata;

class dbs_chef_trainData extends dbs_templates_chef_traindata implements dbs_i_iCooldown
{
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue(self::DBKey_status, constants_trainChef::STATUS_FREE);
    }

    /**
     * 是否空闲
     * @return bool
     */
    public function isFree()
    {
        return $this->get_status() === constants_trainChef::STATUS_FREE;
    }

    /**
     * 是否在训练中
     * @return bool
     */
    public function isTraining()
    {
        return $this->get_status() === constants_trainChef::STATUS_TRAINING;
    }

    /**
     * 是否等待应答
     * @return bool
     */
    public function isWaitAnswer()
    {
        return $this->get_status() === constants_trainChef::STATUS_WAIT_ANSWER;
    }


    /**
     * 已主人形式开始修炼
     * @param dbs_chef_train_Room $roomData
     * @return bool
     */
    public function startTrainAsMaster(dbs_chef_train_Room $roomData)
    {
        if (!$this->isFree()) {
            return false;
        }
        $this->set_trainRoomId($roomData->get_roomId());
        $this->set_isMaster(true);
        $this->set_status(constants_trainChef::STATUS_TRAINING);
        $this->set_startTime($roomData->get_startTime());
        $this->set_finishTime($roomData->get_finishTime());
        $this->set_todayTrainCount($this->get_todayTrainCount() + 1);
        return true;
    }


    /**
     * 请求加入双休
     * @param dbs_chef_train_Room $roomData
     * @param dbs_chef_train_RoomRequestData $requestData
     * @return bool
     */
    public function requestJoinTrain(dbs_chef_train_Room $roomData,
                                     dbs_chef_train_RoomRequestData $requestData)
    {
        if (!$this->isFree()) {
            return false;
        }
        $this->set_trainRoomId($roomData->get_roomId());
        $this->set_isMaster(false);
        $this->set_status(constants_trainChef::STATUS_WAIT_ANSWER);
        $this->set_startTime($roomData->get_startTime());
        $this->set_finishTime($roomData->get_finishTime());
        $this->set_trainRequestId($requestData->get_requestId());
        return true;
    }

    /**
     * 取消加入请求
     * @return bool
     */
    public function cancelJoinTrain()
    {
        if (!$this->isWaitAnswer()) {
            return false;
        }
        $this->reset_trainRoomId()
            ->reset_isMaster()
            ->reset_status()
            ->reset_startTime()
            ->reset_finishTime()
            ->reset_trainRequestId();

        return true;
    }

    /**
     * 同意他人加入我的双休
     * @param dbs_chef_train_Room $roomData
     */
    public function acceptOtherJoinMyTrain(dbs_chef_train_Room $roomData)
    {
        $this->set_finishTime($roomData->get_finishTime());

        //加入培训人的几率
        $this->addTrainedUserId($roomData->get_slaveTrainData()[dbs_chef_train_RoomData::DBKey_userid]);
    }


    /**1
     * 被别人同意加入双休
     * @param dbs_chef_train_Room $roomData
     * @return bool
     */
    public function acceptedByOther(dbs_chef_train_Room $roomData)
    {
        if (!$this->isWaitAnswer()) {
            return false;
        }

        $this->set_status(constants_trainChef::STATUS_TRAINING);
//        $this->set_startTime(time());
        $this->set_finishTime($roomData->get_finishTime());

        $this->reset_trainRequestId();
        $this->set_todayTrainCount($this->get_todayTrainCount() + 1);
        $this->addTrainedUserId($roomData->get_masterTrainData()[dbs_chef_train_RoomData::DBKey_userid]);
        return true;
    }


    /**
     * 加入被培训者的Id
     * @param $userId
     */
    private function addTrainedUserId($userId)
    {
        if (empty($userId)) {
            return;
        }
        $userIds = $this->get_todayTrainedUserIds();
        $userIds[$userId] = time();
        $this->set_todayTrainedUserIds($userIds);
    }

    /**
     * 拒绝加入双休申请
     * @return bool
     */
    public function refuseJoinTrain()
    {
        if (!$this->isWaitAnswer()) {
            return false;
        }
        $this->finishTraining();
        return true;
    }

    /**
     * 清除培训历史信息
     */
    public function resetTrainHistory()
    {
        $this->reset_todayTrainCount()
            ->reset_todayTrainedUserIds();
    }

    /**
     * 完成培训
     */
    public function finishTraining()
    {
        $this->reset_trainRoomId()
            ->reset_isMaster()
            ->reset_status()
            ->reset_startTime()
            ->reset_finishTime()
            ->reset_trainRequestId();
    }

    /**
     * @inheritDoc
     */
    function clearCooldown()
    {
        $this->set_finishTime(0);
    }

    /**
     * @inheritDoc
     */
    function is_Cooldown()
    {
        if (!$this->isTraining()) {
            return false;
        }
        return time() < $this->get_finishTime();
    }

    /**
     * @inheritDoc
     */
    function getCooldownTime()
    {
        if ($this->is_Cooldown()) {
            return $this->get_finishTime() - time();
        }
        return 0;
    }

    /**
     * @inheritDoc
     */
    function get_clearCooldownDiamond()
    {
        return 1;
    }


}