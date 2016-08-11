<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 下午11:14
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use Cron\CronExpression;
use dbs\mall\dbs_mall_manger;
use hellaEngine\schedule\schedule;

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


        $this->addTestFunction('lottery');
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

        $cron = CronExpression::factory('*/2 * * * * *');
        dump($cron->isDue());

        dump(new schedule());


        dump($cron->getNextRunDate()->format('Y-m-d H:i:s'));


//        $currentTime = explode('.', number_format(Common_Util_Time::getCurrenttime(), 3));
//        dump($currentTime);

//        $date = new \DateTime();
//        dump(intval($date->format("His") . end($currentTime)));

//        dump(end(explode('.', number_format(Common_Util_Time::getCurrenttime(), 3))));

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