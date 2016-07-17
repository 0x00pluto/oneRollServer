<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/3
 * Time: 下午4:14
 */

namespace dbs\shop;


use dbs\templates\shop\dbs_templates_shop_playerMallData;

class dbs_shop_playerMallData extends dbs_templates_shop_playerMallData
{
    /**
     * @param $mallId
     * @return dbs_shop_playerMallData
     */
    public static function create($mallId)
    {
        $ins = new self();
        $ins->set_mallid($mallId);
        return $ins;
    }

    /**
     * 增加购买次数
     * @param $num
     */
    public function addBuyCount($num)
    {
        $this->set_buyCount($this->get_buyCount() + $num);
        $this->set_dailyBuyCount($this->get_dailyBuyCount() + $num);
    }
}