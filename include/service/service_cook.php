<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_cookdishes;

/**
 * 做菜服务
 *
 * @author zhipeng
 *
 */
class service_cook extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getallcookbook',
            'learncookbook',
            'BeginCookDishes',
            'cookDishesByStep',
            'cookDishesHarvest',
            'cleardinnertable',
            'ungradecooktable',
            'clearcooktable'
        ));
    }

    protected function get_err_class_name()
    {
        return "err\\err_dbs_cookdishes_";
    }

    /**
     * 获取所有学会的菜谱
     *
     * @return 数组
     */
    function getallcookbook()
    {
        $retCode = 0;
        $data = array();
        // $retCodeArr = array();
        // code
        $data = $this->callerUserInstance->db_cookbook()->toArray();
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * 学习菜谱
     *
     * @param 菜谱id $bookid
     * @return 数组
     */
    function learncookbook($bookid)
    {
        typeCheckString($bookid, 10);
        $bookid = strval($bookid);
        return $this->callerUserInstance->db_cookbook()->learncookbook($bookid);
    }

    /**
     * 开始烹饪
     * @param $themeRestaurantId
     * @param string $buildingGuid 建筑ID
     * @param $cookbookId
     * @param int $cookMaterialItemId1 食材1的ID如果没有为-1
     * @param int $cookMaterialItemId2 食材2的ID如果没有为-1
     * @param int $cookMaterialItemId3 食材3的ID如果没有为-1
     * @param int $cookMaterialItemId4 食材4的ID如果没有为-1
     * @return Common_Util_ReturnVar
     */
    public function BeginCookDishes(
        $themeRestaurantId,
        $buildingGuid,
        $cookbookId,
        $cookMaterialItemId1,
        $cookMaterialItemId2,
        $cookMaterialItemId3,
        $cookMaterialItemId4)
    {
        return dbs_cookdishes::createWithPlayer($this->callerUserInstance)->BeginCookDishes(
            $themeRestaurantId,
            $buildingGuid,
            $cookbookId,
            $cookMaterialItemId1,
            $cookMaterialItemId2,
            $cookMaterialItemId3,
            $cookMaterialItemId4
        );
    }

    /**
     * 做菜步骤
     * @param $themeRestaurantId
     * @param $buildingGuid
     * @return Common_Util_ReturnVar
     */
    public function cookDishesByStep($themeRestaurantId,
                                     $buildingGuid)
    {
        return dbs_cookdishes::createWithPlayer($this->callerUserInstance)
            ->cookDishesByStep($themeRestaurantId, $buildingGuid);
    }

    /**
     * 烹饪收获
     * @param $themeRestaurantId
     * @param $buildingGuid
     * @return Common_Util_ReturnVar
     */
    public function cookDishesHarvest($themeRestaurantId, $buildingGuid)
    {
        return dbs_cookdishes::createWithPlayer($this->callerUserInstance)
            ->cookDishesHarvest($themeRestaurantId, $buildingGuid);
    }

    /**
     * 清除餐台
     *
     * @param $themeRestaurantId
     * @param string $buildingGuid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function cleardinnertable($themeRestaurantId, $buildingGuid)
    {
        return dbs_cookdishes::createWithPlayer($this->callerUserInstance)
            ->cleardinnertable($themeRestaurantId, $buildingGuid);
    }

    /**
     * 升级炉台
     * @param $themeRestaurantId
     * @param $buildingGuid
     * @return Common_Util_ReturnVar
     */
    function ungradecooktable($themeRestaurantId, $buildingGuid)
    {
        return dbs_cookdishes::createWithPlayer($this->callerUserInstance)->ungradecooktable($themeRestaurantId, $buildingGuid);
    }

    /**
     * 清除炉灶上的菜
     *
     * @param $themeRestaurantId
     * @param string $buildingGuid
     *            炉灶guid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function clearcooktable($themeRestaurantId, $buildingGuid)
    {
        return dbs_cookdishes::createWithPlayer($this->callerUserInstance)
            ->clearcooktable($themeRestaurantId, $buildingGuid);
    }
}