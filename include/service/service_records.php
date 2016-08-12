<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/3
 * Time: 下午3:17
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\mall\dbs_mall_goodsSellInfoDetail;
use dbs\records\dbs_records_acceptRecord;
use dbs\records\dbs_records_active;
use dbs\records\dbs_records_deactive;

/**
 * 中奖纪录
 * Class service_records
 * @package service
 */
class service_records extends service_base
{
    protected function configureFunctions()
    {
        $this->addFunction('getActiveRecords');
        $this->addFunction('getDeActiveRecords');
        $this->addFunction('getAcceptRecords');


        $this->addFunction('getTradeDetailsByGoods');
    }

    /**
     * 获取活动中的记录
     * @return Common_Util_ReturnVar
     */
    public function getActiveRecords()
    {
        $data = [];
        //interface err_service_records_getActiveRecords

        $data = dbs_records_active::createWithPlayer($this->callerUserInstance)->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 获取过期的记录
     * @return Common_Util_ReturnVar
     */
    public function getDeActiveRecords()
    {
        $data = [];
        $records = dbs_records_deactive::getRecords($this->callerUserInstance);
        foreach ($records as $record) {
            $data[] = $record->toArray();
        }

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取中奖记录
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAcceptRecords($start = -1, $count = 2)
    {
        $data = [];
        //interface err_service_records_getAcceptRecords


        typeCheckNumber($start);
        typeCheckNumber($count);

        $records = dbs_records_acceptRecord::getAll($this->callerUserid, $start, $count);

        foreach ($records as $record) {
            $data[$record->get_goodsId()] = $record->toArray();
        }

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取交易记录
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getTradeDetails($start = 0, $count = 10)
    {
        $data = [];
        //interface err_service_records_getTradeDetails

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取指定商品的交易记录
     * @param $goodsId
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getTradeDetailsByGoods($goodsId, $start = 0, $count = 10)
    {
        $data = [];
        //interface err_service_records_getTradeDetails


        $details = dbs_mall_goodsSellInfoDetail::all(
            [
                dbs_mall_goodsSellInfoDetail::DBKey_userid => $this->callerUserid,
                dbs_mall_goodsSellInfoDetail::DBKey_mallGoodsId => $goodsId,
            ], $start, $count);
        //code...

        foreach ($details as $detail) {
            $data[] = $detail->toArray();
        }
        return Common_Util_ReturnVar::RetSucc($data);
    }

}