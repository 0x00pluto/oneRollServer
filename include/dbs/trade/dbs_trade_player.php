<?php

namespace dbs\trade;

use Common\Db\Common_Db_memcacheObject;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use configdata\configdata_item_trade_setting;
use configdata\configdata_trade_box_setting;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use dbs\dbs_player;
use dbs\dbs_warehouse;
use dbs\filters\dbs_filters_role;
use dbs\robot\dbs_robot_manager;
use dbs\templates\trade\dbs_templates_trade_player;
use err\err_dbs_trade_player_cancelorder;
use err\err_dbs_trade_player_completeorder;
use err\err_dbs_trade_player_expandtradebox;
use err\err_dbs_trade_player_publicorder;
use err\err_dbs_trade_player_republicorder;
use err\err_dbs_trade_player_takebackcompleteorder;
use err\err_dbs_trade_player_takebackorderitem;

/**
 * 交易类
 * 2015年5月27日 下午2:55:31
 *
 * @author zhipeng
 *
 */
class dbs_trade_player extends dbs_templates_trade_player
{


    /**
     * 添加交易订单
     *
     * @param dbs_trade_data $data
     */
    private function set_trade_order(dbs_trade_data $data)
    {
        $orderlist = $this->get_tradeboxes();
        $orderlist [$data->get_tradeid()] = $data->toArray();
        $this->set_tradeboxes($orderlist);
    }

    /**
     * 获取交易订单
     *
     * @param string $tradeid
     * @return dbs_trade_data|NULL
     */
    private function get_trade_order($tradeid)
    {
        // $orderinfo
        $orderlist = $this->get_tradeboxes();
        if (array_key_exists_faster($tradeid, $orderlist)) {
            $orderdata = new dbs_trade_data ();
            $orderdata->fromArray($orderlist [$tradeid]);
            return $orderdata;
        }
        return null;
    }

    /**
     * 删除订单
     *
     * @param string $tradeid
     */
    private function remove_trade_order($tradeid)
    {
        $orderlist = $this->get_tradeboxes();
        unset ($orderlist [$tradeid]);
        $this->set_tradeboxes($orderlist);
    }


    /**
     * 获取交易次数限制
     *
     * @return dbs_trade_limit
     */
    public function get_tradetimeslimit_data()
    {
        $dataarr = $this->get_tradetimeslimit();
        $data = new dbs_trade_limit ();
        $data->fromArray($dataarr);
        return $data;
    }

    private function set_tradetimelimit_data(dbs_trade_limit $data)
    {
        $this->set_tradetimeslimit($data->toArray());
    }

    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 获取扩格子配置
     *
     * @param int $times
     *            次数
     * @return Ambigous <multitype:, string>
     */
    static function get_expandconfig($times)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_trade_box_setting::class, configdata_trade_box_setting::k_id, $times);
    }

    /**
     * 获取交易配置
     *
     * @param unknown $itemid
     * @return Ambigous <multitype:, string>
     */
    static function get_trade_itemconfig($itemid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_trade_setting::class, configdata_item_trade_setting::k_id, $itemid);
    }

    /**
     * 发布订单
     *
     * @param string $sellitemid
     *            出售物品id
     * @param int $sellitemnum
     *            出售物品数量 1~10
     * @param string $buyitemid
     *            求购物品id
     * @param int $buyitemnum
     *            求购物品数量 1~10
     * @return Common_Util_ReturnVar
     */
    function publicorder($sellitemid, $sellitemnum, $buyitemid, $buyitemnum)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_trade_player_publicorder{}

        $sellitemid = strval($sellitemid);
        $sellitemnum = intval($sellitemnum);

        $buyitemid = strval($buyitemid);
        $buyitemnum = intval($buyitemnum);

        $boxes = $this->get_tradeboxes();
        if (count($boxes) >= $this->get_tradeboxsize()) {
            $retCode = err_dbs_trade_player_publicorder::TRADE_BOXES_FULL;
            $retCode_Str = 'TRADE_BOXES_FULL';
            goto failed;
        }
        if ($sellitemid == $buyitemid) {
            $retCode = err_dbs_trade_player_publicorder::TRADE_ITEM_ID_SAME;
            $retCode_Str = 'TRADE_ITEM_ID_SAME';
            goto failed;
        }

        $itemmaxnum = Common_Util_Configdata::getInstance()->get_global_config_value('TRADE_ITEM_ORDER_ITEM_NUM_MAX')->int_value();

        if ($sellitemnum <= 0 || $sellitemnum > $itemmaxnum) {
            $retCode = err_dbs_trade_player_publicorder::TRADE_ITEM_SELL_ITEM_NUM_ERROR;
            $retCode_Str = 'TRADE_ITEM_SELL_ITEM_NUM_ERROR';
            goto failed;
        }

        if ($buyitemnum <= 0 || $buyitemnum > $itemmaxnum) {
            $retCode = err_dbs_trade_player_publicorder::TRADE_ITEM_BUY_ITEM_NUM_ERROR;
            $retCode_Str = 'TRADE_ITEM_BUY_ITEM_NUM_ERROR';
            goto failed;
        }

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $sellitemid);
        if (is_null($warehouse)) {
            $retCode = err_dbs_trade_player_publicorder::TRADE_SELL_ITEM_NOT_ENOUGH;
            $retCode_Str = 'TRADE_SELL_ITEM_NOT_ENOUGH';
            goto failed;
        }
        // 自己没有东西
        if (!$warehouse->hasItem($sellitemid, $sellitemnum)) {
            $retCode = err_dbs_trade_player_publicorder::TRADE_SELL_ITEM_NOT_ENOUGH;
            $retCode_Str = 'TRADE_SELL_ITEM_NOT_ENOUGH';
            goto failed;
        }

        $sellitemconfig = self::get_trade_itemconfig($sellitemid);
        if (is_null($sellitemconfig)) {
            $retCode = err_dbs_trade_player_publicorder::TRADE_ITEM_CANNOT_SELL;
            $retCode_Str = 'TRADE_ITEM_CANNOT_SELL';
            goto failed;
        }

        $buyitemconfig = self::get_trade_itemconfig($buyitemid);
        if (is_null($buyitemconfig)) {
            $retCode = err_dbs_trade_player_publicorder::TRADE_ITEM_CANNOT_BUY;
            $retCode_Str = 'TRADE_ITEM_CANNOT_BUY';
            goto failed;
        }

        // 比较价值
        $minvalue = Common_Util_Configdata::getInstance()->get_global_config_value('TRADE_ITEM_PRICE_RANGE_MIN')->float_value() / 10000;
        $maxvalue = Common_Util_Configdata::getInstance()->get_global_config_value('TRADE_ITEM_PRICE_RANGE_MAX')->float_value() / 10000;

        $selltotalvalue = $sellitemnum * intval($sellitemconfig [configdata_item_trade_setting::k_tradevalue]);
        $buytotalvalue = $buyitemnum * intval($buyitemconfig [configdata_item_trade_setting::k_tradevalue]);

        $maxsellvalue = $selltotalvalue * $maxvalue;
        $minsellvalue = $selltotalvalue * $minvalue;

        if ($buytotalvalue > $maxsellvalue || $buytotalvalue < $minsellvalue) {
            $retCode = err_dbs_trade_player_publicorder::TRADE_BUY_ITEM_VALUE_NOT_MATCH;
            $retCode_Str = 'TRADE_BUY_ITEM_VALUE_NOT_MATCH';
            goto failed;
        }

        // 删除道具

        $warehouse->removeItemByItemId($sellitemid, $sellitemnum);

        // 生成订单
        $tradedata = dbs_trade_data::create($this->get_userid(), $sellitemid, $sellitemnum, $buyitemid, $buyitemnum);
        $this->set_trade_order($tradedata);

        $data = $tradedata->toArray();

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_9, 1);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 重新发布订单
     *
     * @deprecated 没有这个需求了
     * @param unknown $tradeid
     *            交易id
     * @return Common_Util_ReturnVar
     */
    function republicorder($tradeid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_trade_player_republicorder{}

        $tradedata = $this->get_trade_order($tradeid);

        if (is_null($tradedata)) {
            $retCode = err_dbs_trade_player_republicorder::ORDER_NOT_EXISTS;
            $retCode_Str = 'ORDER_NOT_EXISTS';
            goto failed;
        }

        $expiretime = Common_Util_Configdata::getInstance()->get_global_config_value('TRADE_ITEM_TIMEOUT')->int_value();
        if (time() < $tradedata->get_publictime() + $expiretime) {
            $retCode = err_dbs_trade_player_republicorder::ORDER_NOT_EXPIRE;
            $retCode_Str = 'ORDER_NOT_EXPIRE';
            goto failed;
        }

        $tradedata->set_publictime(time());
        $this->set_trade_order($tradedata);

        $data = $tradedata->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 取消订单
     *
     * @param unknown $tradeid
     * @return Common_Util_ReturnVar
     */
    function cancelorder($tradeid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_trade_player_cancelorder{}
        $tradedata = $this->get_trade_order($tradeid);

        if (is_null($tradedata)) {
            $retCode = err_dbs_trade_player_cancelorder::ORDER_NOT_EXISTS;
            $retCode_Str = 'ORDER_NOT_EXISTS';
            goto failed;
        }

        $needdiamond = Common_Util_Configdata::getInstance()->get_global_config_value('TRADE_REMOVE_ITEM_NEED_DIAMOND')->int_value();
        if ($this->db_owner->db_role()->get_diamond() < $needdiamond) {
            $retCode = err_dbs_trade_player_cancelorder::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        $this->db_owner->db_role()->cost_diamond($needdiamond, constants_moneychangereason::TRADE_CANCEL_ORDER);

        // 删除订单
        $this->remove_trade_order($tradeid);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 取回订单道具
     *
     * @deprecated 没有这个需求了
     *
     * @param unknown $tradeid
     * @return Common_Util_ReturnVar
     */
    function takebackorderitem($tradeid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_trade_player_takebackorderitem{}
        $tradedata = $this->get_trade_order($tradeid);

        if (is_null($tradedata)) {
            $retCode = err_dbs_trade_player_takebackorderitem::ORDER_NOT_EXISTS;
            $retCode_Str = 'ORDER_NOT_EXISTS';
            goto failed;
        }

        $expiretime = Common_Util_Configdata::getInstance()->get_global_config_value('TRADE_ITEM_TIMEOUT')->int_value();

        if (time() < $tradedata->get_publictime() + $expiretime) {
            $retCode = err_dbs_trade_player_takebackorderitem::ORDER_NOT_EXPIRE;
            $retCode_Str = 'ORDER_NOT_EXPIRE';
            goto failed;
        }

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $tradedata->get_sellitemid());
        if (!$warehouse->testItemCanPut($tradedata->get_sellitemid(), $tradedata->get_sellitemnum())) {
            $retCode = err_dbs_trade_player_takebackorderitem::WAREHOUSE_FULL;
            $retCode_Str = 'WAREHOUSE_FULL';
            goto failed;
        }

        // 返还物品
        $warehouse->addItemByItemId($tradedata->get_sellitemid(), $tradedata->get_sellitemnum());

        // 删除订单
        $this->remove_trade_order($tradeid);

        $data = $tradedata->toArray();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 扩充交易格子
     *
     * @return Common_Util_ReturnVar
     */
    function expandtradebox()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_trade_player_expandtradebox{}

        if ($this->get_diamondexpandtimes() >= Common_Util_Configdata::getInstance()->get_global_config_value('TRADE_BOX_DIAMOND_BUY_MAX_TIMES')->int_value()) {
            $retCode = err_dbs_trade_player_expandtradebox::EXPAND_SIZE_MAX;
            $retCode_Str = 'EXPAND_SIZE_MAX';
            goto failed;
        }

        $expandtimes = $this->get_diamondexpandtimes() + 1;

        $expandconfig = self::get_expandconfig($expandtimes);
        if (is_null($expandconfig)) {
            $retCode = err_dbs_trade_player_expandtradebox::EXPAND_CONFIG_ERROR;
            $retCode_Str = 'EXPAND_CONFIG_ERROR';
            goto failed;
        }

        $needdiamond = intval($expandconfig [configdata_trade_box_setting::k_diamond]);
        if ($this->db_owner->db_role()->get_diamond() < $needdiamond) {
            $retCode = err_dbs_trade_player_expandtradebox::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        $this->db_owner->db_role()->cost_diamond($needdiamond, constants_moneychangereason::TRADE_EXPAND_BOX);

        $this->set_diamondexpandtimes($expandtimes);
        $this->set_tradeboxsize($this->get_tradeboxsize() + 1);

        $data [constants_returnkey::RK_DIAMOND] = $needdiamond;
        $data [constants_returnkey::RK_NUM] = $expandtimes;
        $data ['expandsize'] = $this->get_tradeboxsize();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 取回完成的订单物品
     *
     * @param unknown $tradeid
     * @return Common_Util_ReturnVar
     */
    function takebackcompleteorder($tradeid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_trade_player_takebackcompleteorder{}

        $tradeid = strval($tradeid);
        // class err_dbs_trade_player_takebackorderitem{}
        $tradedata = $this->get_trade_order($tradeid);

        if (is_null($tradedata)) {
            $retCode = err_dbs_trade_player_takebackcompleteorder::ORDER_NOT_EXISTS;
            $retCode_Str = 'ORDER_NOT_EXISTS';
            goto failed;
        }

        if (!$tradedata->get_iscomplete()) {
            $retCode = err_dbs_trade_player_takebackcompleteorder::ORDER_NOT_COMPLETE;
            $retCode_Str = 'ORDER_NOT_COMPLETE';
            goto failed;
        }

        $itemid = $tradedata->get_buyitemid();
        $itemcount = $tradedata->get_buyitemnum();

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);
        if (false && !$warehouse->testItemCanPut($itemid, $itemcount)) {
            $retCode = err_dbs_trade_player_takebackcompleteorder::WAREHOUSE_FULL;
            $retCode_Str = 'WAREHOUSE_FULL';
            goto failed;
        }

        // 添加物品
        $warehouse->addItemByItemId($itemid, $itemcount, true);

        // 删除订单
        $this->remove_trade_order($tradeid);

        $data = $tradedata->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 完成订单
     *
     * @param string $destuserid
     * @param string $tradeid
     * @return Common_Util_ReturnVar
     */
    function completeorder($destuserid, $tradeid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_trade_player_completeorder{}

        $destuserid = strval($destuserid);
        $tradeid = strval($tradeid);

        if ($destuserid == $this->get_userid()) {
            $retCode = err_dbs_trade_player_completeorder::CANNOT_TRADE_ME;
            $retCode_Str = 'CANNOT_TRADE_ME';
            goto failed;
        }

        $limitdata = $this->get_tradetimeslimit_data();
        if ($limitdata->is_trade_times_max()) {
            $retCode = err_dbs_trade_player_completeorder::LIMIT_TRADE_NUM_ALL;
            $retCode_Str = 'LIMIT_TRADE_NUM_ALL';
            goto failed;
        }

        $destplayer = dbs_player::newGuestPlayerWithLock($destuserid);
        if (!$destplayer->isRoleExists()) {
            $retCode = err_dbs_trade_player_completeorder::NOT_DEST_PLAYER;
            $retCode_Str = 'NOT_DEST_PLAYER';
            goto failed;
        }

        $tradedata = $destplayer->dbs_trade_player()->get_trade_order($tradeid);
        if (is_null($tradedata)) {
            $retCode = err_dbs_trade_player_completeorder::NOT_DEST_ORDER;
            $retCode_Str = 'NOT_DEST_ORDER';
            goto failed;
        }

        if ($limitdata->is_trade_times_max_by_userid($destuserid)) {
            $retCode = err_dbs_trade_player_completeorder::LIMIT_TRADE_SINGLE_PLAYER;
            $retCode_Str = 'LIMIT_TRADE_SINGLE_PLAYER';
            goto failed;
        }

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $tradedata->get_buyitemid());
        if (!$warehouse->hasItem($tradedata->get_buyitemid(), $tradedata->get_buyitemnum())) {
            $retCode = err_dbs_trade_player_completeorder::ITEM_NOT_ENOUGH;
            $retCode_Str = 'ITEM_NOT_ENOUGH';
            goto failed;
        }

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $tradedata->get_sellitemid());
        // dump ( $tradedata->toArray () );
        if (!$warehouse->testItemCanPut($tradedata->get_sellitemid(), $tradedata->get_sellitemnum())) {
            $retCode = err_dbs_trade_player_completeorder::WAREHOUSE_FULL;
            $retCode_Str = 'WAREHOUSE_FULL';
            goto failed;
        }

        if ($tradedata->get_iscomplete()) {
            $retCode = err_dbs_trade_player_completeorder::ORDER_ALREADY_COMPLETE;
            $retCode_Str = 'ORDER_ALREADY_COMPLETE';
            goto failed;
        }

        // 删除自己的东西
        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $tradedata->get_buyitemid());
        $warehouse->removeItemByItemId($tradedata->get_buyitemid(), $tradedata->get_buyitemnum());
        // 把出售的东西放到仓库
        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $tradedata->get_sellitemid());
        $warehouse->addItemByItemId($tradedata->get_sellitemid(), $tradedata->get_sellitemnum());

        // 设置交易完成
        $tradedata->set_iscomplete(true);
        $buyuserinfo = $this->db_owner->db_role()->toArray(dbs_filters_role::$filters_simple_info);
        $tradedata->set_buyplayerinfo($buyuserinfo);

        $destplayer->dbs_trade_player()->set_trade_order($tradedata);

        // 给出售方把东西寄过去
        // $mail = dbs_mailbox_data::alloc ( '寄卖成功', '您的物品寄卖成功,已经被 ' . $this->get_userid () . ' 购买成功!' );
        // $mail->addattachmentitem ( $tradedata->get_buyitemid (), $tradedata->get_buyitemnum () );
        // $destplayer->dbs_mailbox_list ()->sendmail ( $mail );
        // 删除交易
        // $destplayer->dbs_trade_player ()->remove_trade_order ( $tradeid );

        // 记录交易次数
        $limitdata->addtrade($destuserid, $tradedata);
        $this->set_tradetimelimit_data($limitdata);

        // 增加完成成就接口
        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_8, 1);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取邻居的出售列表
     *
     * @return Common_Util_ReturnVar
     */
    function getneighbourhoodorderlist()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_trade_player_getneighbourhoodorderlist{}

        $memcacheObj = Common_Db_memcacheObject::create('getneighbourhoodorderlist' . $this->get_userid());
        $memcacheObj->setExpiration(30);
        $data = $memcacheObj->get_value();

        if (is_null($data)) {

            $data = [];
            $group = $this->db_owner->dbs_neighbourhood_playerdata()->get_groupdata();

            if (!is_null($group)) {

                $orderlist = array();
                $member = $group->get_member();
                foreach ($member as $userid => $value) {
                    if ($userid === $this->get_userid()) {
                        continue;
                    }

                    $destplayer = dbs_player::newGuestPlayer($userid);
                    if (!$destplayer->isRoleExists()) {
                        continue;
                    }

                    $tradebox = $destplayer->dbs_trade_player()->get_tradeboxes();

                    $orderlist = array_merge($orderlist, $tradebox);
                }

                $data = array();
                foreach ($orderlist as $orderid => $order) {
                    if ($order [dbs_trade_data::DBKey_iscomplete] == true) {
                        unset ($orderlist [$orderid]);
                    }
                }

                $data = $orderlist;

                $memcacheObj->set_value($data);
            }
        }

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取好友出售列表
     *
     * @return Common_Util_ReturnVar
     */
    function getfriendorderlist()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_trade_player_getfriendorderlist{}

        $memcacheObj = Common_Db_memcacheObject::create(__METHOD__ . $this->get_userid());
        $memcacheObj->setExpiration(30);
        $data = $memcacheObj->get_value();

        if (is_null($data)) {
            $friendlist = $this->db_owner->db_friend()->get_friendlist();

            $orderlist = array();
            foreach ($friendlist as $userid => $value) {
                if ($userid === $this->get_userid()) {
                    continue;
                }

                $destplayer = dbs_player::newGuestPlayer($userid);
                if (!$destplayer->isRoleExists()) {
                    continue;
                }

                $tradebox = $destplayer->dbs_trade_player()->get_tradeboxes();

                // dump ( $tradebox );
                $orderlist = array_merge($orderlist, $tradebox);
            }

            $data = array();
            foreach ($orderlist as $orderid => $order) {
                if ($order [dbs_trade_data::DBKey_iscomplete] == true) {
                    unset ($orderlist [$orderid]);
                }
            }

            $data = $orderlist;
            $memcacheObj->set_value($data);
        }
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 机器人自动购买
     */
    private function _npc_auto_buy()
    {
        $expiretime = Common_Util_Configdata::getInstance()->get_global_config_value('TRADE_ITEM_TIMEOUT')->int_value();

        $tradedatalist = $this->get_tradeboxes();
        // npc完成的几率
        $npcbuyratio = Common_Util_Configdata::getInstance()->get_global_config_value('TRADE_NPC_BUY_RATIO')->int_value();

        foreach ($tradedatalist as $tradeid => $value) {
            $tradedata = new dbs_trade_data ();
            $tradedata->fromArray($value);

            if (time2() > $tradedata->get_publictime() + $expiretime && !$tradedata->get_npctrybuy() && !$tradedata->get_iscomplete()) {
                // npc购买
                $tradedata->set_npctrybuy(true);
                $random = rand(0, 10000);
                if ($random < $npcbuyratio) {
                    // npc购买

                    $robotUserId = dbs_robot_manager::getInstance()->getRandomRobotId();

                    $robot = dbs_player::newGuestPlayerWithLock($robotUserId);

                    // 设置交易完成
                    $tradedata->set_iscomplete(true);
                    $buyuserinfo = $robot->db_role()->toArray(dbs_filters_role::$filters_simple_info);
                    dump($buyuserinfo);
                    $tradedata->set_buyplayerinfo($buyuserinfo);

                    $this->set_trade_order($tradedata);

                    // 把东西寄过去
                    // $mail = dbs_mailbox_data::alloc ( '寄卖成功', '您的物品寄卖成功,已经被 robotid 购买成功!' );
                    // $mail->addattachmentitem ( $tradedata->get_buyitemid (), $tradedata->get_buyitemnum () );
                    // $this->db_owner->dbs_mailbox_list ()->sendmail ( $mail );

                    // 删除交易
                    // $this->remove_trade_order ( $tradedata->get_tradeid () );
                } else {
                    $this->set_trade_order($tradedata);
                }
            }
        }
    }

    function masterbeforecall()
    {
        $limitdata = $this->get_tradetimeslimit_data();
        if ($limitdata->get_dayflag() != Common_Util_Time::getGameDay()) {
            $limitdata->nextday();
            $this->set_tradetimelimit_data($limitdata);
        }
        $this->_npc_auto_buy();
    }
}