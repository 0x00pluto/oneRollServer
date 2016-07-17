<?php

namespace dbs\chat;

use constants\constants_mail;
use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\mailbox\dbs_mailbox_data;

/**
 * 聊天数据
 *
 * @author zhipeng
 *
 */
class dbs_chat_data extends dbs_mailbox_data
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * create...
     *
     * @param dbs_player $senduser
     * @param string $content
     * @return dbs_chat_data
     */
    static function create_chat_private(dbs_player $senduser, $content)
    {
        return self::create_chat($senduser, $content, constants_mail::TYPE_PRIVATE_CHAT);
    }

    /**
     * create...
     *
     *
     * @param dbs_player $senduser
     * @param string $content
     * @return dbs_chat_data
     */
    static function create_chat_group(dbs_player $senduser, $content)
    {
        return self::create_chat($senduser, $content, constants_mail::TYPE_GROUP_CHAT);
    }

    /**
     * @param dbs_player $senduser
     * @param $content
     * @param string $type
     * @return static
     */
    private static function create_chat(dbs_player $senduser, $content, $type = constants_mail::TYPE_PRIVATE_CHAT)
    {
        $ins = new static ();
        $ins->set_fromUserid($senduser->get_userid());
        $ins->set_fromUserinfo($senduser->db_role()->toArray(dbs_filters_role::$filters_simple_info));
        $ins->set_customContent($content);
        $ins->set_sendTime(time());
        $ins->set_mailType($type);
        return $ins;
    }
}