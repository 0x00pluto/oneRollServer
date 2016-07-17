<?php

namespace dbs;

use Common\Db\Common_Db_mongo;
use Common\Util\Common_Util_Time;
use dbs\i\dbs_i_iday;
use dbs\templates\shop\dbs_templates_shop_shopItemLimitData;

/**
 * 商店道具限制信息
 * Class dbs_shopitem
 * @package dbs
 */
class dbs_shopitem extends dbs_templates_shop_shopItemLimitData implements dbs_i_iday
{

    function __construct()
    {
        parent::__construct(self::DBKey_tablename);
        $this->set_primary_key([self::DBKey_mallid]);
    }

    /**
     * 增加到每日出售数量
     * @param $num
     */
    public function addServerDailySellCount($num)
    {
        $num = intval($num);
        $this->set_serverDailySellCount($this->get_serverDailySellCount() + $num);
    }

    public function addServerTotalSellCount($num)
    {
        $num = intval($num);
        $this->set_serverTotalSellCount($this->get_serverTotalSellCount() + $num);
    }

    public function nextday()
    {
        if ($this->get_dayFlag() != Common_Util_Time::getGameDay()) {
            $this->reset_serverDailySellCount();
            $this->set_dayFlag(Common_Util_Time::getGameDay());
        }
    }

    /**
     * create...
     * @param $mallId
     * @return dbs_shopitem
     */
    public static function create($mallId)
    {
        $ins = new self();
        $ins->set_dayFlag(Common_Util_Time::getGameDay());
        $ins->set_mallid($mallId);
        return $ins;
    }

    /**
     * @inheritDoc
     */
    protected function loadFromDBAfter(Common_Db_mongo $db)
    {
        $this->nextday();
    }


}