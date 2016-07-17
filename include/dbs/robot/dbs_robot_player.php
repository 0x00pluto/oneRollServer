<?php

namespace dbs\robot;

use dbs\chef\dbs_chef_list;
use dbs\chef\jobs\dbs_chef_jobs_player;
use dbs\dbs_role;
use dbs\dbs_userkvstore;
use dbs\templates\robot\dbs_templates_robot_player;

/**
 * 机器人数据
 * 2015年5月22日 上午11:31:35
 *
 * @author zhipeng
 *
 */
class dbs_robot_player extends dbs_templates_robot_player
{
    use dbs_robot_logicTrait;
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }


    /**
     * 标记是机器人
     */
    public function mark_is_robot()
    {
        $this->set_isrobot(true);
    }

    /**
     * 获取编号
     *
     * @return number
     */
    public function getcode()
    {
        return crc32($this->get_userid());
    }

    /**
     * 是否可以被帮忙嫁接
     */
    public function isCanHelpedItemgraft()
    {
        if($this->get_isrobot())
        {
            return false;
        }
//        return true;
        if(time() - $this->get_helpItemgraftLastTime() >
            getGlobalValue("ROBOT_HELP_ITEMGRAFT_INTERVAL")->int_value())
        {
            return true;
        }
        return false;
    }

    /**
     * 标记被忙吗
     */
    public function markHelpedItemgraft()
    {
        $this->set_helpItemgraftLastTime(time());
    }


    const Key_HelpedTrainChef = "dbs_robot_player_markHelpedTrainChef";

    /**
     *
     */
    public function markHelpedTrainChef()
    { 
        dbs_userkvstore::createWithPlayer($this)->setvalue(self::Key_HelpedTrainChef,time());
    }

    /**
     * 是否可以接受机器人双休
     * @return bool
     */
    public function isCanHelpedTrainChef()
    {
        if($this->get_isrobot())
        {
            return false;
        }

        $helpTime = dbs_userkvstore::createWithPlayer($this)->getvalue(self::Key_HelpedTrainChef,0);
        if(time() - $helpTime >
            getGlobalValue("ROBOT_HELP_TRAINCHEF_INTERVAL")->int_value())
        {
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function processRobotLogic(dbs_robot_data $robotData)
    {
        //处理角色
        dbs_role::createWithPlayer($this->db_owner)->processRobotLogic($robotData);
        //处理厨师
        dbs_chef_list::createWithPlayer($this->db_owner)->processRobotLogic($robotData);
        //处理职业
        dbs_chef_jobs_player::createWithPlayer($this->db_owner)->processRobotLogic($robotData);

    }

}