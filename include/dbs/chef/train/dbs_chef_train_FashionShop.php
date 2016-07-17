<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/21
 * Time: 下午5:43
 */

namespace dbs\chef\train;


use Common\Util\Common_Util_Guid;
use Common\Util\Common_Util_Random;
use configdata\configdata_chef_train_fashion_dress_sell_item_group_setting;
use configdata\configdata_chef_train_fashion_dress_sell_setting;
use dbs\chef\dbs_chef_data;
use dbs\dbs_player;
use dbs\templates\chef\dbs_templates_chef_trainFashionShop;

/**
 * 培训时装商店
 * Class dbs_chef_train_FashionShop
 * @package dbs\chef\train
 */
class dbs_chef_train_FashionShop extends dbs_templates_chef_trainFashionShop
{


    /**
     * @param dbs_player $ownerUser 拥有者ID,也就是谁能购买
     * @param dbs_chef_data $ownerChef 拥有者厨师,也就是谁能购买
     * @param dbs_player $presentUser 受赠者用户,也就是送给谁
     * @param dbs_chef_data $presentChef 受赠者厨师,也就是送给谁
     * @return dbs_chef_train_FashionShop|null
     */
    static function createFashionShop(dbs_player $ownerUser,
                                      dbs_chef_data $ownerChef,
                                      dbs_player $presentUser,
                                      dbs_chef_data $presentChef)
    {
        $ins = new self();

        $ins->set_id(Common_Util_Guid::gen_fashionShopId());
        $ins->set_owneruserid($ownerUser->get_userid());
        $ins->set_ownerchefid($ownerChef->get_guid());
        $ins->set_presentuserid($presentUser->get_userid());
        $ins->set_presentchefid($presentChef->get_guid());


        $itemSex = strval($presentChef->getSex());
        $normalChefLevel = strval(min($presentChef->get_level(), $ownerChef->get_level()));

        $shopConfig = null;
        foreach (configdata_chef_train_fashion_dress_sell_setting::data() as $data) {
            if ($data[configdata_chef_train_fashion_dress_sell_setting::k_level] === $normalChefLevel
                && $data[configdata_chef_train_fashion_dress_sell_setting::k_sex] === $itemSex
            ) {
                $shopConfig = $data;
                break;
            }
        }

        if (is_null($shopConfig)) {
            return null;
        }


        $slotGroupId0 = $shopConfig[configdata_chef_train_fashion_dress_sell_setting::k_slotitemgroupid0];
        $slotAwardId0 = $ins->buildAwardId($slotGroupId0);

        $slotGroupId1 = $shopConfig[configdata_chef_train_fashion_dress_sell_setting::k_slotitemgroupid1];
        $slotAwardId1 = $ins->buildAwardId($slotGroupId1);


        //推荐物品
        $levelDiff = abs($presentChef->get_level() - $ownerChef->get_level());
        if ($levelDiff > 10) {
            $specialChefLevel = strval(max($presentChef->get_level(), $ownerChef->get_level()));
        } else {
            $specialChefLevel = $normalChefLevel;
        }

        $specialShopConfig = null;
        foreach (configdata_chef_train_fashion_dress_sell_setting::data() as $data) {
            if ($data[configdata_chef_train_fashion_dress_sell_setting::k_level] === $specialChefLevel
                && $data[configdata_chef_train_fashion_dress_sell_setting::k_sex] === $itemSex
            ) {
                $specialShopConfig = $data;
                break;
            }
        }

        if (is_null($specialShopConfig)) {
            return null;
        }

        $slotGroupId2 = $specialShopConfig[configdata_chef_train_fashion_dress_sell_setting::k_slotitemgroupid2];
        $slotAwardId2 = $ins->buildAwardId($slotGroupId2);

        //设置奖励物品
        $ins->set_slotid1($slotAwardId0);
        $ins->set_slotid2($slotAwardId1);
        $ins->set_slotid3($slotAwardId2);


        return $ins;
    }

    /**
     * 创建奖励ID
     * @param $groupId
     * @return string
     */
    private function buildAwardId($groupId)
    {
        $groupId = strval($groupId);
        $weightItems = [];

        foreach (configdata_chef_train_fashion_dress_sell_item_group_setting::data() as $data) {
            if ($data[configdata_chef_train_fashion_dress_sell_item_group_setting::k_groupid] === $groupId) {
                $weightItems[$data[configdata_chef_train_fashion_dress_sell_item_group_setting::k_id]] =
                    intval($data[configdata_chef_train_fashion_dress_sell_item_group_setting::k_weight]);
            }
        }

        $awardId = Common_Util_Random::RandomWithWeight($weightItems);

        return $awardId;
    }
}