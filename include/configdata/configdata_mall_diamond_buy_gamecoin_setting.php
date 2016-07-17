<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_mall_diamond_buy_gamecoin_setting {
const k_mallid = "mallid";
const k_isopen = "isopen";
const k_gamecoin = "gamecoin";
const k_diamond = "diamond";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['mallid'=>'1','isopen'=>'1','gamecoin'=>'100','diamond'=>'2'],
['mallid'=>'2','isopen'=>'1','gamecoin'=>'1000','diamond'=>'10'],
['mallid'=>'3','isopen'=>'0','gamecoin'=>'10000','diamond'=>'190'],
['mallid'=>'4','isopen'=>'0','gamecoin'=>'100000','diamond'=>'280'],
['mallid'=>'5','isopen'=>'0','gamecoin'=>'1000000','diamond'=>'370'],
['mallid'=>'6','isopen'=>'0','gamecoin'=>'10000000','diamond'=>'460']
];
}
 return self::$_data;
}
}
