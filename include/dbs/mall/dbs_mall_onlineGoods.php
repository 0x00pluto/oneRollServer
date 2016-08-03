<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 下午11:03
 */

namespace dbs\mall;


use dbs\templates\mall\dbs_templates_mall_onlineGoods;

/**
 * Class dbs_mall_onlineGoods
 * @package dbs\mall
 */
class dbs_mall_onlineGoods extends dbs_templates_mall_onlineGoods
{
    protected function _set_defaultvalue_mallGoodsData()
    {
        $this->set_defaultkeyandvalue(self::DBKey_mallGoodsData, dbs_mall_mallGoodsData::dumpDefaultValue());
    }

    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * @param dbs_mall_mallGoodsData $mallGoodsData
     * @return dbs_mall_onlineGoods
     */
    static function newGoods(dbs_mall_mallGoodsData $mallGoodsData)
    {
        $ins = new self();
        $ins->set_id($mallGoodsData->get_id());
        $ins->set_mallGoodsData($mallGoodsData->toArray());
        return $ins;
    }

}