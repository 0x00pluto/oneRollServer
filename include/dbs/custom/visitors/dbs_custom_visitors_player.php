<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/4/6
 * Time: 下午2:26
 */

namespace dbs\custom\visitors;


use Common\Db\Common_Db_memcached;
use Common\Db\Common_Db_memcacheObject;
use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_friend;
use dbs\friend\dbs_friend_data;
use dbs\templates\custom\visitors\dbs_templates_custom_visitors_player;

/**
 * Class dbs_custom_visitors_player
 * @package dbs\custom\visitors
 */
class dbs_custom_visitors_player extends dbs_templates_custom_visitors_player
{

    public function getRecommend()
    {
        $data = [];
        //interface err_dbs_custom_visitors_player_getRecommend


        $cacheObject = Common_Db_memcacheObject::create("dbs_custom_visitors_player_getRecommend_" . $this->get_userid());
        $cacheObject->setExpiration(1 * 60);
        if ($cacheObject->has_value()) {
            $data = $cacheObject->get_value([]);
        } else {
            $data = $this->getRecommendFriends();
            $data = array_merge($data, $this->getRecommendStrangers());

            $cacheObject->set_value($data);
        }
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取推荐的好友访客
     * @return array
     */
    public function getRecommendFriends()
    {
        $data = [];
        //interface err_dbs_custom_visitors_player_getRecommendFriends

//        dump(dbs_friend::createWithPlayer($this)->get_friendlist());

        $friends = dbs_friend::createWithPlayer($this)->get_friendlist();
        foreach ($friends as $friendUserId => $friend) {
            $friendData = dbs_friend_data::create_with_array($friend);
            $visitor = dbs_custom_visitors_friendVisitor::createWithFriendData($friendData);
            $data[$visitor->get_customId()] = $visitor->toArray();
        }
        //code...
        return $data;
    }

    /**
     * 获取推荐的陌生人访客
     * @return array
     */
    public function getRecommendStrangers()
    {
        $data = [];

        $friends = dbs_friend::createWithPlayer($this)->getrecommendfriends();

        foreach ($friends->get_retdata() as $friendUserId => $friend) {
            $visitor = dbs_custom_visitors_strangerVisitor::createWithUserId($friendUserId);
            $data[$visitor->get_customId()] = $visitor->toArray();
        }
        //code...
        return $data;
    }

}