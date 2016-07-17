<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_chef_goodwill_level_setting {
const k_level = "level";
const k_needexp = "needexp";
const k_totalexp = "totalexp";
const k_awarditem = "awarditem";
const k_awarditemcount = "awarditemcount";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['level'=>'0','needexp'=>'0','totalexp'=>'0'],
['level'=>'1','needexp'=>'50','totalexp'=>'50','awarditem'=>'204001','awarditemcount'=>'1'],
['level'=>'2','needexp'=>'125','totalexp'=>'175','awarditem'=>'204001','awarditemcount'=>'2'],
['level'=>'3','needexp'=>'275','totalexp'=>'450','awarditem'=>'204002','awarditemcount'=>'2'],
['level'=>'4','needexp'=>'325','totalexp'=>'775','awarditem'=>'204001','awarditemcount'=>'3'],
['level'=>'5','needexp'=>'500','totalexp'=>'1275','awarditem'=>'204002','awarditemcount'=>'3']
];
}
 return self::$_data;
}
}
