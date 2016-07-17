<?php

namespace service;

use Common\Db\Common_Db_pools;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_returnkey;
use dbs\dbs_player;
use dbs\dbs_warehouse;
use dbs\neighbourhood\dbs_neighbourhood_groupmanager;
use dbs\thirdparty\dbs_thirdparty_userinfo;

/**
 * GM类
 *
 * @author zhipeng
 *
 */
class service_admin extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'additemtowarehouse',
            'adddiamondandgamecoin',
            'addrestaurantexpandreputationexp',
            'addvipexp',
            'killuser',
            'fresh_join_group',
            'push',
            'adduseridtocache'
        ), true);

        $this->exportForLuaCode = false;
    }

    /**
     * 直接添加道具到仓库
     *
     * @param 道具id $itemid
     * @param 数量 $num
     * @return 数组
     */
    function additemtowarehouse($itemid, $num)
    {
        $itemid = strval($itemid);
        $num = intval($num);

        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code

        $warehouse = dbs_warehouse::getwarehousebyitemid($this->callerUserInstance, $itemid);

        if (is_null($warehouse) || !$warehouse->addItemByItemId($itemid, $num, true)) {
            $retCode = 1;
            goto failed;
        }

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * 增加钻石和游戏币
     *
     * @param number $diamond
     * @param number $gamecoin
     * @return 数组
     */
    function adddiamondandgamecoin($diamond, $gamecoin)
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        // code
        $diamond = intval($diamond);
        $gamecoin = intval($gamecoin);

        $this->callerUserInstance->db_role()->add_gamecoin($gamecoin, 1);
        $this->callerUserInstance->db_role()->add_diamond($diamond);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * 增加餐台经验和美誉度经验
     *
     * @param 餐厅经验 $exp1
     * @param 美誉度经验 $exp2
     * @return 数组
     */
    function addrestaurantexpandreputationexp($exp1, $exp2)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // $retCodeArr = array();
        // code

        $returnCode = $this->callerUserInstance->db_restaurantinfo()->addrestaurantexp($exp1);
//        dump($returnCode);
//        dump($this->callerUserInstance->db_restaurantinfo());

//        $this->callerUserInstance->db_restaurantinfo()->dumpDB();
        // $this->callerUserInstance->db_restaurantinfo ()->addreputationexp ( $exp2 );

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 删除用户
     *
     * @param string $userid
     * @return Common_Util_ReturnVar
     */
    function killuser($userid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_admin_killuser{}

        // code
        $data = Common_Db_pools::default_Db_pools()->dbconnect()->delete('accountthirdparty', array(
            dbs_thirdparty_userinfo::DBKey_link_userid => $userid
        ));

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 刷新有空位置的群组
     *
     * @param string $adminname
     *            目前不校验
     * @param string $adminpassword
     *            目前不校验
     * @return Common_Util_ReturnVar
     */
    function fresh_join_group($adminname, $adminpassword)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_admin_fresh_join_group{}

        $data = dbs_neighbourhood_groupmanager::getInstance()->fresh_empty_group_to_join_group();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 增加vip校验
     *
     * @param unknown $exp
     * @return Common_Util_ReturnVar
     */
    function addvipexp($destuserid, $exp)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_admin_addvipexp{}

        $destplayer = dbs_player::newGuestPlayerWithLock($destuserid);
        if (!$destplayer->isRoleExists()) {
            goto failed;
        }
        $destplayer->dbs_vip()->addvipexp($exp);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 发送push
     *
     * @param unknown $adminname
     * @param unknown $adminpassword
     * @param unknown $destuserid
     * @return Common_Util_ReturnVar
     */
    function push($adminname, $adminpassword, $destuserid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_admin_push{}

        $destplayer = dbs_player::newGuestPlayerWithLock($destuserid);
        if (!$destplayer->isRoleExists()) {
            goto failed;
        }

        $destplayer->dbs_pushplayer()->sendpush("测试一下子", "木子强牛");

        // $pushservice = dbs_push_service::getInstance ()->get_iphone ();
        // $pushservice->sendUnicast ( "db26e40453009a8c993eb1f6556fd7cd2eccf4f029bf09f627947d3d1f1acde4", "测试一下子", "木子强牛" );

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 直接添加useridto缓存
     *
     * @param unknown $userid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function adduseridtocache($userid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_admin_adduseridtocache{}

        $userid = strval($userid);
        $verify = dbs_player::addUseridToCache($userid);

        $data [constants_returnkey::RK_USERID] = $userid;
        $data [constants_returnkey::RK_VERIFY] = $verify;
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}