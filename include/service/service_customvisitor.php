<?php

namespace service;

use Common\Util\Common_Util_ReturnVar;
use dbs\custom\visitors\dbs_custom_visitors_player;

/**
 * 访客npc服务
 *
 * @author zhipeng
 *
 */
class service_customvisitor extends service_base
{


    /**
     * @inheritDoc
     */
    protected function configureFunctions()
    {
        $this->addFunction('getinfo');
        $this->addFunctions([
            'getRecommend'
//            'getRecommendStrangers',
        ]);

    }

    /**
     * @inheritDoc
     */
    protected function get_err_class_name()
    {
        return "err\\" . "err_dbs_custom_visitors_player_";
    }


    /**
     * @inheritDoc
     */
    protected function get_dbins()
    {
        return dbs_custom_visitors_player::createWithPlayer($this->callerUserInstance);
    }


    /**
     * @return Common_Util_ReturnVar
     */
    public function getinfo()
    {
        $data = [];
        //interface err_service_customvisitor_getinfo
        $data = $this->get_dbins()->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }

    /**
     * 获取推荐数据
     * @return Common_Util_ReturnVar
     */
    public function getRecommend()
    {
        return $this->get_dbins()->getRecommend();
    }

}