<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 好友服务
 *
 * @author zhipeng
 *
 */
class service_friend extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'removefriend',
            'getrecommendfriends',
            'addFriend',
            'getGoodwill',
            'awardGoodwillGift'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->db_friend();
    }


    /**
     * 获取信息
     *
     * @return Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        $data = $this->callerUserInstance->db_friend()->getinfo();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }


    /**
     * 删除好友
     *
     * @param 好友userid $frienduserid
     * @return Common_Util_ReturnVar
     */
    function removefriend($frienduserid)
    {
        typeCheckUserId($frienduserid);

        $frienduserid = strval($frienduserid);
        return $this->callerUserInstance->db_friend()->removefriend($frienduserid);
    }

    /**
     * 获取推荐好友
     *
     * @param bool $force_refresh
     *            是否强制刷新
     * @return Common_Util_ReturnVar
     */
    function getrecommendfriends($force_refresh = FALSE)
    {
        return $this->get_dbins()->getrecommendfriends($force_refresh);
    }


    /**
     * 添加好友
     * @param $destUserId
     * @return Common_Util_ReturnVar
     */
    public function addFriend($destUserId)
    {
        return $this->get_dbins()->addFriend($destUserId);
    }

    /**
     * 获取目标用户的好感度
     * @param $userId
     * @return Common_Util_ReturnVar
     */
    public function getGoodwill($userId)
    {
        return $this->get_dbins()->getGoodwill($userId);
    }

    /**
     * 领取好感度礼包
     * @param string $userId 特定用户的用户ID
     * @return Common_Util_ReturnVar
     */
    public function awardGoodwillGift($userId)
    {
        return $this->get_dbins()->awardGoodwillGift($userId);
    }
}