<?php
namespace configdata;
/**
* gen by zeus.php
*/
class configdata_advertisement_invited_award_setting {
const k_id = "id";
const k_gamecoin = "gamecoin";
const k_diamond = "diamond";
const k_itemid = "itemid";
const k_itemcount = "itemcount";
private static $_data = NULL;
public static function data() {
if (is_null ( self::$_data )) {
self::$_data = [
['id'=>'1','itemid'=>'205045','itemcount'=>'1']
];
}
 return self::$_data;
}
}
