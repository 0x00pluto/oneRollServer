<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/3
 * Time: 下午3:17
 */

namespace service;


use Common\Util\Common_Util_ReturnVar;
use dbs\records\dbs_records_active;
use dbs\records\dbs_records_deactive;

class service_records extends service_base
{
    protected function configureFunctions()
    {
        $this->addFunction('getActiveRecords');
        $this->addFunction('getDeActiveRecords');
    }

    /**
     * 获取活动中的记录
     * @return Common_Util_ReturnVar
     */
    public function getActiveRecords()
    {
        $data = [];
        //interface err_service_records_getActiveRecords

        $data = dbs_records_active::createWithPlayer($this->callerUserInstance)->toArray();
        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


    /**
     * 获取过期的记录
     * @return Common_Util_ReturnVar
     */
    public function getDeActiveRecords()
    {
        $data = dbs_records_deactive::createWithPlayer($this->callerUserInstance)->toArray();
        //interface err_service_records_getDeActiveRecords

        //code...
        return Common_Util_ReturnVar::RetSucc($data);
    }


}