<?php

namespace dbs;

use Common\Db\Common_Db_pools;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Log;
use Common\Util\Common_Util_ReturnVar;
use Common\Util\Common_Util_String;
use Common\Util\Common_Util_Time;
use configdata\configdata_robot_headicon_album_setting;
use constants\constants_mission;
use constants\constants_time;
use dbs\chef\dbs_chef_list;
use dbs\chef\jobs\dbs_chef_jobs_player;
use dbs\custom\eatDishes\dbs_custom_eatDishes_player;
use dbs\neighbourhood\dbs_neighbourhood_groupdata;
use dbs\rank\system\dbs_rank_system_addgamecoins;
use dbs\rank\system\dbs_rank_system_diamonds;
use dbs\robot\dbs_robot_data;
use dbs\robot\dbs_robot_logicTrait;
use dbs\robot\dbs_robot_player;
use dbs\templates\dbs_templates_role;
use err\err_dbs_role_changerolename;
use err\err_dbs_role_createrole;
use err\err_dbs_role_getuseridbyrolename;
use hellaEngine\exception\exception_logicError;
use utils\utils_log;

/**
 * Class dbs_role
 * @package dbs
 */
class dbs_role extends dbs_templates_role
{


    /**
     * 设置历史增加游戏币数量
     *
     * @param int $addgamecoins
     * @return $this
     */
    public function set_addgamecoins($addgamecoins)
    {

        dbs_rank_system_addgamecoins::getInstance()->rank_valuechange($this->db_owner, $addgamecoins);
        return parent::set_addgamecoins($addgamecoins);
    }

    /**
     * 获取vip等级
     */
    public function get_viplevel()
    {
        return $this->db_owner->dbs_vip()->get_viplevel();
    }


    /**
     * 设置性别
     *
     * @param int $value
     * @return $this
     */
    public function set_sex($value)
    {
        $value = intval($value);
        if ($value != 0 && $value != 1) {
            return $this;
        }
        return parent::set_sex($value);
    }


    /**
     * 设置生日
     *
     * @param string $birthday
     * @return $this
     */
    public function set_birthday($birthday)
    {
        $birthday = strval($birthday);
        if (mb_strlen($birthday) > 20) {
            $birthday = mb_substr($birthday, 0, 20);
        }
        return parent::set_birthday($birthday);
    }


    /**
     * 设置地址
     *
     * @param string $address
     * @return $this
     */
    public function set_address($address)
    {
        $address = strval($address);
        $length = Common_Util_Configdata::getInstance()->get_global_config_value('MAX_ROLE_HOMETOWN_WORDS')->int_value();
        $address = mb_substr($address, 0, $length);
        return parent::set_address($address);
    }


    /**
     * 设置签名
     *
     * @param string $sign
     * @return $this
     */
    public function set_sign($sign)
    {
        $sign = strval($sign);
        $length = Common_Util_Configdata::getInstance()->get_global_config_value('MAX_ROLE_SIGN_WORDS')->int_value();
        $sign = mb_substr($sign, 0, $length);
        return parent::set_sign($sign);
    }

    /**
     * @inheritDoc
     */
    public function set_interests($value)
    {
        $value = strval($value);
        $length = Common_Util_Configdata::getInstance()->get_global_config_value('MAX_ROLE_INTERESTS_WORDS')->int_value();
        $value = mb_substr($value, 0, $length);
        return parent::set_interests($value);
    }


    private $_age = -1;

    /**
     * 获取年龄
     */
    public function get_age()
    {
        if ($this->_age == -1) {
            $this->_age = Common_Util_Time::getage($this->get_birthday());
        }
        return $this->_age;
    }

    /**
     * 获取ageid
     *
     */
    public function get_ageid()
    {
        return dbs_neighbourhood_groupdata::get_ageid_by_age($this->get_age());
    }


    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);

        $this->setEnableCache(true);
    }


    /**
     * 通过rolename获得userid
     *
     * @param string $roleName
     * @return Common_Util_ReturnVar
     */
    static function getUseridByRoleName($roleName)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $roleName = strval($roleName);
        if (empty ($roleName)) {
            $retCode = err_dbs_role_getuseridbyrolename::ROLENAME_ERR;
            $retCode_Str = 'ROLENAME_ERR';
            goto failed;
        }

        $ret = Common_Db_pools::default_Db_pools()->dbconnect()->query(self::DBKey_tablename, [
            self::DBKey_rolename => $roleName
        ]);

        if (count($ret) != 1) {
            $retCode = err_dbs_role_getuseridbyrolename::NOT_FOUND_ROLENAME;
            $retCode_Str = 'NOT_FOUND_ROLENAME';
            goto failed;
        }

        $data = $ret [0];
        unset ($data [self::DBKey_dbid]);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 昵称是否有效
     * @param $roleName
     * @return bool
     */
    public static function rolename_is_vaild($roleName)
    {
        $nameOldLength = Common_Util_String::utf8_strlen($roleName);
        $roleName = Common_Util_String::trimAll($roleName);

        if (empty ($roleName)) {
            return false;
        }
        $length = Common_Util_Configdata::getInstance()->get_global_config_value('ROLE_NAME_MAX_LENGTH')->int_value();
        $nameLength = Common_Util_String::utf8_strlen($roleName);

        if ($nameOldLength != $nameLength
            || $nameLength > $length
            || $nameLength < 2
        ) {
            //名字中有空格
            //名字大于最大长度
            //名字小于最小长度
            return false;
        }

        return true;
    }

    /**
     * 创建角色
     *
     * @param string $roleName
     * @param int $sex 性别 0男 1女
     * @param string $userid
     *            用户id,可以外部设置
     * @param bool $checkRoleName
     *            是否检测角色名是否合法,默认为TRUE
     * @return Common_Util_ReturnVar
     */
    public function createrole($roleName, $sex, $userid = NULL, $checkRoleName = TRUE)
    {
        $retCode = 0;
        $data = array();
        $retCode_Str = 'SUCC';

        if ($this->exist()) {
            $retCode = err_dbs_role_createrole::EXISTS_ROLE;
            $retCode_Str = 'EXISTS_ROLE';
            goto failed;
        }

        $roleName = strval($roleName);
        if ($checkRoleName && !self::rolename_is_vaild($roleName)) {
            $retCode = err_dbs_role_createrole::ROLE_NAME_INVALID;
            $retCode_Str = 'ROLE_NAME_INVALID';
            goto failed;
        }

        if (!empty ($userid)) {
            $this->set_userid($userid);
        } else {
            $userid = $this->get_userid();
        }
        $this->set_rolename($roleName);
        $this->set_sex($sex);
        // 创建时间
        $this->set_create_time(time());
        $this->set_sequenceId($this->db_connect()->getAutoIncreaseId($this->get_tablename() .
            "_" . self::DBKey_sequenceId));
        $this->saveToDB(true);

        $newPlayer = dbs_player::newGuestPlayerWithLock($userid);


        Common_Util_Log::record(Common_Util_Log::DEBUG, 'create_role', 'create role');
        $this->initializeRole($newPlayer);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 初始化账号
     * @param dbs_player $player
     */
    private function initializeRole(dbs_player $player)
    {

        //初始化货币
        $defaultDiamond = intval(Common_Util_Configdata::getInstance()->get_global_config('ROLE_CREATE_DIAMOND'));
        $player->db_role()->set_diamond($defaultDiamond);
        $defaultGamecoin = intval(Common_Util_Configdata::getInstance()->get_global_config('ROLE_CREATE_GAMECOIN'));
        $player->db_role()->set_gamecoin($defaultGamecoin);
        // 添加礼包
        $packageId = Common_Util_Configdata::getInstance()->get_global_config_value('ROLE_CREATE_PACKAGEID')->string_value();
        $ret = dbs_item::getInstance()->usepackage($player, $packageId);

        // 初始化厨师
        try {
            $sex = dbs_role::createWithPlayer($player)->get_sex();
            if ($sex === 0) {
                //男
                $chefOrderId = 1;
            } else {
                //女
                $chefOrderId = 6;
            }
            dbs_chef_list::createWithPlayer($player)->choose($chefOrderId, []);

            //直接任命厨师
            $chefs = dbs_chef_list::createWithPlayer($player)->get_cheflist();
            foreach ($chefs as $chefId => $chefData) {

                dbs_chef_jobs_player::createWithPlayer($player)->changeJobChef($chefId, 0);
                break;
            }
        } catch (exception_logicError $e) {
        }


//        dump(dbs_chef_list::createWithPlayer($player));


    }

    /**
     * 改名
     *
     * @param string $newname
     * @return Common_Util_ReturnVar
     */
    public function changerolename($newname)
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();
        $retCode_Str = '';

        $newname = strval($newname);
        $newname = Common_Util_String::utf8_trimAll($newname);

        if ($newname == $this->get_rolename()) {
            $retCode = err_dbs_role_changerolename::SAME_ROLENAME;
            $retCode_Str = 'SAME_ROLENAME';
            goto failed;
        }

        // $count = $this->db_ins->count ( $this->get_tablename (), array (
        // self::DBKey_rolename => $newname
        // ) );
        // if ($count > 0) {
        // $retCode = err_dbs_role_changerolename::ROLENAME_EXIST;
        // $retCode_Str = 'ROLENAME_EXIST';
        // goto failed;
        // }

        if (!self::rolename_is_vaild($newname)) {
            $retCode = err_dbs_role_changerolename::ROLE_NAME_INVALID;
            $retCode_Str = 'ROLE_NAME_INVALID';
            goto failed;
        }

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_57, 1);
        $this->set_rolename($newname);
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }


    protected function set_diamond($value)
    {
        parent::set_diamond($value);

        if (!is_null($this->db_owner)) {

            dbs_rank_system_diamonds::getInstance()->rank_valuechange($this->db_owner, $value);
        }
    }

    /**
     * 增加钻石
     *
     * @param number $num
     * @param int $reason
     *            原因id
     * @return boolean
     */
    public function add_diamond($num, $reason = 0)
    {
        $addnum = intval($num);
        if ($addnum <= 0) {
            return false;
        }
        $curr = $this->get_diamond();
        $this->set_diamond($curr + $addnum);

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_ADDDIAMOND, $this->get_userid(), [
            'num' => $num,
            'reason' => $reason,
            'before' => $curr,
            'after' => $this->get_diamond()
        ]);

        return true;
    }

    /**
     * 花费钻石
     *
     * @param int $num
     *            数量
     * @param number $reason
     *            原因
     * @param string $reasondetail
     *            详细原因
     * @return boolean 是否成功
     */
    public function cost_diamond($num, $reason = 0, $reasondetail = '')
    {
        $costnum = intval($num);
        if ($costnum < 0) {
            return false;
        }
        if ($costnum == 0) {
            return true;
        }
        $curr = $this->get_diamond();
        // dump ( $curr );
        // $this->dumpDB();
        if ($costnum > $curr) {
            return false;
        }
        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_61, $costnum);

        $this->set_diamond($curr - $costnum);

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_COSTDIAMOND, $this->get_userid(), [
            'num' => $num,
            'reason' => $reason,
            'before' => $curr,
            'after' => $this->get_diamond()
        ]);

        return true;
    }


    /**
     * 增加游戏币
     * @param $num
     * @param $reason
     * @param bool|true $addToTotal 是否添加到总数累计
     * @return bool
     */
    public function add_gamecoin($num, $reason, $addToTotal = true)
    {
        $addnum = intval($num);
        if ($addnum < 0) {
            return false;
        }
        if ($addnum == 0) {
            return true;
        }
        $curr = $this->get_gamecoin();

        $this->set_gamecoin($curr + $addnum);

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_58, $addnum);

        if ($addToTotal) {
            $this->set_addgamecoins($this->get_addgamecoins() + $num);
        }

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_ADDGAMECOIN, $this->get_userid(), [
            'num' => $num,
            'reason' => $reason,
            'before' => $curr,
            'after' => $this->get_gamecoin()
        ]);

        return true;
    }

    /**
     * 花费游戏币
     *
     * @param number $num
     * @return boolean
     */
    public function cost_gamecoin($num, $reason, $reasondetail = '')
    {
        $costnum = intval($num);
        if ($costnum <= 0) {
            return false;
        }
        $curr = $this->get_gamecoin();
        if ($costnum > $curr) {
            return false;
        }

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_60, $costnum);
        $this->set_gamecoin($curr - $costnum);

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_COSTGAMECOIN, $this->get_userid(), [
            'num' => $num,
            'reason' => $reason,
            'before' => $curr,
            'after' => $this->get_gamecoin()
        ]);

        return true;
    }


    /**
     * 同时增加游戏币和钻石
     * @param $gamecoin
     * @param $diamond
     * @param $reason
     * @param bool|true $addToTotal
     */
    public function add_gamecoin_and_diamonds($gamecoin, $diamond, $reason, $addToTotal = true)
    {
        $this->add_gamecoin($gamecoin, $reason, $addToTotal);
        $this->add_diamond($diamond, $reason);
    }

    /**
     * 用户登陆
     */
    public function login()
    {
        $preLoginTime = $this->get_lastest_logintime();
        $timeNow = time();

        $this->set_lastest_logintime($timeNow);

        $this->db_owner->dbs_friend_recommemd()->set_lastlogintime($timeNow);

        $preLoginTime = intval($preLoginTime / constants_time::SECONDS_ONE_DAY);
        $curLoginTime = intval($timeNow / constants_time::SECONDS_ONE_DAY);

        // 设置连续登陆
        if ($preLoginTime != $curLoginTime) {
            $this->set_continuelogin($this->get_continuelogin() + 1);
            $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_65, $this->get_continuelogin());
        }

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_USERLOGIN, $this->get_userid(), $this->toArray());


        try {
            // 计算离线吃饭
            dbs_custom_eatDishes_player::createWithPlayer($this->db_owner)->eatByOffline();
        } catch (exception_logicError $e) {

        }
    }

    /**
     * 登出
     */
    public function logout()
    {
        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_USERLOGOUT, $this->get_userid(), $this->toArray());
    }

    /**
     * 设置经纬度
     *
     * @param double $Lng
     *            经度
     * @param double $Lat
     *            纬度
     * @return Common_Util_ReturnVar
     */
    function setLngLat($Lng, $Lat)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        $Lng = doubleval($Lng);
        $Lat = doubleval($Lat);
        // class err_dbs_role_setLngLat{}
        $this->set_Lng($Lng);
        $this->set_Lat($Lat);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    public function toArray($filter = NULL, $excludefilter = NULL)
    {
        $ret = parent::toArray($filter, $excludefilter);
        // 机器人处理头像获取
//        if (!is_null($this->db_owner)) {
//
//            $robotService = dbs_robot_player::getCacheObjectOrNew($this->get_userid());
//            if ($robotService instanceof dbs_robot_player
//                && isset ($ret [self::DBKey_headiconurl])
//            ) {
//                // dump ( $ret );
//                $config = $robotService->getheadiconconfig();
//                if (!is_null($config)) {
//                    $ret [self::DBKey_headiconurl] = $config [configdata_robot_headicon_album_setting::k_headicon];
//                }
//            }
//        }
        return $ret;
    }

    /**
     * 增加可以增加声望的额度
     * @param $value
     * @return int
     */
    public function addReputationAmountByDiamond($value)
    {
        $value = intval($value);
        if ($value < 0) {
            return 0;
        }
        $reputation = floor($value / 10);
        $this->set_reputationAmount($this->get_reputationAmount() + $reputation);
        return $this->get_reputationAmount();
    }

    /**
     * 通过钻石数量增加声望
     * @param $value
     * @param $reason
     * @return float|int 增加声望的数量
     */
    public function addReputationByDiamond($value, $reason)
    {
        $value = intval($value);
        if ($value < 0) {
            return 0;
        }
        $reputation = floor($value / 10);
        $reputation = min($reputation, $this->get_reputationAmount());

        $this->addReputation($reputation, $reason);
        return $reputation;
    }

    /**
     * 增加声望
     * @param $value
     * @param $reason
     * @return bool
     */
    public function addReputation($value, $reason)
    {
        $value = intval($value);
        if ($value < 0) {
            return false;
        }

        $value = min($value, $this->get_reputationAmount());
        if ($value === 0) {
            return true;
        }
        $current = $this->get_reputation();
        $this->set_reputation($current + $value);

        dbs_mission::createWithPlayer($this)->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_63,
            $current + $value);

        //减少额度
        $this->set_reputationAmount($this->get_reputationAmount() - $value);

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_ADD_REPUTATION, $this->get_userid(), [
            'num' => $value,
            'reason' => $reason,
            'before' => $current,
            'after' => $this->get_reputation()
        ]);
        return true;
    }

    /**
     * 减少声望
     * @param $value
     * @param $reason
     * @return bool
     */
    public function costReputation($value, $reason)
    {
        typeCheckNumber($value, 0);
        $value = intval($value);
        $current = $this->get_reputation();
        if ($current < $value) {
            return false;
        }
        $this->set_reputation($current - $value);

        utils_log::getInstance()->gamelog(utils_log::LOGTYPE_COST_REPUTATION, $this->get_userid(), [
            'num' => $value,
            'reason' => $reason,
            'before' => $current,
            'after' => $this->get_reputation()
        ]);
        return true;

    }


    use dbs_robot_logicTrait;

    /**
     * @inheritDoc
     */
    public function processRobotLogic( dbs_robot_data $robotData)
    {
        $this->login();
    }


}