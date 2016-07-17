<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/17
 * Time: 下午2:58
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\payout\dbs_payout_player;

/**
 * 付出服务
 * Class service_payout
 * @package service
 */
class service_payout extends service_base
{
    function __construct()
    {
        $this->addFunctions([
            'getinfo',
        ]);

        $this->addFunctions([
            'addDiamondValue'
        ], true);
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_payout_player_";
    }

    /**
     * @return dbs_payout_player|null
     */
    protected function get_dbins()
    {
        return dbs_payout_player::createWithPlayer($this->callerUserInstance);
    }


    /**
     * 获取信息
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {
        $data = $this->get_dbins()->toArray();
        //class err_service_payout_getinfo

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 增加付出
     * @param $destUserId
     * @param $value
     * @throw exception_logicError
     * @return Common_Util_ReturnVar
     *
     */

    public function addDiamondValue($destUserId, $value)
    {
        return $this->get_dbins()->addDiamondValue($destUserId, $value);
    }
}