<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_chef_fill_vit_setting {
const k_times = "times";
const k_diamond = "diamond";
const k_gamecoin = "gamecoin";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['times'=>'1','diamond'=>'2','gamecoin'=>'0'],
['times'=>'2','diamond'=>'4','gamecoin'=>'0'],
['times'=>'3','diamond'=>'8','gamecoin'=>'0'],
['times'=>'4','diamond'=>'12','gamecoin'=>'0'],
['times'=>'5','diamond'=>'18','gamecoin'=>'0'],
['times'=>'6','diamond'=>'23','gamecoin'=>'0'],
['times'=>'7','diamond'=>'28','gamecoin'=>'0'],
['times'=>'8','diamond'=>'33','gamecoin'=>'0'],
['times'=>'9','diamond'=>'38','gamecoin'=>'0'],
['times'=>'10','diamond'=>'43','gamecoin'=>'0'],
['times'=>'11','diamond'=>'48','gamecoin'=>'0'],
['times'=>'12','diamond'=>'53','gamecoin'=>'0'],
['times'=>'13','diamond'=>'58','gamecoin'=>'0'],
['times'=>'14','diamond'=>'71','gamecoin'=>'0'],
['times'=>'15','diamond'=>'76','gamecoin'=>'0'],
['times'=>'16','diamond'=>'82','gamecoin'=>'0'],
['times'=>'17','diamond'=>'88','gamecoin'=>'0'],
['times'=>'18','diamond'=>'93','gamecoin'=>'0'],
['times'=>'19','diamond'=>'99','gamecoin'=>'0'],
['times'=>'20','diamond'=>'105','gamecoin'=>'0']
];
}
 return self::$_data;
}
}
