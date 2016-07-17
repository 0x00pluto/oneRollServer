<?php

namespace apps\payverify\dbs\googleplayreceipt;

use apps\payverify\constants\configure;
use apps\payverify\dbs\notice\dbs_notice_rechargedata;
use apps\payverify\dbs\receipt\dbs_receipt_center;
use apps\payverify\err\err_dbs_googleplayreceipt_center_verify;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_platformtype;

class dbs_googleplayreceipt_center extends dbs_receipt_center
{
    /**
     * @inheritDoc
     */
    protected function initializing()
    {
        $this->addAllowPlatform(constants_platformtype::GOOGLEPLAY);
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
        // class err_dbs_applereceiptcenter_getall{}

        $datas = dbs_googleplayreceipt_data::all();

        dump($datas);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 校验GooglePlay
     *
     * @param string $platformid
     *            平台di
     * @param string $orderid
     *            订单id
     * @param string $receipt
     *            票据数据
     * @param integer $rmbnum
     *            金额 分
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function verify($platformid, $orderid, $receipt, $rmbnum, $purchasedata)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        // $receipt = 'nAyIiDYLV58Vud+XjqiAk0QNG86kgYnAVlOf10JixT0G1iFlnEMvXhvM2OSZ66WE5EmrxaQb5i6DzqRyqnbWYluN1X2LrPngRPhTX7qFTrUCo/dDptynEUPbMoDCYpJU5c8eVHpegs5W+OLrHN++UGIychciRYUIFr1JEx3K+Q3S7gpV//OuWmRxUlh/ikwjukxjYyFFFdQm9LxXpWxJwgaNFSBIUhbCfx+/5UJP5pRslBFAdsqG+KUfoxlZYYXgbpMrDpui3HhCLpTJcl5ZPLSy7vLrwlmzk5oAjle4olSKs5J0rcy08jQSIy3GYBkNdOHWzOG6VT8qy84y6pH7iQ==';
        // $purchasedata = '{"orderId":"GPA.1332-6961-9389-16560","packageName":"com.tomatofun.ctgame","productId":"com.tomatofuns.ctgame.item120","purchaseTime":1446714914427,"purchaseState":0,"purchaseToken":"hjailgjbekicncipgdelbeli.AO-J1OwYsdaRZGMfxpUT6105272L9b8nY8Vszgr9It2rtQF6pC6OaeOR0GytwDBzR3Ln11vro1Z3K3eCyNh-ZZIyd0ni8m_JjUK_9cJB7vLOdlqcSz2DxtDzBBfYP2O0lt140KycfF8q1363GmK9kqwlRUjyvQMc8A"}';

        $platformid = intval($platformid);
        $orderid = strval($orderid);
        $receipt = strval($receipt);
        $rmbnum = intval($rmbnum);
        $purchasedata = strval($purchasedata);
        // class err_dbs_applereceiptcenter_verify{}

        logicErrorCondition($this->isAllowPlatform($platformid),
            err_dbs_googleplayreceipt_center_verify::PLATFORM_NOT_ALLOW,
            "PLATFORM_NOT_ALLOW");

        $googlePlayReceiptData = dbs_googleplayreceipt_data::getReceipt($receipt);
        logicErrorCondition(!$googlePlayReceiptData->exist(),
            err_dbs_googleplayreceipt_center_verify::ALREADY_VERIFIED,
            "ALREADY_VERIFIED");
        $googlePlayReceiptData = dbs_googleplayreceipt_data::create($platformid, $orderid, $receipt, $purchasedata);
        $googlePlayReceiptData->saveToDB();

        $in_app_purchase_data = $purchasedata;
        $in_app_data_signature = $receipt;
        $google_public_key = C(configure::GOOGLE_PUBLIC_KEY);
        $public_key = "-----BEGIN PUBLIC KEY-----\n" . chunk_split($google_public_key, 64, "\n") . "-----END PUBLIC KEY-----";

        $public_key_handle = openssl_get_publickey($public_key);
        $signature = base64_decode($in_app_data_signature);
        $result = openssl_verify($in_app_purchase_data, $signature, $public_key_handle, OPENSSL_ALGO_SHA1);


        if (1 !== $result) {
            $retCode = err_dbs_googleplayreceipt_center_verify::VERIFY_STATUS_ERROR;
            $retCode_Str = 'VERIFY_STATUS_ERROR';
            goto failed;
        }

        // goto succ;

        // 记录数据
        // $applereceiptdata->mark_dirty();
        $googlePlayReceiptData->saveToDB(true);
        // code
        $receiptdata = json_decode($purchasedata, true);

        $rechargeData = new dbs_notice_rechargedata ();
        $rechargeData->set_appid('1');
        $rechargeData->set_money($rmbnum);
        $rechargeData->set_platformid($platformid);
        $rechargeData->set_orderid($orderid);
        $rechargeData->set_goodsid($receiptdata ['productId']);
        $rechargeData->set_goodsnum(1);
        $rechargeData->set_rechargetime($receiptdata ['purchaseTime']);
        $rechargeData->set_extinfo($receiptdata);
        $rechargeData->set_unique_identifier($receiptdata ['orderId']);
        $rechargeData->saveToDB();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}