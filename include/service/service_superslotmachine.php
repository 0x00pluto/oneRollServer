<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 超级老虎机接口
 *
 * @auther zhipeng
 */
class service_superslotmachine extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'rollslotmachine',
            'giveupslotmachine',
            'recvjackpot',
            'sendinvitetouser',
            'sendinvitetogroup'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_pve_superslotmachine();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_pve_superslotmachine" . "_";
    }

    /**
     * 获取信息
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_superslotmachine_getinfo{}

        $data = $this->get_dbins()->toArray();

        succ:

        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 摇动老虎机
     *
     * @param string $destuserid
     *            老虎机发布者的id
     * @param string $slotmachineguid
     *            老虎机id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function rollslotmachine($destuserid, $slotmachineguid)
    {

        typeCheckUserId($destuserid);
        typeCheckGUID($slotmachineguid);

        return $this->get_dbins()->rollslotmachine($destuserid, $slotmachineguid);
    }

    /**
     * 放弃老虎机
     *
     * @param unknown $slotmachineguid
     *            老虎机id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function giveupslotmachine($slotmachineguid)
    {
        typeCheckGUID($slotmachineguid);
        return $this->get_dbins()->giveupslotmachine($slotmachineguid);
    }

    /**
     * 领取超级奖励
     *
     * @param unknown $superslotmachineid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function recvjackpot($superslotmachineid)
    {
        typeCheckGUID($superslotmachineid);
        return $this->get_dbins()->recvjackpot($superslotmachineid);
    }

    /**
     * 发送用户邀请
     *
     * @param unknown $slotmachineid
     * @param unknown $destuserid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function sendinvitetouser($slotmachineid, $destuserid)
    {
        typeCheckGUID($slotmachineid);
        typeCheckUserId($destuserid);

        return $this->get_dbins()->sendinvitetouser($slotmachineid, $destuserid);
    }

    /**
     * 向群组发送邀请
     *
     * @param string $slotmachineid
     *            老虎机id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function sendinvitetogroup($slotmachineid)
    {
        typeCheckGUID($slotmachineid);

        return $this->get_dbins()->sendinvitetogroup($slotmachineid);
    }
}