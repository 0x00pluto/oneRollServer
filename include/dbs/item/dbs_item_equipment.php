<?php

namespace dbs\item;

use dbs\chef\dbs_chef_property;
use dbs\dbs_equipment;
use configdata\configdata_item_equipment_setting;

/**
 * 装备数据
 *
 * @author zhipeng
 *
 */
class dbs_item_equipment extends dbs_chef_property
{
    /**
     * 道具实例
     *
     * @var dbs_item_normal
     */
    private $item_ins = null;

    /**
     * 获取道具实例
     *
     * @return dbs_item_normal
     */
    public function get_item_ins()
    {
        return $this->item_ins;
    }

    /**
     * 装备信息常量
     *
     * @var string
     */
    const DBKey_equipmentinfo = "equipmentinfo";

    /**
     * 装备等级
     *
     * @var string
     */
    const DBKey_level = "level";

    /**
     * 获取 装备等级
     */
    public function get_level()
    {
        return $this->getdata(self::DBKey_level);
    }

    /**
     * 设置 装备等级
     *
     * @param unknown $value
     */
    public function set_level($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_level, $value);
    }

    /**
     * 装备的厨师id
     *
     * @var string
     */
    const DBKey_putonchefid = "putonchefid";

    /**
     * 获取 装备的厨师id
     */
    public function get_putonchefid()
    {
        return $this->getdata(self::DBKey_putonchefid);
    }

    /**
     * 设置 装备的厨师id
     *
     * @param string $value
     */
    public function set_putonchefid($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_putonchefid, $value);
    }

    /**
     * 绑定的厨师id
     *
     * @var string
     */
    const DBKey_bindchefid = "bindchefid";

    /**
     * 获取 绑定的厨师id
     */
    public function get_bindchefid()
    {
        return $this->getdata(self::DBKey_bindchefid);
    }

    /**
     * 设置 绑定的厨师id
     *
     * @param unknown $value
     */
    public function set_bindchefid($value)
    {
        $value = strval($value);
        $this->setdata(self::DBKey_bindchefid, $value);
    }

    /**
     * 升级花费的游戏币
     *
     * @var string
     */
    const DBKey_upgradecostgamecoin = "upgradecostgamecoin";

    /**
     * 获取 升级花费的游戏币
     */
    public function get_upgradecostgamecoin()
    {
        return $this->getdata(self::DBKey_upgradecostgamecoin);
    }

    /**
     * 设置 升级花费的游戏币
     *
     * @param unknown $value
     */
    public function set_upgradecostgamecoin($value)
    {
        $value = intval($value);
        $this->setdata(self::DBKey_upgradecostgamecoin, $value);
    }

    /**
     * 增加装备价值
     *
     * @param unknown $value
     */
    public function add_upgradecostgamecoin($value)
    {
        $value = intval($value);
        $this->set_upgradecostgamecoin($this->get_upgradecostgamecoin() + $value);
    }

    function __construct(dbs_item_normal $item)
    {
        $this->item_ins = $item;
        parent::__construct(array(
            self::DBKey_level => 1,
            self::DBKey_putonchefid => '',
            self::DBKey_bindchefid => '',
            self::DBKey_upgradecostgamecoin => 0
        ));

        $this->load();
    }

    /**
     * 通过道具数据创建道具
     *
     * @param array $itemdata
     * @return dbs_item_equipment
     */
    static function create_with_itemdata(array $itemdata)
    {
        $itemnormal = new dbs_item_normal ();
        $itemnormal->fromArray($itemdata);
        $ins = new self ($itemnormal);
        return $ins;
    }

    /**
     * 是否已经穿上
     */
    function is_puton()
    {
        return !empty ($this->get_putonchefid());
    }

    /**
     * 根据等级计算属性
     */
    function compute()
    {
        $cookingability = 0;
        $chinesefood = 0;
        $westernfood = 0;
        $japensefood = 0;
        $frenchfood = 0;
        $ideafood = 0;

        $equipmentconfig = dbs_equipment::get_equipmentsetting($this->item_ins->get_itemid());
        if (is_null($equipmentconfig)) {
            return;
        }
        $addlevel = $this->get_level() - 1;

        // 厨艺
        $basevalue = intval($equipmentconfig [configdata_item_equipment_setting::k_cookingability]);
        $addvalue = intval($equipmentconfig [configdata_item_equipment_setting::k_cookingabilityaddvalue]);
        $cookingability = $basevalue + $addlevel * $addvalue;

        // 中餐
        $basevalue = intval($equipmentconfig [configdata_item_equipment_setting::k_chinesefood]);
        $addvalue = intval($equipmentconfig [configdata_item_equipment_setting::k_chinesefoodaddvalue]);
        $chinesefood = $basevalue + $addlevel * $addvalue;

        // 西餐
        $basevalue = intval($equipmentconfig [configdata_item_equipment_setting::k_westernfood]);
        $addvalue = intval($equipmentconfig [configdata_item_equipment_setting::k_westernfoodaddvalue]);
        $westernfood = $basevalue + $addlevel * $addvalue;

        // 日料
        $basevalue = intval($equipmentconfig [configdata_item_equipment_setting::k_japenesefood]);
        $addvalue = intval($equipmentconfig [configdata_item_equipment_setting::k_japenesefoodaddvalue]);
        $japensefood = $basevalue + $addlevel * $addvalue;

        // 法餐
        $basevalue = intval($equipmentconfig [configdata_item_equipment_setting::k_frenchfood]);
        $addvalue = intval($equipmentconfig [configdata_item_equipment_setting::k_frenchfoodaddvalue]);
        $frenchfood = $basevalue + $addlevel * $addvalue;

        // 创意
        $basevalue = intval($equipmentconfig [configdata_item_equipment_setting::k_ideafood]);
        $addvalue = intval($equipmentconfig [configdata_item_equipment_setting::k_ideafoodaddvalue]);
        $ideafood = $basevalue + $addlevel * $addvalue;

        $this->set_cookingability($cookingability);
        $this->set_chinesefood($chinesefood);
        $this->set_westernfood($westernfood);
        $this->set_japenesefood($japensefood);
        $this->set_frenchfood($frenchfood);
        $this->set_ideafood($ideafood);

        $this->save();
    }


    /**
     * 加载数据
     */
    protected function load()
    {
        $extendinfo = $this->item_ins->get_extendinfo();
//        dump($extendinfo);
//        dump($this->item_ins);
        if (array_key_exists_faster(self::DBKey_equipmentinfo, $extendinfo)) {
            $equipmentinfo = $extendinfo [self::DBKey_equipmentinfo];
            $this->fromArray($equipmentinfo);
            // dump ( $extendinfo );
            $this->compute();
        } else {
            $this->compute();
            $this->save();
        }
    }

    /**
     * 保存数据
     */
    protected function save()
    {
        $extendinfo = $this->item_ins->get_extendinfo();
        $extendinfo [self::DBKey_equipmentinfo] = $this->toArray();
        $this->item_ins->set_extendinfo($extendinfo);
    }
}

