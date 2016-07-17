<?php

namespace dbs\item\uselogic;

use constants\constants_itemuselogic;

/**
 * 特殊顾客出现卡片
 *
 * @author zhipeng
 *
 */
class dbs_item_uselogic_logic5 extends dbs_item_uselogic_base
{
    public function get_logicid()
    {
        return constants_itemuselogic::TYPE_VIP_CUSTOM;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \dbs\item\uselogic\dbs_item_uselogic_base::useitem()
     */
    function useitem($player, array $useparams, array $Options)
    {
        if (count($useparams) != 1) {
            return false;
        }
        $customid = $useparams [0];

        $ret = $player->db_custom_visitors()->vipVisitorBorn([
            $customid
        ]);
        return $ret->is_succ();
    }
}