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
use hellaEngine\utils\runtime\utils_runtime_result;

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
        $this->setAutoSave(false);
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
     * 货物完成销售
     * @return bool
     */
    function goodsIsFinishSell()
    {
        $mallGoodsData = dbs_mall_mallGoodsData::create_with_array($this->get_mallGoodsData());
        return !$mallGoodsData->isStatus(constants_mallGoodsData::STATUS_SELLING);
    }

    /**
     * 生成下一件在线物品
     */
    function productNextOnlineGoods()
    {
        if (!$this->goodsIsFinishSell()) {
            return utils_runtime_result::createFail('goods_is_selling');
        }
        $storageGoods = dbs_mall_storageGoods::getGoods($this->get_storageGoodsId());
        if (!$storageGoods->exist()) {
            return utils_runtime_result::createFail('storage_goods_not_exists');
        }
        return $storageGoods->productOnlineGoods();
    }


    /**
     * @param dbs_mall_storageGoods $goods
     * @return dbs_mall_onlineGoods
     */
    static function newGoods(dbs_mall_storageGoods $goods)
    {
        $mallGoodsData = dbs_mall_mallGoodsData::create($goods);
        $ins = new self();
        $ins->set_id($mallGoodsData->get_id());
        $ins->set_storageGoodsId($goods->get_goodsId());
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
     * @param $storageGoodsId
     * @return static[]
     */
    static function allSellingGoodsByStorageId($storageGoodsId)
    {
        $key = self::DBKey_mallGoodsData . "." . dbs_mall_mallGoodsData::DBKey_status;

        $goods = self::all([
            $key => constants_mallGoodsData::STATUS_SELLING,
            self::DBKey_storageGoodsId => $storageGoodsId
        ]);
        return $goods;
    }

    /**
     * @param int $bigKindId
     * @param int $start
     * @param int $count
     * @return static[]
     */
    static function allSellingGoodsByBigKindId($bigKindId, $start = 0, $count = 10)
    {

        $key = join(".", [
            self::DBKey_mallGoodsData,
            dbs_mall_mallGoodsData::DBKey_goodsNormalInfo,
            dbs_mall_goodsNormalInfo::DBKey_kindBigId
        ]);

        $statusKey = join(".", [
            self::DBKey_mallGoodsData,
            dbs_mall_mallGoodsData::DBKey_status,
        ]);

        $goods = self::all([
            $key => $bigKindId,
            $statusKey => constants_mallGoodsData::STATUS_SELLING
        ], $start, $count);
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
     * @param int $start
     * @param int $count
     * @return static[]
     */
    static function allFinishGoods($start = 0, $count = 10)
    {
        $key = self::DBKey_mallGoodsData . "." . dbs_mall_mallGoodsData::DBKey_status;
        $sortKey = join(".",
            [
                self::DBKey_mallGoodsData,
                dbs_mall_mallGoodsData::DBKey_goodsRollResult,
                dbs_mall_goodsRollResult::DBKey_rollTime
            ]);

        $goods = self::all([$key => constants_mallGoodsData::STATUS_FINISH], $start, $count,
            [
                $sortKey => -1
            ]);
        return $goods;
    }


    /**
     * @param $storageId
     * @param int $start
     * @param int $count
     * @return static[]
     */
    static function allGoodsByStorageId($storageId, $start = 0, $count = 10)
    {
        $key = self::DBKey_storageGoodsId;

        $goods = self::all([$key => $storageId], $start, $count);
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