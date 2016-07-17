<?php

namespace apps\payverify\dbs\applereceipt;

use apps\payverify\dbs\templates\apple\dbs_templates_apple_receiptData;

/**
 * 说明
 * 2015年8月6日 下午4:06:12
 *
 * @author zhipeng
 *
 */
class dbs_applereceipt_data extends dbs_templates_apple_receiptData
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
     * @return \apps\payverify\dbs\applereceipt\dbs_applereceipt_data
     */
    static function create($platformid, $orderid, $receipt)
    {
        $ins = new self ();
        $ins->set_platformid($platformid);
        $ins->set_orderid($orderid);
        $ins->set_receipt($receipt);
        $ins->autoSetUUID();

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