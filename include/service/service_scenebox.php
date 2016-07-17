<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 场景宝箱服务
 * @auther zhipeng
 */
class service_scenebox extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'opennormalbox',
            'opennormalboxfriend',
            'dropnormalbox',
            'openmasterbox',
            'noticeopenmasterbox'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_scene_box();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_scenebox_scenebox" . "_";
    }

    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_scenebox_getinfo{}

        // code

        $data = $this->get_dbins()->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 开普通宝箱,不需要friendguid
     *
     * @param unknown $boxid
     */
    function opennormalbox($boxid)
    {
        typeCheckGUID($boxid);
        return $this->get_dbins()->opennormalbox($boxid);
    }

    /**
     * 开启好友宝箱
     *
     * @param string $boxid
     *            宝箱id
     * @param string $frienduserid
     *            好友的id
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function opennormalboxfriend($boxid, $frienduserid)
    {
        typeCheckGUID($boxid);
        typeCheckUserId($frienduserid);

        return $this->get_dbins()->opennormalboxfriend($boxid, $frienduserid);
    }

    /**
     * 放弃普通宝箱
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function dropnormalbox()
    {
        return $this->get_dbins()->dropnormalbox();
    }

    /**
     * 开启主人宝箱
     *
     * @param unknown $boxid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function openmasterbox($boxid)
    {
        typeCheckGUID($boxid);
        return $this->get_dbins()->openmasterbox($boxid);
    }

    /**
     * 通知开启宝箱
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function noticeopenmasterbox($destuserid)
    {
        typeCheckUserId($destuserid);
        return $this->get_dbins()->noticeopenmasterbox($destuserid);
    }
}