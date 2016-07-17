<?php

namespace dbs\item\uselogic;

use Common\Util\Common_Util_Configdata;
use configdata\configdata_item_setting;
use configdata\configdata_item_uselogic_setting;
use dbs\dbs_player;

abstract class dbs_item_uselogic_base
{
    /**
     * 当前使用的道具ID
     * @var
     */
    private $useItemId;

    /**
     * @return mixed
     */
    public function getUseItemId()
    {
        return $this->useItemId;
    }

    /**
     * @param mixed $useItemId
     */
    public function setUseItemId($useItemId)
    {
        $this->useItemId = $useItemId;
    }

    /**
     * 获取逻辑id
     */
    abstract public function get_logicid();

    /**
     * 使用道具
     * @param dbs_player $player
     * @param array $useparams 使用道具配置,从道具使用效果表里面读出来
     * @param array $Options 使用道具的额外参数
     * @return bool
     */
    abstract public function useitem($player, array $useparams, array $Options);

    /**
     * 获取逻辑操作配置
     *
     * @param string $itemid
     * @return Ambigous <\Common\Util\multitype:, string>
     */
    static function get_logicconfig($itemid)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_item_uselogic_setting::class, configdata_item_uselogic_setting::k_id, $itemid);
    }

    /**
     * 获取道具基础配置
     * @param $itemId
     * @return null
     */
    static function getItemConfig($itemId)
    {
        return getConfigData(configdata_item_setting::class,
            configdata_item_setting::k_id,
            $itemId);
    }
}