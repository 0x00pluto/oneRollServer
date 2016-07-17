<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_chef_goodwill_hireaddvalue_setting {
const k_level = "level";
const k_addpercent = "addpercent";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['level'=>'0','addpercent'=>'10000'],
['level'=>'1','addpercent'=>'10000'],
['level'=>'2','addpercent'=>'12000'],
['level'=>'3','addpercent'=>'15000'],
['level'=>'4','addpercent'=>'20000'],
['level'=>'5','addpercent'=>'40000']
];
}
 return self::$_data;
}
}
