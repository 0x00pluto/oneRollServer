<?php

namespace dbs\thirdparty;

use Common\Util\Common_Util_String;
use Common\Util\Common_Util_Guid;
use Common\Util\Common_Util_ReturnVar;
use err\err_dbs_thirdparty_default_delete;
use constants\constants_returnkey;

/**
 */
class dbs_thirdparty_default extends dbs_thirdparty_base
{
    /**
     *
     * {@inheritDoc}
     *
     * @see \dbs\thirdparty\dbs_thirdparty_base::create()
     */
    public function create($username, $password, $thirdpartytype, $specialUserid = NULL, $linkuserid = NULL)
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array();


        $username = Common_Util_String::trimAll($username);
        if (empty ($username) || strlen($username) > 128
            || strlen($username) < 5
        ) {
            $retCode = 3;
            goto failed;
        }

        if ($username == "02:00:00:00:00:00") {
            $retCode = 1;
            goto failed;
        }

        $account = dbs_thirdparty_userinfo::getByUserNameAndThirdPartyId($username, $thirdpartytype);

        // 用户已经存在
        if ($account->exist()) {
            $data = $account;
            $retCode = 2;
            goto failed;
        } else {

            if (is_null($specialUserid)) {
                $account->set_userid(Common_Util_Guid::gen_userid());
            } else {
                $account->set_userid($specialUserid);
            }
            $account->set_username($username);
            $account->set_password(md5($username . $password));
            $account->set_thirdpartytype($thirdpartytype);
        }

        if (!empty($linkuserid)) {
            $account->set_link_userid($linkuserid);
        }

        $account->saveToDB(true);

        $data = $account;

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    public function login($username, $password, $thirdpartytype)
    {
        $retCode = 0;
        $data = array();
        $retCodeArr = array(
            'usernameOrPasswordError' => 1
        );

        $account = dbs_thirdparty_userinfo::login($username, $password, $thirdpartytype);
        if (!$account->exist()) {
            $retCode = $retCodeArr ['usernameOrPasswordError'];
            goto failed;
        }

        $data ['userinfo'] = $account;
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data);
    }

    /**
     * (non-PHPdoc)
     *
     * @see dbs_thirdparty_base::delete()
     */
    function delete($username, $password, $thirdpartytype)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_thirdparty_default_delete{}

        $username = strval($username);
        $password = strval($password);
        $account = dbs_thirdparty_userinfo::login($username, $password, $thirdpartytype);

        if (!$account->exist()) {
            $retCode = err_dbs_thirdparty_default_delete::usernameOrPasswordError;
            $retCode_Str = 'usernameOrPasswordError';
            goto failed;
        }
        $account->removeFromDB();
        $data [constants_returnkey::RK_USERINFO] = $account;

        // 删除关联账号
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}