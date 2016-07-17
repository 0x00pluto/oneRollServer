<?php

namespace dbs\item\uselogic;

use configdata\configdata_item_uselogic_setting;
use dbs\dbs_item;
use configdata\configdata_item_setting;
use dbs\dbs_player;

/**
 * 使用逻辑工厂
 *
 * @author zhipeng
 *
 */
class dbs_item_uselogic_factory
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

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }

    /**
     * 道具是否可用
     *
     * @param string $itemid
     * @return bool
     */
    public function canUse($itemid)
    {
        $useconfig = dbs_item_uselogic_base::get_logicconfig($itemid);
        if (is_null($useconfig)) {
            return false;
        }

        $itemconfig = dbs_item::getInstance()->getItemConfig($itemid);
        $usestate = intval($itemconfig [configdata_item_setting::k_usestate]);
        return $usestate == 1;
    }

    /**
     * 使用道具
     * @param $itemId
     * @param dbs_player $player
     * @param array $Options
     * @return bool|mixed
     */
    public function useItem($itemId, dbs_player $player, array $Options)
    {
        $useConfig = dbs_item_uselogic_base::get_logicconfig($itemId);
        if (is_null($useConfig)) {
            return false;
        }
        if (!$this->canUse($itemId)) {
            return false;
        }

        $logicId = $useConfig [configdata_item_uselogic_setting::k_uselogicid];

        $params = [];
        if (isset ($useConfig [configdata_item_uselogic_setting::k_useparam0])) {
            $params [] = $useConfig [configdata_item_uselogic_setting::k_useparam0];
        }
        if (isset ($useConfig [configdata_item_uselogic_setting::k_useparam1])) {
            $params [] = $useConfig [configdata_item_uselogic_setting::k_useparam1];
        }
        if (isset ($useConfig [configdata_item_uselogic_setting::k_useparam2])) {
            $params [] = $useConfig [configdata_item_uselogic_setting::k_useparam2];
        }
        if (isset ($useConfig [configdata_item_uselogic_setting::k_useparam3])) {
            $params [] = $useConfig [configdata_item_uselogic_setting::k_useparam3];
        }

        //具体的使用逻辑
        $logicImp = $this->builder($logicId);
        if (null === $logicImp) {
            return false;
        }
        $logicImp->setUseItemId($itemId);
        return $logicImp->useitem($player, $params, $Options);
    }

    /**
     * builder...
     *
     * @param string $logicid
     * @return dbs_item_uselogic_base|NULL
     */
    private function builder($logicid)
    {

        $className = __NAMESPACE__ . "\\dbs_item_uselogic_logic" . $logicid;
        if (class_exists($className)) {
            return new $className ();
        }

        return null;
    }
}