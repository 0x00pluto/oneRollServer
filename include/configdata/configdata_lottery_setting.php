<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_lottery_setting {
const k_id = "id";
const k_lotterylowawardgroupid = "lotterylowawardgroupid";
const k_lotterylowawardweight = "lotterylowawardweight";
const k_lotteryhighawardgroupid = "lotteryhighawardgroupid";
const k_lotteryhighawardweight = "lotteryhighawardweight";
const k_cdtime = "cdtime";
const k_diamond = "diamond";
const k_awarditemid = "awarditemid";
const k_awarditemcount = "awarditemcount";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','lotterylowawardgroupid'=>'1','lotterylowawardweight'=>'5000','lotteryhighawardgroupid'=>'2','lotteryhighawardweight'=>'500','cdtime'=>'86400','diamond'=>'48','awarditemid'=>'209002','awarditemcount'=>'10'],
['id'=>'2','lotterylowawardgroupid'=>'1','lotterylowawardweight'=>'5000','lotteryhighawardgroupid'=>'2','lotteryhighawardweight'=>'1000','cdtime'=>'0','diamond'=>'432','awarditemid'=>'209002','awarditemcount'=>'100']
];
}
 return self::$_data;
}
}
