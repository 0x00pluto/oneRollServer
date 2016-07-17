<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\mailbox\dbs_mailbox_data;
use dbs\mailbox\dbs_mailbox_list;

/**
 * 邮件服务系统
 *
 * @author zhipeng
 *
 */
class service_mail extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'readmail',
            'recvattachment',
            'deleteMail',
            'deleteAllMail'
        ));
        $this->addFunction('test', true);
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_mailbox_list();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_mailbox_list" . "_";
    }

    /**
     * 获取数据
     *
     * @return Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_mail_getinfo{}

        $data = $this->get_dbins()->toArray();
        // code
//        $a = [1, 2];
//        $b = [2, 3];
//        dump($c = array_merge($a, $b));
//        dump($d = array_unique($c));
//        dump(array_values($d));
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    function test()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_mail_test{}

//        $maildata = dbs_mailbox_data::create('123', '456');
//        // $maildata->set_gamecoin ( 1 );
//        // $maildata->set_diamond ( 2 );
//        $maildata->addattachmentgamecoinanddiamond(122, 222);
//        $maildata->addattachmentitem('100100', 2);
//
//        $maildata->addattachaction('mmd', '1', 1000);
//        // $this->get_dbins ()->sendmail ( $maildata );
//
//        dbs_mailbox_list::sendglobalmail($maildata);

//        dbs_mailbox_list::sendmail_to_user($this->callerUserid, $maildata);


        dbs_mailbox_data::createWithStandardId(1000, [], $this->callerUserid)
            ->send($this->callerUserid);
        dbs_mailbox_data::createWithStandardId(1006, [], $this->callerUserid)
            ->send($this->callerUserid);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 读取信件
     *
     * @param unknown $mailid
     * @return Common_Util_ReturnVar
     */
    function readmail($mailid)
    {
        typeCheckGUID($mailid);
        return $this->get_dbins()->readmail($mailid);
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
        typeCheckGUID($mailid);
        return $this->get_dbins()->recvattachment($mailid);
    }

    /**
     * 删除指定邮件
     * @param $mailId
     * @return Common_Util_ReturnVar
     */
    public function deleteMail($mailId)
    {
        return $this->get_dbins()->deleteMail($mailId);
    }

    /**
     * 清除所有邮件
     * @return Common_Util_ReturnVar
     */
    public function deleteAllMail()
    {
        return $this->get_dbins()->deleteAllMail();
    }
}