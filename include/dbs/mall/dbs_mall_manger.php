<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 下午10:48
 */

namespace dbs\mall;


use Common\Util\Common_Util_ReturnVar;

class dbs_mall_manger
{
    /**
     * 获取所有商品
     * @return Common_Util_ReturnVar
     */
    public function getAll()
    {
        $data = [];
        //interface err_dbs_mall_manger_getAll

        $allGoods = dbs_mall_onlineGoods::all();

        foreach ($allGoods as $Goods) {
            dump($Goods->toArray());
        }

//        dump($allGoods);

//        dump(dbs_mall_mallGoodsData::create()->toArray());

//        dbs_mall_onlineGoods::newGoods(dbs_mall_mallGoodsData::create());

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }
}