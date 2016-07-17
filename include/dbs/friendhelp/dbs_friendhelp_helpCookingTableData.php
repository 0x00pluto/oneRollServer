<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/2
 * Time: 下午2:53
 */

namespace dbs\friendhelp;


use dbs\templates\friendhelp\dbs_templates_friendhelp_helpCookingTableData;

/**
 * 帮忙做菜数据
 * Class dbs_friendhelp_helpCookingTableData
 * @package dbs\friendhelp
 */
class dbs_friendhelp_helpCookingTableData extends dbs_templates_friendhelp_helpCookingTableData
{

    /**
     * @param int $themeRestaruantId 主题餐厅ID
     * @param string $cookingTableId 烹饪台的ID
     * @return dbs_friendhelp_helpCookingTableData
     */
    public static function create($themeRestaruantId, $cookingTableId)
    {
        $ins = new self();
        $ins->set_themeRestaurantId($themeRestaruantId);
        $ins->set_buildingId($cookingTableId);

        return $ins;
    }

    /**
     * 增加帮忙数据
     * @param string $helperUserId 帮忙者的用户ID
     * @param $times
     */
    public function addHelpData($helperUserId, $times)
    {
        $helpers = $this->get_helpers();

        if (isset($helpers[$helperUserId])) {
            $helperData = dbs_friendhelp_helperData::create_with_array($helpers[$helperUserId]);
        } else {
            $helperData = dbs_friendhelp_helperData::create($helperUserId);
        }
        $helperData->addHelpDetail($times);

        $helpers[$helperUserId] = $helperData->toArray();
        $this->set_helpers($helpers);

    }
}