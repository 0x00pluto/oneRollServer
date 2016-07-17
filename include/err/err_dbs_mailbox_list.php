<?php
namespace err;
class err_dbs_mailbox_list_readmail
{
    /**
     * 邮件不存在
     *
     */
    const MAIL_NOT_EXISTS = 1;
}

class err_dbs_mailbox_list_recvattachment
{
    /**
     * 邮件不存在
     *
     */
    const MAIL_NOT_EXISTS = 1;
    /**
     * 仓库满了
     *
     */
    const WAREHOUSE_FULL = 2;

    /**
     * 没有知道到附件
     *
     */
    const NOT_HAS_ATTACHMENT = 3;

    /**
     * 已经领取了附件了
     */
    const ALREADY_RECEIVED_ATTACHMENT = 4;
}

class err_dbs_mailbox_list_activeattachaction
{
    /**
     * 邮件不存在
     *
     */
    const MAIL_NOT_EXISTS = 1;
    /**
     * 邮件没有附加操作
     *
     */
    const MAIL_NOT_HAS_ACTION = 2;
    /**
     * 操作过期
     *
     */
    const ACTION_EXPIRE = 3;
    /**
     * 完成操作需要的材料不足
     *
     */
    const CONDTION_MATERIAL_NOT_ENOUGH = 4;
}

class err_dbs_mailbox_list_deleteMail
{
    /**
     * 邮件不存在
     */
    const MAIL_NOT_EXISTS = 1;
}