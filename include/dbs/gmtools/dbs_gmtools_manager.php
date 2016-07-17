<?php

namespace dbs\gmtools;

use Common\Util\Common_Util_ReturnVar;
use constants\constants_moneychangereason;
use dbs\dbs_player;
use dbs\dbs_warehouse;
use dbs\recharge\dbs_recharge_player;
use dbs\serverstatus\dbs_serverstatus_manager;
use err\err_dbs_gmtools_manager_addDiamondAndGameCoin;
use err\err_dbs_gmtools_manager_addItem;
use err\err_dbs_gmtools_manager_addrestaurantexp;
use err\err_dbs_gmtools_manager_recharge;
use err\err_dbs_gmtools_manager_reduceDiamondAndGameCoin;
use err\err_dbs_gmtools_manager_serverClose;
use err\err_dbs_gmtools_manager_serverOpen;
use utilphp\util;
use dbs\notice\dbs_notice_planemanager;
use dbs\mailbox\dbs_mailbox_list;
use dbs\mailbox\dbs_mailbox_data;

/**
 * 管理员工具
 *
 * @author zhipeng
 *
 */
class dbs_gmtools_manager
{
    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
        // echo 'This is a Constructed method;';
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    /**
     *
     * @return \dbs\gmtools\dbs_gmtools_manager
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof static)) {
            self::$_instance = new static ();
        }
        return self::$_instance;
    }

    /**
     * 是否允许访问
     *
     * @return boolean
     */
    protected function isAllowip()
    {
        $alldatas = dbs_gmtools_allowips::all([
            dbs_gmtools_allowips::DBKey_ipaddress => util::get_client_ip()
        ]);

        return count($alldatas) != 0;
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
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_gmtools_manager_addDiamondAndGameCoin{}

        $userid = strval($userid);
        $diamond = intval($diamond);
        $gamecoin = intval($gamecoin);
        // code

        if (!$this->isAllowip()) {
            $retCode = err_dbs_gmtools_manager_addDiamondAndGameCoin::NOT_ALLOW_IP;
            $retCode_Str = 'NOT_ALLOW_IP';
            goto failed;
        }

        $player = dbs_player::newGuestPlayerWithLock($userid);
        if (!$player->isRoleExists()) {
            $retCode = err_dbs_gmtools_manager_addDiamondAndGameCoin::DEST_USER_NOT_EXISTS;
            $retCode_Str = 'DEST_USER_NOT_EXISTS';
            goto failed;
        }
        if ($diamond < 0) {
            $retCode = err_dbs_gmtools_manager_addDiamondAndGameCoin::DIAMOND_NUM_ERROR;
            $retCode_Str = 'DIAMOND_NUM_ERROR';
            goto failed;
        }

        if ($gamecoin < 0) {
            $retCode = err_dbs_gmtools_manager_addDiamondAndGameCoin::GAMECOIN_NUM_ERROR;
            $retCode_Str = 'GAMECOIN_NUM_ERROR';
            goto failed;
        }

        $player->db_role()->add_gamecoin_and_diamonds($gamecoin, $diamond, constants_moneychangereason::ADD_BY_GM);

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 减少钻石和游戏币
     *
     * @param string $userid 用户id
     * @param int $diamond
     *            钻石数量
     * @param int $gamecoin
     *            游戏币数量
     * @return Common_Util_ReturnVar
     */
    function reduceDiamondAndGameCoin($userid, $diamond, $gamecoin)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_gmtools_manager_reduceDiamondAndGameCoin{}

        $userid = strval($userid);
        $diamond = intval($diamond);
        $gamecoin = intval($gamecoin);

        if (!$this->isAllowip()) {
            $retCode = err_dbs_gmtools_manager_reduceDiamondAndGameCoin::NOT_ALLOW_IP;
            $retCode_Str = 'NOT_ALLOW_IP';
            goto failed;
        }

        $player = dbs_player::newGuestPlayerWithLock($userid);
        if (!$player->isRoleExists()) {
            $retCode = err_dbs_gmtools_manager_reduceDiamondAndGameCoin::DEST_USER_NOT_EXISTS;
            $retCode_Str = 'DEST_USER_NOT_EXISTS';
            goto failed;
        }
        if ($diamond < 0) {
            $retCode = err_dbs_gmtools_manager_reduceDiamondAndGameCoin::DIAMOND_NUM_ERROR;
            $retCode_Str = 'DIAMOND_NUM_ERROR';
            goto failed;
        }

        if ($gamecoin < 0) {
            $retCode = err_dbs_gmtools_manager_reduceDiamondAndGameCoin::GAMECOIN_NUM_ERROR;
            $retCode_Str = 'GAMECOIN_NUM_ERROR';
            goto failed;
        }
        $player->db_role()->cost_gamecoin($gamecoin, constants_moneychangereason::REDUCE_BY_GM);
        $player->db_role()->cost_diamond($diamond, constants_moneychangereason::REDUCE_BY_GM);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
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
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_gmtools_manager_addrestaurantexp{}

        $userid = strval($userid);
        $exp = intval($exp);

        if (!$this->isAllowip()) {
            $retCode = err_dbs_gmtools_manager_addrestaurantexp::NOT_ALLOW_IP;
            $retCode_Str = 'NOT_ALLOW_IP';
            goto failed;
        }

        $player = dbs_player::newGuestPlayerWithLock($userid);
        if (!$player->isRoleExists()) {
            $retCode = err_dbs_gmtools_manager_addrestaurantexp::DEST_USER_NOT_EXISTS;
            $retCode_Str = 'DEST_USER_NOT_EXISTS';
            goto failed;
        }

        $player->db_restaurantinfo()->addrestaurantexp($exp);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 开启服务器
     */
    function serverOpen()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_gmtools_manager_serverOpen{}
        if (!$this->isAllowip()) {
            $retCode = err_dbs_gmtools_manager_serverOpen::NOT_ALLOW_IP;
            $retCode_Str = 'NOT_ALLOW_IP';
            goto failed;
        }
        // code

        dbs_serverstatus_manager::getInstance()->serverOpen();

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 关闭服务器
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function serverClose()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_gmtools_manager_serverClose{}
        if (!$this->isAllowip()) {
            $retCode = err_dbs_gmtools_manager_serverClose::NOT_ALLOW_IP;
            $retCode_Str = 'NOT_ALLOW_IP';
            goto failed;
        }
        // code
        dbs_serverstatus_manager::getInstance()->serverClose();
        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 获取所有公告
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function noticePlaneGetAll()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_gmtools_manager_noticePlaneGetAll{}
        if (!$this->isAllowip()) {
            $retCode = err_dbs_gmtools_manager_serverClose::NOT_ALLOW_IP;
            $retCode_Str = 'NOT_ALLOW_IP';
            goto failed;
        }
        return dbs_notice_planemanager::getInstance()->getall();
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
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
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();

        // class err_dbs_gmtools_manager_sendSystemEmail{}
        $mail = dbs_mailbox_data::create($title, $content);
        return dbs_mailbox_list::sendGlobalMail($mail);

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 删除全局邮件
     *
     * @param unknown $mailid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function removeSystemEmail($mailid)
    {
        return dbs_mailbox_list::removeGlobalMail($mailid);
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
        $data = [];
        //interface err_dbs_gmtools_manager_addItem

        typeCheckUserId($userId);
        typeCheckNumber($itemId);
        typeCheckNumber($itemCount, 1);

        $player = dbs_player::newGuestPlayerWithLock($userId);
        logicErrorCondition($player->isRoleExists(),
            err_dbs_gmtools_manager_addItem::DEST_USER_NOT_EXISTS,
            "DEST_USER_NOT_EXISTS");


        logicErrorCondition(dbs_warehouse::additemtowarehouse($player, $itemId, $itemCount, true),
            err_dbs_gmtools_manager_addItem::ITEM_ADD_ERROR,
            "ITEM_ADD_ERROR");;
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * @param $userId
     * @param $goodsId
     * @return Common_Util_ReturnVar
     */
    public function recharge($userId, $goodsId)
    {
        $data = [];
        //interface err_dbs_gmtools_manager_recharge

        typeCheckUserId($userId);
        typeCheckString($goodsId);

        $player = dbs_player::newGuestPlayerWithLock($userId);

        logicErrorCondition($player->isRoleExists(),
            err_dbs_gmtools_manager_recharge::DEST_USER_NOT_EXISTS,
            "DEST_USER_NOT_EXISTS");

        $rechargeCode = dbs_recharge_player::createWithPlayer($player)->recharge($goodsId);
        logicErrorCondition($rechargeCode->is_succ(), err_dbs_gmtools_manager_recharge::RECHARGE_PROCESS_ERROR,
            "RECHARGE_PROCESS_ERROR",
            $rechargeCode->get_retdata());
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }
}