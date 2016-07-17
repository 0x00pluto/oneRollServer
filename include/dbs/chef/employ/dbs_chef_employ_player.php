<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/26
 * Time: 下午3:07
 */

namespace dbs\chef\employ;


use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_chef_employee_setting;
use configdata\configdata_restaurant_level_setting;
use constants\constants_chefjob;
use constants\constants_mailactiontype;
use constants\constants_mailTemplates;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\chef\dbs_chef_data;
use dbs\chef\dbs_chef_list;
use dbs\chef\jobs\dbs_chef_jobs_player;
use dbs\dbs_mission;
use dbs\dbs_player;
use dbs\dbs_restaurantinfo;
use dbs\dbs_role;
use dbs\filters\dbs_filters_role;
use dbs\mailbox\dbs_mailbox_data;
use dbs\templates\chef\employ\dbs_templates_chef_employ_data;
use err\err_dbs_chef_employ_player_acceptRequest;
use err\err_dbs_chef_employ_player_cancelRequest;
use err\err_dbs_chef_employ_player_fireChef;
use err\err_dbs_chef_employ_player_refuseAllRequest;
use err\err_dbs_chef_employ_player_refuseRequest;
use err\err_dbs_chef_employ_player_sendRequest;
use hellaEngine\exception\exception_logicError;

class dbs_chef_employ_player extends dbs_templates_chef_employ_data
{

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * 获取已经发送出去的请求
     * @param $requestId
     * @return null|dbs_chef_employ_request
     */
    public function getSendRequestData($requestId)
    {
        $requests = $this->get_sendRequests();
        if (!isset($requests[$requestId])) {
            return null;
        }
        return dbs_chef_employ_request::create_with_array($requests[$requestId]);

    }


    /**
     * 设置自己已经发送出去的厨师请求
     * @param dbs_chef_employ_request $data
     */
    public function setSendRequestData(dbs_chef_employ_request $data)
    {
        $requests = $this->get_sendRequests();
        $requests[$data->get_requestId()] = $data->toArray();
        $this->set_sendRequests($requests);
    }


    /**
     * 删除已经发送出去的请求
     * @param $requestId
     */
    public function deleteSendRequestData($requestId)
    {
        $requests = $this->get_sendRequests();
        unset($requests[$requestId]);
        $this->set_sendRequests($requests);
    }

    /**
     * 获取可雇佣员工的最大数量
     * @return int
     */
    public function getEmployeeMax()
    {
        $config = getConfigData(configdata_restaurant_level_setting::class,
            configdata_restaurant_level_setting::k_level,
            dbs_restaurantinfo::createWithPlayer($this->db_owner)->get_restaurantlevel());

        return intval($config[configdata_restaurant_level_setting::k_employeechefnum]);
    }

    /**
     * 雇员是否已经满了
     * @return bool
     */
    public function isEmployeeFull()
    {
        return $this->getEmployeeMax() <= count($this->get_employees());
    }

    /**
     * 雇佣厨师
     * @param dbs_chef_employ_employeeData $data
     */
    private function employChef(dbs_chef_employ_employeeData $data)
    {
        $employees = $this->get_employees();
        $employees[$data->get_chefId()] = $data->toArray();
        $this->set_employees($employees);
    }

    /**
     * 获取雇员数据
     * @param $chefId
     * @return null|dbs_chef_employ_employeeData
     */
    public function getEmployeeData($chefId)
    {
        $employees = $this->get_employees();
        if (isset($employees[$chefId])) {
            return dbs_chef_employ_employeeData::create_with_array($employees[$chefId]);
        }
        return null;
    }

    /**
     * 获取雇佣厨师信息
     * @param $chefId
     * @return null|dbs_chef_data
     */
    public function getEmployeeChefData($chefId)
    {
        $employeeData = $this->getEmployeeData($chefId);
        if (is_null($employeeData)) {
            return null;
        }
        return dbs_chef_data::create_with_array($employeeData->get_employeeChefData());
    }

    /**
     * 设置雇佣的厨师数据
     * @param dbs_chef_data $data
     * @return bool
     */
    public function setEmployeeChefData(dbs_chef_data $data)
    {
        $employeeData = $this->getEmployeeData($data->get_guid());
        if (is_null($employeeData)) {
            return false;
        }
        $employeeData->set_employeeChefData($data->toArray());
        $this->employChef($employeeData);
        return true;
    }

    /**
     * 删除雇员信息
     * @param $chefId
     */
    private function deleteEmployeeData($chefId)
    {
        $employees = $this->get_employees();
        if (isset($employees[$chefId])) {
            unset($employees[$chefId]);
            $this->set_employees($employees);
        }
    }

    /**
     * 发送雇佣请求
     * @param string $destUserId 目标用户ID
     * @param string $destChefId 目标厨师ID
     * @param int $presentType 0游戏币,1钻石
     * @param int $presentValue 聘礼数量
     * @return Common_Util_ReturnVar
     */
    public function sendRequest($destUserId, $destChefId, $presentType, $presentValue)
    {
        $data = [];

        typeCheckUserId($destUserId);
        typeCheckUserId($destChefId);
        typeCheckNumber($presentType);
        typeCheckChoice($presentType, [0, 1]);
        typeCheckNumber($presentValue, 0);


        logicErrorCondition($destUserId !== $this->get_userid(),
            err_dbs_chef_employ_player_sendRequest::CANNOT_HIRE_SELF,
            "CANNOT_HIRE_SELF");

        $destPlayer = dbs_player::newGuestPlayerWithLock($destUserId);
        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_chef_employ_player_sendRequest::DEST_USER_NOT_EXISTS,
            "DEST_USER_NOT_EXISTS");

        $chefData = dbs_chef_list::createWithPlayer($destPlayer)->get_chef($destChefId);
        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_employ_player_sendRequest::DEST_CHEF_NOT_EXISTS,
            "DEST_CHEF_NOT_EXISTS");

        //厨师不能被雇佣
        logicErrorCondition($chefData->isAllowEmployed(),
            err_dbs_chef_employ_player_sendRequest::DEST_CHEF_CANNOT_EMPLOYED,
            "DEST_CHEF_CANNOT_EMPLOYED");

        //雇佣信息
        $employData = $chefData->getEmployData();

        $requestId = dbs_chef_employ_request::createRequestId($this->get_userid(),
            $destUserId, $destChefId);

        $requestData = $this->getSendRequestData($requestId);
        logicErrorCondition(is_null($requestData),
            err_dbs_chef_employ_player_sendRequest::ALREADY_SEND_REQUEST,
            "ALREADY_SEND_REQUEST");

        //判断礼物
        $employConfig = getConfigData(configdata_chef_employee_setting::class,
            configdata_chef_employee_setting::k_cheflevel,
            $chefData->get_level());

        //创建请求
        $requestData = dbs_chef_employ_request::create($this->get_userid(),
            $destUserId, $destChefId);

        if ($presentType === 0) {
            logicErrorCondition($presentValue >= intval($employConfig[configdata_chef_employee_setting::k_gamecoin]),
                err_dbs_chef_employ_player_sendRequest::PRESENT_VALUE_ERROR,
                "PRESENT_VALUE_ERROR");

            logicErrorCondition(dbs_role::createWithPlayer($this->db_owner)->get_gamecoin() >= $presentValue,
                err_dbs_chef_employ_player_sendRequest::NOT_ENOUGH_PRESENT,
                "NOT_ENOUGH_PRESENT");

            $requestData->set_presentGameCoin($presentValue);

        } else {
            logicErrorCondition($presentValue >= intval($employConfig[configdata_chef_employee_setting::k_diamond]),
                err_dbs_chef_employ_player_sendRequest::PRESENT_VALUE_ERROR,
                "PRESENT_VALUE_ERROR");

            logicErrorCondition(dbs_role::createWithPlayer($this->db_owner)->get_diamond() >= $presentValue,
                err_dbs_chef_employ_player_sendRequest::NOT_ENOUGH_PRESENT,
                "NOT_ENOUGH_PRESENT");

            $requestData->set_presentDiamond($presentValue);
        }


        //扣钱
        if ($presentType === 0) {
            dbs_role::createWithPlayer($this->db_owner)->cost_gamecoin($presentValue, constants_moneychangereason::HIRE_CHEF);
        } else {
            dbs_role::createWithPlayer($this->db_owner)->cost_diamond($presentValue, constants_moneychangereason::HIRE_CHEF);
        }

        //保存到自己的请求列表中
        $this->setSendRequestData($requestData);
        //保存到对方厨师请求列表中
        $employData->setRequestData($requestData);


        $chefData->setEmployData($employData);
        dbs_chef_list::createWithPlayer($destPlayer)->set_chef($chefData);

        //邮件通知对方
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::HIRE_CHEF_REQUEST_WITH_PRESENT,
            [
                'requestData' => $requestData->toArray(),
                'chefData' => $chefData->toArray()
            ],
            $this->get_userid())->send($destUserId);


        $data[constants_returnkey::RK_REQUEST] = $requestData->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 取消请求
     * @param $requestId
     * @return Common_Util_ReturnVar
     */
    public function cancelRequest($requestId)
    {
        $data = [];
        //interface err_dbs_chef_employ_player_cancelRequest

        typeCheckGUID($requestId);

        $requestData = $this->getSendRequestData($requestId);

        logicErrorCondition(!is_null($requestData),
            err_dbs_chef_employ_player_cancelRequest::REQUEST_NOT_EXISTS,
            "REQUEST_NOT_EXISTS");

        //归还聘礼
        dbs_role::createWithPlayer($this->db_owner)->add_gamecoin_and_diamonds($requestData->get_presentGameCoin(),
            $requestData->get_presentDiamond(),
            constants_moneychangereason::CANCEL_EMPLOY_CHEF_REQUEST, false);

        //删除对方数据
        $destPlayer = dbs_player::newGuestPlayerWithLock($requestData->get_toUserId());
        $destChef = dbs_chef_list::createWithPlayer($destPlayer)->get_chef($requestData->get_toChefId());
        $destEmployData = $destChef->getEmployData();
        $destEmployData->deleteRequest($requestId);
        $destChef->setEmployData($destEmployData);
        dbs_chef_list::createWithPlayer($destPlayer)->set_chef($destChef);

        //删除自己请求数据
        $this->deleteSendRequestData($requestId);

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 拒绝单个请求
     * @param string $chefId 厨师ID
     * @param string $requestId 请求ID
     * @return Common_Util_ReturnVar
     */
    public function refuseRequest($chefId, $requestId)
    {
        $data = [];
        //interface err_dbs_chef_employ_player_refuseRequest

        typeCheckGUID($chefId);
        typeCheckGUID($requestId);

        $chefData = dbs_chef_list::createWithPlayer($this->db_owner)->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_employ_player_refuseRequest::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $employData = $chefData->getEmployData();

        $requestData = $employData->getRequestData($requestId);
        logicErrorCondition(!is_null($requestData),
            err_dbs_chef_employ_player_refuseRequest::REQUEST_NOT_EXISTS,
            "REQUEST_NOT_EXISTS");

        $employData->refuseRequest($requestId);
        $chefData->setEmployData($employData);

        dbs_chef_list::createWithPlayer($this->db_owner)->set_chef($chefData);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 拒绝所有请求
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function refuseAllRequest($chefId)
    {
        $data = [];
        //interface err_dbs_chef_employ_player_refuseAllRequest
        typeCheckGUID($chefId);

        $chefData = dbs_chef_list::createWithPlayer($this->db_owner)->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_employ_player_refuseAllRequest::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $employData = $chefData->getEmployData();
        $employData->refuseAllRequest();
        $chefData->setEmployData($employData);
        dbs_chef_list::createWithPlayer($this->db_owner)->set_chef($chefData);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 接收请求
     * @param string $chefId 厨师ID
     * @param string $requestId 请求ID
     * @return Common_Util_ReturnVar
     */
    public function acceptRequest($chefId, $requestId)
    {
        $data = [];
        //interface err_dbs_chef_employ_player_acceptRequest

        $chefData = dbs_chef_list::createWithPlayer($this->db_owner)->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_employ_player_acceptRequest::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $employData = $chefData->getEmployData();

        $requestData = $employData->getRequestData($requestId);
        logicErrorCondition(!is_null($requestData),
            err_dbs_chef_employ_player_acceptRequest::REQUEST_NOT_EXISTS,
            "REQUEST_NOT_EXISTS");

        logicErrorCondition($chefData->isAllowEmployed(),
            err_dbs_chef_employ_player_acceptRequest::CHEF_IS_CANNOT_EMPLOYED,
            "CHEF_IS_CANNOT_EMPLOYED");


        $employerPlayer = dbs_player::newGuestPlayerWithLock($requestData->get_fromUserId());
        $employerChefEmployer = dbs_chef_employ_player::createWithPlayer($employerPlayer);

        //雇主的可雇佣厨师已经满了
        logicErrorCondition(!$employerChefEmployer->isEmployeeFull(),
            err_dbs_chef_employ_player_acceptRequest::EMPLOYER_CHEF_FULL,
            "EMPLOYER_CHEF_FULL");


        //开始雇佣操作

        //雇员数据
        //copy出来的数据副本
        $chefDataEmployee = dbs_chef_data::create_with_array($chefData->toArray());
        //雇员补满体力
        $chefDataEmployee->fillVitToFull();
        //清空职业
        $chefDataEmployee->set_currentJob(constants_chefjob::JOB_INVALID);
        //清空职业状态
        //对于雇主来说,这个厨师本身不是雇佣状态
        $chefDataEmployee->setStatusFree();
        //重置雇佣数据
        $chefDataEmployee->reset_employData();

        //设置雇员的雇佣信息
        $employData = $chefDataEmployee->getEmployData();
        $employData->employed($requestData->get_fromUserId());
        $chefDataEmployee->setEmployData($employData);


        //雇主身上的雇员数据
        $employeeData = dbs_chef_employ_employeeData::create($this->db_owner,
            $chefDataEmployee);
        //设置雇佣厨师
        $employerChefEmployer->employChef($employeeData);
        //删除原始请求
        $employerChefEmployer->deleteSendRequestData($requestId);
        //自动雇佣为迎宾
        dbs_chef_jobs_player::createWithPlayer($employerPlayer)->hire($chefDataEmployee->get_guid(),
            3, 1);

        //设置我自己厨师状态
        //接收聘礼
        dbs_role::createWithPlayer($this->db_owner)->add_gamecoin_and_diamonds($requestData->get_presentGameCoin(),
            $requestData->get_presentDiamond(), constants_moneychangereason::HIRE_CHEF);

        //拒绝其它人的请求
        $employData->deleteRequest($requestId);
        $employData->refuseAllRequest();


        $employData->employed($requestData->get_fromUserId());
        $chefData->setEmployData($employData);
        //设置被雇佣
        $chefData->setStatusEmployed();
        //如果有任职,清除任职
        if ($chefData->get_currentJob() !== constants_chefjob::JOB_INVALID) {
            dbs_chef_jobs_player::createWithPlayer($this->db_owner)->fireChef($chefData);
        }
        //保存厨师数据
        dbs_chef_list::createWithPlayer($this->db_owner)->set_chef($chefData);

        //发送邮件通知对方
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::HIRE_CHEF_REQUEST_ACCEPT,
            ['chefData' => $chefData->toArray()], $this->get_userid())
            ->send($employerPlayer->get_userid());

        //完成任务
        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_37, 1);
        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_40, 1);

        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_38,
            $requestData->get_presentDiamond());

        //成功聘请,发送请求方
        dbs_mission::createWithPlayer($employerPlayer)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_41,
            1);
        dbs_mission::createWithPlayer($employerPlayer)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_39,
            1);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 开除厨师
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function fireChef($chefId)
    {
        $data = [];
        //interface err_dbs_chef_employ_player_fireChef

        typeCheckGUID($chefId);

        $chefEmployeeData = $this->getEmployeeData($chefId);

        logicErrorCondition(!is_null($chefEmployeeData),
            err_dbs_chef_employ_player_fireChef::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        //删除员工如果有任职,需要先清空任职
        $chefEmployeeChefData = dbs_chef_data::create_with_array($chefEmployeeData->get_employeeChefData());
        if ($chefEmployeeChefData->get_currentJob() !== constants_chefjob::JOB_INVALID) {
            dbs_chef_jobs_player::createWithPlayer($this->db_owner)->fire($chefId, 1);
        }

        //删除员工
        $this->deleteEmployeeData($chefId);

        //还原雇员状态
        $employeePlayer = dbs_player::newGuestPlayerWithLock($chefEmployeeData->get_userid());
        $employeeChefData = dbs_chef_list::createWithPlayer($employeePlayer)->get_chef($chefId);
        //还原雇佣信息
        $employeeChefData->reset_employData();
        $employeeChefData->setStatusFree();
        //清空体力
        $employeeChefData->clearVitToEmpty();
        dbs_chef_list::createWithPlayer($employeePlayer)->set_chef($employeeChefData);


        //通知我自己厨师离开
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::HIRE_CHEF_GO_HOME,
            [
                'chefData' => $chefEmployeeChefData->toArray()
            ],
            $employeePlayer->get_userid())
            ->send($this->get_userid());

        //通知对方厨师他自己的厨师已经回去了
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::HIRE_CHEF_GO_BACK,
            [
                'employUserInfo' => dbs_filters_role::getVerySimpleInfo($this->db_owner),
                'chefData' => $chefEmployeeChefData->toArray()
            ])
            ->send($employeePlayer->get_userid());

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 自动开除过期雇员
     */
    private function autoFireExpiredEmployee()
    {
        $employees = $this->get_employees();
        foreach ($employees as $chefId => $employee) {
            $employeeData = dbs_chef_employ_employeeData::create_with_array($employee);
            if ($employeeData->isExpired()) {
                try {
                    $this->fireChef($chefId);
                } catch (exception_logicError $e) {

                }
            }
        }
    }

    /**
     *
     */
    private function autoProcessExpiredRequests()
    {
        /**
         * 处理我发出去的过期请求
         */
        $requests = $this->get_sendRequests();
        foreach ($requests as $requestId => $request) {
            $requestData = dbs_chef_employ_request::create_with_array($request);
            if ($requestData->isExpired()) {
                dbs_mailbox_data::createWithStandardId(constants_mailTemplates::HIRE_CHEF_REQUEST_EXPIRED, [
                    'requestData' => $requestData->toArray()
                ], $requestData->get_toUserId())->send($this->get_userid());

                $this->cancelRequest($requestId);
            }
        }

    }

    /**
     * @inheritDoc
     */
    function masterbeforecall()
    {
        $this->autoFireExpiredEmployee();

        $this->autoProcessExpiredRequests();
    }


}