<?php

namespace apps\payverify\dbs\notice;

use apps\payverify\err\err_dbs_notice_center_check;
use Common\Util\Common_Util_ReturnVar;

/**
 * 说明
 * 2015年8月6日 下午3:09:36
 *
 * @author zhipeng
 *
 */
class dbs_notice_center
{

    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
        // echo 'This is a Constructed method;';
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    /**
     *
     * @return \apps\payverify\dbs\notice\dbs_notice_center
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof static)) {
            self::$_instance = new static ();
        }
        return self::$_instance;
    }

    /**
     * 获取所有的订单
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getall()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_noticecenter_getall{}


        $rechargeDatas = dbs_notice_rechargedata::all();

        foreach ($rechargeDatas as $rechargeData) {
            $data[] = $rechargeData->toArray();
        }
//        dump($datas);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }


    /**
     * 校验订单
     *
     * @param string $orderid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function check($orderid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_notice_center_check{}
        $orderid = strval($orderid);
        $rechargeData = dbs_notice_rechargedata::getRechargeData($orderid);
        if (!$rechargeData->exist()) {
            $retCode = err_dbs_notice_center_check::RECHARGE_DATA_NOT_EXIST;
            $retCode_Str = 'RECHARGE_DATA_NOT_EXIST:' . $orderid;
            goto failed;
        }

        if ($rechargeData->get_iscompleteverify()) {
            $retCode = err_dbs_notice_center_check::ALREADY_VERIFYED;
            $retCode_Str = 'ALREADY_VERIFYED';
            goto failed;
        }

        $rechargeData->complete_verify();
        $data = $rechargeData->toArray();
        $rechargeData->saveToDB();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}