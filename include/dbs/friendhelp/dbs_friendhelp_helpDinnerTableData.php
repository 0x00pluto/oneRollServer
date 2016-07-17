<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/2
 * Time: 下午5:28
 */

namespace dbs\friendhelp;


use dbs\templates\friendhelp\dbs_templates_friendhelp_helpDinnerTableData;

class dbs_friendhelp_helpDinnerTableData extends dbs_templates_friendhelp_helpDinnerTableData
{
    /**
     * @param int $themeRestaruantId 主题餐厅ID
     * @param string $dinnerTableId 餐台的ID
     * @return dbs_friendhelp_helpDinnerTableData
     */
    public static function create($themeRestaruantId, $dinnerTableId)
    {
        $ins = new self();
        $ins->set_themeRestaurantId($themeRestaruantId);
        $ins->set_buildingId($dinnerTableId);

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