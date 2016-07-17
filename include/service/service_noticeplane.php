<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\notice\dbs_notice_planemanager;

/**
 * 公告面板服务,目前不用这个服务.由客户端csv自己实现
 * @auther zhipeng
 */
class service_noticeplane extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'sendnotice',
            'modifynotice'
        ), TRUE);

        $this->addFunction('getall');
    }

    protected function get_dbins()
    {
        return dbs_notice_planemanager::getInstance();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_notice_planemanager_";
    }

    /**
     * 发送公告
     * @param $title
     * @param $content
     * @param $startAt
     * @param int $duringtime 持续时间,秒
     * @param $templateId
     * @param $templateVariablesJson
     * @param int $orderid
     * @return Common_Util_ReturnVar
     */
    function sendnotice($title,
                        $content,
                        $startAt,
                        $duringtime,
                        $templateId,
                        $templateVariablesJson = "[]",
                        $orderid = -1)
    {
        typeCheckJsonString($templateVariablesJson);
        $templateVariables = json_decode($templateVariablesJson, true);
        return $this->get_dbins()->sendnotice($title,
            $content,
            $startAt,
            $duringtime,
            $templateId,
            $templateVariables,
            $orderid);
    }

    /**
     * 修改公告
     *
     * @param $noticeid
     * @param $title
     * @param $content
     * @param $startAt
     * @param $duringTime
     * @param $templateId
     * @param string $templateVariablesJson
     * @param int $orderid
     * @return Common_Util_ReturnVar
     */
    function modifynotice($noticeid,
                          $title,
                          $content,
                          $startAt,
                          $duringTime,
                          $templateId,
                          $templateVariablesJson = "[]",
                          $orderid = -1)
    {
        typeCheckJsonString($templateVariablesJson);
        $templateVariables = json_decode($templateVariablesJson, true);
        return $this->get_dbins()->modifynotice($noticeid, $title, $content,
            $startAt,
            $duringTime,
            $templateId,
            $templateVariables,
            $orderid);
    }

    /**
     * 获取所有公告
     *
     * @return Common_Util_ReturnVar
     */
    function getall()
    {
        return $this->get_dbins()->getall();
    }
}