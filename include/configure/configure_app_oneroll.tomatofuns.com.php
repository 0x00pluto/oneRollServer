<?php
use constants\constants_configure;

// 充值校验数据库连接
// $GLOBALS ['Const_PAYVERIFY_DB_Connection'] = 'mongodb://mmongouser:8qxyYH9b2RJJ@10.51.85.137:27017';

return [
    configure_constants::MEMCACHE_HOST => '122e57f6b730416a.m.cnbjalinu16pub001.ocs.aliyuncs.com',
    configure_constants::Const_DB_Connection => 'mongodb://mmongouser:8qxyYH9b2RJJ@dds-2ze2462d8b06cc941.mongodb.rds.aliyuncs.com:3717,dds-2ze2462d8b06cc942.mongodb.rds.aliyuncs.com:3717/admin?replicaSet=mgset-1071315',
    configure_constants::Const_LOGDB_Connection => "mongodb://loguser:loguser@dds-2ze2462d8b06cc941.mongodb.rds.aliyuncs.com:3717,dds-2ze2462d8b06cc942.mongodb.rds.aliyuncs.com:3717/admin?replicaSet=mgset-1071315",
    constants_configure::RECHARGE_APPLE_NOTICE_URL => 'http://payverify.tomatofuns.com',
    constants_configure::RECHARGE_VERIFY_URL => 'http://payverify.tomatofuns.com',
    configure_constants::ENABLE_SCHEDULE => false,
    configure_constants::RSYSLOG_SERVER_IP => "10.51.85.137"
];