<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/16
 * Time: 下午2:54
 */

namespace dbs\itemgraft;


use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\templates\itemgraft\dbs_templates_itemgraft_graftaddweightinfo;

class dbs_itemgraft_graftDataAddWeight extends dbs_templates_itemgraft_graftaddweightinfo
{
    /**
     * @param $index
     * @return dbs_itemgraft_graftDataAddWeight
     */
    public static function createWithIndex($index)
    {
        $ins = new self();
        $ins->set_index($index);
        return $ins;
    }


    /**
     * 增加结果权重
     * @param $UserId
     * @param $times
     * @param array $resultWeight
     */
    public function addResultWeightHistory($UserId, $times, array $resultWeight)
    {
        $resultWeightHistory = dbs_itemgraft_graftDataAddWeightHistory::create_with_array([]);
        $resultWeightHistory->set_userid($UserId);
        $resultWeightHistory->set_addtimes($times);
        $resultWeightHistory->set_addtimespan(time());
        $destPlayer = dbs_player::newGuestPlayer($UserId);
        $resultWeightHistory->set_roleinfo(dbs_filters_role::getNormalInfo($destPlayer->db_role()));
        $resultWeightHistory->set_resultWeights($resultWeight);
        $infos = $this->get_history();


        if (!empty($infos)) {
            $lastIndex = count($infos) - 1;
            $lastInfo = $infos[$lastIndex];
            $diffTime = abs($lastInfo[dbs_itemgraft_graftDataAddWeightHistory::DBKey_addtimespan] - time());
            if ($lastInfo[dbs_itemgraft_graftDataAddWeightHistory::DBKey_userid] === $UserId
                && $diffTime < 10
            ) {
                //最后一条,时间和userid都一致,则合并
                $lastInfo[dbs_itemgraft_graftDataAddWeightHistory::DBKey_addtimes] += $times;
                $lastInfo[dbs_itemgraft_graftDataAddWeightHistory::DBKey_resultWeights] = $resultWeight;
                $infos[$lastIndex] = $lastInfo;
            } else {
                $infos[] = $resultWeightHistory->toArray();
            }
        } else {
            $infos[] = $resultWeightHistory->toArray();
        }
        $this->set_history($infos);
    }
}