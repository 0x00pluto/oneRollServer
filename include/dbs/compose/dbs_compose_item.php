<?php

namespace dbs\compose;

use dbs\dbs_baseplayer;
use Common\Util\Common_Util_Configdata;
use configdata\configdata_item_compose_slots_setting;
use configdata\configdata_item_compose_setting;
use constants\constants_defaultvalue;
use err\err_dbs_compose_item_opendiamondslot;
use Common\Util\Common_Util_ReturnVar;
use err\err_dbs_compose_item_compose;
use dbs\dbs_warehouse;
use constants\constants_moneychangereason;
use err\err_dbs_compose_item_harvestcomposeitem;
use constants\constants_returnkey;
use constants\constants_mission;

/**
 * 合成道具服务
 *
 * @author zhipeng
 *
 */
class dbs_compose_item extends dbs_baseplayer
{
    /**
     * 获取槽位配置
     *
     * @param unknown $slotid
     * @return Ambigous <multitype:, string>
     */
    static function get_slotconfig($slotid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_compose_slots_setting::class, configdata_item_compose_slots_setting::k_id, $slotid);
    }

    /**
     * 获取合成配置
     *
     * @param unknown $composeid
     */
    static function get_composeconfig($composeid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_compose_setting::class, configdata_item_compose_setting::k_id, $composeid);
    }

    /**
     * 等级开启的孔数量
     *
     * @var string
     */
    const DBKey_levelslotscount = "levelslotscount";

    /**
     * 获取等级开启的孔数量
     */
    public function get_levelslotscount()
    {
        return $this->getdata(self::DBKey_levelslotscount);
    }

    /**
     * 设置等级开启的孔数量
     *
     * @param  $value
     */
    private function set_levelslotscount($levelslotscount)
    {
        $this->setdata(self::DBKey_levelslotscount, $levelslotscount);
    }

    /**
     * 钻石开启的孔的数量
     *
     * @var string
     */
    const DBKey_diamondslotscount = "diamondslotscount";

    /**
     * 获取钻石开启的孔的数量
     */
    public function get_diamondslotscount()
    {
        return $this->getdata(self::DBKey_diamondslotscount);
    }

    /**
     * 设置钻石开启的孔的数量
     *
     * @param int $value
     */
    private function set_diamondslotscount($diamondslotscount)
    {
        $this->setdata(self::DBKey_diamondslotscount, $diamondslotscount);
    }

    /**
     * 插槽
     *
     * @var string
     */
    const DBKey_slots = "slots";

    /**
     * 获取插槽
     */
    public function get_slots()
    {
        return $this->getdata(self::DBKey_slots);
    }

    /**
     * 设置插槽
     *
     * @param unknown $value
     */
    private function set_slots($slots)
    {
        $this->setdata(self::DBKey_slots, $slots);
    }

    /**
     * 获取合成位置数据
     *
     * @param int $slotid
     *            位置id
     * @return NULL|dbs_compose_itemdata
     */
    public function get_slots_data($slotid)
    {
        $slotid = intval($slotid);
        $slots = $this->get_slots();
        $slotdata = null;
        if (!array_key_exists_faster($slotid, $slots)) {
            return null;
        }
        $slotdata = $slots [$slotid];

        $data = new dbs_compose_itemdata ($slotid);
        $data->fromArray($slotdata);

        return $data;
    }

    /**
     * 保存位置数据
     *
     * @param dbs_compose_itemdata $data
     */
    public function set_slots_data(dbs_compose_itemdata $data)
    {
        $slots = $this->get_slots();
        $slots [$data->get_slotsid()] = $data->toArray();
        $this->set_slots($slots);
    }

    /**
     * 合成数量
     *
     * @var string
     */
    const DBKey_composehistory = "composehistory";

    /**
     * 获取 合成数量
     */
    private function get_composehistory()
    {
        return $this->getdata(self::DBKey_composehistory);
    }

    /**
     * 设置 合成数量
     *
     * @param unknown $value
     */
    private function set_composehistory($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_composehistory, $value);
    }

    /**
     * 设置 合成数量 默认值
     */
    protected function _set_defaultvalue_composehistory()
    {
        $this->set_defaultkeyandvalue(self::DBKey_composehistory, array());
    }

    const DBKey_tablename = 'compose_item';

    function __construct()
    {
        parent::__construct(self::DBKey_tablename, array(
            self::DBKey_userid => constants_defaultvalue::USERID_EMPTY,
            self::DBKey_diamondslotscount => 0,
            self::DBKey_slots => array(),
            self::DBKey_levelslotscount => 0
        ));
    }

    /**
     * 增加合成记录
     *
     * @param unknown $composeitemid
     * @param unknown $composeitemcount
     */
    private function addComposeHistory($composeitemid, $composeitemcount)
    {
        $composeitemcount = intval($composeitemcount);
        $count = 0;
        $list = $this->get_composehistory();
        if (isset ($list [$composeitemid])) {
            $count = $list [$composeitemid];
        }
        $count += $composeitemcount;
        $list [$composeitemid] = $count;
        $this->set_composehistory($list);
    }

    /**
     * 开启等级孔
     */
    public function openlevelslots()
    {
        $slotscount = $this->get_levelslotscount();
        $restaruantlevel = $this->db_owner->db_restaurantinfo()->get_restaurantlevel();
        while (true) {
            $nextslotscount = $slotscount + 1;
            $config = self::get_slotconfig($nextslotscount);
            if (!is_null($config) && intval($config [configdata_item_compose_slots_setting::k_restaurantlevel]) <= $restaruantlevel) {
                $slotscount = $nextslotscount;
                continue;
            } else {
                break;
            }
        }

        if ($slotscount != $this->get_levelslotscount()) {
            $this->set_levelslotscount($slotscount);
        }

        $slots = $this->get_slots();
        for ($i = 1; $i <= $this->get_levelslotscount(); $i++) {

            if (!array_key_exists($i, $slots)) {
                $data = new dbs_compose_itemdata ($i);

                $slots [$i] = $data->toArray();
            }
        }

        for ($i = 1; $i <= $this->get_diamondslotscount(); $i++) {

            $slotid = 1000 + $i;
            if (!array_key_exists($slotid, $slots)) {
                $data = new dbs_compose_itemdata ($slotid);

                $slots [$slotid] = $data->toArray();
            }
        }

        $this->set_slots($slots);
    }

    /**
     * 服务是否开启
     */
    public function is_serviceopen()
    {
        $restaruantlevel = $this->db_owner->db_restaurantinfo()->get_restaurantlevel();

        $needlevel = intval(Common_Util_Configdata::getInstance()->get_global_config('COMPOSE_ITEM_OPEN_LEVEL'));
        return $restaruantlevel >= $needlevel;
    }

    /**
     * 开启钻石槽位
     *
     * @return Common_Util_ReturnVar
     */
    function opendiamondslot()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        if (!$this->is_serviceopen()) {
            $retCode = err_dbs_compose_item_opendiamondslot::COMPOSE_SERVICE_NOT_OPEN;
            $retCode_Str = 'COMPOSE_SERVICE_NOT_OPEN';
            goto failed;
        }

        $slotscount = $this->get_diamondslotscount();

        $nextslotscount = $slotscount + 1;
        $config = self::get_slotconfig(1000 + $nextslotscount);
        if (is_null($config)) {
            $retCode = err_dbs_compose_item_opendiamondslot::SLOTS_COUNT_MAX;
            $retCode_Str = 'SLOTS_COUNT_MAX';
            goto failed;
        }

        $needdiamond = intval($config [configdata_item_compose_slots_setting::k_diamond]);
        if ($this->db_owner->db_role()->get_diamond() < $needdiamond) {
            $retCode = err_dbs_compose_item_opendiamondslot::NOT_ENOUGH_DIAMOND;
            $retCode_Str = 'NOT_ENOUGH_DIAMOND';
            goto failed;
        }

        $this->db_owner->db_role()->cost_diamond($needdiamond, constants_moneychangereason::UPGRAGE_ITEM_COMPOSE_SLOTS);
        $this->set_diamondslotscount($nextslotscount);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 合成.合成id
     *
     * @param string $slotid
     *            合成位置
     * @param string $composeid
     *            合成id
     * @return Common_Util_ReturnVar
     */
    function compose($slotid, $composeid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $slotid = strval($slotid);
        $composeid = strval($composeid);

        if (!$this->is_serviceopen()) {
            $retCode = err_dbs_compose_item_compose::COMPOSE_SERVICE_NOT_OPEN;
            $retCode_Str = 'COMPOSE_SERVICE_NOT_OPEN';
            goto failed;
        }

        $slots = $this->get_slots();
        // dump ( $slots );
        if (!array_key_exists($slotid, $slots)) {
            $retCode = err_dbs_compose_item_compose::SLOTS_NOT_EXISTS;
            $retCode_Str = 'SLOTS_NOT_EXISTS';
            goto failed;
        }

        $slotdata = new dbs_compose_itemdata ($slotid);
        $slotdata->fromArray($slots [$slotid]);

        if ($slotdata->get_isbusy()) {
            $retCode = err_dbs_compose_item_compose::SLOTS_IS_BUSY;
            $retCode_Str = 'SLOTS_IS_BUSY';
            goto failed;
        }

        $config = self::get_composeconfig($composeid);
        if (is_null($config)) {
            $retCode = err_dbs_compose_item_compose::COMPOSE_CONFIG_ERR;
            $retCode_Str = 'COMPOSE_CONFIG_ERR';
            goto failed;
        }

        // 合成等级不够
        if (intval($config [configdata_item_compose_setting::k_restaruantlevel]) > $this->db_owner->db_restaurantinfo()->get_restaurantlevel()) {
            $retCode = err_dbs_compose_item_compose::RESTARUANT_LEVEL_NOT_ENOUGH;
            $retCode_Str = 'RESTARUANT_LEVEL_NOT_ENOUGH';
            goto failed;
        }

        $gamecoin = intval($config [configdata_item_compose_setting::k_srcgamecoin]);
        $diamond = intval($config [configdata_item_compose_setting::k_srcdiamond]);

        if ($this->db_owner->db_role()->get_gamecoin() < $gamecoin) {
            $retCode = err_dbs_compose_item_compose::COMPOSE_MATERIAL_NOT_ENOUGH;
            $retCode_Str = 'COMPOSE_MATERIAL_NOT_ENOUGH';
            goto failed;
        }

        if ($this->db_owner->db_role()->get_diamond() < $diamond) {
            $retCode = err_dbs_compose_item_compose::COMPOSE_MATERIAL_NOT_ENOUGH;
            $retCode_Str = 'COMPOSE_MATERIAL_NOT_ENOUGH';
            goto failed;
        }

        $items = array();
        if (array_key_exists(configdata_item_compose_setting::k_srcitemid1, $config)) {
            $items [$config [configdata_item_compose_setting::k_srcitemid1]] = intval($config [configdata_item_compose_setting::k_srcitemcount1]);
        }
        if (array_key_exists(configdata_item_compose_setting::k_srcitemid2, $config)) {
            $items [$config [configdata_item_compose_setting::k_srcitemid2]] = intval($config [configdata_item_compose_setting::k_srcitemcount2]);
        }
        if (array_key_exists(configdata_item_compose_setting::k_srcitemid3, $config)) {
            $items [$config [configdata_item_compose_setting::k_srcitemid3]] = intval($config [configdata_item_compose_setting::k_srcitemcount3]);
        }

        foreach ($items as $key => $value) {
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $key);
            if (!is_null($warehouse)) {
                if (!$warehouse->hasItem($key, $value)) {
                    $retCode = err_dbs_compose_item_compose::COMPOSE_MATERIAL_NOT_ENOUGH;
                    $retCode_Str = 'COMPOSE_MATERIAL_NOT_ENOUGH';
                    goto failed;
                }
            }
        }

        // 消耗物品
        $this->db_owner->db_role()->cost_diamond($diamond, constants_moneychangereason::COMPOSE_ITEM);
        $this->db_owner->db_role()->cost_gamecoin($gamecoin, constants_moneychangereason::COMPOSE_ITEM);

        foreach ($items as $key => $value) {
            $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $key);
            if (!is_null($warehouse)) {
                $warehouse->removeItemByItemId($key, $value);
            }
        }

        $timeout = intval($config [configdata_item_compose_setting::k_time]);

        $slotdata->set_isbusy(true);
        $slotdata->set_composeid($composeid);
        $slotdata->set_finishtime(time() + $timeout);

        $slots [$slotid] = $slotdata->toArray();
        $this->set_slots($slots);

        // dump ( $slots );
        // $this->dumpDB ();

//        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_18, 1);
//		$this->db_owner->db_mission ()->set_mission_object_type_count ( constants_mission::MISSION_FINISH_CONDITION_103, $config [configdata_item_compose_setting::k_destitemid], 1 );
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 收获合成物品
     *
     * @param unknown $slotid
     * @return Common_Util_ReturnVar
     */
    function harvestcomposeitem($slotid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_compose_item_harvestcomposeitem{}

        $slotid = strval($slotid);

        if (!$this->is_serviceopen()) {
            $retCode = err_dbs_compose_item_harvestcomposeitem::COMPOSE_SERVICE_NOT_OPEN;
            $retCode_Str = 'COMPOSE_SERVICE_NOT_OPEN';
            goto failed;
        }
        // code

        $slots = $this->get_slots();
        if (!array_key_exists($slotid, $slots)) {
            $retCode = err_dbs_compose_item_harvestcomposeitem::SLOTS_NOT_EXISTS;
            $retCode_Str = 'SLOTS_NOT_EXISTS';
            goto failed;
        }

        $slotdata = new dbs_compose_itemdata ($slotid);
        $slotdata->fromArray($slots [$slotid]);

        if (!$slotdata->get_isbusy()) {
            $retCode = err_dbs_compose_item_harvestcomposeitem::SLOT_EMPTY;
            $retCode_Str = 'SLOT_EMPTY';
            goto failed;
        }

        if (time() < $slotdata->get_finishtime()) {
            $retCode = err_dbs_compose_item_harvestcomposeitem::COOLDOWN;
            $retCode_Str = 'COOLDOWN';
            goto failed;
        }

        $config = self::get_composeconfig($slotdata->get_composeid());

        $itemid = $config [configdata_item_compose_setting::k_destitemid];
        $itemcount = intval($config [configdata_item_compose_setting::k_destitemcount]);

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemid);
        if (!is_null($warehouse)) {
            if (!$warehouse->testItemCanPut($itemid, $itemcount)) {
                $retCode = err_dbs_compose_item_harvestcomposeitem::WAREHOUSE_FULL;
                $retCode_Str = 'WAREHOUSE_FULL';
                goto failed;
            }
        }

        $rate = intval($config [configdata_item_compose_setting::k_successrate]);
        $rand = rand(0, 10000);
        $success = false;
        // 成功
        if ($rand <= $rate) {
            $success = true;
        }

        if ($success) {
            if (!is_null($warehouse)) {
                $warehouse->addItemByItemId($itemid, $itemcount);
            }
            $this->addComposeHistory($itemid, $itemcount);
            $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_17, count($this->get_composehistory()));
        }

        $slotdata->set_isbusy(false);
        $slotdata->set_composeid('');
        $slotdata->set_finishtime(0);

        $slots [$slotid] = $slotdata->toArray();
        $this->set_slots($slots);

        $data [constants_returnkey::RK_SUCC] = $success;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}