<?php

namespace err;

class err_dbs_role_getuseridbyrolename
{
    const ROLENAME_ERR = 1;
    const NOT_FOUND_ROLENAME = 2;
}

class err_dbs_role_createrole
{
    /**
     * 用户名错误
     *
     */
    const ROLE_NAME_INVALID = 1;
    /**
     * 角色已经存在
     *
     */
    const ROLENAME_EXIST = 2;
    /**
     * 已经存在角色
     *
     */
    const EXISTS_ROLE = 3;
}

class err_dbs_role_changerolename
{
    const ROLENAME_EXIST = 1;
    /**
     * 超过最大字符数
     *
     */
    const ROLE_NAME_INVALID = 2;

    /**
     * 相同的角色名称
     *
     */
    const SAME_ROLENAME = 3;
}