<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_item_building_material_setting {
const k_id = "id";
const k_diamond = "diamond";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'401001','diamond'=>'15'],
['id'=>'401002','diamond'=>'15'],
['id'=>'401003','diamond'=>'15'],
['id'=>'401004','diamond'=>'15'],
['id'=>'401005','diamond'=>'15'],
['id'=>'401006','diamond'=>'15'],
['id'=>'401007','diamond'=>'6'],
['id'=>'401008','diamond'=>'14'],
['id'=>'401009','diamond'=>'10'],
['id'=>'401010','diamond'=>'8']
];
}
 return self::$_data;
}
}
