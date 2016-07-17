<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/26
 * Time: 下午7:33
 */

namespace dbs\chef\employ;


use Common\Util\Common_Util_Time;
use dbs\chef\dbs_chef_data;
use dbs\dbs_player;
use dbs\templates\chef\employ\dbs_templates_chef_employ_employeeData;

/**
 * 雇佣厨师数据
 * Class dbs_chef_employ_employeeData
 * @package dbs\chef\employ
 */
class dbs_chef_employ_employeeData extends dbs_templates_chef_employ_employeeData
{
    /**
     * 创建厨师雇佣数据
     * @param dbs_player $employee
     * @param dbs_chef_data $employeeChefData
     * @return dbs_chef_employ_employeeData
     */
    public static function create(dbs_player $employee, dbs_chef_data $employeeChefData)
    {
        $ins = new self();
        $ins->set_userid($employee->get_userid());
        $ins->set_chefId($employeeChefData->get_guid());
        $ins->set_employTime(time());
        $ins->set_employEndTime(time() + getGlobalValue("CHEF_HIRE_TIME_MAX")->int_value());
        $ins->set_employeeChefData($employeeChefData->toArray());
        return $ins;
    }

    /**
     * 是否雇佣过期
     * @return bool
     */
    public function isExpired()
    {
        return $this->get_employEndTime() + Common_Util_Time::getDelayExpiredSecond() < time();
    }
}