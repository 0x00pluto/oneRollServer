<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_mail_actiontype_setting {
const k_actiontypeid = "actiontypeid";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['actiontypeid'=>'1'],
['actiontypeid'=>'2']
];
}
 return self::$_data;
}
}
