<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/2
 * Time: 下午4:41
 */

namespace dbs\records;


use dbs\templates\records\dbs_templates_records_active;

class dbs_records_active extends dbs_templates_records_active
{
    use dbs_records_operation_trait;

    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
    }

}