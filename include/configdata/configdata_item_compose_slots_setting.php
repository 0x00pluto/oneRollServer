<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_item_compose_slots_setting {
const k_id = "id";
const k_restaurantlevel = "restaurantlevel";
const k_diamond = "diamond";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','restaurantlevel'=>'8','diamond'=>'0'],
['id'=>'2','restaurantlevel'=>'9','diamond'=>'0'],
['id'=>'3','restaurantlevel'=>'10','diamond'=>'0'],
['id'=>'4','restaurantlevel'=>'11','diamond'=>'0'],
['id'=>'5','restaurantlevel'=>'12','diamond'=>'0'],
['id'=>'1001','restaurantlevel'=>'0','diamond'=>'20'],
['id'=>'1002','restaurantlevel'=>'0','diamond'=>'80'],
['id'=>'1003','restaurantlevel'=>'0','diamond'=>'200'],
['id'=>'1004','restaurantlevel'=>'0','diamond'=>'1000'],
['id'=>'1005','restaurantlevel'=>'0','diamond'=>'2000']
];
}
 return self::$_data;
}
}
