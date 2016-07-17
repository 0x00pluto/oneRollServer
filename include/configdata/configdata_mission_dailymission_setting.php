<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_mission_dailymission_setting {
const k_id = "id";
const k_opentime = "opentime";
const k_endtime = "endtime";
const k_missionid = "missionid";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','opentime'=>'烹饪多少份','endtime'=>'值为菜品id$数量'],
['id'=>'2','opentime'=>'吃多少份','endtime'=>'值为菜品id$数量']
];
}
 return self::$_data;
}
}
