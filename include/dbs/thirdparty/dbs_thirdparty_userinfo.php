<?php

namespace dbs\thirdparty;

use Common\Db\Common_Db_pools;
use Common\Util\Common_Util_Guid;
use dbs\templates\thirdParty\dbs_templates_thirdParty_userInfo;

class dbs_thirdparty_userinfo extends dbs_templates_thirdParty_userInfo
{
    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_link_userid()
    {
        $this->set_defaultkeyandvalue(self::DBKey_link_userid, Common_Util_Guid::gen_userid());
    }

    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_link_username()
    {
        $this->set_defaultkeyandvalue(self::DBKey_link_username, Common_Util_Guid::gen_userid());

    }

    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_link_password()
    {
        $this->set_defaultkeyandvalue(self::DBKey_link_password, Common_Util_Guid::gen_password());

    }


    public function __construct()
    {
        parent::__construct(self::DBKey_tablename, [],
            [self::DBKey_userid]
        );

        $this->ensureIndex(array(
            self::DBKey_username => 1,
            self::DBKey_thirdpartytype => 1
        ));
        $this->ensureIndex(array(
            self::DBKey_username => 1,
            self::DBKey_password => 1,
            self::DBKey_thirdpartytype => 1
        ));
        $this->ensureIndex(array(
            self::DBKey_link_userid => 1
        ));
    }

    protected function onLoadingFromDB($db)
    {
        $ret = $db->query($this->get_tablename(), [
            self::DBKey_username => $this->get_username(),
            self::DBKey_password => $this->get_password(),
            self::DBKey_thirdpartytype => $this->get_thirdpartytype()
        ]);

        if (count($ret) != 0) {
            $this->fromDBData($ret [0]);
        }
    }

    /**
     * 通过用户名加载用户实例
     *
     * @param string $username
     * @param $thirdPartyId
     * @return dbs_thirdparty_userinfo
     */
    static public function getByUserNameAndThirdPartyId($username, $thirdPartyId)
    {
        $username = strval($username);
        $thirdPartyId = intval($thirdPartyId);

        $ins = self::findOrNew(
            [
                self::DBKey_username => $username,
                self::DBKey_thirdpartytype => $thirdPartyId
            ]);
        return $ins;

    }

    /**
     * 通过linkuserid创建实例
     *
     * @param string $userid
     * @return NULL|dbs_thirdparty_userinfo
     */
    public static function getByLinkUserid($userid)
    {
        $ins = self::findOrNew([self::DBKey_link_userid => $userid]);
        if (!$ins->exist()) {
            return null;
        }
        return $ins;
    }

    /**
     * 通过用户名密码登陆
     *
     * @param string $username
     * @param string $password
     * @return dbs_thirdparty_userinfo
     */
    static public function login($username, $password, $thirdpartytype)
    {
        $username = strval($username);
        $password = strval($password);
        $password_md5 = md5($username . $password);
        $thirdpartytype = intval($thirdpartytype);

        $ins = self::findOrNew([
            self::DBKey_username => $username,
            self::DBKey_password => $password_md5,
            self::DBKey_thirdpartytype => $thirdpartytype
        ]);

        return $ins;
    }

    /**
     * 根据数据创建实例
     */
    public function create($userid, $username, $password, $thirdpartytype, $link_userid, $link_username, $link_password)
    {
        $userid = strval($userid);
        $username = strval($username);
        $password = strval($password);
        $password_md5 = md5($username . $password);
        $thirdpartytype = intval($thirdpartytype);
        $link_userid = strval($link_userid);
        $link_username = strval($link_username);
        $link_password = strval($link_password);

        $where = array();

        $where [] = array(
            self::DBKey_userid => $userid
        );

        $where [] = array(
            self::DBKey_username => $username,
            self::DBKey_password => $password_md5,
            self::DBKey_thirdpartytype => $thirdpartytype
        );

        $where [] = array(
            self::DBKey_link_userid => $link_userid
        );
        $where [] = array(
            self::DBKey_link_username => $link_username
        );

        $retCount = Common_Db_pools::default_Db_pools()->dbconnect()->count($this->get_tablename(),
            [
                '$or' => $where
            ]);
        if ($retCount > 0) {
            return false;
        }

        $this->set_userid($userid);
        $this->set_username($username);
        $this->set_password($password_md5);
        $this->set_thirdpartytype($thirdpartytype);
        $this->set_link_userid($link_userid);
        $this->set_link_username($link_username);
        $this->set_link_password($link_password);

        $this->saveToDB(true);

        return true;
    }


}
