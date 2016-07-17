<?php

namespace dbs\item;

use configdata\configdata_item_setting;
use constants\constants_item;
use dbs\dbs_item;
use dbs\templates\item\dbs_templates_item_normal;

/**
 * 通用道具
 *
 * @author zhipeng
 *
 */
class dbs_item_normal extends dbs_templates_item_normal
{
    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_itemFromInfo()
    {
        $this->set_defaultkeyandvalue(self::DBKey_itemFromInfo, dbs_item_fromInfo::dumpDefaultValue());
    }


    /**
     * dbs_item_normal constructor.
     * @param string $itemId 道具ID
     * @param int $num 道具数量
     */
    function __construct($itemId = '', $num = 0)
    {
        parent::__construct();
        $this->set_itemid($itemId);
        $this->set_num($num);
    }


    /**
     * 获取道具配置
     * @return null
     */
    function getItemConfig()
    {
        return dbs_item::getInstance()->getItemConfig($this->get_itemid());
    }

    /**
     * 是否是时装
     * @return bool
     */
    function isFashionDress()
    {
        $itemConfig = $this->getItemConfig();
        return $itemConfig[configdata_item_setting::k_maintype] === constants_item::ITEM_TYPE_FASHION_DRESS;
    }

    /**
     * 设置来源信息
     * @param $fromType
     * @param array $fromData
     */
    public function setFromInfo($fromType, array $fromData = [])
    {
        $from = dbs_item_fromInfo::create_with_array([]);
        $from->set_FromType($fromType);
        $from->set_FromInfo($fromData);
        $this->set_itemFromInfo($from->toArray());
    }


}