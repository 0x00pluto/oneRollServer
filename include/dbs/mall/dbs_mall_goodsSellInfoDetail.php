<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/2
 * Time: 下午6:04
 */

namespace dbs\mall;


use Common\Util\Common_Util_Guid;
use Common\Util\Common_Util_Time;
use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\templates\mall\dbs_templates_mall_goodsSellInfoDetail;

class dbs_mall_goodsSellInfoDetail extends dbs_templates_mall_goodsSellInfoDetail
{
    protected function configure()
    {
        $this->set_primary_key([self::DBKey_id]);
        $this->set_tablename(self::DBKey_tablename);
        $this->setAutoSave(false);

        $this->ensureIndex(
            [
                self::DBKey_userid => 1,
            ]);

        $this->ensureIndex([
            self::DBKey_userid => 1,
            self::DBKey_mallGoodsId => 1
        ]);

        $this->ensureIndex([
            self::DBKey_rollCode => 1,
            self::DBKey_mallGoodsId => 1
        ]);
    }


    /**
     * @param dbs_player $player
     * @param $mallGoodsId
     * @param $rollCode
     * @return static
     */
    public static function create(dbs_player $player, $mallGoodsId, $rollCode)
    {
        $ins = new static();

        $ins->set_id(Common_Util_Guid::uuid("TradeCode-"));
        $ins->set_mallGoodsId($mallGoodsId);
        $ins->set_selltime(time());
        $ins->set_rolltimeSpan(self::getRollTimeSpan());
        $ins->set_sellcount(1);
        $ins->set_rollCode($rollCode);
        $ins->set_userid($player->get_userid());
        $ins->set_userinfo(dbs_filters_role::getNormalInfo($player));
        return $ins;
    }

    /**
     * @return int
     */
    public static function getRollTimeSpan()
    {
        $currentTime = explode('.', number_format(Common_Util_Time::getCurrenttime(), 3));
        $date = new \DateTime();
        return intval($date->format("His") . end($currentTime));
    }

    /**
     * @param $goodsId
     * @param $rollCode
     * @return static
     */
    public static function getSellDetailByRollCode($goodsId, $rollCode)
    {
        $ins = self::findOrNew(
            [
                self::DBKey_mallGoodsId => $goodsId,
                self::DBKey_rollCode => $rollCode
            ]);

        return $ins;
    }
}