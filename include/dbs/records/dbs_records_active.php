<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/2
 * Time: 下午4:41
 */

namespace dbs\records;


use dbs\mall\dbs_mall_goodsRollResult;
use dbs\mall\dbs_mall_mallGoodsData;
use dbs\mall\dbs_mall_onlineGoods;
use dbs\templates\records\dbs_templates_records_active;

class dbs_records_active extends dbs_templates_records_active
{
    use dbs_records_operation_trait;

    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);

    }

    private function processAllRecords()
    {
        $records = $this->get_records();

        foreach ($records as $goodsId => $recordData) {
            $mall_onlineGoods = dbs_mall_onlineGoods::getGoods($goodsId);
            if ($mall_onlineGoods->goodsIsFinish()) {
//                dump($goodsId);
                $record = dbs_records_recordData::create_with_array($recordData);
                $mallGoodsData = dbs_mall_mallGoodsData::create_with_array($mall_onlineGoods->get_mallGoodsData());
                $goodsRollResult = dbs_mall_goodsRollResult::create_with_array($mallGoodsData->get_goodsRollResult());
                if ($this->get_userid() == $goodsRollResult->get_luckUserId()) {
                    $record->set_isWin(true);
                } else {
                    $record->set_isWin(false);
                }

                $deactiveRecord = dbs_records_deactive::create($this->db_owner, $record);
                $deactiveRecord->saveToDB();

                //生成中奖兑换信息
                if ($record->get_isWin()) {
                    $acceptRecord = dbs_records_acceptRecord::create($deactiveRecord);
                    $acceptRecord->saveToDB();
                }


                $this->removeRecord($goodsId);
            }
        }

//        dump($records);
    }

    function masterbeforecall()
    {
        $this->processAllRecords();
    }


}