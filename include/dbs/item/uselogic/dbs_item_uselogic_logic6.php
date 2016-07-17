<?php

namespace dbs\item\uselogic;

use constants\constants_itemuselogic;
use dbs\chef\dbs_chef_list;

/**
 * 使用厨师体力道具
 *
 * @author zhipeng
 *
 *
 */
class dbs_item_uselogic_logic6 extends dbs_item_uselogic_base
{
    public function get_logicid()
    {
        return constants_itemuselogic::TYPE_ADD_CHEF_VIT;
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
        if (count($Options) != 1) {
            return false;
        }
        $addVitCount = $useparams [0];
        $chefId = $Options [0];

        $chef = $player->dbs_chef_list()->get_chef($chefId);
        if (null === $chef) {
            return false;
        }

        if (!$player->dbs_chef_list()->canUseFillVitItem()) {
            return false;
        }

        if (!$chef->addvit($addVitCount)) {
            return false;
        }
        dbs_chef_list::createWithPlayer($player)->set_chef($chef);
        $player->dbs_chef_list()->recordUseFillVitItem();

        return true;
    }
}