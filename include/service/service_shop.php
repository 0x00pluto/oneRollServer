<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_shop;
use dbs\dbs_shopitem;
use dbs\shop\dbs_shop_player;

/**
 * 商店接口
 *
 * @author zhipeng
 *
 */
class service_shop extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'getallgoods',
            'buy',
            'getbuyinfo'
        ));
    }

    /**
     * 获取商店信息,主要是全服限购,全服每日限购信息
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_shop_getinfo{}

        $dbs_shop = new dbs_shop ();
        $dbs_shop->loadFromDB();
        $dbsitemlimits = $dbs_shop->getShopItems();

        foreach ($dbsitemlimits as $key => $dbsitemlimit) {
            /**
             * @var dbs_shopitem $dbsitemlimit
             */
            $data [$dbsitemlimit->get_mallid()] = $dbsitemlimit->toArray();
        }

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取所有的商品列表
     */
    public function getallgoods()
    {
        $retCode = 0;

        $dbs_shop = new dbs_shop ();
        $dbs_shop->loadFromDB();
        $data = $dbs_shop->getGoods();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
    }

    /**
     * 购买道具
     *
     * @param string $mallid
     *            道具id
     * @param int $num
     *            数量
     * @return Common_Util_ReturnVar
     */
    public function buy($mallid, $num = 1)
    {

        typeCheckString($mallid, 32);
        typeCheckNumber($num, 1);

        $dbs_shop = new dbs_shop ();
        $dbs_shop->loadFromDB();
        return $dbs_shop->buyGoods($this->callerUserInstance, $mallid, $num);
    }

    /**
     * 获取自己的购买信息
     * @return Common_Util_ReturnVar
     */
    public function getbuyinfo()
    {
        $retCode = 0;
        // code
        $data = dbs_shop_player::createWithPlayer($this->callerUserInstance)->toArray();
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
    }
}