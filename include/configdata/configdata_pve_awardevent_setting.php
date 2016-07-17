<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_pve_awardevent_setting {
const k_id = "id";
const k_groupid = "groupid";
const k_weight = "weight";
const k_eventid = "eventid";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','groupid'=>'1','weight'=>'1000','eventid'=>'1'],
['id'=>'2','groupid'=>'1','weight'=>'1000','eventid'=>'2']
];
}
 return self::$_data;
}
}
