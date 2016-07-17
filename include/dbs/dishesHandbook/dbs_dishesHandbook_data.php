<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/1/23
 * Time: 下午4:15
 */

namespace dbs\dishesHandbook;


use configdata\configdata_dishes_handbook_setting;
use dbs\templates\disheshandbook\dbs_templates_disheshandbook_handbookData;

/**
 * 图鉴数据
 * Class dbs_dishesHandbook_data
 * @package dbs\dishesHandbook
 */
class dbs_dishesHandbook_data extends dbs_templates_disheshandbook_handbookData
{

    /**
     * 图鉴配置
     * @return array|null
     */
    public function getHandbookConfig()
    {
        return getConfigData(configdata_dishes_handbook_setting::class,
            configdata_dishes_handbook_setting::k_itemid,
            $this->get_dishesId());
    }

    /**
     * 增加次数
     * @param $value
     * @param bool|false $isComplete 是否完成图鉴,引用传递
     */
    public function addCookTimes($value, &$isComplete = false)
    {
        if ($this->get_isComplete()) {
            return;
        }
        $value = intval($value);
        $totalValue = $this->get_cooktimes() + $value;

        $handbookConfig = $this->getHandbookConfig();
        if (is_null($handbookConfig)) {
            return;
        }
        $cookTimeMax = intval($handbookConfig[configdata_dishes_handbook_setting::k_cooktime]);

//        dump($handbookConfig);
        $totalValue = min($totalValue, $cookTimeMax);
        if ($totalValue === $cookTimeMax) {
            //完成图鉴
            $this->set_isComplete(true);

            $this->set_completeTimespan(time());
            $isComplete = true;
        }
        $this->set_cooktimes($totalValue);

    }

    /**
     * 创建图鉴
     * @param $dishesId
     * @param int $cookTimes
     * @return dbs_dishesHandbook_data
     */
    static public function create($dishesId, $cookTimes = 1)
    {
        $ins = new self();
        $ins->set_dishesId($dishesId);
        $ins->addCookTimes($cookTimes);

        return $ins;

    }

}