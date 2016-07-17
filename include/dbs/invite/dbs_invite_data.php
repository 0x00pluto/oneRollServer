<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/18
 * Time: 下午4:38
 */

namespace dbs\invite;


use dbs\templates\invite\dbs_templates_invite_inviteData;

class dbs_invite_data extends dbs_templates_invite_inviteData
{

    /**
     * create..
     * @param $inviteUserId
     * @return dbs_invite_data
     */
    static public function create($inviteUserId)
    {
        $ins = new self();
        $ins->set_userId($inviteUserId);
        $ins->set_inviteTimespan(time());
        return $ins;
    }
}