<?php

namespace apps\payverify\dbs\applereceipt;

use apps\payverify\constants\configure;
use apps\payverify\dbs\notice\dbs_notice_rechargedata;
use apps\payverify\dbs\receipt\dbs_receipt_center;
use apps\payverify\err\err_dbs_applereceipt_center_verify;
use Common\Util\Common_Util_Http;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_platformtype;

class dbs_applereceipt_center extends dbs_receipt_center
{
    /**
     * @inheritDoc
     */
    protected function initializing()
    {
        $this->addAllowPlatform(constants_platformtype::APPSTORE);
    }

    /**
     * 获取所有票据
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getall()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();


        $allReceipts = dbs_applereceipt_data::all();
        dump($allReceipts);


        // code

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }


    /**
     * 校验苹果订单
     *
     * @param string $platformid
     *            平台di
     * @param string $orderid
     *            订单id
     * @param string $receipt
     *            票据数据
     * @param integer $rmbNum
     *            金额 分
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function verify($platformid, $orderid, $receipt, $rmbNum)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $platformid = intval($platformid);
        $orderid = strval($orderid);
        $receipt = strval($receipt);
        $rmbNum = intval($rmbNum);


        logicErrorCondition($this->isAllowPlatform($platformid),
            err_dbs_applereceipt_center_verify::PLATFORM_NOT_ALLOW,
            "PLATFORM_NOT_ALLOW");

        $appleReceiptData = dbs_applereceipt_data::getReceipt($receipt);
        if ($appleReceiptData->exist()) {
            $retCode = err_dbs_applereceipt_center_verify::ALREADY_VERIFIED;
            $retCode_Str = 'ALREADY_VERIFIED';
            goto failed;
        } else {
            $appleReceiptData = dbs_applereceipt_data::create($platformid, $orderid, $receipt);
            $appleReceiptData->saveToDB();
        }


        $receipt = json_encode([
            "receipt-data" => $receipt
        ]);

        $url = C(configure::APPLE_VERIFY_URL);

        $response = Common_Util_Http::http($url, $receipt, "POST");
        if ($response ['http_code'] != 200) {
            $retCode = err_dbs_applereceipt_center_verify::HTTP_CODE_200;
            $retCode_Str = 'HTTP_CODE_200';
            goto failed;
        }
        $returnCodeJson = json_decode($response ['response'], true);
//        dump($retcodejson);

        if ($returnCodeJson ["status"] != 0) {
            $retCode = err_dbs_applereceipt_center_verify::VERIFY_STATUS_ERROR;
            $retCode_Str = 'VERIFY_STATUS_ERRPR';
            goto failed;
        }

        $receiptData = $returnCodeJson ['receipt'];

        $rechargeData = dbs_notice_rechargedata::getRechargeData($orderid);
        logicErrorCondition(!$rechargeData->exist(),
            err_dbs_applereceipt_center_verify::RECHARGE_VERIFY_DATA_EXISTS,
            "RECHARGE_VERIFY_DATA_EXISTS");

        $rechargeData = new dbs_notice_rechargedata();
        $rechargeData->set_appid('1');
        $rechargeData->set_money($rmbNum);
        $rechargeData->set_platformid($platformid);
        $rechargeData->set_orderid($orderid);
        $rechargeData->set_goodsid($receiptData ['product_id']);
        $rechargeData->set_goodsnum($receiptData ['quantity']);
        $rechargeData->set_rechargetime($receiptData ['original_purchase_date_ms']);
        $rechargeData->set_extinfo($receiptData);
        $rechargeData->set_unique_identifier($receiptData ['unique_identifier']);
        $rechargeData->saveToDB();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}