<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_pve_attacktime_recharge_setting {
const k_rechargecount = "rechargecount";
const k_needdiamonds = "needdiamonds";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['rechargecount'=>'1','needdiamonds'=>'10'],
['rechargecount'=>'2','needdiamonds'=>'10'],
['rechargecount'=>'3','needdiamonds'=>'20'],
['rechargecount'=>'4','needdiamonds'=>'20'],
['rechargecount'=>'5','needdiamonds'=>'20'],
['rechargecount'=>'6','needdiamonds'=>'50'],
['rechargecount'=>'7','needdiamonds'=>'50'],
['rechargecount'=>'8','needdiamonds'=>'50'],
['rechargecount'=>'9','needdiamonds'=>'50'],
['rechargecount'=>'10','needdiamonds'=>'50'],
['rechargecount'=>'11','needdiamonds'=>'50'],
['rechargecount'=>'12','needdiamonds'=>'50'],
['rechargecount'=>'13','needdiamonds'=>'50'],
['rechargecount'=>'14','needdiamonds'=>'50'],
['rechargecount'=>'15','needdiamonds'=>'50'],
['rechargecount'=>'16','needdiamonds'=>'50'],
['rechargecount'=>'17','needdiamonds'=>'50'],
['rechargecount'=>'18','needdiamonds'=>'50'],
['rechargecount'=>'19','needdiamonds'=>'50'],
['rechargecount'=>'20','needdiamonds'=>'50']
];
}
 return self::$_data;
}
}
