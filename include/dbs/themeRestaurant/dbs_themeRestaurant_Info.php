<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/12
 * Time: 上午11:11
 */

namespace dbs\themeRestaurant;


use configdata\configdata_theme_restaurant_setting;
use dbs\templates\themeRestaurant\dbs_templates_themeRestaurant_themeRestaurantInfo;

class dbs_themeRestaurant_Info extends dbs_templates_themeRestaurant_themeRestaurantInfo
{
    /**
     * @param dbs_themeRestaurant_manageData $value
     */
    public function setManageData(dbs_themeRestaurant_manageData $value)
    {
        $this->set_manageData($value->toArray());
    }

    /**
     * @return dbs_themeRestaurant_manageData
     */
    public function getManageData()
    {
        return dbs_themeRestaurant_manageData::create_with_array($this->get_manageData());
    }

    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_manageData()
    {
        $this->set_defaultkeyandvalue(self::DBKey_manageData, dbs_themeRestaurant_manageData::dumpDefaultValue());
    }


    /**
     * 获取主题餐厅配置
     * @return array|null
     */
    public function getConfig()
    {
        return getConfigData(configdata_theme_restaurant_setting::class,
            configdata_theme_restaurant_setting::k_id,
            $this->get_id());
    }
}