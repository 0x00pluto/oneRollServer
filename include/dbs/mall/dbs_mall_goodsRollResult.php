<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/8
 * Time: 下午2:55
 */

namespace dbs\mall;


use dbs\templates\mall\dbs_templates_mall_goodsRollResult;

class dbs_mall_goodsRollResult extends dbs_templates_mall_goodsRollResult
{
    /**
     * @param dbs_mall_recentBuy $recentBuy
     * @return dbs_mall_goodsRollResult
     */
    public static function create(dbs_mall_recentBuy $recentBuy)
    {
        $ins = new self();

        $ins->set_recentBuy($recentBuy->toArray());

        return $ins;
    }
}