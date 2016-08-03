<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/2
 * Time: 下午4:42
 */

namespace dbs\records;


use dbs\mall\dbs_mall_mallGoodsData;
use dbs\templates\records\dbs_templates_records_recordData;

class dbs_records_recordData extends dbs_templates_records_recordData
{
    /**
     * @param dbs_mall_mallGoodsData $mallGoodsData
     * @param array $rollCodes
     * @return dbs_records_recordData
     */
    public static function create(dbs_mall_mallGoodsData $mallGoodsData,
                                  array $rollCodes)
    {
        $ins = new self();
        $ins->set_GoodsId($mallGoodsData->get_id());
        $ins->set_Codes($rollCodes);

        return $ins;
    }


    /**
     * @param dbs_records_recordData $other
     * @return $this
     */
    public function merge(dbs_records_recordData $other)
    {
        $codes = $this->get_Codes();
        $codes = array_merge($codes, $other->get_Codes());
        $this->set_Codes($codes);
        return $this;
    }
}