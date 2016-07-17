<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/3
 * Time: 下午4:12
 */

namespace dbs\shop;


use Common\Util\Common_Util_Time;
use dbs\dbs_userkvstore;
use dbs\i\dbs_i_iday;
use dbs\templates\shop\dbs_templates_shop_player;

class dbs_shop_player extends dbs_templates_shop_player implements dbs_i_iday
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * @param $mallId
     * @return null|dbs_shop_playerMallData
     */
    public function getMallData($mallId)
    {
        $mallDatas = $this->get_mallDatas();
        if (isset($mallDatas[$mallId])) {
            return dbs_shop_playerMallData::create_with_array($mallDatas[$mallId]);
        }
        return null;
    }

    public function setMallData(dbs_shop_playerMallData $mallData)
    {
        $mallDatas = $this->get_mallDatas();
        $mallDatas[$mallData->get_mallid()] = $mallData->toArray();
        $this->set_mallDatas($mallDatas);
    }

    /**
     * 增加购买数量
     * @param $mallId
     * @param $num
     */
    public function addMallBuyCount($mallId, $num)
    {
        $mallData = $this->getMallData($mallId);
        if (is_null($mallData)) {
            $mallData = dbs_shop_playerMallData::create($mallId);
        }

        $mallData->addBuyCount($num);

        $this->setMallData($mallData);


    }

    /**
     * 每日购买的数量
     * @param $mallId
     * @return int
     */
    public function getMallBuyDailyCount($mallId)
    {
        $mallData = $this->getMallData($mallId);
        if (is_null($mallData)) {
            return 0;
        }
        return $mallData->get_dailyBuyCount();
    }

    /**
     * 全部购买的数量
     * @param $mallId
     * @return int
     */
    public function getMallBuyCount($mallId)
    {
        $mallData = $this->getMallData($mallId);
        if (is_null($mallData)) {
            return 0;
        }
        return $mallData->get_buyCount();
    }

    /**
     * @inheritDoc
     */
    function masterbeforecall()
    {
        $this->nextday();
    }

    /**
     * @inheritDoc
     */
    function nextday()
    {
        $dayFlagKey = self::class . "_" . $this->get_userid();
        $dayFlag = dbs_userkvstore::createWithPlayer($this)->getvalue($dayFlagKey, 0);
        if ($dayFlag !== Common_Util_Time::getGameDay()) {
            dbs_userkvstore::createWithPlayer($this)->setvalue($dayFlagKey, Common_Util_Time::getGameDay());
        } else {
            return;
        }


        $dataChange = false;
        $mallDatas = $this->get_mallDatas();
        foreach ($mallDatas as $mallId => $mallData) {
            $mallDataIns = dbs_shop_playerMallData::create_with_array($mallData);
            $mallDataIns->reset_dailyBuyCount();
            $mallDatas[$mallId] = $mallDataIns->toArray();
            $dataChange = true;
        }
        if ($dataChange) {
            $this->set_mallDatas($mallDatas);
        }
    }


}