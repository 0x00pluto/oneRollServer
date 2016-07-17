<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_item_buff_effect_setting {
const k_id = "id";
const k_kinds = "kinds";
const k_value = "value";
const k_level = "level";
const k_duringtime = "duringtime";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'101','kinds'=>'1','value'=>'9000','level'=>'1','duringtime'=>'180'],
['id'=>'201','kinds'=>'2','value'=>'8000','level'=>'2','duringtime'=>'240'],
['id'=>'301','kinds'=>'3','value'=>'7000','level'=>'3','duringtime'=>'360']
];
}
 return self::$_data;
}
}
