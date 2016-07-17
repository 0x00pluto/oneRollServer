<?php
use apps\payverify\constants\configure;

return [
    configure_constants::Const_DB_Name => 'payverify_db',
    configure_constants::Const_DB_Connection => 'mongodb://payverify:payverify@dds-2ze2462d8b06cc941.mongodb.rds.aliyuncs.com:3717,dds-2ze2462d8b06cc942.mongodb.rds.aliyuncs.com:3717/admin?replicaSet=mgset-1071315',
    configure_constants::Const_LOGDB_Connection => "mongodb://loguser:loguser@dds-2ze2462d8b06cc941.mongodb.rds.aliyuncs.com:3717,dds-2ze2462d8b06cc942.mongodb.rds.aliyuncs.com:3717/admin?replicaSet=mgset-1071315",
    configure_constants::RSYSLOG_SERVER_IP => "10.51.85.137",
    configure::APPLE_VERIFY_URL => "https://buy.itunes.apple.com/verifyReceipt",
    configure::GOOGLE_PUBLIC_KEY => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAu7ZkMMa3GcZhWAaBlLTWK/m/c8uwrYuRpwQCQcS3p4CggyQY/SVrC4bCRpsBYIJY93HtLzprNoLIYk1zYO1m8+ICda2e9jm3huajkkkWBZDsBt/aF3euMvqhdnDOcscsGWqJrBUApt0EhwzFOxCpvI/P54wvD9uQI7cJf2iYfoC32UwOoS162c/IJuFt3BvxuEEuRLBvJlZLw+riP1hsDvJROfWLOuv09Kh/n6n9yibu9TI52xJT3t02zaW5B2SZ2aL8Kp96urfDCkgJP/oeXXcMg+bRlkMtutiNIO72gslGGIe5HFdbg/7TGAF7Si8KYwJ9ShMrewTNRwNREhovkwIDAQAB'
];