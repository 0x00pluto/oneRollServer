<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/2/3
 * Time: 上午11:47
 */

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_player;

/**
 * 创建角色服务
 * Class service_createrole
 * @package service
 */
class service_createrole extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'createrole',
        ));
    }

    /**
     * @inheritDoc
     */
    function isNeedRole()
    {
        return false;
    }


    /**
     * 创建角色
     * @param string $rolename 角色名称
     * @param int $sex 性别 0男1女
     * @return Common_Util_ReturnVar
     */
    public function createrole($rolename, $sex)
    {
        typeCheckString($rolename, 16, 2);
        typeCheckNumber($sex, 0, 1);
        $returnData = $this->callerUserInstance->db_role()->createrole($rolename, $sex);
        if ($returnData->is_succ()) {
            $newPlayer = dbs_player::newGuestPlayerWithLock($this->callerUserid);
            $newPlayer->db_role()->set_sex($sex);

        }
        return $returnData;
    }
}