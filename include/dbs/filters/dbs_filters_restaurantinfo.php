<?php

namespace dbs\filters;

use dbs\dbs_restaurantinfo;

class dbs_filters_restaurantinfo
{
    static $lookupinfo = array(
        dbs_restaurantinfo::DBKey_userid,
        dbs_restaurantinfo::DBKey_restaurantlevel,
        dbs_restaurantinfo::DBKey_restaurantexp,
        dbs_restaurantinfo::DBKey_restauranttotalexp,
    );
}