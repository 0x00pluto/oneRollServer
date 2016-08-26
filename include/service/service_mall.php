<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 下午11:14
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\advertisement\dbs_advertisement_advertisement;
use dbs\mall\dbs_mall_goodsSellInfoDetail;
use dbs\mall\dbs_mall_manger;
use dbs\mall\dbs_mall_onlineGoods;

/**
 * 商城接口
 * Class service_mall
 * @package service
 */
class service_mall extends service_base
{
    function isNeedLogin()
    {
        return false;
    }

    protected function configureFunctions()
    {
        $this->addFunction('getAll');
        $this->addFunction('getGoodsInfo');
        $this->addFunction('getGoodsInfos');
        $this->addFunction('getGoodsByStorageId');

        $this->addFunction('getAllSellingGoods');
        $this->addFunction('getAllSellingGoodsByStorageId');
        $this->addFunction('getAllSellingGoodsByBigKindId');
        $this->addFunction('getAllWaitLotteryGoods');
        $this->addFunction('getAllFinishGoods');


        $this->addFunction('getAllAdvertisements');
        $this->addFunction('getAllTradeDetailsByGoodsId');
    }

    /**
     * 获取所有道具
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAll($start = -1, $count = 2)
    {
        $data = [];
        $manager = new dbs_mall_manger();
        return $manager->getAll($start, $count);
    }


    /**
     * 获取商品详情
     * @param $goodsId
     * @return Common_Util_ReturnVar
     */
    public function getGoodsInfo($goodsId)
    {
        $data = [];
        //interface err_service_mall_getGoodsInfo
        typeCheckString($goodsId);
        $goodsData = dbs_mall_onlineGoods::getGoods($goodsId);
        if ($goodsData->exist()) {
            $data = $goodsData->toArray();
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取一系列商品的详细信息
     * @param $goodsIds
     * @return Common_Util_ReturnVar
     */
    public function getGoodsInfos($goodsIds)
    {
        $data = [];

        typeCheckJsonString($goodsIds);
        //interface err_service_mall_getGoodsInfos

        $ids = json_decode($goodsIds, true);

        typeCheckArray($ids);

        foreach ($ids as $mallId) {
            $goodsData = dbs_mall_onlineGoods::getGoods($mallId);
            if ($goodsData->exist()) {
                $data[] = $goodsData->toArray();
            }
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @param $storageGoodsId
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getGoodsByStorageId($storageGoodsId, $start = 0, $count = 10)
    {
        $data = [];
        //interface err_service_mall_getGoodsByStorageId

        $allGoods = dbs_mall_onlineGoods::allGoodsByStorageId($storageGoodsId, $start, $count);
        foreach ($allGoods as $goods) {
            $data[] = $goods->toArray();
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @param $storageGoodsId
     * @return Common_Util_ReturnVar
     */
    public function getAllSellingGoodsByStorageId($storageGoodsId)
    {
        $data = [];
        typeCheckString($storageGoodsId, 64);
        //interface err_service_mall_getAllSellingGoodsByStorageId
        $allGoods = dbs_mall_onlineGoods::allSellingGoodsByStorageId($storageGoodsId);
        foreach ($allGoods as $goods) {
            $data = $goods->toArray();
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * @param $bigKindId
     * @param $start
     * @param $count
     * @return Common_Util_ReturnVar
     */
    public function getAllSellingGoodsByBigKindId($bigKindId, $start, $count)
    {
        $data = [];
        typeCheckNumber($bigKindId);
        typeCheckNumber($start);
        typeCheckNumber($count);
        //interface err_service_mall_getAllSellingGoodsByBigKindId
        $allGoods = dbs_mall_onlineGoods::allSellingGoodsByBigKindId($bigKindId, $start, $count);
        foreach ($allGoods as $goods) {
            $data[] = $goods->toArray();
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 获取所有销售中的货物
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAllSellingGoods($start = 0, $count = -1)
    {
        return dbs_mall_manger::getInstance()->getAllSellingGoods($start, $count);
    }

    /**
     * @return Common_Util_ReturnVar
     */
    public function getAllWaitLotteryGoods()
    {
        return dbs_mall_manger::getInstance()->getAllWaitLotteryGoods();
    }

    /**
     * 获取所有开完奖的货物
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAllFinishGoods($start = 0, $count = -1)
    {
        return dbs_mall_manger::getInstance()->getAllFinishGoods($start, $count);
    }


    /**
     * @return Common_Util_ReturnVar
     */
    public function getAllAdvertisements()
    {
        $data = [];
        //interface err_service_mall_getAllAdvertisements

        $advertisements = dbs_advertisement_advertisement::all();

        foreach ($advertisements as $advertisement) {
            $data[] = $advertisement->toArray();
        }


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @param $goodsId
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAllTradeDetailsByGoodsId($goodsId, $start = 0, $count = 10)
    {
        $data = [];
        //interface err_service_mall_getAllTradeByGoodsId

        $details = dbs_mall_goodsSellInfoDetail::all(
            [
                dbs_mall_goodsSellInfoDetail::DBKey_mallGoodsId => $goodsId,
            ], $start, $count);
        //code...

        foreach ($details as $detail) {
            $data[] = $detail->toArray();
        }

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * @return Common_Util_ReturnVar
     */
    public function lottery()
    {
        $data = [];
        //interface err_service_mall_lottery

        dbs_mall_manger::lottery();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

}