<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_mission_opencondition_setting {
const k_id = "id";
const k_name = "name";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','name'=>'MISSION_OPENCOMPLETE_CONDITION_NAME_1'],
['id'=>'2','name'=>'MISSION_OPENCOMPLETE_CONDITION_NAME_2'],
['id'=>'3','name'=>'MISSION_OPENCOMPLETE_CONDITION_NAME_3'],
['id'=>'4','name'=>'MISSION_OPENCOMPLETE_CONDITION_NAME_4']
];
}
 return self::$_data;
}
}
