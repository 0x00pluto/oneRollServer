<?php

namespace dbs\pve\data;

use dbs\dbs_basedatacell;
use dbs\dbs_player;

/**
 * 邀请厨师数据
 *
 * @author zhipeng
 *
 */
class dbs_pve_data_invitechef extends dbs_basedatacell
{
    /**
     * 自己的厨师1
     *
     * @var string
     */
    const DBKey_selfchefid1 = "selfchefid1";

    /**
     * 获取 自己的厨师1
     */
    public function get_selfchefid1()
    {
        return $this->getdata(self::DBKey_selfchefid1);
    }

    /**
     * 设置 自己的厨师1
     *
     * @param unknown $value
     */
    public function set_selfchefid1($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_selfchefid1, $value);
    }

    /**
     * 设置 自己的厨师1 默认值
     */
    protected function _set_defaultvalue_selfchefid1()
    {
        $this->set_defaultkeyandvalue(self::DBKey_selfchefid1, '');
    }

    /**
     * 好友userid1
     *
     * @var string
     */
    const DBKey_frienduserid1 = "frienduserid1";

    /**
     * 获取 好友userid1
     */
    public function get_frienduserid1()
    {
        return $this->getdata(self::DBKey_frienduserid1);
    }

    /**
     * 设置 好友userid1
     *
     * @param unknown $value
     */
    public function set_frienduserid1($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_frienduserid1, $value);
    }

    /**
     * 设置 好友userid1 默认值
     */
    protected function _set_defaultvalue_frienduserid1()
    {
        $this->set_defaultkeyandvalue(self::DBKey_frienduserid1, '');
    }

    /**
     * 好友厨师id1
     *
     * @var string
     */
    const DBKey_friendchefid1 = "friendchefid1";

    /**
     * 获取 好友厨师id1
     */
    public function get_friendchefid1()
    {
        return $this->getdata(self::DBKey_friendchefid1);
    }

    /**
     * 设置 好友厨师id1
     *
     * @param unknown $value
     */
    public function set_friendchefid1($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_friendchefid1, $value);
    }

    /**
     * 设置 好友厨师id1 默认值
     */
    protected function _set_defaultvalue_friendchefid1()
    {
        $this->set_defaultkeyandvalue(self::DBKey_friendchefid1, '');
    }

    /**
     * 自己的厨师2
     *
     * @var string
     */
    const DBKey_selfchefid2 = "selfchefid2";

    /**
     * 获取 自己的厨师2
     */
    public function get_selfchefid2()
    {
        return $this->getdata(self::DBKey_selfchefid2);
    }

    /**
     * 设置 自己的厨师2
     *
     * @param unknown $value
     */
    public function set_selfchefid2($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_selfchefid2, $value);
    }

    /**
     * 设置 自己的厨师2 默认值
     */
    protected function _set_defaultvalue_selfchefid2()
    {
        $this->set_defaultkeyandvalue(self::DBKey_selfchefid2, '');
    }

    /**
     * 好友userid2
     *
     * @var string
     */
    const DBKey_frienduserid2 = "frienduserid2";

    /**
     * 获取 好友userid2
     */
    public function get_frienduserid2()
    {
        return $this->getdata(self::DBKey_frienduserid2);
    }

    /**
     * 设置 好友userid2
     *
     * @param unknown $value
     */
    public function set_frienduserid2($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_frienduserid2, $value);
    }

    /**
     * 设置 好友userid2 默认值
     */
    protected function _set_defaultvalue_frienduserid2()
    {
        $this->set_defaultkeyandvalue(self::DBKey_frienduserid2, '');
    }

    /**
     * 好友厨师id2
     *
     * @var string
     */
    const DBKey_friendchefid2 = "friendchefid2";

    /**
     * 获取 好友厨师id2
     */
    public function get_friendchefid2()
    {
        return $this->getdata(self::DBKey_friendchefid2);
    }

    /**
     * 设置 好友厨师id2
     *
     * @param unknown $value
     */
    public function set_friendchefid2($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_friendchefid2, $value);
    }

    /**
     * 设置 好友厨师id2 默认值
     */
    protected function _set_defaultvalue_friendchefid2()
    {
        $this->set_defaultkeyandvalue(self::DBKey_friendchefid2, '');
    }

    function __construct()
    {
        parent::__construct([]);
    }

    /**
     * 获取第一位助战好友的战斗力
     *
     * @param dbs_player $player
     * @return number
     */
    public function get_battlepower1(dbs_player $player)
    {
        return $this->get_battlepower($player, 1);
    }

    /**
     * 获取第一位助战好友的战斗力
     *
     * @param dbs_player $player
     * @return number
     */
    public function get_battlepower2(dbs_player $player)
    {
        return $this->get_battlepower($player, 2);
    }

    /**
     *
     * @param dbs_player $player
     * @param string $index
     * @return number
     */
    private function get_battlepower(dbs_player $player, $index)
    {
        return 0;
//        $get_selfchefid = 'get_selfchefid' . $index;
//        $get_frienduserid = 'get_frienduserid' . $index;
//        $get_friendchefid = 'get_friendchefid' . $index;
//
//        if (empty ($this->$get_selfchefid ()) || empty ($this->$get_frienduserid ()) || empty ($this->$get_friendchefid ())) {
//            return 0;
//        }
//        $chefdata = $player->dbs_chef_list()->get_chef($this->$get_selfchefid ());
//        if (is_null($chefdata)) {
//            return 0;
//        }
//
//        $goodwilllist = $chefdata->get_goodwilllist();
//        if (!isset ($goodwilllist [$this->$get_frienduserid ()])) {
//            return 0;
//        }
//
//        $destplayer = dbs_player::newGuestPlayer($this->$get_frienduserid ());
//        if (!$destplayer->isRoleExists()) {
//            return 0;
//        }
//
//        $destchef = $destplayer->dbs_chef_list()->get_chef($this->$get_friendchefid ());
//        if (is_null($destchef)) {
//            return 0;
//        }
//        $destchef->computeability();
//        $goodwilldata = $chefdata->get_goodwilldata($this->$get_frienduserid ());
//
//        $battlepower = $destchef->get_battlepower();
//        $add_key = "PVE_INVITE_FRIEND_ADD_BATTLEPOWER_PERCENT_STAR_" . $goodwilldata->get_goodwilllevel();
//        $add_percent = Common_Util_Configdata::getInstance()->get_global_config_value($add_key)->float_value() / 10000;
//        $battlepower = floor($battlepower * $add_percent);
//
//        return $battlepower;
    }
}