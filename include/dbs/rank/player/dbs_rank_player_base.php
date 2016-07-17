<?php

namespace dbs\rank\player;

use constants\constants_memcachekey;
use Common\Db\Common_Db_memcached;
use dbs\dbs_player;
use dbs\rank\system\dbs_rank_system_database;

abstract class dbs_rank_player_base
{
    /**
     * 排行类型
     *
     * @var int
     */
    protected $rank_type;
    protected $userid;

    function __construct($rank_type, $userid)
    {
        $this->rank_type = $rank_type;
        $this->userid = $userid;
    }

    /**
     * 获取排行类型
     *
     * @return number
     */
    protected function get_rank_type()
    {
        return $this->rank_type;
    }

    /**
     * 排行关键字
     */
    protected function get_rank_key()
    {
        return constants_memcachekey::DBKey_Rank . $this->get_rank_type() . $this->userid;
    }

    /**
     * 获取排行
     *
     * @return boolean|array
     */
    public function get_ranklist()
    {
        $memcache = Common_Db_memcached::getInstance();
        $ranklist = $memcache->get($this->get_rank_key());
        if (!$ranklist) {

            $ranklist = $this->sortall();
            $this->set_ranklist($ranklist);
        }
        return $ranklist;
    }

    /**
     * 设置排行数据
     */
    protected function set_ranklist($ranklist)
    {
        $memcache = Common_Db_memcached::getInstance();
        $memcache->set($this->get_rank_key(), $ranklist, 60);
    }

    /**
     * 获取好友的ids
     */
    protected function get_frienduserids()
    {
        $dbplayer = dbs_player::newGuestPlayer($this->userid);
        $friends = $dbplayer->db_friend()->get_friendlist();
        $friendids = array_keys($friends);
        $friendids [] = $this->userid;
        return $friendids;
    }

    /**
     * 重新排列所有数据
     *
     * @return array 所有排序后的数据
     */
    abstract protected function sortall();

    /**
     * 生成排序数组
     *
     * @param array $arr
     *            原始数组
     * @param string $key_userid
     *            用户id的key
     * @param string $key_rankvalue
     *            排序的key
     * @return multitype:multitype:
     */
    protected function _sortallarray($arr, $key_userid, $key_rankvalue)
    {
        $rank = array();
        $valuecount = count($arr);
        for ($i = 0; $i < $valuecount; $i++) {

            $value = $arr [$i];
            $userid = $value [$key_userid];
            $rankplayer = dbs_player::newGuestPlayer($userid);
            if (!$rankplayer->isRoleExists()) {
                continue;
            }
            $rankdata = $this->create_rankdata($rankplayer, $value [$key_rankvalue]);
            $rank [] = $rankdata->toArray();
        }
        return $rank;
    }

    /**
     * 创建排行数据
     *
     * @param dbs_player $player
     * @param unknown $rankvalue
     * @return dbs_rank_system_database
     */
    abstract protected function create_rankdata(dbs_player $player, $rankvalue);
}