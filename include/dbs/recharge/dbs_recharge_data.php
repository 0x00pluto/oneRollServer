<?php

namespace dbs\recharge;

use Common\Util\Common_Util_Guid;
use dbs\templates\recharge\dbs_templates_recharge_data;

/**
 * 充值订单数据
 *
 * @author zhipeng
 *
 */
class dbs_recharge_data extends dbs_templates_recharge_data
{
    /**
     * 创建订单实例
     *
     * @param string $goodid
     * @return dbs_recharge_data
     */
    public static function create($goodid)
    {
        $ins = new self ();
        $ins->set_orderid(Common_Util_Guid::gen_recharge_orderid());
        $ins->set_goodsid($goodid);
        $ins->set_createtime(time());

        return $ins;
    }
}