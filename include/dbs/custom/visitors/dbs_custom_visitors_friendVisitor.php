<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/4/6
 * Time: 下午2:27
 */

namespace dbs\custom\visitors;


use Common\Util\Common_Util_Guid;
use constants\constants_customtype;
use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\friend\dbs_friend_data;
use dbs\templates\custom\visitors\dbs_templates_custom_visitors_friendvisitor;

class dbs_custom_visitors_friendVisitor extends dbs_templates_custom_visitors_friendvisitor
{
    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_customType()
    {
        $this->set_defaultkeyandvalue(self::DBKey_customType, constants_customtype::FRIEND);
    }


    /**
     * @param dbs_friend_data $friend
     * @return dbs_custom_visitors_friendVisitor
     */
    static public function createWithFriendData(dbs_friend_data $friend)
    {
        $ins = new self();

        
        $ins->set_userid($friend->get_frienduserid());
        $friendPlayer = dbs_player::newGuestPlayer($friend->get_frienduserid());
        $ins->set_userInfo(dbs_filters_role::getNormalInfo($friendPlayer));
        $ins->set_friendInfo($friend->toArray());
        $ins->set_goodwillInfo($friend->getGoodWillData()->toArray());

        $ins->set_customId(Common_Util_Guid::gen_visitor());
        //出现持续5分钟
        $ins->set_startTime(time());
        $ins->set_endTime(time() + 5 * 60);

        return $ins;
    }
}