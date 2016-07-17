<?php

namespace dbs\vip;

use dbs\base\dbs_base_level;
use dbs\dbs_basedatacell;
use dbs\dbs_vip;

class dbs_vip_data extends dbs_basedatacell
{

    use dbs_base_level;
    /**
     * vip经验
     *
     * @var string
     */
    const DBKey_vipexp = "vipexp";

    /**
     * 获取 vip经验
     */
    public function get_vipexp()
    {
        return $this->getdata(self::DBKey_vipexp);
    }

    /**
     * 设置 vip经验
     *
     * @param unknown $value
     */
    public function set_vipexp($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_vipexp, $value);
    }

    /**
     * 设置 vip经验 默认值
     */
    protected function _set_defaultvalue_vipexp()
    {
        $this->set_defaultkeyandvalue(self::DBKey_vipexp, 0);
    }

    /**
     * vip总校验
     *
     * @var string
     */
    const DBKey_viptotalexp = "viptotalexp";

    /**
     * 获取 vip总校验
     */
    public function get_viptotalexp()
    {
        return $this->getdata(self::DBKey_viptotalexp);
    }

    /**
     * 设置 vip总校验
     *
     * @param int $value
     */
    public function set_viptotalexp($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_viptotalexp, $value);
    }

    /**
     * 设置 vip总校验 默认值
     */
    protected function _set_defaultvalue_viptotalexp()
    {
        $this->set_defaultkeyandvalue(self::DBKey_viptotalexp, 0);
    }

    /**
     * vip等级
     *
     * @var string
     */
    const DBKey_viplevel = "viplevel";

    /**
     * 获取 vip等级
     */
    public function get_viplevel()
    {
        return $this->getdata(self::DBKey_viplevel);
    }

    /**
     * 设置 vip等级
     *
     * @param unknown $value
     */
    public function set_viplevel($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_viplevel, $value);
    }

    /**
     * 设置 vip等级 默认值
     */
    protected function _set_defaultvalue_viplevel()
    {
        $this->set_defaultkeyandvalue(self::DBKey_viplevel, 0);
    }

    protected function _get_exp()
    {
        return $this->get_vipexp();
    }

    protected function _set_exp($value)
    {
        $this->set_vipexp($value);
    }

    protected function _get_level()
    {
        return $this->get_viplevel();
    }

    protected function _set_level($value)
    {
        $this->set_viplevel($value);
    }

    protected function _get_totalexp()
    {
        return $this->get_viptotalexp();
    }

    protected function _set_totalexp($value)
    {
        $this->set_viptotalexp($value);
    }

    protected function _get_levelup_config($level)
    {
        return dbs_vip::get_upgrade_config($level);
    }

    public function addvipexp($exp)
    {
        return $this->addexp($exp);
    }

    public function set_level_force($newlevel)
    {
        return $this->_set_level_force($newlevel);
    }

    function __construct()
    {
        parent::__construct(array());
    }
}