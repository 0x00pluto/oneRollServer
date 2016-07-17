<?php

namespace dbs\pve\data;

use dbs\dbs_basedatacell;
use configdata\configdata_pve_base_setting;
use Common\Util\Common_Util_Configdata;
use Common\Util\Common_Util_Time;

class dbs_pve_data_ticket extends dbs_basedatacell
{
    static function get_ticket_conf($restaruantlevel)
    {
        return Common_Util_Configdata::getInstance()->getconfigdata(configdata_pve_base_setting::class, configdata_pve_base_setting::k_restaruantlevel, $restaruantlevel);
    }

    /**
     * 当前拥有的数量
     *
     * @var string
     */
    const DBKey_num = "num";

    /**
     * 获取 当前拥有的数量
     */
    public function get_num()
    {
        return $this->getdata(self::DBKey_num);
    }

    /**
     * 设置 当前拥有的数量
     *
     * @param unknown $value
     */
    public function set_num($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_num, $value);
    }

    /**
     * 设置 当前拥有的数量 默认值
     */
    protected function _set_defaultvalue_num()
    {
        $this->set_defaultkeyandvalue(self::DBKey_num, 60);
    }

    /**
     * 最大数量
     *
     * @var string
     */
    const DBKey_max = "max";

    /**
     * 获取 最大数量
     */
    public function get_max()
    {
        return $this->getdata(self::DBKey_max);
    }

    /**
     * 设置 最大数量
     *
     * @param unknown $value
     */
    public function set_max($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_max, $value);
    }

    /**
     * 设置 最大数量 默认值
     */
    protected function _set_defaultvalue_max()
    {
        $this->set_defaultkeyandvalue(self::DBKey_max, 60);
    }

    /**
     * 上次恢复的时间
     *
     * @var string
     */
    const DBKey_lastrechargetime = "lastrechargetime";

    /**
     * 获取 上次恢复的时间
     */
    public function get_lastrechargetime()
    {
        return $this->getdata(self::DBKey_lastrechargetime);
    }

    /**
     * 设置 上次恢复的时间
     *
     * @param unknown $value
     */
    public function set_lastrechargetime($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_lastrechargetime, $value);
    }

    /**
     * 设置 上次恢复的时间 默认值
     */
    protected function _set_defaultvalue_lastrechargetime()
    {
        $this->set_defaultkeyandvalue(self::DBKey_lastrechargetime, 0);
    }

    /**
     * 日期标识
     *
     * @var string
     */
    const DBKey_dayflag = "dayflag";

    /**
     * 获取 日期标识
     */
    public function get_dayflag()
    {
        return $this->getdata(self::DBKey_dayflag);
    }

    /**
     * 设置 日期标识
     *
     * @param unknown $value
     */
    public function set_dayflag($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_dayflag, $value);
    }

    /**
     * 设置 日期标识 默认值
     */
    protected function _set_defaultvalue_dayflag()
    {
        $this->set_defaultkeyandvalue(self::DBKey_dayflag, 0);
    }

    /**
     * 今日购买邀请票的次数
     *
     * @var string
     */
    const DBKey_todaybuytickettimes = "todaybuytickettimes";

    /**
     * 获取 今日购买邀请票的次数
     */
    public function get_todaybuytickettimes()
    {
        return $this->getdata(self::DBKey_todaybuytickettimes);
    }

    /**
     * 设置 今日购买邀请票的次数
     *
     * @param unknown $value
     */
    public function set_todaybuytickettimes($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_todaybuytickettimes, $value);
    }

    /**
     * 设置 今日购买邀请票的次数 默认值
     */
    protected function _set_defaultvalue_todaybuytickettimes()
    {
        $this->set_defaultkeyandvalue(self::DBKey_todaybuytickettimes, 0);
    }

    function __construct()
    {
        parent::__construct(array());
    }

    /**
     * 下一天
     *
     * @return boolean
     */
    function nextday()
    {
        $day = $this->get_dayflag();
        if ($day == Common_Util_Time::getGameDay()) {
            return false;
        }

        $this->set_dayflag(Common_Util_Time::getGameDay());
        $this->set_todaybuytickettimes(0);
        $this->set_lastrechargetime(0);

        if ($this->get_num() < $this->get_max()) {
            $this->set_num($this->get_max());
        }

        return true;
    }

    function computetickets($restaruantlevel)
    {
        $config = self::get_ticket_conf($restaruantlevel);

        $ticketmax = $config [configdata_pve_base_setting::k_ticketmax];
        if ($ticketmax != $this->get_max()) {
            $this->set_max($ticketmax);
        }

        if ($this->get_num() >= $this->get_max()) {
            return false;
        }

        $filltimespace = Common_Util_Configdata::getInstance()->get_global_config_value('PVE_TICKET_RECHRAGE_TIME')->int_value();
        $filltickets = (time() - $this->get_lastrechargetime()) / $filltimespace;
        $filltickets = floor($filltickets);
        // 不够一次票据补充
        if ($filltickets == 0) {
            return false;
        }

        // 只能恢复到最大体力
        $filltickets = min($filltickets, $this->get_max() - $this->get_num());

        $this->addticket($filltickets);

        if ($this->get_num() < $this->get_max()) {
            // 处理不够时间间隔的剩余时间
            $losttime = (time() - $this->get_lastrechargetime()) % $filltimespace;
            $this->set_lastrechargetime(time() - $losttime);
        }
        return TRUE;
    }

    /**
     * 是否已满
     *
     * @return boolean
     */
    public function isfull()
    {
        return $this->get_num() >= $this->get_max();
    }

    public function buyticket($tickets)
    {
        $this->addticket($tickets);
        $this->set_todaybuytickettimes($this->get_todaybuytickettimes() + 1);
    }

    /**
     * 增加邀请卷
     *
     * @param unknown $tickets
     * @return boolean
     */
    public function addticket($tickets)
    {
        $tickets = intval($tickets);
        if ($tickets <= 0) {
            return false;
        }

        $this->set_num($this->get_num() + $tickets);
        return true;
    }

    /**
     * 花费邀请卷
     *
     * @param unknown $tickets
     * @return boolean
     */
    public function costticket($tickets)
    {
        $tickets = intval($tickets);
        if ($tickets <= 0) {
            return false;
        }

        if ($tickets > $this->get_num()) {
            return false;
        }

        $this->set_num($this->get_num() - $tickets);

        if ($this->get_num() < $this->get_max()) {
            if ($this->get_lastrechargetime() == 0) {
                $this->set_lastrechargetime(time());
            }
        }
        return true;
    }
}