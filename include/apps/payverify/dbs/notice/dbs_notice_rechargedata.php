<?php

namespace apps\payverify\dbs\notice;

use apps\payverify\dbs\templates\notice\dbs_templates_notice_receiptData;

/**
 *
 * @author zhipeng
 *
 */
class dbs_notice_rechargedata extends dbs_templates_notice_receiptData
{
    /**
     * dbs_notice_rechargedata constructor.
     */
    public function __construct()
    {
        parent::__construct(self::DBKey_tablename);
        $this->set_primary_key([self::DBKey_orderid]);
    }

    /**
     * 完成校验
     */
    public function complete_verify()
    {
        $this->set_iscompleteverify(true);
        $this->set_completetimestamp(time());
    }

    /**
     * @param $orderid
     * @param string $unique_identifier
     * @return dbs_notice_rechargedata
     */
    public static function getRechargeData($orderid)
    {
        $ins = self::findOrNew([
            self::DBKey_orderid => $orderid,
        ]);
        return $ins;

    }
}