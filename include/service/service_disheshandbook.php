<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/23
 * Time: 下午4:07
 */

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dishesHandbook\dbs_dishesHandbook_player;

/**
 * 菜品图鉴
 * Class service_disheshandbook
 * @package service
 */
class service_disheshandbook extends service_base
{
    function __construct()
    {
        $this->addFunctions([
            'getinfo',
        ]);

        $this->addFunctions(['test'],
            true);

    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_itemgraft_player_";
    }

    /**
     * @return dbs_dishesHandbook_player
     */
    protected function get_dbins()
    {
        return dbs_dishesHandbook_player::createWithPlayer($this->callerUserInstance);
    }


    /**
     * 获取图鉴信息
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {
        $data = $this->get_dbins()->toArray();
        //interface err_service_disheshandbook_getinfo


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * @return Common_Util_ReturnVar
     */
    public function test()
    {
        $data = [];
        //interface err_service_disheshandbook_test

        $this->get_dbins()->activeHandBook(501001);
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }
}