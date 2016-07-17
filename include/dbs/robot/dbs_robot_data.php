<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/5/11
 * Time: 下午4:38
 */

namespace dbs\robot;


use Common\Util\Common_Util_Random;
use configdata\configdata_robot_scene_group_setting;
use configdata\configdata_robot_scene_template_setting;
use dbs\dbs_player;
use dbs\dbs_restaurantinfo;
use dbs\templates\robot\dbs_templates_robot_robotData;

class dbs_robot_data extends dbs_templates_robot_robotData
{

    /**
     * dbs_robot_data constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->set_tablename(self::DBKey_tablename);
        $this->set_primary_key([self::DBKey_robotUserId]);
        $this->setAutoSave(false);
    }

    /**
     * @param $userId
     * @return static
     */
    public static function getRobotData($userId)
    {
        $ins = self::findOrNew([self::DBKey_robotUserId=>$userId]);
//        dump($ins);
        if(!$ins->exist())
        {
            $ins->set_robotUserId($userId);
        }
        return $ins;
    }

    /**
     * 代理场景的用户ID
     */
    public function getAgentSceneUserId()
    {
//        $this->reRollAgentSceneUserId();
        $agentUserId = $this->get_agentSceneUserId();
        if(empty($agentUserId))
        {
            $agentUserId = $this->reRollAgentSceneUserId();
        }
        return $agentUserId;
    }

    /**
     * 重新获取代理场景用户ID
     * @return string
     */
    public function reRollAgentSceneUserId()
    {
//        $agentUserId = "userid-0b5553bd-fcf6-69c9-482c-0eff6db1019f";

        $robotPlayer = dbs_player::newGuestPlayer($this->get_robotUserId());

        $restaurantLevel = dbs_restaurantinfo::createWithPlayer($robotPlayer)->get_restaurantlevel();

        $groupId = null;
        foreach (configdata_robot_scene_group_setting::data() as $data)
        {
            if($restaurantLevel>= intval($data[configdata_robot_scene_group_setting::k_levelmin]) &&
                $restaurantLevel < intval($data[configdata_robot_scene_group_setting::k_levelmax]))
            {
                $groupId = $data[configdata_robot_scene_group_setting::k_groupid];
            }
        }
        assert(!is_null($groupId));

        $userIds = [];
        foreach (configdata_robot_scene_template_setting::data() as $data)
        {
            if($data[configdata_robot_scene_template_setting::k_groupid])
            {
                $userIds[] = $data[configdata_robot_scene_template_setting::k_templateuserid];
            }
        }

        $agentUserId = Common_Util_Random::RandomWithSameWeight($userIds);

        $this->set_agentSceneUserId($agentUserId);
        $this->saveToDB();
        return $agentUserId;
    }


}