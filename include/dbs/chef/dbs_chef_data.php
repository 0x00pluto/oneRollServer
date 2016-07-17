<?php

namespace dbs\chef;

use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_chef_setting;
use configdata\configdata_chef_upgrade_setting;
use configdata\configdata_chef_upgradestage_setting;
use constants\constants_chefjob;
use constants\constants_chefstatus;
use constants\constants_equipment;
use constants\constants_returnkey;
use dbs\chef\employ\dbs_chef_employ_chefData;
use dbs\item\dbs_item_equipment;
use dbs\item\dbs_item_normal;
use dbs\templates\chef\dbs_templates_chef_data;
use err\err_dbs_chef_data_addexp;

/**
 * 厨师基础数据
 *
 * @author zhipeng
 *
 */
class dbs_chef_data extends dbs_templates_chef_data
{
    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_employData()
    {
        $this->set_defaultkeyandvalue(self::DBKey_employData, dbs_chef_employ_chefData::dumpDefaultValue());
    }


    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_currentJob()
    {
        $this->set_defaultkeyandvalue(self::DBKey_currentJob, constants_chefjob::JOB_INVALID);
    }


    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_status()
    {
        $this->set_defaultkeyandvalue(self::DBKey_status, constants_chefstatus::STATUS_FREE);
    }


    protected function _set_defaultvalue_trainData()
    {
        $this->set_defaultkeyandvalue(self::DBKey_trainData, dbs_chef_trainData::dumpDefaultValue());
    }

    /**
     * 获取培训数据
     * @return dbs_chef_trainData
     */
    public function getTrainData()
    {
        return dbs_chef_trainData::create_with_array($this->get_trainData());
    }

    /**
     * 设置培训数据
     * @param dbs_chef_trainData $data
     */
    public function setTrainData(dbs_chef_trainData $data)
    {
        $this->set_trainData($data->toArray());
    }

    protected function _set_defaultvalue_fashionDress()
    {
        $this->set_defaultkeyandvalue(self::DBKey_fashionDress, dbs_chef_dataFashionDress::dumpDefaultValue());
    }

    /**
     * 获取时装数据
     * @return dbs_chef_dataFashionDress
     */
    public function getFashionDressData()
    {
        return dbs_chef_dataFashionDress::create_with_array($this->get_fashionDress());
    }

    /**
     * 设置时装数据
     * @param dbs_chef_dataFashionDress $data
     */
    public function setFashionDressData(dbs_chef_dataFashionDress $data)
    {
        $this->set_fashionDress($data->toArray());
    }


    /**
     * 获取主体体力类
     * 只读
     *
     * @return dbs_chef_vitdata
     */
    public function get_mastervitdata()
    {
        return dbs_chef_vitdata::create_with_array($this->get_mastervit());
    }


    /**
     * 保存厨师体力
     * @param dbs_chef_vitdata $vitData
     */
    private function set_mastervitdata(dbs_chef_vitdata $vitData)
    {
        $this->set_mastervit($vitData->toArray());
    }

    function __construct()
    {
        parent::__construct([]);
        $this->set_mastervit(dbs_chef_vitdata::dumpDefaultValue());
    }

    /**
     * 脱下装备
     *
     * @param string $pos
     *            constants_equipment::POS_1
     *            item_subtype
     */
    public function takeoffequipment($pos)
    {
        $pos = strval($pos);
        // 脱下来
        switch ($pos) {
            case constants_equipment::POS_1 :

                $this->set_equipment1(null);
                break;
            case constants_equipment::POS_2 :
                $this->set_equipment2(null);
                break;

            case constants_equipment::POS_3 :
                $this->set_equipment3(null);
                break;

            case constants_equipment::POS_4 :
                $this->set_equipment4(null);
                break;

            case constants_equipment::POS_5 :
                $this->set_equipment5(null);
                break;

            case constants_equipment::POS_6 :
                $this->set_equipment6(null);
                break;
        }
    }

    /**
     * 穿上装备
     *
     * @param string $pos
     *            位置
     * @param array $equipitemdata
     *            装备道具数据
     */
    public function putonequipment($pos, array $equipitemdata)
    {
        $pos = strval($pos);

        // 穿着
        switch ($pos) {
            case constants_equipment::POS_1 :
                $this->set_equipment1($equipitemdata);
                break;
            case constants_equipment::POS_2 :
                $this->set_equipment2($equipitemdata);
                break;

            case constants_equipment::POS_3 :
                $this->set_equipment3($equipitemdata);
                break;

            case constants_equipment::POS_4 :
                $this->set_equipment4($equipitemdata);
                break;

            case constants_equipment::POS_5 :
                $this->set_equipment5($equipitemdata);
                break;

            case constants_equipment::POS_6 :
                $this->set_equipment6($equipitemdata);
                break;
        }
    }

    /**
     * 获取装备信息
     *
     * @param string $pos
     * @return NULL|string
     */
    public function get_equipment($pos)
    {
        $pos = strval($pos);

        $data = null;
        // 穿着
        switch ($pos) {
            case constants_equipment::POS_1 :
                $data = $this->get_equipment1();
                break;
            case constants_equipment::POS_2 :
                $data = $this->get_equipment2();
                break;

            case constants_equipment::POS_3 :
                $data = $this->get_equipment3();
                break;

            case constants_equipment::POS_4 :
                $data = $this->get_equipment4();
                break;

            case constants_equipment::POS_5 :
                $data = $this->get_equipment5();
                break;

            case constants_equipment::POS_6 :
                $data = $this->get_equipment6();
                break;
        }
        return $data;
    }

    /**
     * 过了一天了
     */
    public function nextday()
    {

    }


    /**
     * 增加经验
     * @param $exp
     * @param bool $levelUp 是否已经升级,引用传递
     * @return Common_Util_ReturnVar
     */
    public function addexp($exp, &$levelUp)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $levelUp = false;
        // code
        $exp = intval($exp);
        if ($exp <= 0) {
            $retCode = err_dbs_chef_data_addexp::ERROR_EXP_VALUE_WRONG;
            $retCode_Str = 'ERROR_EXP_VALUE_WRONG';
            goto failed;
        }
        $this->compute_stagelevel();
        // 设置经验
        $newexp = $this->get_exp() + $exp;

        // 当前等级
        $level = $this->get_level();
        $nextlevel = $level + 1;
        $levelconf = dbs_chef_list::get_chef_level_config($nextlevel);
        // 等级最大了
        if ($nextlevel > $this->get_levelmax() || is_null($levelconf)) {

            $retCode = err_dbs_chef_data_addexp::ERROR_LEVEL_MAX;
            $retCode_Str = 'ERROR_LEVEL_MAX';
            goto failed;
        } else {
            $this->set_exptotal($exp + $this->get_exptotal());

            while (TRUE) {
                $levelconf = dbs_chef_list::get_chef_level_config($nextlevel);
                // 等级最大了
                if ($nextlevel > $this->get_levelmax() || is_null($levelconf)) {
                    // 修正剩余的经验.
                    $this->set_exptotal($this->get_exptotal() - $newexp);
                    $newexp = 0;
                    break;
                } else {
                    $needexp = intval($levelconf [configdata_chef_upgrade_setting::k_needexp]);
                    if ($newexp >= $needexp) {
                        $newexp -= $needexp;
                        // 升级
                        $level++;
                        // 下一等级
                        $nextlevel = $level + 1;
                    } else {
                        break;
                    }
                }
            }
        }

        $this->set_exp($newexp);
        if ($level != $this->get_level()) {
            $this->set_level($level);
            $data [constants_returnkey::RK_LEVEL] = $level;
            $data [constants_returnkey::RK_UPGRADE] = true;

            $levelUp = true;

        }

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 填满体力
     */
    public function fillVitToFull()
    {
        $vitData = $this->get_mastervitdata();
        $vitData->fillVitToFull($this->get_level());
        $this->set_mastervitdata($vitData);

    }

    /**
     * 清空体力
     */
    public function clearVitToEmpty()
    {
        $vitData = $this->get_mastervitdata();
        $vitData->set_vit(0);
        $this->set_mastervitdata($vitData);
    }

    /**
     * 体力是否满了
     *
     * @return boolean
     */
    public function isvitfull()
    {
        return $this->get_mastervitdata()->isvitfull();
    }

    /**
     * 增加体力
     *
     * @param integer $vit
     * @return boolean
     */
    public function addVit($vit)
    {
        $vitData = $this->get_mastervitdata();
        if ($vitData->addvit($vit)) {
            $this->set_mastervitdata($vitData);
            return true;
        } else {
            return false;
        }
    }


    /**
     * 耗费体力
     * @param $vit
     * @return bool
     */
    public function costVit($vit)
    {
        $vitData = $this->get_mastervitdata();
        if ($vitData->costvit($vit)) {
            $this->set_mastervitdata($vitData);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 计算全部属性
     */
    public function computeability()
    {
        $this->compute_base_abilitys();
        $this->compute_equipment_abilitys();

        $this->compute_stagelevel();
        // 统计战斗力
        $this->compute_battlepower();
    }

    /**
     * 计算基础属性
     */
    private function compute_base_abilitys()
    {
        $cookingability = 0;
        $chinesefood = 0;
        $westernfood = 0;
        $japensefood = 0;
        $frenchfood = 0;
        $ideafood = 0;

        $chefconfig = dbs_chef_list::get_chef_config($this->get_cheftemplateid());
        if (is_null($chefconfig)) {
            return;
        }

        $addlevel = $this->get_level() - 1;

        // 厨艺
        $basevalue = intval($chefconfig [configdata_chef_setting::k_cookingability]);
        $addvalue = intval($chefconfig [configdata_chef_setting::k_cookingabilityaddvalue]);
        $cookingability = $basevalue + $addlevel * $addvalue;

        // 中餐
        $basevalue = intval($chefconfig [configdata_chef_setting::k_chinesefood]);
        $addvalue = intval($chefconfig [configdata_chef_setting::k_chinesefoodaddvalue]);
        $chinesefood = $basevalue + $addlevel * $addvalue;

        // 西餐
        $basevalue = intval($chefconfig [configdata_chef_setting::k_westernfood]);
        $addvalue = intval($chefconfig [configdata_chef_setting::k_westernfoodaddvalue]);
        $westernfood = $basevalue + $addlevel * $addvalue;

        // 日料
        $basevalue = intval($chefconfig [configdata_chef_setting::k_japenesefood]);
        $addvalue = intval($chefconfig [configdata_chef_setting::k_japenesefoodaddvalue]);
        $japensefood = $basevalue + $addlevel * $addvalue;

        // 法餐
        $basevalue = intval($chefconfig [configdata_chef_setting::k_frenchfood]);
        $addvalue = intval($chefconfig [configdata_chef_setting::k_frenchfoodaddvalue]);
        $frenchfood = $basevalue + $addlevel * $addvalue;

        // 创意
        $basevalue = intval($chefconfig [configdata_chef_setting::k_ideafood]);
        $addvalue = intval($chefconfig [configdata_chef_setting::k_ideafoodaddvalue]);
        $ideafood = $basevalue + $addlevel * $addvalue;

        $this->set_cookingability($cookingability);
        $this->set_chinesefood($chinesefood);
        $this->set_westernfood($westernfood);
        $this->set_japenesefood($japensefood);
        $this->set_frenchfood($frenchfood);
        $this->set_ideafood($ideafood);
    }

    /**
     * 计算阶段
     */
    private function compute_stagelevel()
    {
        $stageconfig = dbs_chef_list::get_chef_stage_config($this->get_stagelevel());
        if (is_null($stageconfig)) {
            return;
        }

        $this->set_levelmax($stageconfig [configdata_chef_upgradestage_setting::k_maxlevel]);
    }

    /**
     * 计算所有装备属性
     */
    private function compute_equipment_abilitys()
    {
        $this->compute_equipment_ability($this->get_equipment1());
        $this->compute_equipment_ability($this->get_equipment2());
        $this->compute_equipment_ability($this->get_equipment3());
        $this->compute_equipment_ability($this->get_equipment4());
        $this->compute_equipment_ability($this->get_equipment5());
        $this->compute_equipment_ability($this->get_equipment6());
    }

    private function compute_equipment_ability($itemdata)
    {
        // $itemdata = $this->get_equipment1 ();
        if (empty ($itemdata)) {
            return;
        }

        $item = new dbs_item_normal ();
        $item->fromArray($itemdata);
        $equipment = new dbs_item_equipment ($item);

        $cookingability = $this->get_cookingability();
        $chinesefood = $this->get_chinesefood();
        $westernfood = $this->get_westernfood();
        $japensefood = $this->get_japenesefood();
        $frenchfood = $this->get_frenchfood();
        $ideafood = $this->get_ideafood();

        $cookingability += $equipment->get_cookingability();
        $chinesefood += $equipment->get_chinesefood();
        $westernfood += $equipment->get_westernfood();
        $japensefood += $equipment->get_japenesefood();
        $frenchfood += $equipment->get_frenchfood();
        $ideafood += $equipment->get_ideafood();

        $this->set_cookingability($cookingability);
        $this->set_chinesefood($chinesefood);
        $this->set_westernfood($westernfood);
        $this->set_japenesefood($japensefood);
        $this->set_frenchfood($frenchfood);
        $this->set_ideafood($ideafood);
    }

    /**
     * 计算战斗力
     */
    private function compute_battlepower()
    {
        $battlePowerAdd = 0;
        $battlePowerAdd += $this->get_chinesefood();
        $battlePowerAdd += $this->get_westernfood();
        $battlePowerAdd += $this->get_japenesefood();
        $battlePowerAdd += $this->get_frenchfood();
        $battlePowerAdd += $this->get_ideafood();

        $battlePower = $this->get_cookingability();
        $battlePower = $battlePower + $battlePower * ($battlePowerAdd / 10000);
        $this->set_battlepower($battlePower);
    }

    /**
     * 获取性别
     * @return int 0男,1女
     */
    public function getSex()
    {
        $chefConfig = dbs_chef_list::get_chef_config($this->get_cheftemplateid());
        return intval($chefConfig[configdata_chef_setting::k_sex]);
    }

    /**
     * 是否是培训状态
     * @return bool
     */
    public function isStatusTraining()
    {
        return $this->get_status() === constants_chefstatus::STATUS_TRAINING;
    }

    /**
     * 是否是空闲状态
     * @return bool
     */
    public function isStatusFree()
    {
        return $this->get_status() === constants_chefstatus::STATUS_FREE;
    }

    /**
     * 是否被雇佣
     * @return bool
     */
    public function isStatusEmployed()
    {
        return $this->get_status() === constants_chefstatus::STATUS_EMPLOYED;
    }

    /**
     * 设置为训练状态
     */
    public function setStatusTrain()
    {
        $this->set_status(constants_chefstatus::STATUS_TRAINING);
    }

    /**
     * 设置被雇佣
     */
    public function setStatusEmployed()
    {
        if (!$this->isAllowEmployed()) {
            return false;
        }
        $this->set_status(constants_chefstatus::STATUS_EMPLOYED);

        return true;
    }

    /**
     * 设置为空闲状态
     */
    public function setStatusFree()
    {
        $this->set_status(constants_chefstatus::STATUS_FREE);
    }

    /**
     * 是否允许任职工作
     * @return bool
     */
    public function isAllowWork()
    {
        if ($this->isStatusFree()) {
            return true;
        }
        return false;
    }

    /**
     * 是否可以被雇佣
     * @return bool
     */
    public function isAllowEmployed()
    {
        if ($this->isStatusFree()) {
            if ($this->get_mastervitdata()->get_vit() >= 6) {
                return true;
            }
        }
        return false;
    }

    /**
     * 获取雇佣信息
     * @return dbs_chef_employ_chefData
     */
    public function getEmployData()
    {
        return dbs_chef_employ_chefData::create_with_array($this->get_employData());
    }

    /**
     * 设置雇佣信息
     * @param dbs_chef_employ_chefData $data
     */
    public function setEmployData(dbs_chef_employ_chefData $data)
    {
        $this->set_employData($data->toArray());
    }


}