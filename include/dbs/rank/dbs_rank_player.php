<?php

namespace dbs\rank;

use dbs\dbs_baseplayer;
use dbs\rank\system\dbs_rank_system_restaurantlevel;
use Common\Util\Common_Util_ReturnVar;
use dbs\rank\system\dbs_rank_system_restaurantreputation;
use dbs\rank\system\dbs_rank_system_addgamecoins;
use dbs\rank\system\dbs_rank_system_diamonds;
use dbs\rank\system\dbs_rank_system_neighboorhoodreputation;
use dbs\rank\player\dbs_rank_player_diamonds;
use dbs\rank\player\dbs_rank_player_addgamecoins;
use dbs\rank\player\dbs_rank_player_restaurantlevel;
use dbs\rank\player\dbs_rank_player_restaurantreputation;

/**
 * 排行榜
 * 2015年5月14日 上午11:26:26
 *
 * @author zhipeng
 *
 */
class dbs_rank_player extends dbs_baseplayer
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "rank_player";

    function __construct()
    {
        parent::__construct(self::DBKey_tablename);
    }

    /**
     * 获取餐厅等级排行
     *
     * @return Common_Util_ReturnVar
     */
    function getrestaurantrank()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_rank_player_getrestaurantrank{}

        $rank = dbs_rank_system_restaurantlevel::getInstance();
        // $rank->mark_need_sortall ();
        $rank->rank_valuechange($this->db_owner, $this->db_owner->db_restaurantinfo()->get_restaurantlevel());
        // code
        $data = $rank->get_ranklist();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取美誉度排行
     *
     * @return Common_Util_ReturnVar
     */
    function getrestaurantreputationrank()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_rank_player_getrestaurantreputationrank{}

        $rank = dbs_rank_system_restaurantreputation::getInstance();
        $rank->rank_valuechange($this->db_owner, $this->db_owner->db_restaurantinfo()->get_restauranttotalexp());

        $data = $rank->get_ranklist();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取收入排行
     *
     * @return Common_Util_ReturnVar
     */
    function getaddgamecoinrank()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_rank_player_getaddgamecoinrank{}
        $rank = dbs_rank_system_addgamecoins::getInstance();
        $rank->rank_valuechange($this->db_owner, $this->db_owner->db_role()->get_addgamecoins());

        $data = $rank->get_ranklist();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取钻石排行
     *
     * @return Common_Util_ReturnVar
     */
    function getdiamondsrank()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_rank_player_getdiamondsrank{}

        // code
        $rank = dbs_rank_system_diamonds::getInstance();
        $rank->rank_valuechange($this->db_owner, $this->db_owner->db_role()->get_diamond());

        $data = $rank->get_ranklist();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取社区声望排行
     *
     * @return Common_Util_ReturnVar
     */
    function getneighboorhoodreputationrank()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_rank_player_getneighboorhoodreputationrank{}

        $rank = dbs_rank_system_neighboorhoodreputation::getInstance();
        // $rank->rank_valuechange ( $this->db_owner, $this->db_owner->db_role ()->get_diamond () );

        $data = $rank->get_ranklist();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取好友钻石排行
     *
     * @return Common_Util_ReturnVar
     */
    function getfrienddiamondsrank()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_rank_player_getdiamondsrank{}

        $rank = new dbs_rank_player_diamonds ($this->get_userid());

        $data = $rank->get_ranklist();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取好友收入排行
     *
     * @return Common_Util_ReturnVar
     */
    function getfriendaddgamecoinrank()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $rank = new dbs_rank_player_addgamecoins ($this->get_userid());

        $data = $rank->get_ranklist();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取好友餐厅等级排行
     *
     * @return Common_Util_ReturnVar
     */
    function getfriendrestaurantrank()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_rank_player_getrestaurantrank{}

        $rank = new dbs_rank_player_restaurantlevel ($this->get_userid());
        // code
        $data = $rank->get_ranklist();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取好友美誉度排行
     *
     * @return Common_Util_ReturnVar
     */
    function getfriendrestaurantreputationrank()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_rank_player_getrestaurantreputationrank{}

        $rank = new dbs_rank_player_restaurantreputation ($this->get_userid());

        $data = $rank->get_ranklist();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}