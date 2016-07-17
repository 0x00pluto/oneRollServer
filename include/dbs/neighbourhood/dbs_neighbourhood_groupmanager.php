<?php

namespace dbs\neighbourhood;

use Common\Db\Common_Db_pools;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_globalkey;
use dbs\dbs_player;
use dbs\managers\dbs_managers_globalkvstore;
use err\err_dbs_neighbourhood_groupmanager_exitneighboorhood;

/**
 * 邻居管理器
 *
 * @author zhipeng
 *
 */
class dbs_neighbourhood_groupmanager
{
    /**
     * singleton
     */
    private static $_instance;

    function __construct()
    {
        // echo 'This is a Constructed method;';
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof static)) {
            self::$_instance = new static ();
        }
        return self::$_instance;
    }

    /**
     * 退出群组
     *
     * @param dbs_player $player
     * @return Common_Util_ReturnVar
     */
    function exitneighboorhood(dbs_player $player)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_neighbourhood_groupmanager_exitneighboorhood{}

        // $player->dbs_neighbourhood_playerdata ()->dumpDB ();

        if (!$player->dbs_neighbourhood_playerdata()->hasgroup()) {
            $retCode = err_dbs_neighbourhood_groupmanager_exitneighboorhood::PLAYER_NOT_IN_GROUP;
            $retCode_Str = 'PLAYER_NOT_IN_GROUP';
            goto failed;
        }

        $groupid = $player->dbs_neighbourhood_playerdata()->get_groupid();
        $groupdata = $this->get_groupbyid($groupid);
        if (is_null($groupdata)) {
            $retCode = err_dbs_neighbourhood_groupmanager_exitneighboorhood::GROUP_NOT_EXISTS;
            $retCode_Str = 'GROUP_NOT_EXISTS';
            goto failed;
        }

        return $groupdata->knockout($player);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 刷新所有有空位置的组到加入队列中,手动调用
     */
    public function fresh_empty_group_to_join_group()
    {
        $dbret = Common_Db_pools::default_Db_pools()->dbconnect()->query(dbs_neighbourhood_groupdata::DBKey_tablename, [], []);

        // dump ( $dbret );
        // foreach ( $dbret as $value ) {
        // $groupdata = $this->get_groupbyid ( $value [dbs_neighbourhood_groupdata::DBKey_guid] );
        // dump ( $groupdata->toArray () );
        // }
        // return;

        dbs_managers_globalkvstore::removestorekey(constants_globalkey::KEY_NEIGHBOURHOOD_JOINLIST);
        $groupdata = new dbs_neighbourhood_groupdata ();
        foreach ($dbret as $value) {
            $groupdata->fromArray($value);
            if (!$groupdata->isFull()) {
                $this->addJoinGroup($groupdata);
            }
        }

        $data = dbs_managers_globalkvstore::getvalue(constants_globalkey::KEY_NEIGHBOURHOOD_JOINLIST);

        return $data;
    }

    /**
     * 加入默认群组
     *
     * @param dbs_player $player
     */
    public function autojoinneighboorhood(dbs_player $player)
    {
        $levelmin = Common_Util_Configdata::getInstance()->get_global_config_value('NEIGHBOORHOOD_JOIN_MIN_RESTAURANT_LEVEL')->int_value();
        if ($player->db_restaurantinfo()->get_restaurantlevel() < $levelmin) {
            return false;
        }
        if ($player->dbs_neighbourhood_playerdata()->hasgroup()) {
            return false;
        }

        // dump ( "join" );
        $groupids = $this->getjoingroupids();
        $groupdata = null;
        $ret = null;
        $joinGroupId = 0;
        foreach ($groupids as $groupid) {
            $groupdata = $this->get_groupbyid($groupid, true);
            $ret = $groupdata->join($player);
            // 加入成功
            if ($ret->is_succ()) {
                $joinGroupId = $groupid;
                break;
            }
        }
        // dump ( $groupids );
        // dump ( $ret );
        if (is_null($ret) || $ret->is_failed()) {
            $groupdata = $this->creategroup();
            $ret = $groupdata->join($player);
        }

        if ($ret->is_succ() && $groupdata->isFull()) {
            $this->removeJoinGroup($joinGroupId);
        }

        return $ret;
    }

    /**
     * 获取自动加入的群组id
     *
     * @return multitype:NULL
     */
    private function getjoingroupids()
    {
        $joinlist = dbs_managers_globalkvstore::getvalue(constants_globalkey::KEY_NEIGHBOURHOOD_JOINLIST, array());

        $grouplist = [];
        if (count($joinlist) > 0) {
            foreach ($joinlist as $value) {
                $joindata = new dbs_neighbourhood_joinlistdata ();
                $joindata->fromArray($value);
                $grouplist [] = $joindata->get_groupid();
            }
        } else {
            $groupdata = $this->creategroup();
            $grouplist [] = $groupdata->get_guid();
        }

        return $grouplist;
    }

    /**
     * 删除等待加入的队列
     *
     * @param unknown $groupid
     */
    private function removeJoinGroup($groupid)
    {
        $groupid = strval($groupid);
        $joinlist = dbs_managers_globalkvstore::getvalue(constants_globalkey::KEY_NEIGHBOURHOOD_JOINLIST, array());
        unset ($joinlist [$groupid]);
        dbs_managers_globalkvstore::setvalue(constants_globalkey::KEY_NEIGHBOURHOOD_JOINLIST, $joinlist);
    }

    /**
     * 添加到自动加入的群组
     *
     * @param dbs_neighbourhood_groupdata $data
     */
    private function addJoinGroup(dbs_neighbourhood_groupdata $data)
    {
        $joinlist = dbs_managers_globalkvstore::getvalue(constants_globalkey::KEY_NEIGHBOURHOOD_JOINLIST, array());

        $joindata = new dbs_neighbourhood_joinlistdata ();
        $joindata->set_groupid($data->get_guid());
        $joinlist [$joindata->get_groupid()] = $joindata->toArray();
        dbs_managers_globalkvstore::setvalue(constants_globalkey::KEY_NEIGHBOURHOOD_JOINLIST, $joinlist);
    }

    /**
     * 创建群组
     *
     * @return dbs_neighbourhood_groupdata
     */
    private function creategroup()
    {
        $groupdata = new dbs_neighbourhood_groupdata ();
        $groupdata->set_autoguid();
        $groupdata->saveToDB();

        $this->addJoinGroup($groupdata);
        return $groupdata;
    }

    private $groupdata_cache = array();


    /**
     * 获取群组信息
     * @param $groupid
     * @param bool|false $autocreate
     * @return null|dbs_neighbourhood_groupdata
     */
    public function get_groupbyid($groupid, $autocreate = false)
    {
        $groupid = strval($groupid);
        if (array_key_exists_faster($groupid, $this->groupdata_cache)) {
            return $this->groupdata_cache [$groupid];
        }
        $groupData = dbs_neighbourhood_groupdata::findOrNew(
            [dbs_neighbourhood_groupdata::DBKey_guid => $groupid]
        );


        if ($autocreate || $groupData->exist()) {
            $this->groupdata_cache [$groupid] = $groupData;
            return $groupData;
        }
        return null;
    }
}