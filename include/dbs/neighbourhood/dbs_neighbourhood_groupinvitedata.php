<?php

namespace dbs\neighbourhood;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Guid;
use dbs\templates\neighbourhood\dbs_templates_neighbourhood_groupinvitedata;

/**
 * 社区邀请数据
 *
 * @author zhipeng
 *
 */
class dbs_neighbourhood_groupinvitedata extends dbs_templates_neighbourhood_groupinvitedata
{

    /**
     * create...
     *
     * @param string $userid
     * @param string $lockposid
     * @param string $groupid
     * @return \dbs\neighbourhood\dbs_neighbourhood_groupinvitedata
     */
    static function create($userid, $lockposid, $groupid)
    {
        $ins = new self ();

        $timeout = Common_Util_Configdata::getInstance()->get_global_config_value('NEIGHBOORHOOD_INVITE_CODE_TIMEOUT')->int_value();
        $ins->set_groupid($groupid);
        $ins->set_timeout(time() + $timeout);
        $ins->set_userid($userid);
        $ins->set_inviteguid(Common_Util_Guid::gen_group_inviteguid());
        $ins->set_lockposid($lockposid);

        return $ins;
    }
}