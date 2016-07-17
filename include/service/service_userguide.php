<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;

/**
 * 用户引导
 * @auther zhipeng
 */
class service_userguide extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getinfo',
            'beginguide',
            'endguide',
            'startOffLineEat'
        ));
    }

    protected function get_dbins()
    {
        return $this->callerUserInstance->dbs_userguide();
    }

    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_userguide" . "_";
    }

    /**
     * 获取信息
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getinfo()
    {
        $retCode = 0;
        $retCode_Str = 'SUCC';
        $data = array();
        // class err_service_userguide_getinfo{}

        $data = $this->get_dbins()->toArray();

        // code

        succ:
        return Common_Util_ReturnVar::Ret(true, $retCode, $data, $retCode_Str);
        failed:
        return Common_Util_ReturnVar::Ret(false, $retCode, $data, $retCode_Str);
    }

    /**
     * 开始引导
     *
     * @param string $guideKey
     */
    function beginguide($guideKey)
    {
        typeCheckString($guideKey);
        return $this->get_dbins()->beginguide($guideKey);
    }

    /**
     * 结束引导
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function endguide()
    {
        return $this->get_dbins()->endguide();
    }

    /**
     * 开启离线吃菜
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function startOffLineEat()
    {
        return $this->get_dbins()->startOffLineEat();
    }
}