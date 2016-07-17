<?php

namespace dbs\mission;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Log;
use configdata\configdata_mission_completecondition_setting;
use configdata\configdata_mission_setting;
use dbs\dbs_mission;
use dbs\templates\mission\dbs_templates_mission_missionData;

class dbs_mission_data extends dbs_templates_mission_missionData
{

    /**
     * @param $missionId
     * @return dbs_mission_data
     */
    public static function create($missionId)
    {
        $ins = new self();
        $ins->set_missionId($missionId);
        $ins->set_acceptTime(time());
        return $ins;
    }


    /**
     * 完成任务
     *
     * @param string $conditionId
     * @param array $newValues
     *            条件值数组
     * @return bool
     */
    public function missionComplete($conditionId, array $newValues)
    {
        $conditionId = strval($conditionId);
        $missionConf = dbs_mission::getMissionConfig($this->get_missionId());
        if (is_null($missionConf)) {
            return false;
        }
        $succ = false;
        if (!$this->get_iscompletevalue1() &&
            isset($missionConf[configdata_mission_setting::k_completeconditionid1]) &&
            $conditionId == $missionConf [configdata_mission_setting::k_completeconditionid1]
        ) {
            $completeValue = $this->missionCompleteGetValue($conditionId,
                $missionConf [configdata_mission_setting::k_completeconditionvalue1],
                $this->get_completevalue1(),
                $newValues);

//            dump([$this->get_missionId(), $conditionId, $newValues]);

            $this->set_completevalue1($completeValue ['value']);
            $this->set_iscompletevalue1($completeValue ['complete']);


            $succ = true;
        } elseif (!$this->get_iscompletevalue2() &&
            isset($missionConf[configdata_mission_setting::k_completeconditionid2]) &&
            $conditionId == $missionConf [configdata_mission_setting::k_completeconditionid2]
        ) {
            $completeValue = $this->missionCompleteGetValue($conditionId,
                $missionConf [configdata_mission_setting::k_completeconditionvalue2],
                $this->get_completevalue2(),
                $newValues);


            $this->set_completevalue2($completeValue ['value']);
            $this->set_iscompletevalue2($completeValue ['complete']);
            $succ = true;

        } elseif (!$this->get_iscompletevalue3() &&
            isset($missionConf[configdata_mission_setting::k_completeconditionid3]) &&
            $conditionId == $missionConf [configdata_mission_setting::k_completeconditionid3]
        ) {
            $completeValue = $this->missionCompleteGetValue($conditionId,
                $missionConf [configdata_mission_setting::k_completeconditionvalue3],
                $this->get_completevalue3(),
                $newValues);

            $this->set_completevalue3($completeValue ['value']);
            $this->set_iscompletevalue3($completeValue ['complete']);
            $succ = true;
        }

        return $succ;
    }

    /**
     * 获取条件完成剩余的次数
     * 条件的位置
     * @param $conditionPosition
     * @return int|null
     */
    public function getConditionLeftNum($conditionPosition)
    {
        $num = 0;
        $conditionPosition = strval($conditionPosition);
        $missionConf = dbs_mission::getMissionConfig($this->get_missionId());
        if (is_null($missionConf)) {
            return $num;
        }

        $isCompleteValueFunction = "get_iscompletevalue" . $conditionPosition;
        $getCompleteValueFunction = "get_completevalue" . $conditionPosition;
        $k_completeConditionId = "completeconditionid" . $conditionPosition;
        $k_completeConditionValue = "completeconditionvalue" . $conditionPosition;

        if (!$this->$isCompleteValueFunction () &&
            isset($missionConf[$k_completeConditionId])
        ) {
            $completeConfValue = $missionConf [$k_completeConditionValue];
            $conditionId = $missionConf [$k_completeConditionId];
            $completeNum = $this->getConditionNum($conditionId, $completeConfValue);
            $num = $completeNum - $this->$getCompleteValueFunction ();
        }

        return $num;
    }

    /**
     * 获取条件完成条件的最大数量
     * @param $conditionPosition
     * @return int|null
     */
    public function getConditionMaxNum($conditionPosition)
    {
        $completeNum = 0;
        $conditionPosition = strval($conditionPosition);
        $missionConf = dbs_mission::getMissionConfig($this->get_missionId());
        if (is_null($missionConf)) {
            return $completeNum;
        }

        $isCompleteValueFunction = "get_iscompletevalue" . $conditionPosition;
//        $getCompleteValueFunction = "get_completevalue" . $conditionPosition;
        $k_completeConditionId = "completeconditionid" . $conditionPosition;
        $k_completeConditionValue = "completeconditionvalue" . $conditionPosition;

        if (!$this->$isCompleteValueFunction () &&
            isset($missionConf[$k_completeConditionId])
        ) {
            $completeConfValue = $missionConf [$k_completeConditionValue];
            $conditionId = $missionConf [$k_completeConditionId];
            $completeNum = $this->getConditionNum($conditionId, $completeConfValue);
//            $num = $completeNum - $this->$getCompleteValueFunction ();
        }

        return $completeNum;
    }

    /**
     * 完成任务条件
     *
     * @param $conditionPosition
     * @return bool
     */
    public function completeCondition($conditionPosition)
    {
        $conditionPosition = strval($conditionPosition);
        $missionConf = dbs_mission::getMissionConfig($this->get_missionId());
        if (is_null($missionConf)) {
            return false;
        }
        $succ = false;

        $is_completevalue_function = "get_iscompletevalue" . $conditionPosition;
//        $get_completevalue_function = "get_completevalue" . $conditionPosition;
        $k_completeconditionid = "completeconditionid" . $conditionPosition;
        $k_completeconditionvalue = "completeconditionvalue" . $conditionPosition;
        $set_completevalue = "set_completevalue" . $conditionPosition;
        $set_iscompletevalue = "set_iscompletevalue" . $conditionPosition;

        if (!$this->$is_completevalue_function () &&
            $missionConf[$k_completeconditionid]
        ) {
            $completeConfValue = $missionConf [$k_completeconditionvalue];
            $conditionId = $missionConf [$k_completeconditionid];
            $completeNum = $this->getConditionNum($conditionId, $completeConfValue);
            $this->$set_completevalue ($completeNum);
            $this->$set_iscompletevalue (true);
        }

        return $succ;
    }

    /**
     * 获取条件数量
     * @param $conditionId
     * @param $conditionTemplateValue
     * @return int|null
     */
    private function getConditionNum($conditionId, $conditionTemplateValue)
    {
        $num = 0;

        $conditionConfig = self::getConditionConfig($conditionId);

        if (!is_null($conditionConfig)) {
            switch ($conditionConfig [configdata_mission_completecondition_setting::k_conditiontype]) {
                case "1" :
                    $num = intval($conditionTemplateValue);
                    break;
                case "2" :
                    $conditionTemplateValues = explode('$', $conditionTemplateValue);
                    $num = intval($conditionTemplateValues [1]);
                    break;
            }
        }
        return $num;
    }

    /**
     *
     * @param string $conditionId
     *            条件id
     * @param string $conditionTemplateValue
     *            配置条件数据
     * @param mixed $oldValue
     *            原始数据
     * @param array $newValue
     *            新数据
     * @return array
     */
    private function missionCompleteGetValue($conditionId,
                                             $conditionTemplateValue,
                                             $oldValue,
                                             $newValue)
    {
        $returnValue = $oldValue;
        $succ = false;
        /**
         * 条件是否完成
         */
        $isComplete = false;

        $returnArr = [];

        $conditionConfig = self::getConditionConfig($conditionId);
        $value = null;
        $maxvalue = null;


        if (!is_null($conditionConfig)) {
            //条件值得类型
            $conditionValueType = $conditionConfig [configdata_mission_completecondition_setting::k_conditiontype];
            //任务选项中的限定条件
            $conditionType = null;
            switch ($conditionValueType) {
                case "1" :
                    //value
                    $maxvalue = intval($conditionTemplateValue);
                    $value = intval($newValue [0]);
                    break;

                case "2" :
                    //key$value
                    $conditionTemplateValues = explode('$', $conditionTemplateValue);
                    if (!isset($conditionTemplateValues[1])) {
                        Common_Util_Log::record_error('MissionError', ["missionId" => $this->get_missionId(), "conditionId" => $conditionId]);
                    }
                    $maxvalue = intval($conditionTemplateValues [1]);
                    $conditionType = $conditionTemplateValues [0];
                    $value = intval($newValue [1]);
                    break;
            }

            //任务选项中有限定条件
            if (!empty($conditionType)) {
                //限定条件不匹配
                if ($conditionType != $newValue[0]) {
                    goto end;
                }
            }

            //新值不为空
            if (!is_null($value)) {
                if ($conditionConfig [configdata_mission_completecondition_setting::k_conditionoperatetype] == 'inc') {
                    $returnValue = min([
                        $oldValue + $value,
                        $maxvalue
                    ]);
                } else {
                    $returnValue = min([
                        $value,
                        $maxvalue
                    ]);
                }
                if ($maxvalue <= $returnValue) {
                    $isComplete = true;
                }
                $succ = true;
            }
        }

        end:
        $returnArr ['value'] = $returnValue;
        $returnArr ['succ'] = $succ;
        $returnArr ['complete'] = $isComplete;
        return $returnArr;
    }

    /**
     * 获取条件配置
     *
     * @param string $conditionId
     * @return null
     */
    static function getConditionConfig($conditionId)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_mission_completecondition_setting::class,
            configdata_mission_completecondition_setting::k_id,
            $conditionId);
    }
}