<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/15
 * Time: 下午3:25
 */

namespace dbs\itemgraft;


use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use configdata\configdata_item_graft_formula_config;
use configdata\configdata_restaurant_level_setting;
use constants\constants_bulletin;
use constants\constants_globalkey;
use constants\constants_mailTemplates;
use constants\constants_messagecmd;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\bulletinboard\dbs_bulletinboard_bulletinboarddata;
use dbs\dbs_friend;
use dbs\dbs_mission;
use dbs\dbs_player;
use dbs\dbs_restaurantinfo;
use dbs\dbs_role;
use dbs\dbs_sync;
use dbs\dbs_userkvstore;
use dbs\dbs_warehouse;
use dbs\filters\dbs_filters_role;
use dbs\friend\dbs_friend_recommenddata;
use dbs\i\dbs_i_iday;
use dbs\mailbox\dbs_mailbox_data;
use dbs\mailbox\dbs_mailbox_list;
use dbs\neighbourhood\dbs_neighbourhood_playerdata;
use dbs\robot\dbs_robot_manager;
use dbs\robot\dbs_robot_player;
use dbs\templates\itemgraft\dbs_templates_itemgraft_player;
use err\err_dbs_itemgraft_player_acceptGraft;
use err\err_dbs_itemgraft_player_addResultWeight;
use err\err_dbs_itemgraft_player_answerGraft;
use err\err_dbs_itemgraft_player_harvestGraft;
use err\err_dbs_itemgraft_player_prepareGraft;
use err\err_dbs_itemgraft_player_publishAdvertisement;
use err\err_dbs_itemgraft_player_refuseGraft;
use err\err_dbs_itemgraft_player_refuseGraftAll;

/**
 * 道具嫁接服务
 * Class dbs_itemgraft_player
 * @package dbs\itemgraft
 */
class dbs_itemgraft_player extends dbs_templates_itemgraft_player implements dbs_i_iday
{


    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);

        $this->setEnableCache(true);
    }

    function masterbeforecall()
    {
        $restaurantConfig = $this->db_owner->db_restaurantinfo()->get_restaurant_config();
        $slotCount = intval($restaurantConfig[configdata_restaurant_level_setting::k_graftslotcount]);
        if ($slotCount != $this->get_slotcount()) {
            $this->set_slotcount($slotCount);
            $this->initSlots();
        }

        $userKv = dbs_userkvstore::createWithPlayer($this->db_owner);
        if ($userKv instanceof dbs_userkvstore) {
            $dayFlag = Common_Util_Time::getGameDay();
            if ($dayFlag !== $userKv->getvalue(constants_globalkey::PLAYER_ITEM_GRAFT_DAY_FLAG)) {
                $userKv->setvalue(constants_globalkey::PLAYER_ITEM_GRAFT_DAY_FLAG, $dayFlag);
                $this->nextday();
            }
        };

        $this->processExpiredItemGraft();

        $this->processRobotHelpItemGraft();

        $this->computeAdvertisement();


    }

    /**
     * 处理机器人帮忙嫁接
     */
    private function processRobotHelpItemGraft()
    {
        $waitAnswerSlots = [];
        $slots = $this->get_slots();
        foreach ($slots as $id => $slot) {
            $slotData = dbs_itemgraft_slotinfo::create_with_array($slot);
            if ($slotData->isWaitAnswer() &&
                empty($slotData->get_answerPlayerInfos())) {

                $waitAnswerSlots[] = $id;
            }
        }
        //机器人帮忙
        if(!empty($waitAnswerSlots) &&
            dbs_robot_player::createWithPlayer($this)->isCanHelpedItemgraft())
        {
            $helpRobotId = dbs_robot_manager::getInstance()->getRandomRobotId();
            $robotPlayer = dbs_player::newGuestPlayerWithLock($helpRobotId);
            //需要帮忙的槽位ID
            $helpSlotId = Common_Util_Random::RandomWithSameWeight($waitAnswerSlots);

//            dump([
//                $helpRobotId,
//                $helpSlotId,
//            ]);
            dbs_itemgraft_player::createWithPlayer($robotPlayer)->answerGraftByRobot($this->get_userid(),$helpSlotId);

            //标记被帮忙
            dbs_robot_player::createWithPlayer($this)->markHelpedItemgraft();
        }
    }
    /**
     * 处理过期的嫁接
     */
    private function processExpiredItemGraft()
    {
        $dataChange = false;
        $slots = $this->get_slots();
        foreach ($slots as $id => $slot) {
            $slotData = dbs_itemgraft_slotinfo::create_with_array($slot);
            if ($slotData->isExpired()) {

                dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_TIMEOUT,
                    [], $this->get_userid())
                    ->addAttachmentItem($slotData->get_itemid1(), $slotData->get_itemcount1())
                    ->send($this->get_userid());

                //如果发出广告
                //删除广告
                if ($slotData->get_publishAdvertisement()) {
                    $this->db_owner->dbs_neighbourhood_playerdata()->deleteBulletin($slotData->get_AdvertisementId());
                    $slotData->set_publishAdvertisement(false);
                }

                $slotData->resetAll();
                $slots[$id] = $slotData->toArray();

                $dataChange = true;
            }
        }
        if ($dataChange) {
            $this->set_slots($slots);
        }
    }

    function nextday()
    {
        $this->reset_todayHelpCount();
    }

    /**
     * 计算广告
     */
    private function computeAdvertisement()
    {
        //检测是否已经发送了广告
        $slots = $this->get_slots();
        $dataChange = false;

        $isPublishing = false;

        foreach ($slots as $slotId => $slot) {
            $slotData = dbs_itemgraft_slotinfo::create_with_array($slot);
            if ($slotData->get_publishAdvertisement()) {
                if (time() > $slotData->get_AdvertisementExpiredTime()) {
                    //过期广告
                    $slotData->advertisementTimeOut();
                    $slots[$slotId] = $slotData->toArray();
                    $dataChange = true;
                } else {
                    //存在有效的广告
                    $isPublishing = true;
                }
            }
        }
        if ($dataChange) {
            $this->set_slots($slots);
        }
        //标记发送广告
        dbs_friend_recommenddata::createWithPlayer($this->db_owner)->set_isPublishingItemGraftAdvertisement($isPublishing);
    }

    /**
     * 通过配方ID返回配置
     * @param $formulaId
     * @return null
     */
    static function getGraftConfigByFormulaId($formulaId)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_graft_formula_config::class,
            configdata_item_graft_formula_config::k_formulaid, $formulaId);
    }

    /**
     * 初始化槽位
     */
    private
    function initSlots()
    {
        $slots = $this->get_slots();

        for ($i = 0; $i < $this->get_slotcount(); $i++) {
            $slotKey = "slot_$i";
            if (!isset($slots[$slotKey])) {
                $slotData = dbs_itemgraft_slotinfo::create_with_array([]);
                $slotData->set_slotid($slotKey);
                $slots[$slotKey] = $slotData->toArray();
            }
        }
        $this->set_slots($slots);
    }

    /**
     * 获取槽位数据
     * @param $slotId
     * @return null|dbs_itemgraft_slotinfo
     */
    public function getSlotData($slotId)
    {
        $slots = $this->get_slots();
//        dump($slots);
        if (isset($slots[$slotId])) {
            return dbs_itemgraft_slotinfo::create_with_array($slots[$slotId]);
        }
        return null;
    }

    /**
     * 保存槽位信息
     * @param dbs_itemgraft_slotinfo $slotData
     */
    public function setSlotData(dbs_itemgraft_slotinfo $slotData)
    {
        $slots = $this->get_slots();
        $slots[$slotData->get_slotid()] = $slotData->toArray();

        $this->set_slots($slots);
    }

    /**
     * 保存帮助槽位
     * @param $destPlayerId
     * @param dbs_itemgraft_slotinfo $slotData
     */
    private function setHelpSlotData($destPlayerId, dbs_itemgraft_slotinfo $slotData)
    {
        $helpSlots = $this->get_helpSlots();

        $slots = [];
        if (isset($helpSlots[$destPlayerId])) {
            $slots = $helpSlots[$destPlayerId];
        }
        $slots[$slotData->get_slotid()] = $slotData->toArray();
        $helpSlots[$destPlayerId] = $slots;
        $this->set_helpSlots($helpSlots);

    }

    /**
     * 删除帮忙数据
     * @param $destPlayerId
     * @param $slotId
     */
    private
    function deleteHelpSlotData($destPlayerId, $slotId)
    {
        $helpSlots = $this->get_helpSlots();

        if (!isset($helpSlots[$destPlayerId])) {
            return;
        }
        $slots = $helpSlots[$destPlayerId];
        unset($slots[$slotId]);

        if (empty($slots)) {
            unset($helpSlots[$destPlayerId]);
        } else {
            $helpSlots[$destPlayerId] = $slots;
        }
        $this->set_helpSlots($helpSlots);
    }

    /**
     * 准备嫁接
     * @param $slotId
     * @param $itemId
     * @param $itemCount
     * @return Common_Util_ReturnVar
     */
    public
    function prepareGraft($slotId, $itemId, $itemCount)
    {
        $data = [];
        typeCheckString($slotId, 10);
        typeCheckString($itemId, 10);
        typeCheckNumber($itemCount, 1);

        $slotData = $this->getSlotData($slotId);

//        dump($slotData);
        logicErrorCondition(!is_null($slotData),
            err_dbs_itemgraft_player_prepareGraft::SLOT_ID_ERROR,
            "SLOT_ID_ERROR");

        logicErrorCondition($slotData->isFree(),
            err_dbs_itemgraft_player_prepareGraft::SLOT_STATUS_ERROR,
            "SLOT_STATUS_ERROR");

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemId);
        logicErrorCondition(!is_null($warehouse),
            err_dbs_itemgraft_player_prepareGraft::ITEM_ID_ERROR,
            "ITEM_ID_ERROR");

        logicErrorCondition($warehouse->hasItem($itemId, $itemCount),
            err_dbs_itemgraft_player_prepareGraft::ITEM_NOT_ENOUGH,
            "ITEM_NOT_ENOUGH");

        $config = null;

        foreach (configdata_item_graft_formula_config::data() as $key => $value) {
            if ($value[configdata_item_graft_formula_config::k_fromitemid1] === $itemId &&
                intval($value[configdata_item_graft_formula_config::k_fromitemcount]) === $itemCount
            ) {
                $config = $value;
                break;
            }
        }
        logicErrorCondition(!is_null($config),
            err_dbs_itemgraft_player_prepareGraft::NOT_FORMULA_EXIST,
            "NOT_FORMULA_EXIST");

        //删除物品
        $warehouse->removeItemByItemId($itemId, $itemCount);

        //完善嫁接信息
        $slotData->prepareGraft($itemId, $itemCount);

        $this->setSlotData($slotData);

        $data = $slotData->toArray();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 机器人应答嫁接请求
     * @param $destUserId
     * @param $slotId
     * @return bool
     */
    private function answerGraftByRobot($destUserId, $slotId)
    {
        $destPlayer = dbs_player::newGuestPlayerWithLock($destUserId);
        $destItemGraft = self::createWithPlayer($destPlayer);
        $graftData = $destItemGraft->getSlotData($slotId);

        //重复应答
        $answers = $graftData->get_answerPlayerInfos();
        if(isset($answers[$this->get_userid()]))
        {
            return false;
        }

        //判断配方

//        $config = null;
        $itemId1 = $graftData->get_itemid1();
        //所有可能的配方
        $formulaConfigs = [];
        $foundFormulaConfig = null;
        foreach (configdata_item_graft_formula_config::data() as $key => $value) {
            if ($value[configdata_item_graft_formula_config::k_fromitemid1] === $itemId1){
                $formulaConfigs[$value[configdata_item_graft_formula_config::k_formulaid]] = $value;
                break;
            }
        }
        //寻找价值最小的配方进行合成
        $formulaValue = 1000000;
        foreach ($formulaConfigs as $formulaConfig)
        {
            $currentFormulaValue = intval($formulaConfig[configdata_item_graft_formula_config::k_formulavalue]);
            if($currentFormulaValue < $formulaValue)
            {
                $formulaValue = $currentFormulaValue;
                $foundFormulaConfig = $formulaConfig;
            }
        }

        if(is_null($foundFormulaConfig))
        {
            return false;
        }

        $itemId = $foundFormulaConfig[configdata_item_graft_formula_config::k_fromitemid2];
        $itemCount = intval($foundFormulaConfig[configdata_item_graft_formula_config::k_fromitemcount]);

        //可以开始了....

        //填充嫁接数据
        $graftData->answerGraft($itemId, $itemCount,
            $this->db_owner->db_role()->toArray([], dbs_filters_role::$filters_lookup_blocked_info));
        $destItemGraft->setSlotData($graftData);

        $this->setHelpSlotData($destUserId, $graftData);


        //发送同步请求
        dbs_sync::createWithPlayer($destPlayer)->mark_sync(constants_messagecmd::S2C_SEND_ITEM_GRAFT_REQUEST);
        //发送通知邮件
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_REQUEST,
            [], $this->get_userid())->send($destUserId);
    }
    /**
     * 应答嫁接
     * @param $destUserId
     * @param $slotId
     * @param $itemId
     * @param $itemCount
     * @return Common_Util_ReturnVar
     */
    public function answerGraft($destUserId, $slotId, $itemId, $itemCount)
    {
        typeCheckUserId($destUserId);
        typeCheckString($slotId, 10);
        typeCheckString($itemId, 10);
        typeCheckNumber($itemCount, 1);

        logicErrorCondition($destUserId !== $this->get_userid(),
            err_dbs_itemgraft_player_answerGraft::CAN_NOT_SELF,
            "CAN_NOT_SELF");

//        dump(getGlobalValue("GRAFT_ANSWER_DAILY_MAX_TIMES")->int_value());
        logicErrorCondition($this->get_todayHelpCount() < getGlobalValue("GRAFT_ANSWER_DAILY_MAX_TIMES")->int_value(),
            err_dbs_itemgraft_player_answerGraft::ANSWER_TIMES_MAX,
            "ANSWER_TIMES_MAX");

        $destPlayer = dbs_player::newGuestPlayerWithLock($destUserId);
        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_itemgraft_player_answerGraft::DEST_PLAYER_NOT_EXIST,
            "DEST_PLAYER_NOT_EXIST");


        //目标嫁接数据
        $destItemGraft = self::createWithPlayer($destPlayer);
        $graftData = $destItemGraft->getSlotData($slotId);
        logicErrorCondition(!is_null($graftData),
            err_dbs_itemgraft_player_answerGraft::SLOT_ID_ERROR,
            "SLOT_ID_ERROR");


        logicErrorCondition($graftData->isWaitAnswer(),
            err_dbs_itemgraft_player_answerGraft::DEST_PLAYER_NOT_GRAFT,
            "DEST_PLAYER_NOT_GRAFT");

        //重复应答
        $answers = $graftData->get_answerPlayerInfos();
        logicErrorCondition(!isset($answers[$this->get_userid()]),
            err_dbs_itemgraft_player_answerGraft::ANSWER_DUPLICATE,
            "ANSWER_DUPLICATE");

        //判断自己物品
        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemId);
        logicErrorCondition(!is_null($warehouse),
            err_dbs_itemgraft_player_answerGraft::ITEM_ID_ERROR,
            "ITEM_ID_ERROR");

        logicErrorCondition($warehouse->hasItem($itemId, $itemCount),
            err_dbs_itemgraft_player_answerGraft::ITEM_NOT_ENOUGH,
            "ITEM_NOT_ENOUGH");

        //判断配方

        $config = null;
        $itemId1 = $graftData->get_itemid1();
        foreach (configdata_item_graft_formula_config::data() as $key => $value) {
            if ($value[configdata_item_graft_formula_config::k_fromitemid1] === $itemId1 &&
                intval($value[configdata_item_graft_formula_config::k_fromitemcount]) === $itemCount &&
                $value[configdata_item_graft_formula_config::k_fromitemid2] === $itemId
            ) {
                $config = $value;
                break;
            }
        }
        logicErrorCondition(!is_null($config),
            err_dbs_itemgraft_player_answerGraft::NOT_FORMULA_EXIST,
            "NOT_FORMULA_EXIST");

        //可以开始了....

        //扣除道具
        $warehouse->removeItemByItemId($itemId, $itemCount);

        //填充嫁接数据
        $graftData->answerGraft($itemId, $itemCount,
            $this->db_owner->db_role()->toArray([], dbs_filters_role::$filters_lookup_blocked_info));
        $destItemGraft->setSlotData($graftData);

        $this->setHelpSlotData($destUserId, $graftData);

        //记录次数
        $this->set_todayHelpCount($this->get_todayHelpCount() + 1);

        //发送同步请求
        dbs_sync::createWithPlayer($destPlayer)->mark_sync(constants_messagecmd::S2C_SEND_ITEM_GRAFT_REQUEST);

        $data = $graftData->toArray();

        //发送通知邮件
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_REQUEST,
            [], $this->get_userid())->send($destUserId);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 接收嫁接
     * @param $slotId
     * @param string $destUserId 目标用户id
     * @return Common_Util_ReturnVar
     */
    public function acceptGraft($slotId, $destUserId)
    {
        $data = [];

        typeCheckString($slotId);
        typeCheckUserId($destUserId);
        $slotData = $this->getSlotData($slotId);

        logicErrorCondition(!is_null($slotData),
            err_dbs_itemgraft_player_acceptGraft::SLOT_ID_ERROR,
            "SLOT_ID_ERROR");

        logicErrorCondition($slotData->isWaitAnswer(),
            err_dbs_itemgraft_player_acceptGraft::SLOT_STATUS_ERROR,
            "SLOT_STATUS_ERROR");

        $answers = $slotData->get_answerPlayerInfos();
        logicErrorCondition(isset($answers[$destUserId]),
            err_dbs_itemgraft_player_acceptGraft::DEST_USER_NOT_EXIST,
            "DEST_USER_NOT_EXIST");

        //如果发出广告
        //删除广告
        if ($slotData->get_publishAdvertisement()) {
            $this->db_owner->dbs_neighbourhood_playerdata()->deleteBulletin($slotData->get_AdvertisementId());
            $slotData->set_publishAdvertisement(false);
        }

        $slotData->acceptGraft($destUserId);
        $this->setSlotData($slotData);

        //返还其它人物品
        //删除同意的用户
        unset($answers[$destUserId]);
        $this->refuseGraftAndReturnBackItems($slotId, $answers);


        //帮忙好友的Userd
        $destPlayer = dbs_player::newGuestPlayerWithLock($destUserId);

        $destItemGraft = dbs_itemgraft_player::createWithPlayer($destPlayer);
        $destItemGraft->setHelpSlotData($this->get_userid(), $slotData);

        $config = self::getGraftConfigByFormulaId($slotData->get_formulaid());

        //增加好感度
        $goodwillExp = intval($config[configdata_item_graft_formula_config::k_addfriendgoodwillexp]);
        $this->db_owner->db_friend()->addFriendGoodWill($destUserId, $goodwillExp);


        $data = $slotData->toArray();

        //发送邮件
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_ACCEPT_REQUEST,
            [], $this->get_userid())->send($destUserId);


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 归还物品
     * @param $slotId
     * @param array $answers
     */
    private
    function refuseGraftAndReturnBackItems($slotId, array $answers)
    {
        foreach ($answers as $userId => $answer) {
            $answerData = dbs_itemgraft_graftAnswerData::create_with_array($answer);

            //帮忙好友的Userd
            $destPlayer = dbs_player::newGuestPlayerWithLock($userId);
            $destItemGraft = dbs_itemgraft_player::createWithPlayer($destPlayer);
            //清除帮忙数据
            $destItemGraft->deleteHelpSlotData($this->get_userid(), $slotId);

            dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_REFUSE_REQUEST, [],
                $this->get_userid())
                ->addAttachmentItem($answerData->get_itemid(),
                    $answerData->get_itemcount())
                ->send($userId);
        }
    }

    /**
     * 拒绝嫁接
     * @param $slotId
     * @param string $destUserId 目标用户id
     * @return Common_Util_ReturnVar
     */
    public function refuseGraft($slotId, $destUserId)
    {
        $data = [];
        //class err_dbs_itemgraft_player_refuseGraft
        typeCheckString($slotId);
        typeCheckUserId($destUserId);
        $slotData = $this->getSlotData($slotId);

        logicErrorCondition(!is_null($slotData),
            err_dbs_itemgraft_player_refuseGraft::SLOT_ID_ERROR,
            "SLOT_ID_ERROR");

        logicErrorCondition($slotData->isWaitAnswer(),
            err_dbs_itemgraft_player_refuseGraft::SLOT_STATUS_ERROR,
            "SLOT_STATUS_ERROR");

        $answers = $slotData->get_answerPlayerInfos();
        logicErrorCondition(isset($answers[$destUserId]),
            err_dbs_itemgraft_player_refuseGraft::ANSWER_NOT_EXIST,
            "DEST_USER_NOT_EXIST");

        $deleteAnswers = [$destUserId => $answers[$destUserId]];
        $this->refuseGraftAndReturnBackItems($slotId, $deleteAnswers);

        //保存清除数据
        $slotData->refuseGraft($destUserId);
        $this->setSlotData($slotData);

        $data = $slotData->toArray();


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 拒绝所有请求
     * @param $slotId
     * @return Common_Util_ReturnVar
     */
    public function refuseGraftAll($slotId)
    {
        $data = [];
        //class err_dbs_itemgraft_player_refuseGraftAll
        typeCheckString($slotId);
        $slotData = $this->getSlotData($slotId);

        logicErrorCondition(!is_null($slotData),
            err_dbs_itemgraft_player_refuseGraftAll::SLOT_ID_ERROR,
            "SLOT_ID_ERROR");

        logicErrorCondition($slotData->isWaitAnswer(),
            err_dbs_itemgraft_player_refuseGraftAll::SLOT_STATUS_ERROR,
            "SLOT_STATUS_ERROR");

        $answers = $slotData->get_answerPlayerInfos();
        logicErrorCondition(!empty($answers),
            err_dbs_itemgraft_player_refuseGraftAll::ANSWERS_EMPTY,
            "DEST_USER_NOT_EXIST");

        $this->refuseGraftAndReturnBackItems($slotId, $answers);

        //保存清除数据
        $slotData->refuseGraftAll();
        $this->setSlotData($slotData);

        $data = $slotData->toArray();

        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 增加结果加成
     * @param $destUserId
     * @param $slotId
     * @param $index [0,1,2,3]
     * @param int $num
     * @return Common_Util_ReturnVar
     */
    public function addResultWeight($destUserId, $slotId, $index, $num = 1)
    {
        $data = [];
        //class err_dbs_itemgraft_player_addResultWeight


        typeCheckUserId($destUserId);
        typeCheckString($slotId, 10);
        typeCheckNumber($index, 0, 3);
        typeCheckNumber($num, 1);

        $destPlayer = null;
        if ($destUserId === $this->get_userid()) {
            $destPlayer = $this->db_owner;
        } else {
            $destPlayer = dbs_player::newGuestPlayerWithLock($destUserId);
        }

        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_itemgraft_player_addResultWeight::DEST_PLAYER_NOT_EXIST,
            'DEST_PLAYER_NOT_EXIST');


        $destItemGraft = self::createWithPlayer($destPlayer);

        $slotData = $destItemGraft->getSlotData($slotId);
        logicErrorCondition(!is_null($slotData),
            err_dbs_itemgraft_player_addResultWeight::SLOT_ID_ERROR,
            'SLOT_ID_ERROR');

        logicErrorCondition($slotData->isGrafting(),
            err_dbs_itemgraft_player_addResultWeight::SLOT_STATUS_ERROR,
            'SLOT_STATUS_ERROR');

        $config = self::getGraftConfigByFormulaId($slotData->get_formulaid());
        $configIndex = $index + 1;
        $keyToItemId = "toitemid" . $configIndex;
        $keyToItemCount = "toitemcount" . $configIndex;
        $toitemweight = "toitemweight" . $configIndex;
        $keyToItemAddWeight = "toitemaddweight" . $configIndex;

        logicErrorCondition(isset($config[$keyToItemId]),
            err_dbs_itemgraft_player_addResultWeight::ADD_RESULT_WEIGHT_INDEX_ERROR,
            "ADD_RESULT_WEIGHT_INDEX_ERROR");


        $itemAddWeight = floatval($config[$keyToItemAddWeight]);
        //当前权重
        $currentWeight = $slotData->getResultWeight($index);
        //剩余可以添加的次数
        $totalAddWeightTimes = ceil((10000 - $currentWeight) /
            floatval($itemAddWeight));

        //检测是否还可以继续提升概率
//        logicErrorCondition($num <= $totalAddWeightTimes,
//            err_dbs_itemgraft_player_addResultWeight::ADD_RESULT_TIMES_MAX,
//            "ADD_RESULT_TIMES_MAX");

        //增加结果产出权重
        $slotData->addResultWeight($this->get_userid(), $index, $num);
        $destItemGraft->setSlotData($slotData);

        $data = $slotData->toArray();

        //自己不是嫁接主人,则通知嫁接主人
        if ($destUserId !== $this->get_userid()) {
            $mailUserId = $destUserId;
        } else {
            //通知被嫁接人
            $mailUserId = $slotData->get_helpPlayerInfo()[self::DBKey_userid];
        }

        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_WEIGHT_ADD_ITEM,
            ['itemNum' => $num],
            $this->get_userid())
            ->send($mailUserId);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 收获嫁接
     * @param $destUserId
     * @param $slotId
     * @return Common_Util_ReturnVar
     */
    public function harvestGraft($destUserId, $slotId)
    {
        $data = [];
        //class err_dbs_itemgraft_player_harvestGraft
        typeCheckUserId($destUserId);
        typeCheckString($slotId, 10);

        $destPlayer = null;
        if ($destUserId === $this->get_userid()) {
            $destPlayer = $this->db_owner;
        } else {
            $destPlayer = dbs_player::newGuestPlayerWithLock($destUserId);
        }

        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_itemgraft_player_harvestGraft::DEST_PLAYER_NOT_EXIST,
            "DEST_PLAYER_NOT_EXIST");

        $destItemGraft = self::createWithPlayer($destPlayer);

        $slotData = $destItemGraft->getSlotData($slotId);
        logicErrorCondition(!is_null($slotData),
            err_dbs_itemgraft_player_harvestGraft::SLOT_ID_ERROR,
            'SLOT_ID_ERROR');

        logicErrorCondition($slotData->isFinishGraft(),
            err_dbs_itemgraft_player_addResultWeight::SLOT_STATUS_ERROR,
            'SLOT_STATUS_ERROR');


        //发东西..
        $config = self::getGraftConfigByFormulaId($slotData->get_formulaid());

        //构建奖励物品
        $awards = [];
        //摇奖ID
        $rollAwards = [];
        for ($index = 1; $index <= 4; $index++) {
            $key = "toitemid" . $index;
            if (!isset($config[$key])) {
                //嫁接出的道具是否有效
                continue;
            }

            $award = [];
            $award["itemId"] = $config["toitemid" . $index];
            $award["itemCount"] = intval($config["toitemcount" . $index]);

            //增加权重信息
            $weight = $slotData->getResultWeight($index - 1);
            $award["weight"] = $weight;

            $awards[$key] = $award;
            $rollAwards[$key] = $award["weight"];

        }


        $awardId = Common_Util_Random::RandomWithWeight($rollAwards);

        //奖励道具
        $award = $awards[$awardId];
        $awardItemId = $award["itemId"];
        $awardItemCount = $award["itemCount"];

        //判断仓库
        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $awardItemId);
        logicErrorCondition($warehouse->testItemCanPut($awardItemId, $awardItemCount),
            err_dbs_itemgraft_player_harvestGraft::WAREHOUSE_FULL,
            "WAREHOUSE_FULL");

        //放入仓库
        $warehouse->addItemByItemId($awardItemId, $awardItemCount);

        //获取对方
        $otherUserId = $slotData->get_helpPlayerInfo()[self::DBKey_userid];
        $otherPlayer = dbs_player::newGuestPlayerWithLock($otherUserId);
        if ($otherPlayer->isRoleExists()) {
            //发送邮件

            $mailData = dbs_mailbox_data::createWithStandardId(constants_mailTemplates::ITEM_GRAFT_COMPLETE, [],
                $this->get_userid());
            $mailData->addAttachmentItem($awardItemId, $awardItemCount);
            dbs_mailbox_list::sendMailToUser($otherUserId, $mailData);
        }
        //如果有已经发送的广告,需要删除广告.已经在同意的时候删除掉广告了


        $slotData->completeGraft();
        $destItemGraft->setSlotData($slotData);

        //完成任务
        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_30,
            1);

        $data[constants_returnkey::RK_AWARD] = $award;
        $data[constants_returnkey::RK_GRAFT_SLOT_DATA] = $slotData->toArray();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 发布广告
     * @param string $slotId 槽位ID
     * @param int $useDiamond [0,1] 是否使用钻石
     * @return Common_Util_ReturnVar
     */
    public function publishAdvertisement($slotId, $useDiamond)
    {
        $data = [];
        //class err_dbs_itemgraft_player_publishAdvertisement

        typeCheckString($slotId, 10);
        typeCheckNumber($useDiamond, 0, 1);

        $slotData = $this->getSlotData($slotId);

        logicErrorCondition(!is_null($slotData),
            err_dbs_itemgraft_player_publishAdvertisement::SLOT_ID_ERROR,
            'SLOT_ID_ERROR');

        logicErrorCondition($slotData->isWaitAnswer(),
            err_dbs_itemgraft_player_publishAdvertisement::SLOT_STATUS_ERROR,
            'SLOT_STATUS_ERROR');

        logicErrorCondition(!$slotData->get_publishAdvertisement(),
            err_dbs_itemgraft_player_publishAdvertisement::PUBLISHED,
            'PUBLISHED');


        $role = dbs_role::createWithPlayer($this->db_owner);
        $needDiamond = getGlobalValue("GRAFT_ADVERTISEMENT_NEED_DIAMOND")->int_value();
        if ($useDiamond === 1) {

            if ($role instanceof dbs_role) {
                logicErrorCondition($role->get_diamond() >= $needDiamond,
                    err_dbs_itemgraft_player_publishAdvertisement::DIAMOND_NOT_ENOUGH,
                    'DIAMOND_NOT_ENOUGH');
            }
        } else {
            logicErrorCondition(time() >= $this->get_publishAdvertisementCoolDown(),
                err_dbs_itemgraft_player_publishAdvertisement::COOL_DOWN,
                "COOL_DOWN");
        }

        $bulletinTimeout = getGlobalValue("GRAFT_ADVERTISEMENT_BUTTLETIN_TIMEOUT")->int_value();

        $advertisement = dbs_bulletinboard_bulletinboarddata::createWithPlayer(
            "请和我嫁接吧",
            "嫁接嫁接",
            $this->db_owner
        );
        $advertisement->set_type(constants_bulletin::TYPE_GRAFT_REQUEST);
        $advertisement->set_expiredTime(time() + $bulletinTimeout);
        $advertisement->set_attachactiontype(constants_bulletin::ATTACH_ACTION_TYPE_GRAFT_REQUEST);
        $advertisement->set_attachactionvalue($slotData->toArray());
        $this->db_owner->dbs_neighbourhood_playerdata()->publishBulletin($advertisement);


        //设置发布广告数据
        $slotData->set_publishAdvertisement(true);
        $slotData->set_AdvertisementId($advertisement->get_guid());
        $slotData->set_AdvertisementExpiredTime($advertisement->get_expiredTime());

        //保存数据
        $this->setSlotData($slotData);


        if ($useDiamond === 1) {
            //扣钱
            $role->cost_diamond($needDiamond, constants_moneychangereason::CLEAR_GRAFT_ADVERTISEMENT_COOL_DOWN);
        }
        //增加冷却
        $this->set_publishAdvertisementCoolDown(time() + getGlobalValue("GRAFT_ADVERTISEMENT_COOLDOWN")->int_value());


        $data[constants_returnkey::RK_GRAFT_SLOT_DATA] = $slotData->toArray();


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取推荐数据
     * @param array $userIdArray
     * @return array
     */
    private function getRecommendItemGraft(array $userIdArray)
    {
        $datas = [];
        foreach ($userIdArray as $userid => $value) {
            $data = [];
            $data[dbs_role::DBKey_tablename] = dbs_filters_role::getNormalInfo(dbs_role::getCacheObjectOrNew($userid));
            $data[self::DBKey_tablename] = dbs_itemgraft_player::getCacheObjectOrNew($userid)->toArray();
            $data[dbs_restaurantinfo::DBKey_tablename] = dbs_restaurantinfo::getCacheObjectOrNew($userid)->toArray();
            $datas[$userid] = $data;
        }
        return $datas;
    }


    /**
     * 获取推荐道具合成用户数据
     * @return Common_Util_ReturnVar
     */
    public function getRecommendItemGraftData()
    {
        $datas = [];
        //interface err_dbs_itemgraft_player_getRecommendItemGraftData


        $extensionRule = [
            dbs_friend_recommenddata::DBKey_isPublishingItemGraftAdvertisement => true
        ];

        $recommendList = dbs_friend::createWithPlayer($this)->normalRecommendRule($extensionRule, false);

        $datas = $this->getRecommendItemGraft($recommendList);
        //code...
        return Common_Util_ReturnVar::RetSucc($datas);
    }


    /**
     * 获取好友的嫁接数据
     * @return Common_Util_ReturnVar
     */
    public function getRecommendFriendsItemGraftData()
    {
        $friendList = dbs_friend::createWithPlayer($this)->get_friendlist();
        $datas = $this->getRecommendItemGraft($friendList);
        return Common_Util_ReturnVar::RetSucc($datas);

    }


    /**
     * 获取社区人的嫁接数据
     * @return Common_Util_ReturnVar
     */
    public function getRecommendNeighbourhoodItemGraftData()
    {
        $datas = [];
        $groupData = dbs_neighbourhood_playerdata::createWithPlayer($this)->get_groupdata();
        if (!is_null($groupData)) {

            $members = $groupData->get_member();
            $datas = $this->getRecommendItemGraft($members);
        }
        return Common_Util_ReturnVar::RetSucc($datas);
    }


}