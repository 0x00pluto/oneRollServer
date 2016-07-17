<?php

namespace dbs\neighbourhood;

use Common\Util\Common_Util_Guid;
use configdata\configdata_item_neighboorhood_gift_package_setting;
use dbs\templates\neighbourhood\dbs_templates_neighbourhood_groupgiftpackagedata;

/**
 * 红包本身数据
 *
 * @author zhipeng
 *
 */
class dbs_neighbourhood_groupgiftpackagedata extends dbs_templates_neighbourhood_groupgiftpackagedata
{


    /**
     * 生成红包数据
     * @param string $itemid 红包到道具id
     * @param string $senduserid 发红包的人的id
     * @return dbs_neighbourhood_groupgiftpackagedata|null
     */
    public static function create_giftpackage($itemid, $senduserid)
    {
        $itemid = strval($itemid);
        $senduserid = strval($senduserid);

        $data = new self ();
        $data->set_owneruserid($senduserid);
        $data->set_guid(Common_Util_Guid::gen_neighboorhoodgiftpackageid());
        $data->set_gitfitemid($itemid);

        $config = dbs_neighbourhood_playerdatagiftpackage::get_giftconfig($itemid);
        if (is_null($config)) {
            return null;
        }

        $gamecoin = intval($config [configdata_item_neighboorhood_gift_package_setting::k_sellgamecoin]);
        $diamonds = intval($config [configdata_item_neighboorhood_gift_package_setting::k_selldiamond]);
        $recvmaxtime = intval($config [configdata_item_neighboorhood_gift_package_setting::k_recvtimes]);

        $data->set_eachdiamond($diamonds / $recvmaxtime);
        $data->set_eachgamecoin($gamecoin / $recvmaxtime);
        $data->set_recvmaxtimes($recvmaxtime);

        $duringtime = intval($config [configdata_item_neighboorhood_gift_package_setting::k_duringtime]);
        $data->set_expiretime(time() + $duringtime);

        return $data;
    }

    /**
     * 是否过期
     *
     * @return boolean
     */
    public function is_expired()
    {
        return time() > $this->get_expiretime();
    }

    /**
     * 是否到达了接受上限
     *
     * @return boolean
     */
    public function is_recvtimes_max()
    {
        return $this->get_recvtimes() >= $this->get_recvmaxtimes();
    }

    /**
     * 是否已经领取了这个红包
     *
     * @param string $userid
     *            要领取红包人的id
     * @return boolean
     */
    public function is_already_recv($userid)
    {
        $recvlist = $this->get_recvuserlist();
        return array_key_exists_faster($userid, $recvlist);
    }

    /**
     * 领取红包
     *
     * @param string $userid
     */
    public function recvpackage($userid)
    {
        $userid = strval($userid);
        // 增加到领取列表中
        $recvlist = $this->get_recvuserlist();
        $recvlist [$userid] = 0;
        $this->set_recvuserlist($recvlist);

        // 次数增加
        $recvtimes = $this->get_recvtimes() + 1;
        $this->set_recvtimes($recvtimes);
    }

    /**
     * 设置感谢操作
     *
     * @param string $userid
     */
    public function thanks($userid)
    {
        // 增加到领取列表中
        $recvlist = $this->get_recvuserlist();
        if (array_key_exists_faster($userid, $recvlist)) {
            $recvlist [$userid] = 1;
            $this->set_recvuserlist($recvlist);
        }
    }
}