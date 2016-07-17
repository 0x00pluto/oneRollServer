<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_friend_help_times_setting {
const k_id = "id";
const k_goodwillmin = "goodwillmin";
const k_goodwillmax = "goodwillmax";
const k_helptimes = "helptimes";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','goodwillmin'=>'0','goodwillmax'=>'50','helptimes'=>'3'],
['id'=>'2','goodwillmin'=>'51','goodwillmax'=>'175','helptimes'=>'5'],
['id'=>'3','goodwillmin'=>'176','goodwillmax'=>'450','helptimes'=>'7'],
['id'=>'4','goodwillmin'=>'451','goodwillmax'=>'775','helptimes'=>'9'],
['id'=>'5','goodwillmin'=>'776','goodwillmax'=>'1275','helptimes'=>'10']
];
}
 return self::$_data;
}
}
