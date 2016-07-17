<?php
use apps\payverify\constants\configure;
return [
    configure_constants::Const_DB_Name => 'payverify_db',
    configure_constants::Const_DB_Connection => 'mongodb://payverify:payverify@192.168.1.3:27017',
    configure_constants::RSYSLOG_SERVER_IP => "192.168.1.11",
    configure::APPLE_VERIFY_URL => "https://sandbox.itunes.apple.com/verifyReceipt",
    configure::GOOGLE_PUBLIC_KEY => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAu7ZkMMa3GcZhWAaBlLTWK/m/c8uwrYuRpwQCQcS3p4CggyQY/SVrC4bCRpsBYIJY93HtLzprNoLIYk1zYO1m8+ICda2e9jm3huajkkkWBZDsBt/aF3euMvqhdnDOcscsGWqJrBUApt0EhwzFOxCpvI/P54wvD9uQI7cJf2iYfoC32UwOoS162c/IJuFt3BvxuEEuRLBvJlZLw+riP1hsDvJROfWLOuv09Kh/n6n9yibu9TI52xJT3t02zaW5B2SZ2aL8Kp96urfDCkgJP/oeXXcMg+bRlkMtutiNIO72gslGGIe5HFdbg/7TGAF7Si8KYwJ9ShMrewTNRwNREhovkwIDAQAB'
];