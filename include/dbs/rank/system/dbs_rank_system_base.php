<?php

namespace dbs\rank\system;

use Common\Util\Common_Util_LockMemcache;
use Common\Util\Common_Util_LockInterface;
use constants\constants_memcachekey;
use Common\Db\Common_Db_memcached;
use Common\Util\Common_Util_Time;
use dbs\dbs_player;

/**
 * 全局排行基类
 *
 * @author zhipeng
 *
 */
abstract class dbs_rank_system_base
{
    /**
     * 排行类型
     *
     * @var int
     */
    protected $rank_type;
    /**
     * 排行数量
     *
     * @var int
     */
    protected $rank_count = 500;
    /**
     *
     * @var Common_Util_LockInterface
     */
    private $_lock;

    function __construct($rank_type)
    {
        $this->rank_type = $rank_type;
        $this->_lock = Common_Util_LockMemcache::newlock("lock_" . $this->rank_type);
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
     * 获取排行数量
     *
     * @return number
     */
    protected function get_rank_count()
    {
        return $this->rank_count + 100;
    }

    /**
     * 排行关键字
     */
    protected function get_rank_key()
    {
        return constants_memcachekey::DBKey_Rank . $this->get_rank_type();
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
        if ($this->_is_needresortall() || !$ranklist) {

            $ranklist = $this->sortall();
            $this->set_ranklist($ranklist);
            $this->_clear_resortall_flag();
        }
        return $ranklist;
    }

    private function _sortall_key()
    {
        return constants_memcachekey::DBKey_Rank_Need_Update . $this->get_rank_type();
    }

    /**
     * 是否需要重新排列
     *
     * @return boolean
     */
    private function _is_needresortall()
    {
        $key = $this->_sortall_key();
        $memcache = Common_Db_memcached::getInstance();
        $days = $memcache->get($key);

        if (!$days) {
            return true;
        }
        if ($days != Common_Util_Time::getGameDay()) {
            return true;
        }
        return FALSE;
    }

    /**
     * 清除重新排列标志位
     */
    private function _clear_resortall_flag()
    {
        $key = $this->_sortall_key();
        $memcache = Common_Db_memcached::getInstance();
        $memcache->set($key, Common_Util_Time::getGameDay());
    }

    /**
     * 标记需要重新排列所有
     */
    public function mark_need_sortall()
    {
        $key = $this->_sortall_key();
        $memcache = Common_Db_memcached::getInstance();
        $memcache->delete($key);
    }

    /**
     * 设置排行数据
     */
    protected function set_ranklist($ranklist)
    {
        $memcache = Common_Db_memcached::getInstance();
        $memcache->set($this->get_rank_key(), $ranklist);
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
     * @return array:multitype:
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
            $rankvalue = isset ($value [$key_rankvalue]) ? $value [$key_rankvalue] : 0;
            $rankdata = $this->create_rankdata($rankplayer, $rankvalue);
            $rank [] = $rankdata->toArray();
        }
        return $rank;
    }

    /**
     * 排行数值改变
     *
     * @param dbs_player $player
     * @param int $rankvalue
     */
    public function rank_valuechange($player, $rankvalue)
    {
        if (is_null($player)) {
            return;
        } else {
            return;
        }

        $userid = $player->get_userid();
        $rankdata = $this->get_rank_by_userid($userid);
        $ranklist = $this->get_ranklist();

        // $rankvalue = $player->db_restaurantinfo ()->get_restaurantlevel ();

        if (is_null($rankdata)) {
            // 没有上榜

            // 创建排行数据
            $rankdata = $this->create_rankdata($player, $rankvalue);

            $lastrankdata = $this->get_rank_last();

            if (is_null($lastrankdata)) {
                // 没有最后一名 ,不太可能吧
                $this->insert_rankdata($rankdata);
            } else {
                if (count($ranklist) < $this->get_rank_count()) {
                    // 还有空位置
                    $this->insert_rankdata($rankdata);
                } elseif ($rankvalue > $lastrankdata->get_rankvalue()) {
                    // 新上榜
                    $this->insert_rankdata($rankdata);
                    // 删除最后一名
                    $this->remove_rank_last();
                }
            }
        } else {
            if ($rankdata->get_rankvalue() != $rankvalue) {
                // $rankdata->set_rankvalue ( $rankvalue );
                $rankdata = $this->create_rankdata($player, $rankvalue);

                // 已经在榜上了
                // 先删除
                $this->remove_rank_by_userid($userid);
                // 再更新
                $this->insert_rankdata($rankdata);
            }
        }
    }

    /**
     * 获取上榜最后一名的数据
     *
     * @return NULL|dbs_rank_system_database
     */
    protected function get_rank_last()
    {
        $ranks = $this->get_ranklist();
        $rankdataarr = array_pop($ranks);
        if (is_null($rankdataarr)) {
            return null;
        }
        $rankdata = new dbs_rank_system_database ();
        $rankdata->fromArray($rankdataarr);
        return $rankdata;
    }

    /**
     * 删除最后一名
     */
    protected function remove_rank_last()
    {
        $ranks = $this->get_ranklist();
        array_pop($ranks);
        $this->set_ranklist($ranks);
    }

    /**
     * 获取排名用户数据
     *
     * @param string $userid
     * @return dbs_rank_system_database|NULL
     */
    protected function get_rank_by_userid($userid)
    {
        $userid = strval($userid);
        $ranks = $this->get_ranklist();
        foreach ($ranks as $value) {
            if ($value [dbs_rank_system_database::DBKey_userid] === $userid) {
                $data = new dbs_rank_system_database ();
                $data->fromArray($value);
                return $data;
            }
        }
        return null;
    }

    /**
     * 通过userid删除排行数据
     *
     * @param unknown $userid
     */
    protected function remove_rank_by_userid($userid)
    {
        $userid = strval($userid);
        $ranks = $this->get_ranklist();
        foreach ($ranks as $i => $value) {
            if ($value [dbs_rank_system_database::DBKey_userid] === $userid) {
                // unset ( $ranks [$i] );
                $rank = array_splice($ranks, $i, 1);
                // dump ( $i );
                break;
            }
        }

        $this->set_ranklist($ranks);
    }

    /**
     * 插入排行数据
     *
     * @param dbs_rank_system_database $rankdata
     */
    protected function insert_rankdata(dbs_rank_system_database $rankdata)
    {
        $ranks = $this->get_ranklist();
        $finalranks = array();
        // 是否已经找到了位置
        $isinsert = false;
        foreach ($ranks as $i => $value) {
            if ($rankdata->get_rankvalue() > $value [dbs_rank_system_database::DBKey_rankvalue]) {
                $frontarray = array_slice($ranks, 0, $i);
                $frontarray [] = $rankdata->toArray();

                $backarray = array_slice($ranks, $i);
                $finalranks = array_merge($frontarray, $backarray);
                $isinsert = true;

                break;
            }
        }
        if (!$isinsert) {
            $finalranks = $ranks;
            $finalranks [] = $rankdata->toArray();
        }
        $this->set_ranklist($finalranks);
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