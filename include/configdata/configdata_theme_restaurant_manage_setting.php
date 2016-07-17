<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_theme_restaurant_manage_setting {
const k_id = "id";
const k_timeinterval = "timeinterval";
const k_basegamecoin = "basegamecoin";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','timeinterval'=>'14400','basegamecoin'=>'600'],
['id'=>'2','timeinterval'=>'86400','basegamecoin'=>'20000'],
['id'=>'3','timeinterval'=>'28800','basegamecoin'=>'6000'],
['id'=>'4','timeinterval'=>'28800','basegamecoin'=>'4500'],
['id'=>'5','timeinterval'=>'64800','basegamecoin'=>'14500'],
['id'=>'6','timeinterval'=>'21600','basegamecoin'=>'2300']
];
}
 return self::$_data;
}
}
