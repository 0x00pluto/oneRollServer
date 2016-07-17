<?php

namespace apps\payverify\service;

use apps\payverify\dbs\notice\dbs_notice_center;

/**
 * @auther zhipeng
 */
class service_noticecenter extends service_base
{
    function __construct()
    {
        $this->addFunctions(array(
            'getall',
            'check'
        ));
    }

    protected function get_dbins()
    {
        return dbs_notice_center::getInstance();
    }

    protected function get_err_class_name()
    {
        return "apps\\payverify\\err\\" . "err_dbs_notice_center" . "_";
    }

    /**
     * 获取所有的订单
     *
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function getall()
    {
        return $this->get_dbins()->getall();
    }

    /**
     * 校验订单
     *
     * @param $orderid
     * @return \Common\Util\Common_Util_ReturnVar
     */
    function check($orderid)
    {
        return $this->get_dbins()->check($orderid);
    }
}