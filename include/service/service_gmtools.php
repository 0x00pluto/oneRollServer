<?php

namespace service;

use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_serverVersion;
use dbs\dbs_account;
use dbs\dbs_player;
use dbs\gmtools\dbs_gmtools_manager;
use dbs\thirdparty\dbs_thirdparty_userinfo;
use err\err_service_gmtools_killPlayer;
use servicemiddle\servicemiddle_gmallowip;
use dbs\mailbox\dbs_mailbox_list;
use dbs\serverstatus\dbs_serverstatus_manager;

/**
 * 游戏管理工具
 * @auther zhipeng
 */
class service_gmtools extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'addDiamondAndGameCoin',
            'reduceDiamondAndGameCoin',
            'addrestaurantexp',
            'getinfo',
            'serverOpen',
            'serverClose',
            'getServerState',
            'noticePlaneGetAll',
            'sendSystemEmail',
            'removeSystemEmail',
            'getSystemEmails',
            'addItem',
            'killPlayer',
            'recharge',
            'getServerDetails'

        ));

        $this->exportForLuaCode = false;
    }

    public function isNeedLogin()
    {
        return false;
    }

    protected function get_dbins()
    {
        return dbs_gmtools_manager::getInstance();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_gmtools_manager" . "_";
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \service\service_base::configure()
     */
    protected function configure()
    {
        $this->registerMiddleWare(new servicemiddle_gmallowip ());
    }

    /**
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_gmtools_getinfo{}

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 增加钻石和游戏币
     *
     * @param string $userid ;
     * @param integer $diamond
     * @param integer $gamecoin
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function addDiamondAndGameCoin($userid, $diamond, $gamecoin)
    {
        typeCheckUserId($userid);
        typeCheckNumber($diamond, 0);
        typeCheckNumber($gamecoin, 0);

        return $this->get_dbins()->addDiamondAndGameCoin($userid, $diamond, $gamecoin);
    }

    /**
     * 减少钻石和游戏币
     *
     * @param string $userid 用户idf
     * @param int $diamond
     *            钻石数量
     * @param int $gamecoin
     *            游戏币数量
     * @return Common_Util_ReturnVar
     */
    function reduceDiamondAndGameCoin($userid, $diamond, $gamecoin)
    {
        typeCheckUserId($userid);
        typeCheckNumber($diamond, 0);
        typeCheckNumber($gamecoin, 0);
        return $this->get_dbins()->reduceDiamondAndGameCoin($userid, $diamond, $gamecoin);
    }

    /**
     * 增加餐厅经验
     *
     * @param unknown $userid
     * @param unknown $exp
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function addrestaurantexp($userid, $exp)
    {
        typeCheckUserId($userid);
        typeCheckNumber($exp, 0);

        return $this->get_dbins()->addrestaurantexp($userid, $exp);
    }

    /**
     * 开启服务器
     */
    function serverOpen()
    {
        return $this->get_dbins()->serverOpen();
    }

    /**
     * 关闭服务器
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function serverClose()
    {
        return $this->get_dbins()->serverClose();
    }

    /**
     * 获取服务器状态
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getServerState()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_gmtools_getServerState{}

        $data = dbs_serverstatus_manager::getInstance()->getServerState();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取服务器详细信息
     * @return Common_Util_ReturnVar
     */
    public function getServerDetails()
    {
        $data = [];
        //interface err_service_gmtools_getServerDetail

        
        $data["SERVER_VERSION"] = constants_serverVersion::VERSION;
        $data["SUPPORT_MIN_CLIENT_VERSION"] = constants_serverVersion::SUPPORT_MIN_CLIENT_VERSION;
        $data['CSV_VERSION'] = Common_Util_Configdata::getInstance()->getConfigSetting("ResourceCheckCode")->
        string_value();


        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取所有公告
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function noticePlaneGetAll()
    {
        return $this->get_dbins()->noticePlaneGetAll();
    }

    /**
     * 发送系统邮件
     *
     * @param string $title
     *            标题
     * @param string $content
     *            内容
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function sendSystemEmail($title, $content)
    {
        typeCheckString($title);
        typeCheckString($content);
        return $this->get_dbins()->sendSystemEmail($title, $content);
    }

    /**
     * 删除全局邮件
     *
     * @param string $mailid 邮件ID
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function removeSystemEmail($mailid)
    {
        typeCheckGUID($mailid);

        return $this->get_dbins()->removeSystemEmail($mailid);
    }

    /**
     * 获取全部系统邮件
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getSystemEmails()
    {
        return dbs_mailbox_list::getGlobalMails();
    }

    /**
     * 添加道具
     * @param $userId
     * @param $itemId
     * @param $itemCount
     * @return Common_Util_ReturnVar
     */
    public function addItem($userId, $itemId, $itemCount)
    {
        return $this->get_dbins()->addItem($userId, $itemId, $itemCount);
    }

    /**
     * 删除用户
     * @param $userId
     * @return Common_Util_ReturnVar
     */
    public function killPlayer($userId)
    {
        $data = [];
        //interface err_service_gmtools_killPlayer

        $thirdPartyUserInfo = dbs_thirdparty_userinfo::getByLinkUserid($userId);

        logicErrorCondition(!is_null($thirdPartyUserInfo),
            err_service_gmtools_killPlayer::USERID_INVALID,
            "USERID_INVALID");

        $account = dbs_account::getByUserId($userId);
        logicErrorCondition($account->exist(),
            err_service_gmtools_killPlayer::USERID_INVALID,
            "USERID_INVALID");
        //删除渠道信息
        $thirdPartyUserInfo->removeFromDB();
        //删除账号信息
        $account->delete();


        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 充值接口
     * @param $userId
     * @param $goodsId
     * @return Common_Util_ReturnVar
     */
    public function recharge($userId, $goodsId)
    {
        return $this->get_dbins()->recharge($userId, $goodsId);
    }
}