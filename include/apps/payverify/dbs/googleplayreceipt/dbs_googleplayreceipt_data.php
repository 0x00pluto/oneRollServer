<?php

namespace apps\payverify\dbs\googleplayreceipt;

use apps\payverify\dbs\templates\googlePlay\dbs_templates_googlePlay_receiptData;

/**
 * 说明
 * 2015年8月6日 下午4:06:12
 *
 * @author zhipeng
 *
 */
class dbs_googleplayreceipt_data extends dbs_templates_googlePlay_receiptData
{

    function __construct()
    {
        parent::__construct(self::DBKey_tablename);
        $this->set_primary_key([self::DBKey_uuid]);
    }

    /**
     * 自动设置uuid
     */
    private function autoSetUUID()
    {
        $this->set_uuid(md5($this->get_receipt()));
    }


    /**
     * create function
     *
     * @param string $platformid
     * @param string $orderid
     * @param string $receipt
     * @param string $purchasedata
     * @return \apps\payverify\dbs\applereceipt\dbs_applereceipt_data
     */
    static function create($platformid, $orderid, $receipt, $purchasedata)
    {
        $ins = new static ();
        $ins->set_platformid($platformid);
        $ins->set_orderid($orderid);
        $ins->set_receipt($receipt);
        $ins->set_purchasedata($purchasedata);
        $ins->autoSetUUID();
        $ins->clearDirtyKeys();

        return $ins;
    }

    /**
     * 获取票据
     * @param $receipt
     * @return \apps\payverify\dbs\applereceipt\dbs_applereceipt_data
     */
    static function getReceipt($receipt)
    {
        return self::findOrNew([self::DBKey_uuid => md5($receipt)]);
    }
}