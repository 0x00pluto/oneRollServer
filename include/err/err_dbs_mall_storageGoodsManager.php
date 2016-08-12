<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/12
 * Time: 下午2:12
 */

namespace err;


class err_dbs_mall_storageGoodsManager
{
    const GOODS_NOT_EXISTS = 1;
}

class err_dbs_mall_storageGoodsManager_setGoodsInvalid extends err_dbs_mall_storageGoodsManager
{

}

class err_dbs_mall_storageGoodsManager_setGoodsValid extends err_dbs_mall_storageGoodsManager
{

}

class err_dbs_mall_storageGoodsManager_setGoodsOnline extends err_dbs_mall_storageGoodsManager
{
    /**
     * 货物无效
     */
    const GOODS_INVALID = 10;
    /**
     * 货物已经上线
     */
    const GOODS_ALREADY_ONLINE = 11;

    /**
     * 生产货物错误
     */
    const PRODUCTS_GOODS_ERROR = 12;

}