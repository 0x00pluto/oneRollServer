<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/17
 * Time: 下午12:34
 */

namespace dbs\advertisement;


use Common\Util\Common_Util_Guid;
use dbs\templates\advertisement\dbs_templates_advertisement_advertisement;

class dbs_advertisement_advertisement extends dbs_templates_advertisement_advertisement
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
        $this->setAutoSave(false);
        $this->set_primary_key([self::DBKey_id]);
    }


    /**
     * @return dbs_advertisement_advertisement
     */
    public static function create()
    {
        $ins = new self();
        $ins->set_id(Common_Util_Guid::uuid('advertisement-'));
        $ins->set_link('#');
        return $ins;
    }

}