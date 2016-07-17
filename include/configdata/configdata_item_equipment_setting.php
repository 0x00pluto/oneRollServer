<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_item_equipment_setting {
const k_id = "id";
const k_cookingability = "cookingability";
const k_cookingabilityaddvalue = "cookingabilityaddvalue";
const k_chinesefood = "chinesefood";
const k_chinesefoodaddvalue = "chinesefoodaddvalue";
const k_westernfood = "westernfood";
const k_westernfoodaddvalue = "westernfoodaddvalue";
const k_japenesefood = "japenesefood";
const k_japenesefoodaddvalue = "japenesefoodaddvalue";
const k_frenchfood = "frenchfood";
const k_frenchfoodaddvalue = "frenchfoodaddvalue";
const k_ideafood = "ideafood";
const k_ideafoodaddvalue = "ideafoodaddvalue";
const k_goodwill = "goodwill";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'801001','cookingability'=>'60','cookingabilityaddvalue'=>'2','chinesefood'=>'100','chinesefoodaddvalue'=>'50','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'801002','cookingability'=>'80','cookingabilityaddvalue'=>'3','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'100','westernfoodaddvalue'=>'50','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'801003','cookingability'=>'100','cookingabilityaddvalue'=>'4','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'100','japenesefoodaddvalue'=>'50','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'801004','cookingability'=>'120','cookingabilityaddvalue'=>'5','chinesefood'=>'100','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'100','frenchfoodaddvalue'=>'50','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'801005','cookingability'=>'80','cookingabilityaddvalue'=>'6','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'100','frenchfoodaddvalue'=>'50','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'801006','cookingability'=>'120','cookingabilityaddvalue'=>'7','chinesefood'=>'100','chinesefoodaddvalue'=>'50','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'802001','cookingability'=>'60','cookingabilityaddvalue'=>'8','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'100','westernfoodaddvalue'=>'50','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'802002','cookingability'=>'80','cookingabilityaddvalue'=>'9','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'100','japenesefoodaddvalue'=>'50','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'802003','cookingability'=>'100','cookingabilityaddvalue'=>'10','chinesefood'=>'100','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'100','frenchfoodaddvalue'=>'50','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'802004','cookingability'=>'60','cookingabilityaddvalue'=>'8','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'100','westernfoodaddvalue'=>'50','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'802005','cookingability'=>'80','cookingabilityaddvalue'=>'9','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'100','japenesefoodaddvalue'=>'50','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'802006','cookingability'=>'100','cookingabilityaddvalue'=>'10','chinesefood'=>'100','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'100','frenchfoodaddvalue'=>'50','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'803001','cookingability'=>'60','cookingabilityaddvalue'=>'2','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'100','ideafoodaddvalue'=>'50','goodwill'=>'10'],
['id'=>'803002','cookingability'=>'80','cookingabilityaddvalue'=>'3','chinesefood'=>'100','chinesefoodaddvalue'=>'50','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'803003','cookingability'=>'100','cookingabilityaddvalue'=>'4','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'100','westernfoodaddvalue'=>'50','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'803007','cookingability'=>'120','cookingabilityaddvalue'=>'5','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'100','japenesefoodaddvalue'=>'50','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'803008','cookingability'=>'100','cookingabilityaddvalue'=>'6','chinesefood'=>'100','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'100','frenchfoodaddvalue'=>'50','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'803009','cookingability'=>'130','cookingabilityaddvalue'=>'7','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'100','westernfoodaddvalue'=>'50','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'804001','cookingability'=>'60','cookingabilityaddvalue'=>'8','chinesefood'=>'100','chinesefoodaddvalue'=>'50','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'804002','cookingability'=>'80','cookingabilityaddvalue'=>'9','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'100','westernfoodaddvalue'=>'50','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'804003','cookingability'=>'100','cookingabilityaddvalue'=>'10','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'100','japenesefoodaddvalue'=>'50','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'805001','cookingability'=>'60','cookingabilityaddvalue'=>'2','chinesefood'=>'100','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'100','frenchfoodaddvalue'=>'50','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'805002','cookingability'=>'80','cookingabilityaddvalue'=>'3','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'100','ideafoodaddvalue'=>'50','goodwill'=>'10'],
['id'=>'805003','cookingability'=>'100','cookingabilityaddvalue'=>'4','chinesefood'=>'100','chinesefoodaddvalue'=>'50','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'806001','cookingability'=>'60','cookingabilityaddvalue'=>'5','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'100','westernfoodaddvalue'=>'50','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'806002','cookingability'=>'80','cookingabilityaddvalue'=>'6','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'100','japenesefoodaddvalue'=>'50','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'806003','cookingability'=>'100','cookingabilityaddvalue'=>'7','chinesefood'=>'100','chinesefoodaddvalue'=>'0','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'100','frenchfoodaddvalue'=>'50','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'806004','cookingability'=>'120','cookingabilityaddvalue'=>'8','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'100','westernfoodaddvalue'=>'50','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'806005','cookingability'=>'110','cookingabilityaddvalue'=>'9','chinesefood'=>'100','chinesefoodaddvalue'=>'50','westernfood'=>'0','westernfoodaddvalue'=>'0','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10'],
['id'=>'806006','cookingability'=>'100','cookingabilityaddvalue'=>'10','chinesefood'=>'0','chinesefoodaddvalue'=>'0','westernfood'=>'100','westernfoodaddvalue'=>'50','japenesefood'=>'0','japenesefoodaddvalue'=>'0','frenchfood'=>'0','frenchfoodaddvalue'=>'0','ideafood'=>'0','ideafoodaddvalue'=>'0','goodwill'=>'10']
];
}
 return self::$_data;
}
}
