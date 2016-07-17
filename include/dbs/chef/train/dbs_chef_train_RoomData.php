<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/24
 * Time: 下午5:43
 */

namespace dbs\chef\train;


use dbs\templates\chef\dbs_templates_chef_trainserviceTrainData;

class dbs_chef_train_RoomData extends dbs_templates_chef_trainserviceTrainData
{
    /**
     * 通过请求创建数据
     * @param dbs_chef_train_RoomRequestData $request
     * @return dbs_chef_train_RoomData
     */
    static function createWithRequestData(dbs_chef_train_RoomRequestData $request)
    {
        $ins = new self();
        $ins->set_userid($request->get_userid());
        $ins->set_userinfo($request->get_userinfo());
        $ins->set_chefid($request->get_chefid());
        $ins->set_chefinfo($request->get_chefinfo());

        return $ins;
    }
}