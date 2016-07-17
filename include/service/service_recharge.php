<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 充值服务
 *
 * @author zhipeng
 *
 */
class service_recharge extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'verifyorderappstore',
            'verifyordergoogleplay',
            'createorder'
        ));
        $this->addFunction('verifyorder');
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_recharge_player();
    }

    protected function get_err_class_name()
    {
        return "err_dbs_recharge_player_";
    }

    /**
     * 获取信息
     *
     * @return Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_recharge_getinfo{}

        // $quickaccount = dbs_thirdparty_userinfo::createwithlinkuserid ( $this->callerUserid );
        // $quickaccount->dumpDB ();

        $data = $this->get_dbins()->toArray();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 校验苹果数据
     *
     * @param string $orderid
     *            本地订单编号
     * @param string $receipt
     *            校验码
     * @return Common_Util_ReturnVar
     */
    function verifyorderappstore($orderid, $receipt)
    {
        typeCheckGUID($orderid);
        typeCheckString($receipt);
        return $this->get_dbins()->verifyorderappstore($orderid, $receipt);
    }

    /**
     * 校验GooglePlay数据
     *
     * @param string $orderid
     *            本地订单编号
     *
     * @param string $purchasedata
     *            订单数据
     * @param string $signature
     *            校验码
     * @return Common_Util_ReturnVar
     */
    function verifyordergoogleplay($orderid, $purchasedata, $signature)
    {
        typeCheckGUID($orderid);
        return $this->get_dbins()->verifyordergoogleplay($orderid, $purchasedata, $signature);
    }

    /**
     * 创建订单
     *
     * @param string $goodsid
     * @return Common_Util_ReturnVar
     */
    function createorder($goodsid)
    {
        typeCheckString($goodsid);
        return $this->get_dbins()->createorder($goodsid);
    }

    /**
     * 校验订单
     *
     * @param unknown $orderid
     */
    function verifyorder($orderid)
    {
        typeCheckGUID($orderid);
        return $this->get_dbins()->verifyorder($orderid);
    }
}