<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/2
 * Time: 下午4:49
 */

namespace dbs\records;


trait dbs_records_operation_trait
{
    /**
     * @param dbs_records_recordData $data
     */
    public function addRecord(dbs_records_recordData $data)
    {
        $records = $this->get_records();
        /**
         * @var dbs_records_recordData $record
         */
        $record = $data;

        if (isset($records[$data->get_GoodsId()])) {

            $record = dbs_records_recordData::create_with_array($records[$data->get_GoodsId()]);
            $record->merge($data);
        }

        $records[$record->get_GoodsId()] = $record->toArray();
        $this->set_records($records);
    }


    /**
     * @param $goodsId
     * @return null|dbs_records_recordData
     */
    public function getRecordData($goodsId)
    {
        $records = $this->get_records();
        if (isset($records[$goodsId])) {

            $record = dbs_records_recordData::create_with_array($records[$goodsId]);
            return $record;
        }
        return null;
    }

    /**
     * 删除记录
     * @param $goodsId
     * @return null|dbs_records_recordData
     */
    public function removeRecord($goodsId)
    {
        $records = $this->get_records();
        if (isset($records[$goodsId])) {

            $record = dbs_records_recordData::create_with_array($records[$goodsId]);
            unset($records[$goodsId]);
            $this->set_records($records);
            return $record;
        }
        return null;
    }
}