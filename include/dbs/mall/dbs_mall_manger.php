<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 下午10:48
 */

namespace dbs\mall;


use Common\Util\Common_Util_Http;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_mall;
use dbs\dbs_player;
use dbs\records\dbs_records_active;
use dbs\records\dbs_records_recordData;
use dbs\storage\dbs_storage_globalValue;
use err\err_dbs_mall_manger_buy;

class dbs_mall_manger
{

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
//        $allGoods = dbs_mall_onlineGoods::allWaitLotteryGoods($start, $count);
        foreach ($allGoods as $Goods) {
            $data[] = $Goods->toArray();
        }

//        $dbs_mall_recent_buy = self::getRecentBuy();

//        dump($dbs_mall_recent_buy->getTotalRollTimeSpan());
//
//        self::getRemoteRollNum();


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
        typeCheckNumber($num);
        //TODO:此处需要锁一下
        //TODO:需要扣钱

        $goods = dbs_mall_onlineGoods::findOrNew(
            [
                dbs_mall_onlineGoods::DBKey_id => $mallId
            ]);

        logicErrorCondition($goods->exist(),
            err_dbs_mall_manger_buy::GOODS_NOT_EXISTS,
            "GOODS_NOT_EXISTS");

        $mallGoodsData = dbs_mall_mallGoodsData::create_with_array($goods->get_mallGoodsData());
//        logicErrorCondition($goods->get_mallGoodsData())

        logicErrorCondition($mallGoodsData->get_selloutCount() < $mallGoodsData->get_count(),
            err_dbs_mall_manger_buy::GOODS_NOT_ENOUGH,
            "GOODS_NOT_ENOUGH");

        //创建购买记录
//        $mallSellInfo = dbs_mall_goodsSellInfo::create_with_array($mallGoodsData->get_goodsSellInfo());
//        $mallSellInfo->createCode($player, $num);


        list($rollCodes) = $mallGoodsData->sell($player, $num);

        $record = dbs_records_recordData::create($mallGoodsData, $rollCodes);

//        dump($mallGoodsData->toArray());
//        dump($rollCodes);
        //code...


        $goods->set_mallGoodsData($mallGoodsData->toArray());
        $goods->saveToDB();

        dbs_records_active::createWithPlayer($player)->addRecord($record);

        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * @return dbs_mall_recentBuy
     */
    static function getRecentBuy()
    {
        return dbs_mall_recentBuy::create_with_array(dbs_storage_globalValue::getValue(constants_mall::RECENT_BUY, []));
    }

    /**
     * 获取最新的重庆时时彩 彩票数据
     * @return bool
     */
    static public function getNewestRemoteRollNum()
    {
        $response = Common_Util_Http::http("http://f.apiplus.cn/cqssc-1.json");

        if ($response['http_code'] = 200) {
            $jsonData = json_decode($response['response'], true);
            dbs_mall_remoteRollNum::saveCqsscData($jsonData);
            return true;
        }
        return false;
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
            } else {
                //开奖失败
            }
        }
    }

    static public function getRemoteRollNum()
    {
        $response = Common_Util_Http::http("http://f.apiplus.cn/cqssc-1.json");

        if ($response['http_code'] = 200) {
            $jsonData = json_decode($response['response'], true);
            dump($jsonData);


            $caipaiData = $jsonData["data"][0];

            dump($caipaiData);


            dbs_mall_remoteRollNum::saveCqsscData($jsonData);

        }
//        dump($response);


        dbs_mall_remoteRollNum::getRemoteRollId(time() + 8 * 60 * 60);

    }

}