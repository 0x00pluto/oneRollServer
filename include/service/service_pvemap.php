<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * pve地图服务
 * @auther zhipeng
 */
class service_pvemap extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'battle',
            'restorestagebattletimes',
            'buytickets',
            'getmapaward',
            'battleinvitefriendchef'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_pve_map();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_pve_map" . "_";
    }

    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_pvemap_getinfo{}

        // code
        $data = $this->get_dbins()->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 刷地图,单次
     *
     * @param string $stageid
     *            关卡id
     * @return Common_Util_ReturnVar
     */
    function battle($stageid)
    {
        return $this->get_dbins()->battle($stageid);
    }

    /**
     * 恢复地图的战斗次数
     *
     * @param unknown $stageid
     * @return Common_Util_ReturnVar
     */
    function restorestagebattletimes($stageid)
    {
        return $this->get_dbins()->restorestagebattletimes($stageid);
    }

    /**
     * 购买邀请卷
     *
     * @return Common_Util_ReturnVar
     */
    function buytickets()
    {
        return $this->get_dbins()->buytickets();
    }

    /**
     * 获取地图奖励
     *
     * @param string $awardid
     *            奖励id
     * @return Common_Util_ReturnVar
     */
    function getmapaward($awardid)
    {
        return $this->get_dbins()->getmapaward($awardid);
    }

    /**
     * 战斗邀请好友厨师
     *
     * @param string $selfchefid1
     * @param string $frienduserid1
     * @param string $friendchefid1
     * @param string $selfchefid2
     * @param string $frienduserid2
     * @param string $friendchefid2
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function battleinvitefriendchef($selfchefid1 = '', $frienduserid1 = '', $friendchefid1 = '', $selfchefid2 = '', $frienduserid2 = '', $friendchefid2 = '')
    {
        return $this->get_dbins()->battleinvitefriendchef($selfchefid1, $frienduserid1, $friendchefid1, $selfchefid2, $frienduserid2, $friendchefid2);
    }
}