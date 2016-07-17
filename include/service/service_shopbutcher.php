<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_shopbutcherplayer;

/**
 * 肉店服务
 *
 * @author zhipeng
 *
 */
class service_shopbutcher extends service_base
{
    function __construct()
    {
        $this->addFunctions([
            'getallgoods',
            'getshopinfo',
            'buyitem',
            'upgrade',
        ]);
    }


    /**
     * 获取所有道具列表
     * @return Common_Util_ReturnVar
     */
    public function getallgoods()
    {
        $data = $this->callerUserInstance->db_shopbutcherplayer()->getgoods();
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 获取商店信息
     * @return Common_Util_ReturnVar
     */
    public function getshopinfo()
    {
        $data = dbs_shopbutcherplayer::createWithPlayer($this->callerUserInstance)->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 购买道具
     * @param string $mallid
     * @param int $num
     * @return Common_Util_ReturnVar
     */
    function buyitem($mallid, $num)
    {

        typeCheckString($mallid, 32);
        typeCheckNumber($num, 1);

        $mallid = strval($mallid);
        $num = intval($num);

        return $this->callerUserInstance->db_shopbutcherplayer()->buyitem($mallid, $num);
    }


    /**
     * 升级
     * @return Common_Util_ReturnVar
     */
    function upgrade()
    {
        return $this->callerUserInstance->db_shopbutcherplayer()->upgrade();
    }

}