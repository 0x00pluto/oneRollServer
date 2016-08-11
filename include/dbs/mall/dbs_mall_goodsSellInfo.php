<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 上午11:23
 */

namespace dbs\mall;


use dbs\templates\mall\dbs_templates_mall_goodsSellInfo;

class dbs_mall_goodsSellInfo extends dbs_templates_mall_goodsSellInfo
{

    /**
     * @param dbs_mall_goodsSellInfoDetail $detail
     * @return array
     */
    public function addSellDetail(dbs_mall_goodsSellInfoDetail $detail)
    {
        $this->set_sellcount($this->get_sellcount() + $detail->get_sellcount());

        $details = $this->get_sellDetails();
        $details[$detail->get_id()] = $detail->toArray();
        $this->set_sellDetails($details);


        $rollDetails = $this->get_rollDetails();

        $rollDetails[$detail->get_rollCode()] = $detail->get_userid();

        $this->set_rollDetails($rollDetails);

        return $details;

    }

    /**
     * @param $luckNum
     * @return string
     */
    public function getUserId($luckNum)
    {
        $details = $this->get_rollDetails();;

        if (isset($details[$luckNum])) {
            return $details[$luckNum];
        }
        return "";
    }


}