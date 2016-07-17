<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/25
 * Time: 下午5:17
 */

namespace err;


class err_dbs_chef_jobs_player_changeJob
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;
    /**
     * 不能任职该职业
     */
    const CANNOT_WORKING_WITH_THE_JOB = 2;

    /**
     * 要切换的职业,和原来的职业相同
     */
    const JOB_SAME = 3;
}

class err_dbs_chef_jobs_player_fire
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;
    /**
     * 没有被雇佣了
     */
    const NOT_HIRED = 2;
}

class err_dbs_chef_jobs_player_hire
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;
    /**
     * 厨师已经被雇佣了
     */
    const ALREADY_HIRED = 2;

    /**
     * 雇员数量已经最大了
     */
    const EMPLOYEE_NUM_MAX = 3;

    /**
     * 配置错误
     */
    const JOB_CONFIG_ERROR = 4;

    /**
     * 不能任职该职业
     */
    const CANNOT_WORKING_WITH_THE_JOB = 5;

    /**
     * 厨师繁忙,不能任职
     */
    const CHEF_STATUS_BUSYING = 6;
    /**
     * 职位没有开启
     */
    const JOB_NOT_OPEN = 7;
}

class err_dbs_chef_jobs_player_changeJobChef
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;

    /**
     * 厨师职业相同
     */
    const CHEF_JOB_SAME = 2;
}