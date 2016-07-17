<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/29
 * Time: 上午10:55
 */

namespace dbs\friend;


use configdata\configdata_friend_goodwill_level_setting;
use dbs\base\dbs_base_level;
use dbs\templates\friend\dbs_templates_friend_goodwill;

class dbs_friend_goodwill extends dbs_templates_friend_goodwill
{
    use dbs_base_level;

    /**
     * dbs_friend_goodwill constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->set_tablename(self::DBKey_tablename);
        $this->set_primary_key([self::DBKey_guid]);
    }


    /**
     * 设置好友ID 及guid
     * @param $friendUserId1
     * @param $friendUserId2
     */
    public function setFriendUserIds($friendUserId1, $friendUserId2)
    {
        $dbFriendUserId1 = $friendUserId1;
        $dbFriendUserId2 = $friendUserId2;

        $result = strcmp($friendUserId1, $friendUserId2);
        if ($result < 0) {
            $dbFriendUserId1 = $friendUserId2;
            $dbFriendUserId2 = $friendUserId1;
        }
        $guid = md5($dbFriendUserId1 . $dbFriendUserId2);

        $this->set_userId1($dbFriendUserId1);
        $this->set_userId2($dbFriendUserId2);
        $this->set_guid($guid);
    }

    /**
     * @inheritDoc
     */
    protected function _get_exp()
    {
        return $this->get_exp();
    }

    /**
     * @inheritDoc
     */
    protected function _set_exp($value)
    {
        $this->set_exp($value);
    }

    /**
     * @inheritDoc
     */
    protected function _get_level()
    {
        $this->get_level();
    }

    /**
     * @inheritDoc
     */
    protected function _set_level($value)
    {
        $this->set_level($value);
    }

    /**
     * @inheritDoc
     */
    protected function _get_totalexp()
    {
        return $this->get_expTotal();
    }

    /**
     * @inheritDoc
     */
    protected function _set_totalexp($value)
    {
        $this->set_expTotal($value);
    }

    /**
     * @inheritDoc
     */
    protected function _get_levelup_config($level)
    {
        return getConfigData(configdata_friend_goodwill_level_setting::class,
            configdata_friend_goodwill_level_setting::k_level,
            $level);
    }


    /**
     * 增加好感度经验
     * @param $exp
     * @return \Common\Util\Common_Util_ReturnVar
     */
    public function addGoodwillExp($exp)
    {
        return $this->addexp($exp);
    }

    /**
     * 创建GUID
     * @param $friendUserId1
     * @param $friendUserId2
     * @return string
     */
    public static function createGoodWillGUID($friendUserId1, $friendUserId2)
    {
        $dbFriendUserId1 = $friendUserId1;
        $dbFriendUserId2 = $friendUserId2;

        $result = strcmp($friendUserId1, $friendUserId2);
        if ($result < 0) {
            $dbFriendUserId1 = $friendUserId2;
            $dbFriendUserId2 = $friendUserId1;
        }
        $guid = md5($dbFriendUserId1 . $dbFriendUserId2);
        return $guid;
    }

    /**
     * 通过唯一ID获取好感度
     * @param $guid
     * @return dbs_friend_goodwill
     */
    public static function getGoodWillByGuid($guid)
    {
        $ins = self::findOrNew([self::DBKey_guid => $guid]);
        return $ins;
    }

    /**
     * @param $friendUserId1
     * @param $friendUserId2
     * @return dbs_friend_goodwill
     */
    public static function getGoodWill($friendUserId1, $friendUserId2)
    {
        $guid = self::createGoodWillGUID($friendUserId1, $friendUserId2);
        return self::getGoodWillByGuid($guid);
    }

    /**
     * 获取好感度礼包领取等级
     * @param $userId
     * @return int
     */
    public function getAwardGiftLevel($userId)
    {
        if ($userId === $this->get_userId1()) {
            return $this->get_userAwardGiftLevel1();
        }
        return $this->get_userAwardGiftLevel2();
    }

    /**
     * 设置好感度礼包领取等级
     * @param $userId
     * @param $level
     * @return $this
     */
    public function setAwardGiftLevel($userId, $level)
    {
        if ($userId === $this->get_userId1()) {
            return $this->set_userAwardGiftLevel1($level);
        }
        return $this->set_userAwardGiftLevel2($level);
    }
}