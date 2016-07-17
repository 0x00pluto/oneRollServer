<?php

namespace service;
use Common\Util\Common_Util_ReturnVar;

/**
 * 钻石购买道具服务
 *
 * @author zhipeng
 *
 */
class service_shopdiamondbuyitem extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'buyitem',
            'buygamecoin'
        ));
    }

    /**
     * 购买物品
     *
     * @param string $itemid 道具id
     * @param int $count 道具数量
     * @param bool $force
     *            是否可以超仓库上限 0不可以 1可以
     * @return Common_Util_ReturnVar
     */
    function buyitem($itemid, $count, $force)
    {
        typeCheckString($itemid, 32);
        typeCheckNumber($count, 1);
        typeCheckChoice(intval($force), [
            0, 1]);

        return $this->callerUserInstance->db_shopdiamondbuyitem()->buyitem($itemid, $count, $force);
    }

    /**
     * 购买游戏币
     *
     * @param string $mallid 商场id
     * @return Common_Util_ReturnVar
     */
    function buygamecoin($mallid)
    {
        typeCheckString($mallid, 32);
        return $this->callerUserInstance->db_shopdiamondbuyitem()->buygamecoin($mallid);
    }
}
