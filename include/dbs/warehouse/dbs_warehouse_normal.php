<?php

namespace dbs\warehouse;

use dbs\dbs_warehousebase;

/**
 * 通用仓库
 *
 * @author zhipeng
 *
 */
class dbs_warehouse_normal extends dbs_warehousebase
{

    protected function configure()
    {
        $this->set_tablename("warehouse_normal");
    }


}