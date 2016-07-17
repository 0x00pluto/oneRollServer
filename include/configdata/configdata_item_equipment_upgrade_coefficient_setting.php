<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_item_equipment_upgrade_coefficient_setting {
const k_quality = "quality";
const k_coefficient = "coefficient";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['quality'=>'0','coefficient'=>'1'],
['quality'=>'1','coefficient'=>'1.5'],
['quality'=>'2','coefficient'=>'2'],
['quality'=>'3','coefficient'=>'3']
];
}
 return self::$_data;
}
}
