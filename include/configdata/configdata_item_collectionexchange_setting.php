<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_item_collectionexchange_setting {
const k_id = "id";
const k_itemid1 = "itemid1";
const k_itemid2 = "itemid2";
const k_itemid3 = "itemid3";
const k_itemid4 = "itemid4";
const k_itemid5 = "itemid5";
const k_awardgamecoin = "awardgamecoin";
const k_awarddiamonds = "awarddiamonds";
const k_awardrestaruantexp = "awardrestaruantexp";
const k_awarditemid = "awarditemid";
const k_awarditemcount = "awarditemcount";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','itemid1'=>'701001','itemid2'=>'701002','itemid3'=>'701003','itemid4'=>'701004','itemid5'=>'701005','awardgamecoin'=>'2000','awarditemid'=>'113005','awarditemcount'=>'1'],
['id'=>'2','itemid1'=>'401001','itemid2'=>'401002','itemid3'=>'401003','itemid4'=>'401004','itemid5'=>'401005','awarddiamonds'=>'10','awarditemid'=>'122002','awarditemcount'=>'1'],
['id'=>'3','itemid1'=>'401006','itemid2'=>'401007','itemid3'=>'401008','itemid4'=>'401009','itemid5'=>'401010','awardrestaruantexp'=>'300','awarditemid'=>'111002','awarditemcount'=>'1'],
['id'=>'4','itemid1'=>'701006','itemid2'=>'701007','itemid3'=>'701008','itemid4'=>'701009','itemid5'=>'701010','awardgamecoin'=>'2000','awarditemid'=>'801001','awarditemcount'=>'1'],
['id'=>'5','itemid1'=>'701011','itemid2'=>'701012','itemid3'=>'701013','itemid4'=>'701014','itemid5'=>'701015','awarddiamonds'=>'10','awarditemid'=>'802001','awarditemcount'=>'1'],
['id'=>'6','itemid1'=>'701016','itemid2'=>'701017','itemid3'=>'701018','itemid4'=>'701019','itemid5'=>'701020','awardrestaruantexp'=>'300','awarditemid'=>'803001','awarditemcount'=>'1'],
['id'=>'7','itemid1'=>'701021','itemid2'=>'701022','itemid3'=>'701023','itemid4'=>'701024','itemid5'=>'701025','awardgamecoin'=>'2000','awarditemid'=>'803002','awarditemcount'=>'1'],
['id'=>'8','itemid1'=>'701026','itemid2'=>'701027','itemid3'=>'701028','itemid4'=>'701029','itemid5'=>'701030','awarddiamonds'=>'10','awarditemid'=>'805001','awarditemcount'=>'1'],
['id'=>'9','itemid1'=>'701031','itemid2'=>'701032','itemid3'=>'701033','itemid4'=>'701034','itemid5'=>'701035','awardrestaruantexp'=>'300','awarditemid'=>'806001','awarditemcount'=>'1']
];
}
 return self::$_data;
}
}
