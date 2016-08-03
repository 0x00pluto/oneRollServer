<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/2
 * Time: 下午6:04
 */

namespace dbs\mall;


use Common\Util\Common_Util_Guid;
use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\templates\mall\dbs_templates_mall_goodsSellInfoDetail;

class dbs_mall_goodsSellInfoDetail extends dbs_templates_mall_goodsSellInfoDetail
{
    /**
     * @param dbs_player $player
     * @param array $rollCodes
     * @return static
     */
    public static function create(dbs_player $player, array $rollCodes)
    {
        $ins = new static();

        $ins->set_id(Common_Util_Guid::uuid("TradeCode-"));
        $ins->set_selltime(time());
        $ins->set_sellcount(count($rollCodes));
        $ins->set_rollCodes($rollCodes);
        $ins->set_userinfo(dbs_filters_role::getNormalInfo($player));
        return $ins;
    }
}