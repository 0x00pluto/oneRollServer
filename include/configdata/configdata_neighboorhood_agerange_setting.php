<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_neighboorhood_agerange_setting {
const k_ageid = "ageid";
const k_agemin = "agemin";
const k_agemax = "agemax";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['ageid'=>'1','agemin'=>'0','agemax'=>'12'],
['ageid'=>'2','agemin'=>'12','agemax'=>'18'],
['ageid'=>'3','agemin'=>'18','agemax'=>'30'],
['ageid'=>'4','agemin'=>'30','agemax'=>'40'],
['ageid'=>'5','agemin'=>'40','agemax'=>'1000']
];
}
 return self::$_data;
}
}
