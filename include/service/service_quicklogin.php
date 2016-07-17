<?php

namespace service;

use dbs\dbs_thirdparty;
use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_account;
use dbs\dbs_role;
use dbs\thirdparty\dbs_thirdparty_userinfo;
use constants\constants_returnkey;
use dbs\dbs_player;
use Common\Db\Common_Db_pools;
use err\err_service_quicklogin_delete;

/**
 * 快速登陆接口
 *
 * @author zhipeng
 *
 */
class service_quicklogin extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'thirdpartycreate',
            'thirdpartylogin',
            'delete'
        ));

        $this->addFunctions(array(
            'get_verify',
            'get_userid_byverify'
        ), true);
    }

    function isNeedLogin()
    {
        return false;
    }

    /**
     * 第三方平台账号创建
     *
     * @param string $username
     * @param string $password
     * @param int $thirdpartytype
     * @return Common_Util_ReturnVar
     */
    public function thirdpartycreate($username, $password, $thirdpartytype = 0)
    {

        typeCheckString($username, 128, 2);
        typeCheckString($password, 128, 6);
        typeCheckNumber($thirdpartytype);

        $RetCode = 0;
        $data = array();
        $RetCodeArr = array(
            'RetCode_Succ' => 0,
            'RetCode_PlatFormId_Error' => 1,
            'RetCode_createAccountFailed' => 2
        );

        $partymanager = dbs_thirdparty::getInstance($thirdpartytype);
        if (is_null($partymanager)) {
            $RetCode = $RetCodeArr ['RetCode_PlatFormId_Error'];
            goto failed;
        }

        $ret = $partymanager->create($username, $password, $thirdpartytype);
        if (!Common_Util_ReturnVar::isSucc($ret)) {
            $RetCode = $RetCodeArr ['RetCode_createAccountFailed'];
            goto failed;
        }
        /**
         *
         * @var dbs_thirdparty_userinfo
         */
        $thirdUserInfo = Common_Util_ReturnVar::getdata($ret);
        if ($thirdUserInfo instanceof dbs_thirdparty_userinfo) {
            // 创建本地关联账号
            $local_account = new dbs_account ();
            $local_account->create_account(
                $thirdUserInfo->get_link_username(),
                $thirdUserInfo->get_link_password(),
                $thirdUserInfo->get_link_userid());
        }

        succ:
        return Common_Util_ReturnVar::Ret(true, $RetCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $RetCode, $data);
    }

    /**
     * 本地第三方登录
     *
     * @param string $username
     * @param string $password
     * @param number $thirdpartytype
     */
    public function thirdpartylogin($username, $password, $thirdpartytype)
    {
        typeCheckString($username, 128, 2);
        typeCheckString($password, 128, 6);
        typeCheckNumber($thirdpartytype);

        $retCode = 0;
        $data = array();
        $retCodeArr = array(
            'AccessTokenError' => 1,
            'getUserInfoError' => 2,
            'ServerIDError' => 3
        );

        // dump(configdata_arena_award_setting::data());
        // code
        $partymanager = dbs_thirdparty::getInstance($thirdpartytype);
        if (is_null($partymanager)) {
            $retCode = $retCodeArr ['ServerIDError'];
            goto failed;
        }

        $ret = $partymanager->login($username, $password, $thirdpartytype);
        if (!Common_Util_ReturnVar::isSucc($ret)) {
            $retCode = $retCodeArr ['getUserInfoError'];
            goto failed;
        }
        $retdata = $ret->get_retdata();
        /**
         * @var $accountdata dbs_thirdparty_userinfo
         */
        $accountdata = $retdata ['userinfo'];
        $data [constants_returnkey::RK_VERIFY] = dbs_player::addUseridToCache($accountdata->get_link_userid());

        $userid = $accountdata->get_link_userid();

        $db_account = dbs_account::getByUserId($userid);
        $data [constants_returnkey::RK_EXISTS_ACCOUNT] = $db_account->exist();

        $role = dbs_role::findOrNew([dbs_role::DBKey_userid => $userid]);
        $data [constants_returnkey::RK_EXISTS_ROLE] = $role->exist();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * 删除账号
     *
     * @param string $username
     *            用户名
     * @param string $password
     *            密码
     * @param string $thirdpartytype
     *            平台类型
     * @return Common_Util_ReturnVar
     */
    function delete($username, $password, $thirdpartytype)
    {
        typeCheckString($username, 128, 2);
        typeCheckString($password, 128, 6);
        typeCheckNumber($thirdpartytype);

        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_quicklogin_delete{}

        $username = strval($username);
        $password = strval($password);
        $thirdpartytype = intval($thirdpartytype);
        // code
        $partyManager = dbs_thirdparty::getInstance($thirdpartytype);
        if (is_null($partyManager)) {
            $retCode = err_service_quicklogin_delete::ServerIDError;
            $retCode_Str = 'ServerIDError';
            goto failed;
        }

        $ret = $partyManager->delete($username, $password, $thirdpartytype);
        if ($ret->is_succ()) {
            /**
             *
             * @var dbs_thirdparty_userinfo
             */
            $thirdPartyUserInfo = $ret->get_retdata() [constants_returnkey::RK_USERINFO];

            if ($thirdPartyUserInfo instanceof dbs_thirdparty_userinfo) {
                $local_account = dbs_account::getByUserId($thirdPartyUserInfo->get_link_userid());
                if ($local_account->exist()) {
                    $local_account->delete();
                }
                // 清除verify
                dbs_player::removeVerifyFromUserid($thirdPartyUserInfo->get_link_userid());
            }
        }
        return $ret;

        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 测试方法,获取verify 通过linkuserid
     *
     * @param unknown $linkuserid
     * @return Common_Util_ReturnVar
     */
    function get_verify($linkuserid)
    {
        typeCheckUserId($linkuserid);
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_quicklogin_get_verify{}

        $data [constants_returnkey::RK_VERIFY] = dbs_player::getVerifyFromUserid($linkuserid);

        // dump ( $this->service_list );
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    function get_userid_byverify($verify)
    {
        typeCheckGUID($verify);
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_quicklogin_get_userid_byverify{}

        $userid = dbs_player::getUseridFromCache($verify);
        $data [constants_returnkey::RK_USERID] = dbs_player::getUseridFromCache($verify);
        // code

        $accountinfo = dbs_thirdparty_userinfo::getByLinkUserid($data [constants_returnkey::RK_USERID]);
        $data [constants_returnkey::RK_USERINFO] = $accountinfo->toArray();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     *
     * @return Common_Util_ReturnVar
     */
    function update()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_quicklogin_update{}

        // code
        $db = Common_Db_pools::default_Db_pools()->dbconnect();
        $ret = $db->query(dbs_thirdparty_userinfo::DBKey_tablename);
        // dump ( $ret );
        foreach ($ret as $dbarr) {
            // dump ( $dbarr );
            if (!array_key_exists_faster('password_bak', $dbarr)) {

                $dbarr ['password_bak'] = $dbarr [dbs_thirdparty_userinfo::DBKey_password];
                unset ($dbarr ['_id']);
                $dbarr [dbs_thirdparty_userinfo::DBKey_password] = md5($dbarr [dbs_thirdparty_userinfo::DBKey_username] . $dbarr [dbs_thirdparty_userinfo::DBKey_password]);

                // dump ( $dbarr );
                $db->update(dbs_thirdparty_userinfo::DBKey_tablename, $dbarr, array(
                    dbs_thirdparty_userinfo::DBKey_userid => $dbarr [dbs_thirdparty_userinfo::DBKey_userid]
                ));
            }
            // dump ( $dbarr );
            // break;
        }

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}