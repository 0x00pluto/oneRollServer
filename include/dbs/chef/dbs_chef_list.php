<?php

namespace dbs\chef;

use Common\Db\Common_Db_memcacheObject;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Guid;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_Time;
use configdata\configdata_chef_fill_vit_setting;
use configdata\configdata_chef_goodwill_level_setting;
use configdata\configdata_chef_open_award_setting;
use configdata\configdata_chef_open_setting;
use configdata\configdata_chef_setting;
use configdata\configdata_chef_train_fashion_dress_sell_item_group_setting;
use configdata\configdata_chef_train_setting;
use configdata\configdata_chef_upgrade_setting;
use configdata\configdata_chef_upgradestage_setting;
use configdata\configdata_item_fashion_dress_setting;
use configdata\configdata_item_setting;
use constants\constants_chefstatus;
use constants\constants_itemFromInfo;
use constants\constants_mailTemplates;
use constants\constants_messagecmd;
use constants\constants_mission;
use constants\constants_moneychangereason;
use constants\constants_returnkey;
use constants\constants_roleReputationChangeReason;
use dbs\chef\employ\dbs_chef_employ_player;
use dbs\chef\employ\dbs_chef_employ_request;
use dbs\chef\jobs\dbs_chef_jobs_player;
use dbs\chef\train\dbs_chef_train_FashionShop;
use dbs\chef\train\dbs_chef_train_Room;
use dbs\chef\train\dbs_chef_train_RoomData;
use dbs\chef\train\dbs_chef_train_RoomRequestData;
use dbs\dbs_friend;
use dbs\dbs_item;
use dbs\dbs_mission;
use dbs\dbs_player;
use dbs\dbs_restaurantinfo;
use dbs\dbs_role;
use dbs\dbs_sync;
use dbs\dbs_userkvstore;
use dbs\dbs_warehouse;
use dbs\filters\dbs_filters_role;
use dbs\friend\dbs_friend_recommenddata;
use dbs\i\dbs_i_iday;
use dbs\item\dbs_item_equipment;
use dbs\item\dbs_item_fashionDress;
use dbs\item\dbs_item_normal;
use dbs\mailbox\dbs_mailbox_data;
use dbs\neighbourhood\dbs_neighbourhood_playerdata;
use dbs\payout\dbs_payout_player;
use dbs\robot\dbs_robot_data;
use dbs\robot\dbs_robot_logicTrait;
use dbs\robot\dbs_robot_manager;
use dbs\robot\dbs_robot_player;
use dbs\templates\chef\dbs_templates_chef_list;
use dbs\warehouse\dbs_warehouse_fashionDress;
use err\err_dbs_chef_list_acceptJoinTrainChef;
use err\err_dbs_chef_list_cancelJoinTrainChef;
use err\err_dbs_chef_list_fashionDressPutOn;
use err\err_dbs_chef_list_fashionDressTakeOff;
use err\err_dbs_chef_list_fillchefvit;
use err\err_dbs_chef_list_joinTrainChef;
use err\err_dbs_chef_list_puton;
use err\err_dbs_chef_list_refuseJoinChefTrain;
use err\err_dbs_chef_list_sendGiftToJoinRequest;
use err\err_dbs_chef_list_takeoff;
use err\err_dbs_chef_list_trainChef;
use err\err_dbs_chef_list_trainChefFashionShopBuy;
use err\err_dbs_chef_list_trainChefFinish;
use err\err_dbs_chef_list_trainChefPublishAdvertisement;
use err\err_service_chef_choose;
use hellaEngine\exception\exception_logicError;

/**
 * 厨师列表
 *
 * @author zhipeng
 *
 */
class dbs_chef_list extends dbs_templates_chef_list implements dbs_i_iday
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

    /**
     * 获取开启配置
     *
     * @param string $orderid 顺序id
     * @return Ambigous <multitype:, string>
     */
    public static function get_openconfig($orderid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_chef_open_setting::class, configdata_chef_open_setting::k_id, $orderid);
    }

    /**
     * 获取恢复体力配置
     *
     * @param  $times
     * @return null
     */
    public static function get_fillvitconfig($times)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_chef_fill_vit_setting::class, configdata_chef_fill_vit_setting::k_times, $times);
    }

    /**
     * 获得厨师主要属性,升级属性啥的
     *
     * @param $chefid
     * @return null
     */
    public static function get_chef_config($chefid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_chef_setting::class, configdata_chef_setting::k_npcid, $chefid);
    }

    /**
     * 获取升阶配置
     *
     * @param  $stageLevel
     * @return null
     */
    public static function get_chef_stage_config($stageLevel)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_chef_upgradestage_setting::class, configdata_chef_upgradestage_setting::k_level, $stageLevel);
    }

    /**
     * 获取升级配置
     *
     * @param  $level
     * @return null
     */
    public static function get_chef_level_config($level)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_chef_upgrade_setting::class, configdata_chef_upgrade_setting::k_level, $level);
    }

    /**
     * 获取好感度配置
     *
     * @param  $level
     * @return null
     */
    public static function get_chef_goodwillconfig($level)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_chef_goodwill_level_setting::class, configdata_chef_goodwill_level_setting::k_level, $level);
    }


    /**
     * 获得厨师
     *
     * @param string $chefid
     * @return dbs_chef_data|NULL
     */
    public function get_chef($chefid)
    {
        $chef = NULL;
        $cheflist = $this->get_cheflist();
        if (array_key_exists_faster($chefid, $cheflist)) {
            $chef = new dbs_chef_data ();
            $chef->fromArray($cheflist [$chefid]);
        }
        return $chef;
    }

    /**
     * 保存厨师
     *
     * @param dbs_chef_data $chef
     */
    public function set_chef(dbs_chef_data $chef)
    {
        $cheflist = $this->get_cheflist();
        $cheflist [$chef->get_guid()] = $chef->toArray();
        $this->set_cheflist($cheflist);
    }


    /**
     * 选择厨子
     * @param int $chefOrderId 厨师选择顺序ID
     * @param array $selectedAwardIds 选择奖励的ID数组
     * @return Common_Util_ReturnVar
     */
    function choose($chefOrderId, array $selectedAwardIds)
    {

        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        typeCheckNumber($chefOrderId);
//        typeCheckNumber($selectedAwardId);


        //已经选择的列表
        $chooseChefs = $this->get_chooselist();
        logicErrorCondition(!isset($chooseChefs[$chefOrderId]),
            err_service_chef_choose::ALREADY_CHOOSE,
            "ALREADY_CHOOSE");

        $chooseConfig = getConfigData(configdata_chef_open_setting::class,
            configdata_chef_open_setting::k_id,
            $chefOrderId);

        logicErrorCondition(!is_null($chooseConfig),
            err_service_chef_choose::CHOOSE_CONFIG_ERROR,
            "CHOOSE_CONFIG_ERROR");

        $restaruantLevel = $this->db_owner->db_restaurantinfo()->get_restaurantlevel();
        $sex = $this->db_owner->db_role()->get_sex();

        logicErrorCondition(intval($chooseConfig[configdata_chef_open_setting::k_rolesex]) === $sex,
            err_service_chef_choose::CHOOSE_SEX_NOT_MATCH,
            "CHOOSE_SEX_NOT_MATCH");

        //前置厨子没有开启
        $preOpenid = intval($chooseConfig[configdata_chef_open_setting::k_preopenid]);
        if ($preOpenid !== -1) {
            logicErrorCondition(isset($chooseChefs[$preOpenid]),
                err_service_chef_choose::PRE_CHEF_NOT_OPEN,
                "PRE_CHEF_NOT_OPEN");
        }

        //餐厅等级不够
        logicErrorCondition($restaruantLevel >= intval($chooseConfig[configdata_chef_open_setting::k_restaurantlevel]),
            err_service_chef_choose::LEVEL_NOT_ENOUGH,
            "LEVEL_NOT_ENOUGH");

        //选择厨师
        $chefList = $this->get_cheflist();
        //添加到已选择列表中
        $chefTemplateId = $chooseConfig[configdata_chef_open_setting::k_openchefid];
        $chef = new dbs_chef_data ();
        $chef->set_cheftemplateid($chefTemplateId);
        $chef->set_guid(Common_Util_Guid::gen_chefguid());
        $chef->set_isSelf(intval($chooseConfig[configdata_chef_open_setting::k_isself]) == 1);
        //首次补充满体力
        $chef->fillVitToFull();
        $chefList [$chef->get_guid()] = $chef->toArray();

        $chooseChefs[$chefOrderId] = $chef->get_guid();


        //发送厨师


        $awardId = $chooseConfig[configdata_chef_open_setting::k_awardgroupid];
        $awardItemConfigs = [];

        //奖励配置
        foreach (configdata_chef_open_award_setting::data() as $data) {
            if ($data[configdata_chef_open_award_setting::k_groupid] === $awardId) {
                $awardItemConfigs[intval($data[configdata_chef_open_award_setting::k_id])] = $data;
            }
        }

//        dump($awardItemConfigs);

//        dump($selectedAwardIds);
        //发放选择奖励

        if (!empty($selectedAwardIds)) {

            $selectedAwardIds = array_unique($selectedAwardIds);
            $fashionDressTypes = [];
            $awards = [];
            foreach ($selectedAwardIds as $selectedAwardId) {
                logicErrorCondition(isset($awardItemConfigs[$selectedAwardId]),
                    err_service_chef_choose::AWARD_ID_INVALID,
                    "AWARD_ID_INVALID");

                $awardItemConfig = $awardItemConfigs[$selectedAwardId];

                logicErrorCondition($awardItemConfig[configdata_chef_open_award_setting::k_needselected] === "1",
                    err_service_chef_choose::AWARD_ID_INVALID,
                    "AWARD_ID_INVALID");


                $itemId = $awardItemConfig[configdata_chef_open_award_setting::k_itemid];
                $itemCount = intval($awardItemConfig[configdata_chef_open_award_setting::k_itemcount]);

                $fashionDressConfig = getConfigData(configdata_item_fashion_dress_setting::class,
                    configdata_item_fashion_dress_setting::k_id,
                    $itemId);

                $mainType = $fashionDressConfig[configdata_item_fashion_dress_setting::k_maintype];
                logicErrorCondition(!isset($fashionDressTypes[$mainType]),
                    err_service_chef_choose::AWARD_POSITION_DUPLICATE,
                    "AWARD_POSITION_DUPLICATE");

                $fashionDressTypes[$mainType] = $itemId;
                $awards [$itemId] = $itemCount;


            }


            //发放物品
            foreach ($awards as $itemId => $itemCount) {
                $item = dbs_item::getInstance()->newItem($itemId, $itemCount);
                if ($item->isFashionDress()) {
                    $fashionDressExtend = dbs_item_fashionDress::create($item);
                    $fashionDressExtend->set_bindChefId($chef->get_guid());
                    $fashionDressExtend->save();
                }
                $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemId);
                $warehouse->addItem($item);
            }

        }

//        dump($awardItemConfigs);

        //发放固定奖励
        foreach ($awardItemConfigs as $awardItemConfig) {
            if ($awardItemConfig[configdata_chef_open_award_setting::k_needselected] === "0") {
                $itemId = $awardItemConfig[configdata_chef_open_award_setting::k_itemid];
                $itemCount = intval($awardItemConfig[configdata_chef_open_award_setting::k_itemcount]);

                $item = dbs_item::getInstance()->newItem($itemId, $itemCount);
                if ($item->isFashionDress()) {
                    $fashionDressExtend = dbs_item_fashionDress::create($item);
                    $fashionDressExtend->set_bindChefId($chef->get_guid());
                    $fashionDressExtend->save();
                }

//                dump([$itemId, $itemCount]);
                $warehouse = dbs_warehouse::getwarehousebyitemid($this->db_owner, $itemId);
                $warehouse->addItem($item);
            }
        }


        $this->set_cheflist($chefList);
        $this->set_chooselist($chooseChefs);
        $data[constants_returnkey::RK_CHEF_LIST] = $chefList;

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }

    /**
     * 时装穿着
     * @param string $chefId 厨师ID
     * @param string $fashionDressWarehousePositionId 时装仓库的位置
     * @return Common_Util_ReturnVar
     */
    public function fashionDressPutOn($chefId, $fashionDressWarehousePositionId)
    {
        $data = [];
        //class err_dbs_chef_list_fashionDressPutOn
        typeCheckGUID($chefId);
        typeCheckGUID($fashionDressWarehousePositionId);

        $fashionDressWarehouse = dbs_warehouse_fashionDress::createWithPlayer($this->db_owner);
        if (!$fashionDressWarehouse instanceof dbs_warehouse_fashionDress) {
            return Common_Util_ReturnVar::RetSucc($data);
        }

        $chefData = $this->get_chef($chefId);
        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_fashionDressPutOn::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $itemData = $fashionDressWarehouse->getitem($fashionDressWarehousePositionId);
        logicErrorCondition(!is_null($itemData),
            err_dbs_chef_list_fashionDressPutOn::WAREHOUSE_POS_ERROR,
            "WAREHOUSE_POS_ERROR");


        $item = dbs_item_normal::create_with_array($itemData);

        //已经绑定给其它人
        $itemFashionData = dbs_item_fashionDress::create($item);
        logicErrorCondition((empty($itemFashionData->get_bindChefId()) ||
            $itemFashionData->get_bindChefId() === $chefId),
            err_dbs_chef_list_fashionDressPutOn::FASHION_DRESS_BIND,
            "FASHION_DRESS_BIND");
        //已经穿过了
        logicErrorCondition(!$itemFashionData->get_isPutOn(),
            err_dbs_chef_list_fashionDressPutOn::ALREADY_PUT_ON,
            "ALREADY_PUT_ON");

        $fashionDressConfig = getConfigData(configdata_item_fashion_dress_setting::class,
            configdata_item_fashion_dress_setting::k_id,
            $item->get_itemid());


        logicErrorCondition(!is_null($fashionDressConfig),
            err_dbs_chef_list_fashionDressPutOn::FASHION_DRESS_CONFIG_ERROR,
            "FASHION_DRESS_CONFIG_ERROR");

        $fashionDressSex = $fashionDressConfig[configdata_item_fashion_dress_setting::k_sex];


        logicErrorCondition($chefData->getSex() === intval($fashionDressSex),
            err_dbs_chef_list_fashionDressPutOn::SEX_NOT_MATCH,
            "SEX_NOT_MATCH");


        $fashionDressData = $chefData->getFashionDressData();

        $fashionTypes = $itemFashionData->getAllPositionTypes();

//        dump($fashionTypes);
        $fashionMainType = $itemFashionData->getMainType();

        //所有要脱掉的装备
        $oldFashionItems = [];
        foreach ($fashionTypes as $fashionType) {
            $oldFashionItem = $fashionDressData->getFashionDressByType($fashionType);
            if (!is_null($oldFashionItem)) {
                $oldFashionItems[$oldFashionItem->get_warehousepos()] = $oldFashionItem;
            }
        }
//        dump($oldFashionItems);
        //脱掉装备所有位置
        foreach ($oldFashionItems as $oldFashionItem) {
            if ($oldFashionItem instanceof dbs_item_normal) {
                $oldFashionItemFashionDress = dbs_item_fashionDress::create($oldFashionItem);
                $takeoffTypes = $oldFashionItemFashionDress->getAllPositionTypes();
                foreach ($takeoffTypes as $takeoffType) {
                    $fashionDressData->takeOff($this->db_owner, $takeoffType);
                }
                $oldFashionItemFashionDress->set_isPutOn(false);
                $oldFashionItemFashionDress->save();
                $fashionDressWarehouse->modifyItem($oldFashionItem->get_warehousepos(),
                    $oldFashionItem);
            }

        }

        //设定装备绑定
        $itemFashionData->set_bindChefId($chefId);
        $itemFashionData->set_isPutOn(true);
        $itemFashionData->setUsed();
        $itemFashionData->save();

        //主要装备位道具
        $masterEquipmentSlot = dbs_chef_dataFashionDressEquipmentSlot::createMasterEquipment($item);
        $masterEquipmentSlot->set_position($fashionMainType);


        //穿上
        logicErrorCondition($fashionDressData->putOn($this->db_owner, $masterEquipmentSlot),
            err_dbs_chef_list_fashionDressPutOn::PUT_ON_UNKNOWN_ERROR,
            "PUT_ON_UNKNOWN_ERROR");

        //副本装备位置
        $fashionExternalTypes = $itemFashionData->getExternalPositionTypes();
        foreach ($fashionExternalTypes as $type) {
            $slaveEquipmentSlot = dbs_chef_dataFashionDressEquipmentSlot::createSlaveEquipment($item);
            $slaveEquipmentSlot->set_position($type);
            //穿上
            logicErrorCondition($fashionDressData->putOn($this->db_owner, $slaveEquipmentSlot),
                err_dbs_chef_list_fashionDressPutOn::PUT_ON_UNKNOWN_ERROR,
                "PUT_ON_UNKNOWN_ERROR");
        }

        //保存数据
        $fashionDressWarehouse->modifyItem($item->get_warehousepos(),
            $item);


        $chefData->setFashionDressData($fashionDressData);
        $this->set_chef($chefData);

        //统计自己的魅力值
        if ($chefData->get_isSelf()) {
            dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_62,
                $fashionDressData->get_charmvalue());
        }

        $data = $chefData->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 脱掉时装
     * @param string $chefId
     * @param string $fashionDressType 时装部位类型
     * @return Common_Util_ReturnVar
     */
    public function fashionDressTakeOff($chefId, $fashionDressType)
    {
        $data = [];
        //class err_dbs_chef_list_fashionDressTakeOff
        typeCheckGUID($chefId);
        typeCheckString($fashionDressType);


        $fashionDressWarehouse = dbs_warehouse_fashionDress::createWithPlayer($this->db_owner);
        if (!$fashionDressWarehouse instanceof dbs_warehouse_fashionDress) {
            return Common_Util_ReturnVar::RetSucc($data);
        }

        $chefData = $this->get_chef($chefId);
        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_fashionDressTakeOff::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        //时装数据
        $fashionDressData = $chefData->getFashionDressData();
        $fashionItem = $fashionDressData->getFashionDressByType($fashionDressType);

        logicErrorCondition(!is_null($fashionItem),
            err_dbs_chef_list_fashionDressTakeOff::NOT_EXIST_FASHION_DRESS,
            "NOT_EXIST_FASHION_DRESS");

        $fashionItemExtend = dbs_item_fashionDress::create($fashionItem);
        $takeoffTypes = $fashionItemExtend->getAllPositionTypes();
//        dump($takeoffTypes);
        foreach ($takeoffTypes as $takeoffType) {
            $fashionDressData->takeOff($this->db_owner, $takeoffType);
        }
        //保存仓库数据

        $fashionItemExtend->set_isPutOn(false);
        $fashionItemExtend->save();
        $fashionDressWarehouse->modifyItem($fashionItem->get_warehousepos(),
            $fashionItem);

        //保存数据
        $chefData->setFashionDressData($fashionDressData);
        $this->set_chef($chefData);

        $data = $chefData->toArray();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 回复厨师体力
     *
     * @param  string $chefid 厨师id
     * @return Common_Util_ReturnVar
     */
    function fillchefvit($chefid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_chef_list_fillchefvit{}
        $chefid = strval($chefid);
        $chef = $this->get_chef($chefid);
        if (is_null($chef)) {
            $retCode = err_dbs_chef_list_fillchefvit::CHEF_NOT_EXISTS;
            $retCode_Str = 'CHEF_NOT_EXISTS';
            goto failed;
        }

        $vitData = $chef->get_mastervitdata();

        if ($vitData->isvitfull()) {
            $retCode = err_dbs_chef_list_fillchefvit::VIT_FULL;
            $retCode_Str = 'VIT_FULL';
            goto failed;
        }

        $fillMaxCount = $this->db_owner->dbs_vip()->get_chef_fillvitcount();
        if ($vitData->get_todayfillvitcount() >= $fillMaxCount) {
            $retCode = err_dbs_chef_list_fillchefvit::TIMES_MAX;
            $retCode_Str = 'TIMES_MAX';
            goto failed;
        }

        $vitTimes = $vitData->get_todayfillvitcount() + 1;
        $vitConfig = self::get_fillvitconfig($vitTimes);
        $diamond = intval($vitConfig [configdata_chef_fill_vit_setting::k_diamond]);

        $diamondPercent = floatval($vitData->get_vitmax() - $vitData->get_vit()) / 120.0;
        $diamond = ceil($diamond * $diamondPercent);

        if ($diamond > $this->db_owner->db_role()->get_diamond()) {
            $retCode = err_dbs_chef_list_fillchefvit::DIAMOND_NOT_ENOUGH;
            $retCode_Str = 'DIAMOND_NOT_ENOUGH';
            goto failed;
        }

        // 扣除钻石
        if ($diamond > 0) {
            $this->db_owner->db_role()->cost_diamond($diamond, constants_moneychangereason::FILL_CHEF_VIT);
        }

        // 增加次数
        $vitData->set_todayfillvitcount($vitTimes);
        $vitData->fillVitToFull($chef->get_level());
        $chef->set_mastervit($vitData->toArray());
        // 保存厨师
        $this->set_chef($chef);

        $data[constants_returnkey::RK_DIAMOND] = $diamond;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 装备
     *
     * @param string $equipmentwarehousepos 装备仓库位置
     * @param string $chefid 厨师id
     * @return Common_Util_ReturnVar
     */
    function puton($equipmentwarehousepos, $chefid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_chef_list_equip{}

        $equipmentwarehousepos = strval($equipmentwarehousepos);
        $chefid = strval($chefid);

        $chef = $this->get_chef($chefid);
        if (is_null($chef)) {
            $retCode = err_dbs_chef_list_puton::CHEF_NOT_EXISTS;
            $retCode_Str = 'CHEF_NOT_EXISTS';
            goto failed;
        }

        $equipmentdata = $this->db_owner->dbs_warehouseequipment()->getitem($equipmentwarehousepos);
        if (is_null($equipmentdata)) {
            $retCode = err_dbs_chef_list_puton::EQUIPMENT_NOT_EXISTS;
            $retCode_Str = 'EQUIPMENT_NOT_EXISTS';
            goto failed;
        }
        $item = new dbs_item_normal ();
        $item->fromArray($equipmentdata);
        $equipment = new dbs_item_equipment ($item);

        // 装备已经绑定特定厨师
        if (!empty ($equipment->get_bindchefid()) && $equipment->get_bindchefid() != $chefid) {
            $retCode = err_dbs_chef_list_puton::CHEF_ID_BIND_ERROR;
            $retCode_Str = 'CHEF_ID_BIND_ERROR';
            goto failed;
        }

        // code
        $itemconfig = dbs_item::getInstance()->getItemConfig($item->get_itemid());
        $itemsubtype = $itemconfig [configdata_item_setting::k_subtype];

        // 原始位置的装备
        $oldequipmentdata = $chef->get_equipment($itemsubtype);
        if (!empty ($oldequipmentdata)) {
            $olditem = new dbs_item_normal ();
            $olditem->fromArray($oldequipmentdata);
//            $oldequipment = new dbs_item_equipment ($olditem);

            $this->takeoff($olditem->get_warehousepos());
        }

        if (!empty ($equipment->get_putonchefid())) {
            // 已经有穿在其它人身上了
            $this->takeoff($equipmentwarehousepos);
        }

        // 穿着到身上
        $equipment->set_putonchefid($chefid);
        $equipment->compute();
        $this->db_owner->dbs_warehouseequipment()->modifyItem($equipmentwarehousepos, $item);

        // dump ( $itemsubtype );
        // 穿着
        $chef->putonequipment($itemsubtype, $item->toArray());

        $chef->computeability();
        // 保存厨师信息
        $this->set_chef($chef);
        // 同步数据
//        $this->copychefdata_master_to_copy_withoutvit($chefid);

//        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_110, 1);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 脱下
     *
     * @param string $equipmentwarehousepos
     * @return Common_Util_ReturnVar
     */
    function takeoff($equipmentwarehousepos)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_chef_list_takeoff{}
        $equipmentwarehousepos = strval($equipmentwarehousepos);

        $equipmentdata = $this->db_owner->dbs_warehouseequipment()->getitem($equipmentwarehousepos);
        if (is_null($equipmentdata)) {
            $retCode = err_dbs_chef_list_takeoff::EQUIPMENT_NOT_EXISTS;
            $retCode_Str = 'EQUIPMENT_NOT_EXISTS';
            goto failed;
        }
        $item = new dbs_item_normal ();
        $item->fromArray($equipmentdata);
        $equipment = new dbs_item_equipment ($item);

        $chefid = $equipment->get_putonchefid();
        if (empty ($chefid)) {
            $retCode = err_dbs_chef_list_takeoff::EQUIPMENT_NOT_PUT_ON;
            $retCode_Str = 'EQUIPMENT_NOT_PUT_ON';
            goto failed;
        }

        $chef = $this->get_chef($chefid);
        if (!is_null($chef)) {

            $itemconfig = dbs_item::getInstance()->getItemConfig($item->get_itemid());
            $itemsubtype = $itemconfig [configdata_item_setting::k_subtype];

            // 脱下装备
            $chef->takeoffequipment($itemsubtype);
            // 计算属性
            $chef->computeability();

            // 保存厨师信息

            $this->set_chef($chef);
        }

        // 修改装备穿着信息
        $equipment->set_putonchefid('');
        $equipment->compute();
        $this->db_owner->dbs_warehouseequipment()->modifyItem($equipmentwarehousepos, $item);

        // 同步数据
//        $this->copychefdata_master_to_copy_withoutvit($chefid);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 培养自己的厨师
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function trainChef($chefId)
    {
        $data = [];
        //class err_dbs_chef_list_trainChef
        typeCheckGUID($chefId);

        $chefData = $this->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_trainChef::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        logicErrorCondition($chefData->isStatusFree(),
            err_dbs_chef_list_trainChef::CHEF_BUSYING,
            "CHEF_BUSYING");

        $chefTrainData = $chefData->getTrainData();
        logicErrorCondition($chefTrainData->isFree(),
            err_dbs_chef_list_trainChef::CHEF_ALREADY_TRAINING,
            "CHEF_ALREADY_TRAINING");

        $todayTrainMaxCount = getGlobalValue("CHEF_TRAIN_TODAY_MAXCOUNT")->int_value();
        logicErrorCondition($chefTrainData->get_todayTrainCount() < $todayTrainMaxCount,
            err_dbs_chef_list_trainChef::CHEF_TODAY_TRAIN_COUNT_MAX,
            "CHEF_TODAY_TRAIN_COUNT_MAX");

        $minVits = getGlobalValue("CHEF_TRAIN_MIN_VITS")->int_value();

        $chefVitData = $chefData->get_mastervitdata();
        logicErrorCondition($chefVitData->get_vit() <= $minVits,
            err_dbs_chef_list_trainChef::CHEF_VIT_NOT_EMPTY,
            "CHEF_VIT_NOT_EMPTY");


        //开始培训
        $trainRoom = dbs_chef_train_Room::newRoom();
        $trainRoom->setMasterChef($this->db_owner, $chefData);

        //设置开始培训
        $chefTrainData->startTrainAsMaster($trainRoom);


        //保存数据
        $chefData->setTrainData($chefTrainData);
        $chefData->setStatusTrain();
        //解除职务
        dbs_chef_jobs_player::createWithPlayer($this->db_owner)->fireChef($chefData);

        $this->set_chef($chefData);


        $data[constants_returnkey::RK_CHEF_DATA] = $chefData->toArray();

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 完成训练
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function trainChefFinish($chefId)
    {
        $data = [];
        //class err_dbs_chef_list_trainChefFinish
        typeCheckGUID($chefId);

        $chefData = $this->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_trainChefFinish::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $chefTrainData = $chefData->getTrainData();
        logicErrorCondition($chefTrainData->isTraining(),
            err_dbs_chef_list_trainChefFinish::CHEF_NOT_TRAINING,
            "CHEF_NOT_TRAINING");


        //获取房间信息
        $trainRoom = dbs_chef_train_Room::getRoom($chefTrainData->get_trainRoomId());
        logicErrorCondition(!$trainRoom->is_Cooldown(),
            err_dbs_chef_list_trainChefFinish::CHEF_TRAINING_UNCOMPLETED,
            "CHEF_TRAINING_UNCOMPLETED");

        //移除所有的加入请求
        $trainRoom->refuseAllJoinRequest();

        //补充体力
        $chefData->fillVitToFull();

        //增加经验
        $chefLevel = $chefData->get_level();
        $trainConfig = getConfigData(configdata_chef_train_setting::class,
            configdata_chef_train_setting::k_level,
            $chefLevel);
        $awardExp = intval($trainConfig[configdata_chef_train_setting::k_awardexp]);
        $isLevelUp = false;
        $chefData->addexp($awardExp, $isLevelUp);

        //培训进过的时间
        $trainTimeInterval = $trainRoom->get_finishTime() - $trainRoom->get_startTime();


        //是否是双休,并且自己的房间
        //双休这里不处理对方经验,防止奇怪出现升级
        //主要处理好感度,好感度全局唯一 只增加一次即可
        if ($trainRoom->isDoubleTrain() && $chefTrainData->get_isMaster()) {
            $otherUserRoomData = $trainRoom->get_slaveTrainData();
            $otherUser = dbs_player::newGuestPlayerWithLock($otherUserRoomData[dbs_chef_train_RoomData::DBKey_userid]);
            logicErrorCondition($otherUser->isRoleExists(),
                err_dbs_chef_list_trainChefFinish::DOUBLE_TRAIN_USER_NOT_EXIST,
                "DOUBLE_TRAIN_USER_NOT_EXIST");

            $friend = dbs_friend::createWithPlayer($this);

            $friend->addFriendGoodWill($otherUser->get_userid(), getGlobalValue("CHEF_TRAIN_ADD_GOODWILL")->int_value());

//            dump($friend->getGoodwill($otherUser->get_userid()));

//            dump(10);
        }

        //对方是否是机器人
        $otherIsRobot = false;

        //双休,生成最后的购买界面
        if ($trainRoom->isDoubleTrain()) {

            $ownerPlayer = $this->db_owner;
            $ownerChef = $chefData;

            //是主人
            if ($chefTrainData->get_isMaster()) {
                $selfTrainRoomData = $trainRoom->get_masterTrainData();
                $otherUserRoomData = $trainRoom->get_slaveTrainData();
            } else {
                $selfTrainRoomData = $trainRoom->get_slaveTrainData();
                $otherUserRoomData = $trainRoom->get_masterTrainData();
            }


            $presentPlayer = dbs_player::newGuestPlayerWithLock($otherUserRoomData[dbs_chef_train_RoomData::DBKey_userid]);
            $presentChef = dbs_chef_list::createWithPlayer($presentPlayer)->get_chef($otherUserRoomData[dbs_chef_train_RoomData::DBKey_chefid]);

            $otherIsRobot = dbs_robot_player::createWithPlayer($presentPlayer)->get_isrobot();


            //时装商店
            $fashionShopInfo = $this->createTrainChefFashionShop($ownerPlayer, $ownerChef, $presentPlayer, $presentChef);
            $data[constants_returnkey::RK_FASHION_SHOP_INFO] = $fashionShopInfo->toArray();

            //发送购物通知
            dbs_mailbox_data::createWithStandardId(constants_mailTemplates::CHEF_TRAIN_FINISH_CAN_SHOP,
                [
                    'destTrainData' => $otherUserRoomData,
                    'fashionShopInfo' => $fashionShopInfo->toArray(),
                ])
                ->setExpiredTime(getGlobalValue("CHEF_TRAIN_FASHION_SHOP_EXPIRED_TIME")->int_value())
                ->send($this->get_userid());

            //给对方发送通知
            dbs_mailbox_data::createWithStandardId(constants_mailTemplates::CHEF_TRAIN_FINISH_DOUBLE,
                [
                    'destTrainData' => $otherUserRoomData,
                    'srcTrainData' => $selfTrainRoomData,
                    'trainTimeInterval' => $trainTimeInterval
                ], $this->get_userid())
                ->send($presentPlayer);


            //双休的对方是机器人.直接清理
            if ($otherIsRobot) {
                $otherChefTrainData = $presentChef->getTrainData();
                $otherChefTrainData->finishTraining();
                $presentChef->setTrainData($otherChefTrainData);
                $presentChef->set_status(constants_chefstatus::STATUS_FREE);
                dbs_chef_list::createWithPlayer($presentPlayer)->set_chef($presentChef);
            }

        } else {
            //单休
            //发送邮件通知
            dbs_mailbox_data::createWithStandardId(constants_mailTemplates::CHEF_TRAIN_FINISH_SINGLE,
                [
                    'chefData' => $chefData->toArray(),
                    'trainTimeInterval' => $trainTimeInterval
                ])
                ->send($this->get_userid());
        }


        //修改房间状态
        if ($otherIsRobot) {
            $trainRoom->masterChefReceiveAward();
            $trainRoom->slaveChefReceiveAward();
        } else {
            if ($chefTrainData->get_isMaster()) {
                $trainRoom->masterChefReceiveAward();
            } else {
                $trainRoom->slaveChefReceiveAward();
            }
        }
        //都完成修炼了,把房间删除掉
        if ($trainRoom->isCanDestroy()) {
            $trainRoom->removeFromDB();
        }

        //把厨师的培训状态重置
        $chefTrainData->finishTraining();
        $chefData->setTrainData($chefTrainData);
        $chefData->set_status(constants_chefstatus::STATUS_FREE);
        $this->set_chef($chefData);

        $data[constants_returnkey::RK_CHEF_DATA] = $chefData->toArray();
        $data[constants_returnkey::RK_CHEF_TRAIN_ROOM_DATA] = $trainRoom->toArray();


        //培训升级了
        if ($isLevelUp) {
            dbs_sync::createWithPlayer($this)->mark_sync(constants_messagecmd::S2C_CHEF_LEVELUP,
                [constants_returnkey::RK_CHEF_DATA => $chefData->toArray()]);
        }

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取培训数据
     * @return Common_Util_ReturnVar
     */
    public function getTrainChefInfo()
    {
        $data = [];
        //class err_dbs_chef_list_getTrainInfo

        $chefs = $this->get_cheflist();
        foreach ($chefs as $chefData) {
            $chef = dbs_chef_data::create_with_array($chefData);
            if ($chef instanceof dbs_chef_data) {
                $trainData = $chef->getTrainData();

                if (!$trainData->isFree()) {
                    $trainRoom = dbs_chef_train_Room::getRoom($trainData->get_trainRoomId());
                    $info = [
                        constants_returnkey::RK_CHEF_DATA => $chef->toArray(),
                        constants_returnkey::RK_CHEF_TRAIN_ROOM_DATA => $trainRoom->toArray()
                    ];
                    $data[$chef->get_guid()] = $info;
                }
            }
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 加入双休
     * @param string $chefId 我自己要参加双休的厨师ID
     * @param string $trainRoomId 对方已经修炼开出的房间ID
     * @return Common_Util_ReturnVar
     */
    public function joinTrainChef($chefId, $trainRoomId)
    {
        $data = [];
        //class err_dbs_chef_list_joinTrainChef
        typeCheckGUID($chefId);
        typeCheckGUID($trainRoomId);
//        typeCheckNumber($giftDiamond);
//        typeCheckNumber($giftGamecoin);


        $chefData = $this->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_joinTrainChef::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");
        $chefTrainData = $chefData->getTrainData();

        logicErrorCondition($chefTrainData->isFree(),
            err_dbs_chef_list_joinTrainChef::CHEF_STATUS_ERROR,
            "CHEF_STATUS_ERROR");

        $isRobot = dbs_robot_player::createWithPlayer($this)->get_isrobot();

        if (!$isRobot) {
            $todayTrainMaxCount = getGlobalValue("CHEF_TRAIN_TODAY_MAXCOUNT")->int_value();
            logicErrorCondition($chefTrainData->get_todayTrainCount() < $todayTrainMaxCount,
                err_dbs_chef_list_joinTrainChef::CHEF_TODAY_TRAIN_COUNT_MAX,
                "CHEF_TODAY_TRAIN_COUNT_MAX");
        }

        $trainRoom = dbs_chef_train_Room::getRoom($trainRoomId);

        logicErrorCondition($trainRoom->exist(),
            err_dbs_chef_list_joinTrainChef::TRAIN_ROOM_NOT_EXIST,
            "TRAIN_ROOM_NOT_EXIST");

        logicErrorCondition(!$trainRoom->requestExist($chefId),
            err_dbs_chef_list_joinTrainChef::CHEF_ALREADY_REQUEST_JOIN,
            "CHEF_ALREADY_REQUEST_JOIN");

        // 是否正在单人修炼中
        logicErrorCondition($trainRoom->isSingleTrain(),
            err_dbs_chef_list_joinTrainChef::TRAIN_ROOM_STATUS_ERROR,
            "TRAIN_ROOM_STATUS_ERROR");

        //培训已经完成
        logicErrorCondition($trainRoom->is_Cooldown(),
            err_dbs_chef_list_joinTrainChef::TRAIN_IS_FINISH,
            "TRAIN_IS_FINISH");

        $trainRoomData = $trainRoom->get_masterTrainData();
        //房主用户ID
        $roomOwnerUserId = $trainRoomData[dbs_chef_train_RoomData::DBKey_userid];
        logicErrorCondition($this->get_userid() !== $roomOwnerUserId,
            err_dbs_chef_list_joinTrainChef::CANNOT_JOIN_SELF_ROOM,
            "CANNOT_JOIN_SELF_ROOM");

        $trainedPlayers = $chefTrainData->get_todayTrainedUserIds();

        logicErrorCondition(!isset($trainedPlayers[$roomOwnerUserId]),
            err_dbs_chef_list_joinTrainChef::CHEF_TODAY_ALREADY_TRAINED_BY_ME,
            "CHEF_TODAY_ALREADY_TRAINED_BY_ME");

        //加入申请列表
        $trainRoomRequest = dbs_chef_train_RoomRequestData::createRequest($this->db_owner,
            $chefData, 0, 0);


        //加入申请列表
        $trainRoom->addJoinRequest($trainRoomRequest);

        //修改自己的状态
        $chefTrainData->requestJoinTrain($trainRoom, $trainRoomRequest);

        $chefData->setTrainData($chefTrainData);
        //申请状态
        $chefData->setStatusTrain();
        //解除职务
        dbs_chef_jobs_player::createWithPlayer($this->db_owner)->fireChef($chefData);

        $this->set_chef($chefData);

        //房主用户
        $trainRoomPlayer = dbs_player::newGuestPlayerWithLock($trainRoomData[dbs_chef_train_RoomData::DBKey_userid]);

        //发送同步请求
        dbs_sync::createWithPlayer($trainRoomPlayer)->mark_sync(constants_messagecmd::S2C_SEND_ITEM_GRAFT_REQUEST);

        //发送消息
        $masterChefData = $trainRoomData[dbs_chef_train_RoomData::DBKey_chefinfo];
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::CHEF_TRAIN_REQUEST_NO_PRESENTS,
            [
                'masterChef' => $masterChefData,
                'slaveChef' => $chefData->toArray()
            ], $this->get_userid())
            ->send($trainRoomPlayer->get_userid());


        $data[constants_returnkey::RK_CHEF_DATA] = $chefData->toArray();
        $data[constants_returnkey::RK_CHEF_TRAIN_ROOM_DATA] = $trainRoom->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 创建培训时装商店
     * @param dbs_player $ownerUser 拥有者ID,也就是谁能购买
     * @param dbs_chef_data $ownerChef 拥有者厨师,也就是谁能购买
     * @param dbs_player $presentUser 受赠者用户,也就是送给谁
     * @param dbs_chef_data $presentChef 受赠者厨师,也就是送给谁
     * @return dbs_chef_train_FashionShop|null
     */
    private function createTrainChefFashionShop(dbs_player $ownerUser,
                                                dbs_chef_data $ownerChef,
                                                dbs_player $presentUser,
                                                dbs_chef_data $presentChef)
    {
        $trainChefShopData = dbs_chef_train_FashionShop::createFashionShop(
            $ownerUser,
            $ownerChef,
            $presentUser,
            $presentChef);

        $timeOut = getGlobalValue("CHEF_TRAIN_FASHION_SHOP_EXPIRED_TIME")->int_value();

        $trainChefShopData->set_expiredtime(time() + $timeOut);

        $trainChefShopCache = Common_Db_memcacheObject::create($trainChefShopData->get_id());
        $trainChefShopCache->setExpiration($timeOut);
        $trainChefShopCache->set_value($trainChefShopData->toArray());


        return $trainChefShopData;
    }

    /**
     * 培训厨师时装商店购买
     * @param int $shopId 商店的ID
     * @param int $slotId 购买第几个位置的物品,1,2,3
     * @return Common_Util_ReturnVar
     */
    public function trainChefFashionShopBuy($shopId, $slotId)
    {
        $data = [];
        //interface err_dbs_chef_list_trainChefFashionShopBuy

        typeCheckGUID($shopId);
        typeCheckNumber($slotId);
        typeCheckChoice($slotId, [1, 2, 3]);


        $trainChefShopCache = Common_Db_memcacheObject::create($shopId);
        logicErrorCondition($trainChefShopCache->has_value(),
            err_dbs_chef_list_trainChefFashionShopBuy::SHOP_ID_ERROR,
            "SHOP_ID_ERROR");


        $trainChefShopData = dbs_chef_train_FashionShop::create_with_array($trainChefShopCache->get_value());

        if ($slotId === 1) {
            $awardId = $trainChefShopData->get_slotid1();
        } elseif ($slotId === 2) {
            $awardId = $trainChefShopData->get_slotid2();
        } else {
            $awardId = $trainChefShopData->get_slotid3();
        }

        $awardConfig = getConfigData(configdata_chef_train_fashion_dress_sell_item_group_setting::class,
            configdata_chef_train_fashion_dress_sell_item_group_setting::k_id,
            $awardId);

        logicErrorCondition(!is_null($awardConfig),
            err_dbs_chef_list_trainChefFashionShopBuy::ITEM_CONFIG_ERROR,
            "ITEM_CONFIG_ERROR");


        $price = intval($awardConfig[configdata_chef_train_fashion_dress_sell_item_group_setting::k_price]);
        $sellType = intval($awardConfig[configdata_chef_train_fashion_dress_sell_item_group_setting::k_selltype]);

        $itemId = $awardConfig[configdata_chef_train_fashion_dress_sell_item_group_setting::k_itemid];
        $itemCount = intval($awardConfig[configdata_chef_train_fashion_dress_sell_item_group_setting::k_itemcount]);

        if ($sellType === 1) {
            logicErrorCondition(dbs_role::createWithPlayer($this->db_owner)->get_gamecoin() >= $price,
                err_dbs_chef_list_trainChefFashionShopBuy::NOT_ENOUGH_MONEY,
                "NOT_ENOUGH_MONEY");

            //扣钱
            dbs_role::createWithPlayer($this->db_owner)->cost_gamecoin($price, constants_moneychangereason::TRAIN_CHEF_BUY_FASHION_DRESS);
        } else {
            logicErrorCondition(dbs_role::createWithPlayer($this->db_owner)->get_diamond() >= $price,
                err_dbs_chef_list_trainChefFashionShopBuy::NOT_ENOUGH_MONEY,
                "NOT_ENOUGH_MONEY");
            //扣钱
            dbs_role::createWithPlayer($this->db_owner)->cost_diamond($price, constants_moneychangereason::TRAIN_CHEF_BUY_FASHION_DRESS);
            //增加声望
            dbs_role::createWithPlayer($this->db_owner)->addReputation($price, constants_roleReputationChangeReason::TRAIN_FINISH_BUY_FASHION_DRESS);

            //payoutValue
            $itemConfig = dbs_item::getInstance()->getItemConfig($itemId);
            $payoutValue = intval($itemConfig[configdata_item_setting::k_payoutvalue]);
            //增加利益输送
            dbs_payout_player::createWithPlayer($this->db_owner)->addDiamondValue($trainChefShopData->get_presentuserid(), $payoutValue);
        }

        //发送道具
        $fashionDressItem = dbs_item::getInstance()->newItem($itemId, 1);
        $fashionDressItem->setFromInfo(constants_itemFromInfo::FROM_TRAIN_CHEF_PRESENTED,
            dbs_filters_role::getNormalInfo($this->db_owner));

        $fashionDressItemExtends = dbs_item_fashionDress::create($fashionDressItem);
        $fashionDressItemExtends->set_bindChefId($trainChefShopData->get_presentchefid());
        $fashionDressItemExtends->save();

        $presentPlayer = dbs_player::newGuestPlayerWithLock($trainChefShopData->get_presentuserid());
        //发送邮件
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::CHEF_TRAIN_FINISH_SEND_GIFT,
            [
                'item' => $fashionDressItem->toArray()
            ], $this->get_userid())
            ->addAttachmentItem($itemId, $itemCount, $fashionDressItem)
            ->send($presentPlayer);


        //删除商店信息
        $trainChefShopCache->del_value();


        //完成任务
//        dump([$awardId, $sellType, $price]);
        if ($sellType === 1) {
            dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_45, $price);
        } else {
            dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_44, $price);
        }
        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_46, 1);

        dbs_mission::createWithPlayer($presentPlayer)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_47, 1);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 给已经发送的请求发送聘礼
     * @param string $chefId 自己的厨师ID
     * @param int $giftDiamond 聘礼钻石数
     * @param int $giftGamecoin 聘礼游戏币
     * @return Common_Util_ReturnVar
     */
    public function sendGiftToJoinRequest($chefId, $giftDiamond, $giftGamecoin)
    {
        $data = [];
        //interface err_dbs_chef_list_sendGiftToJoinRequest

        typeCheckGUID($chefId);
        typeCheckNumber($giftDiamond);
        typeCheckNumber($giftGamecoin);

        $chefData = $this->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_sendGiftToJoinRequest::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");
        $chefTrainData = $chefData->getTrainData();

        logicErrorCondition($chefTrainData->isWaitAnswer(),
            err_dbs_chef_list_sendGiftToJoinRequest::CHEF_STATUS_ERROR,
            "CHEF_STATUS_ERROR");

        //最小开启等级
        $minSendGiftLevel = getGlobalValue("CHEF_TRAIN_BETROTHAL_OPEN_LEVEL")->int_value();
        if (dbs_restaurantinfo::createWithPlayer($this->db_owner)->get_restaurantlevel() < $minSendGiftLevel) {
            logicErrorCondition($giftDiamond === 0 && $giftGamecoin === 0,
                err_dbs_chef_list_sendGiftToJoinRequest::CHEF_SEND_GIFT_NOT_OPEN,
                "CHEF_SEND_GIFT_NOT_OPEN");
        }


        $trainRoomId = $chefTrainData->get_trainRoomId();
        $trainRoom = dbs_chef_train_Room::getRoom($trainRoomId);
        //加入请求
        $joinRequest = $trainRoom->getJoinRequest($chefTrainData->get_trainRequestId());


        //扣除游戏币和钻石
        $role = dbs_role::createWithPlayer($this->db_owner);
        if ($role instanceof dbs_role) {

            logicErrorCondition($role->get_gamecoin() >= $giftGamecoin,
                err_dbs_chef_list_sendGiftToJoinRequest::CHEF_GIFT_GAMECOIN_NOT_ENOUGH,
                "CHEF_GIFT_GAMECOIN_NOT_ENOUGH");

            logicErrorCondition($role->get_diamond() >= $giftDiamond,
                err_dbs_chef_list_sendGiftToJoinRequest::CHEF_GIFT_DIAMOND_NOT_ENOUGH,
                "CHEF_GIFT_DIAMOND_NOT_ENOUGH");

            $role->cost_diamond($giftDiamond, constants_moneychangereason::REQUEST_JOIN_CHEF_TRAIN);
            $role->cost_gamecoin($giftGamecoin, constants_moneychangereason::REQUEST_JOIN_CHEF_TRAIN);
        }

        $joinRequest->addGiftDiamond($giftDiamond);
        $joinRequest->addGiftGameCoin($giftGamecoin);

        $trainRoom->addJoinRequest($joinRequest);


        $data[constants_returnkey::RK_CHEF_TRAIN_ROOM_DATA] = $trainRoom->toArray();

        $masterTrainRoomData = $trainRoom->get_masterTrainData();
        //发送通知邮件
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::CHEF_TRAIN_REQUEST_WITH_PRESENTS,
            [
                'masterChef' => $masterTrainRoomData[dbs_chef_train_RoomData::DBKey_chefinfo],
                'slaveChef' => $chefData->toArray(),
                'giftGameCoin' => $giftGamecoin,
                'giftDiamond' => $giftDiamond
            ], $this->get_userid())
            ->send($masterTrainRoomData[dbs_chef_train_RoomData::DBKey_userid]);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 取消加入双休的请求
     * @param string $chefId 我自己的厨师ID
     * @return Common_Util_ReturnVar
     */
    public function cancelJoinTrainChef($chefId)
    {
        $data = [];
        //class err_dbs_chef_list_cancelJoinTrainChef

        typeCheckGUID($chefId);

        $chefData = $this->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_cancelJoinTrainChef::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $chefTrainData = $chefData->getTrainData();
        logicErrorCondition($chefTrainData->isWaitAnswer(),
            err_dbs_chef_list_cancelJoinTrainChef::CHEF_STATUS_ERROR,
            "CHEF_STATUS_ERROR");

        $trainRoom = dbs_chef_train_Room::getRoom($chefTrainData->get_trainRoomId());
        logicErrorCondition($trainRoom->exist(),
            err_dbs_chef_list_cancelJoinTrainChef::TRAIN_ROOM_NOT_EXISTS,
            "TRAIN_ROOM_NOT_EXISTS");

        $requestData = $trainRoom->getJoinRequest($chefTrainData->get_trainRequestId());
        logicErrorCondition(!is_null($requestData),
            err_dbs_chef_list_cancelJoinTrainChef::REQUEST_NOT_EXISTS,
            "REQUEST_NOT_EXISTS");

        //返还钻石和游戏币
        $gameCoin = $requestData->get_giftGamecoin();
        $diamond = $requestData->get_giftDiamond();

        $role = dbs_role::createWithPlayer($this->db_owner);
        if ($role instanceof dbs_role) {
            $role->add_gamecoin_and_diamonds($gameCoin, $diamond, constants_moneychangereason::CANCEL_JOIN_CHEF_TRAIN);
        }


        //房间重置请求
        $trainRoom->cancelJoinRequest($chefTrainData->get_trainRequestId());

        //重置厨师的请求状态
        $chefTrainData->cancelJoinTrain();
        $chefData->setTrainData($chefTrainData);
        $chefData->set_status(constants_chefstatus::STATUS_FREE);
        $this->set_chef($chefData);

        $data[constants_returnkey::RK_CHEF_DATA] = $chefData->toArray();
        $data[constants_returnkey::RK_CHEF_TRAIN_ROOM_DATA] = $trainRoom->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 接收加入双休的申请
     * @param string $chefId 我自己的修炼的厨师ID
     * @param string $requestId 请求ID
     * @return Common_Util_ReturnVar
     * @throws
     */
    public function acceptJoinTrainChef($chefId, $requestId)
    {
        $data = [];
        //class err_dbs_chef_list_acceptJoinTrainChef
        typeCheckGUID($chefId);
        typeCheckGUID($requestId);

        $chefData = $this->get_chef($chefId);

        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_acceptJoinTrainChef::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $chefTrainData = $chefData->getTrainData();
        logicErrorCondition($chefTrainData->isTraining(),
            err_dbs_chef_list_acceptJoinTrainChef::CHEF_STATUS_ERROR,
            "CHEF_STATUS_ERROR");
        //自己不是主人
        logicErrorCondition($chefTrainData->get_isMaster(),
            err_dbs_chef_list_acceptJoinTrainChef::CHEF_NOT_MASTER,
            "CHEF_NOT_MASTER");

        $trainRoom = dbs_chef_train_Room::getRoom($chefTrainData->get_trainRoomId());
        logicErrorCondition($trainRoom->exist(),
            err_dbs_chef_list_acceptJoinTrainChef::TRAIN_ROOM_NOT_EXISTS,
            "TRAIN_ROOM_NOT_EXISTS");
        //房间状态错误
        logicErrorCondition($trainRoom->isSingleTrain(),
            err_dbs_chef_list_acceptJoinTrainChef::TRAIN_ROOM_STATUS_ERROR,
            "TRAIN_ROOM_STATUS_ERROR");

        //培训已经完成
        logicErrorCondition($trainRoom->is_Cooldown(),
            err_dbs_chef_list_acceptJoinTrainChef::TRAIN_IS_FINISH,
            "TRAIN_IS_FINISH");

        $requestData = $trainRoom->getJoinRequest($requestId);
        logicErrorCondition(!is_null($requestData),
            err_dbs_chef_list_acceptJoinTrainChef::REQUEST_NOT_EXISTS,
            "REQUEST_NOT_EXISTS");


        //获取所有拒绝请求列表
        $refuseRequests = $trainRoom->get_joinRequests();
        unset($refuseRequests[$requestId]);
        //修改房间状态
        $trainRoom->acceptJoinRequest($requestId);
        //拒绝其他人
        foreach ($refuseRequests as $requestId => $refuseRequest) {
            $trainRoom->refuseJoinRequest($requestId, true);
        }
        //重置请求列表
        $trainRoom->reset_joinRequests();

        //修改自己的修炼状态
        $chefTrainData->acceptOtherJoinMyTrain($trainRoom);
        //聘礼
        $gameCoin = $requestData->get_giftGamecoin();
        $diamond = $requestData->get_giftDiamond();
        //接收聘礼
        $role = dbs_role::createWithPlayer($this->db_owner);
        if ($role instanceof dbs_role) {
            $role->add_gamecoin_and_diamonds($gameCoin, $diamond, constants_moneychangereason::ACCEPT_JOIN_CHEF_TRAIN);
        }
        //修改被同意双休者的状态
        $destUser = dbs_player::newGuestPlayerWithLock($requestData->get_userid());
        $destChefService = dbs_chef_list::createWithPlayer($destUser);
        $destChef = $destChefService->get_chef($requestData->get_chefid());
        $destChefTrainData = $destChef->getTrainData();
        $destChefTrainData->acceptedByOther($trainRoom);
        $destChef->setTrainData($destChefTrainData);
        $destChefService->set_chef($destChef);


        //增加声望
        dbs_role::createWithPlayer($destUser)->addReputationByDiamond($diamond, constants_roleReputationChangeReason::ACCEPT_TRAIN_CHEF_GIFT);
        //增加付出
        dbs_payout_player::createWithPlayer($destUser)->addDiamondValue($this->get_userid(), $diamond);


        //保存厨师数据
        $chefData->setTrainData($chefTrainData);
        $this->set_chef($chefData);


        //发送邮件通知被同意者
        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::CHEF_TRAIN_ACCEPT_REQUEST,
            [
                'masterChef' => $chefData->toArray(),
                'slaveChef' => $destChef->toArray()
            ], $this->get_userid())
            ->send($destUser);

        //任务
        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_42, 1);
        dbs_mission::createWithPlayer($destUser)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_42, 1);


//        logicError(1, "1");
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 拒绝单个请求
     * @param $chefId
     * @param $requestId
     * @return Common_Util_ReturnVar
     */
    public function refuseJoinTrainChef($chefId, $requestId)
    {
        $data = [];
        //class err_dbs_chef_list_refuseJoinChefTrain
        typeCheckGUID($chefId);
        typeCheckGUID($requestId);

        $chefData = $this->get_chef($chefId);
        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_refuseJoinChefTrain::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");
        $chefTrainData = $chefData->getTrainData();

        logicErrorCondition($chefTrainData->isTraining(),
            err_dbs_chef_list_refuseJoinChefTrain::CHEF_STATUS_ERROR,
            "CHEF_STATUS_ERROR");
        //不是我自己的房间
        logicErrorCondition($chefTrainData->get_isMaster(),
            err_dbs_chef_list_refuseJoinChefTrain::CHEF_NOT_MASTER,
            "CHEF_NOT_MASTER");

        $trainRoom = dbs_chef_train_Room::getRoom($chefTrainData->get_trainRoomId());

        logicErrorCondition($trainRoom->exist(),
            err_dbs_chef_list_refuseJoinChefTrain::TRAIN_ROOM_NOT_EXISTS,
            "TRAIN_ROOM_NOT_EXISTS");

        logicErrorCondition($trainRoom->isSingleTrain(),
            err_dbs_chef_list_refuseJoinChefTrain::TRAIN_ROOM_STATUS_ERROR,
            "TRAIN_ROOM_STATUS_ERROR");

        $refuseRequestData = $trainRoom->getJoinRequest($requestId);
        logicErrorCondition(!is_null($refuseRequestData),
            err_dbs_chef_list_refuseJoinChefTrain::REQUEST_NOT_EXISTS,
            "REQUEST_NOT_EXISTS");

        $trainRoom->refuseJoinRequest($requestId);


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 培训厨师发布广告
     * @param $chefId
     * @return Common_Util_ReturnVar
     */
    public function trainChefPublishAdvertisement($chefId)
    {
        $data = [];
        //interface err_dbs_chef_list_trainChefPublishAdvertisement

        typeCheckGUID($chefId);

        $chefData = $this->get_chef($chefId);
        logicErrorCondition(!is_null($chefData),
            err_dbs_chef_list_trainChefPublishAdvertisement::CHEF_NOT_EXISTS,
            "CHEF_NOT_EXISTS");

        $trainData = $chefData->getTrainData();

        logicErrorCondition($trainData->isTraining(),
            err_dbs_chef_list_trainChefPublishAdvertisement::CHEF_STATUS_ERROR,
            "CHEF_STATUS_ERROR");

        logicErrorCondition($trainData->get_isMaster(),
            err_dbs_chef_list_trainChefPublishAdvertisement::CHEF_NOT_MASTER,
            "CHEF_NOT_MASTER");

        $trainRoom = dbs_chef_train_Room::getRoom($trainData->get_trainRoomId());

        logicErrorCondition($trainRoom->isSingleTrain(),
            err_dbs_chef_list_trainChefPublishAdvertisement::TRAINING_ROOM_STATUS_ERROR,
            "TRAINING_ROOM_STATUS_ERROR");

        logicErrorCondition($trainRoom->is_Cooldown(),
            err_dbs_chef_list_trainChefPublishAdvertisement::TRAINING_COMPLETED,
            "TRAINING_COMPLETED");

        logicErrorCondition(!$trainRoom->get_publishAdvertisement(),
            err_dbs_chef_list_trainChefPublishAdvertisement::TRAINING_ALREADY_PUBLISH_ADVERTISEMENT,
            "TRAINING_ALREADY_PUBLISH_ADVERTISEMENT");


        $trainRoom->set_publishAdvertisement(true);
        $trainRoom->set_AdvertisementExpiredTime(time() + 86400);
        $trainRoom->set_AdvertisementId(Common_Util_Guid::gen_bulletin_id());

        //设置筛选数据
        dbs_friend_recommenddata::createWithPlayer($this)->set_isPublishingTrainChefAdvertisement(true);

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 处理培训推荐通用数据
     * @param array $userIdArray {userid=>mixed}
     * @return array
     */
    private function getTrainChefRecommendData(array $userIdArray)
    {
        $datas = [];
        foreach ($userIdArray as $userid => $value) {
            $data = array();

//            $destPlayer = dbs_player::newGuestPlayer($userid);
            $data [dbs_role::DBKey_tablename] = dbs_filters_role::getNormalInfo(dbs_role::getCacheObjectOrNew($userid));
            $data[dbs_restaurantinfo::DBKey_tablename] = dbs_restaurantinfo::getCacheObjectOrNew($userid)->toArray();

            $rooms = [];
            $chefs = dbs_chef_list::getCacheObjectOrNew($userid)->get_cheflist();
            foreach ($chefs as $chefId => $chef) {
                $chefData = dbs_chef_data::create_with_array($chef);
                if ($chefData->isStatusTraining()) {
                    $chefTrainData = $chefData->getTrainData();
                    if ($chefTrainData->get_isMaster() && $chefTrainData->isTraining()) {
                        $trainRoomData = dbs_chef_train_Room::getRoom($chefTrainData->get_trainRoomId());

                        if ($trainRoomData->isSingleTrain() &&
                            $trainRoomData->is_Cooldown() &&
                            $trainRoomData->get_publishAdvertisement()
                        ) {
                            $rooms[$trainRoomData->get_roomId()] = $trainRoomData->toArray();
                        }
                    }
                }
            }
            $data[dbs_chef_train_Room::DBKey_tablename] = $rooms;

            if (empty($rooms)) {
                continue;
            }
            $datas [$userid] = $data;
        }
        return $datas;
    }

    /**
     * 获取推荐房间信息
     * @return Common_Util_ReturnVar
     */
    public function trainChefGetRecommend()
    {
        //interface err_dbs_chef_list_trainChefGetRecommend
        $memCacheObj = Common_Db_memcacheObject::create("trainChefGetRecommend_" . $this->get_userid());
        $memCacheObj->setExpiration(5 * 60);
        if (false && $memCacheObj->has_value()) {
            $datas = $memCacheObj->get_value();
        } else {

            $extensionRule = [
                dbs_friend_recommenddata::DBKey_isPublishingTrainChefAdvertisement => true
            ];

            $recommendList = dbs_friend::createWithPlayer($this)->normalRecommendRule($extensionRule, false);

            $datas = $this->getTrainChefRecommendData($recommendList);

            $memCacheObj->set_value($datas);
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($datas);
    }


    /**
     * 获取好友培训房间信息
     * @return Common_Util_ReturnVar
     */
    public function trainChefGetRecommendFriend()
    {
        $memCacheObj = Common_Db_memcacheObject::create("trainChefGetRecommendFriend_" . $this->get_userid());
        $memCacheObj->setExpiration(5 * 60);
        if (false && $memCacheObj->has_value()) {
            $datas = $memCacheObj->get_value();
        } else {
            $friendList = dbs_friend::createWithPlayer($this)->get_friendlist();

            $datas = $this->getTrainChefRecommendData($friendList);

            $memCacheObj->set_value($datas);
        }
        return Common_Util_ReturnVar::RetSucc($datas);
    }

    /**
     * 获取社区好友培训房间数据
     * @return Common_Util_ReturnVar
     */
    public function trainChefGetRecommendNeighbourhood()
    {
        $memCacheObj = Common_Db_memcacheObject::create("trainChefGetRecommendNeighbourhood_" . $this->get_userid());
        $memCacheObj->setExpiration(5 * 60);
        $datas = [];
        if (false && $memCacheObj->has_value()) {
            $datas = $memCacheObj->get_value();
        } else {
            $groupData = dbs_neighbourhood_playerdata::createWithPlayer($this)->get_groupdata();
            if (!is_null($groupData)) {

                $members = $groupData->get_member();
                $datas = $this->getTrainChefRecommendData($members);
                $memCacheObj->set_value($datas);
            }

        }
        return Common_Util_ReturnVar::RetSucc($datas);
    }


    /**
     * 获取所有厨师的战斗力
     *
     * @return number
     */
    public function get_all_battlepowers()
    {
        $battlepower = 0;

        $cheflist = $this->get_cheflist();
        $chef = new dbs_chef_data ();
        foreach ($cheflist as $value) {
            $chef->fromArray($value);
            $chef->computeability();
            $battlepower += $chef->get_battlepower();
        }

        return $battlepower;
    }


    /**
     * 修正机器人空厨师的问题
     */
    private function _fixrobotchef()
    {
        if ($this->db_owner->dbs_robot_player()->get_isrobot()) {
            // $this->
            if (empty($this->get_cheflist())) {
                try {
//                    $this->choose();
                } catch (exception_logicError $e) {

                }
            }
        }
    }

    /**
     * 删除过期时装
     */
    private function autoRemoveExpiredFashionDress()
    {
        $chefs = $this->get_cheflist();
        $warehouse = dbs_warehouse_fashionDress::createWithPlayer($this->db_owner);
        if (!$warehouse instanceof dbs_warehouse_fashionDress) {
            return;
        }
        foreach ($chefs as $chefData) {
            $chef = dbs_chef_data::create_with_array($chefData);
            $fashionData = $chef->getFashionDressData();
            $removeItems = $fashionData->removeExpiredFashionDresses();

            //存在过期数据
            if (!empty($removeItems)) {
                foreach ($removeItems as $item) {
                    if ($item instanceof dbs_item_normal) {
                        $warehouse->removeItem($item->get_warehousepos());
                    }


                    //发送过期邮件
                    dbs_mailbox_data::createWithStandardId(constants_mailTemplates::MAIL_FASHION_DRESS_OVERTIME,
                        ['fashionData' => $item->toArray()])
                        ->send($this->get_userid());
//                    $mailData->addAttachAction(constants_mailactiontype::FASHION_DRESS_EXPIRED,
//                        $item->toArray());

//                    dbs_mailbox_list::sendMailToUser($this->get_userid(), $mailData);
                }
                $chef->setFashionDressData($fashionData);
                $this->set_chef($chef);
            }
        }

    }


    public function beforecall()
    {
        $this->_fixrobotchef();
    }

    /**
     * @inheritDoc
     */
    function masterbeforecall()
    {
        $nextDayKey = "DAY_FLAG_" . get_class($this);
        $days = Common_Util_Time::getGameDay();
        if ($days !== dbs_userkvstore::createWithPlayer($this)->getvalue($nextDayKey, 0)) {
            dbs_userkvstore::createWithPlayer($this)->setvalue($nextDayKey, $days);
            $this->nextday();
        }


        $this->autoRemoveExpiredFashionDress();

        $this->autoFireEmployeeChef();
        $this->autoProcessEmployeeExpiredRequests();

        $this->computeTrainRequestExpired();
        $this->computeTrainChefExpiredAdvertisements();

        $this->autoTrainByRobot();

    }

    /**
     * @inheritDoc
     */
    function nextday()
    {
        //处理厨师培训过日子的问题

        $chefs = $this->get_cheflist();
        foreach ($chefs as $chefId => $chef) {
            $chefData = dbs_chef_data::create_with_array($chef);

            $chefTrainData = $chefData->getTrainData();
            $chefTrainData->resetTrainHistory();
            $chefData->setTrainData($chefTrainData);
            $chefs[$chefId] = $chefData->toArray();


        }
        $this->set_cheflist($chefs);

        //还原体力道具使用情况
        $this->reset_fillvitItemTodayUseCount();

        $this->reset_todaySpeedUpTrainChefTimes();
    }


    private function autoFireEmployeeChef()
    {
        //检查我自己的厨师被雇佣过期情况

        $chefs = $this->get_cheflist();
        foreach ($chefs as $chefId => $chef) {
            $chefData = dbs_chef_data::create_with_array($chef);
            if ($chefData->isStatusEmployed()) {
                $employData = $chefData->getEmployData();
                if ($employData->isExpired()) {
                    $employerPlayer = dbs_player::newGuestPlayerWithLock($employData->get_employerId());
                    try {
                        dbs_chef_employ_player::createWithPlayer($employerPlayer)->fireChef($chefId);
                    } catch (exception_logicError $e) {

                    }
                }
            }
        }

    }

    /**
     * 处理过期的雇佣请求
     */
    private function autoProcessEmployeeExpiredRequests()
    {
        $chefs = $this->get_cheflist();
        foreach ($chefs as $chefId => $chef) {
            $chefData = dbs_chef_data::create_with_array($chef);
            if ($chefData->isAllowEmployed()) {
                $employData = $chefData->getEmployData();
                $requests = $employData->get_requests();
                foreach ($requests as $requestId => $request) {
                    $requestData = dbs_chef_employ_request::create_with_array($request);
                    if ($requestData->isExpired()) {
                        $employerPlayer = dbs_player::newGuestPlayerWithLock($employData->get_employerId());
                        try {
                            dbs_chef_employ_player::createWithPlayer($this)->refuseRequest($chefId, $requestId);
                        } catch (exception_logicError $e) {

                        }
                        //通知对方请求已经过期

                        dbs_mailbox_data::createWithStandardId(constants_mailTemplates::HIRE_CHEF_REQUEST_EXPIRED, [
                            'requestData' => $requestData->toArray(), $this->get_userid()
                        ])->send($employerPlayer);
                    }
                }
            }
        }
    }

    /**
     * 处理过期的请求
     */
    private function computeTrainRequestExpired()
    {
        $chefs = $this->get_cheflist();
        foreach ($chefs as $chefId => $chef) {
            $chefData = dbs_chef_data::create_with_array($chef);
            if ($chefData->isStatusTraining()) {

                $chefTrainData = $chefData->getTrainData();
                //正在请求中
                if ($chefTrainData->isWaitAnswer()) {
                    $trainRoomData = dbs_chef_train_Room::getRoom($chefTrainData->get_trainRoomId());
                    if ($trainRoomData->exist()) {
                        if (!$trainRoomData->is_Cooldown()) {
                            //房间已经培训完成
                            $trainRoomData->refuseJoinRequest($chefTrainData->get_trainRequestId());
                            //这里就不做保存了,应该为拒绝请求的过程中,已经处理了用户数据
                        }
                    } else {
                        //房间不存在了???不太可能出现
                        $chefTrainData->cancelJoinTrain();

                    }
                }

            }
        }

    }

    /**
     * 计算厨师过期广告问题
     */
    private
    function computeTrainChefExpiredAdvertisements()
    {
        $chefs = $this->get_cheflist();
        $hasAdvertisement = false;
        foreach ($chefs as $chefId => $chef) {
            $chefData = dbs_chef_data::create_with_array($chef);
            if ($chefData->isStatusTraining()) {
                //培训中
                $chefTrainData = $chefData->getTrainData();
                if ($chefTrainData->get_isMaster()) {
                    //是房间主人,并且是一个人的时候
                    $trainRoomData = dbs_chef_train_Room::getRoom($chefTrainData->get_trainRoomId());

                    if ($trainRoomData->isSingleTrain() && $trainRoomData->get_publishAdvertisement()) {
                        if (!$trainRoomData->is_Cooldown() || time() > $trainRoomData->get_AdvertisementExpiredTime()) {
//                            dump("here");
                            $trainRoomData->clearAdvertisement();
                        } else {
                            $hasAdvertisement = true;
                        }
                    }

                }
            }
        }

        dbs_friend_recommenddata::createWithPlayer($this)->set_isPublishingTrainChefAdvertisement($hasAdvertisement);
    }


    /**
     * 是否可以使用补充体力道具
     *
     * @return boolean
     */
    public function canUseFillVitItem()
    {
        $count = $this->get_fillvitItemTodayUseCount();
        $count++;

        if ($count > Common_Util_Configdata::getInstance()->get_global_config_value('CHEF_USE_VIT_ITEM_EVERYDAY_LIMIT')->int_value()) {
            return false;
        }
        return true;
    }

    /**
     * 记录使用补充体力道具
     *
     * @return boolean false 使用失败
     */
    public function recordUseFillVitItem()
    {
        if (!$this->canUseFillVitItem()) {
            return false;
        }
        $count = $this->get_fillvitItemTodayUseCount();
        $count++;
        $this->set_fillvitItemTodayUseCount($count);
        return true;
    }

    /**
     *
     */
    public function addSpeedUpTrainChefTime()
    {
        $this->set_todaySpeedUpTrainChefTimes($this->get_todaySpeedUpTrainChefTimes() + 1);
    }


    use dbs_robot_logicTrait;

    /**
     * @inheritDoc
     */
    public function processRobotLogic(dbs_robot_data $robotData)
    {
        $this->autoChooseChefByRobot();
    }

    private function autoChooseChefByRobot()
    {
        foreach (configdata_chef_open_setting::data() as $data) {
            try {
                $chefOrderId = $data[configdata_chef_open_setting::k_id];
                $this->choose($chefOrderId, []);
            } catch (exception_logicError $e) {

            }
        }
    }

    /**
     * 机器人自动双休
     */
    private function autoTrainByRobot()
    {
        if (dbs_robot_player::createWithPlayer($this)->isCanHelpedTrainChef()) {
            $trainRoomData = null;

            $chefs = $this->get_cheflist();
            foreach ($chefs as $chefData) {
                $chef = dbs_chef_data::create_with_array($chefData);
                $trainData = $chef->getTrainData();

                if (!$trainData->isFree()) {
                    $trainRoom = dbs_chef_train_Room::getRoom($trainData->get_trainRoomId());
                    if ($trainRoom->isSingleTrain() &&
                        empty($trainRoom->get_joinRequests())
                        && time() - $trainRoom->get_startTime() > 60
                        && $trainRoom->is_Cooldown()
                    ) {
                        $trainRoomData = $trainRoom;
                        break;
                    }
                }
            }


            //有空闲的屋子
            if (!is_null($trainRoomData)) {
                $helpRobotId = dbs_robot_manager::getInstance()->getRandomRobotId();
                $robotPlayer = dbs_player::newGuestPlayerWithLock($helpRobotId);

                $robotChefs = dbs_chef_list::createWithPlayer($robotPlayer)->get_cheflist();
                foreach ($robotChefs as $chefId => $robotChef) {

                    $robotChefData = dbs_chef_list::createWithPlayer($robotPlayer)->get_chef($chefId);


                    dump($trainRoomData->toArray());
                    /**
                     * @var dbs_chef_data $robotChef
                     */
                    if ($robotChefData->getTrainData()->isFree()) {
                        dbs_chef_list::createWithPlayer($robotPlayer)->joinTrainChef($chefId, $trainRoomData->get_roomId());
                        break;
                    }
                }
                dbs_robot_player::createWithPlayer($this)->markHelpedTrainChef();
            }
        }
    }


}