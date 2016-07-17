<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/4/6
 * Time: 下午3:19
 */

namespace dbs\custom\visitors;


use Common\Util\Common_Util_Guid;
use constants\constants_customtype;
use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\templates\custom\visitors\dbs_templates_custom_visitors_strangervisitor;

class dbs_custom_visitors_strangerVisitor extends dbs_templates_custom_visitors_strangervisitor
{
    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_customType()
    {
        $this->set_defaultkeyandvalue(self::DBKey_customType, constants_customtype::STRANGER);
    }

    static public function createWithUserId($userid)
    {
        $ins = new self;

        $ins->set_userid($userid);
        $player = dbs_player::newGuestPlayer($userid);
        $ins->set_userInfo(dbs_filters_role::getNormalInfo($player));
        $ins->set_customId(Common_Util_Guid::gen_visitor());
        //出现持续5分钟
        $ins->set_startTime(time());
        $ins->set_endTime(time() + 5 * 60);

        return $ins;
    }
}