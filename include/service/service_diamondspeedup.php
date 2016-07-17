<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_diamondspeedup;

/**
 * 钻石加速各种服务接口
 *
 * @author zhipeng
 *
 */
class service_diamondspeedup extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'speedupcooktable',
            'speedupsceneexpand',
            'speedupcomposeitem',
            'speedupdinnertable',
            'speedUpGraft',
            'speedupTrainChef'
        ));

        $this->addFunction("getSpeedUpSceneExpandDiamonds");
        $this->addFunction("getSpeedUpCookTableDiamonds");
        $this->addFunction("getSpeedUpDinnerTableDiamonds");
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->db_diamondspeedup();
    }

    /**
     * 获取加速扩建所用的钻石数量
     * @param $themeRestaurantId
     * @return Common_Util_ReturnVar
     */
    public function getSpeedUpSceneExpandDiamonds($themeRestaurantId)
    {
        return dbs_diamondspeedup::createWithPlayer($this->callerUserInstance)->getSpeedUpSceneExpandDiamonds($themeRestaurantId);
    }

    /**
     * 获取加速做菜所用的钻石数量
     * @param $themeRestaurantId
     * @param string $cooktableGuid
     * @return Common_Util_ReturnVar
     */
    public function getSpeedUpCookTableDiamonds($themeRestaurantId, $cooktableGuid)
    {
        return $this->get_dbins()->getSpeedUpCookTableDiamonds($themeRestaurantId, $cooktableGuid);
    }

    /**
     * 加速炉灶做菜
     *
     * @param int $themeRestaurantId 主题餐厅ID
     * @param string $cooktableGuid
     * @return Common_Util_ReturnVar
     */
    function speedupcooktable($themeRestaurantId, $cooktableGuid)
    {
        return $this->callerUserInstance->db_diamondspeedup()->speedupcooktable($themeRestaurantId, $cooktableGuid);

    }

    /**
     * 加速场景扩地
     * @param string $themeRestaurantId 主题餐厅ID
     * @return Common_Util_ReturnVar
     */
    function speedupsceneexpand($themeRestaurantId)
    {
        return $this->callerUserInstance->db_diamondspeedup()->speedupsceneexpand($themeRestaurantId);
    }

    /**
     * 加速合成
     *
     * @param int $slotid
     *            合成位置id
     * @return Common_Util_ReturnVar
     */
    function speedupcomposeitem($slotid)
    {
        typeCheckString($slotid, 10);
        return $this->get_dbins()->speedupcomposeitem($slotid);
    }

    /**
     * 获取加速餐台吃饭钻石数
     * @param $themeRestaurantId
     * @param $dinnerTableGuid
     * @return Common_Util_ReturnVar
     */
    public function getSpeedUpDinnerTableDiamonds($themeRestaurantId, $dinnerTableGuid)
    {
        return $this->get_dbins()->getSpeedUpDinnerTableDiamonds($themeRestaurantId, $dinnerTableGuid);
    }

    /**
     * 加速餐台吃饭
     * @param int $themeRestaurantId 主题餐厅ID
     * @param string $dinnerTableGuid 餐台ID
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function speedupdinnertable($themeRestaurantId, $dinnerTableGuid)
    {
        return $this->get_dbins()->speedupdinnertable($themeRestaurantId, $dinnerTableGuid);
    }

    /**
     * 加速嫁接
     * @param $destUserId
     * @param $slotId
     * @return Common_Util_ReturnVar
     */
    public function speedUpGraft($destUserId, $slotId)
    {
        return $this->get_dbins()->speedUpGraft($destUserId, $slotId);
    }

    /**
     * 加速培训
     * @param string $chefId 自己参加培训的厨师ID
     * @return Common_Util_ReturnVar
     */
    public function speedupTrainChef($chefId)
    {
        return $this->get_dbins()->speedupTrainChef($chefId);
    }
}