<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/25
 * Time: 上午11:26
 */

namespace dbs\chef\train;


use Common\Util\Common_Util_Guid;
use dbs\chef\dbs_chef_data;
use dbs\dbs_player;
use dbs\dbs_role;
use dbs\filters\dbs_filters_role;
use dbs\templates\chef\dbs_templates_chef_trainserviceTrainJoinRequestData;

class dbs_chef_train_RoomRequestData extends dbs_templates_chef_trainserviceTrainJoinRequestData
{
    /**
     * 创建请求
     * @param dbs_player $player
     * @param dbs_chef_data $chef
     * @param int $giftDiamond
     * @param int $giftGameCoin
     * @return dbs_chef_train_RoomRequestData
     */
    public static function createRequest(dbs_player $player, dbs_chef_data $chef, $giftDiamond = 0, $giftGameCoin = 0)
    {
        $ins = new self();

        $ins->set_requestId(Common_Util_Guid::gen_requestId());

        $ins->set_requestTime(time());
        $ins->set_giftDiamond($giftDiamond);
        $ins->set_giftGamecoin($giftGameCoin);

        $ins->set_userid($player->get_userid());
        $ins->set_userinfo(dbs_filters_role::getNormalInfo(dbs_role::createWithPlayer($player)));
        $ins->set_chefid($chef->get_guid());
        $ins->set_chefinfo($chef->toArray());

        return $ins;
    }

    /**
     * 增加游戏币
     * @param $value
     * @return int
     */
    public function addGiftGameCoin($value)
    {
        $value = intval($value);
        $this->set_giftGamecoin($this->get_giftGamecoin() + $value);

        return $this->get_giftGamecoin();
    }

    /**
     * 增加钻石
     * @param $value
     * @return int
     */
    public function addGiftDiamond($value)
    {
        $value = intval($value);
        $this->set_giftDiamond($this->get_giftDiamond() + $value);
        return $value;
    }

}