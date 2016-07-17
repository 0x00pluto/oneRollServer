<?php

namespace dbs\mailbox;

use Common\Util\Common_Util_Guid;
use configdata\configdata_mail_setting;
use configdata\configdata_mail_settting;
use constants\constants_mail;
use constants\constants_time;
use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\item\dbs_item_normal;
use dbs\templates\mailbox\dbs_templates_mailbox_maildata;
use PhpParser\Node\Param;

class dbs_mailbox_data extends dbs_templates_mailbox_maildata
{
    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_mailType()
    {
        $this->set_defaultkeyandvalue(self::DBKey_mailType, constants_mail::TYPE_SYSTEM);
    }


    /**
     * 添加附件道具
     * @param $itemid
     * @param $num
     * @param dbs_item_normal|null $specialItemInfo 道具特殊信息,直接在接收的时候赋值道具数据
     * @return dbs_mailbox_data
     */
    public function addAttachmentItem($itemid, $num, dbs_item_normal $specialItemInfo = null)
    {
        $attachment = array(
            'itemid' => $itemid,
            'num' => $num
        );

        if (!is_null($specialItemInfo)) {
            $attachment['specialItemInfo'] = $specialItemInfo->toArray();
        }

        $attachmentList = $this->get_attachmentitems();
        $attachmentList[] = $attachment;
        $this->set_attachmentitems($attachmentList);

        $this->set_hasAttachment(true);


        return $this;
    }

    /**
     * 添加游戏币和钻石
     *
     * @param int $gamecoin
     * @param int $diamond
     *
     * @return dbs_mailbox_data
     */
    public function addAttachmentGamecoinAndDiamond($gamecoin, $diamond)
    {
        $gamecoin = intval($gamecoin);
        $diamond = intval($diamond);
        $this->set_attachmentGamecoin($gamecoin);
        $this->set_attachmentDiamond($diamond);
        $this->set_hasAttachment(true);

        return $this;
    }

    /**
     * 清除附件
     */
    public function clearAttachment()
    {
//        $this->reset_hasAttachment();
//            ->reset_attachmentGamecoin()
//            ->reset_attachmentDiamond()
//            ->reset_attachmentitems();
        if ($this->get_hasAttachment()) {
            $this->set_receivedAttachments(true);
        }
    }


    /**
     * 附加操作
     *
     * @param string $actionType
     *            操作类型
     * @param mixed $actionValue
     *            操作值
     * @param int $duringTime
     *            持续时间,-1为邮件生命周期
     *
     * @return $this
     */
    public function addAttachAction($actionType, $actionValue = [], $duringTime = -1)
    {
        if ($duringTime == -1) {
            $this->set_attachactionEndtime(0);
        } else {
            $this->set_attachactionEndtime(time() + $duringTime);
        }
        $this->set_attachactionId(Common_Util_Guid::gen_attachactoinid());
        $this->set_attachactionType($actionType);
        $this->set_attachactionValue($actionValue);
        $this->set_hasAttachaction(TRUE);

        return $this;
    }

    /**
     * 清除附加操作
     */
    public function clearAttachAction()
    {
        $this->reset_hasAttachaction()
            ->reset_attachactionEndtime()
            ->reset_attachactionId()
            ->reset_attachactionType()
            ->reset_attachactionValue();

    }


    /**
     * 使用语言模板设置语言ID
     * @param string $standardId
     * @param array $standardVariables {key=>value}
     * @return dbs_mailbox_data
     */
    public function setMailStandardId($standardId, array $standardVariables)
    {
        $this->set_mailStandardId($standardId);
        $this->set_mailStandardVariables($standardVariables);

        return $this;
    }

    /**
     * 设置过期时间
     * @param int $time
     *
     * @return $this
     */
    public function setExpiredTime($time)
    {
        $this->set_sendTime(time());
        $this->set_expiredTime($time + time());
        return $this;
    }

    /**
     * 发送邮件
     * @param string|dbs_player $destUserId
     */
    public function send($destUserId)
    {
        if ($destUserId instanceof dbs_player) {
            $destUserId = $destUserId->get_userid();
        }
        dbs_mailbox_list::sendMailToUser($destUserId, $this);
    }


    /**
     * 生产新的邮件内容
     * @param string $title 标题
     * @param string $content
     * @param string $fromUserid
     * @return dbs_mailbox_data
     */
    static function create($title, $content = '', $fromUserid = '')
    {
        $ins = new self ();
        $ins->set_mailid(Common_Util_Guid::gen_mailid());
        $ins->set_title($title);
        $ins->set_customContent($content);
        $ins->set_mailType(constants_mail::TYPE_SYSTEM);
        if (!empty ($fromUserid)) {
            $fromPlayer = dbs_player::newGuestPlayer($fromUserid);
            if ($fromPlayer->isRoleExists()) {
                $ins->set_fromUserid($fromUserid);
                $ins->set_fromUserinfo(dbs_filters_role::getVerySimpleInfo($fromPlayer));
                $ins->set_mailType(constants_mail::TYPE_USER);
            }
        }

        $ins->setExpiredTime(getGlobalValue("MAIL_EXPIRED")->int_value() * constants_time::SECONDS_ONE_DAY);


        return $ins;
    }

    /**
     * 通过语言配置创建邮件
     * @param $standardId
     * @param array $standardVariables
     * @param null $fromUserId
     * @return dbs_mailbox_data
     */
    static function createWithStandardId($standardId, array $standardVariables = [], $fromUserId = null)
    {
        $ins = new self ();

        $ins->set_mailid(Common_Util_Guid::gen_mailid());
        $ins->setExpiredTime(getGlobalValue("MAIL_EXPIRED")->int_value() * constants_time::SECONDS_ONE_DAY);

        $standardMailConfig =
            getConfigData(configdata_mail_setting::class,
                configdata_mail_setting::k_id,
                $standardId);


        if (is_null($standardMailConfig)) {
            //FIXME: 暂时过度一下.等配好表.再全局修改了
            $ins->set_title($standardId);
            $ins->set_mailStandardVariables($standardVariables);
            $ins->set_mailType(constants_mail::TYPE_SYSTEM);
            if (!empty ($fromUserId)) {
                $fromPlayer = dbs_player::newGuestPlayer($fromUserId);
                if ($fromPlayer->isRoleExists()) {
                    $ins->set_fromUserid($fromUserId);
                    $ins->set_fromUserinfo(dbs_filters_role::getVerySimpleInfo($fromPlayer));
                    $ins->set_mailType(constants_mail::TYPE_USER);
                }
            }
        } else {
            $ins->setMailStandardId($standardId, $standardVariables);
            $ins->set_mailType($standardMailConfig[configdata_mail_setting::k_type]);
            if (!empty ($fromUserId)) {
                $fromPlayer = dbs_player::newGuestPlayer($fromUserId);
                if ($fromPlayer->isRoleExists()) {
                    $ins->set_fromUserid($fromUserId);
                    $ins->set_fromUserinfo(dbs_filters_role::getVerySimpleInfo($fromPlayer));
                }
            }
        }
        return $ins;
    }
}