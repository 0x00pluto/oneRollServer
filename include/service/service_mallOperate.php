<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/12
 * Time: 下午4:51
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\mall\dbs_mall_manger;

/**
 * 商城操作接口
 * Class service_mallOperate
 * @package service
 */
class service_mallOperate extends service_base
{
    protected function configureFunctions()
    {
        $this->addFunction('buy');
    }

    /**
     * @param $mallId
     * @param $num
     * @return Common_Util_ReturnVar
     */
    public function buy($mallId, $num = 1)
    {
        return dbs_mall_manger::getInstance()->buy(
            $this->callerUserInstance,
            $mallId,
            $num);
    }
}