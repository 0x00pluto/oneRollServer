<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\dbs_item;

/**
 * 道具服务
 *
 * @author zhipeng
 *
 */
class service_item extends service_base
{
    function __construct()
    {
        $this->addFunctions([
            'useitem',
            'useitemarg1',
            'useItemToAddGraftWeight'
        ]);
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_item_";
    }

    /**
     * 使用道具
     *
     * @param $itemid
     * @param $num
     * @return Common_Util_ReturnVar
     */
    function useitem($itemid, $num)
    {
        typeCheckString($itemid);
        typeCheckNumber($num, 1);
        return dbs_item::getInstance()->useitem($this->callerUserInstance, $itemid, $num);
    }

    /**
     * 使用道具,追加1个参数
     * @param $itemid
     * @param $num
     * @param $arg1
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function useitemarg1($itemid, $num, $arg1)
    {
        typeCheckString($itemid);
        typeCheckNumber($num, 1);

        return dbs_item::getInstance()->useitemWithOptions($this->callerUserInstance, $itemid, $num, [
            $arg1
        ]);
    }


    /**
     * 使用嫁接加权道具
     * @param $itemId
     * @param $num
     * @param $destUserId
     * @param $slotId
     * @param $resultIndex [0,1,2,3]
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function useItemToAddGraftWeight($itemId, $num, $destUserId, $slotId, $resultIndex)
    {
        typeCheckString($itemId);
        typeCheckNumber($num, 1);
        typeCheckString($slotId, 10);
        typeCheckNumber($resultIndex, 0, 3);
        return dbs_item::getInstance()->useitemWithOptions($this->callerUserInstance, $itemId, $num,
            [
                $destUserId,
                $slotId,
                $resultIndex
            ]);
    }
}