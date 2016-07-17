<?php

namespace service;

use Common\Db\Common_Db_memcacheObject;
use Common\Db\Common_Db_pools;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use configdata\configdata_robot_building_setting;
use constants\constants_lookupNormalModel;
use constants\constants_returnkey;
use dbs\chef\dbs_chef_list;
use dbs\chef\employ\dbs_chef_employ_player;
use dbs\chef\jobs\dbs_chef_jobs_player;
use dbs\dbs_friend;
use dbs\dbs_player;
use dbs\dbs_restaurantinfo;
use dbs\dbs_role;
use dbs\dbs_vip;
use dbs\filters\dbs_filters_restaurantinfo;
use dbs\filters\dbs_filters_role;
use dbs\friend\dbs_friend_goodwill;
use dbs\itemgraft\dbs_itemgraft_player;
use dbs\photoalbum\dbs_photoalbum_player;
use dbs\robot\dbs_robot_data;
use dbs\robot\dbs_robot_manager;
use dbs\robot\dbs_robot_player;
use dbs\scene\dbs_scene_player;
use dbs\scenebox\dbs_scenebox_scenebox;
use dbs\themeRestaurant\dbs_themeRestaurant_Info;
use dbs\themeRestaurant\dbs_themeRestaurant_Player;
use err\err_service_lookup_lookupchefinfo;
use err\err_service_lookup_lookupfriendhelp;
use err\err_service_lookup_lookUpNormalModel;
use err\err_service_lookup_lookuproleinfo;
use err\err_service_lookup_lookuproleinfobyrolename;
use err\err_service_lookup_lookUpThemeRestaurantReputation;

/**
 * 查询服务
 *
 * @author zhipeng
 *
 */
class service_lookup extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            "lookupchefinfo",
            "lookupvipinfo",
            "lookupsceneinfo",
            'lookuprestaurantinfo',
            'lookuproleinfo',
            'lookuproleinfobyrolename',
            'lookupPhotoAlbum',
            'lookUpGraftInfo',
            'lookUpTrainChef',
            'lookUpThemeRestaurantInfo',
            'lookUpFriends',
            'lookUpNormalModel',
            'lookUpThemeRestaurantReputation'
        ));

        //厨师职业模块
        $this->addNormalModel(constants_lookupNormalModel::MODEL_CHEF_JOB,
            dbs_chef_jobs_player::class);
        $this->addNormalModel(constants_lookupNormalModel::MODEL_CHEF_EMPLOY,
            dbs_chef_employ_player::class);


    }

    /**
     * @var array
     */
    private $lookUpNormalModels = [];

    /**
     * 添加通用查看接口
     * @param $key
     * @param $className
     */
    private function addNormalModel($key, $className)
    {
        $this->lookUpNormalModels[$key] = $className;
    }

    private $currentCacheKey = null;
    /**
     * 是否开启缓存数据
     * @var bool
     */
    private $enableCacheData = true;

    /**
     * @param $destuserid
     * @param $functionname
     * @return null
     * @throw exception_logicSucc
     */
    private function getCache($destuserid, $functionname)
    {

        //没开启缓存
        if (!$this->enableCacheData) {
            return null;
        }

        $this->currentCacheKey = 'service_lookup_' . $functionname . '_' . $destuserid;
        $memcacheObj = Common_Db_memcacheObject::create($this->currentCacheKey);
        $data = $memcacheObj->get_value();
        if (!is_null($data)) {
            $this->currentCacheKey = null;
            logicSuccess($data);
        }
        return null;
    }

    /**
     * 设置缓存
     * @param $data
     * @param null $destUserId
     * @param null $functionName
     * @param int $cacheTime
     */
    private function setCache($data, $destUserId = null, $functionName = null, $cacheTime = 30)
    {
        //没开启缓存
        if (!$this->enableCacheData) {
            return;
        }
        $cacheKey = $this->currentCacheKey;

        if (!is_null($destUserId) || !is_null($functionName)) {
            $cacheKey = 'service_lookup_' . $functionName . '_' . $destUserId;

        }
        if (empty($cacheKey)) {
            return;
        }

        $memcacheObj = Common_Db_memcacheObject::create($cacheKey);
        if (!$memcacheObj->has_value()) {
            $memcacheObj->setExpiration($cacheTime);
            $memcacheObj->set_value($data);
        }

    }

    /**
     * 缓存单个 baseplayer实例
     * @param $className
     * @param $userId
     * @return \dbs\dbs_baseplayer
     */
    private function cacheOrNew($className, $userId)
    {
        $cacheObject = $className::getCacheObjectOrNew($userId);
        logicErrorCondition(!is_null($cacheObject),
            err_service_lookup_lookuproleinfo::DEST_USER_NOT_FOUND,
            'DEST_USER_NOT_FOUND');
        return $cacheObject;
    }

    protected function callFunctionAfter($functionName, $params = [])
    {
        $this->currentCacheKey = null;
    }


    /**
     * 查看其它人的厨师信息
     *
     * @param $destUserId
     * @return Common_Util_ReturnVar
     */
    function lookupchefinfo($destUserId)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_lookup_lookup_chefinfo{}

        typeCheckUserId($destUserId);

        $chefCacheObject = $this->cacheOrNew(dbs_chef_list::class, $destUserId);
        $chefDataCacheObject = $this->cacheOrNew(dbs_chef_jobs_player::class, $destUserId);
        $data["cheflist"] = $chefCacheObject->toArray();
        $chefData = $chefDataCacheObject->getJobChefData();
        if (is_null($chefData)) {
            $data[constants_returnkey::RK_MAIN_CHEF_DATA] = null;
        } else {
            $data[constants_returnkey::RK_MAIN_CHEF_DATA] = $chefData->toArray();
        }
//        $destUserId = strval($destUserId);

//        $destPlayer = dbs_player::newGuestPlayerWithLock($destUserId);
//        if (!$destPlayer->is_user_exists()) {
//            $retCode = err_service_lookup_lookupchefinfo::DEST_USER_NOT_FOUND;
//            $retCode_Str = 'DEST_USER_NOT_FOUND';
//            goto failed;
//        }
//
//        $data ['cheflist'] = $destPlayer->dbs_chef_list()->toArray();
//        $chefData = dbs_chef_jobs_player::createWithPlayer($destPlayer)->getJobChefData();
//        if (is_null($chefData)) {
//            $data[constants_returnkey::RK_MAIN_CHEF_DATA] = null;
//        } else {
//            $data[constants_returnkey::RK_MAIN_CHEF_DATA] = $chefData->toArray();
//        }

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }


    /**
     * 查看场景信息
     *
     * @param string $destUserid
     * @param int $themeRestaruantId 主题餐厅ID
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function lookupsceneinfo($destUserid, $themeRestaruantId)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        typeCheckUserId($destUserid);
        typeCheckNumber($themeRestaruantId);

        $this->getCache($destUserid, __FUNCTION__ . '_' . $themeRestaruantId);


        // class err_service_lookup_lookupsceneinfo{}
        $destplayer = dbs_player::newGuestPlayer($destUserid);
        if (!$destplayer->isRoleExists()) {
            $retCode = err_service_lookup_lookupchefinfo::DEST_USER_NOT_FOUND;
            $retCode_Str = 'DEST_USER_NOT_FOUND';
            goto failed;
        }

        if (dbs_robot_manager::getInstance()->isNormalRobot($destUserid)) {

            $agentUserId = dbs_robot_data::getRobotData($destUserid)->getAgentSceneUserId();
            if ($agentUserId !== $destUserid) {
                $destplayer = dbs_player::newGuestPlayer($agentUserId);
            }
        }

        $dbs_scene = dbs_scene_player::createWithPlayer($destplayer);

        if ($dbs_scene instanceof dbs_scene_player) {
            $data ['sceneinfo'] = $dbs_scene->getThemeRestaurantSceneInfo($themeRestaruantId)->get_retdata();
            $data ['ValidCells'] = $dbs_scene->getValidCellsByExpandLevel($themeRestaruantId)->get_retdata();
            $data [dbs_scene_player::DBKey_userid] = $destUserid;
        }
        // code

        $this->setCache($data);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 查看vip信息
     *
     * @param string $destUserId
     * @return Common_Util_ReturnVar
     */
    function lookupvipinfo($destUserId)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';

        typeCheckUserId($destUserId);


        $cacheObject = $this->cacheOrNew(dbs_vip::class, $destUserId);
        $data = $cacheObject->toArray(array(
            dbs_vip::DBKey_userid,
            dbs_vip::DBKey_viplevelinfo
        ));

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }

    /**
     * 查看餐厅信息
     *
     * @param string $destuserid
     *            目标用户
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function lookuprestaurantinfo($destuserid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';

        $cacheObject = $this->cacheOrNew(dbs_restaurantinfo::class, $destuserid);
        $data = $cacheObject->toArray(dbs_filters_restaurantinfo::$lookupinfo);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }


    /**
     * 查看用户信息
     *
     * @param string $destUserId
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function lookuproleinfo($destUserId)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        typeCheckUserId($destUserId);

        $cacheObject = $this->cacheOrNew(dbs_role::class, $destUserId);
        $data = $cacheObject->toArray([]);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }

    /**
     * 通过rolename查找用户信息
     *
     * @param string $roleName
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function lookuproleinfobyrolename($roleName)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        typeCheckString($roleName, 14, 1);
        $this->getCache($roleName, __FUNCTION__);

        $returns = Common_Db_pools::default_Db_pools()->dbconnect()->query(dbs_role::DBKey_tablename,
            [
                dbs_role::DBKey_rolename => [
                    '$regex'=>new \MongoRegex("/$roleName/")
                ]
            ]
            , [
                dbs_role::DBKey_userid
            ]);
        if (count($returns) == 0) {
            $retCode = err_service_lookup_lookuproleinfobyrolename::DEST_USER_NOT_FOUND;
            $retCode_Str = 'DEST_USER_NOT_FOUND';
            goto failed;
        }

        $roleInfos = [];
        foreach ($returns as $ret) {
            $userid = $ret [dbs_role::DBKey_userid];
            $roleInfoReturn = $this->lookuproleinfo($userid);
            $roleInfos [$userid] = $roleInfoReturn->get_retdata();
        }
        $data [constants_returnkey::RK_ROLEINFO] = $roleInfos;

        $this->setCache($data);
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 查看其它人场景宝箱信息
     *
     * @param unknown $destuserid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function lookupsceneboxinfo($destuserid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        typeCheckUserId($destuserid);


        $cacheObject = $this->cacheOrNew(dbs_scenebox_scenebox::class, $destuserid);
        $data = $cacheObject->toArray();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }


    /**
     * 查看他人相册
     *
     * @param  $destuserid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function lookupPhotoAlbum($destuserid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';

        typeCheckUserId($destuserid);
        $cacheObject = $this->cacheOrNew(dbs_photoalbum_player::class, $destuserid);
        $data = $cacheObject->toArray();
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
    }

    /**
     * 查看嫁接信息
     * @param $destUserid
     * @return Common_Util_ReturnVar
     */
    public function lookUpGraftInfo($destUserid)
    {
        $data = [];
        //class err_service_lookup_lookUpGraftInfo

        typeCheckUserId($destUserid);
        $cacheObject = $this->cacheOrNew(dbs_itemgraft_player::class, $destUserid);
        $data = $cacheObject->toArray([
            dbs_itemgraft_player::DBKey_slots,
            dbs_itemgraft_player::DBKey_dataTemplateType
        ]);

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 查看培训信息
     * @param $destUserId
     * @return Common_Util_ReturnVar
     */
    public function lookUpTrainChef($destUserId)
    {
        $data = [];
        typeCheckUserId($destUserId);

        $cacheObject = $this->cacheOrNew(dbs_chef_list::class, $destUserId);
        if ($cacheObject instanceof dbs_chef_list) {
            $data = $cacheObject->getTrainChefInfo()->get_retdata();
        }
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 查看好友餐厅信息
     * @param $destUserId
     * @return Common_Util_ReturnVar
     */
    public function lookUpThemeRestaurantInfo($destUserId)
    {
        typeCheckUserId($destUserId);

//        $destPlayer = dbs_player::newGuestPlayer($destUserId);
        if (dbs_robot_manager::getInstance()->isNormalRobot($destUserId)) {
            dump("agent");
//            $destUserId = "userid-0b5553bd-fcf6-69c9-482c-0eff6db1019f";
            //agentId.
            $agentUserId = dbs_robot_data::getRobotData($destUserId)->getAgentSceneUserId();
            $cacheObject = $this->cacheOrNew(dbs_themeRestaurant_Player::class, $agentUserId);
        } else {
            $cacheObject = $this->cacheOrNew(dbs_themeRestaurant_Player::class, $destUserId);
        }
        $data = $cacheObject->toArray();
        $data[dbs_themeRestaurant_Player::DBKey_userid] = $destUserId;
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 查看餐厅米其林经验
     * @param $destUserId
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function lookUpThemeRestaurantReputation($destUserId, $themeRestaurantId)
    {
        $data = [];
        //interface err_service_lookup_lookUpThemeRestaurantReputation
        // 从缓存获取数据

        typeCheckNumber($themeRestaurantId);

        $this->getCache($destUserId . $themeRestaurantId, __FUNCTION__);
        $destPlayer = dbs_player::newGuestPlayerWithLock($destUserId);
        logicErrorCondition($destPlayer->isRoleExists(),
            err_service_lookup_lookUpThemeRestaurantReputation::DEST_USER_NOT_FOUND,
            'DEST_USER_NOT_FOUND',
            $data);

        logicErrorCondition(dbs_themeRestaurant_Player::createWithPlayer($destPlayer)->isThemeRestaruantOpened($themeRestaurantId),
            err_service_lookup_lookUpThemeRestaurantReputation::RESTARUANT_NOT_OPEN,
            "RESTARUANT_NOT_OPEN");

        $data[constants_returnkey::RK_REPUTATION] = dbs_themeRestaurant_Player::createWithPlayer($destPlayer)->getBaseReputation($themeRestaurantId);
        $data[dbs_themeRestaurant_Info::DBKey_id] = $themeRestaurantId;
        $data[constants_returnkey::RK_LEVEL] = dbs_themeRestaurant_Player::createWithPlayer($destPlayer)->getReputationLevel($themeRestaurantId);

        $this->setCache($data);

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * @param $destUserid
     * @return Common_Util_ReturnVar
     */
    public function lookUpFriends($destUserid)
    {
        $data = [];
        //interface err_service_lookup_lookUpFriends
        // 从缓存获取数据
        $this->getCache($destUserid, __FUNCTION__);
        $destPlayer = dbs_player::newGuestPlayerWithLock($destUserid);
        logicErrorCondition($destPlayer->isRoleExists(),
            err_service_lookup_lookupfriendhelp::DEST_USER_NOT_FOUND,
            'DEST_USER_NOT_FOUND',
            $data);


        $friends = dbs_friend::createWithPlayer($destPlayer)->get_friendlist();

        foreach ($friends as $userId => $friend) {
            $lookupInfo = [];
            $lookupInfo[dbs_friend::DBKey_tablename] = $friend;
            $lookupInfo[dbs_role::DBKey_tablename] = dbs_filters_role::getVerySimpleInfo($destPlayer);
            $lookupInfo[dbs_friend_goodwill::DBKey_tablename] = dbs_friend_goodwill::getGoodWill($destUserid, $userId)->toArray();
            $data[$userId] = $lookupInfo;
        }

        $this->setCache($data);

        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 通用lookup接口,只适用于简单,单一数据单元
     * @param string $destUserId 用户名
     * @param string $ModelConstantName 数据模块常量
     * @return Common_Util_ReturnVar
     */
    public function lookUpNormalModel($destUserId, $ModelConstantName)
    {
        $data = [];
        //interface err_service_lookup_lookUpNormalModel

        typeCheckUserId($destUserId);
        typeCheckString($ModelConstantName, 30, 2);

        logicErrorCondition(isset($this->lookUpNormalModels[$ModelConstantName]),
            err_service_lookup_lookUpNormalModel::MODEL_NOT_EXISTS,
            "MODEL_NOT_EXISTS");

        $cacheObject = $this->cacheOrNew($this->lookUpNormalModels[$ModelConstantName], $destUserId);
        $data = $cacheObject->toArray();
        return Common_Util_ReturnVar::RetSucc($data);

    }


}