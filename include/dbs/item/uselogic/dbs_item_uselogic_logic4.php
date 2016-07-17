<?php

namespace dbs\item\uselogic;

use constants\constants_itemuselogic;

/**
 * 使用各种带有buff的道具
 *
 * @author zhipeng
 *
 *
 */
class dbs_item_uselogic_logic4 extends dbs_item_uselogic_base
{
    public function get_logicid()
    {
        return constants_itemuselogic::TYPE_ADD_BUFF;
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
        $buffid = $useparams [0];

        $ret = $player->dbs_buff_list()->addbuff($buffid);
        return $ret->is_succ();
    }
}