<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 上午11:23
 */

namespace dbs\mall;


use dbs\templates\mall\dbs_templates_mall_goodsSellInfo;
use dbs\templates\mall\dbs_templates_mall_goodsSellInfoDetail;

class dbs_mall_goodsSellInfo extends dbs_templates_mall_goodsSellInfo
{

    /**
     * @param dbs_templates_mall_goodsSellInfoDetail $detail
     * @return array
     */
    public function addSellDetail(dbs_templates_mall_goodsSellInfoDetail $detail)
    {
        $this->set_sellcount($this->get_sellcount() + $detail->get_sellcount());

        $details = $this->get_sellDetails();
        $details[$detail->get_id()] = $detail->toArray();
        $this->set_sellDetails($details);

        return $details;

    }


}