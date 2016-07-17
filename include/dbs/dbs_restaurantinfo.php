<?php

namespace dbs;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_restaurant_level_setting;
use constants\constants_messagecmd;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\rank\system\dbs_rank_system_restaurantlevel;
use dbs\templates\dbs_templates_restaurantinfo;
use err\err_dbs_restaurantinfo_addrestaurantexp;

/**
 * 餐厅信息类
 *
 * @author zhipeng
 *
 */
class dbs_restaurantinfo extends dbs_templates_restaurantinfo
{
    /**
     * 获取餐厅等级配置
     * @param $level
     * @return null
     */
    static function getRestaurantLevelConfig($level)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_restaurant_level_setting::class,
            configdata_restaurant_level_setting::k_level,
            $level);
    }


    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 增加餐厅经验
     *
     * @param int $exp
     * @return Common_Util_ReturnVar
     */
    function addrestaurantexp($exp)
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code
        $exp = intval($exp);
        if ($exp <= 0) {
            $retCode = err_dbs_restaurantinfo_addrestaurantexp::ERROR_EXP_VALUE_WRONG;
            goto failed;
        }
        // 设置经验
        $newexp = $this->get_restaurantexp() + $exp;

        // 当前美誉度等级
        $restaurantLevel = $this->get_restaurantlevel();
        $nextRestaurantLevel = $restaurantLevel + 1;
        $restaurantconf = self::getRestaurantLevelConfig($nextRestaurantLevel);
        // 等级最大了
        if (is_null($restaurantconf)) {

            $retCode = err_dbs_restaurantinfo_addrestaurantexp::ERROR_LEVEL_MAX;
            goto failed;
        } else {
            $this->set_restauranttotalexp($exp + $this->get_restauranttotalexp());
            while (TRUE) {
                $restaurantconf = self::getRestaurantLevelConfig($nextRestaurantLevel);
                // 等级最大了
                if (is_null($restaurantconf)) {
                    // 修正剩余的经验.
                    $this->set_restauranttotalexp($this->get_restauranttotalexp() - $newexp);
                    $newexp = 0;
                    break;
                } else {
                    $needexp = intval($restaurantconf [configdata_restaurant_level_setting::k_needexp]);
                    if ($newexp >= $needexp) {
                        $newexp -= $needexp;
                        // 升级
                        $restaurantLevel++;
                        // 下一等级
                        $nextRestaurantLevel = $restaurantLevel + 1;
                    } else {
                        break;
                    }
                }
            }
        }

        $this->set_restaurantexp($newexp);
        if ($restaurantLevel != $this->get_restaurantlevel()) {
            $this->set_restaurantlevel($restaurantLevel);
            $data [constants_returnkey::RK_UPGRADE] = true;
            $data [constants_returnkey::RK_LEVEL] = $restaurantLevel;

            // 任务
            $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_56, $restaurantLevel);

            $this->db_owner->db_sync()->mark_sync(constants_messagecmd::S2C_RESTAURANT_LEVELUP, $data);

            //领取升级奖励
            $this->awardLevelUpAward();
        }

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }


    /**
     * @param int $value
     * @return $this
     */
    public function set_restaurantlevel($value)
    {
        dbs_rank_system_restaurantlevel::getInstance()->rank_valuechange($this->db_owner, $value);
        $this->db_owner->dbs_friend_recommemd()->set_restaurantlevel($value);
        return parent::set_restaurantlevel($value);
    }


    /**
     * 获取当前等级的餐厅配置
     */
    public function get_restaurant_config()
    {
        return self::getRestaurantLevelConfig($this->get_restaurantlevel());
    }


    /**
     * 获取当前餐厅等级的人气值
     * @return int
     */
    public function getReputation()
    {
        $config = $this->getRestaurantLevelConfig($this->get_restaurantlevel());
        return intval($config[configdata_restaurant_level_setting::k_reputation]);
    }

    /**
     * 领取餐厅升级奖励
     * @return bool
     */
    private function awardLevelUpAward()
    {
        if ($this->get_recvRestaurantAwardLevel() >= $this->get_restaurantlevel()) {
            return false;
        }

        //当前领取到的等级
        $currentAwardLevel = $this->get_recvRestaurantAwardLevel();
        //餐厅等级
        $currentLevel = $this->get_restaurantlevel();

        do {
            $currentAwardLevel++;
            $awardConfig = self::getRestaurantLevelConfig($currentAwardLevel);
            if (is_null($awardConfig)) {
                continue;
            }
            $awardGameCoin = intval($awardConfig[configdata_restaurant_level_setting::k_gamecoin]);
            $awardDiamond = intval($awardConfig[configdata_restaurant_level_setting::k_diamond]);

            dbs_role::createWithPlayer($this)->add_gamecoin_and_diamonds($awardGameCoin, $awardDiamond,
                constants_moneychangereason::RESTAURANT_LEVEL_UP);

        } while ($currentAwardLevel < $currentLevel);

        $this->set_recvRestaurantAwardLevel($currentAwardLevel);

        return true;
    }
}