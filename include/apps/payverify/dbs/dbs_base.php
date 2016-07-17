<?php

namespace apps\payverify\dbs;

use constants\constants_db;
use hellaEngine\data\data_basedbdatacell;

abstract class dbs_base extends data_basedbdatacell
{
    function __construct($table_name = constants_db::EMPTY_TABLE_NAME, $db_field_keys = array(), $db_field_primary_key = array())
    {
        parent::__construct($table_name, $db_field_keys, $db_field_primary_key, false);
    }
}