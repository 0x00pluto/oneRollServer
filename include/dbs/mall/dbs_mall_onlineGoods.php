<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 下午11:03
 */

namespace dbs\mall;


use constants\constants_mallGoodsData;
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
     * 开奖
     * @return \hellaEngine\utils\runtime\utils_runtime_result
     */
    public function lottery()
    {

        $mallGoodsData = dbs_mall_mallGoodsData::create_with_array($this->get_mallGoodsData());

        $lotteryResult = $mallGoodsData->lottery();
//        dump($lotteryResult->toArray());
        //开奖失败
        if (!$lotteryResult->is_succ()) {
            return $lotteryResult;
        }

        //开奖成功
        //保存到数据库
        $this->set_mallGoodsData($mallGoodsData->toArray());


        return $lotteryResult;
    }

    /**
     * @return bool
     */
    function goodsIsFinish()
    {
        $mallGoodsData = dbs_mall_mallGoodsData::create_with_array($this->get_mallGoodsData());
        return $mallGoodsData->isStatus(constants_mallGoodsData::STATUS_FINISH);

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

    /**
     * @param int $start
     * @param int $count
     * @return static[]
     */
    static function allSellingGoods($start = 0, $count = 10)
    {
        $key = self::DBKey_mallGoodsData . "." . dbs_mall_mallGoodsData::DBKey_status;

        $goods = self::all([$key => constants_mallGoodsData::STATUS_SELLING], $start, $count);
        return $goods;
    }

    /**
     * @param int $start
     * @param int $count
     * @return static[]
     */
    static function allWaitLotteryGoods($start = 0, $count = 10)
    {
        $key = self::DBKey_mallGoodsData . "." . dbs_mall_mallGoodsData::DBKey_status;

        $goods = self::all([$key => constants_mallGoodsData::STATUS_WAIT_ROLL], $start, $count);
        return $goods;
    }

    /**
     * @param $goodsId
     * @return static
     */
    static function getGoods($goodsId)
    {
        return self::findOrNew([self::DBKey_id => $goodsId]);
    }


}