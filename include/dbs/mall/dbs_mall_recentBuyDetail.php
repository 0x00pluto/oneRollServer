<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/5
 * Time: 下午5:14
 */

namespace dbs\mall;


use dbs\templates\mall\dbs_templates_mall_recentBuyDetail;

class dbs_mall_recentBuyDetail extends dbs_templates_mall_recentBuyDetail
{
    static public function create(dbs_mall_goodsSellInfoDetail $detail)
    {
        $ins = new self();

        $ins->set_tradeId($detail->get_id());
        $ins->set_rollTimeSpan($detail->get_rolltimeSpan());
        $ins->set_tradeTime($detail->get_selltime());
        $ins->set_tradeTimeMillisecond($detail->get_selltimeMillisecond());
        $ins->set_tradeUserId($detail->get_userid());
        $ins->set_tradeUserInfo($detail->get_userinfo());

        return $ins;
    }
}