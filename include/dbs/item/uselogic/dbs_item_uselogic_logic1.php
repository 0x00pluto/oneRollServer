<?php

namespace dbs\item\uselogic;
use constants\constants_itemuselogic;

/**
 * 灵感泡泡使用逻辑
 *
 * @author zhipeng
 *
 *
 */
class dbs_item_uselogic_logic1 extends dbs_item_uselogic_base
{
    public function get_logicid()
    {
        return constants_itemuselogic::TYPE_ADD_CHEF_EXP;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \dbs\item\uselogic\dbs_item_uselogic_base::useitem()
     */
    function useitem($player, array $useparams, array $Options)

    {
        dump($useparams);
    }
}