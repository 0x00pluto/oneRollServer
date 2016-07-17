<?php

namespace dbs\chat;

use Common\Util\Common_Util_Message;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_messagecmd;
use constants\constants_mission;
use dbs\dbs_baseplayer;
use dbs\dbs_player;
use dbs\mailbox\dbs_mailbox_data;
use err\err_dbs_chat_normal_chat;
use err\err_dbs_chat_normal_chattoneighbourhood;
use err\err_dbs_chat_normal_recvneighbourhoodchat;

/**
 * 基本聊天服务
 * 2015年5月9日 上午11:55:21
 *
 * @author zhipeng
 *
 */
class dbs_chat_normal extends dbs_baseplayer
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "chat_normal";

    /**
     * 聊天列表
     *
     * @var string
     */
    const DBKey_chatlist = "chatlist";

    /**
     * 获取聊天列表
     */
    public function get_chatlist()
    {
        return $this->getdata(self::DBKey_chatlist);
    }

    /**
     * 设置聊天列表
     *
     * @param unknown $chatlist
     */
    private function set_chatlist($chatlist)
    {
        $this->setdata(self::DBKey_chatlist, $chatlist);
    }

    function __construct()
    {
        parent::__construct(self::DBKey_tablename, array(
            self::DBKey_userid => '',
            self::DBKey_chatlist => array()
        ));
    }

    /**
     * 聊天
     *
     * @param string $destuserid 目标用户
     * @param string $content 内容
     * @return Common_Util_ReturnVar
     */
    function chat($destuserid, $content)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_chat_normal_chat{}

        $destuserid = strval($destuserid);
        $content = strval($content);

        if ($destuserid == $this->get_userid()) {
            $retCode = err_dbs_chat_normal_chat::CANNOT_CHAT_WITH_SELF;
            $retCode_Str = 'CANNOT_CHAT_WITH_SELF';
            goto failed;
        }

        $destplayer = dbs_player::newGuestPlayerWithLock($destuserid);
        if (!$destplayer->isRoleExists()) {
            $retCode = err_dbs_chat_normal_chat::DEST_USER_NOT_FOUND;
            $retCode_Str = 'DEST_USER_NOT_FOUND';
            goto failed;
        }

        $chatdata = dbs_chat_data::create_chat_private($this->db_owner, $content);
        $chatservice = $destplayer->dbs_chat_normal();
        $chatservice->insert_chat_message($chatdata);

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_74, 1);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 接收所有的聊天消息,客户端注意自己保存
     *
     * @return Common_Util_ReturnVar
     */
    function recvchat()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_chat_normal_recvchat{}
        $data = $this->get_chatlist();

        if (count($data) != 0) {
            $this->set_chatlist(array());
        }
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 聊天服务
     *
     * @param dbs_chat_data $chatdata
     * @return Common_Util_ReturnVar
     */
    private function insert_chat_message(dbs_chat_data $chatdata)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_chat_normal_chat{}

        $chatlist = $this->get_chatlist();
        array_push($chatlist, $chatdata->toArray());
        $this->set_chatlist($chatlist);

        // 标记有新的聊天消息

        $this->db_owner->db_sync()->mark_sync(constants_messagecmd::S2C_HAS_NEED_CHAT);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 发送群组聊天
     *
     * @param string $content
     * @return Common_Util_ReturnVar
     */
    function chattoneighbourhood($content)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_chat_normal_chattoneighbourhood{}

        $groupdata = $this->db_owner->dbs_neighbourhood_playerdata()->get_groupdata();

        if (is_null($groupdata)) {
            $retCode = err_dbs_chat_normal_chattoneighbourhood::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }

        $chatdata = dbs_chat_data::create_chat_group($this->db_owner, $content);
        $groupdata->chat($chatdata);

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_71, 1);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 直接发送,群组聊天
     *
     * @param dbs_mailbox_data $data
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function chattoneighbourhood_withdata(dbs_mailbox_data $chatdata)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_chat_normal_chattoneighbourhood_withdata{}
        $groupdata = $this->db_owner->dbs_neighbourhood_playerdata()->get_groupdata();

        if (is_null($groupdata)) {
            $retCode = err_dbs_chat_normal_chattoneighbourhood::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }

        $groupdata->chat($chatdata);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 收取群聊
     *
     * @param string $param
     * @return Common_Util_ReturnVar
     */
    function recvneighbourhoodchat()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_chat_normal_recvneighbourhoodchat{}
        $groupdata = $this->db_owner->dbs_neighbourhood_playerdata()->get_groupdata();

        if (is_null($groupdata)) {
            $retCode = err_dbs_chat_normal_recvneighbourhoodchat::NOT_IN_GROUP;
            $retCode_Str = 'NOT_IN_GROUP';
            goto failed;
        }
        $data = $groupdata->recvchat();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    function sync()
    {
        $chatlist = $this->get_chatlist();
        if (count($chatlist) > 0) {
            Common_Util_Message::pushS2CMessageByCmdId(constants_messagecmd::S2C_HAS_NEED_CHAT, array(
                'num' => count($chatlist)
            ));
        }
    }
}