<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_theme_restaurant_setting {
const k_id = "id";
const k_needrestaurantlevel = "needrestaurantlevel";
const k_needdisheshandbook1 = "needdisheshandbook1";
const k_needdisheshandbook2 = "needdisheshandbook2";
const k_reputation = "reputation";
const k_customs = "customs";
const k_mapfilename = "mapfilename";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','needrestaurantlevel'=>'1','reputation'=>'1','customs'=>'10','mapfilename'=>'map_1'],
['id'=>'2','needrestaurantlevel'=>'61','needdisheshandbook1'=>'505016','needdisheshandbook2'=>'505021','reputation'=>'6','customs'=>'40','mapfilename'=>'map_2'],
['id'=>'3','needrestaurantlevel'=>'34','reputation'=>'4','customs'=>'30','mapfilename'=>'map_3'],
['id'=>'4','needrestaurantlevel'=>'23','reputation'=>'3','customs'=>'25','mapfilename'=>'map_4'],
['id'=>'5','needrestaurantlevel'=>'50','reputation'=>'5','customs'=>'35','mapfilename'=>'map_5'],
['id'=>'6','needrestaurantlevel'=>'20','reputation'=>'2','customs'=>'20','mapfilename'=>'map_6']
];
}
 return self::$_data;
}
}
