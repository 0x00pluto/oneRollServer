<?php

namespace constants;

/**
 * 货币变化常量
 *
 * @author zhipeng
 *
 */
class constants_moneychangereason
{
    /**
     * 商店购买
     *
     * @var
     */
    const SHOP_BUY = 0;
    /**
     * 出售场景建筑
     *
     * @var
     */
    const SELL_BUILDING = 1;
    /**
     * 吃东西
     *
     * @var
     */
    const EAT_FOODS = 2;
    /**
     * 加速做菜
     *
     * @var
     */
    const SPEED_UP_COOKTABLE = 3;

    /**
     * 任务奖励
     *
     * @var
     */
    const MISSION_AWARD = 4;

    /**
     * 升级场景
     *
     * @var
     */
    const UPGRADE_SCENE = 5;

    /**
     * 升级合成物品槽位
     *
     * @var
     */
    const UPGRAGE_ITEM_COMPOSE_SLOTS = 6;

    /**
     * 合成物品
     *
     * @var
     */
    const COMPOSE_ITEM = 7;

    /**
     * 完成任务
     *
     * @var
     */
    const FINISH_MISSION = 8;
    /**
     * 完成任务条件
     *
     * @var
     */
    const FINISH_MISSION_CONDITION = 9;

    /**
     * 购买道具
     *
     * @var
     */
    const DIAMOND_SHOP_BUY_ITEM = 10;

    /**
     * 转换游戏币 钻石
     *
     * @var
     */
    const CONVERT_GAMECOIN_DIAMOND = 11;

    /**
     * 收藏品兑换
     *
     * @var
     */
    const ITEM_COLLECTION_EXCHANGE = 12;

    /**
     * 升级装备
     *
     * @var
     */
    const UPGRADE_EQUIPMENT = 13;

    /**
     * 填充厨师体力
     *
     * @var
     */
    const FILL_CHEF_VIT = 14;

    /**
     * 填充其他人厨师体力
     *
     * @var
     */
    const FILL_OTHER_CHEF_VIT = 15;

    /**
     * 雇佣厨师
     *
     * @var
     */
    const HIRE_CHEF = 16;

    /**
     * 厨师被雇佣奖励
     *
     * @var
     */
    const HIRED_CHEF_AWARD = 17;
    /**
     * 收取附件
     *
     * @var
     */
    const RECV_MAIL_ATTACHMENT = 18;

    /**
     * 领取红包
     *
     * @var
     */
    const RECV_NEIGHBOURHOOD_GIFTPACKAGE = 19;

    /**
     * 感谢发红包的人
     *
     * @var
     */
    const THANKS_NEIGHBOURHOOD_GIFTPACKAGE = 20;

    /**
     * 出售仓库道具
     *
     * @var
     */
    const SELL_WAREHOUSE_ITEM = 21;

    /**
     * 充值
     *
     * @var
     */
    const RECHARGE = 22;

    /**
     * 领取vip升级礼包
     *
     * @var
     */
    const AWARD_VIP_LEVEL_UP_GIFT = 23;

    /**
     * 领取月卡
     *
     * @var
     */
    const AWARD_MONTHLY_CARD = 24;

    /**
     * 单抽
     *
     * @var
     */
    const LOTTERY_ONE = 25;

    /**
     * 十连抽
     *
     * @var
     */
    const LOTTERY_TEN = 26;

    /**
     * 刷新推荐好友
     *
     * @var
     */
    const REFRESH_RECOMMEND_FRIEND = 27;

    /**
     * 扩展交易格子
     *
     * @var
     */
    const TRADE_EXPAND_BOX = 28;

    /**
     * 取消订单
     *
     * @var
     */
    const TRADE_CANCEL_ORDER = 29;

    /**
     * 开礼包
     *
     * @var
     */
    const OPEN_PACKAGE = 30;

    /**
     * 推图
     *
     * @var
     */
    const BATTLE_PVE = 31;

    /**
     * 推图
     *
     * @var
     */
    const BATTLE_PVE_FROM_ITEM = 31001;

    /**
     * 恢复地图次数
     *
     * @var
     */
    const RESTORE_PVE_STAGE_BATTLE_TIMES = 32;

    /**
     * 购买pve邀请卷
     *
     * @var
     */
    const BUY_PVE_TICKETS = 33;

    /**
     * 领取pve地图奖励
     *
     * @var
     */
    const RECV_PVE_MAP_AWARD = 34;

    /**
     * 购买社区红包
     *
     * @var
     */
    const BUY_NEIGHBOORHOOD_GIFT_PACKAGE = 35;

    /**
     * 开启场景宝箱
     *
     * @var
     */
    const OPEN_SCENE_BOX = 36;

    /**
     * 好友帮忙,烹饪
     *
     * @var
     */
    const FRIEND_HELP_COOK_DISHES = 37;
    /**
     * 帮忙吃菜
     *
     * @var
     */
    const FRIEND_HELP_EAT_DISHES = 38;

    /**
     * 帮忙扩地获得游戏币
     *
     * @var
     */
    const FRIEND_HELP_REQUEST_EXPAND_MATERIAL = 39;
    /**
     * 帮忙扩地加速使用的钻石
     *
     * @var
     */
    const FRIEND_HELP_REQUEST_EXPAND_SPEEDUP = 40;

    /**
     * 超级老虎机摇奖
     *
     * @var
     */
    const SUPER_SLOTMACHINE_ROLL = 41;

    /**
     * 领取超级大奖
     *
     * @var
     */
    const SUPER_SLOT_MACHINE_JACKPOT = 42;

    /**
     * GM增加
     *
     * @var
     */
    const ADD_BY_GM = 43;
    /**
     * GM减少
     *
     * @var
     */
    const REDUCE_BY_GM = 44;

    /**
     * 通过新手引导增加
     *
     * @var integer
     */
    const ADD_BY_USER_GUIDE = 45;

    /**
     * 清除嫁接冷却
     */
    const CLEAR_GRAFT_ADVERTISEMENT_COOL_DOWN = 46;

    /**
     * 双休聘礼申请
     */
    const REQUEST_JOIN_CHEF_TRAIN = 47;
    /**
     * 取消加入双休申请
     */
    const CANCEL_JOIN_CHEF_TRAIN = 48;
    /**
     * 同意他人加入双休
     */
    const ACCEPT_JOIN_CHEF_TRAIN = 49;
    /**
     * 拒绝双休
     */
    const REFUSE_JOIN_CHEF_TRAIN = 50;

    /**
     * 购买厨师时装
     */
    const TRAIN_CHEF_BUY_FASHION_DRESS = 51;

    /**
     * 取消雇佣厨师请求
     */
    const CANCEL_EMPLOY_CHEF_REQUEST = 52;

    /**
     * 收获自动经营的餐厅
     */
    const HARVEST_AUTO_MANAGE_RESTAURANT = 53;

    /**
     * 餐厅升级奖励
     */
    const RESTAURANT_LEVEL_UP = 54;
}