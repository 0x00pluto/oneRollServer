<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 装备服务
 *
 * @author zhipeng
 *
 */
class service_equipment extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'upgrade',
            'auto_upgrade',
            'upgradegiveequipment',
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_equipment();
    }

    /**
     * 升级装备
     *
     * @param string $pos
     *            装备位置
     * @return Common_Util_ReturnVar
     */
    function upgrade($pos)
    {
        typeCheckGUID($pos);
        return $this->get_dbins()->upgrade($pos);
    }

    /**
     * 升级赠送出去的装备
     *
     * @param string $destuserid
     *            目的userid
     * @param string $destchefid
     *            目的厨师id
     * @param string $pos
     *            目的装备位置
     */
    function upgradegiveequipment($destuserid, $destchefid, $pos)
    {
        typeCheckUserId($destuserid);
        typeCheckGUID($destchefid);
        typeCheckGUID($pos);

        return $this->get_dbins()->upgradegiveequipment($destuserid, $destchefid, $pos);
    }

    /**
     * 一键升级
     *
     * @param
     *            unknown 位置
     * @return Common_Util_ReturnVar
     */
    function auto_upgrade($pos)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_equipment_auto_upgrade{}

        typeCheckGUID($pos);

        $singleret = null;
        for ($i = 0; $i < 300; $i++) {
            $singleret = $this->get_dbins()->upgrade($pos);
            $data[] = $singleret->to_Array();
            if ($singleret->is_failed()) {
                break;
            }

        }

        $retCode = $singleret->get_retcode();
        $retCode_Str = $singleret->get_retcode_str();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }


}