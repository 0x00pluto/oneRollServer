<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_npc_custom_goodwill_setting {
const k_id = "id";
const k_upgradeid = "upgradeid";
const k_needexp = "needexp";
const k_totalexp = "totalexp";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','upgradeid'=>'2','needexp'=>'0','totalexp'=>'0'],
['id'=>'2','upgradeid'=>'3','needexp'=>'150','totalexp'=>'150'],
['id'=>'3','upgradeid'=>'4','needexp'=>'350','totalexp'=>'500'],
['id'=>'4','upgradeid'=>'5','needexp'=>'600','totalexp'=>'1100'],
['id'=>'5','needexp'=>'900','totalexp'=>'2000']
];
}
 return self::$_data;
}
}
