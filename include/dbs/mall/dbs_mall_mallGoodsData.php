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
use dbs\dbs_player;
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


    /**
     * 创建货物实例
     * @param int $onlineTime
     * @param int $onlineDuringTime
     * @param int $startTime
     * @param int $startDuringTime
     * @return dbs_mall_mallGoodsData
     */
    public static function create($onlineTime = -1,
                                  $onlineDuringTime = 1800,
                                  $startTime = -1,
                                  $startDuringTime = 1200)
    {
        $ins = new self();

        $onlineTime = $onlineTime == -1 ? time() : $onlineTime;
        $startTime = $startTime == -1 ? time() : $startTime;
        $ins->set_onlineTime($onlineTime);
        $ins->set_offlineTime($onlineTime + $onlineDuringTime);
        $ins->set_startTime($startTime);
        $ins->set_endTime($startTime + $startDuringTime);

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

        $sellDetail = dbs_mall_goodsSellInfoDetail::create($player, $rollCodes);

        $sellInfo = dbs_mall_goodsSellInfo::create_with_array($this->get_goodsSellInfo());
        $sellInfo->addSellDetail($sellDetail);


        $this->set_goodsSellInfo($sellInfo->toArray());

        return [$rollCodes, $sellDetail];


    }

    /**
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

}