<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_chef_hire_times_setting {
const k_times = "times";
const k_diamond = "diamond";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['times'=>'1','diamond'=>'0'],
['times'=>'2','diamond'=>'15'],
['times'=>'3','diamond'=>'30'],
['times'=>'4','diamond'=>'50'],
['times'=>'5','diamond'=>'70'],
['times'=>'6','diamond'=>'90'],
['times'=>'7','diamond'=>'110'],
['times'=>'8','diamond'=>'130'],
['times'=>'9','diamond'=>'150'],
['times'=>'10','diamond'=>'170'],
['times'=>'11','diamond'=>'190'],
['times'=>'12','diamond'=>'210'],
['times'=>'13','diamond'=>'230'],
['times'=>'14','diamond'=>'250'],
['times'=>'15','diamond'=>'270'],
['times'=>'16','diamond'=>'290'],
['times'=>'17','diamond'=>'310'],
['times'=>'18','diamond'=>'330'],
['times'=>'19','diamond'=>'350'],
['times'=>'20','diamond'=>'370']
];
}
 return self::$_data;
}
}
