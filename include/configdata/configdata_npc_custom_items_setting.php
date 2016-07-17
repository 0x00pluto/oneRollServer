<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_npc_custom_items_setting {
const k_id = "id";
const k_groupid = "groupid";
const k_itemid = "itemid";
const k_itemcount = "itemcount";
const k_weight = "weight";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','groupid'=>'1','itemid'=>'401001','itemcount'=>'1','weight'=>'5000'],
['id'=>'2','groupid'=>'1','itemid'=>'401002','itemcount'=>'2','weight'=>'5000'],
['id'=>'3','groupid'=>'1','itemid'=>'401003','itemcount'=>'1','weight'=>'5000'],
['id'=>'4','groupid'=>'2','itemid'=>'401004','itemcount'=>'2','weight'=>'5000'],
['id'=>'5','groupid'=>'2','itemid'=>'401005','itemcount'=>'1','weight'=>'5000'],
['id'=>'6','groupid'=>'2','itemid'=>'401006','itemcount'=>'2','weight'=>'5000'],
['id'=>'7','groupid'=>'3','itemid'=>'401007','itemcount'=>'1','weight'=>'5000'],
['id'=>'8','groupid'=>'3','itemid'=>'401008','itemcount'=>'1','weight'=>'5000'],
['id'=>'9','groupid'=>'3','itemid'=>'401009','itemcount'=>'2','weight'=>'5000'],
['id'=>'10','groupid'=>'3','itemid'=>'401010','itemcount'=>'1','weight'=>'3000']
];
}
 return self::$_data;
}
}
