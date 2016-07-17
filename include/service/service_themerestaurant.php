<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/12
 * Time: 上午11:15
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\themeRestaurant\dbs_themeRestaurant_Player;

/**
 * 主题餐厅相关服务
 * Class service_themerestaurant
 * @package service
 */
class service_themerestaurant extends service_base
{

    /**
     * service_themerestaurant constructor.
     */
    public function __construct()
    {
        $this->addFunctions([
            'getinfo',
            'openNewRestaruant',
            'harvestThemeRestaurantAutoManage'
        ]);
    }

    /**
     * @return dbs_themeRestaurant_Player
     */
    protected function get_dbins()
    {
        return dbs_themeRestaurant_Player::createWithPlayer($this->callerUserInstance);
    }

    /**
     * @inheritDoc
     */
    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_themeRestaurant_Player_";
    }


    /**
     * 获取主题餐厅信息
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {
        $data = [];

        $data = $this->get_dbins()->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 开启新的餐厅
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function openNewRestaruant($themeRestaurantId)
    {
        return $this->get_dbins()->openNewRestaruant($themeRestaurantId);
    }

    /**
     * 收获餐厅自动经营所得
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function harvestThemeRestaurantAutoManage($themeRestaurantId)
    {
        return $this->get_dbins()->harvestThemeRestaurantAutoManage($themeRestaurantId);
    }
}