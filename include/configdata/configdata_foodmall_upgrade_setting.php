<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_foodmall_upgrade_setting {
const k_shopid = "shopid";
const k_shoptype = "shoptype";
const k_shoplv = "shoplv";
const k_reducetime = "reducetime";
const k_upgradeenable = "upgradeenable";
const k_upgradeshopid = "upgradeshopid";
const k_upgradeitemid1 = "upgradeitemid1";
const k_upgradeitemcount1 = "upgradeitemcount1";
const k_upgradeitemid2 = "upgradeitemid2";
const k_upgradeitemcount2 = "upgradeitemcount2";
const k_upgradeitemid3 = "upgradeitemid3";
const k_upgradeitemcount3 = "upgradeitemcount3";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['shopid'=>'1000','shoptype'=>'0','shoplv'=>'1','reducetime'=>'10000','upgradeenable'=>'1','upgradeshopid'=>'1001'],
['shopid'=>'1001','shoptype'=>'0','shoplv'=>'2','reducetime'=>'9000','upgradeenable'=>'1','upgradeshopid'=>'1002','upgradeitemid1'=>'401004','upgradeitemcount1'=>'1','upgradeitemid2'=>'401005','upgradeitemcount2'=>'1','upgradeitemid3'=>'401006','upgradeitemcount3'=>'1'],
['shopid'=>'1002','shoptype'=>'0','shoplv'=>'3','reducetime'=>'8000','upgradeenable'=>'0','upgradeitemid1'=>'401004','upgradeitemcount1'=>'2','upgradeitemid2'=>'401005','upgradeitemcount2'=>'2','upgradeitemid3'=>'401006','upgradeitemcount3'=>'2'],
['shopid'=>'2000','shoptype'=>'1','shoplv'=>'1','reducetime'=>'10000','upgradeenable'=>'1','upgradeshopid'=>'2001'],
['shopid'=>'2001','shoptype'=>'1','shoplv'=>'2','reducetime'=>'9000','upgradeenable'=>'1','upgradeshopid'=>'2002','upgradeitemid1'=>'401004','upgradeitemcount1'=>'2','upgradeitemid2'=>'401005','upgradeitemcount2'=>'2','upgradeitemid3'=>'401006','upgradeitemcount3'=>'2'],
['shopid'=>'2002','shoptype'=>'1','shoplv'=>'3','reducetime'=>'8000','upgradeenable'=>'0','upgradeitemid1'=>'401004','upgradeitemcount1'=>'3','upgradeitemid2'=>'401005','upgradeitemcount2'=>'3','upgradeitemid3'=>'401006','upgradeitemcount3'=>'3'],
['shopid'=>'3000','shoptype'=>'2','shoplv'=>'1','reducetime'=>'10000','upgradeenable'=>'1','upgradeshopid'=>'3001'],
['shopid'=>'3001','shoptype'=>'2','shoplv'=>'2','reducetime'=>'9000','upgradeenable'=>'1','upgradeshopid'=>'3002','upgradeitemid1'=>'401004','upgradeitemcount1'=>'3','upgradeitemid2'=>'401005','upgradeitemcount2'=>'3','upgradeitemid3'=>'401006','upgradeitemcount3'=>'3'],
['shopid'=>'3002','shoptype'=>'2','shoplv'=>'3','reducetime'=>'8000','upgradeenable'=>'0','upgradeitemid1'=>'401004','upgradeitemcount1'=>'4','upgradeitemid2'=>'401005','upgradeitemcount2'=>'4','upgradeitemid3'=>'401006','upgradeitemcount3'=>'4']
];
}
 return self::$_data;
}
}
