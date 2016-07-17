<?php

namespace dbs\custom;

use Common\Db\Common_Db_memcached;
use Common\Db\Common_Db_memcacheObject;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Random;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_npc_custom_items_setting;
use configdata\configdata_npc_custom_setting;
use constants\constants_customtype;
use constants\constants_memcache;
use constants\constants_returnkey;
use dbs\dbs_baseplayer;
use dbs\dbs_player;
use dbs\dbs_warehouse;
use dbs\filters\dbs_filters_role;
use err\err_dbs_custom_visitor_accpetmission;
use err\err_dbs_custom_visitor_harvestawarditem;
use err\err_dbs_custom_visitor_vipVisitorBorn;
use err\err_dbs_custom_visitor_VisitorEatDishes;

class dbs_custom_visitor extends dbs_baseplayer
{
    /**
     * 获取npc掉落配置
     *
     * @param unknown $groupid
     * @return Ambigous <multitype:, boolean>
     */
    static function get_npc_dropitemgroup($groupid)
    {
        $groupid = strval($groupid);
        $key = 'npc_dropitem_groupid_' . $groupid;
        $memcache = Common_Db_memcached::getInstance();
        $items = $memcache->get($key);
        if ($items) {
            return $items;
        }

        $items = array();
        foreach (configdata_npc_custom_items_setting::data() as $value) {
            if ($value [configdata_npc_custom_items_setting::k_groupid] == $groupid) {
                // array_push ( $items, $value );
                $items [$value [configdata_npc_custom_items_setting::k_id]] = $value;
            }
        }

        $memcache->set($key, $items, constants_memcache::CONFIG_CACHE_TIME);
        return $items;
    }

    /**
     * visitors
     *
     * @var string
     */
    const DBKey_visitors = "visitors";

    /**
     * 获取visitors
     */
    public function get_visitors()
    {
        return $this->getdata(self::DBKey_visitors);
    }

    /**
     * 设置visitors
     *
     * @param unknown $value
     */
    private function set_visitors($visitors)
    {
        $this->setdata(self::DBKey_visitors, $visitors);
    }

    /**
     * 冷却中的npcid
     *
     * @var string
     */
    const DBKey_cooldownvisitors = "cooldownvisitors";

    /**
     * 获取冷却中的npcid
     */
    public function get_cooldownvisitors()
    {
        return $this->getdata(self::DBKey_cooldownvisitors);
    }

    /**
     * 设置冷却中的npcid
     *
     * @param unknown $value
     */
    private function set_cooldownvisitors($cooldownvisitors)
    {
        $this->setdata(self::DBKey_cooldownvisitors, $cooldownvisitors);
    }

    /**
     * 好友访客
     *
     * @var string
     */
    const DBKey_friendvisitors = "friendvisitors";

    /**
     * 获取好友访客
     */
    public function get_friendvisitors()
    {
        return $this->getdata(self::DBKey_friendvisitors);
    }

    /**
     * 设置好友访客
     *
     * @param unknown $friendvisitors
     */
    private function set_friendvisitors($friendvisitors)
    {
        $this->setdata(self::DBKey_friendvisitors, $friendvisitors);
    }

    /**
     * 设置好友访客 默认值
     */
    protected function _set_defaultvalue_friendvisitors()
    {
        $this->set_defaultkeyandvalue(self::DBKey_friendvisitors, array());
    }

    /**
     * 好友冷却列表
     *
     * @var string
     */
    const DBKey_friendcdvisitors = "friendcdvisitors";

    /**
     * 获取好友冷却列表
     */
    public function get_friendcdvisitors()
    {
        return $this->getdata(self::DBKey_friendcdvisitors);
    }

    /**
     * 设置好友冷却列表
     *
     * @param unknown $friendcdvisitors
     */
    private function set_friendcdvisitors($friendcdvisitors)
    {
        $this->setdata(self::DBKey_friendcdvisitors, $friendcdvisitors);
    }

    /**
     * 设置好友冷却列表 默认值
     */
    protected function _set_defaultvalue_friendcdvisitors()
    {
        $this->set_defaultkeyandvalue(self::DBKey_friendcdvisitors, array());
    }

    /**
     * 好友生成时间
     *
     * @var string
     */
    const DBKey_friend_custom_borntime = "friend_custom_borntime";

    /**
     * 获取好友生成时间
     */
    public function get_friend_custom_borntime()
    {
        return $this->getdata(self::DBKey_friend_custom_borntime);
    }

    /**
     * 设置好友生成时间
     *
     * @param unknown $friend_custom_borntime
     */
    private function set_friend_custom_borntime($friend_custom_borntime)
    {
        $this->setdata(self::DBKey_friend_custom_borntime, $friend_custom_borntime);
    }

    /**
     * 设置好友生成时间 默认值
     */
    protected function _set_defaultvalue_friend_custom_borntime()
    {
        $this->set_defaultkeyandvalue(self::DBKey_friend_custom_borntime, 0);
    }

    const DBKey_tablename = 'custom_visitor';

    function __construct()
    {
        parent::__construct(self::DBKey_tablename, array(
            self::DBKey_userid => '',
            self::DBKey_visitors => array(),
            self::DBKey_cooldownvisitors => array()
        ));
    }

    /**
     * 通过npcid获取生成的npc
     *
     * @param string $npcid
     * @return Ambigous <NULL, dbs_custom_visitordata>
     */
    public function get_visitor_bynpcid($npcid)
    {
        $npcid = strval($npcid);
        $visitors = $this->get_visitors();
        if (array_key_exists($npcid, $visitors)) {
            $visitor = new dbs_custom_visitordata ();
            $visitor->fromArray($visitors [$npcid]);
            return $visitor;
        }
        return null;;
    }

    /**
     * 获取好友npc
     *
     * @param unknown $frienduserid
     * @return dbs_custom_visitordatafriend|NULL
     */
    public function get_friend_visitor_byfrienduserid($frienduserid)
    {
        $frienduserid = strval($frienduserid);
        $visitors = $this->get_friendvisitors();
        if (array_key_exists_faster($frienduserid, $visitors)) {
            $visitor = new dbs_custom_visitordatafriend ();
            $visitor->fromArray($visitors [$frienduserid]);
            return $visitor;
        }
        return null;
    }

    /**
     * npc是否在冷却中
     *
     * @param string $npcid
     * @return boolean
     */
    public function is_visitor_cooldown($npcid)
    {
        $npcid = strval($npcid);
        return array_key_exists($npcid, $this->get_cooldownvisitors());
    }

    /**
     * npc是否在冷却中
     *
     * @param string $frienduserid
     * @return boolean
     */
    public function is_friend_visitor_cooldown($frienduserid)
    {
        $frienduserid = strval($frienduserid);
        return array_key_exists($frienduserid, $this->get_friendcdvisitors());
    }

    /**
     * 生成好友npc
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    private function friendvisitorborn()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $borncooldown = Common_Util_Configdata::getInstance()->get_global_config_value('VISITOR_FRIEND_BORN_INTERVAL')->int_value();
        // 好友生成冷却中
        if (time() < $this->get_friend_custom_borntime() + $borncooldown) {
            goto failed;
        }

        $max_friend_count = Common_Util_Configdata::getInstance()->get_global_config_value('VISITOR_FRIEND_MAX_NUM')->int_value();
        $friends = $this->db_owner->db_friend()->get_friendlist();
        $friendvisitors = $this->get_friendvisitors();
        if (count($friendvisitors) >= $max_friend_count) {
            goto failed;
        }

        // 好友生成数量
        $bornfriendscount = Common_Util_Configdata::getInstance()->get_global_config_value('VISITOR_FRIEND_BORN_NUM')->int_value();

        $enablefriends = array();

        $randomfriendarr = array();
        foreach ($friends as $frienduserid => $frienddata) {
            // 已经出现了
            if ($this->get_friend_visitor_byfrienduserid($frienduserid)) {
                continue;
            }

            // 出现间隔
            if ($this->is_friend_visitor_cooldown($frienduserid)) {
                continue;
            }

            // 好友
            $randomfriendarr [$frienduserid] = 2;
        }

        // 推荐群里面的好友
        $groupdata = $this->db_owner->dbs_neighbourhood_playerdata()->get_groupdata();

        if (!is_null($groupdata)) {
            $members = $groupdata->get_member();
            foreach ($members as $frienduserid => $frienddata) {
                if ($frienduserid == $this->get_userid()) {
                    continue;
                }
                // 已经出现了
                if ($this->get_friend_visitor_byfrienduserid($frienduserid)) {
                    continue;
                }
                // 出现间隔
                if ($this->is_friend_visitor_cooldown($frienduserid)) {
                    continue;
                }
                $randomfriendarr [$frienduserid] = 1;
            }
        }

        // dump ( $randomfriendarr );

        if (count($randomfriendarr) != 0) {
            // 生成好友

            $frienduserid = Common_Util_Random::RandomWithWeight($randomfriendarr);

            // dump ( $randomfriendarr );
            // dump ( $frienduserid );
            $visitor = dbs_custom_visitordatafriend::create($frienduserid);
            $visitor->set_timeborn(time());
            $lifetime = Common_Util_Configdata::getInstance()->get_global_config_value('VISITOR_FRIEND_LEFTTIME')->int_value();
            $visitor->set_timedead(time() + $lifetime);

            $friendplayer = dbs_player::newGuestPlayer($frienduserid);
            $visitor->set_friendinfo($friendplayer->db_role()->toArray(dbs_filters_role::$filters_simple_info));
            $visitor->set_isfriend($randomfriendarr [$frienduserid] == 2);

            $friendvisitors [$frienduserid] = $visitor->toArray();

            $this->addVisitorToEatCache($visitor);
        } else {
            goto failed;
        }

        $this->set_friendvisitors($friendvisitors);
        $this->set_friend_custom_borntime(time());

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     *
     * @var Common_Db_memcacheObject
     */
    private $eatCache;

    /**
     *
     * @return \Common\Db\Common_Db_memcacheObject
     */
    private function getEatCache()
    {
        if (!$this->eatCache instanceof Common_Db_memcacheObject) {
            $this->eatCache = Common_Db_memcacheObject::create('Visitors_Cache_' . $this->get_userid());
            $this->eatCache->setExpiration(10 * 60);
        }
        return $this->eatCache;
    }

    /**
     * 访客增加到缓存中吃饭缓存中
     *
     * @param dbs_custom_visitordata $visitor
     */
    private function addVisitorToEatCache(dbs_custom_visitordata $visitor)
    {
        $visitors = $this->getEatCache()->get_value([]);
        $visitors [$visitor->get_guid()] = $visitor->toArray();
        $this->getEatCache()->set_value($visitors);
    }

    /**
     * 从缓存中获取吃饭缓存访客信息
     *
     * @param unknown $guid
     * @return \Common\Db\Ambigous|NULL
     */
    public function getVisitorFromEatCache($guid)
    {
        $visitors = $this->getEatCache()->get_value([]);
        if (isset ($visitors [$guid])) {
            return $visitors [$guid];
        }
        return null;
    }

    /**
     * 从吃饭缓存中删除访客数据
     *
     * @param unknown $guid
     */
    private function deleteVisitorFromEatCache($guid)
    {
        $cache = $this->getEatCache();
        $visitors = $cache->get_value([]);
        unset ($visitors [$guid]);
        $cache->set_value($visitors);
    }

    /**
     * 删除过期的吃饭票据
     */
    private function deleteTimeoutVisitorFromEatCache()
    {
        $dirty = false;
        $cache = $this->getEatCache();
        $visitors = $cache->get_value([]);
        foreach ($visitors as $guid => $visitor) {
            if ($visitor [dbs_custom_visitordata::DBKey_timedead] + 10 * 60 < time()) {
                unset ($visitors [$guid]);
                $dirty = true;
            }
        }
        if ($dirty) {
            $cache->set_value($visitors);
        }
    }

    /**
     * NPC吃菜
     *
     * @param unknown $guid
     * @param string $DishesId
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function VisitorEatDishes($guid, $DishesId)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_custom_visitor_VisitorEatDishes{}

        $visitorData = $this->getVisitorFromEatCache($guid);
        if (is_null($visitorData)) {
            $retCode = err_dbs_custom_visitor_VisitorEatDishes::GUID_INVALID;
            $retCode_Str = 'GUID_INVALID';
            goto failed;
        }
        // 删除此id
        $this->deleteVisitorFromEatCache($guid);

        $visitor = new dbs_custom_visitordata ();
        $visitor->fromArray($visitorData);

        // 目前只处理特殊NPC
        if ($visitor->get_npctype() == constants_customtype::NPC) {

            $visitors = $this->get_visitors();
            // 当前处理的NPC还活在列表中
            if (isset ($visitors [$visitor->get_npcid()])) {
                $visitor->fromArray($visitors [$visitor->get_npcid()]);
                if ($visitor->get_alreadyEat()) {
                    $this->deleteVisitorFromEatCache($guid);
                    $retCode = err_dbs_custom_visitor_VisitorEatDishes::ALREADY_EAT;
                    $retCode_Str = 'ALREADY_EAT';
                    goto failed;
                }
                $visitor->set_alreadyEat(true);
                $visitors [$visitor->get_npcid()] = $visitor->toArray();

                $this->set_visitors($visitors);
            }

            // 处理吃的菜品和好感度之间的关系
            $customConfig = dbs_custom_goodwill::get_customconfig($visitor->get_npcid());
            if ($customConfig [configdata_npc_custom_setting::k_favoritedishesid] === $DishesId) {
                $goodwillvalue = Common_Util_Configdata::getInstance()->get_global_config_value('VIP_CUSTOM_EAT_FAVORITE_DISHES_ADD_GOODWILL')->int_value();
                $this->db_owner->db_custom_goodwill()->addgoodwillexp($visitor->get_npcid(), $goodwillvalue);
                $data [constants_returnkey::RK_GOODWILL_DATA] = $goodwillvalue;
            }
        }

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 生产普通npc
     *
     * @return Common_Util_ReturnVar
     */
    private function vistorNpcBorn()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // $reputationlevelconfig = dbs_restaurantinfo::getreputationlevelConfig($this->db_owner->db_restaurantinfo()->get_reputationlevel());
        // 最多的vip数量 2星往上
// 		$this->db_owner->db_restaurantinfo ()->computecustoms(1);
        $maxvipcount = $this->db_owner->db_restaurantinfo()->get_customvips();

// 		$maxvipcount = 1;
// 		dump ( $maxvipcount );
        if ($maxvipcount == 0) {
            goto failed;
        }

        // 可以出现的npc
        $customs = array();

        foreach (configdata_npc_custom_setting::data() as $value) {
            // dump ( $value );
            // 不是自动出现的npc
            if ($value [configdata_npc_custom_setting::k_autoappear] != '1') {
                continue;
            }
            /**
             * 不是一星顾客
             */
            if ($value [configdata_npc_custom_setting::k_type] == '1') {
                continue;
            }
            // 开启等级不够
            if ($this->db_owner->db_restaurantinfo()->get_restaurantlevel() < intval($value [configdata_npc_custom_setting::k_appearrestaurantlevel])) {
                continue;
            }

            // 美誉度经验不够
//            if ($this->db_owner->db_restaurantinfo()->get_reputationtotalexp() < intval($value [configdata_npc_custom_setting::k_appearreputationexp])) {
//                continue;
//            }
            // 需要连续天数
            if ($this->db_owner->db_role()->get_continuelogin() < intval($value [configdata_npc_custom_setting::k_appeardays])) {
                continue;
            }

            $npcid = $value [configdata_npc_custom_setting::k_id];

            // 已经出现了
            if ($this->get_visitor_bynpcid($npcid)) {
                continue;
            }
            // 出现间隔
            if ($this->is_visitor_cooldown($npcid)) {
                continue;
            }
            $customs [$npcid] = 1;
        }

        $visitors = $this->get_visitors();
        // 剩余可以生成的vip顾客的数量
        $maxvipcount = $maxvipcount - count($visitors);
        if ($maxvipcount <= 0) {
            goto failed;
        }

        for ($i = 0; $i < $maxvipcount; $i++) {
            $customid = Common_Util_Random::RandomWithWeight($customs);
            unset ($customs [$customid]);
            if (empty ($customid)) {
                break;
            }
            $visitor = $this->vipVisitorBornImp($customid);
            $visitors [$customid] = $visitor->toArray();
            $this->addVisitorToEatCache($visitor);
        }

        $this->set_visitors($visitors);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 生成特殊NPC
     *
     * @param unknown $customIDs
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function vipVisitorBorn($customIDs = [])
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_custom_visitor_vipVisitorBorn{}

        $visitors = $this->get_visitors();

        foreach ($customIDs as $customID) {
            $config = dbs_custom_goodwill::get_customconfig($customID);
            if (empty ($config)) {
                $retCode = err_dbs_custom_visitor_vipVisitorBorn::NPC_CONFIG_ERROR;
                $retCode_Str = 'NPC_CONFIG_ERROR';
                goto failed;
            }
            $visitors [$customID] = $this->vipVisitorBornImp($customID)->toArray();
        }
        $this->set_visitors($visitors);

        // 删除冷却ID

        $cooldownVisitors = $this->get_cooldownvisitors();
        foreach ($customIDs as $customID) {
            unset ($cooldownVisitors [$customID]);
        }
        $this->set_cooldownvisitors($cooldownVisitors);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 生成特殊NPC
     *
     * @param unknown $customid
     * @return dbs_custom_visitordata
     */
    private function vipVisitorBornImp($customid)
    {
        // 设置出现
//		$this->db_owner->db_mission ()->set_mission_object ( constants_mission::MISSION_FINISH_CONDITION_13, 1 );

        $ret = $this->db_owner->db_custom_goodwill()->getgoodwill($customid);
        // dump ( $ret );
        $hasgoodwill = $ret->is_succ();
        if ($hasgoodwill) {
            $goodwilldata = $ret->get_retdata();
        } else {
            $goodwilldata = [];
        }

        $visitor = dbs_custom_visitordata::create($customid);
        // $visitor->set
        $visitor->set_timeborn(time());
        $config = dbs_custom_goodwill::get_customconfig($customid);
        $visitor->set_timedead(time() + intval($config [configdata_npc_custom_setting::k_appeartimeinterval]));

        if ($hasgoodwill) {
            $goodwill_level = $goodwilldata [dbs_custom_goodwilldata::DBKey_level];
            if (!$goodwilldata [dbs_custom_goodwilldata::DBKey_completelevelupmission]) {
                // 接取升级任务
                $missionkey = 'goodwill' . $goodwill_level . 'missionid';
                if (array_key_exists($missionkey, $config)) {
                    $visitor->set_missionid($config [$missionkey]);
                } else {
                    $this->db_owner->db_custom_goodwill()->set_missionfinish($customid);
                }
            } else {
                // 携带道具
                $awardid1 = 'awardgoodwill' . $goodwill_level . 'groupid1';
                $awardprecent1 = 'awardgoodwill' . $goodwill_level . 'groupprecent1';
                $awarditems = array();

                if (array_key_exists($awardid1, $config)) {
                    $awardprecent = intval($config [$awardprecent1]);
                    $weight = rand(0, 10000);
                    if ($weight < $awardprecent) {
                        $dropitemsconfig = self::get_npc_dropitemgroup($config [$awardid1]);
                        $dropitems = array();
                        foreach ($dropitemsconfig as $key => $value) {
                            $dropitems [$key] = intval($value [configdata_npc_custom_items_setting::k_weight]);
                        }

                        $dropitemid = Common_Util_Random::RandomWithWeight($dropitems);
                        $dropitemconfig = $dropitemsconfig [$dropitemid];

                        // 添加到掉落物品
                        $awarditems [$dropitemconfig [configdata_npc_custom_items_setting::k_itemid]] = $dropitemconfig [configdata_npc_custom_items_setting::k_itemcount];
                    }
                }

                $awardid2 = 'awardgoodwill' . $goodwill_level . 'groupid2';
                $awardprecent2 = 'awardgoodwill' . $goodwill_level . 'groupprecent2';

                if (isset ($config [$awardid2])) {
                    $awardprecent = intval($config [$awardprecent2]);
                    $weight = rand(0, 10000);
                    if ($weight < $awardprecent) {
                        $dropitemsconfig = self::get_npc_dropitemgroup($config [$awardid2]);
                        $dropitems = array();
                        foreach ($dropitemsconfig as $key => $value) {
                            $dropitems [$key] = intval($value [configdata_npc_custom_items_setting::k_weight]);
                        }

                        $dropitemid = Common_Util_Random::RandomWithWeight($dropitems);
                        $dropitemconfig = $dropitemsconfig [$dropitemid];

                        // 添加到掉落物品
                        $awarditems [$dropitemconfig [configdata_npc_custom_items_setting::k_itemid]] = $dropitemconfig [configdata_npc_custom_items_setting::k_itemcount];
                    }
                }

                // 整理掉落物品
                foreach ($awarditems as $key => $value) {
                    $visitor->addItem($key, $value);
                }
            }
        }

        return $visitor;
    }

    /**
     * 删除过期的npc
     */
    private function delete_timeout_friend_vistor()
    {
        $cooldownvisitors = $this->get_friendcdvisitors();

        $visitors = $this->get_friendvisitors();

        $cooldowntime = Common_Util_Configdata::getInstance()->get_global_config_value('VISITOR_FRIEND_COOLDOWN')->int_value();
        foreach ($visitors as $key => $value) {
            $visitor = new dbs_custom_visitordatafriend ();
            $visitor->fromArray($value);
            if ($visitor->isdead()) {
                unset ($visitors [$key]);

                $visitor->set_timeborn(time());
                $visitor->set_timedead(time() + $cooldowntime);
                $cooldownvisitors [$visitor->get_npcid()] = $visitor->toArray();
            }
        }

        // 删除冷却结束的npc
        foreach ($cooldownvisitors as $key => $value) {
            $visitor = new dbs_custom_visitordatafriend ();
            $visitor->fromArray($value);
            if ($visitor->isdead()) {
                unset ($cooldownvisitors [$key]);
            }
        }
        $this->set_friendvisitors($visitors);

        $this->set_friendcdvisitors($cooldownvisitors);
    }

    /**
     * 删除过期的npc
     */
    private function delete_timeoutvistor()
    {
        $cooldownvisitors = $this->get_cooldownvisitors();

        $visitors = $this->get_visitors();
        foreach ($visitors as $key => $value) {
            $visitor = new dbs_custom_visitordata ();
            $visitor->fromArray($value);
            if ($visitor->isdead()) {
                unset ($visitors [$key]);

                $config = dbs_custom_goodwill::get_customconfig($visitor->get_npcid());
                $cooldowntime = intval($config [configdata_npc_custom_setting::k_appeartimecooldown]);
                if ($cooldowntime > 0) {
                    $visitor->set_timeborn(time());
                    $visitor->set_timedead(time() + $cooldowntime);
                    $cooldownvisitors [$visitor->get_npcid()] = $visitor->toArray();
                }
            }
        }

        // 删除冷却结束的npc
        foreach ($cooldownvisitors as $key => $value) {
            $visitor = new dbs_custom_visitordata ();
            $visitor->fromArray($value);
            if ($visitor->isdead()) {
                unset ($cooldownvisitors [$key]);
            }
        }
        $this->set_visitors($visitors);

        $this->set_cooldownvisitors($cooldownvisitors);
        // $this->dumpDB ();
    }

    /**
     * 收获npc身上的物品
     *
     * @param unknown $npcguid
     * @return Common_Util_ReturnVar
     */
    function harvestawarditem($npcguid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_custom_visitor_harvestawarditem{}

        $npcguid = strval($npcguid);
        $visitors = $this->get_visitors();
        $visitor = null;
        foreach ($visitors as $key => $value) {
            if ($value [dbs_custom_visitordata::DBKey_guid] == $npcguid) {
                $visitor = new dbs_custom_visitordata ();
                $visitor->fromArray($value);
                break;
            }
        }

        if (is_null($visitor)) {
            $retCode = err_dbs_custom_visitor_harvestawarditem::NOT_FOUND_NPC;
            $retCode_Str = 'NOT_FOUND_NPC';
            goto failed;
        }

        if (empty ($visitor->get_itemid1())) {
            $retCode = err_dbs_custom_visitor_harvestawarditem::NPC_NOT_HAS_ITEM;
            $retCode_Str = 'NPC_NOT_HAS_ITEM';
            goto failed;
        }

        // 添加第一个道具
        if (!empty ($visitor->get_itemid1())) {
            dbs_warehouse::additemtowarehouse($this->db_owner, $visitor->get_itemid1(), $visitor->get_itemcount1());
        }
        // 添加第二个道具
        if (!empty ($visitor->get_itemid2())) {
            dbs_warehouse::additemtowarehouse($this->db_owner, $visitor->get_itemid2(), $visitor->get_itemcount2());
        }

        // 从访客列表中删除
        unset ($visitors [$visitor->get_npcid()]);

        // 添加到冷却列表中

        $config = dbs_custom_goodwill::get_customconfig($visitor->get_npcid());
        $cooldowntime = intval($config [configdata_npc_custom_setting::k_appeartimecooldown]);
        if ($cooldowntime > 0) {
            $cooldownvisitors = $this->get_cooldownvisitors();
            $visitor->set_timeborn(time());
            $visitor->set_timedead(time() + $cooldowntime);
            $cooldownvisitors [$visitor->get_npcid()] = $visitor->toArray();
            $this->set_cooldownvisitors($cooldownvisitors);
        }

        // 增加好感度
        $this->db_owner->db_custom_goodwill()->addgoodwillexp($visitor->get_npcid(), 1);
        $this->set_visitors($visitors);
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    function accpetmission($guid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_custom_visitor_accpetmission{}

        $guid = strval($guid);
        $visitors = $this->get_visitors();
        $visitor = null;
        foreach ($visitors as $key => $value) {
            if ($value [dbs_custom_visitordata::DBKey_guid] == $guid) {
                $visitor = new dbs_custom_visitordata ();
                $visitor->fromArray($value);
                break;
            }
        }
        if (is_null($visitor)) {
            $retCode = err_dbs_custom_visitor_accpetmission::NOT_FOUND_NPC;
            $retCode_Str = 'NOT_FOUND_NPC';
            goto failed;
        }

        if (empty ($visitor->get_missionid())) {
            $retCode = err_dbs_custom_visitor_accpetmission::NPC_NOT_HAS_MISSION;
            $retCode_Str = 'NPC_NOT_HAS_MISSION';
            goto failed;
        }
        // code

        // 接受任务错误
        if (!$this->db_owner->db_mission()->acceptNpcMission($visitor->get_missionid())) {
            $retCode = err_dbs_custom_visitor_accpetmission::ACCPET_MISSION_ERROR;
            $retCode_Str = 'ACCPET_MISSION_ERROR';
            goto failed;
        }
        /**
         * 标记任务已经接受过了
         */
        $this->db_owner->db_custom_goodwill()->set_missionfinish($visitor->get_npcid());

        // 从访客列表中删除
        unset ($visitors [$visitor->get_npcid()]);

        // 添加到冷却列表中

        $config = dbs_custom_goodwill::get_customconfig($visitor->get_npcid());
        $cooldowntime = intval($config [configdata_npc_custom_setting::k_appeartimecooldown]);
        if ($cooldowntime > 0) {
            $cooldownvisitors = $this->get_cooldownvisitors();
            $visitor->set_timeborn(time());
            $visitor->set_timedead(time() + $cooldowntime);
            $cooldownvisitors [$visitor->get_npcid()] = $visitor->toArray();
            $this->set_cooldownvisitors($cooldownvisitors);
        }

        $this->set_visitors($visitors);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    public function masterbeforecall()
    {
        $this->delete_timeoutvistor();
        $this->delete_timeout_friend_vistor();
        $this->deleteTimeoutVisitorFromEatCache();
    }

    /**
     * 生成访问者
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function visitorsborn()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $ret_npc = $this->vistorNpcBorn();
        $ret_friend = $this->friendvisitorborn();

        $data = [];
        $visitors = $this->get_visitors();
        $data ['normalNPCs'] = $visitors;
        $friendvisitors = $this->get_friendvisitors();
        $data ['friends'] = $friendvisitors;
        // code

// 		$memcache = $this->getEatCache ();
// 		dump ( $memcache->get_value ( [ ] ) );

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}