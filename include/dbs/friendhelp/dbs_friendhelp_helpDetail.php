<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/2
 * Time: 下午2:53
 */

namespace dbs\friendhelp;


use dbs\templates\friendhelp\dbs_templates_friendhelp_helpDetailData;

/**
 * 单次帮忙的详细数据
 * Class dbs_friendhelp_helpDetail
 * @package dbs\friendhelp
 */
class dbs_friendhelp_helpDetail extends dbs_templates_friendhelp_helpDetailData
{
    /**
     * @param string $helperUserId 帮忙者的用户实例
     * @param int $helpTimes 帮忙次数
     * @return dbs_friendhelp_helpDetail
     */
    public static function create($helperUserId, $helpTimes = 1)
    {
        $ins = new self();
        $ins->set_userid($helperUserId);
        $ins->set_helpTimes($helpTimes);
        $ins->set_helpTimespan(time());
        return $ins;
    }
}