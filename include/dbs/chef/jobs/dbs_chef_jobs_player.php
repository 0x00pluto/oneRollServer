<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/25
 * Time: 下午4:27
 */

namespace dbs\chef\jobs;


use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_chef_job_num_setting;
use configdata\configdata_chef_job_setting;
use constants\constants_chefjob;
use dbs\chef\dbs_chef_data;
use dbs\chef\dbs_chef_list;
use dbs\chef\employ\dbs_chef_employ_player;
use dbs\dbs_restaurantinfo;
use dbs\robot\dbs_robot_data;
use dbs\robot\dbs_robot_logicTrait;
use dbs\templates\chef\jobs\dbs_templates_chef_jobs_data;
use dbs\templates\chef\jobs\dbs_templates_chef_jobs_list;
use err\err_dbs_chef_jobs_player_changeJobChef;
use err\err_dbs_chef_jobs_player_fire;
use err\err_dbs_chef_jobs_player_hire;
use hellaEngine\exception\exception_logicError;

/**
 * 职位列表
 * Class dbs_chef_jobs_player
 * @package dbs\chef\jobs
 */
class dbs_chef_jobs_player extends dbs_templates_chef_jobs_list
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * 获取当前等级,岗位人数配置
     * @return array|null
     */
    public function getCurrentJobNumConfig()
    {
        //获取职业人数限制
        $restaurantLevel = dbs_restaurantinfo::createWithPlayer($this->db_owner)->get_restaurantlevel();

        $jobNumConfig = getConfigData(configdata_chef_job_num_setting::class,
            configdata_chef_job_num_setting::k_restaurantlevel,
            $restaurantLevel);
        return $jobNumConfig;
    }

    /**
     * 获取职业配置
     * @param $jobId
     * @return mixed
     */
    private function getJobConfig($jobId)
    {
        return getConfigData(configdata_chef_job_setting::class,
            configdata_chef_job_setting::k_jobid,
            $jobId);
    }


    /**
     * 解除厨师职位
     * @param dbs_chef_data $chefData
     * @return bool
     */
    public function fireChef(dbs_chef_data $chefData)
    {

        if ($chefData->get_currentJob() === constants_chefjob::JOB_INVALID) {
            return false;
        }
        $jobId = $chefData->get_currentJob();

        $chefList = $this->getJobList($jobId);
        if (isset($chefList[$chefData->get_guid()])) {
            unset($chefList[$chefData->get_guid()]);

            $this->setJobList($jobId, $chefList);
        }

        $chefData->set_currentJob(constants_chefjob::JOB_INVALID);

        return true;
    }

    /**
     * 解雇
     * @param string $chefId 厨师ID
     * @param int $isHired 是否是聘请过来的厨师,0不是,1是
     * @return Common_Util_ReturnVar
     */
    public function fire($chefId, $isHired)
    {
        $data = [];
        //interface err_dbs_chef_jobs_player_fire
        typeCheckGUID($chefId);
        typeCheckNumber($isHired);
        typeCheckChoice($isHired, [0, 1]);
        //code...

        $chefData = null;
        if ($isHired === 0) {
            $chefData = dbs_chef_list::createWithPlayer($this->db_owner)->get_chef($chefId);
        } else {
            $chefData = dbs_chef_employ_player::createWithPlayer($this->db_owner)->getEmployeeChefData($chefId);

        }

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_jobs_player_fire::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        logicErrorCondition($chefData->get_currentJob() !== constants_chefjob::JOB_INVALID,
            err_dbs_chef_jobs_player_fire::NOT_HIRED,
            "NOT_HIRED");
        $jobId = $chefData->get_currentJob();

        $chefList = $this->getJobList($jobId);
        unset($chefList[$chefId]);

        $this->setJobList($jobId, $chefList);

        $chefData->set_currentJob(constants_chefjob::JOB_INVALID);
        if ($isHired === 0) {
            dbs_chef_list::createWithPlayer($this->db_owner)->set_chef($chefData);
        } else {
            dbs_chef_employ_player::createWithPlayer($this->db_owner)->setEmployeeChefData($chefData);

        }

        $this->computeAllChefCharm();

        return Common_Util_ReturnVar::RetSucc($data);
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
        $data = [];
        //interface err_dbs_chef_jobs_player_hire

        typeCheckGUID($chefId);
        typeCheckNumber($jobId);
        typeCheckChoice($jobId, [1, 2, 3, 4]);
        typeCheckNumber($isHired);
        typeCheckChoice($isHired, [0, 1]);


        $jobConfig = $this->getJobConfig($jobId);
        $jobOpenLevel = intval($jobConfig[configdata_chef_job_setting::k_openlevel]);

        logicErrorCondition(dbs_restaurantinfo::createWithPlayer($this->db_owner)->get_restaurantlevel() >= $jobOpenLevel,
            err_dbs_chef_jobs_player_hire::JOB_NOT_OPEN,
            "JOB_NOT_OPEN");

        $chefData = null;
        if ($isHired === 0) {

            logicErrorCondition($jobId === 1,
                err_dbs_chef_jobs_player_hire::CANNOT_WORKING_WITH_THE_JOB,
                "CANNOT_WORKING_WITH_THE_JOB");


            $chefData = dbs_chef_list::createWithPlayer($this->db_owner)->get_chef($chefId);
        } else {

            $chefData = dbs_chef_employ_player::createWithPlayer($this->db_owner)->getEmployeeChefData($chefId);
        }

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_jobs_player_hire::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        logicErrorCondition($chefData->isAllowWork(),
            err_dbs_chef_jobs_player_hire::CHEF_STATUS_BUSYING,
            "CHEF_STATUS_BUSYING");

        $oldJobId = $chefData->get_currentJob();

        logicErrorCondition($oldJobId === constants_chefjob::JOB_INVALID,
            err_dbs_chef_jobs_player_hire::ALREADY_HIRED,
            "ALREADY_HIRED");


        $jobNumConfig = $this->getCurrentJobNumConfig();
        logicErrorCondition(!is_null($jobNumConfig),
            err_dbs_chef_jobs_player_hire::JOB_CONFIG_ERROR,
            "JOB_CONFIG_ERROR");

        $key = "joblimit" . $jobId;
        $maxNum = intval($jobNumConfig[$key]);

        $currentJobList = $this->getJobList($jobId);
        logicErrorCondition(count($currentJobList) < $maxNum,
            err_dbs_chef_jobs_player_hire::EMPLOYEE_NUM_MAX,
            "EMPLOYEE_NUM_MAX");

        $jobData = new dbs_templates_chef_jobs_data();
        $jobData->set_chefId($chefId);
        $jobData->set_startTime(time());
        $jobData->set_isHired($isHired);

        $currentJobList[$chefId] = $jobData->toArray();

        $this->setJobList($jobId, $currentJobList);
        $chefData->set_currentJob($jobId);

        if ($isHired === 0) {
            dbs_chef_list::createWithPlayer($this->db_owner)->set_chef($chefData);
        } else {
            dbs_chef_employ_player::createWithPlayer($this->db_owner)->setEmployeeChefData($chefData);
        }

        $this->computeAllChefCharm();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 获取职业列表
     * @param $jobId
     * @return mixed
     */
    private function getJobList($jobId)
    {
        return $this->{"get_job" . "$jobId" . "Chefs"}();
    }

    /**
     * 设置职业数据
     * @param $jobId
     * @param array $datas
     */
    private function setJobList($jobId, array $datas)
    {
        $this->{"set_job" . $jobId . "Chefs"}($datas);
    }


    /**
     * 获取主厨数据
     * @return null|dbs_chef_jobs_data
     */
    public function getJobChefData()
    {
        $chefs = $this->getJobList(1);
        if (empty($chefs)) {
            return null;
        }
        $hireData = dbs_chef_jobs_data::create_with_array(array_pop($chefs));
        return $hireData;
    }

    /**
     * 切换厨师
     * @param $chefId
     * @param $isHired
     * @return Common_Util_ReturnVar
     */
    public function changeJobChef($chefId, $isHired)
    {
        $data = [];
        //interface err_dbs_chef_jobs_player_changeJobChef
        typeCheckGUID($chefId);
        typeCheckNumber($isHired);
        typeCheckChoice($isHired, [0, 1]);

        //厨师职业ID
        $jobId = 1;

        $chefData = null;
        if ($isHired === 0) {
            $chefData = dbs_chef_list::createWithPlayer($this->db_owner)->get_chef($chefId);
        } else {
            $chefData = dbs_chef_employ_player::createWithPlayer($this->db_owner)->getEmployeeChefData($chefId);
        }

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_jobs_player_changeJobChef::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");


        $chefJobData = $this->getJobChefData();

        $oldChefId = null;
        if (!is_null($chefJobData)) {
            //原来位置有厨师,先执行开除操作
            $oldChefId = $chefJobData->get_chefId();

            //现任厨师和要更换的厨师不是同一人
            logicErrorCondition($oldChefId !== $chefId,
                err_dbs_chef_jobs_player_changeJobChef::CHEF_JOB_SAME,
                "CHEF_JOB_SAME");
            $this->fire($chefJobData->get_chefId(), $chefJobData->get_isHired());
        }
        //厨师原来有职业,并且不是厨师,自动开除
        if ($oldChefId !== $chefData->get_guid()
            && $chefData->get_currentJob() !== constants_chefjob::JOB_INVALID
        ) {
            $this->fire($chefId, $isHired);
        }

        //雇佣为新职业
        $this->hire($chefId, $jobId, $isHired);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 计算总魅力值
     * @param $jobId
     * @return int
     */
    private function computeChefCharm($jobId)
    {
        $jobId = intval($jobId);
        $jobDatas = $this->{"get_job" . $jobId . "Chefs"}();
        $charmValue = 0;
        foreach ($jobDatas as $jobDataArr) {
            $jobData = dbs_chef_jobs_data::create_with_array($jobDataArr);

            $chefId = $jobData->get_chefId();
            if ($jobData->get_isHired() === 0) {
                $chefData = dbs_chef_list::createWithPlayer($this->db_owner)->get_chef($chefId);
            } else {
                $chefData = dbs_chef_employ_player::createWithPlayer($this->db_owner)->getEmployeeChefData($chefId);
            }
//            dump($jobData);

//            dump($chefData);

            if (!is_null($chefData)) {
                $charmValue += $chefData->getFashionDressData()->get_charmvalue();
            }
        }
        return $charmValue;
    }

    /**
     * 计算总共的魅力值
     */
    private function computeAllChefCharm()
    {
        $charmValues = [];
        for ($i = 1; $i <= 4; $i++) {
            $charmValues[$i] = $this->computeChefCharm($i);

        }
        $this->set_totalCharms($charmValues);
    }


    /**
     * 通过职业ID,获取该职业所有任职人员的魅力值总和
     * @param $jobId 1-4
     * @return int
     */
    public function getChefCharmByJobId($jobId)
    {
        $jobId = intval($jobId);
        $allCharms = $this->get_totalCharms();
        if (isset($allCharms[$jobId])) {
            return $allCharms[$jobId];
        }
        return 0;
    }

    /**
     * @inheritDoc
     */
    function masterbeforecall()
    {
        $this->computeAllChefCharm();
    }

    use dbs_robot_logicTrait;

    /**
     * @inheritDoc
     */
    public function processRobotLogic(dbs_robot_data $robotData)
    {

        $chefs = dbs_chef_list::createWithPlayer($this->db_owner)->get_cheflist();
        foreach ($chefs as $chefId => $chefData) {
            try {
                $this->changeJobChef($chefId, 0);
                break;
            } catch (exception_logicError $e) {

            }
        }

//        $this->changeJobChef();
    }


}