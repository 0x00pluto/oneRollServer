<?php
namespace dbs;
/**
 * 配方仓库
 * @author zhipeng
 * @deprecated 使用通用仓库
 *
 */
class dbs_warehouseformula extends dbs_warehousebase
{

    protected function configure()
    {
        $this->set_tablename("warehouse_formula");
    }


}