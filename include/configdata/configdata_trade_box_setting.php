<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_trade_box_setting {
const k_id = "id";
const k_diamond = "diamond";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','diamond'=>'5'],
['id'=>'2','diamond'=>'10'],
['id'=>'3','diamond'=>'20'],
['id'=>'4','diamond'=>'50'],
['id'=>'5','diamond'=>'80'],
['id'=>'6','diamond'=>'110'],
['id'=>'7','diamond'=>'140'],
['id'=>'8','diamond'=>'170'],
['id'=>'9','diamond'=>'200'],
['id'=>'10','diamond'=>'230'],
['id'=>'11','diamond'=>'260'],
['id'=>'12','diamond'=>'290'],
['id'=>'13','diamond'=>'320'],
['id'=>'14','diamond'=>'350'],
['id'=>'15','diamond'=>'380'],
['id'=>'16','diamond'=>'410'],
['id'=>'17','diamond'=>'440'],
['id'=>'18','diamond'=>'470'],
['id'=>'19','diamond'=>'500'],
['id'=>'20','diamond'=>'530']
];
}
 return self::$_data;
}
}
