<?php

namespace dbs\filters;

use dbs\dbs_player;
use dbs\dbs_role;

class dbs_filters_role
{
    public function __construct()
    {
    }

    /**
     * 简要信息
     *
     * @var array
     */
    static $filters_simple_info = array(
        dbs_role::DBKey_userid,
        dbs_role::DBKey_rolename,
        dbs_role::DBKey_headiconurl,

        dbs_role::DBKey_sex
    );

    /**
     * 简要信息
     *
     * @var unknown
     */
    static $filters_lookup_blocked_info = array(
        dbs_role::DBKey_gamecoin,
        dbs_role::DBKey_diamond,
        dbs_role::DBKey_gmlevel,

        dbs_role::DBKey_create_time,
        dbs_role::DBKey_addgamecoins,
        dbs_role::DBKey_continuelogin,

        dbs_role::DBKey_reputationAmount,
        dbs_role::DBKey_reputation,
    );

    /**
     * 非常简要信息,只包含一点点
     * @param dbs_role|dbs_player $role
     * @return array
     */
    static function getVerySimpleInfo($role)
    {
        if ($role instanceof dbs_role) {
            return $role->toArray(self::$filters_simple_info);
        } elseif ($role instanceof dbs_player) {
            return dbs_role::createWithPlayer($role)->toArray(self::$filters_simple_info);
        }
        return [];
    }

    /**
     * 获得比较详细信息,不包含敏感信息
     * @param dbs_role|dbs_player|mixed $role
     * @return array
     */
    static function getNormalInfo($role)
    {
        if ($role instanceof dbs_role) {
            return $role->toArray([], self::$filters_lookup_blocked_info);
        } elseif ($role instanceof dbs_player) {
            return dbs_role::createWithPlayer($role)->toArray([], self::$filters_lookup_blocked_info);
        }
        return [];
    }
}