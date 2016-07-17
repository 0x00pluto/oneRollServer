<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/2
 * Time: 下午6:21
 */

namespace dbs\friendhelp;


use dbs\templates\friendhelp\dbs_templates_friendhelp_helpExpandData;

class dbs_friendhelp_helpExpandData extends dbs_templates_friendhelp_helpExpandData
{
    /**
     * @param int $themeRestaruantId 主题餐厅ID
     * @return dbs_friendhelp_helpExpandData
     */
    public static function create($themeRestaruantId)
    {
        $ins = new self();
        $ins->set_themeRestaurantId($themeRestaruantId);

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