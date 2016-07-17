<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_chef_hire_times_award_setting {
const k_times = "times";
const k_diamond = "diamond";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['times'=>'1','diamond'=>'1'],
['times'=>'2','diamond'=>'1'],
['times'=>'3','diamond'=>'1'],
['times'=>'4','diamond'=>'1'],
['times'=>'5','diamond'=>'1']
];
}
 return self::$_data;
}
}
