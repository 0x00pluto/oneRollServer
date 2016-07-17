<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/10
 * Time: 上午10:24
 */

namespace dbs;


use dbs\templates\examples\dbs_templates_examples_role;

class dbs_roleTest extends dbs_templates_examples_role
{
    /**
     * 表名
     *
     * @var string
     */
    const DBKey_tablename = "roleTest";


    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);

        $this->set_Friends(['1']);
    }


}