<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/12
 * Time: 下午12:35
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\mall\dbs_mall_storageGoodsManager;

/**
 * 库存管理函数
 * Class service_storageGoodsManager
 * @package service
 */
class service_storageGoodsManager extends service_base
{


    protected function configureFunctions()
    {
        $this->addFunction('getAll');
        $this->addFunction('create');

        $this->addFunction('setGoodsValid');
        $this->addFunction("setGoodsInvalid");

        $this->addFunction('setGoodsOnline');
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_mall_storageGoodsManager" . "_";
    }


    /**
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAll($start = 0, $count = -1)
    {
        return dbs_mall_storageGoodsManager::getInstance()->getAll($start, $count);
    }

    /**
     * @param $goodsName
     * @return Common_Util_ReturnVar
     */
    public function create($goodsName)
    {
        return dbs_mall_storageGoodsManager::getInstance()->create($goodsName);
    }

    /**
     * 设置货物无效
     * @param $goodsId
     * @return Common_Util_ReturnVar
     */
    public function setGoodsValid($goodsId)
    {
        return dbs_mall_storageGoodsManager::getInstance()->setGoodsValid($goodsId);
    }

    /**
     * 设置货物有效
     * @param $goodsId
     * @return Common_Util_ReturnVar
     */
    public function setGoodsInvalid($goodsId)
    {
        return dbs_mall_storageGoodsManager::getInstance()->setGoodsInvalid($goodsId);
    }

    /**
     * 发布物品
     * @param $goodsId
     * @return Common_Util_ReturnVar
     */
    public function setGoodsOnline($goodsId)
    {
        return dbs_mall_storageGoodsManager::getInstance()->setGoodsOnline($goodsId);
    }
}