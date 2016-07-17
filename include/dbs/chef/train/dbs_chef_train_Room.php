<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/24
 * Time: 下午4:37
 */

namespace dbs\chef\train;


use Common\Util\Common_Util_Guid;
use configdata\configdata_chef_train_setting;
use constants\constants_chefstatus;
use constants\constants_mail;
use constants\constants_mailactiontype;
use constants\constants_mailTemplates;
use constants\constants_trainRoom;
use dbs\chef\dbs_chef_data;
use dbs\chef\dbs_chef_list;
use dbs\dbs_player;
use dbs\dbs_role;
use dbs\filters\dbs_filters_role;
use dbs\i\dbs_i_iCooldown;
use dbs\mailbox\dbs_mailbox_data;
use dbs\templates\chef\dbs_templates_chef_trainservice;

/**
 * 培训数据
 * Class dbs_chef_train_Room
 * @package dbs\chef\train
 */
class dbs_chef_train_Room extends dbs_templates_chef_trainservice implements dbs_i_iCooldown
{
    protected function _set_defaultvalue_masterTrainData()
    {
        $this->set_defaultkeyandvalue(self::DBKey_masterTrainData, dbs_chef_train_RoomData::dumpDefaultValue());
    }

    protected function _set_defaultvalue_slaveTrainData()
    {
        $this->set_defaultkeyandvalue(self::DBKey_slaveTrainData, dbs_chef_train_RoomData::dumpDefaultValue());
    }

    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue(self::DBKey_status, constants_trainRoom::STATUS_EMPTY);
    }


    /**
     * dbs_chef_train_Room constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->set_tablename(self::DBKey_tablename);
        $this->set_primary_key([self::DBKey_roomId]);

    }


    /**
     * 设置房主
     * @param dbs_player $player
     * @param dbs_chef_data $chef_data
     * @return bool
     */
    public function setMasterChef(dbs_player $player, dbs_chef_data $chef_data)
    {

        $chefLevel = $chef_data->get_level();
        $trainConfig = getConfigData(configdata_chef_train_setting::class,
            configdata_chef_train_setting::k_level,
            $chefLevel);
        if (is_null($trainConfig)) {
            return false;
        }


        $trainData = dbs_chef_train_RoomData::create_with_array($this->get_masterTrainData());
        $trainData->set_chefid($chef_data->get_guid());
        $trainData->set_chefinfo($chef_data->toArray());
        $trainData->set_userid($player->get_userid());
        $trainData->set_userinfo(dbs_filters_role::getNormalInfo(dbs_role::createWithPlayer($player)));
        $this->set_masterTrainData($trainData->toArray());


        //设置到期时间
        $this->set_startTime(time());
        $this->set_finishTime(time() + intval($trainConfig[configdata_chef_train_setting::k_traintime]));

        $this->set_status(constants_trainRoom::STATUS_SINGLE_TRAIN);

        return true;

    }


    /**
     * 主人领取奖励
     * @return bool
     */
    public function masterChefReceiveAward()
    {
        $trainData = dbs_chef_train_RoomData::create_with_array($this->get_masterTrainData());
        if ($trainData->get_receiveAward()) {
            return false;
        }
        $trainData->set_receiveAward(true);
        $this->set_masterTrainData($trainData->toArray());
        return true;
    }

    /**
     * 客人领取奖励
     * @return bool
     */
    public function slaveChefReceiveAward()
    {
        $trainData = dbs_chef_train_RoomData::create_with_array($this->get_slaveTrainData());
        if ($trainData->get_receiveAward()) {
            return false;
        }
        $trainData->set_receiveAward(true);
        $this->set_slaveTrainData($trainData->toArray());
        return true;
    }

    /**
     * 是否可以销毁房间
     * @return bool
     */
    public function isCanDestroy()
    {
        if ($this->isSingleTrain()) {
            $trainData = dbs_chef_train_RoomData::create_with_array($this->get_masterTrainData());
            return $trainData->get_receiveAward();
        } else if ($this->isDoubleTrain()) {
            $masterTrainData = dbs_chef_train_RoomData::create_with_array($this->get_masterTrainData());
            $slaveTrainData = dbs_chef_train_RoomData::create_with_array($this->get_slaveTrainData());
            return $masterTrainData->get_receiveAward() && $slaveTrainData->get_receiveAward();
        } else {
            return false;
        }
    }

    /**
     * 是否是单休
     * @return bool
     */
    public function isSingleTrain()
    {
        return $this->get_status() === constants_trainRoom::STATUS_SINGLE_TRAIN;
    }

    /**
     * 是否是双休
     * @return bool
     */
    public function isDoubleTrain()
    {
        return $this->get_status() === constants_trainRoom::STATUS_DOUBLE_TRAIN;
    }


    /**
     * 获取服务
     * @param $roomId
     * @return dbs_chef_train_Room
     */
    static function getRoom($roomId)
    {
        $ins = self::findOrNew([self::DBKey_roomId => $roomId]);
        return $ins;
    }

    /**
     * 生成一个新的房间
     * @return dbs_chef_train_Room
     */
    static function newRoom()
    {
        $ins = new self();
        $ins->set_roomId(Common_Util_Guid::gen_train_room_id());
        return $ins;
    }

    /**
     * 根据厨师ID,判断此厨师是否发送了请求
     * @param $chefId
     * @return bool
     */
    public function requestExist($chefId)
    {
        $requests = $this->get_joinRequests();
        foreach ($requests as $request) {
            if ($request[dbs_chef_train_RoomRequestData::DBKey_chefid] === $chefId) {
                return true;
            }
        }
        return false;
    }

    /**
     * 增加双休申请
     * @param dbs_chef_train_RoomRequestData $requestData
     * @return bool
     */
    public function addJoinRequest(dbs_chef_train_RoomRequestData $requestData)
    {
        if (!$this->isSingleTrain()) {
            return false;
        }
        if (time() > $this->get_finishTime()) {
            return false;
        }
        $requests = $this->get_joinRequests();
        $requests[$requestData->get_requestId()] = $requestData->toArray();

        $this->set_joinRequests($requests);
        return true;
    }

    /**
     * 获取双休申请
     * @param $requestId
     * @return null|dbs_chef_train_RoomRequestData
     */
    public function getJoinRequest($requestId)
    {

        $requests = $this->get_joinRequests();
        if (isset($requests[$requestId])) {
            $request = dbs_chef_train_RoomRequestData::create_with_array($requests[$requestId]);
            return $request;
        }
        return null;
    }

    /**
     * 取消加入请求
     * @param $requestId
     */
    public function cancelJoinRequest($requestId)
    {
        $requests = $this->get_joinRequests();
        if (isset($requests[$requestId])) {
            unset($requests[$requestId]);
            $this->set_joinRequests($requests);
        }
    }


    /**
     * 接收请求
     * @param $requestId
     * @return bool
     */
    public function acceptJoinRequest($requestId)
    {
        if (!$this->isSingleTrain()) {
            return false;
        }
        $requests = $this->get_joinRequests();
        if (!isset($requests[$requestId])) {
            return false;
        }

        $requestData = $requests[$requestId];
        $request = dbs_chef_train_RoomRequestData::create_with_array($requestData);

        $chefLevel = $request->get_chefinfo()[dbs_chef_data::DBKey_level];
        $slaveTrainConfig = getConfigData(configdata_chef_train_setting::class,
            configdata_chef_train_setting::k_level,
            $chefLevel);
        if (is_null($slaveTrainConfig)) {
            return false;
        }
        $masterChef = $this->get_masterTrainData()[dbs_chef_train_RoomData::DBKey_chefinfo];

        $chefLevel = $masterChef[dbs_chef_data::DBKey_level];
        $masterTrainConfig = getConfigData(configdata_chef_train_setting::class,
            configdata_chef_train_setting::k_level,
            $chefLevel);
        if (is_null($masterTrainConfig)) {
            return false;
        }

        $roomTrainData = dbs_chef_train_RoomData::createWithRequestData($request);
        $this->set_slaveTrainData($roomTrainData->toArray());

        //重新计算时间

        //双休时间
        $trainJoinTime = intval($masterTrainConfig[configdata_chef_train_setting::k_jointraintime]) +
            intval($slaveTrainConfig[configdata_chef_train_setting::k_jointraintime]);

        $trainJoinTime = $trainJoinTime / 2;

        //主人双休进程
        $escapeTime = time() - $this->get_startTime();
        $escapePercent = $escapeTime / floatval($masterTrainConfig[configdata_chef_train_setting::k_traintime]);
        $leftPercent = 1 - $escapePercent;

        $trainTime = floor($trainJoinTime * $leftPercent);

        $this->set_finishTime(time() + $trainTime);
        $this->set_status(constants_trainRoom::STATUS_DOUBLE_TRAIN);


        $this->clearAdvertisement();

        return true;
    }

    /**
     * 清楚广告
     */
    public function clearAdvertisement()
    {
        $this->reset_publishAdvertisement()
            ->reset_AdvertisementId()
            ->reset_AdvertisementExpiredTime();
    }

    /**
     * 拒绝所有加入请求
     */
    public function refuseAllJoinRequest()
    {
        $requests = $this->get_joinRequests();
        if (empty($requests)) {
        }
        foreach ($requests as $requestId => $request) {
            $this->refuseJoinRequest($requestId);
        }

    }


    /**
     * 拒绝加入请求
     * @param $requestId
     * @param bool|false $refuseByAcceptOther 拒绝请求,是因为接收了别人的请求
     * @return bool
     */
    public function refuseJoinRequest($requestId, $refuseByAcceptOther = false)
    {
        $refuseRequestData = $this->getJoinRequest($requestId);
        if (is_null($refuseRequestData)) {
            return false;
        }

        //拒绝请求
        $destUser = dbs_player::newGuestPlayerWithLock($refuseRequestData->get_userid());
        $destChef = dbs_chef_list::createWithPlayer($destUser)->get_chef($refuseRequestData->get_chefid());
        $destChefTrainData = $destChef->getTrainData();
        $destChefTrainData->refuseJoinTrain();
        $destChef->setTrainData($destChefTrainData);
        $destChef->set_status(constants_chefstatus::STATUS_FREE);
        dbs_chef_list::createWithPlayer($destUser)->set_chef($destChef);

        //退换聘礼
        $gameCoin = $refuseRequestData->get_giftGamecoin();
        $diamond = $refuseRequestData->get_giftDiamond();
        //房主信息
        $masterUserId = $this->get_masterTrainData()[dbs_chef_train_RoomData::DBKey_userid];

        //是否包含附件
        $hasAttachment = false;
        if ($gameCoin !== 0 || $diamond !== 0) {
            $hasAttachment = true;
        }
//        $languageId = null;
//        $languageVariables = [];
        //发送邮件
        if ($refuseByAcceptOther) {
            //因为同意其它人而被拒绝
            if ($hasAttachment) {
                $standardId = constants_mailTemplates::CHEF_TRAIN_ACCEPT_ONE_REJECT_REQUEST_WITH_PRESENTS;
            } else {
                $standardId = constants_mailTemplates::CHEF_TRAIN_ACCEPT_ONE_REJECT_REQUEST;
            }
            $standardVariables = [
                'masterUserInfo' => $this->get_masterTrainData(),
                'slaveUserInfo' => $this->get_slaveTrainData()
            ];
        } else {
            if ($hasAttachment) {
                $standardId = constants_mailTemplates::CHEF_TRAIN_REJECT_REQUEST_WITH_PRESENTS;
            } else {
                $standardId = constants_mailTemplates::CHEF_TRAIN_REJECT_REQUEST;
            }
            $standardVariables = [
                'masterUserInfo' => $this->get_masterTrainData(),
            ];
        }

        $mailData = dbs_mailbox_data::createWithStandardId($standardId,
            $standardVariables,
            $masterUserId);
        $mailData->addAttachmentGamecoinAndDiamond($gameCoin, $diamond);
        $mailData->send($refuseRequestData->get_userid());
//        dump($mailData);

        $requests = $this->get_joinRequests();

        if (isset($requests[$requestId])) {
            unset($requests[$requestId]);
            $this->set_joinRequests($requests);
        }
        return true;
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
    function clearCooldown()
    {
        if ($this->is_Cooldown()) {
            $this->set_finishTime(0);

            //单休,只通知主人即可
            if ($this->isSingleTrain()) {

                $masterTrainRoomData = dbs_chef_train_RoomData::create_with_array($this->get_masterTrainData());
                $masterPlayer = dbs_player::newGuestPlayerWithLock($masterTrainRoomData->get_userid());
                $masterChef = dbs_chef_list::createWithPlayer($masterPlayer)->get_chef($masterTrainRoomData->get_chefid());
                $masterTrainData = $masterChef->getTrainData();
                $masterTrainData->clearCooldown();
                $masterChef->setTrainData($masterTrainData);
                dbs_chef_list::createWithPlayer($masterPlayer)->set_chef($masterChef);
            } elseif ($this->isDoubleTrain()) {
                //加速主人
                $masterTrainRoomData = dbs_chef_train_RoomData::create_with_array($this->get_masterTrainData());
                $masterPlayer = dbs_player::newGuestPlayerWithLock($masterTrainRoomData->get_userid());
                $masterChef = dbs_chef_list::createWithPlayer($masterPlayer)->get_chef($masterTrainRoomData->get_chefid());
                $masterTrainData = $masterChef->getTrainData();
                $masterTrainData->clearCooldown();
                $masterChef->setTrainData($masterTrainData);
                dbs_chef_list::createWithPlayer($masterPlayer)->set_chef($masterChef);

                //加速加入者
                $slaveTrainRoomData = dbs_chef_train_RoomData::create_with_array($this->get_slaveTrainData());
                $slavePlayer = dbs_player::newGuestPlayerWithLock($slaveTrainRoomData->get_userid());
                $slaveChef = dbs_chef_list::createWithPlayer($slavePlayer)->get_chef($slaveTrainRoomData->get_chefid());
                $slaveTrainData = $slaveChef->getTrainData();
                $slaveTrainData->clearCooldown();
                $slaveChef->setTrainData($slaveTrainData);
                dbs_chef_list::createWithPlayer($slavePlayer)->set_chef($slaveChef);

            }
            //自动拒绝所有请求
            $this->refuseAllJoinRequest();
        }
    }

    /**
     * @inheritDoc
     */
    function get_clearCooldownDiamond()
    {
        return 1;
    }

    /**
     * @inheritDoc
     */
    function is_Cooldown()
    {
        if ($this->isSingleTrain() || $this->isDoubleTrain()) {
//            dump([time(), $this->get_finishTime()]);
            if (time() < $this->get_finishTime()) {
                return true;
            }
        }
        return false;
    }


}