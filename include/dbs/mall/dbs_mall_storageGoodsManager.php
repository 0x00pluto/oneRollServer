<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/12
 * Time: 下午12:13
 */

namespace dbs\mall;


use Common\Util\Common_Util_ReturnVar;
use err\err_dbs_mall_storageGoodsManager;
use err\err_dbs_mall_storageGoodsManager_setGoodsInvalid;
use err\err_dbs_mall_storageGoodsManager_setGoodsOnline;
use err\err_dbs_mall_storageGoodsManager_setGoodsValid;
use hellaEngine\utils\singleton;

class dbs_mall_storageGoodsManager
{
    use singleton;

    /**
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAll($start = 0, $count = -1)
    {
        typeCheckNumber($start);
        typeCheckNumber($count);
        $data = [];
        //interface err_dbs_mall_storageGoodsManager_getAll

        $goods = dbs_mall_storageGoods::all([], $start, $count);

        foreach ($goods as $good) {
            $data[] = $good->toArray();
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @param $goodsName
     * @return Common_Util_ReturnVar
     */
    public function create($goodsName)
    {
        $data = [];
        //interface err_dbs_mall_storageGoodsManager_create

        typeCheckString($goodsName);

        $goods = dbs_mall_storageGoods::create($goodsName, 10, 1, 10);
        $goods->saveToDB();
        $data = $goods->toArray();
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取货物
     * @param $goodsId
     * @return dbs_mall_storageGoods
     */
    private function getGoods($goodsId)
    {

        typeCheckString($goodsId);

        $goods = dbs_mall_storageGoods::findOrNew([dbs_mall_storageGoods::DBKey_goodsId => $goodsId]);

        logicErrorCondition($goods->exist(),
            err_dbs_mall_storageGoodsManager::GOODS_NOT_EXISTS,
            "GOODS_NOT_EXISTS");
        return $goods;
    }

    /**
     * 设置货物无效
     * @param $goodsId
     * @return Common_Util_ReturnVar
     */
    public function setGoodsValid($goodsId)
    {
        $data = [];

        $goods = $this->getGoods($goodsId);

        $goods->set_valid(true);
        $goods->saveToDB();

        $data = $goods->toArray();


        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 设置货物有效
     * @param $goodsId
     * @return Common_Util_ReturnVar
     */
    public function setGoodsInvalid($goodsId)
    {
        $goods = $this->getGoods($goodsId);

        $goods->set_valid(false);
        $goods->set_onlineTime(false);
        $goods->saveToDB();

        $data = $goods->toArray();
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 发布物品
     * @param $goodsId
     * @return Common_Util_ReturnVar
     */
    public function setGoodsOnline($goodsId)
    {
        $data = [];
        $goods = $this->getGoods($goodsId);


        logicErrorCondition($goods->get_valid(),
            err_dbs_mall_storageGoodsManager_setGoodsOnline::GOODS_INVALID,
            "GOODS_INVALID");

        $productResult = $goods->productOnlineGoods();
        logicErrorCondition($productResult->is_succ(),
            err_dbs_mall_storageGoodsManager_setGoodsOnline::PRODUCTS_GOODS_ERROR,
            $productResult->get_retcode());



        return Common_Util_ReturnVar::RetSucc($data);
    }


}