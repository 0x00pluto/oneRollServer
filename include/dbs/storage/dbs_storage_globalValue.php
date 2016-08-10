<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/5
 * Time: 下午4:26
 */

namespace dbs\storage;


use dbs\templates\storage\dbs_templates_storage_globalValue;

class dbs_storage_globalValue extends dbs_templates_storage_globalValue
{
    protected function configure()
    {
        $this->set_tablename(self::DBKey_tablename);
        $this->set_primary_key([self::DBKey_key]);
        $this->setAutoSave(false);
    }


    /**
     * @param $key
     * @param null $defaultValue
     * @return mixed|null
     */
    static function getValue($key, $defaultValue = null)
    {
        $ins = self::findOrNew([self::DBKey_key => $key]);
        if ($ins->exist()) {
            return $ins->get_value();
        }
        return $defaultValue;
    }

    /**
     * @param $key
     * @param $value
     */
    static function setValue($key, $value)
    {
        $ins = self::findOrNew([self::DBKey_key => $key]);
        $ins->set_key($key);
        $ins->set_value($value);
        $ins->saveToDB();
    }


}