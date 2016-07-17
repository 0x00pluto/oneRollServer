<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_scene_box_setting {
const k_boxid = "boxid";
const k_type = "type";
const k_needdiamond = "needdiamond";
const k_needfriendgoodwill = "needfriendgoodwill";
const k_awardgroupid = "awardgroupid";
const k_weight = "weight";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['boxid'=>'1','type'=>'1','needdiamond'=>'0','needfriendgoodwill'=>'0','awardgroupid'=>'1','weight'=>'1000'],
['boxid'=>'2','type'=>'1','needdiamond'=>'0','needfriendgoodwill'=>'100','awardgroupid'=>'2','weight'=>'1000'],
['boxid'=>'3','type'=>'1','needdiamond'=>'3','needfriendgoodwill'=>'0','awardgroupid'=>'3','weight'=>'1000'],
['boxid'=>'4','type'=>'2','needdiamond'=>'0','needfriendgoodwill'=>'0','awardgroupid'=>'4','weight'=>'1000']
];
}
 return self::$_data;
}
}
