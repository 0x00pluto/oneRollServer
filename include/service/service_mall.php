<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 下午11:14
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\mall\dbs_mall_manger;

/**
 * 商城接口
 * Class service_mall
 * @package service
 */
class service_mall extends service_base
{
    function isNeedLogin()
    {
        return false;
    }

    protected function configureFunctions()
    {
        $this->addFunction('getAll');

        $this->addFunction('getAllSellingGoods');
        $this->addFunction('getAllWaitLotteryGoods');
        $this->addFunction('getAllFinishGoods');


//        $this->addTestFunction('lottery');
    }

    /**
     * 获取所有道具
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAll($start = -1, $count = 2)
    {
        $data = [];
        $manager = new dbs_mall_manger();
        return $manager->getAll($start, $count);
    }

    /**
     * 获取所有销售中的货物
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAllSellingGoods($start = 0, $count = -1)
    {
        return dbs_mall_manger::getInstance()->getAllSellingGoods($start, $count);
    }

    /**
     * @return Common_Util_ReturnVar
     */
    public function getAllWaitLotteryGoods()
    {
        return dbs_mall_manger::getInstance()->getAllWaitLotteryGoods();
    }

    /**
     * 获取所有开完奖的货物
     * @param int $start
     * @param int $count
     * @return Common_Util_ReturnVar
     */
    public function getAllFinishGoods($start = 0, $count = -1)
    {
        return dbs_mall_manger::getInstance()->getAllFinishGoods($start, $count);
    }


    /**
     * @return Common_Util_ReturnVar
     */
    public function lottery()
    {
        $data = [];
        //interface err_service_mall_lottery

        dbs_mall_manger::lottery();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

}