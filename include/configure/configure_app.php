<?php
use constants\constants_configure;

return [
    constants_configure::RECHARGE_APPLE_NOTICE_URL => 'http://payverify1.cooking.com',
    constants_configure::RECHARGE_VERIFY_URL => 'http://payverify1.cooking.com',

    configure_constants::Const_DB_Name => "oneroll",
    configure_constants::Const_DB_Connection => "mongodb://dds:dds@192.168.1.3:27017",

    configure_constants::ENABLE_SCHEDULE => true,

    constants_configure::VERIFY_CACHE_TIME => 20 * 60,

    configure_constants::Const_LOGDB_Connection => "mongodb://loguser:loguser@192.168.1.3:27017",

    configure_constants::RSYSLOG_SERVER_IP => "192.168.1.11",

    constants_configure::RESTAURANT_MAP_DATA_PATH => realpath(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "mapdata")
];