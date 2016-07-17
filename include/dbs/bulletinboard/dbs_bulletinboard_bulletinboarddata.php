<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/17
 * Time: 下午5:30
 */

namespace dbs\bulletinboard;


use Common\Util\Common_Util_Guid;
use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\templates\dbs_templates_bulletinboarddata;

/**
 * 公告数据
 * Class dbs_bulletinboard_bulletinboarddata
 * @package dbs\bulletinboard
 */
class dbs_bulletinboard_bulletinboarddata extends dbs_templates_bulletinboarddata
{
    /**
     * 是否过期了
     * @return bool
     */
    public function expired()
    {
        return time() > $this->get_expiredTime();
    }

    /**
     * 通过玩家创建
     * @param $title
     * @param $content
     * @param dbs_player $player
     * @return dbs_bulletinboard_bulletinboarddata
     */
    static function createWithPlayer($title, $content, dbs_player $player)
    {
        $ins = new self();
        $ins->set_guid(Common_Util_Guid::gen_bulletin_id());
        $ins->set_title($title);
        $ins->set_content($content);
        $ins->set_sendTime(time());
        $ins->set_fromUserId($player->get_userid());
        $ins->set_fromUserInfo(dbs_filters_role::getNormalInfo($player->db_role()));

        return $ins;
    }
}