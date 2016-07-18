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
    }

    /**
     * 获取所有道具
     * @return Common_Util_ReturnVar
     */
    public function getAll()
    {
        $data = [];
        //interface err_service_mall_getAll
        $manager = new dbs_mall_manger();
        return $manager->getAll();
    }

}