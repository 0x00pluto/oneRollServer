<?php

namespace dbs\mailbox;

use Common\Util\Common_Util_ReturnVar;
use constants\constants_globalkey;
use constants\constants_mailactiontype;
use constants\constants_messagecmd;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\dbs_player;
use dbs\dbs_warehouse;
use dbs\item\dbs_item_normal;
use dbs\managers\dbs_managers_globalkvstore;
use dbs\robot\dbs_robot_player;
use dbs\templates\mailbox\dbs_templates_mailbox_maillist;
use err\err_dbs_mailbox_list_activeattachaction;
use err\err_dbs_mailbox_list_deleteMail;
use err\err_dbs_mailbox_list_readmail;
use err\err_dbs_mailbox_list_recvattachment;

/**
 * 邮箱系统
 *
 * @author zhipeng
 *
 */
class dbs_mailbox_list extends dbs_templates_mailbox_maillist
{

    /**
     * 获取邮件数据
     *
     * @param string $mailid
     * @return dbs_mailbox_data|null
     */
    public function get_maildata($mailid)
    {
        $mailid = strval($mailid);
        $maildata = null;
        $mailllist = $this->get_maillist();

        if (isset($mailllist, $mailid)) {
            $maildata = new dbs_mailbox_data ();
            $maildata->fromArray($mailllist [$mailid]);
        }
        return $maildata;
    }

    /**
     * 保存单个邮件信息
     *
     * @param dbs_mailbox_data $mailData
     */
    public function set_maildata(dbs_mailbox_data $mailData)
    {
        $mailList = $this->get_maillist();
        if (isset($mailList[$mailData->get_mailid()])) {

            $mailList [$mailData->get_mailid()] = $mailData->toArray();
            $this->set_maillist($mailList);
        }
    }

    /**
     * 发送全服邮件
     *
     * @param dbs_mailbox_data $mail
     * @return Common_Util_ReturnVar
     */
    static function sendGlobalMail(dbs_mailbox_data $mail)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_mailbox_list_sendglobalmail{}

        $mailList = dbs_managers_globalkvstore::getvalue(constants_globalkey::GLOBAL_MAIL_LIST, array());
        $mailList [$mail->get_mailid()] = $mail->toArray();
        dbs_managers_globalkvstore::setvalue(constants_globalkey::GLOBAL_MAIL_LIST, $mailList);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 删除全局邮件
     *
     * @param string $mailId
     * @return \Common\Util\Common_Util_ReturnVar
     */
    static function removeGlobalMail($mailId)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_mailbox_list_removeGlobalMail{}

        $mailList = dbs_managers_globalkvstore::getvalue(constants_globalkey::GLOBAL_MAIL_LIST, []);
        if (isset ($mailList [$mailId])) {
            unset ($mailList [$mailId]);
            dbs_managers_globalkvstore::setvalue(constants_globalkey::GLOBAL_MAIL_LIST, $mailList);
        }
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取全部全局邮件
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    static function getGlobalMails()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_mailbox_list_getGlobalMails{}

        $data = dbs_managers_globalkvstore::getvalue(constants_globalkey::GLOBAL_MAIL_LIST, []);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 给指定用户发送邮件
     *
     * @param $userid
     */
    static function sendMailToUser($userid, dbs_mailbox_data $mail)
    {
        $userid = strval($userid);
        $destPlayer = dbs_player::newGuestPlayerWithLock($userid);
        if (!$destPlayer->isRoleExists()) {
            return;
        }
        //不用向机器人发邮件了
        if(dbs_robot_player::createWithPlayer($destPlayer)->get_isrobot())
        {
            return;
        }
        $destPlayer->dbs_mailbox_list()->sendmail($mail);
    }

    /**
     * 给我发送邮件
     *
     * @param dbs_mailbox_data $mail
     * @return Common_Util_ReturnVar
     */
    function sendmail(dbs_mailbox_data $mail)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_mailbox_list_sendmail{}

        $mailList = $this->get_maillist();
        $mailList [$mail->get_mailid()] = $mail->toArray();
        $this->set_maillist($mailList);

        // $unreadcount = $this->unread_mail_count ();
        // if ($unreadcount > 0) {
        $this->db_owner->db_sync()->mark_sync(constants_messagecmd::S2C_HAS_NEW_MAILS, [
            constants_returnkey::RK_DATA => $mail->toArray()
        ]);
        // }
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 读取信件
     *
     * @param string $mailid
     * @return Common_Util_ReturnVar
     */
    function readmail($mailid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_mailbox_list_readmail{}

        $mailid = strval($mailid);
        $mailData = $this->get_maildata($mailid);
        if (is_null($mailData)) {
            $retCode = err_dbs_mailbox_list_readmail::MAIL_NOT_EXISTS;
            $retCode_Str = 'MAIL_NOT_EXISTS';
            goto failed;
        }
        $mailData->set_isRead(true);
        $this->set_maildata($mailData);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 收取所有附件
     *
     * @param string $mailid
     *            邮件id
     * @return Common_Util_ReturnVar
     */
    function recvattachment($mailid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_mailbox_list_recvattachment{}
        $mailid = strval($mailid);
        $mailData = $this->get_maildata($mailid);


        if (is_null($mailData)) {
            $retCode = err_dbs_mailbox_list_recvattachment::MAIL_NOT_EXISTS;
            $retCode_Str = 'MAIL_NOT_EXISTS';
            goto failed;
        }

        logicErrorCondition(!$mailData->get_receivedAttachments(),
            err_dbs_mailbox_list_recvattachment::ALREADY_RECEIVED_ATTACHMENT,
            "ALREADY_RECEIVED_ATTACHMENT");

        if (!$mailData->get_hasAttachment()) {
            $retCode = err_dbs_mailbox_list_recvattachment::NOT_HAS_ATTACHMENT;
            $retCode_Str = 'NOT_HAS_ATTACHMENT';
            goto failed;
        }

        $gamecoin = $mailData->get_attachmentGamecoin();
        $diamond = $mailData->get_attachmentDiamond();

        $items = $mailData->get_attachmentitems();
        $warehouse = null;
        foreach ($items as $item) {
            $itemId = $item ['itemid'];
            $itemNum = $item ['num'];
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $item ['itemid']);
            if ($warehouse) {
                if (!$warehouse->testItemCanPut($itemId, $itemNum)) {
                    $retCode = err_dbs_mailbox_list_recvattachment::WAREHOUSE_FULL;
                    $retCode_Str = 'WAREHOUSE_FULL';
                    goto failed;
                }
            }
        }

        // 添加游戏币和钻石

        $this->db_owner->db_role()->add_diamond($diamond, constants_moneychangereason::RECV_MAIL_ATTACHMENT);
        $this->db_owner->db_role()->add_gamecoin($gamecoin, constants_moneychangereason::RECV_MAIL_ATTACHMENT);

        // 添加道具
        foreach ($items as $item) {
            $itemId = $item ['itemid'];
            $itemNum = $item ['num'];
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $item ['itemid']);

            if ($warehouse) {
                //特殊道具信息,直接添加
                if (isset($item['specialItemInfo'])) {
                    $specialItemInfo = dbs_item_normal::create_with_array($item['specialItemInfo']);
                    $warehouse->addItem($specialItemInfo, true);
                } else {
                    $warehouse->addItemByItemId($itemId, $itemNum, true);
                }
            }
        }

        // 清除附件
        $mailData->set_isRead(true);
        $mailData->clearAttachment();
        $this->set_maildata($mailData);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 激活附加操作
     *
     * @param string $mailid
     *            邮件id
     * @param bool $accpet
     *            是否同意,0 不同意,1同意
     * @return Common_Util_ReturnVar
     */
    function activeattachaction($mailid, $accpet)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_mailbox_list_activeattachaction{}

        $mailid = strval($mailid);
        $accpet = boolval($accpet);

        $mailData = $this->get_maildata($mailid);
        if (is_null($mailData)) {
            $retCode = err_dbs_mailbox_list_activeattachaction::MAIL_NOT_EXISTS;
            $retCode_Str = 'MAIL_NOT_EXISTS';
            goto failed;
        }

        if (!$mailData->get_hasAttachaction()) {
            $retCode = err_dbs_mailbox_list_activeattachaction::MAIL_NOT_HAS_ACTION;
            $retCode_Str = 'MAIL_NOT_HAS_ACTION';
            goto failed;
        }

        if ($mailData->get_attachactionEndtime() != 0 && $mailData->get_attachactionEndtime() < time()) {
            $retCode = err_dbs_mailbox_list_activeattachaction::ACTION_EXPIRE;
            $retCode_Str = 'ACTION_EXPIRE';
            goto failed;
        }

        if ($accpet == false) {
        } else {
            // 接受条件
            self::active_attach_action($mailData);
        }

        $mailData->clearAttachAction();
        $mailData->set_isRead(true);
        $this->set_maildata($mailData);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 删除指定邮件
     * @param $mailId
     * @return Common_Util_ReturnVar
     */
    public function deleteMail($mailId)
    {
        $data = [];
        //interface err_dbs_mailbox_list_deleteMail

        typeCheckGUID($mailId);

        $mails = $this->get_maillist();

        logicErrorCondition(isset($mails[$mailId]),
            err_dbs_mailbox_list_deleteMail::MAIL_NOT_EXISTS,
            "MAIL_NOT_EXISTS");


        unset($mails[$mailId]);
        $this->set_maillist($mails);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 清除所有邮件
     * @return Common_Util_ReturnVar
     */
    public function deleteAllMail()
    {
        $data = [];
        //interface err_dbs_mailbox_list_deleteAllMail

        $this->reset_maillist();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 激活附件操作
     *
     * @param dbs_mailbox_data $maildata
     */
    public static function active_attach_action(dbs_mailbox_data $maildata)
    {
        $condition = $maildata->get_attachactionType();

        // TODO 目前没有邮件附加操作,需要后续补充
        switch ($condition) {
            // 领取超级老虎机
            case constants_mailactiontype::RECV_SUPER_SLOTMACHINE_JACKPOT :
                ;
                break;

            default :
                ;
                break;
        }
    }

    /**
     * 未读邮件的数量
     */
    private function unread_mail_count()
    {
        $mailList = $this->get_maillist();
        $mailData = new dbs_mailbox_data ();
        $unreadCount = 0;
        foreach ($mailList as $value) {
            $mailData->fromArray($value);
            if (!$mailData->get_isRead()) {
                $unreadCount++;
            }
        }

        return $unreadCount;
    }

    /**
     * 接收全服邮件
     */
    private function recvGlobalMails()
    {
        $globalMails = dbs_managers_globalkvstore::getvalue(constants_globalkey::GLOBAL_MAIL_LIST, array());

        $userGlobalMails = $this->db_owner->dbs_userkvstore()->getvalue(constants_globalkey::PLAYER_GLOBAL_MAIL_LIST, array());
        $dataChange = false;
        foreach ($globalMails as $key => $mail) {
            if (!isset ($userGlobalMails [$key])) {
                $userGlobalMails [$key] = 1;
                dbs_mailbox_data::create_with_array($mail)->send($this->get_userid());
                $dataChange = true;
            }
        }
        if ($dataChange) {
            $this->db_owner->dbs_userkvstore()->setvalue(constants_globalkey::PLAYER_GLOBAL_MAIL_LIST, $userGlobalMails);
        }
    }

    /**
     * 删除过期邮件
     */
    private function removeTimeOutMails()
    {
        $mails = $this->get_maillist();

        $dataChange = false;
        foreach ($mails as $mailId => $mailData) {
            $mail = dbs_mailbox_data::create_with_array($mailData);
            if ($mail->get_expiredTime() <= time()) {
                $dataChange = true;
                unset($mails[$mailId]);
            }
        }

        if ($dataChange) {
            $this->set_maillist($mails);
        }
    }

    function masterbeforecall()
    {
        $this->recvGlobalMails();

        $this->removeTimeOutMails();
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


}