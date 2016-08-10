<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/7/18
 * Time: 上午11:21
 */

namespace dbs\mall;


use Common\Util\Common_Util_Guid;
use constants\constants_mall;
use constants\constants_mallGoodsData;
use dbs\dbs_player;
use dbs\storage\dbs_storage_globalValue;
use dbs\templates\mall\dbs_templates_mall_mallGoodsData;

class dbs_mall_mallGoodsData extends dbs_templates_mall_mallGoodsData
{

    const GUID_PREFIX = "mallGoods-";

    protected function _set_defaultvalue_goodsInfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_goodsInfo, dbs_mall_goodsNormalInfo::dumpDefaultValue());
    }

    protected function _set_defaultvalue_goodsSellInfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_goodsSellInfo, dbs_mall_goodsSellInfo::dumpDefaultValue());

    }

    protected function _set_defaultvalue_goodsRollResult()
    {
        $this->set_defaultkeyandvalue(self::DBKey_goodsRollResult, dbs_mall_goodsRollResult::dumpDefaultValue());
    }


    /**
     * 创建货物实例
     * @param int $onlineTime
     * @param int $startTime
     * @return dbs_mall_mallGoodsData
     */
    public static function create($onlineTime = -1,
                                  $startTime = -1
    )
    {
        $ins = new self();

        $onlineTime = $onlineTime == -1 ? time() : $onlineTime;
        $startTime = $startTime == -1 ? time() : $startTime;
        $ins->set_onlineTime($onlineTime);
        $ins->set_startTime($startTime);
        $ins->set_endTime(-1);
        $ins->set_status(constants_mallGoodsData::STATUS_IDLE);


        $ins->set_id(Common_Util_Guid::uuid(self::GUID_PREFIX));
        return $ins;
    }

    /**
     * @param dbs_player $player
     * @param int $num
     * @return array
     */
    public function sell(dbs_player $player, $num = 1)
    {
        $sellCount = $this->get_selloutCount();
        $rollCodes = $this->createRollCode($sellCount, $num);

        $this->set_selloutCount($sellCount + $num);

        //近期购买记录
        $recent_buy = dbs_mall_recentBuy::create_with_array(dbs_storage_globalValue::getValue(constants_mall::RECENT_BUY, []));
        $sellInfo = dbs_mall_goodsSellInfo::create_with_array($this->get_goodsSellInfo());
        foreach ($rollCodes as $rollCode) {
            $sellDetail = dbs_mall_goodsSellInfoDetail::create($player, $this->get_id(), $rollCode);
            $sellInfo->addSellDetail($sellDetail);
            $sellDetail->saveToDB(true);


            $recent_buy->pushSellDetail($sellDetail);

        }

        dbs_storage_globalValue::setValue(constants_mall::RECENT_BUY, $recent_buy->toArray());

        $this->set_goodsSellInfo($sellInfo->toArray());

        $this->finishSell();


        return [$rollCodes];


    }

    /**
     * 创建抽奖代码
     * @param int $num
     * @return array
     */
    private function createRollCode($sellCount, $num = 1)
    {

        $rollCodes = [];
//        $sellCount = $this->get_selloutCount();
        for ($i = 0; $i < $num; $i++) {
            $rollCodes[] = $sellCount + constants_mall::CODE_START + $i;
        }
        return $rollCodes;
    }


    /**
     * 结束购买.开始等待开奖
     */
    private function finishSell()
    {
        $this->set_status(constants_mallGoodsData::STATUS_WAIT_ROLL);

        $mall_goodsRollResult = dbs_mall_goodsRollResult::create(dbs_mall_manger::getRecentBuy());
        //冻结目前最后50名的操作数据

        //取向后偏移90秒的开奖ID
        $nextOpenSSCID = dbs_mall_remoteRollNum::getRemoteRollId(time() + 8 * 60 * 60 + 90);

        $nextSSCOpenTime = dbs_mall_remoteRollNum::getRemoteNumOpenTime($nextOpenSSCID);
        $nextOpenTime = strtotime(date('Y-m-d', time())) + $nextSSCOpenTime + 3 * 60;
        $nextOpenFullSSCID = sprintf("%s%03d", date("Ymd"), $nextOpenSSCID);

        $mall_goodsRollResult->set_cqsscId($nextOpenFullSSCID);
        $mall_goodsRollResult->set_rollTime($nextOpenTime);

        $this->set_goodsRollResult($mall_goodsRollResult->toArray());

//        dump([$nextOpenSSCID, $nextOpenFullSSCID, $nextSSCOpenTime, time(),
//            date('Y-m-d His', $nextOpenTime)]);

//        dump([strtotime(date('Y-m-d', time())), strtotime("now")]);


//        return
    }

}