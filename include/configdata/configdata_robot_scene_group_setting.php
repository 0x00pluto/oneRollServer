<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_robot_scene_group_setting {
const k_groupid = "groupid";
const k_levelmin = "levelmin";
const k_levelmax = "levelmax";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['groupid'=>'1','levelmin'=>'1','levelmax'=>'8'],
['groupid'=>'2','levelmin'=>'8','levelmax'=>'10'],
['groupid'=>'3','levelmin'=>'10','levelmax'=>'21'],
['groupid'=>'4','levelmin'=>'21','levelmax'=>'23'],
['groupid'=>'5','levelmin'=>'23','levelmax'=>'32'],
['groupid'=>'6','levelmin'=>'32','levelmax'=>'34'],
['groupid'=>'7','levelmin'=>'34','levelmax'=>'48'],
['groupid'=>'8','levelmin'=>'48','levelmax'=>'50'],
['groupid'=>'9','levelmin'=>'50','levelmax'=>'59'],
['groupid'=>'10','levelmin'=>'59','levelmax'=>'61'],
['groupid'=>'11','levelmin'=>'61','levelmax'=>'76'],
['groupid'=>'12','levelmin'=>'76','levelmax'=>'101']
];
}
 return self::$_data;
}
}
