<?php

namespace dbs;

use Common\Util\Common_Util_Guid;
use Common\Util\Common_Util_ReturnVar;
use dbs\friend\dbs_friend_recommenddata;
use dbs\templates\account\dbs_templates_account_account;

class dbs_account extends dbs_templates_account_account
{

    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);

        $this->set_primary_key([self::DBKey_username]);

        // 建立索引
        $this->ensureIndex(array(
            self::DBKey_username => 1,
            self::DBKey_password => 1
        ));

    }


    /**
     * 通过UserId获取账号
     * @param $userid
     * @return dbs_account
     */
    public static function getByUserId($userid)
    {

        $ins = self::findOrNew([self::DBKey_userid => $userid]);
        return $ins;
    }

    static $RetCode_Create_Account = array(
        'OK' => 0,
        'USERNAME_DUPLICATE' => 1,
        'PARAMS_ERROR' => 2,
        'USERNAME_OR_PASSWORD_CANNOT_EMPTY' => 3
    );

    /**
     * 创建账号
     *
     * @param string $username
     *            用户名
     * @param string $password
     *            密码
     * @param string $userid
     *            用户id,可以为空
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function create_account($username, $password, $userid = '')
    {
        $succ = true;
        $code = dbs_account::$RetCode_Create_Account ['OK'];
        $username = strval($username);
        $password = strval($password);

        if (empty ($username) || empty ($password)) {
            $succ = false;
            $code = dbs_account::$RetCode_Create_Account ['USERNAME_OR_PASSWORD_CANNOT_EMPTY'];
            goto end;
        }

        if (!empty ($userid)) {
            $where = [
                '$or' => [
                    [
                        self::DBKey_username => $username
                    ],
                    [
                        self::DBKey_userid => $userid
                    ]
                ]
            ];
        } else {
            $where = array(
                self::DBKey_username => $username
            );
        }
        $ret = $this->db_connect()->query($this->get_tablename(), $where);
        // 用户名重复
        if (count($ret) != 0) {
            $succ = false;
            $code = dbs_account::$RetCode_Create_Account ['USERNAME_DUPLICATE'];
            goto end;
        }

        $this->set_username($username);
        $this->set_password($password);
        if (empty ($userid)) {
            $userid = Common_Util_Guid::gen_userid();
        }
        $this->set_userid($userid);

        $this->set_ctl_code(0);

        $this->saveToDB(true);
        end:
        return Common_Util_ReturnVar::Ret($succ, $code);
    }

    /**
     * 删除账号
     */
    public function delete()
    {

        $this->set_isdelete(true);

        $player = dbs_player::newGuestPlayer($this->get_userid());

        //标记推荐数据此用户删除
        dbs_friend_recommenddata::createWithPlayer($player)->set_isDeleteAccount(true);

    }

    protected function onLoadingFromDB($db)
    {
        $ret = $db->query($this->get_tablename(), array(
            self::DBKey_username => $this->get_username(),
            self::DBKey_password => $this->get_password()
        ));
        if (count($ret) != 0) {
            $this->fromDBData($ret [0]);
        }
    }
}