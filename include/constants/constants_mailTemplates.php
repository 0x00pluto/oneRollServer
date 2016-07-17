<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/28
 * Time: 下午2:42
 */

namespace constants;


class constants_mailTemplates
{
    /**
     *﻿ 求培训，不带聘礼
     */
    const CHEF_TRAIN_REQUEST_NO_PRESENTS = 1000;
    /**
     * 求培训，带聘礼
     */
    const CHEF_TRAIN_REQUEST_WITH_PRESENTS = 1001;
    /**
     * 对方选择和你培训
     */
    const CHEF_TRAIN_ACCEPT_REQUEST = 1002;
    /**
     * 请求失败－对方选择和第三人培训,很抱歉
     */
    const CHEF_TRAIN_ACCEPT_ONE_REJECT_REQUEST = 1003;
    /**
     * 请求失败－对方3天内未应答
     */
    const CHEF_TRAIN_REJECT_REQUEST = 1004;
    /**
     * 被加速－自己／第3人
     */
    const CHEF_TRAIN_SPEEDUP = 1005;
    /**
     * 培训完成－自己一个人
     */
    const CHEF_TRAIN_FINISH_SINGLE = 1006;
    /**
     * 培训完成－双方
     */
    const CHEF_TRAIN_FINISH_DOUBLE = 1007;
    /**
     * 培训完成-赠送礼物
     */
    const CHEF_TRAIN_FINISH_SEND_GIFT = 1008;
    /**
     * 培训完成－可购物
     */
    const CHEF_TRAIN_FINISH_CAN_SHOP = 1009;

    /**
     * ﻿请求失败－对方选择和第三人培训－带聘礼
     */
    const CHEF_TRAIN_ACCEPT_ONE_REJECT_REQUEST_WITH_PRESENTS = 1010;

    /**
     * ﻿请求失败－对方3天内未应答／被拒绝－带聘礼
     */
    const CHEF_TRAIN_REJECT_REQUEST_WITH_PRESENTS = 1011;


    //食品嫁接,,

    /**
     * 收到嫁接请求
     */
    const ITEM_GRAFT_REQUEST = 2000;//,收到嫁接请求,请允许我跟你一起嫁接吧，拜托啦！
    /**
     * 嫁接开始－对方通过嫁接请求（2选1）
     */
    const ITEM_GRAFT_ACCEPT_REQUEST = 2001;//,嫁接开始－对方通过嫁接请求（2选1）,好开心能和你一起嫁接，希望咱们能获得传说中的神奇食材。
    /**
     * 嫁接失败－对方和第三人嫁接
     */
    const ITEM_GRAFT_REFUSE_REQUEST = 2002;//,嫁接失败－对方和第三人嫁接,我昨天和别人约好的，这次嫁接就先不找你啦，食材退回到你仓库里，下次再约。
    /**
     * 嫁接失败－请求过期
     */
    const ITEM_GRAFT_REQUEST_EXPIRED = 2003;//,嫁接失败－请求过期,很抱歉，我心情不好不想嫁接了，食材已经退回到你的仓库里了。
    /**
     * 嫁接失败－无人没回应
     */
    const ITEM_GRAFT_TIMEOUT = 2004;//,嫁接失败－无人没回应。,很抱歉，还没人跟你嫁接，食材已退回你仓库，可以试试嫁接别的。
    /**
     * 被加速
     */
    const ITEM_GRAFT_SPEEDUP = 2005;//,被加速。,我猜我们都急着做菜，于是我就让它快快完成啦。只要你乐意，花多少钻石都可以。
    /**
     * 被添加药水
     */
    const ITEM_GRAFT_WEIGHT_ADD_ITEM = 2006;//,被添加药水,我刚刚添加了{itemNum}瓶{itemName}～
    /**
     * 嫁接完成
     */
    const ITEM_GRAFT_COMPLETE = 2007;//,嫁接完成,时间到！快去看看咱们最终嫁接的食材是什么吧。


    /**
     * 收到请求－无聘礼
     */
    const HIRE_CHEF_REQUEST_WITHOUT_PRESENT = 3000;//,收到请求－无聘礼（任选一条发）,冒昧地问一句，能请你{你\(弟弟\妹妹)厨师名字}来我家餐厅帮忙么？
    /**
     * 收到聘请请求
     */
    const HIRE_CHEF_REQUEST_WITH_PRESENT = 3001;//,收到聘请请求,亲爱滴～我用{500}{钻|金币}当聘礼，拜托一定要让{空－聘请的是主角|妹妹|弟弟}来我家。
    /**
     * 请求未通过
     */
    const HIRE_CHEF_REQUEST_REFUSE = 3002;//,请求未通过,{我|妹妹|弟弟}想想还是觉得现在不敢一个人去你家，等下次吧。
    /**
     * 请求过期
     */
    const HIRE_CHEF_REQUEST_EXPIRED = 3003;//,请求过期,很抱歉，我去度假了，没有及时处理你的请求。
    /**
     * 聘请成功
     */
    const HIRE_CHEF_REQUEST_ACCEPT = 3004;//,聘请成功,很高兴为你效劳，我一定会使出吃奶的力气，为你烹饪出超级棒的菜肴。
    /**
     * 聘来的厨师离开
     */
    const HIRE_CHEF_GO_HOME = 3005;//,聘来的厨师离开,为了你，我连最后一点力气都用光了，回家了，别太想我。
    /**
     * 自己的厨师回来
     */
    const HIRE_CHEF_GO_BACK = 3006;//,自己的厨师回来,在｛周大琪——用户名字｝家实在是太累了，回来后一点体力都没有啦。

    /**
     * 邀请别人得礼包
     */
    const INVITE_MASTER_GIFT = 4000;
    /**
     * 被邀请人得礼包
     */
    const INVITE_SLAVE_GIFT = 4001;

    /**
     * 成为好友消息
     */
    const FRIEND_START_TALKING = 5000;

    /**
     * 时装已经过期
     */
    const MAIL_FASHION_DRESS_OVERTIME = 6000;

    /**
     * 十连抽仓库容量已满
     */
    const MAIL_RAFFLE_TEN_OFF_CAPACITY = 7000;


    /**
     * 通知领取月卡
     */
    const MAIL_MONTH_CARD_COLLECT = 8000;

}