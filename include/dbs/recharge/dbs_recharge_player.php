<?php

namespace dbs\recharge;

use apps;
use Common\Util\Common_Util_Array;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Http;
use Common\Util\Common_Util_Log;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_recharge_setting;
use constants\constants_configure;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_platformtype;
use constants\constants_returnkey;
use dbs\dbs_role;
use dbs\payout\dbs_payout_player;
use dbs\templates\recharge\dbs_templates_recharge_player;
use dbs\thirdparty\dbs_thirdparty_userinfo;
use err\err_dbs_recharge_player_completeorder;
use err\err_dbs_recharge_player_createorder;
use err\err_dbs_recharge_player_recharge;
use err\err_dbs_recharge_player_verifyorder;
use err\err_dbs_recharge_player_verifyorderactive;
use utils\utils_log;

/**
 * 说明
 * 2015年5月11日 下午4:22:25
 *
 * @author zhipeng
 *
 */
class dbs_recharge_player extends dbs_templates_recharge_player
{
    /**
     * 获取充值配置
     * @param $goodsid
     * @return null
     */
    static function get_goods_config($goodsid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_recharge_setting::class,
            configdata_recharge_setting::k_goodsid,
            $goodsid);
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 充值记录
     *
     * @param string $goodsid
     */
    private function add_rechargegoodsid($goodsid)
    {
        $num = 0;
        $md5GoodsId = md5($goodsid);
        $list = $this->get_rechargegoodsidlist();
        if (isset($list[$md5GoodsId])) {
            $num = $list [$md5GoodsId];
        }
        $num++;

        $list [$md5GoodsId] = $num;

        $this->set_rechargegoodsidlist($list);

    }

    /**
     * 获取充值次数
     *
     * @param string $goodsid
     * @return int
     */
    private function get_rechargecount($goodsid)
    {
        $md5goodsid = md5($goodsid);
        return Common_Util_Array::getvalue($this->get_rechargegoodsidlist(), $md5goodsid, 0)->int_value();
    }

    /**
     * 添加到未完成的订单中
     *
     * @param dbs_recharge_data $orderdata
     */
    protected function add_uncompleteorder(dbs_recharge_data $orderdata)
    {
        $list = $this->get_uncompleteorderlist();
        $list [$orderdata->get_orderid()] = $orderdata->toArray();
        $this->set_uncompleteorderlist($list);
    }

    /**
     * 取消订单
     *
     * @param string $orderid
     */
    protected function remove_uncompleteorder($orderid)
    {
        $list = $this->get_uncompleteorderlist();
        if (isset($list[$orderid])) {
            unset ($list [$orderid]);
            $this->set_uncompleteorderlist($list);
        }

    }

    /**
     * 获取未完成的订单
     *
     * @param string $orderid
     * @return dbs_recharge_data|NULL
     */
    protected function get_uncompleteorder($orderid)
    {
        $list = $this->get_uncompleteorderlist();
        if (isset($list[$orderid])) {
            $data = new dbs_recharge_data ();
            $data->fromArray($list [$orderid]);
            return $data;
        }
        return NULL;
    }

    /**
     * 添加到未完成的订单中
     *
     * @param dbs_recharge_data $orderdata
     */
    protected function add_completeorder(dbs_recharge_data $orderdata)
    {
        $list = $this->get_completeorderlist();
        $list [$orderdata->get_orderid()] = $orderdata->toArray();
        $this->set_completeorderlist($list);
    }

    /**
     * 创建订单
     *
     * @param string $goodsid
     * @return Common_Util_ReturnVar
     */
    function createorder($goodsid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $goodsid = strval($goodsid);

        $goodsConfig = self::get_goods_config($goodsid);
        if (is_null($goodsConfig)) {
            $retCode = err_dbs_recharge_player_createorder::GOODS_NOT_EXISTS;
            $retCode_Str = 'GOODS_NOT_EXISTS';
            goto failed;
        }

        $accountUserInfo = dbs_thirdparty_userinfo::getByLinkUserid($this->get_userid());

        logicErrorCondition(intval($goodsConfig[configdata_recharge_setting::k_channelid]) ==
            $accountUserInfo->get_thirdpartytype(),
            err_dbs_recharge_player_createorder::CHANNEL_NOT_MATCH,
            "CHANNEL_NOT_MATCH");


        // 如果是月卡,判断是否可以购买
        if (intval($goodsConfig [configdata_recharge_setting::k_ismonth]) == 1) {
            if (!$this->db_owner->dbs_monthlycard()->canBuy()) {
                $retCode = err_dbs_recharge_player_createorder::CANNOT_RECHAGRE_MONTHLY_CARD;
                $retCode_Str = 'CANNOT_RECHAGRE_MONTHLY_CARD';
                goto failed;
            }
        }


        $goodsorderdata = dbs_recharge_data::create($goodsid);

        $this->add_uncompleteorder($goodsorderdata);

        $data = $goodsorderdata->toArray();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 取消订单
     *
     * @return Common_Util_ReturnVar
     */
    function cancelorder($orderid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        $orderid = strval($orderid);
        // class err_dbs_recharge_player_cancelorder{}

        //
        $this->remove_uncompleteorder($orderid);
        // $this->set_currentrechargeorder ( null );

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 完成订单
     *
     * @return Common_Util_ReturnVar
     */
    private function completeorder($orderid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        $orderid = strval($orderid);
        // class err_dbs_recharge_player_completeorder{}

        $orderdata = $this->get_uncompleteorder($orderid);
        if (is_null($orderdata)) {
            $retCode = err_dbs_recharge_player_completeorder::NOT_UNCOMPLETE_ORDER;
            $retCode_Str = 'NOT_UNCOMPLETE_ORDER';
            goto failed;
        }
        $this->remove_uncompleteorder($orderid);
        $orderdata->set_iscomplete(true);

        $this->add_completeorder($orderdata);
        $this->add_rechargegoodsid($orderdata->get_goodsid());
        // code

        succ:

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 校验订单
     *
     * @param $orderid
     * @return Common_Util_ReturnVar
     */
    function verifyorder($orderid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_recharge_player_verifyorder{}

        $orderdata = $this->get_uncompleteorder($orderid);
        if (is_null($orderdata)) {
            $retCode = err_dbs_recharge_player_verifyorder::NOT_UNCOMPLETE_ORDER;
            $retCode_Str = 'NOT_UNCOMPLETE_ORDER';
            goto failed;
        }

        // 发送验证票据服务

        $url = C(constants_configure::RECHARGE_VERIFY_URL);

        $params = [
            'orderid' => $orderid
        ];
        $rpc_return = Common_Util_Http::call_remote_rpc($url, 'noticecenter.check', $params);
        if (is_null($rpc_return)) {
            $retCode = err_dbs_recharge_player_verifyorder::VERIFY_SYSTEM_ERR;
            $retCode_Str = 'VERIFY_SYSTEM_ERR';
            goto failed;
        }
        if ($rpc_return->is_failed()) {
            // dump ( $rpc_return );
            $retCode = err_dbs_recharge_player_verifyorder::NOT_FOUND_RECHARGE_RECORD;
            $retCode_Str = 'NOT_FOUND_RECHARGE_RECORD';
            goto failed;
        }

        $rechargeData = new apps\payverify\dbs\notice\dbs_notice_rechargedata ();
        $rechargeData->fromArray($rpc_return->get_retdata());

        if ($orderdata->get_goodsid() != $rechargeData->get_goodsid()) {
            $retCode = err_dbs_recharge_player_verifyorder::GOODS_ID_NOT_MATCH;
            $retCode_Str = 'GOODS_ID_NOT_MATCH';
            goto failed;
        }

        // 充值
        $rechargeretdata = $this->recharge($orderdata->get_goodsid());
        // 返回客户端充值的钻石数量
        $data = $rechargeretdata->get_retdata();

        // 充值日志
        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_RECHAGRE, $this->get_userid(), [
            'orderdata' => $orderdata->toArray(),
            'rechargedata' => $data
        ]);

        // 移动到完成订单中
        $this->completeorder($orderid);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 主动校验充值数据
     *
     * @param string $orderid
     *            本地订单编号
     * @param string $receipt
     *            校验码
     * @return Common_Util_ReturnVar
     */
    private function verifyOrderReceipt($orderid, $receipt, $verifycommand, $commandextparams = [])
    {
        $data = array();
        // class err_dbs_recharge_player_verifyordergoogleplay{}
        $orderid = strval($orderid);
        $receipt = strval($receipt);

        $thirdUserInfo = dbs_thirdparty_userinfo::getByLinkUserid($this->get_userid());
        $platformId = $thirdUserInfo->get_thirdpartytype();
        $orderdata = $this->get_uncompleteorder($orderid);
        if (is_null($orderdata)) {
            $retCode = err_dbs_recharge_player_verifyorderactive::NOT_UNCOMPLETE_ORDER;
            $retCode_Str = 'NOT_UNCOMPLETE_ORDER';
            goto failed;
        }

        $url = C(constants_configure::RECHARGE_APPLE_NOTICE_URL);

        $goodsconfig = self::get_goods_config($orderdata->get_goodsid());

        $params = [];
        $params ['platformid'] = $platformId; // aptconstants_platformtype::APPSTORE;
        $params ['orderid'] = $orderid;
        $params ['receipt'] = $receipt;
        $params ['rmbnum'] = $goodsconfig [configdata_recharge_setting::k_rmbnum];

        $params = array_merge($params, $commandextparams);

        // dump ( $params );
        $rpc_return = Common_Util_Http::call_remote_rpc($url, $verifycommand, $params);

        // dump ( $rpc_return );
        if (!is_null($rpc_return) && $rpc_return->is_succ()) {
            // 校验票据
            return $this->verifyorder($orderid);
        } else {
            Common_Util_Log::record_error('Recharge verifyOrderReceipt Error!',
                [
                    "params" => $params
                ]);
//            $data = $rpc_return->to_Array();
            $retCode = err_dbs_recharge_player_verifyorderactive::DUPLICATE_VERIFY;
            $retCode_Str = 'DUPLICATE_VERIFY';
            goto failed;
        }


        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 校验GooglePlay数据
     *
     * @param string $orderid
     *            本地订单编号
     *
     * @param string $purchasedata
     *            订单数据
     * @param string $signature
     *            校验码
     * @return Common_Util_ReturnVar
     */
    function verifyordergoogleplay($orderid, $purchasedata, $signature)
    {
        return $this->verifyOrderReceipt($orderid, $signature, 'googleplayreceiptcenter.verify', [
            'purchasedata' => $purchasedata
        ]);
    }

    /**
     * 校验苹果数据
     *
     * @param string $orderid
     *            本地订单编号
     * @param string $receipt
     *            校验码
     * @return Common_Util_ReturnVar
     */
    function verifyorderappstore($orderid, $receipt)
    {
        return $this->verifyOrderReceipt($orderid, $receipt, 'applereceiptcenter.verify');

    }

    /**
     * 充值
     *
     * @param string $goodsId
     *            货物id
     * @return Common_Util_ReturnVar
     */
    function recharge($goodsId)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_recharge_player_recharge{}

        $goodsId = strval($goodsId);
        $goodsConfig = self::get_goods_config($goodsId);
        if (is_null($goodsConfig)) {
            $retCode = err_dbs_recharge_player_recharge::GOODS_ID_ERROR;
            $retCode_Str = 'GOODS_ID_ERROR';
            goto failed;
        }

        // 钻石数量
        // 基础钻石数量
        $baseDiamonds = intval($goodsConfig [configdata_recharge_setting::k_diamondnum]);
        // vip 经验
        $vipExp = intval($goodsConfig [configdata_recharge_setting::k_awardvipexp]);
        // 额外奖励钻石
        $additionalDiamonds = intval($goodsConfig [configdata_recharge_setting::k_rebatediamond]);
        // 首冲奖励钻石
        $firstRechargeAddDiamonds = 0;

        if ($this->get_rechargecount($goodsId) == 0) {
            //是首冲,增加首冲奖励钻石
            $firstRechargeAddDiamonds = intval($goodsConfig [configdata_recharge_setting::k_firstrebatediamond]);
        }

        $diamonds = $baseDiamonds + $additionalDiamonds + $firstRechargeAddDiamonds;
        $this->db_owner->db_role()->add_diamond($diamonds, constants_moneychangereason::RECHARGE);
        $this->db_owner->dbs_vip()->addvipexp($vipExp);

        //增加声望额度
        dbs_role::createWithPlayer($this->db_owner)->addReputationAmountByDiamond($diamonds);

        //增加利益输送额度
        dbs_payout_player::createWithPlayer($this->db_owner)->addPayoutAmount($diamonds);

        // 设置金额
        $rmb = intval($goodsConfig [configdata_recharge_setting::k_rmbnum]);
        $this->set_totalrechargemoney($this->get_totalrechargemoney() + $rmb);

        // 如果是月卡,激活月卡
        if (intval($goodsConfig [configdata_recharge_setting::k_ismonth]) == 1) {
            $this->db_owner->dbs_monthlycard()->active();
        }

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_64,
            $baseDiamonds);

        $data [constants_returnkey::RK_RMB] = $rmb;
        $data [constants_returnkey::RK_DIAMOND] = $diamonds;
        $data [constants_returnkey::RK_EXP] = $vipExp;
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}