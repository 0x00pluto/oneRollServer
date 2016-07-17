<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/17
 * Time: 上午11:50
 */

namespace dbs\payout;


use Common\Util\Common_Util_ReturnVar;
use constants\constants_returnkey;
use dbs\dbs_player;
use dbs\templates\payout\dbs_templates_payout_payout;
use err\err_dbs_payout_player_addDiamondValue;

/**
 * Class dbs_payout_player
 * @package dbs\payout
 */
class dbs_payout_player extends dbs_templates_payout_payout
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 增加付出
     * @param $destUserId
     * @param $value
     * @throw exception_logicError
     * @return Common_Util_ReturnVar
     *
     */

    public function addDiamondValue($destUserId, $value)
    {
        $data = [];
        //class err_dbs_payout_player_addDiamondValue
        typeCheckNumber($value, 0);
        typeCheckUserId($destUserId);

        logicErrorCondition($destUserId !== $this->get_userid(),
            err_dbs_payout_player_addDiamondValue::CAN_NOT_SELF,
            "CAN_NOT_SELF");


        $destPlayer = dbs_player::newGuestPlayer($destUserId);
        logicErrorCondition($destPlayer->isRoleExists(),
            err_dbs_payout_player_addDiamondValue::DEST_USER_NOT_EXIST,
            "DEST_USER_NOT_EXIST");

        $value = min($value, $this->get_payoutValueAmount());

        if ($value !== 0) {

            $payouts = $this->get_payouts();

            if (!isset($payouts[$destUserId])) {
                $payoutData = new dbs_payout_data();
                $payoutData->set_userId($destUserId);
            } else {
                $payoutData = dbs_payout_data::create_with_array($payouts[$destUserId]);
            }
            $payoutData->set_diamondValue($payoutData->get_diamondValue() + $value);

            $payouts[$destUserId] = $payoutData->toArray();
            $this->set_payouts($payouts);

            //减少额度
            $this->set_payoutValueAmount($this->get_payoutValueAmount() - $value);

        }

        $data[constants_returnkey::RK_PAY_OUT] = $value;


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 增加付出额度
     * @param $value
     */
    public function addPayoutAmount($value)
    {
        $value = intval($value);
        if ($value <= 0) {
            return;
        }

        $this->set_payoutValueAmount($this->get_payoutValueAmount() + $value);

    }

}