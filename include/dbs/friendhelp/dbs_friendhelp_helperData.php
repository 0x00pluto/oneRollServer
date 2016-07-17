<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/2
 * Time: 下午2:52
 */

namespace dbs\friendhelp;


use dbs\dbs_player;
use dbs\filters\dbs_filters_role;
use dbs\templates\friendhelp\dbs_templates_friendhelp_helperData;

/**
 * 用户帮忙数据
 * Class dbs_friendhelp_helperData
 * @package dbs\friendhelp
 */
class dbs_friendhelp_helperData extends dbs_templates_friendhelp_helperData
{
    /**
     *
     * @param string $helperUserId 帮忙者的用户实例ID
     * @param int $helpTimes 帮忙次数 0 为不增加
     * @return dbs_friendhelp_helperData
     */
    public static function create($helperUserId, $helpTimes = 0)
    {
        $ins = new self();
        $ins->set_userid($helperUserId);
        $ins->set_userinfo(dbs_filters_role::getNormalInfo(dbs_player::newGuestPlayer($helperUserId)));
        if ($helpTimes !== 0) {
            $ins->addHelpDetail($helpTimes);
        }

        return $ins;

    }

    /**
     * 增加帮忙详情
     * @param int $helpTimes
     */
    public function addHelpDetail($helpTimes = 1)
    {
        $helpDetail = dbs_friendhelp_helpDetail::create($this->get_userid(), $helpTimes);

        //设置帮忙次数
        $this->set_helpTimes($this->get_helpTimes() + $helpTimes);
        //设置帮助详情
        $helpDetails = $this->get_helpDetails();

        $helpDetails[] = $helpDetail->toArray();
        $this->set_helpDetails($helpDetails);
    }
}