<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_pve_ticket_buy_setting {
const k_rechargeid = "rechargeid";
const k_needdiamonds = "needdiamonds";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['rechargeid'=>'1','needdiamonds'=>'20'],
['rechargeid'=>'2','needdiamonds'=>'20'],
['rechargeid'=>'3','needdiamonds'=>'50'],
['rechargeid'=>'4','needdiamonds'=>'50'],
['rechargeid'=>'5','needdiamonds'=>'50'],
['rechargeid'=>'6','needdiamonds'=>'50'],
['rechargeid'=>'7','needdiamonds'=>'50'],
['rechargeid'=>'8','needdiamonds'=>'50'],
['rechargeid'=>'9','needdiamonds'=>'50'],
['rechargeid'=>'10','needdiamonds'=>'50'],
['rechargeid'=>'11','needdiamonds'=>'100'],
['rechargeid'=>'12','needdiamonds'=>'100'],
['rechargeid'=>'13','needdiamonds'=>'100'],
['rechargeid'=>'14','needdiamonds'=>'100'],
['rechargeid'=>'15','needdiamonds'=>'100'],
['rechargeid'=>'16','needdiamonds'=>'100'],
['rechargeid'=>'17','needdiamonds'=>'100'],
['rechargeid'=>'18','needdiamonds'=>'100'],
['rechargeid'=>'19','needdiamonds'=>'100'],
['rechargeid'=>'20','needdiamonds'=>'100']
];
}
 return self::$_data;
}
}
