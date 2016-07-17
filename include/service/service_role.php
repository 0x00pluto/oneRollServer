<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 角色信息接口
 *
 * @author zhipeng
 *
 */
class service_role extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'changerolename',
            'getroleinfo',
            'setLngLat',
            'savesettingroleinfo',
            'setheadiconurl'
        ));
    }


    /**
     * 改名
     * @param string $newrolename 新用户名
     * @return Common_Util_ReturnVar
     */
    public function changerolename($newrolename)
    {
        typeCheckString($newrolename, 32, 2);
        return $this->callerUserInstance->db_role()->changerolename($newrolename);

    }


    /**
     * 获取角色信息
     *
     * @return Common_Util_ReturnVar
     */
    public function getroleinfo()
    {
        $data = [];
        $retCodeArr = array(
            'NOT_ROLE_INFO' => 1
        );


        logicErrorCondition($this->callerUserInstance->db_role()->exist(),
            $retCodeArr ['NOT_ROLE_INFO'],
            'NOT_ROLE_INFO',
            $data);

        $data = $this->callerUserInstance->db_role()->toArray();

        return Common_Util_ReturnVar::RetSucc($data);
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
        typeCheckNumber($Lng);
        typeCheckNumber($Lat);
        return $this->callerUserInstance->db_role()->setLngLat($Lng, $Lat);
    }

    /**
     * 保存设置信息
     *
     * @param string $sign
     *            签名
     * @param string $birthday
     *            生日
     * @param string $address
     *            家庭住址
     * @param string $interests 兴趣爱好
     * @return Common_Util_ReturnVar
     */
    function savesettingroleinfo($sign,
                                 $birthday,
                                 $address,
                                 $interests)
    {
        typeCheckString($sign, 200);
        typeCheckString($birthday);
        typeCheckString($address, 200, 2);
        typeCheckString($interests, 200);
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        $role = $this->callerUserInstance->db_role();
        $role->set_birthday($birthday);
        $role->set_sign($sign);
        $role->set_address($address);
        $role->set_interests($interests);

        // 推荐好友数据
        $this->callerUserInstance->dbs_friend_recommemd()->set_sex($role->get_sex());
        $this->callerUserInstance->dbs_friend_recommemd()->set_birthday($role->get_birthday());

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 设置头像url
     *
     * @param unknown $url
     * @return Common_Util_ReturnVar
     */
    function setheadiconurl($url)
    {
        typeCheckString($url, 200, 2);
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_role_setheadiconurl{}

        $role = $this->callerUserInstance->db_role();
        $role->set_headiconurl($url);

        if (!empty ($url)) {
            $this->callerUserInstance->dbs_friend_recommemd()->set_setheadicon(1);
        }
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}