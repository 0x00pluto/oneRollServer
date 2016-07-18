<?php

namespace dbs\serverstatus;

use Common\Db\Common_Db_mongo;
use dbs\templates\serverstatus\dbs_templates_serverstatus_basestatusdata;

/**
 * 说明
 * 2015年11月6日 下午3:03:23
 *
 * @author zhipeng
 *
 */
class dbs_serverstatus_basestatusdata extends dbs_templates_serverstatus_basestatusdata
{


    function __construct()
    {
        parent::__construct(self::DBKey_tablename);
    }

    /**
     * 保存数据
     *
     * @param Common_Db_mongo $db
     */
    function onLoadingFromDB($db)
    {
        $dbReturnDatas = $db->query($this->get_tablename(), [], [], 1);
        if (!empty ($dbReturnDatas)) {
            $this->fromDBData($dbReturnDatas [0]);
        }
    }
}