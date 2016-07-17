<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/15
 * Time: 下午3:43
 */

namespace dbs\itemgraft;


use configdata\configdata_item_graft_formula_config;
use constants\constants_itemgraft;
use constants\constants_time;
use dbs\dbs_player;
use dbs\dbs_role;
use dbs\filters\dbs_filters_role;
use dbs\i\dbs_i_iCooldown;
use dbs\templates\itemgraft\dbs_templates_itemgraft_graftdata;

class dbs_itemgraft_slotinfo extends dbs_templates_itemgraft_graftdata implements dbs_i_iCooldown
{
    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_resultaddweightinfo0()
    {
        $this->set_defaultkeyandvalue(self::DBKey_resultaddweightinfo0,
            dbs_itemgraft_graftDataAddWeight::createWithIndex(0)->toArray());

    }

    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_resultaddweightinfo1()
    {
        $this->set_defaultkeyandvalue(self::DBKey_resultaddweightinfo1,
            dbs_itemgraft_graftDataAddWeight::createWithIndex(1)->toArray());

    }

    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_resultaddweightinfo2()
    {
        $this->set_defaultkeyandvalue(self::DBKey_resultaddweightinfo2,
            dbs_itemgraft_graftDataAddWeight::createWithIndex(2)->toArray());
    }

    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_resultaddweightinfo3()
    {
        $this->set_defaultkeyandvalue(self::DBKey_resultaddweightinfo3,
            dbs_itemgraft_graftDataAddWeight::createWithIndex(3)->toArray());
    }

    /**
     * 是否在空闲状态
     * @return bool
     */
    public function isFree()
    {
        return $this->get_slotStatus() == constants_itemgraft::SLOT_STATUS_FREE;
    }

    /**
     * 是否在等待嫁接应答
     * @return bool
     */
    public function isWaitAnswer()
    {
        return $this->get_slotStatus() === constants_itemgraft::SLOT_STATUS_WAIT_ANSWER;
    }


    /**
     * 是否在嫁接中
     * @return bool
     */
    public function isGrafting()
    {
        return $this->get_slotStatus() === constants_itemgraft::SLOT_STATUS_GRAFTING;
    }

    /**
     * 是否完成了嫁接
     * @return bool
     */
    public function isFinishGraft()
    {
        if ($this->isGrafting() && time() > $this->get_finishtime()) {
            return true;
        }
        return false;
    }

    /**
     * 嫁接信息是否过期
     */
    public function isExpired()
    {
        if ($this->isWaitAnswer()) {
            if (time() > $this->get_preparetime() + constants_time::SECONDS_ONE_DAY * getGlobalValue("GRAFT_VALID_PERIOD")->int_value()) {
                return true;
            }
        }
        return false;
    }


    /**
     * 准备嫁接
     * @param $itemId
     * @param $itemCount
     * @return bool
     */
    public function prepareGraft($itemId, $itemCount)
    {
        if (!$this->isFree()) {
            return false;
        }

        $this->set_itemid1($itemId);
        $this->set_itemcount1($itemCount);
        $this->set_preparetime(time());
        $this->set_slotStatus(constants_itemgraft::SLOT_STATUS_WAIT_ANSWER);
        $this->set_formulaid(constants_itemgraft::FORMULA_ID_INVALID);

        $this->reset_resultaddweightinfo0()
            ->reset_resultaddweightinfo1()
            ->reset_resultaddweightinfo2()
            ->reset_resultaddweightinfo3();

        $this->reset_publishAdvertisement()
            ->reset_AdvertisementId();

        return true;
    }


    /**
     * 开始嫁接
     * @param $itemId
     * @param $itemCount
     * @param array $helpRoleInfo 帮忙人的信息
     * @return bool
     */
    public function answerGraft($itemId, $itemCount, array $helpRoleInfo)
    {
        if (!$this->isWaitAnswer()) {
            return false;
        }
        $config = null;
        $itemId1 = $this->get_itemid1();

        foreach (configdata_item_graft_formula_config::data() as $key => $value) {
            if ($value[configdata_item_graft_formula_config::k_fromitemid1] === $itemId1 &&
                intval($value[configdata_item_graft_formula_config::k_fromitemcount]) === $itemCount &&
                $value[configdata_item_graft_formula_config::k_fromitemid2] === $itemId
            ) {
                $config = $value;
                break;
            }
        }

        if (is_null($config)) {
            return false;
        }

        $this->set_preparetime(time());

        $answerData = new dbs_itemgraft_graftAnswerData();
        $answerData->set_itemid($itemId);
        $answerData->set_itemcount($itemCount);
        $answerData->set_formulaid($config[configdata_item_graft_formula_config::k_formulaid]);
        $answerData->set_answerPlayerInfo($helpRoleInfo);

        $answers = $this->get_answerPlayerInfos();
        $answers[$helpRoleInfo[dbs_role::DBKey_userid]] = $answerData->toArray();
        $this->set_answerPlayerInfos($answers);


        return true;

    }

    /**
     * 设置结果的默认信息
     * @param integer $index 0-3
     */
    private function setResultDefaultWeightInfo($index)
    {
        $formulaId = $this->get_formulaid();
        $config = getConfigData(configdata_item_graft_formula_config::class,
            configdata_item_graft_formula_config::k_formulaid,
            $formulaId);

        $k_toitemweight = "toitemweight" . ($index + 1);
        $weight = intval($config[$k_toitemweight]);

        $addWeightInfo = dbs_itemgraft_graftDataAddWeight::create_with_array($this->{"get_resultaddweightinfo" . $index}());
        $addWeightInfo->set_originWeight($weight);
        $addWeightInfo->set_weight($weight);
        $this->{"set_resultaddweightinfo" . $index}($addWeightInfo->toArray());
    }

    /**
     * @param $index
     * @return dbs_itemgraft_graftDataAddWeight
     */
    private function getResultAddWeightInfo($index)
    {
        $addWeightInfo = dbs_itemgraft_graftDataAddWeight::create_with_array($this->{"get_resultaddweightinfo" . $index}());
        return $addWeightInfo;
    }

    /**
     * @param dbs_itemgraft_graftDataAddWeight $data
     */
    private function setResultAddWeightInfo(dbs_itemgraft_graftDataAddWeight $data)
    {
        $index = $data->get_index();
        $this->{"set_resultaddweightinfo" . $index}($data->toArray());

    }


    /**
     * 接受嫁接
     * @param $userId
     * @return bool
     */
    public function acceptGraft($userId)
    {
        if (!$this->isWaitAnswer()) {
            return false;
        }

        $answers = $this->get_answerPlayerInfos();
        if (!isset($answers[$userId])) {
            return false;
        }
        $answer = dbs_itemgraft_graftAnswerData::create_with_array($answers[$userId]);

        //配方配制
        $config = dbs_itemgraft_player::getGraftConfigByFormulaId($answer->get_formulaid());

        //设置数据
        $this->set_itemid2($answer->get_itemid());
        $this->set_itemcount2($answer->get_itemcount());
        $this->set_formulaid($answer->get_formulaid());
        $this->set_helpPlayerInfo($answer->get_answerPlayerInfo());


        $this->set_preparetime(time());
        $this->set_finishtime(time() + intval($config[configdata_item_graft_formula_config::k_needtime]));


        $this->set_slotStatus(constants_itemgraft::SLOT_STATUS_GRAFTING);

        //重置请求列表
        $this->reset_answerPlayerInfos()
            ->reset_publishAdvertisement()
            ->reset_AdvertisementId();

        //设置初始概率
        $this->setResultDefaultWeightInfo(0);
        $this->setResultDefaultWeightInfo(1);
        $this->setResultDefaultWeightInfo(2);
        $this->setResultDefaultWeightInfo(3);


        return true;
    }


    /**
     * 拒绝嫁接,单个用户
     * @param $userId
     * @return bool
     */
    public function refuseGraft($userId)
    {
        if (!$this->isWaitAnswer()) {
            return false;
        }

        $this->set_preparetime(time());

        $answers = $this->get_answerPlayerInfos();
        if (!isset($answers[$userId])) {
            return false;
        }
        unset($answers[$userId]);
        $this->set_answerPlayerInfos($answers);
        $this->reset_helpPlayerInfo();


        return true;

    }

    /**
     * 拒绝嫁接,全部用户
     * @return bool
     */
    public function refuseGraftAll()
    {
        if (!$this->isWaitAnswer()) {
            return false;
        }
        $this->set_preparetime(time());
        $this->reset_answerPlayerInfos();
        $this->reset_helpPlayerInfo();
        return true;
    }

    /**
     * 增加结果权重
     * @param $userId
     * @param int $index 0-3
     * @param $times
     */
    public function addResultWeight($userId, $index, $times = 1)
    {
        $resultIndexs = [0, 1, 2, 3];
        foreach ($resultIndexs as $key => $resultIndex) {
            if ($index === $resultIndex) {
                unset($resultIndexs[$key]);
            }
        }
        $resultWeight = [];
        //配方ID
        $formulaId = $this->get_formulaid();
        $config = getConfigData(configdata_item_graft_formula_config::class,
            configdata_item_graft_formula_config::k_formulaid,
            $formulaId);

        $addWeightInfo = $this->getResultAddWeightInfo($index);
        //单位药水增加权重的万分比
        $k_toitemaddweight = "toitemaddweight" . ($index + 1);
        $addWeight = intval($config[$k_toitemaddweight]);
        //当前增加的总权重,最大10000
        $totalWeight = min(10000, $addWeightInfo->get_weight() + $times * $addWeight);


//        dump([
//            $addWeightInfo->toArray(),
//            $times,
//            $addWeight,
//            $totalWeight
//        ]);
        //当前剩余的权重
        $leftTotalWeight = 10000 - $totalWeight;
        //设置当前权重
        $addWeightInfo->set_weight($totalWeight);
        $resultWeight[$index] = $totalWeight;



        //剩余总原始权重
        $leftTotalOriginWeight = 0;
        foreach ($resultIndexs as $resultIndex) {
            $otherWeightInfo = $this->getResultAddWeightInfo($resultIndex);
            $leftTotalOriginWeight += $otherWeightInfo->get_originWeight();
        }

//        dump([
//            $leftTotalWeight,
//            $leftTotalOriginWeight,
//        ]);
        //设置剩余的概率
        foreach ($resultIndexs as $key => $resultIndex) {
            $otherWeightInfo = $this->getResultAddWeightInfo($resultIndex);
            $otherWeightPercent = floatval($otherWeightInfo->get_originWeight()) / $leftTotalOriginWeight;
            //剩余概率
            $otherWeight = floor($leftTotalWeight * $otherWeightPercent);

            $otherWeightInfo->set_weight($otherWeight);
            $resultWeight[$resultIndex] = $otherWeight;

            $this->setResultAddWeightInfo($otherWeightInfo);
        }


        //设置当前增加用户信息
        $addWeightInfo->addResultWeightHistory($userId, $times,$resultWeight);
        //保存药水添加的结果概率
        $this->setResultAddWeightInfo($addWeightInfo);
    }


    /**
     * 获取结果的权重
     * @param $index
     * @return int
     */
    public function getResultWeight($index)
    {
        $addWeightData = $this->getResultAddWeightInfo($index);
        return $addWeightData->get_weight();
    }

    /**
     * 获取单个结果添加药水的次数
     * @param int $index 结果位置索引 0-3
     * @return int
     */
    public function getResultAddWeightCount($index)
    {
        $addNum = 0;
        $infos = $this->{"get_resultaddweightinfo" . $index}();
        foreach ($infos as $info) {
            $addWeightInfo = dbs_itemgraft_graftDataAddWeight::create_with_array($info);
            $addNum += $addWeightInfo->get_addtimes();
        }
        return $addNum;
    }

    /**
     * 广告超时
     */
    public function advertisementTimeOut()
    {
        $this->reset_AdvertisementExpiredTime()
            ->reset_publishAdvertisement()
            ->reset_AdvertisementId();
    }

    /**
     * 完成合成
     */
    public function completeGraft()
    {
        $this->reset_slotStatus()
            ->reset_itemid1()
            ->reset_itemcount1()
            ->reset_itemid2()
            ->reset_itemcount2()
            ->reset_helpPlayerInfo()
            ->reset_formulaid()
            ->reset_preparetime()
            ->reset_finishtime()
            ->reset_resultaddweightinfo0()
            ->reset_resultaddweightinfo1()
            ->reset_resultaddweightinfo2()
            ->reset_resultaddweightinfo3()
            ->reset_publishAdvertisement()
            ->reset_AdvertisementId()
            ->reset_answerPlayerInfos();
    }

    /**
     * 重置
     */
    public function resetAll()
    {

        $this->completeGraft();
    }

    function getCooldownTime()
    {
        if (!$this->is_Cooldown()) {
            return 0;
        }
        return $this->get_finishtime() - time();
    }

    function clearCooldown()
    {
        $this->set_finishtime(0);
    }

    function get_clearCooldownDiamond()
    {
        return 1;
    }

    function is_Cooldown()
    {
        if ($this->isGrafting() && time() < $this->get_finishtime()) {
            return true;
        }
        return false;
    }


}