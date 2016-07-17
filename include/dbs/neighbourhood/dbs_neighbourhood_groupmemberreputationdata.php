<?php

namespace dbs\neighbourhood;

use Common\Util\Common_Util_Configdata;
use configdata\configdata_neighboorhood_reputation_upgrade_setting;
use dbs\base\dbs_base_level;
use dbs\templates\neighbourhood\dbs_templates_neighbourhood_groupmemberreputationdata;

/**
 * 成员威望数据
 *
 * @author zhipeng
 *
 */
class dbs_neighbourhood_groupmemberreputationdata extends dbs_templates_neighbourhood_groupmemberreputationdata
{

    use dbs_base_level;

    /**
     * 获取威望升级配置
     * @param $level
     * @return null
     */
    static public function get_level_config($level)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_neighboorhood_reputation_upgrade_setting::class, configdata_neighboorhood_reputation_upgrade_setting::k_level, $level);
    }


    protected function _set_level($value)
    {
        return $this->set_reputationlevel($value);
    }

    protected function _get_level()
    {
        return $this->get_reputationlevel();
    }


    protected function _set_exp($value)
    {
        $this->set_reputationexp($value);
    }

    protected function _get_exp()
    {
        return $this->get_reputationexp();
    }


    protected function _set_totalexp($value)
    {
        $this->set_reputationtotalexp($value);
    }

    protected function _get_totalexp()
    {
        return $this->get_reputationtotalexp();
    }

    protected function _get_levelup_config($level)
    {
        return self::get_level_config($level);
    }


    /**
     * @param $exp
     * @return \Common\Util\Common_Util_ReturnVar
     */
    public function addreputationexp($exp)
    {
        return $this->addexp($exp);
    }


}