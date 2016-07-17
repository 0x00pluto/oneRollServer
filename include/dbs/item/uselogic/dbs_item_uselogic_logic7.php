<?php

namespace dbs\item\uselogic;

use configdata\configdata_item_setting;
use constants\constants_itemuselogic;
use constants\constants_mission;
use constants\constants_roleReputationChangeReason;
use dbs\dbs_friend;
use dbs\dbs_mission;
use dbs\dbs_player;
use dbs\dbs_role;
use dbs\itemgraft\dbs_itemgraft_player;
use dbs\payout\dbs_payout_player;
use hellaEngine\exception\exception_logicError;

/**
 * 使用增加嫁接几率道具
 *
 * @author zhipeng
 *
 *
 */
class dbs_item_uselogic_logic7 extends dbs_item_uselogic_base
{
    public function get_logicid()
    {
        return constants_itemuselogic::TYPE_ADD_GRAFT_RESULT_WEIGHT;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \dbs\item\uselogic\dbs_item_uselogic_base::useitem()
     */
    function useitem($player, array $useparams, array $Options)
    {
        if (count($useparams) != 1) {
            return false;
        }
        if (count($Options) != 3) {
            return false;
        }

        $addWeight = $useparams [0];
        $destUserId = $Options [0];
        $slotId = $Options [1];
        $resultIndex = $Options [2];


        $itemGraft = dbs_itemgraft_player::createWithPlayer($player);
        if (!$itemGraft instanceof dbs_itemgraft_player) {
            return false;
        }

        try {
            $returnResult = $itemGraft->addResultWeight($destUserId,
                $slotId,
                $resultIndex,
                1);

        } catch (exception_logicError $e) {
            return false;
        }

        if ($returnResult->is_failed()) {
            return false;
        }

        dbs_mission::createWithPlayer($player)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_31, 1);

        //增加声望
        $itemConfig = $this->getItemConfig($this->getUseItemId());

        $reputation = intval($itemConfig[configdata_item_setting::k_reputation]);
        /**
         * @var $role dbs_role
         */
        $role = dbs_role::createWithPlayer($player);
        $role->addReputation($reputation, constants_roleReputationChangeReason::USE_GRAFT_ADD_WEIGHT_ITEM);


        //嫁接槽位在实际的用户身上
        if ($destUserId === $player->get_userid()) {
            //自己给自己的嫁接添加药水
            $destItemGraft = $itemGraft;
        } else {
            $destItemGraft = dbs_itemgraft_player::createWithPlayer(dbs_player::newGuestPlayerWithLock($destUserId));
        }

        //增加钻石价值
        $payoutValue = intval($itemConfig[configdata_item_setting::k_payoutvalue]);
        //实际嫁接数据
        $graftData = $destItemGraft->getSlotData($slotId);
        //嫁接发起者
        $graftUserId = $destUserId;
        //嫁接应答者
        $graftedUserId = $graftData->get_helpPlayerInfo()[dbs_itemgraft_player::DBKey_userid];
        //第三方加速.付出减半
        if (
            $graftedUserId !== $player->get_userid() &&
            $graftUserId !== $player->get_userid()
        ) {
            $payoutValue = floor($payoutValue / 2);
        }

        //增加付出
        $payout = dbs_payout_player::createWithPlayer($player);
        if ($payout instanceof dbs_payout_player) {
            try {
                $payout->addDiamondValue($graftUserId, $payoutValue);
            } catch (exception_logicError $e) {

            }
            try {
                $payout->addDiamondValue($graftedUserId, $payoutValue);
            } catch (exception_logicError $e) {

            }
        }

        //增加好感度
        $goodWill = getGlobalValue("GRAFT_ADD_WEIGHT_ITEM_GOODWILL")->int_value();
        //第三方加速.每人分别增加好感度
        if (
            $graftedUserId !== $player->get_userid() &&
            $graftUserId !== $player->get_userid()
        ) {
            dbs_friend::createWithPlayer($player)->addFriendGoodWill($graftedUserId, $goodWill);
            dbs_friend::createWithPlayer($player)->addFriendGoodWill($graftUserId, $goodWill);

        } else {
            $addGoodWillUserId = $graftedUserId === $player->get_userid() ? $graftUserId : $graftedUserId;
            dbs_friend::createWithPlayer($player)->addFriendGoodWill($addGoodWillUserId, $goodWill);
        }

        return true;
    }
}