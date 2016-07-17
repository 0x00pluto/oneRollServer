<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_serverlist {
const k_id = "id";
const k_rechargeisopen = "rechargeisopen";
const k_notifyisopen = "notifyisopen";
const k_districitid = "districitid";
const k_recommend = "recommend";
const k_serverip = "serverip";
const k_serverport = "serverport";
const k_paycallbackurl = "paycallbackurl";
const k_adminurl = "adminurl";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1002','rechargeisopen'=>'0','notifyisopen'=>'1','districitid'=>'1','recommend'=>'0','serverip'=>'172.16.3.13','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'1001','rechargeisopen'=>'0','notifyisopen'=>'1','districitid'=>'1','recommend'=>'0','serverip'=>'172.16.3.11','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'1003','rechargeisopen'=>'0','notifyisopen'=>'1','districitid'=>'1','recommend'=>'0','serverip'=>'172.16.3.12','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'1004','rechargeisopen'=>'0','notifyisopen'=>'1','districitid'=>'1','recommend'=>'0','serverip'=>'172.16.3.18','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'1005','rechargeisopen'=>'0','notifyisopen'=>'1','districitid'=>'1','recommend'=>'0','serverip'=>'172.16.3.14','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'1006','rechargeisopen'=>'0','notifyisopen'=>'1','districitid'=>'1','recommend'=>'1','serverip'=>'172.16.3.15','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'1007','rechargeisopen'=>'1','notifyisopen'=>'1','districitid'=>'1','recommend'=>'0','serverip'=>'172.16.3.19','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'1008','rechargeisopen'=>'1','notifyisopen'=>'1','districitid'=>'1','recommend'=>'0','serverip'=>'172.16.3.11','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'1009','rechargeisopen'=>'0','notifyisopen'=>'1','districitid'=>'1','recommend'=>'0','serverip'=>'172.16.3.19','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'2001','rechargeisopen'=>'0','notifyisopen'=>'1','districitid'=>'1','recommend'=>'0','serverip'=>'172.16.3.19','serverport'=>'9001','paycallbackurl'=>'http://sa.zillionaire.kaixin009.com/paycallback/','adminurl'=>'http://sa.zillionaire.kaixin009.com/'],
['id'=>'3001','rechargeisopen'=>'0','notifyisopen'=>'1','districitid'=>'1','recommend'=>'1','serverip'=>'27.131.223.54','serverport'=>'9001','paycallbackurl'=>'http://zillionaire.kaixin002.com/paycallback/','adminurl'=>'http://zillionaire.kaixin002.com/'],
['id'=>'3000','rechargeisopen'=>'1','notifyisopen'=>'0','districitid'=>'1','recommend'=>'1','serverip'=>'103.17.40.148','serverport'=>'9001','paycallbackurl'=>'http://supper.zillionaire.bolo001.com/','adminurl'=>'http://admin.zillionaire.bolo001.com/'],
['id'=>'4000','rechargeisopen'=>'1','notifyisopen'=>'1','districitid'=>'1','recommend'=>'1','serverip'=>'103.17.40.149','serverport'=>'9001','paycallbackurl'=>'http://supper.zillionaire.bolo001.com/','adminurl'=>'http://admin.zillionaire.bolo001.com/']
];
}
 return self::$_data;
}
}
