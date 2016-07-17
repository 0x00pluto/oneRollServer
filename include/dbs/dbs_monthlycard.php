<?php

namespace dbs;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use constants\constants_mailTemplates;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\mailbox\dbs_mailbox_data;
use dbs\templates\dbs_templates_monthlycard;
use err\err_dbs_monthlycard_award;

/**
 * 月卡
 * 2015年5月20日 下午5:08:14
 *
 * @author zhipeng
 *
 */
class dbs_monthlycard extends dbs_templates_monthlycard
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 是否可以购买
     * @return bool
     */
    function canBuy()
    {
        //可以随时购买
        //不在激活中,可以购买
        return true;
    }

    /**
     * 激活月卡
     *
     * @return Common_Util_ReturnVar
     */
    function active()
    {
        $days = Common_Util_Time::getGameDay();
        $duringDay = Common_Util_Configdata::getInstance()->get_global_config_value('MONTHLY_CARD_DURINGTIME')->int_value();
        if ($this->get_isActive()) {
            //续费
            $this->set_duringDay($this->get_duringDay() + $duringDay);
            $this->set_endDay($this->get_endDay() + $duringDay);
        } else {
            //新开卡
            $this->set_startDay($days);
            $this->set_duringDay($duringDay);
            $this->set_endDay($days + $duringDay);
            $this->set_isActive(true);
        }
        return true;
    }

    /**
     * 领取奖励
     *
     * @return Common_Util_ReturnVar
     */
    function award()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_monthlycard_award{}
        $days = Common_Util_Time::getGameDay();
        logicErrorCondition($this->get_isActive(), err_dbs_monthlycard_award::NOT_ACTIVE,
            'NOT_ACTIVE');

        logicErrorCondition($this->get_awardDay() < $days,
            err_dbs_monthlycard_award::ALREADY_AWARD,
            "ALREADY_AWARD");

        // 标记领取日期
        $this->set_awardDay($days);
        // 发钱
        $diamonds = Common_Util_Configdata::getInstance()->get_global_config_value('MONTHLY_CARD_AWARD_DIAMOND')->int_value();

        dbs_role::createWithPlayer($this)->add_diamond($diamonds,
            constants_moneychangereason::AWARD_MONTHLY_CARD);

        $data [constants_returnkey::RK_DIAMOND] = $diamonds;

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }

    /**
     * 自动发送月卡领取通知
     */
    private function autoSendAwardMail()
    {
        //不在月卡期
        if (!$this->get_isActive()) {
            return;
        }
        $day = Common_Util_Time::getGameDay();
        //今天已经领过了
        if ($day <= $this->get_awardDay()) {
            return;
        }
        //今天已经通知过了
        if ($day <= $this->get_noticeAwardDay()) {
            return;
        }

        dump(['Common_Util_Time::getTodayLeftSeconds()',
            Common_Util_Time::getTodayLeftSeconds()]);

        //标记今天已经通知过了
        $this->set_noticeAwardDay($day);
        //通知领取月卡
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::MAIL_MONTH_CARD_COLLECT,
            [
                'monthlyCard' => $this->toArray()
            ])->setExpiredTime(Common_Util_Time::getTodayLeftSeconds())
            ->send($this->get_userid());


    }

    /**
     * @inheritDoc
     */
    function masterbeforecall()
    {
        if ($this->get_isActive()) {
            //月卡自动过期
            $day = Common_Util_Time::getGameDay();
            if ($day > $this->get_endDay()) {
                $this->set_isActive(false);
            }
        }

        $this->autoSendAwardMail();
    }


}