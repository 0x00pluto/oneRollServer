<?php
namespace err;
class err_dbs_chef_list_choose
{
    /**
     * 等级不足
     *
     */
    const LEVEL_NOT_ENOUGH = 1;

    /**
     * 已经选择
     *
     */
    const ALREADY_CHOOSE = 2;

    /**
     * 厨师不存在
     *
     */
    const CHEF_NOT_EXISTS = 3;

    /**
     * 选择最大了
     */
    const CHOOSE_MAX = 4;

    /**
     * 选择厨师配置错误
     */
    const CHOOSE_CONFIG_ERROR = 5;
    /**
     * 选择厨师的性别和主角性别不一致
     */
    const CHOOSE_SEX_NOT_MATCH = 6;

    /**
     * 前置厨师没有开启
     */
    const PRE_CHEF_NOT_OPEN = 7;
    /**
     * 奖励ID错误
     */
    const AWARD_ID_INVALID = 8;
    /**
     * 奖励部位重复
     */
    const AWARD_POSITION_DUPLICATE = 9;
}

class err_dbs_chef_list_fillchefvit
{
    /**
     * 厨师不存在
     *
     */
    const CHEF_NOT_EXISTS = 1;
    /**
     * 体力已经满了
     *
     */
    const VIT_FULL = 2;
    /**
     * 钻石不足
     *
     */
    const DIAMOND_NOT_ENOUGH = 3;
    /**
     * 补充体力次数最大了
     *
     */
    const TIMES_MAX = 4;
}

class err_dbs_chef_list_puton
{
    /**
     * 厨师不存在
     *
     */
    const CHEF_NOT_EXISTS = 1;

    /**
     * 装备不存在
     *
     */
    const EQUIPMENT_NOT_EXISTS = 2;
    /**
     * 装备位置符合
     *
     */
    const EQUIPMENT_POS_NOT_MATCH = 3;

    /**
     * 相同装备
     *
     */
    const EQUIPMENT_SAME = 4;

    /**
     * 装备位置类型错误
     *
     */
    const EQUIPMENT_POS_ERROR = 5;

    /**
     * 厨师装备已经绑定到特定厨师
     *
     */
    const CHEF_ID_BIND_ERROR = 6;
}

class err_dbs_chef_list_takeoff
{
    /**
     * 装备不在装备中
     *
     */
    const EQUIPMENT_NOT_PUT_ON = 1;
    /**
     * 装备不存在
     *
     */
    const EQUIPMENT_NOT_EXISTS = 2;
}

class err_dbs_chef_list_fillotherchefmastervit
{
    /**
     * 用户不存在
     *
     */
    const PLAYER_NOT_EXISTS = 1;
    /**
     * 厨师不存在
     *
     */
    const CHEF_NOT_EXISTS = 2;
    /**
     * 体力满了
     *
     */
    const VIT_FULL = 3;
    /**
     * 填充体力次数满了
     *
     */
    const FILL_VIT_TIMES_MAX = 4;

    /**
     * 钻石不足
     *
     */
    const DIAMOND_NOT_ENOUGH = 5;

    /**
     * 不能给自己补充体力
     *
     */
    const CANNOT_FILL_VIT_SELF = 6;
}

class err_dbs_chef_list_fillotherchefcopyvit extends err_dbs_chef_list_fillotherchefmastervit
{
}

class err_dbs_chef_list_giveequipment
{
    /**
     * 目的用户不存在
     *
     */
    const DEST_USER_NOT_EXISTS = 1;
    /**
     * 目的厨师不存在
     *
     */
    const DEST_CHEF_NOT_EXISTS = 2;
    /**
     * 装备不存在
     *
     */
    const EQUIPMENT_NOT_EXISTS = 3;
    /**
     * 不是自己的装备
     *
     */
    const EQUIPMENT_NOT_MY = 4;
    /**
     * 不能赠送自己
     *
     */
    const CANNOT_GIVE_SELF = 5;
    /**
     * 赠送上限了
     *
     */
    const GIVE_TIMES_MAX = 6;
    /**
     * 装备穿着中
     *
     */
    const OLD_EQUIPMENT_ALEARY_PUTON = 7;
    /**
     * 要赠送的装备在穿着中
     *
     */
    const EQUIPMENT_ALEARY_PUTON = 8;
}

class err_dbs_chef_list_trainChef
{
    /**
     * 厨师不存在
     *
     * @var
     */
    const CHEF_NOT_EXISTS = 11;
    /**
     * 厨师正在培训中
     *
     * @var
     */
    const CHEF_ALREADY_TRAINING = 12;
    /**
     * 厨师体力不为空
     */
    const CHEF_VIT_NOT_EMPTY = 13;

    /**
     * 厨师繁忙中
     */
    const CHEF_BUSYING = 14;

    /**
     * 厨师今天培训次数达到上限
     */
    const CHEF_TODAY_TRAIN_COUNT_MAX = 15;
}

class err_dbs_chef_list_trainChefFinish
{
    /**
     * 厨师不存在
     *
     * @var
     */
    const CHEF_NOT_EXISTS = 11;
    /**
     * 厨师没有开始培训中
     *
     * @var
     */
    const CHEF_NOT_TRAINING = 12;

    /**
     * 培训没有完成
     *
     * @var
     */
    const CHEF_TRAINING_UNCOMPLETED = 13;

    /**
     * 双休另一个用户不存在
     */
    const DOUBLE_TRAIN_USER_NOT_EXIST = 14;
}

class err_dbs_chef_list_joinTrainChef
{
    /**
     * 厨师不存在
     *
     */
    const CHEF_NOT_EXISTS = 11;
    /**
     * 厨师状态错误
     *
     */
    const CHEF_STATUS_ERROR = 12;
    /**
     * 培训房间不存在(UI没有这个概念)
     */
    const TRAIN_ROOM_NOT_EXIST = 13;
    /**
     * 培训房间状态错误(UI没有这个概念)
     */
    const TRAIN_ROOM_STATUS_ERROR = 14;

    /**
     * 不能加入自己的房间
     */
    const CANNOT_JOIN_SELF_ROOM = 15;

    /**
     * 厨师已经申请过了
     */
    const CHEF_ALREADY_REQUEST_JOIN = 16;

    /**
     * 厨师培训次数到达上限
     */
    const CHEF_TODAY_TRAIN_COUNT_MAX = 17;

    /**
     * 对方厨师今天已经和我双休过了
     */
    const CHEF_TODAY_ALREADY_TRAINED_BY_ME = 18;

    /**
     * 培训已经完成
     */
    const TRAIN_IS_FINISH = 20;

}

interface err_dbs_chef_list_sendGiftToJoinRequest
{
    /**
     * 厨师不存在
     *
     */
    const CHEF_NOT_EXISTS = 11;
    /**
     * 厨师状态错误
     *
     */
    const CHEF_STATUS_ERROR = 12;
    /**
     * 培训房间不存在(UI没有这个概念)
     */
    const TRAIN_ROOM_NOT_EXIST = 13;
    /**
     * 培训房间状态错误(UI没有这个概念)
     */
    const TRAIN_ROOM_STATUS_ERROR = 14;

    /**
     * 发送聘礼等级不够
     */
    const CHEF_SEND_GIFT_NOT_OPEN = 15;
    /**
     * 聘礼钻石不足
     */
    const CHEF_GIFT_DIAMOND_NOT_ENOUGH = 16;
    /**
     * 聘礼游戏币不足
     */
    const CHEF_GIFT_GAMECOIN_NOT_ENOUGH = 17;
}

class err_dbs_chef_list_cancelJoinTrainChef
{
    /**
     * 厨师不存在
     *
     * @var
     */
    const CHEF_NOT_EXISTS = 11;

    /**
     * 厨师状态错误
     *
     * @var
     */
    const CHEF_STATUS_ERROR = 12;

    /**
     * 培训房间不存在
     */
    const TRAIN_ROOM_NOT_EXISTS = 13;
    /**
     * 请求不存在
     */
    const REQUEST_NOT_EXISTS = 14;


}

class err_dbs_chef_list_trainChefFashionShopBuy
{
    /**
     * 商店ID错误
     */
    const SHOP_ID_ERROR = 1;
    /**
     * 购买ID错误
     */
    const SLOT_ID_ERROR = 2;

    /**
     * 货币不足
     */
    const NOT_ENOUGH_MONEY = 3;

    /**
     * 道具配置错误
     */
    const ITEM_CONFIG_ERROR = 4;

}

class err_dbs_chef_list_acceptJoinTrainChef
{
    /**
     * 厨师不存在
     *
     * @var
     */
    const CHEF_NOT_EXISTS = 11;

    /**
     * 厨师状态错误
     *
     * @var
     */
    const CHEF_STATUS_ERROR = 12;

    /**
     * 培训房间不存在
     */
    const TRAIN_ROOM_NOT_EXISTS = 13;
    /**
     * 请求不存在
     */
    const REQUEST_NOT_EXISTS = 14;
    /**
     * 我自己的厨师不是主人
     */
    const CHEF_NOT_MASTER = 15;
    /**
     * 房间状态错误
     */
    const TRAIN_ROOM_STATUS_ERROR = 16;

    /**
     * 培训已经完成
     */
    const TRAIN_IS_FINISH = 17;
}

class err_dbs_chef_list_refuseJoinChefTrain
{
    /**
     * 厨师不存在
     *
     * @var
     */
    const CHEF_NOT_EXISTS = 11;
    /**
     * 厨师状态错误
     *
     * @var
     */
    const CHEF_STATUS_ERROR = 12;
    /**
     * 培训房间不存在
     */
    const TRAIN_ROOM_NOT_EXISTS = 13;
    /**
     * 请求不存在
     */
    const REQUEST_NOT_EXISTS = 14;

    /**
     * 我自己的厨师不是主人
     */
    const CHEF_NOT_MASTER = 15;
    /**
     * 房间状态错误
     */
    const TRAIN_ROOM_STATUS_ERROR = 16;

}

class err_dbs_chef_list_trainChefPublishAdvertisement
{
    /**
     * 厨师不存在
     *
     * @var
     */
    const CHEF_NOT_EXISTS = 11;
    /**
     * 厨师状态错误
     *
     * @var
     */
    const CHEF_STATUS_ERROR = 12;
    /**
     * 培训房间不存在
     */
    const TRAIN_ROOM_NOT_EXISTS = 13;

    /**
     * 不是房间拥有者
     */
    const CHEF_NOT_MASTER = 14;

    /**
     * 已经发送过广告了
     */
    const TRAINING_ALREADY_PUBLISH_ADVERTISEMENT = 15;
    /**
     * 房间状态错误
     */
    const TRAINING_ROOM_STATUS_ERROR = 16;

    /**
     * 培训已经完成
     */
    const TRAINING_COMPLETED = 17;
}


class err_dbs_chef_list_putonothermastercopychef
{
    /**
     * 目的用户不存在
     *
     * @var
     */
    const DEST_USER_NOT_EXISTS = 1;
    /**
     * 目的厨师不存在
     *
     * @var
     */
    const DEST_CHEF_NOT_EXISTS = 2;

    /**
     * 不能操作自己
     *
     * @var
     */
    const CANNOT_OPREATE_SELF = 3;

    /**
     * 没有送过装备
     *
     * @var
     */
    const NOT_GIVE_EQUIPMENTS = 4;
}

class err_dbs_chef_list_takeoffothermastercopychef
{
    /**
     * 目的用户不存在
     *
     */
    const DEST_USER_NOT_EXISTS = 1;
    /**
     * 目的厨师不存在
     *
     */
    const DEST_CHEF_NOT_EXISTS = 2;

    /**
     * 不能操作自己
     *
     */
    const CANNOT_OPREATE_SELF = 3;

    /**
     * 没有送过装备
     *
     */
    const NOT_GIVE_EQUIPMENTS = 4;
}

class err_dbs_chef_list_awardgoodwillgift
{
    /**
     * 目的用户不存在
     *
     */
    const DEST_USER_NOT_EXISTS = 1;
    /**
     * 目的厨师不存在
     *
     */
    const DEST_CHEF_NOT_EXISTS = 2;

    /**
     * 不能操作自己
     *
     */
    const CANNOT_OPREATE_SELF = 3;

    /**
     * 等级不足
     *
     */
    const LEVEL_NOT_ENOUGH = 4;

    /**
     * 仓库满了
     *
     */
    const WAREHOUSE_FULL = 5;
}

class err_dbs_chef_list_changemainchefid
{
    const CHEF_ID_SAME = 1;
    const CHEF_ID_NOT_EXISTS = 2;
}

/**
 * 穿着时装
 * Class err_dbs_chef_list_fashionDressPutOn
 * @package err
 */
class err_dbs_chef_list_fashionDressPutOn
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;
    /**
     * 时装已经绑定
     */
    const FASHION_DRESS_BIND = 2;
    /**
     * 仓库位置错误
     */
    const WAREHOUSE_POS_ERROR = 3;

    /**
     * 时装配置错误
     */
    const FASHION_DRESS_CONFIG_ERROR = 4;

    /**
     * 穿着未知错误
     */
    const PUT_ON_UNKNOWN_ERROR = 5;

    /**
     * 时装已经穿着了
     */
    const ALREADY_PUT_ON = 6;
    /**
     * 性别不匹配
     */
    const SEX_NOT_MATCH = 7;

}

/**
 * 脱掉时装
 * Class err_dbs_chef_list_fashionDressTakeOff
 * @package err
 */
class err_dbs_chef_list_fashionDressTakeOff
{
    /**
     * 厨师不存在
     */
    const CHEF_NOT_EXISTS = 1;

    /**
     * 不存在时装
     */
    const NOT_EXIST_FASHION_DRESS = 2;
}

