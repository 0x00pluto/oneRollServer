<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/23
 * Time: 上午11:59
 */

namespace dbs\item;


use Common\Util\Common_Util_Bit;
use configdata\configdata_item_fashion_dress_setting;
use configdata\configdata_item_fashion_dress_type_setting;
use dbs\templates\item\dbs_templates_item_fashionDress;
use interfaces\dbs\item\dbs_item_extendInfo;

/**
 * 时装道具
 * Class dbs_item_fashionDress
 * @package dbs\item
 */
class dbs_item_fashionDress extends dbs_templates_item_fashionDress
{
    use dbs_item_extendInfo;
    /**
     * 道具实例
     * @var dbs_item_normal
     */
    private $itemInstance;
    /**
     * 时装配置
     * @var
     */
    private $fashionDressConfig;

    /**
     * 属性关键字
     * @return string
     */
    public function getPropertyKey()
    {
        return "fashionDress";
    }

    /**
     * 获取原本道具数据
     * @return dbs_item_normal
     */
    public function getItem()
    {
        return $this->itemInstance;
    }

    /**
     * 设置道具
     * @param dbs_item_normal $item
     */
    public function setItem(dbs_item_normal $item)
    {
        $this->itemInstance = $item;

        $this->fashionDressConfig = getConfigData(configdata_item_fashion_dress_setting::class,
            configdata_item_fashion_dress_setting::k_id,
            $item->get_itemid());

        $this->load();
    }

    /**
     * 时装是否过期
     * @return bool
     */
    public function isExpired()
    {
        if ($this->get_isUsed()) {
            return time() > $this->get_expiredTime();
        }
        return false;
    }

    /**
     * 设置被使用
     */
    public function setUsed()
    {
        if ($this->get_isUsed()) {
            return;
        }
        $this->set_isUsed(true);
        $this->set_expiredTime(time() +
            intval($this->fashionDressConfig[configdata_item_fashion_dress_setting::k_periodvalid]));
    }

    /**
     * 获得扩展位置类型,除了自己的主要位置
     * @return array
     */
    public function getExternalPositionTypes()
    {
        $typeValue = intval($this->fashionDressConfig[configdata_item_fashion_dress_setting::k_typevalue]);
        $mainType = intval($this->fashionDressConfig[configdata_item_fashion_dress_setting::k_maintype]);
        $types = [];
        foreach (configdata_item_fashion_dress_type_setting::data() as $data) {
            $type = intval($data[configdata_item_fashion_dress_type_setting::k_type]);
            if ($mainType !== $type &&
                Common_Util_Bit::has($typeValue, $type)
            ) {
                $types[] = $data[configdata_item_fashion_dress_type_setting::k_typename];
            }
        }
        return $types;
    }

    /**
     * 获取所有位置信息
     * @return array
     */
    public function getAllPositionTypes()
    {
        $typeValue = intval($this->fashionDressConfig[configdata_item_fashion_dress_setting::k_typevalue]);
        $types = [];
        foreach (configdata_item_fashion_dress_type_setting::data() as $data) {
            $type = intval($data[configdata_item_fashion_dress_type_setting::k_type]);
            if (Common_Util_Bit::has($typeValue, $type)) {
                $types[] = $data[configdata_item_fashion_dress_type_setting::k_typename];
            }
        }
        return $types;
    }

    /**
     * 获取主要类型
     * @return null
     */
    public function getMainType()
    {
        $typeConfig = getConfigData(configdata_item_fashion_dress_type_setting::class,
            configdata_item_fashion_dress_type_setting::k_type,
            $this->fashionDressConfig[configdata_item_fashion_dress_setting::k_maintype]);
        if (is_null($typeConfig)) {
            return null;
        }
        return $typeConfig[configdata_item_fashion_dress_type_setting::k_typename];
    }

    /**
     * 通过道具创建
     * @param dbs_item_normal $item
     * @return dbs_item_fashionDress
     */
    static function create(dbs_item_normal $item)
    {
        $ins = new self();
        $ins->setItem($item);

        //修正数据
        if ($ins->get_isPutOn() == true && $ins->get_isUsed() == false) {
            $ins->setUsed();
            $ins->save();
        }
        return $ins;
    }

    /**
     * 通过道具数据创建
     * @param array $itemData
     * @return dbs_item_fashionDress
     */
    static function createByItemData(array $itemData)
    {
        $item = dbs_item_normal::create_with_array($itemData);
        return self::create($item);
    }


}