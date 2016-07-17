<?php

namespace dbs\notice;

use Common\Db\Common_Db_memcacheObject;
use Common\Db\Common_Db_pools;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_memcachekey;
use err\err_dbs_notice_planemanager_modifynotice;

/**
 * 消息面板管理器
 * 2015年5月20日 上午11:33:29
 *
 * @author zhipeng
 *
 */
class dbs_notice_planemanager
{

    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
        // echo 'This is a Constructed method;';
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }

    /**
     * 更新缓存
     *
     * @return array
     */
    private function cacheNotices()
    {
        $all = [];
        $notices = dbs_notice_plane::all();
        foreach ($notices as $notice) {
            $all [] = $notice->toArray();
        }
        $db_memcache = Common_Db_memcacheObject::create(constants_memcachekey::DBkey_NOTICE_PLANE);
        $db_memcache->setExpiration(60 * 60 * 24);
        $db_memcache->set_value($all);


        return $all;
    }


    /**
     * 发送公告
     * @param $title
     * @param $content
     * @param $startAt
     * @param int $duringtime 持续时间,秒
     * @param $templateId
     * @param $templateVariables
     * @param int $orderid
     * @return Common_Util_ReturnVar
     */
    function sendnotice($title,
                        $content,
                        $startAt,
                        $duringtime,
                        $templateId,
                        array $templateVariables = [],
                        $orderid = -1)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $dbs_notice = dbs_notice_plane::create($title, $content, $startAt, $duringtime, $orderid);
        $dbs_notice->set_templateId($templateId);
        $dbs_notice->set_templateVariables($templateVariables);
        $dbs_notice->saveToDB();

        // 更新到memcache
        $this->cacheNotices();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
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
     * @param array $templateVariables
     * @param int $orderid
     * @return Common_Util_ReturnVar
     */
    function modifynotice($noticeid,
                          $title,
                          $content,
                          $startAt,
                          $duringTime,
                          $templateId,
                          array $templateVariables = [],
                          $orderid = -1)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $notice = dbs_notice_plane::findOrNew([
            dbs_notice_plane::DBKey_noticeid => $noticeid
        ]);

        if (!$notice->exist()) {
            $retCode = err_dbs_notice_planemanager_modifynotice::NOTICE_NOT_FOUND;
            $retCode_Str = 'NOTICE_NOT_FOUND';
            goto failed;
        }

        $notice->set_title($title);
        $notice->set_content($content);
        $notice->set_startTime($startAt);
        $notice->set_expireTime($startAt + $duringTime);
        $notice->set_orderId($orderid);
        $notice->set_templateId($templateId);
        $notice->set_templateVariables($templateVariables);

        $notice->saveToDB();

        $data = $notice->toArray();

        $this->cacheNotices();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取所有公告
     *
     * @return Common_Util_ReturnVar
     */
    function getall()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_notice_planemanager_getall{}

        $allNotices = [];
        $db_memcache = Common_Db_memcacheObject::create(constants_memcachekey::DBkey_NOTICE_PLANE);
        if ($db_memcache->has_value()) {
            $allNotices = $db_memcache->get_value([]);
        } else {
            $allNotices = $this->cacheNotices();
        }
        $data ['notices'] = $allNotices;

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }
}