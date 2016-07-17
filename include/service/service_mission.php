<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use constants\constants_mission;

/**
 * 任务服务
 *
 * @author zhipeng
 *
 */
class service_mission extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'missioncompleteachievement',
            'missioncomplete',
            'missioncompleteconditionusediamond'
        ));
        $this->addFunction('test', true);
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->db_mission();
    }

    /**
     * 获取任务基础信息
     *
     * @return Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_mission_getinfo{}

        $data = $this->callerUserInstance->db_mission()->toArray();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 测试函数
     *
     * @param unknown $param
     * @return Common_Util_ReturnVar
     */
    function test()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_mission_test{}

        $this->callerUserInstance->db_mission()->set_mission_object(100, 1);

        $data = $this->callerUserInstance->db_mission()->toArray();
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 完成普通任务
     *
     * @param string $missionid
     */
    function missioncomplete($missionid)
    {
        typeCheckString($missionid, 32);
        $missionid = strval($missionid);

        return $this->callerUserInstance->db_mission()->missioncomplete($missionid, constants_mission::MISSION_TYPE_NORMAL);
    }

    /**
     * 完成成就
     *
     * @param 任务id $missionid
     */
    function missioncompleteachievement($missionid)
    {
        typeCheckString($missionid, 32);
        $missionid = strval($missionid);

        return $this->callerUserInstance->db_mission()->missioncomplete($missionid, constants_mission::MISSION_TYPE_ACHIEVEMENT);
    }

    /**
     * 使用钻石完整任务条件
     *
     * @param 任务id $missionid
     * @param 条件位置 $conditionposition
     *            1,2,3
     * @return Common_Util_ReturnVar
     */
    function missioncompleteconditionusediamond($missionid, $conditionposition)
    {
        typeCheckString($missionid, 32);
        typeCheckChoice(intval($conditionposition), [
            1,
            2,
            3
        ]);
        return $this->get_dbins()->missioncompleteconditionusediamond($missionid, $conditionposition, constants_mission::MISSION_TYPE_NORMAL);
    }
}