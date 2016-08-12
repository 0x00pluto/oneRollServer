<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/11
 * Time: 上午11:24
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\mall\dbs_mall_manger;
use dbs\mall\dbs_mall_remoteRollNum;
use hellaEngine\schedule\schedule;
use servicemiddle\servicemiddle_iplimits;

/**
 * schedule
 * Class service_schedule
 * @package service
 */
class service_schedule extends service_base
{
    function isNeedLogin()
    {
        return false;
    }

    protected function configure()
    {
        parent::configure(); //
        $this->registerMiddleWare(new servicemiddle_iplimits([
            "127.0.0.1/24",
            "192.168.0.1/24",
            "114.254.144.1/24"
        ]));
    }

    protected function configureFunctions()
    {
        $this->addFunction("schedule");
    }

    /**
     * schedule function
     * @return Common_Util_ReturnVar
     */
    public function schedule()
    {
        $data = [];
        //interface err_service_schedule_schedule

        //获取远程彩票数据
        schedule::run('*/1 * * * * *', function () {
            if (dbs_mall_remoteRollNum::getNewestRemoteRollNum()) {

            } else {

            }
        });

        //开奖倒计时
        schedule::run('*/1 * * * * *', function () {
            dbs_mall_manger::lottery();
        });


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


}