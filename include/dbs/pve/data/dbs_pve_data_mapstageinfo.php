<?php

namespace dbs\pve\data;

use dbs\dbs_basedatacell;
use constants\constants_pvegrade;
use configdata\configdata_pve_map_setting;
use dbs\pve\dbs_pve_map;
use constants\constants_pvestagetype;

class dbs_pve_data_mapstageinfo extends dbs_basedatacell
{

    /**
     * 关卡id
     *
     * @var string
     */
    const DBKey_stageid = "stageid";

    /**
     * 获取 关卡id
     */
    public function get_stageid()
    {
        return $this->getdata(self::DBKey_stageid);
    }

    /**
     * 设置 关卡id
     *
     * @param unknown $value
     */
    public function set_stageid($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_stageid, $value);
    }

    /**
     * 设置 关卡id 默认值
     */
    protected function _set_defaultvalue_stageid()
    {
        $this->set_defaultkeyandvalue(self::DBKey_stageid, "0");
    }

    /**
     * 地图id
     *
     * @var string
     */
    const DBKey_mapid = "mapid";

    /**
     * 获取 地图id
     */
    public function get_mapid()
    {
        return $this->getdata(self::DBKey_mapid);
    }

    /**
     * 设置 地图id
     *
     * @param unknown $value
     */
    public function set_mapid($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_mapid, $value);
    }

    /**
     * 设置 地图id 默认值
     */
    protected function _set_defaultvalue_mapid()
    {
        $this->set_defaultkeyandvalue(self::DBKey_mapid, 0);
    }

    /**
     * 最好成绩
     *
     * @var string
     */
    const DBKey_bestgrade = "bestgrade";

    /**
     * 获取 最好成绩
     */
    public function get_bestgrade()
    {
        return $this->getdata(self::DBKey_bestgrade);
    }

    /**
     * 设置 最好成绩
     *
     * @param unknown $value
     */
    private function set_bestgrade($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_bestgrade, $value);
    }

    /**
     * 设置 最好成绩 默认值
     */
    protected function _set_defaultvalue_bestgrade()
    {
        $this->set_defaultkeyandvalue(self::DBKey_bestgrade, constants_pvegrade::GRADE_F);
    }

    /**
     * 第一次通关时间
     *
     * @var string
     */
    const DBKey_fristpasstime = "fristpasstime";

    /**
     * 获取 第一次通关时间
     */
    public function get_fristpasstime()
    {
        return $this->getdata(self::DBKey_fristpasstime);
    }

    /**
     * 设置 第一次通关时间
     *
     * @param unknown $value
     */
    public function set_fristpasstime($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_fristpasstime, $value);
    }

    /**
     * 设置 第一次通关时间 默认值
     */
    protected function _set_defaultvalue_fristpasstime()
    {
        $this->set_defaultkeyandvalue(self::DBKey_fristpasstime, time());
    }

    /**
     * 战斗的次数
     *
     * @var string
     */
    const DBKey_battletimes = "battletimes";

    /**
     * 获取 战斗的次数
     */
    public function get_battletimes()
    {
        return $this->getdata(self::DBKey_battletimes);
    }

    /**
     * 设置 战斗的次数
     *
     * @param int $value
     */
    public function set_battletimes($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_battletimes, $value);
    }

    /**
     * 设置 战斗的次数 默认值
     */
    protected function _set_defaultvalue_battletimes()
    {
        $this->set_defaultkeyandvalue(self::DBKey_battletimes, 0);
    }

    /**
     * 战斗的最大次数
     *
     * @var string
     */
    const DBKey_battlemaxtimes = "battlemaxtimes";

    /**
     * 获取 战斗的最大次数
     */
    public function get_battlemaxtimes()
    {
        return $this->getdata(self::DBKey_battlemaxtimes);
    }

    /**
     * 设置 战斗的最大次数
     *
     * @param int $value
     */
    private function set_battlemaxtimes($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_battlemaxtimes, $value);
    }

    /**
     * 设置 战斗的最大次数 默认值
     */
    protected function _set_defaultvalue_battlemaxtimes()
    {
        $this->set_defaultkeyandvalue(self::DBKey_battlemaxtimes, 0);
    }

    /**
     * 每日恢复的次数
     *
     * @var string
     */
    const DBKey_dailyrestoretimes = "dailyrestoretimes";

    /**
     * 获取 每日恢复的次数
     */
    public function get_dailyrestoretimes()
    {
        return $this->getdata(self::DBKey_dailyrestoretimes);
    }

    /**
     * 设置 每日恢复的次数
     *
     * @param unknown $value
     */
    public function set_dailyrestoretimes($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_dailyrestoretimes, $value);
    }

    /**
     * 设置 每日恢复的次数 默认值
     */
    protected function _set_defaultvalue_dailyrestoretimes()
    {
        $this->set_defaultkeyandvalue(self::DBKey_dailyrestoretimes, 0);
    }

    function __construct()
    {
        parent::__construct(array());
    }

    /**
     * 通过配置创建
     *
     * @param unknown $stageid
     * @return dbs_pve_data_mapstageinfo
     */
    static function createwithconfig($stageid)
    {
        $ins = new self ();
        $ins->set_stageid($stageid);
        $stageconf = dbs_pve_map::get_stage_conf($stageid);
        $mapid = $stageconf [configdata_pve_map_setting::k_mapid];
        $ins->set_mapid($mapid);
        $ins->set_battlemaxtimes($stageconf [configdata_pve_map_setting::k_attackdailycount]);
        $ins->set_battletimes($stageconf [configdata_pve_map_setting::k_attackdailycount]);
        return $ins;
    }

    /**
     * 是否可以打
     */
    public function canattack()
    {
        $stageconf = dbs_pve_map::get_stage_conf($this->get_stageid());
        if ($stageconf [configdata_pve_map_setting::k_stagetype] == constants_pvestagetype::TYPE_BOSS) {
            // boss 关,判断次数
            if ($this->get_battletimes() > 0) {
                return true;
            }
        } else {
            // 普通关,只要是失败 就能打
            if ($this->get_bestgrade() == constants_pvegrade::GRADE_F) {
                return true;
            }
        }
        return false;
    }

    /**
     * 攻击
     *
     * @param number $times
     */
    public function attack($times = 1)
    {
        $stageconf = dbs_pve_map::get_stage_conf($this->get_stageid());
        if ($stageconf [configdata_pve_map_setting::k_stagetype] == constants_pvestagetype::TYPE_BOSS) {
            // boss 关,判断次数
            if ($this->get_battletimes() >= $times) {
                $this->set_battletimes($this->get_battletimes() - $times);
            }
        }
    }

    /**
     * 设置战斗等级
     *
     * @param unknown $grade
     */
    public function set_battle_grade($grade)
    {
        $grade = intval($grade);

        if ($grade > $this->get_bestgrade()) {
            if ($this->get_bestgrade() == constants_pvegrade::GRADE_F) {
                $this->set_fristpasstime(time());
            }
            $this->set_bestgrade($grade);
        }
    }

    /**
     * 恢复战斗次数
     */
    public function restorebattletimes()
    {
        $stageconf = dbs_pve_map::get_stage_conf($this->get_stageid());
        $this->set_battlemaxtimes($stageconf [configdata_pve_map_setting::k_attackdailycount]);
        $this->set_battletimes($stageconf [configdata_pve_map_setting::k_attackdailycount]);
    }
}