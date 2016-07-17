<?php

namespace dbs;

use constants\constants_defaultvalue;
use configdata\configdata_mission_activitymission_setting;
use constants\constants_memcachekey;
use Common\Db\Common_Db_memcached;
use configdata\configdata_mission_activitymissionperiod_setting;

/**
 *  活动任务
 *
 * @author zhipeng
 *
 */
class dbs_missionactivity extends dbs_baseplayer
{
    function __construct()
    {
        parent::__construct('missionactivity', array(
            self::DBKey_userid => constants_defaultvalue::USERID_EMPTY
        ));
    }

    /**
     * 当前激活的任务
     *
     * @var array
     */
    private static $_active_missions = null;

    /**
     * 获取当前激活的任务
     */
    public static function get_active_missions()
    {
        if (is_null(self::$_active_missions)) {
            self::$_active_missions = array();
            $activity_config = configdata_mission_activitymission_setting::data();
            foreach ($activity_config as $key => $value) {
                if (intval($value [configdata_mission_activitymission_setting::k_periodid]) == self::get_activity_period()) {
                    $missionid = $value [configdata_mission_activitymission_setting::k_missionid];
                    self::$_active_missions [$missionid] = dbs_mission::getMissionConfig($missionid);
                }
            }
        }
        return self::$_active_missions;
    }

    /**
     * 获得活动期数
     */
    public static function get_activity_period()
    {
        $memcached = Common_Db_memcached::getInstance();
        $period = $memcached->get(constants_memcachekey::DBKey_missionround);
// 		dump ( $period );
        if ($period) {
            return $period;
        }

        // $periodconfig = Common_Util_Configdata::getInstance()->getconfigdata(configdata_mission_activitymissionperiod_setting::class,, $index, $key)

        $periodconfigs = configdata_mission_activitymissionperiod_setting::data();
        $time = time();
        $expiretime = 0;

        foreach ($periodconfigs as $key => $value) {
            if ($time >= strtotime($value [configdata_mission_activitymissionperiod_setting::k_opentime]) && $time < strtotime($value [configdata_mission_activitymissionperiod_setting::k_endtime])) {
                $period = intval($value [configdata_mission_activitymissionperiod_setting::k_id]);
                $expiretime = strtotime($value [configdata_mission_activitymissionperiod_setting::k_endtime]) - $time;
                break;
            }
        }
        $memcached->add(constants_memcachekey::DBKey_missionround, $period, $expiretime);
        return $period;
    }

    function masterbeforecall()
    {
        $period = $this->get_activity_period();
    }
}