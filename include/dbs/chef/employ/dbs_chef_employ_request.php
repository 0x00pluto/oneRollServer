<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/26
 * Time: 下午4:10
 */

namespace dbs\chef\employ;


use Common\Util\Common_Util_Guid;
use constants\constants_time;
use dbs\templates\chef\employ\dbs_templates_chef_employ_requestData;

class dbs_chef_employ_request extends dbs_templates_chef_employ_requestData
{
    /**
     * 是否过期
     */
    public function isExpired()
    {
        return time() > $this->get_sendtime() + constants_time::SECONDS_ONE_DAY;
    }

    /**
     * 创建申请ID
     * @param $fromUserId
     * @param $toUserId
     * @param $toChefId
     * @return string
     */
    public static function createRequestId($fromUserId, $toUserId, $toChefId)
    {
        $uuidString = $fromUserId . $toUserId . $toChefId;
        return "requestId_" . Common_Util_Guid::uuid_fromString($uuidString);;
    }


    /**
     *
     * @param $fromUserId
     * @param $toUserId
     * @param $toChefId
     * @return dbs_chef_employ_request
     */
    public static function create($fromUserId, $toUserId, $toChefId)
    {
        $ins = new self();
        $ins->set_fromUserId($fromUserId);
        $ins->set_toUserId($toUserId);
        $ins->set_toChefId($toChefId);
        $ins->set_requestId(self::createRequestId($fromUserId,
            $toUserId,
            $toChefId));
        $ins->set_sendtime(time());
        return $ins;
    }

}