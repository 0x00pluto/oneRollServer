<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 下午10:48
 */

namespace dbs\mall;


use Common\Util\Common_Util_ReturnVar;
use constants\constants_mallGoodsData;
use constants\constants_moneychangereason;
use dbs\dbs_player;
use dbs\dbs_role;
use dbs\records\dbs_records_active;
use dbs\records\dbs_records_recordData;
use err\err_dbs_mall_manger_buy;
use hellaEngine\utils\singleton;

/**
 * Class dbs_mall_manger
 * @package dbs\mall
 */
class dbs_mall_manger
{
    use singleton;

    /**
     * 获取所有商品
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAll($start = -1, $count = -1)
    {
        $data = [];
        //interface err_dbs_mall_manger_getAll

        typeCheckNumber($start);
        typeCheckNumber($count);
        $allGoods = dbs_mall_onlineGoods::all([], $start, $count);
        foreach ($allGoods as $Goods) {
            $data[] = $Goods->toArray();
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
        $data = [];
        typeCheckNumber($start);
        typeCheckNumber($count);

        $allGoods = dbs_mall_onlineGoods::allSellingGoods($start, $count);
        foreach ($allGoods as $Goods) {
            $data[] = $Goods->toArray();
        }

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @return Common_Util_ReturnVar
     */
    public function getAllWaitLotteryGoods()
    {
        $data = [];

        $allGoods = dbs_mall_onlineGoods::allWaitLotteryGoods(0, -1);
        foreach ($allGoods as $Goods) {
            $data[] = $Goods->toArray();
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 获取所有开完奖的货物
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAllFinishGoods($start = 0, $count = -1)
    {
        $data = [];
        typeCheckNumber($start);
        typeCheckNumber($count);

        $allGoods = dbs_mall_onlineGoods::allFinishGoods($start, $count);
        foreach ($allGoods as $Goods) {
            $data[] = $Goods->toArray();
        }

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * @param dbs_player $player
     * @param $mallId
     * @param $num
     * @return Common_Util_ReturnVar
     */
    public function buy(dbs_player $player, $mallId, $num = 1)
    {
        $data = [];
        //interface err_dbs_mall_manger_buy
        typeCheckGUID($mallId);
        typeCheckNumber($num, 1);
        //TODO:此处需要锁一下

        $goods = dbs_mall_onlineGoods::findOrNew(
            [
                dbs_mall_onlineGoods::DBKey_id => $mallId
            ]);

        logicErrorCondition($goods->exist(),
            err_dbs_mall_manger_buy::GOODS_NOT_EXISTS,
            "GOODS_NOT_EXISTS");

        $mallGoodsData = dbs_mall_mallGoodsData::create_with_array($goods->get_mallGoodsData());

        logicErrorCondition($mallGoodsData->isStatus(constants_mallGoodsData::STATUS_SELLING),
            err_dbs_mall_manger_buy::GOODS_IS_NOT_SELLING,
            "GOODS_IS_NOT_SELLING");

        logicErrorCondition($mallGoodsData->get_selloutrollCount() + $num <= $mallGoodsData->get_rollCount(),
            err_dbs_mall_manger_buy::GOODS_NOT_ENOUGH,
            "GOODS_NOT_ENOUGH");

        //钻石不足
        $needDiamonds = $mallGoodsData->get_eachRollPrice() * $num;
        logicErrorCondition(dbs_role::createWithPlayer($player)->get_diamond() >=
            $needDiamonds,
            err_dbs_mall_manger_buy::DIAMOND_NOT_ENOUGH,
            "DIAMOND_NOT_ENOUGH");

        //获取购买产生的中奖号码
        list($rollCodes) = $mallGoodsData->sell($player, $num);

        //创建购买记录
        $record = dbs_records_recordData::create($mallGoodsData, $rollCodes);
        $goods->set_mallGoodsData($mallGoodsData->toArray());
        $goods->saveToDB();

        dbs_records_active::createWithPlayer($player)->addRecord($record);
        dbs_role::createWithPlayer($player)->cost_diamond($needDiamonds, constants_moneychangereason::MALL_BUY, $mallId);

        //完成销售,生产下一期的物品

        $nextProductGoodsResult = $goods->productNextOnlineGoods();
//        dump($nextProductGoodsResult->toArray());

        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 开奖
     */
    static public function lottery()
    {

        //获取所有需要开奖的商品

        $allGoods = dbs_mall_onlineGoods::allWaitLotteryGoods(0, -1);


        foreach ($allGoods as $goods) {

            /**
             * @var $goods dbs_mall_onlineGoods
             */
            if ($goods->lottery()) {
                //开奖成功
                $goods->saveToDB();
            } else {
                //开奖失败
            }
        }
    }


}