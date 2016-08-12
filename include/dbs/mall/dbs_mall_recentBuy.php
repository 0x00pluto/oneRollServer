<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/5
 * Time: 下午5:12
 */

namespace dbs\mall;


use constants\constants_mall;
use dbs\storage\dbs_storage_globalValue;
use dbs\templates\mall\dbs_templates_mall_recentBuy;

class dbs_mall_recentBuy extends dbs_templates_mall_recentBuy
{
    function pushSellDetail(dbs_mall_goodsSellInfoDetail $detail)
    {
        $details = $this->get_lastTradeDetails();

        $mall_recentBuyDetail = dbs_mall_recentBuyDetail::create($detail);
        $mall_recentBuyDetail_data = $mall_recentBuyDetail->toArray();
        array_push($details, $mall_recentBuyDetail_data);

        while (count($details) > 50) {
            array_shift($details);
        }
        $this->set_lastTradeDetails($details);
    }

    /**
     * @return int
     */
    function getTotalRollTimeSpan()
    {
        $details = $this->get_lastTradeDetails();
        $rollTimeSpan = 0;
        foreach ($details as $detail) {
            $rollTimeSpan += intval($detail[dbs_mall_recentBuyDetail::DBKey_rollTimeSpan]);
        }

        return $rollTimeSpan;
    }

    /**
     * 获取最近的购买
     * @return static
     */
    static function getRecentBuy()
    {
        return self::create_with_array(dbs_storage_globalValue::getValue(constants_mall::RECENT_BUY, []));

    }
}