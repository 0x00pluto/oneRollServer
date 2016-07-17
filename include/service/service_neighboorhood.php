<?php

namespace service;

use dbs\neighbourhood\dbs_neighbourhood_groupmanager;
use Common\Util\Common_Util_ReturnVar;
use err\err_service_neighboorhood_getneighboorhoodinfo;
use dbs\dbs_player;

/**
 * 邻居社区服务
 *
 * @author zhipeng
 *
 */
class service_neighboorhood extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(

            'getneighboorhoodinfo',
            'getmymemberinfo',
            'getmyneighboorhoodallmemberinfo',
            'buygiftpackage',
            'sendgiftpackage',
            'recvgiftpackage',
            'thanksgiftpackagesender',
            'getinvitepos',
            'accpetinvitepos',

            'getBulletinBoardInfo',

        ));

        $this->addFunctions([
            'exitgroup'
        ], true);
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_neighbourhood_playerdata();
    }

    /**
     *  自动加入群组
     *
     * @return Common_Util_ReturnVar
     */
    function autojoingroup()
    {
        return dbs_neighbourhood_groupmanager::getInstance()->autojoinneighboorhood($this->callerUserInstance);

    }

    /**
     * 退出群组
     *
     * @return Common_Util_ReturnVar
     */
    function exitgroup()
    {

        return dbs_neighbourhood_groupmanager::getInstance()->exitneighboorhood($this->callerUserInstance);
    }

    /**
     * 获取群组信息
     *
     * @return Common_Util_ReturnVar
     */
    function getneighboorhoodinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        $groupdata = $this->callerUserInstance->dbs_neighbourhood_playerdata()->get_groupdata();
        if (is_null($groupdata)) {
            $retCode = err_service_neighboorhood_getneighboorhoodinfo::NEIGHBOORHOOD_INFO_NOT_EXISTS;
            $retCode_Str = 'NEIGHBOORHOOD_INFO_NOT_EXISTS';
            goto failed;
        }
        $data = $groupdata->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取我的所有邻居的信息
     *
     * @return Common_Util_ReturnVar
     */
    function getmyneighboorhoodallmemberinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_neighboorhood_getmyneighboorhoodallmemberinfo{}
        $groupdata = $this->callerUserInstance->dbs_neighbourhood_playerdata()->get_groupdata();
        if (is_null($groupdata)) {
            $retCode = err_service_neighboorhood_getneighboorhoodinfo::NEIGHBOORHOOD_INFO_NOT_EXISTS;
            $retCode_Str = 'NEIGHBOORHOOD_INFO_NOT_EXISTS';
            goto failed;
        }
        // code
        $members = $groupdata->get_member();
        $membersgroupinfo = array();
        foreach ($members as $memberuserid => $value) {
            $memberplayer = dbs_player::newGuestPlayer($memberuserid);
            $membersgroupinfo [$memberuserid] = $memberplayer->dbs_neighbourhood_playerdata()->toArray();
        }
        $data = $membersgroupinfo;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取自己的群组信息
     *
     * @return Common_Util_ReturnVar
     */
    function getmymemberinfo()
    {
        return $this->callerUserInstance->dbs_neighbourhood_playerdata()->getmemberinfo();
    }

    /**
     * 购买红包
     *
     * @param string $itemid
     *            红包id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function buygiftpackage($itemid)
    {
        return $this->callerUserInstance->dbs_neighbourhood_playerdata()->buygiftpackage($itemid);
    }

    /**
     * 发送红包
     *
     * @param unknown $itemid
     */
    function sendgiftpackage($itemid)
    {
        typeCheckString($itemid, 20);
        return $this->callerUserInstance->dbs_neighbourhood_playerdata()->sendgiftpackage($itemid);
    }

    /**
     * 抢红包
     *
     * @param unknown $giftguid
     * @return Common_Util_ReturnVar
     */
    function recvgiftpackage($giftguid)
    {
        typeCheckGUID($giftguid);
        return $this->callerUserInstance->dbs_neighbourhood_playerdata()->recvgiftpackage($giftguid);
    }

    /**
     * 感谢红包发送者
     *
     * @param string $giftguid
     * @param int $thankstype
     *            0 忽略 1 普通感谢 2 钻石感谢
     * @return Common_Util_ReturnVar
     */
    function thanksgiftpackagesender($giftguid, $thankstype)
    {
        typeCheckGUID($giftguid);
        typeCheckNumber($thankstype);
        typeCheckChoice(intval($thankstype), [
            0,
            1,
            2
        ]);
        return $this->callerUserInstance->dbs_neighbourhood_playerdata()->thanksgiftpackagesender($giftguid, $thankstype);
    }

    /**
     * 获取位置邀请码
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getinvitepos()
    {
        return $this->get_dbins()->getinvitepos();
    }

    /**
     * 接收位置申请
     *
     * @param unknown $groupid
     * @param unknown $invitecode
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function accpetinvitepos($groupid, $invitecode)
    {

        typeCheckString($groupid);
        typeCheckGUID($invitecode);
        return $this->get_dbins()->accpetinvitepos($groupid, $invitecode);
    }

    /**
     * 获取公告信息
     * @return Common_Util_ReturnVar
     */
    public function getBulletinBoardInfo()
    {
        return $this->get_dbins()->getBulletinBoardInfo();
    }
}