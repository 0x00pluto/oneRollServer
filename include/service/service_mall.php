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
    protected function configureFunctions()
    {
        $this->addFunction('getAll');
        $this->addFunction('buy');
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
        //interface err_service_mall_getAll
        $manager = new dbs_mall_manger();
        return $manager->getAll($start, $count);
    }

    /**
     * @param $mallId
     * @param $num
     * @return Common_Util_ReturnVar
     */
    public function buy($mallId, $num = 1)
    {
        $manager = new dbs_mall_manger();
        return $manager->buy(
            $this->callerUserInstance,
            $mallId,
            $num);
    }

}