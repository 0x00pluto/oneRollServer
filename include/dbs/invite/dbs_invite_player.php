<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/18
 * Time: 下午3:29
 */

namespace dbs\invite;


use Common\Db\Common_Db_mongo;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_advertisement_invite_award_setting;
use configdata\configdata_advertisement_invited_award_setting;
use configdata\configdata_advertisement_inviteed_award_setting;
use constants\constants_mailTemplates;
use constants\constants_mission;
use dbs\dbs_mission;
use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\mailbox\dbs_mailbox_data;
use dbs\templates\invite\dbs_templates_invite_player;
use err\err_dbs_invite_player_invited;

/**
 * 邀请码服务
 * Class dbs_invite_player
 * @package dbs\invite
 */
class dbs_invite_player extends dbs_templates_invite_player
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
        $this->ensureIndex([
            self::DBKey_inviteCode => 1
        ], true);
    }


    /**
     * 创建邀请码
     * @param Common_Db_mongo $db
     */
    private function createInviteCode(Common_Db_mongo $db)
    {
        if ($this->get_inviteCode() === 0) {
            $this->set_inviteCode($db->getAutoIncreaseId($this->get_tablename() . "_" . self::DBKey_inviteCode));
        }
    }

    /**
     * @inheritDoc
     */
    protected function loadFromDBAfter(Common_Db_mongo $db)
    {
        $this->createInviteCode($db);
    }


    /**
     * 通过邀请码,获取用户ID
     * @param $inviteCode
     * @return null|string
     */
    static function getUserIdByInviteCode($inviteCode)
    {
        $ins = self::findOrNew([self::DBKey_inviteCode => $inviteCode]);
        if ($ins->exist()) {
            return $ins->get_userid();
        }
        return null;
    }

    /**
     * 被邀请,
     * @param int $inviteCode 邀请人的邀请码
     * @return Common_Util_ReturnVar
     */
    public function invited($inviteCode)
    {
        $data = [];
        //interface err_dbs_invite_player_invited

        typeCheckNumber($inviteCode);


        logicErrorCondition(empty($this->get_invitedUserid()),
            err_dbs_invite_player_invited::ALREADY_INVITED,
            "ALREADY_INVITED");

        //不能自己邀请自己
        logicErrorCondition($this->get_inviteCode() !== $inviteCode,
            err_dbs_invite_player_invited::CANNOT_INVITE_SELF,
            "CANNOT_INVITE_SELF");

        $inviteUserid = self::getUserIdByInviteCode($inviteCode);

        logicErrorCondition(!empty($inviteUserid),
            err_dbs_invite_player_invited::INVITE_CODE_INVALID,
            "INVITE_CODE_INVALID");
        /**
         * 邀请者用户
         * @var $invitePlayer dbs_player
         */
        $invitePlayer = dbs_player::newGuestPlayerWithLock($inviteUserid);

        logicErrorCondition($invitePlayer->isRoleExists(),
            err_dbs_invite_player_invited::INVITE_PLAYER_NOT_EXISTS,
            "INVITE_PLAYER_NOT_EXISTS");

        //邀请人处理邀请
        dbs_invite_player::createWithPlayer($invitePlayer)->invite($this->get_userid());

        //设置我自己的邀请人ID
        $this->set_invitedUserid($inviteUserid);
        // 给我自己发放奖励

        $awardConfig = null;
        foreach (configdata_advertisement_invited_award_setting::data() as $data) {
            $awardConfig = $data;
            break;
        }
        if (!is_null($awardConfig)) {
            $mailData = dbs_mailbox_data::createWithStandardId(constants_mailTemplates::INVITE_SLAVE_GIFT,
                [], $inviteUserid);

            $awardGameCoin = 0;
            $awardDiamond = 0;
            if (isset($awardConfig[configdata_advertisement_invited_award_setting::k_gamecoin])) {
                $awardGameCoin = intval($awardConfig[configdata_advertisement_invited_award_setting::k_gamecoin]);
            }
            if (isset($awardConfig[configdata_advertisement_invited_award_setting::k_diamond])) {
                $awardDiamond = intval($awardConfig[configdata_advertisement_invited_award_setting::k_diamond]);
            }
            if ($awardGameCoin !== 0 || $awardDiamond !== 0) {
                $mailData->addAttachmentGamecoinAndDiamond($awardGameCoin, $awardDiamond);
            }

            if (isset($awardConfig[configdata_advertisement_invited_award_setting::k_itemid])) {
                $mailData->addAttachmentItem(
                    $awardConfig[configdata_advertisement_invited_award_setting::k_itemid],
                    intval($awardConfig[configdata_advertisement_invited_award_setting::k_itemcount]));
            }

            $mailData->send($this->get_userid());
        }

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取邀请的奖励配置
     * @param $inviteCount
     * @return null|array
     */
    private function getInviteAwardConfig($inviteCount)
    {
        foreach (configdata_advertisement_invite_award_setting::data() as $data) {
            if ($inviteCount >= intval($data[configdata_advertisement_invite_award_setting::k_invitecountmin]) &&
                $inviteCount < intval($data[configdata_advertisement_invite_award_setting::k_invitecountmax])
            ) {
                return $data;

            }
        }
        return null;
    }

    /**
     * 邀请用户
     * @param string $userid 被邀请人的id
     * @return bool
     */
    private function invite($userid)
    {
        $inviteDatas = $this->get_inviteDatas();
        //已经邀请过了?为什么???
        if (isset($inviteDatas[$userid])) {
            return false;
        }

        $inviteData = dbs_invite_data::create($userid);

        $inviteDatas[$userid] = $inviteData->toArray();

        $inviteCount = count($inviteDatas);


        //奖励配置
        $awardConfig = $this->getInviteAwardConfig($inviteCount);
        //达到发放奖励的条件
        if (!is_null($awardConfig)) {
            $mailData = dbs_mailbox_data::createWithStandardId(constants_mailTemplates::INVITE_MASTER_GIFT,
                [
                    "userid" => $userid,
                    "roleInfo" => dbs_filters_role::getVerySimpleInfo(dbs_player::newGuestPlayer($userid))
                ]);

            $awardGameCoin = 0;
            $awardDiamond = 0;
            if (isset($awardConfig[configdata_advertisement_invite_award_setting::k_gamecoin])) {
                $awardGameCoin = intval($awardConfig[configdata_advertisement_invite_award_setting::k_gamecoin]);
            }
            if (isset($awardConfig[configdata_advertisement_invite_award_setting::k_diamond])) {
                $awardDiamond = intval($awardConfig[configdata_advertisement_invite_award_setting::k_diamond]);
            }
            if ($awardGameCoin !== 0 || $awardDiamond !== 0) {
                $mailData->addAttachmentGamecoinAndDiamond($awardGameCoin, $awardDiamond);
            }

            if (isset($awardConfig[configdata_advertisement_invite_award_setting::k_itemid])) {
                $mailData->addAttachmentItem(
                    $awardConfig[configdata_advertisement_invite_award_setting::k_itemid],
                    intval($awardConfig[configdata_advertisement_invite_award_setting::k_itemcount]));
            }

            $mailData->send($this->get_userid());

        }


        //统计任务
        dbs_mission::createWithPlayer($this->db_owner)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_99,
            1);

        $this->set_inviteDatas($inviteDatas);

        return true;

    }


}