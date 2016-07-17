<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_chef_open_setting {
const k_id = "id";
const k_preopenid = "preopenid";
const k_rolesex = "rolesex";
const k_restaurantlevel = "restaurantlevel";
const k_openchefid = "openchefid";
const k_isself = "isself";
const k_awardgroupid = "awardgroupid";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','preopenid'=>'-1','rolesex'=>'0','restaurantlevel'=>'1','openchefid'=>'10000','isself'=>'1','awardgroupid'=>'1'],
['id'=>'2','preopenid'=>'1','rolesex'=>'0','restaurantlevel'=>'5','openchefid'=>'10006','isself'=>'0','awardgroupid'=>'2'],
['id'=>'3','preopenid'=>'2','rolesex'=>'0','restaurantlevel'=>'10','openchefid'=>'10002','isself'=>'0','awardgroupid'=>'3'],
['id'=>'4','preopenid'=>'3','rolesex'=>'0','restaurantlevel'=>'20','openchefid'=>'10007','isself'=>'0','awardgroupid'=>'4'],
['id'=>'5','preopenid'=>'4','rolesex'=>'0','restaurantlevel'=>'35','openchefid'=>'10003','isself'=>'0','awardgroupid'=>'5'],
['id'=>'6','preopenid'=>'-1','rolesex'=>'1','restaurantlevel'=>'1','openchefid'=>'10001','isself'=>'1','awardgroupid'=>'6'],
['id'=>'7','preopenid'=>'6','rolesex'=>'1','restaurantlevel'=>'5','openchefid'=>'10004','isself'=>'0','awardgroupid'=>'7'],
['id'=>'8','preopenid'=>'7','rolesex'=>'1','restaurantlevel'=>'10','openchefid'=>'10008','isself'=>'0','awardgroupid'=>'8'],
['id'=>'9','preopenid'=>'8','rolesex'=>'1','restaurantlevel'=>'20','openchefid'=>'10005','isself'=>'0','awardgroupid'=>'9'],
['id'=>'10','preopenid'=>'9','rolesex'=>'1','restaurantlevel'=>'35','openchefid'=>'10009','isself'=>'0','awardgroupid'=>'10']
];
}
 return self::$_data;
}
}
