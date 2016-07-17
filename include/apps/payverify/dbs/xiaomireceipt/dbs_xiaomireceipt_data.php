<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/5/31
 * Time: 上午11:39
 */

namespace apps\payverify\dbs\xiaomireceipt;


use apps\payverify\dbs\templates\xiaomi\dbs_templates_xiaomi_receiptData;

class dbs_xiaomireceipt_data extends dbs_templates_xiaomi_receiptData
{

    /**
     * dbs_xiaomireceipt_data constructor.
     */
    public function __construct()
    {
        parent::__construct(self::DBKey_tablename);
    }


    /**
     * @param $platformid
     * @param $orderid
     * @param $xiaomiOrderId
     * @param $receiptString
     * @return static
     */
    static function create($platformid, $orderid, $xiaomiOrderId, $receiptString)
    {
        $ins = new static ();
        $ins->set_platformid($platformid);
        $ins->set_orderid($orderid);
        $ins->set_receiptString($receiptString);
        $ins->set_uuid($xiaomiOrderId);
        $ins->clearDirtyKeys();

        return $ins;
    }

    /**
     * 获取票据
     * @param $xiaomiOrderId
     * @return dbs_xiaomireceipt_data
     */
    static function getReceipt($xiaomiOrderId)
    {
        return self::findOrNew([self::DBKey_uuid => $xiaomiOrderId]);
    }
}