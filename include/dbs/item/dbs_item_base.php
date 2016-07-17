<?php

namespace dbs\item;

use dbs\templates\item\dbs_templates_item_itemData;

/**
 * 道具基础类
 *
 * @author zhipeng
 *
 */
abstract class dbs_item_base extends dbs_templates_item_itemData
{

    function __construct($itemId = '', $num = 0)
    {
        parent::__construct([]);
        $this->set_itemid($itemId);
        $this->set_num($num);
    }
}