<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_server_lang_setting {
const k_languageid = "languageid";
const k_zn = "zn";
const k_en = "en";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['languageid'=>'MESSAGE_SUPER_SLOTMACHINE_RECV_JACKPOT','zn'=>'快来"领取"{rolename}的超级{num}大奖{rolename}吧'],
['languageid'=>'MESSAGE_SUPER_SLOTMACHINE_INVITE','zn'=>'快来参见{rolename}的超级老虎机'],
['languageid'=>'MESSAGE_REQEUST_SEND_TO_NEIGHBOOR','zn'=>'快乐帮帮我吧']
];
}
 return self::$_data;
}
}
