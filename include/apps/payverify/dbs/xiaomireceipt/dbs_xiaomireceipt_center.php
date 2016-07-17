<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/5/31
 * Time: 上午11:33
 */

namespace apps\payverify\dbs\xiaomireceipt;


use apps\payverify\dbs\notice\dbs_notice_rechargedata;
use apps\payverify\dbs\receipt\dbs_receipt_center;
use apps\payverify\err\err_dbs_applereceipt_center_verify;
use apps\payverify\err\err_dbs_xiaomireceipt_center_verify;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_platformtype;

class dbs_xiaomireceipt_center extends dbs_receipt_center
{
    /**
     * @inheritDoc
     */
    protected function initializing()
    {
        $this->addAllowPlatform(constants_platformtype::XIAOMI);
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


        $allReceipts = dbs_xiaomireceipt_data::all();
        dump($allReceipts);


        // code

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }


    /**
     * 小米订单
     *
     * @param string $platformid
     *            平台di
     * @param string $orderid
     *            订单id
     * @param string $receiptString
     *            票据数据
     * @param integer $rmbNum
     *            金额 分
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function verify($platformid, $orderid, $receiptString)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $platformid = intval($platformid);
        $orderid = strval($orderid);
        $receiptString = strval($receiptString);
//        $rmbNum = intval($rmbNum);


        logicErrorCondition($this->isAllowPlatform($platformid),
            err_dbs_applereceipt_center_verify::PLATFORM_NOT_ALLOW,
            "PLATFORM_NOT_ALLOW");

        /**
         * {
         * "signature": "eb30240cff8c66f856ec0e48354aa670b8cf037f",
         * "uid": "100010",
         * "appId": 2882303761517239300,
         * "cpOrderId": "9786bffc-996d-4553-aa33-f7e92c0b29d5",
         * "productCode": "com.demo_1",
         * "orderStatus": "TRADE_SUCCESS",
         * "productName": "%E9%93%B6%E5%AD%901%E4%B8%A4",
         * "productCount": 1,
         * "orderConsumeType": "10",
         * "orderId": "21140990160359583390",
         * "payFee": 1,
         * "payTime": "2014-09-05 15:20:27"
         * }
         */
        //TODO 支付文档地址http://dev.xiaomi.com/doc/p=3295/index.html

        /**
         * @var array
         */
        $rechargeOriginData = json_decode($receiptString, true);
        logicErrorCondition($rechargeOriginData !== false,
            err_dbs_xiaomireceipt_center_verify::VERIFY_STATUS_ERROR,
            "VERIFY_STATUS_ERROR");

        logicErrorCondition($rechargeOriginData['orderStatus'] === 'TRADE_SUCCESS',
            err_dbs_xiaomireceipt_center_verify::VERIFY_STATUS_ERROR,
            "VERIFY_STATUS_ERROR");


        $receiptData = dbs_xiaomireceipt_data::getReceipt($rechargeOriginData['orderId']);
        logicErrorCondition(!$receiptData->exist(),
            err_dbs_xiaomireceipt_center_verify::RECHARGE_VERIFY_DATA_EXISTS,
            "ALREADY_VERIFIED");

        $receiptData = dbs_xiaomireceipt_data::create($platformid, $orderid, $rechargeOriginData['orderId'], $receiptString);
        //保存票据
        $receiptData->saveToDB(true);

        //生成充值ID
        $rechargeId = md5("xiaomi_".$receiptData->get_uuid());
        $rechargeData = dbs_notice_rechargedata::getRechargeData($rechargeId);


        logicErrorCondition(!$rechargeData->exist(),
            err_dbs_xiaomireceipt_center_verify::RECHARGE_VERIFY_DATA_EXISTS,
            "RECHARGE_VERIFY_DATA_EXISTS");




        $rechargeData = new dbs_notice_rechargedata();
        $rechargeData->set_appid($rechargeOriginData['appId']);
        $rechargeData->set_money($rechargeOriginData['payFee']);
        $rechargeData->set_platformid($platformid);
        $rechargeData->set_orderid($orderid);
        $rechargeData->set_goodsid($rechargeOriginData ['productCode']);
        $rechargeData->set_goodsnum($rechargeOriginData ['productCount']);
        $rechargeData->set_rechargetime($rechargeOriginData ['payTime']);
        $rechargeData->set_extinfo($rechargeOriginData);
        $rechargeData->set_unique_identifier($rechargeOriginData ['signature']);
        $rechargeData->saveToDB();

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }

}