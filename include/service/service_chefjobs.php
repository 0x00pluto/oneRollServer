<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/25
 * Time: 下午4:31
 */

namespace service;

use Common\Util\Common_Util_ReturnVar;
use constants\constants_returnkey;
use dbs\chef\jobs\dbs_chef_jobs_player;

/**
 * 厨师职位服务
 * Class service_chefjobs
 * @package service
 */
class service_chefjobs extends service_base
{

    /**
     * service_chefjobs constructor.
     */
    public function __construct()
    {
        $this->addFunctions([
            'getinfo',
            'fire',
            'hire',
            'changeJobChef',
            'getMainChefData'
        ]);
    }

    /**
     * @return dbs_chef_jobs_player
     */
    protected function get_dbins()
    {
        return dbs_chef_jobs_player::createWithPlayer($this->callerUserInstance);
    }

    /**
     * @inheritDoc
     */
    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_chef_jobs_player_";
    }

    /**
     * 获取信息
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {
        $data = [];
        //interface err_service_chefjobs_getinfo

        $data = $this->get_dbins()->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 解雇
     * @param string $chefId 厨师ID
     * @param int $isHired 是否是聘请过来的厨师,0不是,1是
     * @return Common_Util_ReturnVar
     */
    public function fire($chefId, $isHired)
    {
        return $this->get_dbins()->fire($chefId, $isHired);
    }

    /**
     * 雇佣
     * @param string $chefId 厨师ID
     * @param int $jobId 职位ID
     * @param int $isHired 是否是聘请过来的厨师,0不是,1是
     * @return Common_Util_ReturnVar
     */
    public function hire($chefId, $jobId, $isHired)
    {
        return $this->get_dbins()->hire($chefId, $jobId, $isHired);
    }

    /**
     * 切换厨师
     * @param $chefId
     * @param $isHired
     * @return Common_Util_ReturnVar
     */
    public function changeJobChef($chefId, $isHired)
    {
        return $this->get_dbins()->changeJobChef($chefId, $isHired);
    }

    /**
     * 获取主厨数据
     * @return Common_Util_ReturnVar
     */
    public function getMainChefData()
    {
        $data = [];
        //interface err_service_chefjobs_getMainChefData

        $chefData = $this->get_dbins()->getJobChefData();
        if (is_null($chefData)) {
            $data[constants_returnkey::RK_MAIN_CHEF_DATA] = null;
        } else {
            $data[constants_returnkey::RK_MAIN_CHEF_DATA] = $chefData->toArray();
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

}