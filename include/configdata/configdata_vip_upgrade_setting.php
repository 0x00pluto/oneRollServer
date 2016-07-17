<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_vip_upgrade_setting {
const k_level = "level";
const k_needexp = "needexp";
const k_totalexp = "totalexp";
const k_awarditemid = "awarditemid";
const k_awarditemcount = "awarditemcount";
const k_awardgamecoin = "awardgamecoin";
const k_awarddiamond = "awarddiamond";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['level'=>'0','needexp'=>'0','totalexp'=>'0','awarditemid'=>'202001','awarditemcount'=>'1','awardgamecoin'=>'10000','awarddiamond'=>'1'],
['level'=>'1','needexp'=>'10','totalexp'=>'10','awarditemid'=>'202002','awarditemcount'=>'1','awardgamecoin'=>'100000','awarddiamond'=>'30'],
['level'=>'2','needexp'=>'300','totalexp'=>'310','awarditemid'=>'202003','awarditemcount'=>'1','awardgamecoin'=>'250000','awarddiamond'=>'68'],
['level'=>'3','needexp'=>'680','totalexp'=>'990','awarditemid'=>'202004','awarditemcount'=>'1','awardgamecoin'=>'500000','awarddiamond'=>'128'],
['level'=>'4','needexp'=>'1280','totalexp'=>'2270','awarditemid'=>'202005','awarditemcount'=>'1','awardgamecoin'=>'1500000','awarddiamond'=>'328'],
['level'=>'5','needexp'=>'3280','totalexp'=>'5550','awarditemid'=>'202006','awarditemcount'=>'1','awardgamecoin'=>'0','awarddiamond'=>'648'],
['level'=>'6','needexp'=>'6480','totalexp'=>'12030','awarditemid'=>'202007','awarditemcount'=>'1','awardgamecoin'=>'0','awarddiamond'=>'648'],
['level'=>'7','needexp'=>'12800','totalexp'=>'24830','awarditemid'=>'202008','awarditemcount'=>'1','awardgamecoin'=>'0','awarddiamond'=>'648'],
['level'=>'8','needexp'=>'25600','totalexp'=>'50430','awarditemid'=>'202009','awarditemcount'=>'1','awardgamecoin'=>'0','awarddiamond'=>'648'],
['level'=>'9','needexp'=>'51200','totalexp'=>'101630','awarditemid'=>'202010','awarditemcount'=>'1','awardgamecoin'=>'0','awarddiamond'=>'648'],
['level'=>'10','needexp'=>'51200','totalexp'=>'101630','awarditemid'=>'202010','awarditemcount'=>'1','awardgamecoin'=>'0','awarddiamond'=>'648']
];
}
 return self::$_data;
}
}
