<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/3/1
 * Time: 下午12:15
 */

namespace dbs\item;


use constants\constants_itemFromInfo;
use dbs\templates\item\dbs_templates_item_itemFromInfo;

class dbs_item_fromInfo extends dbs_templates_item_itemFromInfo
{
    /**
     * @inheritDoc
     */
    protected function _set_defaultvalue_FromType()
    {
        $this->set_defaultkeyandvalue(self::DBKey_FromType, constants_itemFromInfo::FROM_INVALID);
    }

}