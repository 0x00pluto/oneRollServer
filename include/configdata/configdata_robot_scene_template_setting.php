<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_robot_scene_template_setting {
const k_id = "id";
const k_groupid = "groupid";
const k_templateuserid = "templateuserid";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','groupid'=>'1','templateuserid'=>'userid-10000'],
['id'=>'2','groupid'=>'1','templateuserid'=>'userid-10000'],
['id'=>'3','groupid'=>'1','templateuserid'=>'userid-10000'],
['id'=>'4','groupid'=>'2','templateuserid'=>'userid-10000'],
['id'=>'5','groupid'=>'3','templateuserid'=>'userid-10000'],
['id'=>'6','groupid'=>'3','templateuserid'=>'userid-10000'],
['id'=>'7','groupid'=>'3','templateuserid'=>'userid-10000'],
['id'=>'8','groupid'=>'4','templateuserid'=>'userid-10000'],
['id'=>'9','groupid'=>'5','templateuserid'=>'userid-10000'],
['id'=>'10','groupid'=>'5','templateuserid'=>'userid-10000'],
['id'=>'11','groupid'=>'5','templateuserid'=>'userid-10000'],
['id'=>'12','groupid'=>'6','templateuserid'=>'userid-10000'],
['id'=>'13','groupid'=>'7','templateuserid'=>'userid-10000'],
['id'=>'14','groupid'=>'8','templateuserid'=>'userid-10000'],
['id'=>'15','groupid'=>'9','templateuserid'=>'userid-10000'],
['id'=>'16','groupid'=>'10','templateuserid'=>'userid-10000'],
['id'=>'17','groupid'=>'11','templateuserid'=>'userid-10000'],
['id'=>'18','groupid'=>'12','templateuserid'=>'userid-10000']
];
}
 return self::$_data;
}
}
