<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_item_itemtowarehouse_setting {
const k_itemmaintype = "itemmaintype";
const k_warehousetype = "warehousetype";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['itemmaintype'=>'0','warehousetype'=>'0'],
['itemmaintype'=>'1','warehousetype'=>'3'],
['itemmaintype'=>'2','warehousetype'=>'0'],
['itemmaintype'=>'3','warehousetype'=>'1'],
['itemmaintype'=>'4','warehousetype'=>'2'],
['itemmaintype'=>'5','warehousetype'=>'0'],
['itemmaintype'=>'6','warehousetype'=>'0'],
['itemmaintype'=>'7','warehousetype'=>'0'],
['itemmaintype'=>'8','warehousetype'=>'4'],
['itemmaintype'=>'9','warehousetype'=>'0'],
['itemmaintype'=>'10','warehousetype'=>'5']
];
}
 return self::$_data;
}
}
