<?php

namespace dbs\notice;

use Common\Util\Common_Util_Guid;
use dbs\templates\notice\dbs_templates_notice_noticeData;

/**
 * 公告
 * 2015年5月20日 上午11:17:48
 *
 * @author zhipeng
 *
 */
class dbs_notice_plane extends dbs_templates_notice_noticeData
{


    function __construct()
    {
        parent::__construct(self::DBKey_tablename, array(), array(
            self::DBKey_noticeid
        ), FALSE);
    }

    /**
     * 创建公告
     *
     * @param string $title
     * @param string $content
     * @param int $startAt
     * @param int $duringTime
     * @param int $orderId
     * @return dbs_notice_plane
     */
    static function create($title, $content, $startAt, $duringTime, $orderId = 0)
    {
        $ins = new self ();
        $ins->set_noticeid(Common_Util_Guid::gen_notice_guid());
        $ins->set_startTime($startAt);
        $ins->set_orderId($orderId);
        $ins->set_title($title);
        $ins->set_content($content);
        $ins->set_expireTime($startAt + $duringTime);
        return $ins;
    }
}