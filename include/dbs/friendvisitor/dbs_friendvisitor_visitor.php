<?php

namespace dbs\friendvisitor;

use dbs\dbs_baseplayer;
use dbs\dbs_player;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_ReturnVar;
use constants\constants_mission;
use err\err_dbs_friendvisitor_visitor_visit;

/**
 * 访客
 * 2015年7月8日 下午12:08:39
 *
 * @author zhipeng
 *
 */
class dbs_friendvisitor_visitor extends dbs_baseplayer
{

    /**
     * 访客列表
     *
     * @var string
     */
    const DBKey_visitors = "visitors";

    /**
     * 获取 访客列表
     */
    public function get_visitors()
    {
        return $this->getdata(self::DBKey_visitors);
    }

    /**
     * 设置 访客列表
     *
     * @param unknown $value
     */
    public function set_visitors($value)
    {
        // $value = strval($value);
        $this->setdata(self::DBKey_visitors, $value);
    }

    /**
     * 设置 访客列表 默认值
     */
    protected function _set_defaultvalue_visitors()
    {
        $this->set_defaultkeyandvalue(self::DBKey_visitors, array());
    }

    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "friendvisitor";

    function __construct()
    {
        parent::__construct(self::DBKey_tablename);
    }

    /**
     * 添加访问者
     *
     * @param unknown $userid
     */
    private function addvisitor($userid)
    {
        $userid = strval($userid);
        $data = dbs_friendvisitor_data::create($userid);
        $visitors = $this->get_visitors();
        foreach ($visitors as $key => $value) {
            if ($value [dbs_friendvisitor_data::DBKey_userid] == $userid) {
                unset ($visitors [$key]);
                break;
            }
        }

        array_unshift($visitors, $data->toArray());

        $maxcount = Common_Util_Configdata::getInstance()->get_global_config_value('FIREND_VISITOR_MAX_COUNT')->int_value();
        while (count($visitors) > $maxcount) {
            array_pop($visitors);
        }

        $this->set_visitors($visitors);
    }

    /**
     * 访问
     *
     * @param unknown $destUserid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function visit($destUserid)
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_dbs_friendvisitor_visit{}
        $destUserid = strval($destUserid);
        if ($destUserid == $this->get_userid()) {
            $retCode = err_dbs_friendvisitor_visitor_visit::CANNOT_VISITOR_SELF;
            $retCode_Str = 'CANNOT_VISITOR_SELF';
            goto failed;
        }

        $destPlayer = dbs_player::newGuestPlayerWithLock($destUserid);
        if (!$destPlayer->isRoleExists()) {
            $retCode = err_dbs_friendvisitor_visitor_visit::DEST_USER_NOT_EXIST;
            $retCode_Str = 'DEST_USER_NOT_EXIST';
            goto failed;
        }

        $destPlayer->dbs_friendvisitor_visitor()->addvisitor($this->get_userid());

        $this->db_owner->db_mission()->set_mission_object(constants_mission::MISSION_FINISH_CONDITION_73, 1);
        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }
}