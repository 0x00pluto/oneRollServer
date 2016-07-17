<?php

namespace dbs\mission;

use dbs\templates\mission\dbs_templates_mission_missionFinishData;

class dbs_mission_finishdata extends dbs_templates_mission_missionFinishData
{


    /**
     * @param $missionId
     * @return dbs_mission_finishdata
     */
    static function create($missionId)
    {
        $ins = new self();
        $ins->set_missionId($missionId);
        $ins->set_finishtime(time());
        return $ins;

    }
}