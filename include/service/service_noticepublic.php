<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\notice\dbs_notice_public;

/**
 * 滚动公告
 * @auther zhipeng
 */
class service_noticepublic extends service_base
{
    function __construct()
    {
        $this->addFunction('sendnotice', TRUE);
        $this->addFunction('getnotice');
    }

    protected function get_dbins()
    {
        return dbs_notice_public::getInstance();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_noticepublic";
    }

    /**
     * 发送通知
     *
     * @param unknown $content
     * @param unknown $senduserid
     * @return Common_Util_ReturnVar
     */
    function sendnotice($content, $senduserid)
    {
        return $this->get_dbins()->sendnotice($content, $senduserid);
    }

    /**
     * 获取通知
     *
     * @return Common_Util_ReturnVar
     */
    function getnotice()
    {
        return $this->get_dbins()->getnotice();
    }
}