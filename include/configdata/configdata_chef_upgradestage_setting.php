<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_chef_upgradestage_setting {
const k_level = "level";
const k_needlevel = "needlevel";
const k_maxlevel = "maxlevel";
const k_nextlevel = "nextlevel";
const k_itemid = "itemid";
const k_itemcount = "itemcount";
const k_gamecoin = "gamecoin";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['level'=>'1','needlevel'=>'1','maxlevel'=>'49','nextlevel'=>'2'],
['level'=>'2','needlevel'=>'50','maxlevel'=>'79','nextlevel'=>'3','itemid'=>'203001','itemcount'=>'5','gamecoin'=>'50000'],
['level'=>'3','needlevel'=>'80','maxlevel'=>'109','nextlevel'=>'4','itemid'=>'203001','itemcount'=>'10','gamecoin'=>'100000'],
['level'=>'4','needlevel'=>'110','maxlevel'=>'139','nextlevel'=>'5','itemid'=>'203001','itemcount'=>'15','gamecoin'=>'200000'],
['level'=>'5','needlevel'=>'140','maxlevel'=>'169','nextlevel'=>'6','itemid'=>'203001','itemcount'=>'20','gamecoin'=>'300000'],
['level'=>'6','needlevel'=>'170','maxlevel'=>'199','nextlevel'=>'7','itemid'=>'203001','itemcount'=>'25','gamecoin'=>'400000'],
['level'=>'7','needlevel'=>'200','maxlevel'=>'229','nextlevel'=>'8','itemid'=>'203001','itemcount'=>'30','gamecoin'=>'500000'],
['level'=>'8','needlevel'=>'230','maxlevel'=>'259','nextlevel'=>'9','itemid'=>'203001','itemcount'=>'35','gamecoin'=>'600000'],
['level'=>'9','needlevel'=>'260','maxlevel'=>'289','nextlevel'=>'10','itemid'=>'203001','itemcount'=>'40','gamecoin'=>'700000'],
['level'=>'10','needlevel'=>'290','maxlevel'=>'299','nextlevel'=>'11','itemid'=>'203001','itemcount'=>'45','gamecoin'=>'800000']
];
}
 return self::$_data;
}
}
